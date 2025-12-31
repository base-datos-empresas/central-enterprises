import requests
import sys

BASE_URL = "https://central.enterprises"
ENDPOINTS = [
    "/",
    "/api/health",
    "/country/es",
    "/sitemap.xml",
    "/robots.txt"
]

def check_endpoint(url):
    print(f"Checking {url}...")
    try:
        response = requests.get(url, timeout=10)
        status = response.status_code
        print(f"  Status: {status}")
        
        if status == 200:
            # Check for basic SEO/Meta if HTML
            if "text/html" in response.headers.get("Content-Type", ""):
                content = response.text.lower()
                has_title = "<title>" in content
                has_desc = 'name="description"' in content or "name='description'" in content
                print(f"  SEO: {'Title OK' if has_title else 'MISSING Title'}, {'Desc OK' if has_desc else 'MISSING Desc'}")
            
            # Check security headers
            csp = response.headers.get("Content-Security-Policy")
            hsts = response.headers.get("Strict-Transport-Security")
            print(f"  Security: {'HSTS OK' if hsts else 'NO HSTS'}, {'CSP OK' if csp else 'NO CSP'}")
        
        return status == 200
    except Exception as e:
        print(f"  Error: {e}")
        return False

def main():
    print(f"--- STARTING TECHNICAL CHECK FOR {BASE_URL} ---")
    results = []
    for ep in ENDPOINTS:
        results.append(check_endpoint(BASE_URL + ep))
    
    if all(results):
        print("\nSUCCESS: All critical endpoints are reachable.")
    else:
        print("\nWARNING: Some endpoints failed or had issues.")

if __name__ == "__main__":
    main()
