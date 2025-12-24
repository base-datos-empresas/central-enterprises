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

# b. Setup Environment
cd /opt/centralui
python3 -m venv venv
./venv/bin/pip install -r requirements.txt
cp .env.example .env

# c. Setup Systemd Service
sudo cp centralui.service /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable centralui
sudo systemctl start centralui
sudo systemctl status centralui

# d. Configure Nginx
# Add the location block from nginx_snippet.conf to /etc/nginx/sites-available/central.enterprises
sudo nginx -t
sudo systemctl reload nginx

# e. Verification
curl -I http://127.0.0.1:8050
