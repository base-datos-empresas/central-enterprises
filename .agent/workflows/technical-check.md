---
description: Pre-flight technical health check
---

// turbo

1. Run the project's technical diagnostic script.

```powershell
.\venv\Scripts\python.exe PythonTools/technical_check.py
```

1. Verify PHP syntax on all public_html files to avoid production crashes.

```powershell
Get-ChildItem -Path public_html -Filter *.php -Recurse | ForEach-Object { php -l $_.FullName }
```

1. Check for any missing deployment keys.
   - Path check: `Server_Config/Oracle-key-privada.key`
