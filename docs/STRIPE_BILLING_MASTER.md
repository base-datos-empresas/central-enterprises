# Stripe Billing Master Documentation

**Version:** 1.0  
**Last Updated:** 2026-01-15  
**System:** Central.Enterprises SaaS Core

---

## 1. System Overview

The Stripe Billing integration is a **headless, event-driven** system. The backend does not maintain complex billing logic; it strictly obeys Stripe Webhooks. Content access is controlled by a local SQLite database that mirrors the subscription status from Stripe.

### Core Philosophy
>
> "Stripe sends the invoice. Stripe retries failures. Stripe calculates tax. The Backend simple unlocks the door when Stripe says 'PAID'."

---

## 2. Architecture & Files

| Component | File Path | Purpose |
| :--- | :--- | :--- |
| **Configuration** | `public_html/stripe/config.php` | API Keys, Secrets, and Price ID Mapping. |
| **API Wrapper** | `public_html/stripe/StripeClient.php` | Lightweight cURL wrapper (No Composer). |
| **Checkout** | `public_html/stripe/create-checkout-session.php` | Generates Stripe Hosted Payment Page URLs. |
| **Webhook** | `public_html/stripe/webhook.php` | Listens for events and updates DB. |
| **Database** | `data/subscriptions.sqlite` | Stores user status (`stripe_customer_id`, `status`). |
| **DB Helper** | `public_html/includes/db.php` | Handles connection and auto-migrations. |

---

## 3. Configuration

**Critical Step**: You must configure the keys in `public_html/stripe/config.php` for the system to function.

```php
define('STRIPE_SECRET_KEY', 'sk_live_...');     // Found in Stripe Dashboard > Developers > API Keys
define('STRIPE_PUBLISHABLE_KEY', 'pk_live_...'); 
define('STRIPE_WEBHOOK_SECRET', 'whsec_...');   // Found in Stripe Dashboard > Developers > Webhooks
```

### Price Mapping

Map internal product keys to Stripe Price IDs (created in Stripe Product Catalog).

```php
define('STRIPE_PRICES', [
    'agency_global_year' => 'price_1Q5...', 
    'pro_country_year'   => 'price_1Q6...',
]);
```

---

## 4. Lifecycle & Webhooks

The system listens for specific events to transition user states.

| Event | Status Update | Description |
| :--- | :--- | :--- |
| `checkout.session.completed` | **ACTIVE** | New subscription started. User created in DB. |
| `invoice.paid` | **ACTIVE** | Renewal successful. Validity extended. |
| `invoice.payment_failed` | **BLOCKED** | Payment failed. Access revoked immediately. |
| `customer.subscription.deleted` | **CANCELED** | User canceled or max retries reached. |
| `charge.refunded` | **BLOCKED** | Dispute or manual refund. Instant blocking. |

**Database Schema:**

```sql
CREATE TABLE subscriptions (
    id INTEGER PRIMARY KEY,
    stripe_customer_id TEXT,
    stripe_subscription_id TEXT,
    stripe_price_id TEXT,
    status TEXT, -- 'active', 'blocked', 'canceled', 'past_due'
    current_period_end INTEGER,
    invoice_url TEXT,
    created_at DATETIME
);
```

---

## 5. Deployment & Permissions

For the SQLite database to be writable by the webhook (which runs as `www-data`), directory permissions must be correct.

**Deploy Script (`deploy_prod.ps1`) Rule:**

```powershell
"sudo find public_html data bases -type d -exec chmod 775 {} \;" +
"sudo find public_html data bases -type f -exec chmod 664 {} \;"
```

*Ensures `www-data` group has Write (w) access.*

---

## 6. Frontend Integration

### "Pay Now" Flow

Frontend buttons utilize a generic JS handler to fetch a checkout session.

```html
<a href="javascript:void(0)" 
   class="stripe-checkout-btn"
   data-price-id="price_123...">
   Subscribe Now
</a>

<script>
// Fetches session from /stripe/create-checkout-session.php
// Redirects to Stripe URL
</script>
```

### Content Unlocking

Premium content is unlocked via PHP Session check.

**File:** `public_html/country/index.php`

```php
<?php 
$isPremium = isset($_SESSION['premium_active']) && $_SESSION['premium_active']; 
?>
<?php if ($isPremium): ?>
   <!-- Show Download Links -->
<?php else: ?>
   <!-- Show Sales Card -->
<?php endif; ?>
```

*Note: In a full-auth system, `$_SESSION['premium_active']` involves verifying the user login against the `subscriptions` database.*

---

## 7. Testing

### Using Stripe CLI

1. **Install CLI**: `brew install stripe/stripe-cli/stripe` (or Windows equivalent).
2. **Login**: `stripe login`.
3. **Forward Webhooks**:

   ```bash
   stripe listen --forward-to localhost:8000/stripe/webhook.php
   ```

4. **Trigger Events**:

   ```bash
   stripe trigger checkout.session.completed
   stripe trigger invoice.payment_failed
   ```

---
