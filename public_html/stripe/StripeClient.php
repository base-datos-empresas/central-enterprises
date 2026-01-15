<?php
require_once __DIR__ . '/config.php';

class StripeClient
{
    private $secretKey;

    public function __construct()
    {
        $this->secretKey = STRIPE_SECRET_KEY;
    }

    public function post($endpoint, $data)
    {
        $ch = curl_init('https://api.stripe.com/v1/' . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->secretKey . ':');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = json_decode($response, true);

        if ($httpCode >= 400) {
            throw new Exception("Stripe API Error: " . ($json['error']['message'] ?? 'Unknown error'));
        }

        return $json;
    }

    public function verifyWebhookSignature($payload, $sigHeader, $secret)
    {
        $timestamp = null;
        $signatures = [];

        $items = explode(',', $sigHeader);
        foreach ($items as $item) {
            $parts = explode('=', $item, 2);
            if (count($parts) != 2)
                continue;
            if (trim($parts[0]) == 't')
                $timestamp = trim($parts[1]);
            if (trim($parts[0]) == 'v1')
                $signatures[] = trim($parts[1]);
        }

        if (!$timestamp)
            return false;

        // Check timestamp freshness (tolerate 5 mins)
        if (abs(time() - $timestamp) > 300)
            return false;

        $signedPayload = "{$timestamp}.{$payload}";
        $expectedSignature = hash_hmac('sha256', $signedPayload, $secret);

        return in_array($expectedSignature, $signatures);
    }
}
?>