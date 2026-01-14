# Stability and Robustness Architecture

This document outlines the measures taken to ensure `central.enterprises` remains stable and free of 403 (Forbidden) errors.

## 1. Automatic Permission Recovery

The script `deployment/self_heal.sh` runs every **5 minutes** on the Oracle server via cron.
It performs the following:

- Verify and restart Python API (Gunicorn).
- Verify and restart Nginx.
- **Permission Enforcement**: Recursively resets directories to `755` and files to `644`, ensuring the `www-data` group always has read access.

## 2. Hardened Deployment

The `deployment/deploy_prod.ps1` script includes:

- **Pre-flight Checks**: Ensures the SSH key is available and directories are writable.
- **Post-flight Verification**: Checks the public URL via `curl` immediately after deployment.
- **Post-flight Verification**: Checks the public URL via `curl` immediately after deployment.
- **Immediate Recovery**: Triggers `self_heal.sh` manually if the verification fails.

## 4. GitHub Synergy

Code changes are pushed to GitHub via `PythonTools/git_uploader.py`, ensuring a versioned backup exists before every deployment.

## 5. Rules of Engagement (For New Agents)

To maintain this stability, all agents MUST:

1. **Always use the Workflows**: Refer to `.agent/workflows/` for deployment and data updates.
2. **No Direct SSH Edits**: Do not modify files directly on the Oracle server. Always deploy through `deploy_prod.ps1`.
3. **Validate PHP**: Ensure all PHP changes are linted before pushing (`php -l`).
4. **Manifest Priority**: Treat `digital_library.json` as the immutable authority for dataset metrics.
5. **SEO Integrity**: Never change a country slug without updating the sitemap and internal redirects.
