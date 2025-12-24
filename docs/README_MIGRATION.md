# CentralUI Hybrid Migration Guide

This project has been migrated to a hybrid architecture:

- **PHP** (Frontend): Serves ultra-fast static HTML landings using pre-calculated CSVs.
- **Python** (Backend): Processes big data and exposes an API.

## 1. Directory Structure

```
/centralui
├── PythonTools/          # Python Scripts & API
│   ├── process_data.py   # Streaming Data Processor (Big CSV -> Small CSVs)
│   ├── api.py            # Flask API (Health, Recompute)
│   └── sitemap_generator.py
├── public_html/          # Web Root (PHP)
│   ├── country/          # Landing Pages
│   │   └── index.php     # Main Landing Template
│   ├── lib/              # PHP Libraries
│   │   └── TitanData.php # Data Reader
│   └── assets/           # CSS/JS
├── data/
│   ├── country_data.csv  # Source Data
│   └── outputs/          # Generated Small CSVs (Read by PHP)
├── docs/                 # Documentation
│   └── README_MIGRATION.md
└── nginx.conf            # Server Configuration
```

## 2. Data Generation (Python)

To generate the optimized CSVs for the website:

```bash
# Activate Venv
.\venv\Scripts\activate

# Run Processor (Source -> Output)
python backend/process_data.py --source centralui/data/country_data.csv --out data/outputs
```

This generates `country_stats_{code}.csv` and `country_top_categories_{code}.csv` in `data/outputs`.

## 3. Frontend (PHP)

The frontend expects a PHP-FPM environment.

- **URL Structure**: `https://domain.com/country/es` -> maps to `index.php?code=es`.
- **Logic**: `index.php` uses `TitanData` to read the CSV for "es" and renders the Titan Design System.

## 4. Backend API

Start the API (Gunicorn in production):

```bash
python backend/api.py
```

- **Health**: `GET /api/health`
- **Recompute**: `POST /api/v1/recompute` (Requires `X-API-Token: titan-secret-key`)

## 5. Sitemap

Generate the sitemap based on available country data:

```bash
python backend/sitemap_generator.py
```

## 6. Deployment (Nginx)

Use the provided `nginx.conf` as a baseline. It configures:

- Static Asset Caching
- PHP-FPM handling
- `/api/` reverse proxy to Python
