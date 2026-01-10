import subprocess
import sys
import re

def run_command(command, cwd=None):
    """Runs a shell command and returns the output."""
    try:
        result = subprocess.run(command, shell=True, check=True, capture_output=True, text=True, cwd=cwd)
        return result.stdout.strip()
    except subprocess.CalledProcessError as e:
        print(f"Error running command: {command}")
        print(f"Stdout: {e.stdout}")
        print(f"Stderr: {e.stderr}")
        return None

def main():
    print("--- Git Auth Fixer ---")
    
    # 1. Get Token
    if len(sys.argv) > 1:
        token = sys.argv[1]
    else:
        print("Usage: python fix_git_auth.py <YOUR_NEW_PAT_TOKEN>")
        print("Please provide the token as an argument.")
        sys.exit(1)
        
    project_root = "." # Assumption: run from root or handle paths carefully
    
    # Verify we are in a git repo
    remotes = run_command("git remote -v", cwd=project_root)
    if not remotes:
        print("Error: Not a git repository or no remotes found.")
        sys.exit(1)
        
    print("Current remotes:")
    print(remotes)
    
    # 2. Construct new URL
    # Hardcoded repo URL base for safety/convenience as per project knowledge
    repo_url = "github.com/base-datos-empresas/central-enterprises.git"
    new_remote_url = f"https://{token}@{repo_url}"
    
    # 3. Update Remote
    print(f"\nUpdating origin to use new token...")
    run_command(f"git remote set-url origin {new_remote_url}", cwd=project_root)
    
    # 4. Verify
    print("\nVerifying connection (git fetch)...")
    fetch_result = run_command("git fetch", cwd=project_root)
    
    if fetch_result is not None:
        print("\nSUCCESS! Authentication fixed.")
        print("You can now run 'python PythonTools/git_uploader.py' to push your changes.")
    else:
        print("\nFAILURE: Still cannot fetch. Please check if the token has 'contents: read/write' permissions.")

if __name__ == "__main__":
    main()
