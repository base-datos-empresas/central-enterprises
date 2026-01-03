# Central.Enterprises | The Open Company Data Foundation

> **Status:** In Formation (Spain)  
> **Operator:** Pablo Cirre (Steward)  
> **Version:** v1.1.0 (Stable)

**Central.Enterprises** is a global reference layer for corporate entity data, provided as **Public Infrastructure (CC0)**. We standardize, deduplicate, and publish company registries from around the world to ensure business reality is accessible to researchers, journalists, and systems—not just those who can afford proprietary access.

## 🏛 The Mission

Open data is infrastructure. It is the difference between an opaque economy and one where innovation allows small players to compete.

- **Public Core (CC0):** Basic entity data (Name, ID, Address, Status) is always free and public domain.
- **Pro Layer (Enrichment):** Optional commercial layer providing digital footprint signals (Domains, Emails, Social).
- **Hybrid Architecture:** High-availability static delivery coupled with a "Deep Registry" dynamic backend.

## 🏗 Architecture

This project uses a **Hybrid Storage Cloud** architecture to deliver massive datasets without server saturation.

### Stack

- **Frontend:** Vanilla PHP 8.4 (Component-based).
- **Styling:** Titan Design System (CSS Variables, Dark Mode native).
- **Data Plane:** `registry_index.json` (No SQL Database).
- **Storage:** Hybrid Cloud (Oracle Block Storage + Dropbox Public Edge).
- **Routing:** Nginx 1.22 (Hardened CSP).

### Directory Structure

```text
/
├── public_html/          # Web Root (Encapsulated Modules)
│   ├── assets/           # Titan CSS, JS, Favicons
│   ├── data/             # Catalog & Registry Logic
│   ├── pro/              # Commercial Layer
│   ├── standard/         # Schema Documentation (v1)
│   ├── foundation/       # Governance & Roadmap
│   ├── docs/             # Technical Documentation Hub
│   └── index.php         # Entry Point
│
├── data/                 # Core Data Registry
│   └── registry_index.json  # The "Database" (JSON Snapshot)
│
├── deployment/           # DevOps Automations
│   └── deploy_prod.ps1      # PowerShell Deployment Script
│
└── PythonTools/          # Backend CLI Utilities
    ├── HybridStorage.py     # Syncs local data to Cloud
    └── SitemapGenerator.py  # Generates SEO maps from JSON
```

## 🚀 Deployment

The platform is deployed to Oracle Cloud Infrastructure (OCI) via a custom PowerShell pipeline.

**Prerequisites:**

- SSH Key `id_rsa` in `deployment/secrets/`.
- PowerShell 7+.

**Command:**

```powershell
./deployment/deploy_prod.ps1
```

**What it does:**

1. **Syncs Code:** `scp` transfers `public_html` to `/var/www/html`.
2. **Hardens Permissions:** Sets `www-data` ownership and `755/644` modes.
3. **Restarts Services:** Reloads `php8.4-fpm` and `nginx`.
4. **Verifies:** Checks HTTP 200 OK on endpoints.

## 📜 Standards & Schema

We adhere to the **Open Company Data Standard (OCDS) v1**.

- **Manifesto:** [Read the Institutional Manifesto](https://central.enterprises/docs/manifesto.php)
- **Methodology:** [View Data Quality Metrics](https://central.enterprises/docs/methodology.php)

## ⚖️ Legal & Governance

**Central.Enterprises** is currently transitioning into a Spain-based foundation.

- **Legal Notice:** [LSSI Compliance](https://central.enterprises/legal/notice/)
- **Privacy:** [GDPR Policy](https://central.enterprises/legal/privacy/)
- **Open Data:** Released under **Creative Commons Zero (CC0)**.

---
*Built with discipline. Published with responsibility. Open by conviction.*
