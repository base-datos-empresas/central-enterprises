<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/StripeClient.php';
require_once __DIR__ . '/../includes/db.php';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

$client = new StripeClient();

if (!$client->verifyWebhookSignature($payload, $sig_header, STRIPE_WEBHOOK_SECRET)) {
    http_response_code(400);
    exit('Invalid signature');
}

$event = json_decode($payload, true);
$pdo = DB::connect();

try {
    switch ($event['type']) {
        case 'checkout.session.completed':
            $session = $event['data']['object'];
            $custId = $session['customer'];
            $subId = $session['subscription'] ?? null;

            // Upsert subscription
            $stmt = $pdo->prepare("INSERT INTO subscriptions (stripe_customer_id, stripe_subscription_id, status, created_at) VALUES (?, ?, 'active', CURRENT_TIMESTAMP)");
            $stmt->execute([$custId, $subId]);
            break;

        case 'invoice.paid':
            $invoice = $event['data']['object'];
            $subId = $invoice['subscription'];
            $pdfUrl = $invoice['hosted_invoice_url'];

            // Maintain Active
            $stmt = $pdo->prepare("UPDATE subscriptions SET status = 'active', invoice_url = ? WHERE stripe_subscription_id = ?");
            $stmt->execute([$pdfUrl, $subId]);
            break;

        case 'invoice.payment_failed':
            $invoice = $event['data']['object'];
            $subId = $invoice['subscription'];

            // STRICT BLOCKING as requested
            $stmt = $pdo->prepare("UPDATE subscriptions SET status = 'blocked' WHERE stripe_subscription_id = ?");
            $stmt->execute([$subId]);
            break;

        case 'customer.subscription.deleted':
            $sub = $event['data']['object'];
            $subId = $sub['id'];

            $stmt = $pdo->prepare("UPDATE subscriptions SET status = 'canceled' WHERE stripe_subscription_id = ?");
            $stmt->execute([$subId]);
            break;

        case 'charge.refunded':
            $charge = $event['data']['object'];
            $custId = $charge['customer'];

            // STRICT BLOCKING on refund
            $stmt = $pdo->prepare("UPDATE subscriptions SET status = 'blocked' WHERE stripe_customer_id = ?");
            $stmt->execute([$custId]);
            break;

        default:
            http_response_code(200);
            exit();
    }
} catch (Exception $e) {
    http_response_code(500);
    exit('Webhook Error: ' . $e->getMessage());
}

http_response_code(200);
?>