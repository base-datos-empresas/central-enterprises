import os
import glob
from datetime import datetime

# Configuration
OUTPUT_DIR = os.path.join(os.path.dirname(__file__), '../data/outputs')
PUBLIC_HTML = os.path.join(os.path.dirname(__file__), '../public_html')
BASE_URL = "https://central.enterprises" # Configure base URL

def generate_sitemap():
    print(f"Scanning {OUTPUT_DIR} for country stats...")
    
    urls = []
    
    # Find all country_stats_{code}.csv
    files = glob.glob(os.path.join(OUTPUT_DIR, 'country_stats_*.csv'))
    
    for f in files:
        basename = os.path.basename(f)
        # Extract code: country_stats_es.csv -> es
        code = basename.replace('country_stats_', '').replace('.csv', '')
        
        # In a real CSV reader we would get updated_at, but file mtime is a good proxy for file-system generation
        lastmod = datetime.fromtimestamp(os.path.getmtime(f)).strftime('%Y-%m-%d')
        
        loc = f"{BASE_URL}/country/{code}"
        urls.append((loc, lastmod))
        
    # Build XML
    xml = ['<?xml version="1.0" encoding="UTF-8"?>']
    xml.append('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">')
    
    for loc, lastmod in urls:
        xml.append('  <url>')
        xml.append(f'    <loc>{loc}</loc>')
        xml.append(f'    <lastmod>{lastmod}</lastmod>')
        xml.append('    <changefreq>daily</changefreq>')
        xml.append('  </url>')
        
    xml.append('</urlset>')
    
    # Write to public_html
    sitemap_path = os.path.join(PUBLIC_HTML, 'sitemap.xml')
    with open(sitemap_path, 'w') as f:
        f.write('\n'.join(xml))
        
    print(f"Generated sitemap with {len(urls)} URLs at {sitemap_path}")

if __name__ == "__main__":
    generate_sitemap()
