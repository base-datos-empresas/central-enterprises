import os
import requests
import time

# User provided keys
SECRET_KEY = "sk_live_..."

HEADERS = {
    "Authorization": f"Bearer {SECRET_KEY}",
    "Content-Type": "application/x-www-form-urlencoded"
}

# Pricing Data (Mirrors PricingConfig.php)
# Country Codes & Base Prices
MASTER_PRICES = {
    'US': 1290, 'GB': 990, 'DE': 990, 'CH': 990, 'NO': 990,
    'FR': 790, 'ES': 790, 'BR': 790, 'IT': 590, 'CA': 590,
    'AU': 590, 'NL': 590, 'BE': 490, 'PL': 490, 'ID': 390,
    'PT': 290, 'RO': 290, 'AT': 290, 'MY': 290, 'IE': 290,
    'LT': 190
}
DEFAULT_PRICE = 590

GLOBAL_PLANS = {
    'agency_global': {'name': 'Agency Global License', 'amount': 3900, 'interval': 'year'},
    'enterprise_base': {'name': 'Enterprise Base', 'amount': 14000, 'interval': 'year'},
    'enterprise_plus': {'name': 'Enterprise Plus', 'amount': 18000, 'interval': 'year'},
    'enterprise_ultra': {'name': 'Enterprise Ultra', 'amount': 25000, 'interval': 'year'}
}

def create_product(name):
    print(f"Creating Product: {name}")
    resp = requests.post("https://api.stripe.com/v1/products", headers=HEADERS, data={
        "name": name
    })
    if resp.status_code == 200:
        return resp.json()['id']
    else:
        print(f"Error creating product {name}: {resp.text}")
        return None

def create_price(product_id, amount_eur, interval=None, nickname=None):
    # Stripe expects amount in cents
    amount_cents = int(amount_eur * 100)
    data = {
        "product": product_id,
        "unit_amount": amount_cents,
        "currency": "eur"
    }
    if interval:
        data["recurring[interval]"] = interval
        
    if nickname:
        data["nickname"] = nickname

    resp = requests.post("https://api.stripe.com/v1/prices", headers=HEADERS, data=data)
    if resp.status_code == 200:
        return resp.json()['id']
    else:
        print(f"Error creating price: {resp.text}")
        return None

def main():
    print("--- STARTING STRIPE SEEDING ---")
    results = {}

    # 1. Global Plans
    print("\n--- GLOBAL PLANS ---")
    for key, plan in GLOBAL_PLANS.items():
        prod_id = create_product(plan['name'])
        if prod_id:
            price_id = create_price(prod_id, plan['amount'], plan['interval'], key)
            results[key] = price_id
            print(f"OK: {key} => {price_id}")

    # 2. Country Plans (PRO)
    print("\n--- COUNTRY PLANS (PRO) ---")
    # Base Generic Product for Pro
    # Actually, let's make unique products for cleaner invoices "Pro License - Spain"
    for iso, price in MASTER_PRICES.items():
        name = f"Pro Country License - {iso}"
        prod_id = create_product(name)
        if prod_id:
            key = f"pro_{iso.lower()}"
            price_id = create_price(prod_id, price, "year", key)
            results[key] = price_id
            print(f"OK: {key} => {price_id}")

    # 3. Country Plans (Starter)
    print("\n--- COUNTRY PLANS (STARTER) ---")
    for iso, price in MASTER_PRICES.items():
        name = f"Starter License (90D) - {iso}"
        prod_id = create_product(name)
        if prod_id:
            # Starter is One Time
            starter_price = round(price / 3, 2)
            key = f"starter_{iso.lower()}"
            price_id = create_price(prod_id, starter_price, None, key) # Non-recurring
            results[key] = price_id
            print(f"OK: {key} => {price_id}")

    print("\n\n--- CONFIG PHP ARRAY ---")
    print("define('STRIPE_PRICES', [")
    for k, v in results.items():
        print(f"    '{k}' => '{v}',")
    print("]);")

if __name__ == "__main__":
    main()
