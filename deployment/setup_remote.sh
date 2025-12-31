#!/bin/bash
set -e

APP_DIR="/opt/centralui"
cd $APP_DIR

echo ">>> Setting up Virtual Environment..."
if [ ! -d "venv" ]; then
    python3 -m venv venv
fi
./venv/bin/pip install -r requirements.txt gunicorn flask

echo ">>> Configuring Systemd Service..."
sudo cp centralui-api.service /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable centralui-api
sudo systemctl restart centralui-api

echo ">>> Configuring Nginx..."
# Ensure default is disabled or configured
if [ -f /etc/nginx/sites-enabled/default ]; then
    sudo rm /etc/nginx/sites-enabled/default
fi

sudo cp nginx.conf /etc/nginx/sites-available/central.enterprises
# Link if not exists
if [ ! -L /etc/nginx/sites-enabled/central.enterprises ]; then
    sudo ln -s /etc/nginx/sites-available/central.enterprises /etc/nginx/sites-enabled/
fi

sudo nginx -t
sudo systemctl restart nginx

echo ">>> Deployment Complete!"
