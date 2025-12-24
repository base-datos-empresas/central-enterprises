$ErrorActionPreference = "Stop"

# Configuration
$KeyPath = "Server_Config\Oracle-key-privada.key"
$User = "ubuntu"
$HostName = "central.enterprises"
$RemotePath = "/opt/centralui"

Write-Host "Starting Deployment to $HostName..."

# 0. Remote Setup (Ensure directory exists and is writable)
Write-Host "Setting up remote directories..."
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" "sudo mkdir -p /opt/centralui && sudo chown -R ubuntu:ubuntu /opt/centralui"

# 1. Upload public_html
Write-Host "Uploading public_html..."
scp -i $KeyPath -o StrictHostKeyChecking=no -r public_html "${User}@${HostName}:${RemotePath}"

# 2. Upload PythonTools
Write-Host "Uploading PythonTools..."
scp -i $KeyPath -o StrictHostKeyChecking=no -r PythonTools "${User}@${HostName}:${RemotePath}"

# 3. Upload Data (excluding heavy sources if needed, but here we send all)
Write-Host "Uploading Data..."
scp -i $KeyPath -o StrictHostKeyChecking=no -r data "${User}@${HostName}:${RemotePath}"

# 4. Upload Nginx Conf
Write-Host "Uploading Nginx Config..."
scp -i $KeyPath -o StrictHostKeyChecking=no nginx.conf "${User}@${HostName}:${RemotePath}"

Write-Host "Deployment Files Uploaded."

# 5. Fix Permissions
Write-Host "Fixing Remote Permissions..."
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" "sudo chmod -R 755 /opt/centralui/public_html"

Write-Host "Please SSH in to restart services/nginx if needed."
