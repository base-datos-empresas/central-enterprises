# Git Operations Guide (For Agents)

This project uses a private Git repository and a Python automation script for deployments.

## Repository Information

- **URL**: `https://github.com/base-datos-empresas/central-enterprises`
- **Visibility**: Private

## Automation Tool: `git_uploader.py`

A script is provided to simplify commits and pushes, managing the complexity of the private repository and authentication.

- **Location**: `PythonTools/git_uploader.py`
- **Interpreter**: Use the project's virtual environment.

### Usage

To push changes, run the following command from the project root:

```powershell
.\venv\Scripts\python.exe PythonTools/git_uploader.py "Your commit message"
```

## Authentication

The local repository is configured with a Personal Access Token (PAT) for HTTPS access.
If authentication fails (403 or 401 error):

1. Verify the PAT permissions on GitHub (must have **Read and Write** for **Contents**).
2. The remote URL might need to be refreshed:
    `git remote set-url origin https://<TOKEN>@github.com/base-datos-empresas/central-enterprises.git`

## Security Note

- **Keep it Private**: Do not change the repository visibility to public unless explicitly requested by the USER.
- **Ignore Sensitive Files**: Always ensure `.env` and other secret files remain in `.gitignore`.
