Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

$repoRoot = Split-Path -Parent $PSScriptRoot
Set-Location $repoRoot

Write-Host 'Starting Docker services...'
docker compose up -d db wordpress | Out-Null

$siteUrl = 'http://localhost:8080'
$maxAttempts = 60
$attempt = 0

while ($attempt -lt $maxAttempts) {
    $attempt++

    try {
        $response = Invoke-WebRequest -Uri $siteUrl -UseBasicParsing -TimeoutSec 3

        if ($response.StatusCode -ge 200 -and $response.StatusCode -lt 500) {
            break
        }
    } catch {
        Start-Sleep -Seconds 2
        continue
    }
}

if ($attempt -ge $maxAttempts) {
    throw 'WordPress container did not become reachable on http://localhost:8080.'
}

Write-Host 'Bootstrapping WordPress, WooCommerce, theme, plugin, and demo content...'
docker compose run --rm --entrypoint sh wpcli /workspace/scripts/wp-bootstrap.sh | Out-Null

Write-Host ''
Write-Host 'Launch complete.'
Write-Host "Storefront: $siteUrl"
Write-Host 'Admin: http://localhost:8080/wp-admin'
Write-Host 'Username: admin'
Write-Host 'Password: admin123!'
