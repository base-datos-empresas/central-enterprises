<?php
// CENTRAL.ENTERPRISES SECURITY HEADERS
// Enforced at application level for environments where Nginx config is immutable.

// Prevent Clickjacking
header('X-Frame-Options: SAMEORIGIN');

// XSS Protection
header('X-XSS-Protection: 1; mode=block');

// Prevent MIME Sniffing
header('X-Content-Type-Options: nosniff');

// Referrer Policy
header('Referrer-Policy: strict-origin-when-cross-origin');

// Strict Transport Security (HSTS) - 1 year
header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

// Basic Content Security Policy (CSP)
// Allows Google Fonts, GTM, GA4, and local assets.
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https://www.googletagmanager.com; connect-src 'self' https://www.google-analytics.com https://analytics.google.com; frame-src 'self';");
?>
