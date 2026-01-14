import os
import shutil
import json

def sync_metadata():
    project_root = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    outputs_dir = os.path.join(project_root, 'Outputs')
    dest_dir = os.path.join(project_root, 'public_html', 'data', 'metadata_index')

    if not os.path.exists(dest_dir):
        os.makedirs(dest_dir)

    print(f"Scanning {outputs_dir}...")

    count = 0
    # Walk through Outputs directory
    for country_name in os.listdir(outputs_dir):
        country_path = os.path.join(outputs_dir, country_name)
        if not os.path.isdir(country_path):
            continue

        # Look for the OpenData folder content
        opendata_folder = f"{country_name}-OpenData"
        opendata_path = os.path.join(country_path, opendata_folder)
        metadata_file = os.path.join(opendata_path, 'METADATA.json')

        if os.path.exists(metadata_file):
            # Target path: public_html/data/metadata_index/{Country}/METADATA.json
            target_country_dir = os.path.join(dest_dir, country_name)
            if not os.path.exists(target_country_dir):
                os.makedirs(target_country_dir)
            
            target_file = os.path.join(target_country_dir, 'METADATA.json')
            shutil.copy2(metadata_file, target_file)
            print(f"Synced: {country_name} -> {target_file}")
            count += 1
    
    print(f"Sync complete. {count} metadata files copied to public_html/data/metadata_index/.")

if __name__ == "__main__":
    sync_metadata()
