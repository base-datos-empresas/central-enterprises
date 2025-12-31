# DEPLOYMENT INSTRUCTIONS

## 1. Local Development (Windows/Linux)
cd centralui
python -m venv venv
# Activate: .\venv\Scripts\activate (Windows) or source venv/bin/activate (Linux)
pip install -r requirements.txt
cp .env.example .env
python app.py
# Open http://127.0.0.1:8050

## 2. Server Deployment (Ubuntu 20.04 ARM OCI)

# a. Prepare Directories
sudo mkdir -p /opt/centralui
sudo chown -R ubuntu:ubuntu /opt/centralui
# Upload files via SCP to /opt/centralui (exclude venv and __pycache__)

3. DEPLOYMENT STEPS
-------------------
A. Ensure the server has a virtual environment at /opt/centralui/venv
B. Run the 'deploy_prod.ps1' script from your local machine.
   The script will:
   - Upload public_html, PythonTools, data, and config files.
   - Automatically update dependencies on the server (pip install).
   - Automatically restart the 'centralui-api.service' and 'nginx'.

4. API ENDPOINTS
----------------
- Health Check: https://central.enterprises/api/health
- Recompute Data: POST https://central.enterprises/api/v1/recompute?dry-run=true (Requires X-API-Token)

# d. Configure Nginx
# Add the location block from nginx_snippet.conf to /etc/nginx/sites-available/central.enterprises
sudo nginx -t
sudo systemctl reload nginx

# e. Verification
curl -I http://127.0.0.1:8050
