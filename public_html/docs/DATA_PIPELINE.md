# Hybrid Data Pipeline & Storage

## Overview

Central.Enterprises uses a **Tripartite Storage Model** to handle massive datasets without saturating the application server.

1. **Application Logic:** Oracle Cloud (PHP/HTML).
2. **Heavy Assets (ZIPs):** Dropbox (Edge/CDN).
3. **Metadata Registry:** `data/digital_library.json` (Oracle Cloud).

## The `Outputs` Directory

The `Outputs` directory on the local machine contains the generated datasets (OpenData & Premium).

- **Status:** **EXCLUDED** from Git and Deployment.
- **Reason:** Files exceed 2GB+.

## Synchronization Workflow

> [!IMPORTANT]
> **The `Outputs` directory is dynamic.** As new datasets are generated locally, you must manually update the production metadata.

### How to Update Production Data

When you generate new datasets in `Outputs/`:

1. **Sync to Dropbox:** Upload the new `.zip` files from `Outputs/` to your Dropbox Public folder.
2. **Update Manifest:** The generator script updates `Outputs/digital_library.json` with the new Dropbox links and metrics.
3. **Deploy Metadata:** You must **MANUALLY COPY** the updated manifest to the production deployment folder:

    ```powershell
    Copy-Item Outputs/digital_library.json data/digital_library.json
    ```

4. **Deploy:** Run the standard deployment script to push the new JSON to Oracle.

    ```powershell
    ./deployment/deploy_prod.ps1
    ```

**Note:** The application frontend reads exclusively from `data/digital_library.json`. If you do not copy the file, the website will continue to serve old links/metrics even if you have new local files.
