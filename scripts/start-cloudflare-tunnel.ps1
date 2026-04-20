Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

$repoRoot = Split-Path -Parent $PSScriptRoot
$exePath = Join-Path $repoRoot '.tools\cloudflared\cloudflared.exe'
$tunnelDir = Join-Path $repoRoot '.tunnel'
$pidFile = Join-Path $tunnelDir 'cloudflared.pid'
$stdoutLog = Join-Path $tunnelDir 'cloudflared.out.log'
$stderrLog = Join-Path $tunnelDir 'cloudflared.err.log'

if (-not (Test-Path $exePath)) {
	throw "cloudflared binary not found at $exePath"
}

New-Item -ItemType Directory -Force $tunnelDir | Out-Null

if (Test-Path $pidFile) {
	$existingPid = Get-Content $pidFile -ErrorAction SilentlyContinue
	if ($existingPid) {
		$existingProcess = Get-Process -Id $existingPid -ErrorAction SilentlyContinue
		if ($existingProcess) {
			Stop-Process -Id $existingPid -Force -ErrorAction SilentlyContinue
		}
	}
}

Remove-Item $stdoutLog, $stderrLog -ErrorAction SilentlyContinue

$process = Start-Process `
	-FilePath $exePath `
	-ArgumentList @('--no-autoupdate', 'tunnel', '--url', 'http://localhost:8080') `
	-RedirectStandardOutput $stdoutLog `
	-RedirectStandardError $stderrLog `
	-PassThru `
	-WindowStyle Hidden

$process.Id | Set-Content $pidFile

$deadline = (Get-Date).AddSeconds(45)
$url = $null

while ((Get-Date) -lt $deadline) {
	Start-Sleep -Milliseconds 500

	$combined = ''
	if (Test-Path $stdoutLog) {
		$combined += [System.IO.File]::ReadAllText($stdoutLog)
	}
	if (Test-Path $stderrLog) {
		$combined += "`n" + [System.IO.File]::ReadAllText($stderrLog)
	}

	$match = [regex]::Match($combined, 'https://[-a-z0-9]+\.trycloudflare\.com')
	if ($match.Success) {
		$url = $match.Value
		break
	}

	if ($process.HasExited) {
		break
	}
}

[pscustomobject]@{
	Pid = $process.Id
	HasExited = $process.HasExited
	Url = $url
	StdoutLog = $stdoutLog
	StderrLog = $stderrLog
} | ConvertTo-Json -Compress
