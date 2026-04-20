# Deployment Script for Pantheon

# This script automates the migration of your custom Azure Synthetics theme and plugin to Pantheon.
# It assumes you have Git installed and your SSH keys are set up in your own terminal.

$pantheonGitUrl = "ssh://codeserver.dev.40264a91-6a93-4042-a9b5-a73e0b8b55f3@codeserver.dev.40264a91-6a93-4042-a9b5-a73e0b8b55f3.drush.in:2222/~/repository.git"
$tempDir = "pantheon_deploy_tmp"
$bundleDir = "migration_bundle"

Write-Host "--- Azure Synthetics Pantheon Deployer ---" -ForegroundColor Cyan

# 1. Clean up old attempts
if (Test-Path $tempDir) {
    Write-Host "Cleaning up old temporary directory..."
    Remove-Item -Path $tempDir -Recurse -Force
}

# 2. Clone Pantheon Repository
Write-Host "Step 1: Cloning your Pantheon repository..." -ForegroundColor Yellow
git clone $pantheonGitUrl $tempDir
if ($LASTEXITCODE -ne 0) {
    Write-Host "Error: Failed to clone Pantheon repo. Please ensure your SSH keys are added to Pantheon." -ForegroundColor Red
    exit
}

# 3. Inject Custom Theme and Plugin
Write-Host "Step 2: Injecting custom theme and plugin..." -ForegroundColor Yellow
if (-not (Test-Path $bundleDir)) {
    Write-Host "Error: Migration bundle not found. Please ask Antigravity to recreate it." -ForegroundColor Red
    exit
}

xcopy /E /I /Y "$bundleDir\wp-content" "$tempDir\wp-content"

# 4. Commit and Push
Write-Host "Step 3: Committing and pushing to Pantheon..." -ForegroundColor Yellow
Push-Location $tempDir
git add .
git commit -m "Deploy Azure Synthetics Storefront - Automated Push"
git push origin master
Pop-Location

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "SUCCESS! Your code has been pushed to Pantheon." -ForegroundColor Green
    Write-Host "Now, go to your Pantheon Dashboard and upload the database file: " -ForegroundColor White
    Write-Host "$bundleDir\azure_synthetics_full_migration.sql" -ForegroundColor White
} else {
    Write-Host "Error: Failed to push code to Pantheon." -ForegroundColor Red
}

Write-Host "-------------------------------------------"
