<?php
// Stripe API Keys
define('STRIPE_SECRET_KEY', 'sk_live_...');
define('STRIPE_PUBLISHABLE_KEY', 'pk_live_...');
define('STRIPE_WEBHOOK_SECRET', 'whsec_...');

// Stripe Currency
define('STRIPE_CURRENCY', 'eur');

// Database Path
define('DB_PATH', __DIR__ . '/../data/subscriptions.sqlite');

// Stripe Prices - Managed by seed_stripe.ps1
define('STRIPE_PRICES', [
    'pro_gb' => 'price_1Sppm7E4cbXrZo2xs0RNj0yt',
    'pro_ie' => 'price_1Sppm0E4cbXrZo2xwJkgtQJD',
    'starter_ca' => 'price_1SppmPE4cbXrZo2xSRX38m1b',
    'agency_global' => 'price_1SppluE4cbXrZo2xQ239kEZR',
    'pro_fr' => 'price_1Sppm0E4cbXrZo2xuRoQjl1r',
    'pro_pl' => 'price_1Sppm9E4cbXrZo2xiJlqpt74',
    'starter_de' => 'price_1SppmCE4cbXrZo2xNzpVFtYd',
    'starter_it' => 'price_1SppmDE4cbXrZo2xxISl3jFy',
    'enterprise_ultra' => 'price_1SpplwE4cbXrZo2x6PSHNiQA',
    'pro_de' => 'price_1SpplxE4cbXrZo2x37PkvhJQ',
    'pro_id' => 'price_1SpplzE4cbXrZo2xEmNjQv3R',
    'pro_ch' => 'price_1SppmBE4cbXrZo2xCL0OqGBZ',
    'pro_br' => 'price_1Sppm7E4cbXrZo2xAL3Pdvf3',
    'pro_ca' => 'price_1SppmAE4cbXrZo2x0SFmyEUd',
    'enterprise_base' => 'price_1SpplvE4cbXrZo2xvXgKNoHC',
    'pro_pt' => 'price_1Sppm8E4cbXrZo2xAKwPkPjS',
    'pro_es' => 'price_1Sppm4E4cbXrZo2xi9yRL8iA',
    'starter_be' => 'price_1SppmHE4cbXrZo2xwyprLZC9',
    'starter_lt' => 'price_1SppmJE4cbXrZo2xTeB2drYH',
    'starter_id' => 'price_1SppmDE4cbXrZo2xk8xJ0K4N',
    'pro_au' => 'price_1Sppm6E4cbXrZo2xMb1tJK5X',
    'pro_be' => 'price_1Sppm2E4cbXrZo2xByxbAkcy',
    'starter_es' => 'price_1SppmIE4cbXrZo2xORqCzRSR',
    'pro_lt' => 'price_1Sppm4E4cbXrZo2xpNjNo4Rj',
    'pro_no' => 'price_1Sppm3E4cbXrZo2xetLojdcL',
    'pro_nl' => 'price_1SpplxE4cbXrZo2xGwppTvPq',
    'pro_it' => 'price_1SpplyE4cbXrZo2xWkMOZHGf',
    'starter_fr' => 'price_1SppmFE4cbXrZo2xQnJTaLOU',
    'pro_at' => 'price_1Sppm9E4cbXrZo2xplugM3qz',
    'starter_ie' => 'price_1SppmEE4cbXrZo2xtkOSNvt2',
    'starter_au' => 'price_1SppmKE4cbXrZo2xiu6oIcgC',
    'starter_br' => 'price_1SppmLE4cbXrZo2xKQZjqrv8',
    'pro_ro' => 'price_1Sppm5E4cbXrZo2x5vnjFhVC',
    'starter_gb' => 'price_1SppmME4cbXrZo2xXG8uh3Zj',
    'starter_nl' => 'price_1SppmBE4cbXrZo2xMC1sZcVf',
    'starter_ro' => 'price_1SppmKE4cbXrZo2x4bBJRNtF',
    'pro_my' => 'price_1Sppm2E4cbXrZo2xEchKGqy1',
    'starter_pl' => 'price_1SppmOE4cbXrZo2xgfNxeX70',
    'pro_us' => 'price_1Sppm1E4cbXrZo2xjYTl4u0b',
    'starter_my' => 'price_1SppmGE4cbXrZo2xRsLoZjx3',
    'starter_pt' => 'price_1SppmME4cbXrZo2xTvPE6NjI',
    'starter_ch' => 'price_1SppmPE4cbXrZo2xGSRCPP9e',
    'starter_no' => 'price_1SppmIE4cbXrZo2xKqc5FOiF',
    'starter_at' => 'price_1SppmNE4cbXrZo2xvgLJaLiL',
    'starter_us' => 'price_1SppmGE4cbXrZo2x1LnGUmbI',
    'enterprise_plus' => 'price_1SpplvE4cbXrZo2xDDZt8w5p',
]);