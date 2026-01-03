#!/bin/bash
# SELF-HEALING INFRASTRUCTURE SCRIPT
# Checks local API and Nginx status. Restarts if failed.

LOG_FILE="/opt/centralui/self_heal.log"
TIMESTAMP=$(date "+%Y-%m-%d %H:%M:%S")

# 1. Check Python API (Local Port 8000)
STATUS_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:8000/api/status || echo "000")

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
