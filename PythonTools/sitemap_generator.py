import json
import os
from datetime import datetime

def generate_sitemap():
    base_url = "https://central.enterprises"
    library_path = r"c:\Users\MASTER\Desktop\Centra-data\central-enterprises\data\digital_library.json"
    output_path = r"c:\Users\MASTER\Desktop\Centra-data\central-enterprises\public_html\sitemap.xml"
    
    if not os.path.exists(library_path):
        print(f"Error: {library_path} not found.")
        return

    with open(library_path, 'r', encoding='utf-8') as f:
        data = json.load(f)

    countries = [k for k in data.keys() if k != "_metadata"]
    
    sitemap_content = []
    sitemap_content.append('<?xml version="1.0" encoding="UTF-8"?>')
    sitemap_content.append('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">')
    
    # Static Pages
    static_pages = [
        "/",
        "/data/",
        "/pro/",
        "/standard/",
        "/foundation/",
        "/about/",
        "/contact/"
    ]
    
    now = datetime.now().strftime("%Y-%m-%d")
    
    for page in static_pages:
        sitemap_content.append(f"  <url>")
        sitemap_content.append(f"    <loc>{base_url}{page}</loc>")
        sitemap_content.append(f"    <lastmod>{now}</lastmod>")
        sitemap_content.append(f"    <changefreq>daily</changefreq>")
        sitemap_content.append(f"    <priority>1.0</priority>")
        sitemap_content.append(f"  </url>")
    
    # Dynamic Country Pages
    for country in countries:
        slug = country.lower().replace(" ", "-") # Simplified to just country-name
        sitemap_content.append(f"  <url>")
        sitemap_content.append(f"    <loc>{base_url}/country/{slug}</loc>")
        sitemap_content.append(f"    <lastmod>{now}</lastmod>")
        sitemap_content.append(f"    <changefreq>weekly</changefreq>")
        sitemap_content.append(f"    <priority>0.8</priority>")
        sitemap_content.append(f"  </url>")
    
    sitemap_content.append('</urlset>')
    
    with open(output_path, 'w', encoding='utf-8') as f:
        f.write('\n'.join(sitemap_content))
    
    print(f"Sitemap generated successfully at {output_path}")

if __name__ == "__main__":
    generate_sitemap()
