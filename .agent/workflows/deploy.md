---
description: How to deploy changes to production (Git and Oracle)
---

// turbo

1. Run the consistency check to ensure no syntax errors and sitemap is fresh.

```powershell
.\venv\Scripts\python.exe PythonTools/git_uploader.py --check-only
```

1. Generate the updated sitemap (if changes affect landing pages).

```powershell
.\venv\Scripts\python.exe PythonTools/sitemap_generator.py
```

1. Commit and push changes to GitHub using the standardized tool.

```powershell
.\venv\Scripts\python.exe PythonTools/git_uploader.py "Brief description of changes"
```

1. Deploy to the Oracle Cloud production server.

```powershell
powershell -ExecutionPolicy Bypass -File deployment/deploy_prod.ps1
```

1. Verify the live site status.

```powershell
curl.exe -I https://central.enterprises
```
