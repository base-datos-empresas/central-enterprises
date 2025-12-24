import subprocess
import os
import sys

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
    print("--- Oracle Git Uploader ---")
    
    # Project root is one level up from PythonTools
    project_root = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    
    # 1. Check git status
    print("\n[1/4] Checking Git status...")
    status = run_command("git status --short", cwd=project_root)
    if status == "":
        print("No changes to commit.")
    else:
        print("Changes detected:")
        print(status)
    
    # 2. Add and Commit
    if len(sys.argv) > 1:
        commit_msg = sys.argv[1]
    else:
        commit_msg = "Update project"
        
    print(f"\n[2/4] Staging and committing with message: '{commit_msg}'...")
    run_command("git add .", cwd=project_root)
    run_command(f'git commit -m "{commit_msg}"', cwd=project_root)
    
    # 3. Handle Authentication (Optional but helpful for private repos)
    print("\n[3/4] Checking remote configuration...")
    remotes = run_command("git remote -v", cwd=project_root)
    print(remotes)
    
    # 4. Push
    print("\n[4/4] Attempting to push to remote...")
    print("Note: If the repo is private, you may be prompted for credentials if not using SSH or a cached token.")
    
    push_result = subprocess.run("git push -u origin main", shell=True, cwd=project_root)
    
    if push_result.returncode == 0:
        print("\nSUCCESS: Project uploaded successfully to GitHub!")
    else:
        print("\nFAILURE: Push failed. See details above.")
        print("\nTIP: If you are hitting 'Repository not found', it might be an authentication issue.")
        print("Try setting your GitHub Personal Access Token (PAT):")
        print("git remote set-url origin https://<YOUR_TOKEN>@github.com/base-datos-empresas/central-enterprises.git")

if __name__ == "__main__":
    main()
