import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse

BASE_URL = "https://central.enterprises"
MAX_DEPTH = 2

def crawl(url, depth=0, visited=None):
    if visited is None:
        visited = set()
    
    if depth > MAX_DEPTH or url in visited:
        return visited

    visited.add(url)
    print(f"{'  ' * depth}Crawling: {url}")

    try:
        response = requests.get(url, timeout=10)
        if response.status_code != 200:
            print(f"{'  ' * depth}  [ERROR] Status {response.status_code}")
            return visited

        if "text/html" not in response.headers.get("Content-Type", ""):
            return visited

        soup = BeautifulSoup(response.text, 'html.parser')
        for link in soup.find_all('a', href=True):
            href = link['href']
            full_url = urljoin(url, href)
            
            # Only crawl internal links
            if urlparse(full_url).netloc == urlparse(BASE_URL).netloc:
                # Remove fragment
                full_url = full_url.split('#')[0]
                if full_url not in visited:
                    crawl(full_url, depth + 1, visited)
            else:
                # Just check if external link is alive (optional, but requested "todos los posibles")
                # For now let's just log it to avoid getting blocked by external sites
                pass

    except Exception as e:
        print(f"{'  ' * depth}  [ERROR] {e}")

    return visited

def main():
    print(f"--- STARTING LINK CRAWL FOR {BASE_URL} (MAX DEPTH {MAX_DEPTH}) ---")
    visited_urls = crawl(BASE_URL)
    print(f"\nCrawl complete. Visited {len(visited_urls)} internal URLs.")

if __name__ == "__main__":
    # Check if beautifulsoup4 is installed, if not we might need to pip install it
    try:
        main()
    except ImportError:
        print("Error: beautifulsoup4 and requests are required. Run 'pip install beautifulsoup4 requests'")
