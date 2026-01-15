# PYTHON TOOLS MANUAL

**Directory**: `PythonTools/`  
**Interpreter**: Project Virtual Environment (`venv`)

---

## 1. Core ETL Pipeline

### `process_data.py`

**Type**: ETL Engine  
**Input**: Raw source files (CSV, Excel) from `inputs/`.  
**Output**: Structured JSON/CSV in `outputs/`.  
**Function**:

- Cleanses corporate entity names.
- Normalizes address formats.
- Generates the `CentralRating`.

### `sitemap_generator.py`

**Type**: SEO Utility  
**Function**:

- Scans `public_html/country/` logic.
- Generates `sitemap.xml` for all valid country/sector permutations.
- Critical for Google indexing of the "Open Data" footprint.

---

## 2. DevOps & Maintenance

### `git_uploader.py`

**Type**: Version Control Wrapper  
**Usage**: `python git_uploader.py "Commit Message"`  
**Function**:

- Automates `git add .`, `git commit`, `git push`.
- Manages HTTPS authentication tokens to avoid 403 errors.

### `fix_git_auth.py`

**Type**: Repair Script  
**Function**:

- Resets Git remote URLs if authentication tokens expire.

### `technical_check.py`

**Type**: Pre-Flight  
**Function**:

- Verifies file integrity before deployment.
- Checks for syntax errors in critical Python scripts.

---

## 3. Monitoring & Quality

### `pagespeed_check.py`

**Type**: Performance Monitor  
**Usage**: `python pagespeed_check.py`  
**Function**:

- Queries Google PageSpeed Insights API.
- Reports Desktop vs. Mobile performance scores (LCP, CLS).

### `link_tester.py`

**Type**: QA Tool  
**Function**:

- Crawls local or staging environment to find broken internal links (404s).

### `api.py`

**Type**: Backend Service  
**Function**:

- Runs via Gunicorn on port 8000.
- Provides dynamic search/filter endpoints (proxied by Nginx).

---

## 4. Execution Guide

**Run from Project Root:**

```powershell
.\venv\Scripts\python.exe PythonTools/process_data.py
```

**Install Dependencies:**

```powershell
pip install -r requirements.txt
```
