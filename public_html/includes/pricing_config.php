<?php
/**
 * MASTER PRICING CONFIGURATION v2.0
 * Source of Truth for SaaS Licensing
 */

class PricingConfig
{

    // Base Annual Price for "Pro Country" Plan
    // All other prices are derived from this base.
    private static $masterPriceTable = [
        'US' => 1290, // USA
        'GB' => 990,  // UK
        'DE' => 990,  // Germany
        'CH' => 990,  // Switzerland
        'NO' => 990,  // Norway
        'FR' => 790,  // France
        'ES' => 790,  // Spain
        'BR' => 790,  // Brazil
        'IT' => 590,  // Italy
        'CA' => 590,  // Canada
        'AU' => 590,  // Australia
        'NL' => 590,  // Netherlands
        'BE' => 490,  // Belgium
        'PL' => 490,  // Poland
        'ID' => 390,  // Indonesia
        'PT' => 290,  // Portugal
        'RO' => 290,  // Romania
        'AT' => 290,  // Austria
        'MY' => 290,  // Malaysia
        'IE' => 290,  // Ireland
        'LT' => 190,  // Lithuania
    ];

    // Default price if country not in list
    private static $defaultPrice = 590;

    /**
     * Get Pricing Tiers for a specific country
     * @param string $iso Country ISO Code (2 chars)
     * @return array Rules for Open, Starter, Pro
     */
    public static function getCountryPricing(string $iso): array
    {
        $iso = strtoupper($iso);
        $baseAnnual = self::$masterPriceTable[$iso] ?? self::$defaultPrice;

        return [
            'open' => [
                'name' => 'Open Data',
                'price' => 0,
                'period' => 'Forever',
                'features' => ['Public dataset', 'Limited exports', 'No mass download']
            ],
            'starter' => [
                'name' => 'Starter 90D',
                'price_one_time' => round($baseAnnual / 3, 2), // Rule: Pro / 3
                'period' => '90 Days',
                'updates' => false,
                'features' => ['Full dataset dump', 'No updates', 'Internal use', '90 Day License']
            ],
            'pro' => [
                'name' => 'Pro Country',
                'price_annual' => $baseAnnual,
                'price_monthly_display' => round($baseAnnual / 12, 2), // Rule: Pro / 12
                'period' => '1 Year',
                'updates' => true,
                'features' => ['Full dataset', 'Daily Updates', 'Priority Support', 'Annual License']
            ],
            'agency' => [
                'name' => 'Agency Global',
                'price_annual' => 3900,
                'price_monthly_display' => 325,
                'features' => ['Up to 5 Countries', 'Client Services Allowed', 'Multi-seat']
            ]
        ];
    }

    /**
     * Get Global Licensing Plans (Enterprise)
     */
    public static function getGlobalPricing(): array
    {
        return [
            'agency' => [
                'name' => 'Agency / Multi-Country',
                'price_annual' => 3900,
                'price_monthly_display' => 325,
                'desc' => 'For client services & regional intelligence.'
            ],
            'enterprise_base' => [
                'name' => 'Enterprise Base',
                'price_annual' => 14000,
                'price_monthly_display' => 1166.67,
                'desc' => 'Unlimited countries. Standard SLA.'
            ],
            'enterprise_plus' => [
                'name' => 'Enterprise Plus',
                'price_annual' => 18000,
                'price_monthly_display' => 1500.00,
                'desc' => 'Unlimited countries. Priority SLA. Custom Extraction.'
            ],
            'enterprise_ultra' => [
                'name' => 'Enterprise Ultra',
                'price_annual' => 25000,
                'price_monthly_display' => 2083.33,
                'desc' => 'Full Global Infrastructure. Dedicated Engineers.'
            ]
        ];
    }

    /**
     * Generate Stripe Link (Mock placeholder for now)
     */
    public static function getStripeLink(string $plan, string $iso, float $amount): string
    {
        // 1. Resolve Config Key
        $iso = strtolower($iso);
        $configKey = '';

        if ($plan === 'pro') {
            $configKey = "pro_{$iso}";
        } elseif ($plan === 'starter') {
            $configKey = "starter_{$iso}";
        } elseif ($plan === 'agency') {
            $configKey = 'agency_global';
        } elseif (strpos($plan, 'enterprise') === 0) {
            $configKey = $plan;
        }

        // 2. Resolve Price ID from Global Config
        // Ensure constants are loaded. If not, fallback or error?
        // STRIPE_PRICES is defined in stripe/config.php
        if (defined('STRIPE_PRICES') && isset(STRIPE_PRICES[$configKey])) {
            $priceId = STRIPE_PRICES[$configKey];
            return "/stripe/buy.php?price_id=" . urlencode($priceId);
        }

        // 3. Fallback (If key missing or config not loaded)
        return "/contact/?plan=" . urlencode($plan) . "&error=price_missing";
    }
}
