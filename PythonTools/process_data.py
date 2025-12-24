import csv
import os
import sys
import json
import time
import argparse
import tempfile
import shutil
from collections import defaultdict
from datetime import datetime

# --- Configuration ---
# Map source CSV columns to internal keys
# Adjust these based on the actual header of your source CSV
COLUMN_MAPPING = {
    'country_code': 'iso_code',    # Mapped to actual CSV column
    'name': 'country_name',        
    'category': 'main_category',   
    'city': 'city',
    'rating': 'rating'
}

# Defaults if columns are missing
DEFAULTS = {
    'country_code': 'XX',
    'name': 'Unknown',
    'category': 'Uncategorized',
    'city': 'Unknown',
    'rating': 0.0
}

def normalize_row(row, header_map):
    """
    Normalizes a CSV row based on the mapping.
    Returns a dict with standard keys.
    """
    normalized = {}
    for key, csv_col in COLUMN_MAPPING.items():
        val = row.get(csv_col, row.get(key)) # Try mapped name, then key itself
        
        if val is None or val == '':
            val = DEFAULTS.get(key)
            
        # Specific normalizations
        if key == 'country_code':
            val = str(val).lower().strip()[:2]
        elif key == 'rating':
            try:
                val = float(val)
            except (ValueError, TypeError):
                val = 0.0
        elif key == 'city':
            val = str(val).strip().title()
        elif key == 'category':
            val = str(val).strip().title()
            
        normalized[key] = val
        
    # Pass through other useful columns explicitly if needed
    normalized['landing_title'] = row.get('landing_title', '')
    normalized['landing_description'] = row.get('landing_description', '')
    
    return normalized

def atomic_write_csv(filepath, fieldnames, rows):
    """
    Writes a CSV file atomically using a temporary file and rename.
    """
    dir_name = os.path.dirname(filepath)
    if not os.path.exists(dir_name):
        os.makedirs(dir_name, exist_ok=True)
        
    fd, temp_path = tempfile.mkstemp(dir=dir_name, text=True)
    
    try:
        with os.fdopen(fd, 'w', newline='', encoding='utf-8') as f:
            writer = csv.DictWriter(f, fieldnames=fieldnames)
            writer.writeheader()
            writer.writerows(rows)
            
        # Atomic rename
        shutil.move(temp_path, filepath)
        # print(f"Generated: {filepath}")
        
    except Exception as e:
        print(f"Error writing {filepath}: {e}")
        os.remove(temp_path)
        raise

def process_stream(source_path, output_dir, target_countries=None):
    """
    Reads source CSV in streaming mode and aggregates data.
    """
    print(f"Processing source: {source_path}")
    
    # Aggregators
    country_stats = defaultdict(lambda: {
        'count': 0, 
        'total_rating': 0.0, 
        'rated_count': 0,
        'cities': defaultdict(int),
        'categories': defaultdict(int),
        'meta': {} # Store landing title/desc
    })
    
    start_time = time.time()
    processed_rows = 0
    
    with open(source_path, 'r', encoding='utf-8') as f:
        reader = csv.DictReader(f)
        
        # Detect actual columns for mapping (simple auto-detection could go here)
        # For now, we rely on the row.get fallbacks in normalize_row
        
        for row in reader:
            data = normalize_row(row, COLUMN_MAPPING)
            cc = data['country_code']
            
            # Filter if needed
            if target_countries and cc not in target_countries:
                continue
                
            stats = country_stats[cc]
            stats['count'] += 1
            
            if data['rating'] > 0:
                stats['total_rating'] += data['rating']
                stats['rated_count'] += 1
                
            stats['cities'][data['city']] += 1
            stats['categories'][data['category']] += 1
            
            # Keep metadata from the last row (or first) - assuming generally static per country in this specific prompt context
            # In a real company list, companies don't have landing titles.
            # But the prompt implies the source has country data mixed in? 
            # Actually prompt says: "CSV fuente puede tener... name, category... country_code".
            # So it's a list of companies. Where do Landing Title/Desc come from?
            # Likely separate config or we infer. I will preserve what I can find.
            if data['landing_title']:
                stats['meta']['landing_title'] = data['landing_title']
            if data['landing_description']:
                stats['meta']['landing_description'] = data['landing_description']
                
            processed_rows += 1
            if processed_rows % 10000 == 0:
                print(f"Processed {processed_rows} rows...", end='\r')
                
    print(f"\nFinished processing {processed_rows} rows in {time.time() - start_time:.2f}s")
    
    # Generate Outputs
    generate_outputs(country_stats, output_dir)

def generate_outputs(aggregated_data, output_dir):
    """
    Generates the small CSV files for PHP consumption.
    """
    timestamp = datetime.now().isoformat()
    
    for cc, stats in aggregated_data.items():
        if not cc or cc == 'xx': continue # Skip invalid
        
        # 1. Country Stats (1 row)
        avg_rating = 0.0
        if stats['rated_count'] > 0:
            avg_rating = round(stats['total_rating'] / stats['rated_count'], 2)
            
        stats_row = [{
            'country_code': cc,
            'total_companies': stats['count'],
            'avg_rating': avg_rating,
            'top_category': max(stats['categories'], key=stats['categories'].get) if stats['categories'] else 'None',
            'landing_title': stats['meta'].get('landing_title', f"Companies in {cc.upper()}"),
            'landing_description': stats['meta'].get('landing_description', f"Browse {stats['count']} verified companies in {cc.upper()}."),
            'updated_at': timestamp
        }]
        
        atomic_write_csv(
            os.path.join(output_dir, f"country_stats_{cc}.csv"),
            ['country_code', 'total_companies', 'avg_rating', 'top_category', 'landing_title', 'landing_description', 'updated_at'],
            stats_row
        )
        
        # 2. Top Categories (List)
        sorted_cats = sorted(stats['categories'].items(), key=lambda x: x[1], reverse=True)[:50]
        cat_rows = [{'category': c, 'count': n} for c, n in sorted_cats]
        
        atomic_write_csv(
            os.path.join(output_dir, f"country_top_categories_{cc}.csv"),
            ['category', 'count'],
            cat_rows
        )
        
        # 3. Top Cities (Optional)
        sorted_cities = sorted(stats['cities'].items(), key=lambda x: x[1], reverse=True)[:100]
        city_rows = [{'city': c, 'count': n} for c, n in sorted_cities]
        
        atomic_write_csv(
            os.path.join(output_dir, f"country_top_cities_{cc}.csv"),
            ['city', 'count'],
            city_rows
        )

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Process Source CSV into optimized Web CSVs")
    parser.add_argument('--source', required=True, help="Path to massive source CSV")
    parser.add_argument('--out', required=True, help="Directory for output CSVs")
    
    args = parser.parse_args()
    
    if not os.path.exists(args.source):
        print(f"Error: Source file {args.source} not found.")
        sys.exit(1)
        
    process_stream(args.source, args.out)
