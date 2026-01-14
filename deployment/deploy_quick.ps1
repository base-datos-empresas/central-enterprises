$ErrorActionPreference = "Stop"

# Robust Path Resolution
$DeployScriptRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$ProjectRoot = Split-Path -Parent $DeployScriptRoot

# Configuration (Paths relative to project root)
$KeyPath = Join-Path $ProjectRoot "Server_Config\Oracle-key-privada.key"
$User = "ubuntu"
$HostName = "central.enterprises"
$RemotePath = "/opt/centralui"

Write-Host "--- STARTING QUICK DEPLOY (CODE ONLY) ---"

# 0. Pre-Flight Integrity Check
if (-not (Test-Path $KeyPath)) { 
    Write-Error "CRITICAL: Private key not found at $KeyPath. Deployment aborted." 
}

# 1. Upload public_html (Code)
Write-Host "Uploading public_html..."
scp -i $KeyPath -o StrictHostKeyChecking=no -r (Join-Path $ProjectRoot "public_html") "${User}@${HostName}:${RemotePath}"

# 2. Upload PythonTools
Write-Host "Uploading PythonTools..."
scp -i $KeyPath -o StrictHostKeyChecking=no -r (Join-Path $ProjectRoot "PythonTools") "${User}@${HostName}:${RemotePath}"

# 3. Upload Config Files
Write-Host "Uploading Config..."
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "nginx.conf") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "centralui-api.service") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "self_heal.sh") "${User}@${HostName}:${RemotePath}"

# 4. Restart Services
Write-Host "Applying Changes & Restarting Services..."
$ServiceCmds = "sudo cp $RemotePath/nginx.conf /etc/nginx/sites-available/central.enterprises && " +
"sudo ln -sf /etc/nginx/sites-available/central.enterprises /etc/nginx/sites-enabled/ && " +
"sudo nginx -t && " +
"sudo systemctl restart nginx && " +
"sudo systemctl restart centralui-api.service && " +
"sudo chown -R ubuntu:www-data /opt/centralui && " +
"sudo chmod -R 755 /opt/centralui && " +
"sudo find /opt/centralui -type f -exec chmod 644 {} \; && " +
"sudo find /opt/centralui -type d -exec chmod 755 {} \; && " +
"sudo systemctl restart nginx"

ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" $ServiceCmds

# 5. Verification
Write-Host "Verifying Deployment..."
$VerifyStatus = curl.exe -I -s -o /dev/null -w "%{http_code}" "https://$HostName/country/spain"
if ($VerifyStatus -eq "200") {
    Write-Host "SUCCESS: Site is LIVE. /country/spain returned 200."
}
else {
    Write-Warning "CAUTION: /country/spain returned status $VerifyStatus."
}

Write-Host "Quick Deployment Complete."
