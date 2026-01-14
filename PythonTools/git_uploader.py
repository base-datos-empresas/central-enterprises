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

def verify_consistency(project_root):
    """Performs pre-push checks."""
    print("\n[*] Running Consistency Verification...")
    
    # 1. Check PHP Syntax
    print(" - Checking PHP Syntax...")
    try:
        # Check specific critical files or everything in public_html
        crit_files = ["public_html/index.php", "public_html/country/index.php", "public_html/data/index.php"]
        for f in crit_files:
            path = os.path.join(project_root, f)
            if os.path.exists(path):
                subprocess.run(f"php -l {path}", shell=True, check=True, capture_output=True)
    except subprocess.CalledProcessError as e:
        print(f"CRITICAL ERROR: PHP Syntax error found in {f}!")
        print(e.stderr.decode())
        return False

    # 2. Check Sitemap Freshness
    print(" - Checking Sitemap Status...")
    sitemap_path = os.path.join(project_root, "public_html", "sitemap.xml")
    if os.path.exists(sitemap_path):
        mtime = os.path.getmtime(sitemap_path)
        from datetime import datetime, timedelta
        if datetime.fromtimestamp(mtime) < datetime.now() - timedelta(hours=24):
            print("WARNING: sitemap.xml is more than 24 hours old. Please run sitemap_generator.py.")
    
    return True

def main():
    print("--- Oracle Git Uploader ---")
    
    # Project root is one level up from PythonTools
    project_root = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    
    # 0. Consistency Check
    if not verify_consistency(project_root):
        print("\nABORTING: Consistency checks failed. Fix the errors before pushing.")
        sys.exit(1)

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
        print("\nFAILURE: Push failed. Since the repository is PRIVATE, you must authenticate.")
        print("\n--- HOW TO FIX ---")
        print("1. Generate a 'Fine-grained personal access token' on GitHub (Settings > Developer settings > Personal access tokens).")
        print("2. Run the following command with your token:")
        print("   git remote set-url origin https://<TOKEN>@github.com/base-datos-empresas/central-enterprises.git")
        print("3. Then run this script again.")
        print("\nAlternatively, use the browser window I've kept open to manually upload or manage settings.")

if __name__ == "__main__":
    main()
