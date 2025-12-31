import os

# Files to fix
PHP_FILES = [
    'public_html/pro.php',
    'public_html/catalog.php',
    'public_html/donations.php',
    'public_html/updates.php',
    'public_html/methodology.php',
    'public_html/status.php',
    'public_html/pro-license.php',
    'public_html/includes/foundation_banner.php'
]

# Mapping of mangled sequences to correct characters (best guess based on context)
MAPPING = {
    '­ƒôä': '📄',
    '­ƒôè': '📊',
    '­ƒôª': '📦',
    '­ƒù£´©Å': '🗜️',
    'ônàÉ': '⬅️',
    'ÔåÉ': '⬅️',
    'Ôåæ': '⬆️',
    'Ô¼ç´©Å': '🔍'
}

def fix_file(path):
    if not os.path.exists(path):
        return
    
    with open(path, 'rb') as f:
        content = f.read()
    
    # Remove BOM if exists
    if content.startswith(b'\xef\xbb\xbf'):
        content = content[3:]
    
    # Try to decode from UTF-8 (since Out-File -Encoding utf8 was used)
    try:
        text = content.decode('utf-8')
    except UnicodeDecodeError:
        # Fallback to latin-1 if utf-8 fails
        text = content.decode('latin-1')
        
    # Fix icons
    for mangled, fixed in MAPPING.items():
        text = text.replace(mangled, fixed)
        
    # Standardize assets paths in these files too (from assets/ to /assets/)
    text = text.replace('href="assets/', 'href="/assets/')
    text = text.replace('src="assets/', 'src="/assets/')
    text = text.replace('href="styles/', 'href="/styles/')
    
    # Write back as clean UTF-8 without BOM
    with open(path, 'w', encoding='utf-8', newline='\n') as f:
        f.write(text)
    print(f"Fixed: {path}")

if __name__ == "__main__":
    for f in PHP_FILES:
        fix_file(f)
