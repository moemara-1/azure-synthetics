Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

$repoRoot = Split-Path -Parent $PSScriptRoot
$tunnelDir = Join-Path $repoRoot '.tunnel'
$pidFile = Join-Path $tunnelDir 'localtunnel.pid'
$logFile = Join-Path $tunnelDir 'localtunnel.log'

New-Item -ItemType Directory -Force $tunnelDir | Out-Null

# Clean up existing PID if it exists
if (Test-Path $pidFile) {
    try {
        $existingPid = Get-Content $pidFile -ErrorAction SilentlyContinue
        if ($existingPid) {
            $existingProcess = Get-Process -Id $existingPid -ErrorAction SilentlyContinue
            if ($existingProcess) {
                Stop-Process -Id $existingPid -Force -ErrorAction SilentlyContinue
            }
        }
    } catch {}
    Remove-Item $pidFile -ErrorAction SilentlyContinue
}

# Clean up existing log
if (Test-Path $logFile) {
    Remove-Item $logFile -ErrorAction SilentlyContinue
}

Write-Host "Starting Localtunnel for azure-synthetics..."

# Use npx to run localtunnel in the background
# We use -WindowStyle Hidden to prevent a terminal pop-up
$process = Start-Process `
    -FilePath "npx.cmd" `
    -ArgumentList "localtunnel", "--port", "8080", "--subdomain", "azure-synthetics" `
    -RedirectStandardOutput $logFile `
    -PassThru `
    -WindowStyle Hidden

$process.Id | Set-Content $pidFile

# Wait for URL to appear in log
$maxWait = 30
$count = 0
$url = $null

while ($count -lt $maxWait) {
    Start-Sleep -Seconds 1
    $count++
    
    if (Test-Path $logFile) {
        $logContent = Get-Content $logFile -Raw
        if ($logContent -match "your url is: (https://[a-zA-Z0-9.-]+\.loca\.lt)") {
            $url = $Matches[1]
            break
        }
    }
}

if ($url) {
    Write-Host "Tunnel active: $url"
} else {
    Write-Host "Failed to retrieve URL from Localtunnel logs."
    Get-Content $logFile
}

# Return JSON for tool parsing if needed
[pscustomobject]@{
    Pid = $process.Id
    Url = $url
    LogFile = $logFile
} | ConvertTo-Json
