<?php
// STRIPE CONFIGURATION
// -------------------------------------------------------------------
// Fill with your actual keys from Stripe Dashboard

define('STRIPE_SECRET_KEY', 'sk_test_replace_me_with_your_secret_key');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_replace_me_with_your_publishable_key');
define('STRIPE_WEBHOOK_SECRET', 'whsec_replace_me_with_your_webhook_secret');

// Currency Configuration
define('STRIPE_CURRENCY', 'eur');

// Database Configuration (SQLite)
define('DB_PATH', __DIR__ . '/../../data/subscriptions.sqlite');

// Product/Price Mapping (Internal ID => Stripe Price ID)
// FILL THIS: Create these prices in Stripe Dashboard > Product Catalog
define('STRIPE_PRICES', [
    'agency_global_year' => 'price_1234567890',
    'pro_country_year' => 'price_0987654321', // Create one per country or use metadata?
    // Using a generic price and logic is harder with Billing, best to have specific prices.
    // For this implementation, we will assume a generic 'pro_standard' price for simplicity
    // and let the user update it.
    'default_pro' => 'price_REPLACE_WITH_REAL_ID'
]);
?>