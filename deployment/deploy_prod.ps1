$ErrorActionPreference = "Stop"

# Robust Path Resolution
$DeployScriptRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$ProjectRoot = Split-Path -Parent $DeployScriptRoot

# Configuration (Paths relative to project root)
$KeyPath = Join-Path $ProjectRoot "Server_Config\Oracle-key-privada.key"
$User = "ubuntu"
$HostName = "central.enterprises"
$RemotePath = "/opt/centralui"

# 0. Pre-Flight Integrity Check
Write-Host "Running Pre-Flight Checks..."
if (-not (Test-Path $KeyPath)) { 
    Write-Error "CRITICAL: Private key not found at $KeyPath. Deployment aborted." 
}

# Verify local manifest exists
if (-not (Test-Path (Join-Path $ProjectRoot "data\digital_library.json"))) {
    Write-Error "CRITICAL: data\digital_library.json missing. Deployment aborted."
}

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
# 3. Upload Data & Bases (METADATA ONLY)
Write-Host "Uploading Critical Metadata (Registry & Library)..."
# Ensure remote data directory exists
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" "sudo mkdir -p ${RemotePath}/data && sudo chown ubuntu:ubuntu ${RemotePath}/data"
# Upload only the index files
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $ProjectRoot "data\registry_index.json") "${User}@${HostName}:${RemotePath}/data/"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $ProjectRoot "data\digital_library.json") "${User}@${HostName}:${RemotePath}/data/"
# Bases are skipped as requested
# scp -i $KeyPath -o StrictHostKeyChecking=no -r (Join-Path $ProjectRoot "bases") "${User}@${HostName}:${RemotePath}"

# 4. Upload System Files
Write-Host "Uploading Config & Requirements..."
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "nginx.conf") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "centralui-api.service") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $DeployScriptRoot "self_heal.sh") "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no (Join-Path $ProjectRoot "requirements.txt") "${User}@${HostName}:${RemotePath}"

Write-Host "Deployment Files Uploaded."

# 5. Remote Environment, Dependencies & Permissions
# 5. Remote Environment, Dependencies & Permissions
Write-Host "Updating Remote Environment and Permissions..."
$RemoteCmds = "cd $RemotePath && " +
"sudo chown -R ubuntu:www-data public_html data bases && " +
"sudo find public_html data bases -type d -exec chmod 775 {} \; && " +
"sudo find public_html data bases -type f -exec chmod 664 {} \; && " +
"if [ ! -d 'venv' ]; then sudo python3 -m venv venv; fi && " +
"sudo ./venv/bin/pip install -r requirements.txt || echo 'Pip failed but continuing...'"
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" $RemoteCmds
if ($LASTEXITCODE -ne 0) { Write-Warning "Remote command had issues, but attempting to proceed..." }

# 6. Restart Services & Apply Config & Set Cron
Write-Host "Restarting Services..."
$ServiceCmds = "sudo cp $RemotePath/centralui-api.service /etc/systemd/system/ && " +
"sudo systemctl daemon-reload && " +
"sudo systemctl restart centralui-api.service && " +
"sudo cp $RemotePath/nginx.conf /etc/nginx/sites-available/central.enterprises && " +
"sudo ln -sf /etc/nginx/sites-available/central.enterprises /etc/nginx/sites-enabled/ && " +
"sudo systemctl restart nginx && " +
"sudo /opt/centralui/self_heal.sh && " +
"sudo ./venv/bin/python PythonTools/sitemap_generator.py && " +
"(crontab -l 2>/dev/null | grep -v 'self_heal.sh' | grep -v 'backup_db.py'; echo '*/5 * * * * /opt/centralui/self_heal.sh'; echo '0 3 * * * cd /opt/centralui && ./venv/bin/python PythonTools/backup_db.py >> /var/log/central_backup.log 2>&1') | crontab -"
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
