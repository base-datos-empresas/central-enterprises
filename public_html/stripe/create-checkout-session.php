<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/StripeClient.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('InvalidRequestMethod');
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $priceId = $input['priceId'] ?? STRIPE_PRICES['default_pro'];
    $mode = $input['mode'] ?? 'subscription'; // subscription or payment
    $successUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/pro/success.php?session_id={CHECKOUT_SESSION_ID}';
    $cancelUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/pro/cancel.php';

    $stripe = new StripeClient();

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
        // 'customer_email' => $input['email'], // Optional: prefill if you have it
    ];

    $session = $stripe->post('checkout/sessions', $sessionConfig);

    echo json_encode(['id' => $session['id'], 'url' => $session['url']]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>