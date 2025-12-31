import requests
import sys

# Note: Without an API key, performance might be slower or rate-limited.
# If the user has one, it should be in .env but we'll try without first or use a placeholder.
API_KEY = "" 
BASE_URL = "https://central.enterprises"

def get_pagespeed_report(url, strategy='desktop'):
    print(f"Fetching PageSpeed report for {url} ({strategy})...")
    api_url = f"https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={url}&strategy={strategy}"
    if API_KEY:
        api_url += f"&key={API_KEY}"
    
    try:
        response = requests.get(api_url, timeout=30)
        if response.status_code != 200:
            print(f"  Error: {response.status_code} - {response.text}")
            return None
        
        data = response.json()
        categories = data.get('lighthouseResult', {}).get('categories', {})
        
        report = {
            'Performance': categories.get('performance', {}).get('score', 0) * 100,
            'Accessibility': categories.get('accessibility', {}).get('score', 0) * 100,
            'Best Practices': categories.get('best-practices', {}).get('score', 0) * 100,
            'SEO': categories.get('seo', {}).get('score', 0) * 100,
        }
        return report
    except Exception as e:
        print(f"  Error: {e}")
        return None

def main():
    print(f"--- STARTING PAGESPEED CHECK FOR {BASE_URL} ---")
    
    desktop_report = get_pagespeed_report(BASE_URL, 'desktop')
    if desktop_report:
        print("\nDESKTOP RESULTS:")
        for cat, score in desktop_report.items():
            print(f"  {cat}: {score:.0f}/100")
            
    mobile_report = get_pagespeed_report(BASE_URL, 'mobile')
    if mobile_report:
        print("\nMOBILE RESULTS:")
        for cat, score in mobile_report.items():
            print(f"  {cat}: {score:.0f}/100")

if __name__ == "__main__":
    main()
