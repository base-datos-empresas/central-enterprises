<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/StripeClient.php';

$priceId = $_GET['price_id'] ?? null;

if (!$priceId) {
    die("Error: No pricing plan selected.");
}

// Determine Mode (payment vs subscription)
// If priceId corresponds to 'starter' (one-time), it's payment.
$mode = 'subscription';
$key = array_search($priceId, STRIPE_PRICES);
if ($key && strpos($key, 'starter') !== false) {
    $mode = 'payment'; // One-time payment
}

try {
    $stripe = new StripeClient();
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $successUrl = $protocol . '://' . $host . '/pro/success.php?session_id={CHECKOUT_SESSION_ID}';
    $cancelUrl = $protocol . '://' . $host . '/pro/cancel.php';

    $sessionConfig = [
        'mode' => $mode,
        'line_items' => [
            [
                'price' => $priceId,
                'quantity' => 1,
            ]
        ],
        'success_url' => $successUrl,
        'cancel_url' => $cancelUrl,
        'automatic_tax' => ['enabled' => true],
    ];

    $session = $stripe->post('checkout/sessions', $sessionConfig);

    // Redirect
    if (isset($session['url'])) {
        header("Location: " . $session['url']);
        exit;
    } else {
        throw new Exception("Stripe API did not return a session URL. Response: " . json_encode($session));
    }

} catch (Exception $e) {
    http_response_code(500);
    die("Billing Error: " . $e->getMessage());
}
