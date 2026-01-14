---
description: How to update country datasets and manifests
---

1. Verify that new data outputs are present in the `Outputs/` directory.
   - For each country, expect: `Outputs/{Country}/{Country}-OpenData/METADATA.json`

2. Update the `data/digital_library.json` manifest with the new metrics and links.
   - Ensure the `_metadata.last_update` timestamp is updated.

3. Update the sitemap to reflect any newly added jurisdictions.

```powershell
.\venv\Scripts\python.exe PythonTools/sitemap_generator.py
```

1. Verify that `country/index.php` correctly resolves the new data by testing a sample URL.
   - Example: `/country/new-jurisdiction-business-databases-b2b`
