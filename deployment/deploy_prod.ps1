$ErrorActionPreference = "Stop"

# Robust Path Resolution
$DeployScriptRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$ProjectRoot = Split-Path -Parent $DeployScriptRoot

# Configuration (Paths relative to project root)
$KeyPath = Join-Path $ProjectRoot "Server_Config\Oracle-key-privada.key"
$User = "ubuntu"
$HostName = "central.enterprises"
$RemotePath = "/opt/centralui"

Write-Host "Starting Deployment to $HostName..."

# 0. Remote Setup (Ensure directory exists and is writable)
Write-Host "Setting up remote directories..."
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" "sudo mkdir -p /opt/centralui && sudo chown -R ubuntu:ubuntu /opt/centralui"
if ($LASTEXITCODE -ne 0) { Write-Error "Failed to setup remote directories." }


# 1. Upload public_html
Write-Host "Uploading public_html..."
scp -i $KeyPath -o StrictHostKeyChecking=no -r (Join-Path $ProjectRoot "public_html") "${User}@${HostName}:${RemotePath}"

# 2. Upload PythonTools
Write-Host "Uploading PythonTools..."
scp -i $KeyPath -o StrictHostKeyChecking=no -r (Join-Path $ProjectRoot "PythonTools") "${User}@${HostName}:${RemotePath}"

# 3. Upload Data & Bases
Write-Host "Uploading Data and Bases..."
scp -i $KeyPath -o StrictHostKeyChecking=no -r (Join-Path $ProjectRoot "data") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no -r (Join-Path $ProjectRoot "bases") "${User}@${HostName}:${RemotePath}"

# 4. Upload System Files
Write-Host "Uploading Config & Requirements..."
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "nginx.conf") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "centralui-api.service") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "self_heal.sh") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $ProjectRoot "requirements.txt") "${User}@${HostName}:${RemotePath}"

Write-Host "Deployment Files Uploaded."

# 5. Remote Environment, Dependencies & Permissions
Write-Host "Updating Remote Environment and Permissions..."
$RemoteCmds = "cd $RemotePath && " +
"sudo ./venv/bin/pip install -r requirements.txt && " +
"sudo chmod +x self_heal.sh && " +
"sudo find public_html data bases -type d -exec chmod 755 {} \; && " +
"sudo find public_html data bases -type f -exec chmod 644 {} \; && " +
"sudo chown -R ubuntu:www-data data bases public_html"
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" $RemoteCmds
if ($LASTEXITCODE -ne 0) { Write-Error "Failed to update remote environment/permissions." }

# 6. Restart Services & Apply Config & Set Cron
Write-Host "Restarting Services..."
$ServiceCmds = "sudo cp $RemotePath/centralui-api.service /etc/systemd/system/ && " +
"sudo systemctl daemon-reload && " +
"sudo systemctl restart centralui-api.service && " +
"sudo cp $RemotePath/nginx.conf /etc/nginx/sites-available/central.enterprises && " +
"sudo ln -sf /etc/nginx/sites-available/central.enterprises /etc/nginx/sites-enabled/ && " +
"sudo systemctl restart nginx && " +
"sudo /opt/centralui/self_heal.sh && " +
"(crontab -l 2>/dev/null | grep -v 'self_heal.sh'; echo '*/5 * * * * /opt/centralui/self_heal.sh') | crontab -"
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" $ServiceCmds

# 7. Post-Deployment Verification
Write-Host "Verifying Deployment..."
$VerifyStatus = curl.exe -I -s -o /dev/null -w "%{http_code}" "https://$HostName"
if ($VerifyStatus -eq "200" -or $VerifyStatus -eq "301" -or $VerifyStatus -eq "302") {
    Write-Host "SUCCESS: Site is LIVE and STABLE (Status: $VerifyStatus)."
}
else {
    Write-Warning "CAUTION: Site returned status $VerifyStatus. Running emergency self-heal..."
    ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" "sudo /opt/centralui/self_heal.sh"
}

Write-Host "Deployment Complete. Services Synchronized and Hardened."
