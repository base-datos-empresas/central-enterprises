import shutil
import os
import datetime
import glob

# Config
DB_PATH = "/opt/centralui/data/subscriptions.sqlite"
BACKUP_DIR = "/opt/centralui/data/backups"
MAX_BACKUPS = 30  # Keep 30 days history

def backup_database():
    if not os.path.exists(DB_PATH):
        print(f"Database not found at {DB_PATH}. Skipping backup.")
        return

    if not os.path.exists(BACKUP_DIR):
        os.makedirs(BACKUP_DIR)
        print(f"Created backup directory at {BACKUP_DIR}")

    # Create timestamped filename
    timestamp = datetime.datetime.now().strftime("%Y-%m-%d_%H%M%S")
    backup_path = os.path.join(BACKUP_DIR, f"subscriptions_{timestamp}.sqlite")

    try:
        shutil.copy2(DB_PATH, backup_path)
        print(f"SUCCESS: Database backed up to {backup_path}")
    except Exception as e:
        print(f"ERROR: Failed to backup database: {str(e)}")
        return

    # Cleanup old backups
    cleanup_old_backups()

def cleanup_old_backups():
    files = glob.glob(os.path.join(BACKUP_DIR, "subscriptions_*.sqlite"))
    files.sort(key=os.path.getmtime)

    if len(files) > MAX_BACKUPS:
        to_delete = files[:-MAX_BACKUPS]
        for f in to_delete:
            try:
                os.remove(f)
                print(f"Removed old backup: {f}")
            except OSError as e:
                print(f"Error deleting {f}: {e}")

if __name__ == "__main__":
    print("--- Starting Daily Database Backup ---")
    backup_database()
