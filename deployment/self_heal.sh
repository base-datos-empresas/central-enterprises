#!/bin/bash
# SELF-HEALING INFRASTRUCTURE SCRIPT
# Checks local API and Nginx status. Restarts if failed.

LOG_FILE="/opt/centralui/self_heal.log"
TIMESTAMP=$(date "+%Y-%m-%d %H:%M:%S")

# 1. Check Python API (Local Port 8000)
STATUS_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:8000/api/health || echo "000")

if [ "$STATUS_CODE" -ne 200 ]; then
    echo "$TIMESTAMP [ERROR] API DOWN (Code: $STATUS_CODE). Restarting..." >> $LOG_FILE
    sudo systemctl restart centralui-api.service
else
    echo "$TIMESTAMP [OK] API Healthy" >> $LOG_FILE
fi

# 2. Check Nginx
if ! pgrep nginx > /dev/null; then
    echo "$TIMESTAMP [ERROR] Nginx DOWN. Restarting..." >> $LOG_FILE
    sudo systemctl restart nginx
fi

# 3. ENFORCE PERMISSIONS (Robustness Fix)
# Ensure directories are 755 and files are 644
echo "$TIMESTAMP [FIX] Enforcing Permissions..." >> $LOG_FILE
sudo find /opt/centralui/public_html /opt/centralui/data /opt/centralui/bases -type d -exec chmod 755 {} \;
sudo find /opt/centralui/public_html /opt/centralui/data /opt/centralui/bases -type f -exec chmod 644 {} \;
sudo chown -R ubuntu:www-data /opt/centralui/public_html /opt/centralui/data /opt/centralui/bases

echo "$TIMESTAMP [OK] Self-Heal Cycle Complete" >> $LOG_FILE
