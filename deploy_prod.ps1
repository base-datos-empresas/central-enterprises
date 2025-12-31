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

# 4. Upload System Files
Write-Host "Uploading Config & Requirements..."
scp -i $KeyPath -o StrictHostKeyChecking=no nginx.conf "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no centralui-api.service "${User}@${HostName}:${RemotePath}"
scp -i $KeyPath -o StrictHostKeyChecking=no requirements.txt "${User}@${HostName}:${RemotePath}"

Write-Host "Deployment Files Uploaded."

# 5. Remote Environment & Dependencies
Write-Host "Updating Remote Environment..."
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" "cd $RemotePath && ./venv/bin/pip install -r requirements.txt && sudo chmod -R 755 public_html"

# 6. Restart Services
Write-Host "Restarting Services..."
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" "sudo cp $RemotePath/centralui-api.service /etc/systemd/system/ && sudo systemctl daemon-reload && sudo systemctl restart centralui-api.service"
ssh -i $KeyPath -o StrictHostKeyChecking=no "${User}@${HostName}" "sudo systemctl restart nginx"

Write-Host "Deployment Complete. Services Synchronized."
