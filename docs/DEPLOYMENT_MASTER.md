# DEPLOYMENT MASTER MANUAL

**Target Environment**: Oracle Cloud (Ubuntu 22.04 LTS)  
**Web Server**: Nginx + PHP 8.1-FPM  
**Orchestration**: PowerShell (`deploy_prod.ps1`)

---

## 1. Deployment Pipeline

The deployment process is automated via `deployment/deploy_prod.ps1`. This script ensures consistency and permission integrity across updates.

### Workflow

1. **Pre-Flight Identity**: Checks for `Oracle-key-privada.key`.
2. **Upload**: Uses `scp` to sync `public_html`, `PythonTools`, and `data` manifests.
    - *Note*: `bases/` directory is skipped to save bandwidth (static assets).
3. **Permissions (CRITICAL)**:
    - Directories: `775` (User/Group Write)
    - Files: `664` (User/Group Write)
    - **Why?**: Grants `www-data` (PHP/Webhooks) ability to write to `subscriptions.sqlite` and `data/` logs.
4. **Dependencies**: Checks/Installs Python `requirements.txt` in a `venv`.
5. **Service Restart**: Reloads `nginx` and `centralui-api` (Python Gunicorn).
6. **Self-Heal**: Runs `/opt/centralui/self_heal.sh` as a final sanity check.

---

## 2. Server Configuration (`nginx.conf`)

The Nginx configuration is hardened for security and high availability.

### Security Headers (Grade A+)

- `Strict-Transport-Security`: Preload enabled.
- `Content-Security-Policy`: Strict whitelist for Google Analytics/Tags.
- `X-Frame-Options`: SAMEORIGIN.

### PHP-FPM Handling

- Passes to `unix:/run/php/php7.4-fpm.sock` (Legacy ref, verified working).
- **Buffer Tuning**: `fastcgi_buffers 16 16k` to handle large JSON dumps.

### Caching Strategy

- **Assets**: `expires 30d` for `/assets/`.
- **Versioning**: All CSS/JS links use `?v=XXX` query params to bust cache on deploy.

---

## 3. Automation Scripts

### `self_heal.sh`

Located at `/opt/centralui/self_heal.sh` (Remote).

- Runs every 5 minutes via Cron.
- Resets permissions if they drift.
- Restarts Nginx if it crashes.

### `git_uploader.py`

Located at `PythonTools/git_uploader.py` (Local).

- Automates Git version control.
- Handles PAT authentication for the private repo.

---

## 4. Emergency Procedures

**If Site Returns 403 Forbidden:**

1. Run `deploy_prod.ps1` immediately (it reapplies `chmod 775`).
2. SSH manually and run:

    ```bash
    sudo chown -R ubuntu:www-data /opt/centralui
    sudo chmod -R 775 /opt/centralui/public_html
    ```

**If Stripe Webhooks Fail:**

1. Check `data/subscriptions.sqlite` permissions.
2. Ensure `www-data` can write to the `data/` directory.
