<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";

// --- DYNAMIC METRICS AGGREGATION (PRO TIER) ---
$registryPath = __DIR__ . '/../../data/registry_index.json';
$proStats = [
    'companies' => 0,
    'emails' => 0,
    'phones' => 0,
    'domains' => 0,
    'countries' => []
];

if (file_exists($registryPath)) {
    $registry = json_decode(file_get_contents($registryPath), true);

    foreach ($registry as $asset) {
        $tier = $asset['tier'] ?? '';
        if ($tier !== 'Premium' && $tier !== 'Pro')
            continue;

        if (strpos($asset['asset_name'], 'Metrics-Premium.json') === false)
            continue;

        $jurisdiction = $asset['jurisdiction'];
        $jsonPath = __DIR__ . "/../../data/XPublicar1/{$jurisdiction}/{$jurisdiction}-Premium/{$asset['asset_name']}";

        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);
            if (isset($data['totals'])) {
                $proStats['companies'] += $data['totals']['companies_unique'] ?? 0;
                $proStats['emails'] += $data['totals']['unique_emails'] ?? 0;
                $proStats['domains'] += $data['totals']['web_domains_unique'] ?? 0;
                $proStats['countries'][$jurisdiction] = [
                    'companies' => $data['totals']['companies_unique'] ?? 0,
                    'emails' => $data['totals']['unique_emails'] ?? 0
                ];
            }
        }
    }
}

// Format for display
$fmtCompanies = number_format($proStats['companies']);
$fmtEmails = number_format($proStats['emails']);
$fmtDomains = number_format($proStats['domains']);
$countCountries = count($proStats['countries']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro Access | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=11">
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=transparent">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">INFRASTRUCTURE CORE</div>
                <h1 class="hero-title">PRO <br>ACCESS.</h1>
                <div class="hero-desc">
                    Pro Access for infrastructure-grade company intelligence. CC0 is the public core. Pro is the funding
                    layer that keeps the standard, validation, and refresh cycles sustainable—without compromising
                    openness.
                </div>

                <!-- LIVE INFRASTRUCTURE STATS -->
                <div class="grid-container"
                    style="margin-top: 3rem; margin-bottom: 2rem; border-top: 1px solid var(--structural-line); padding-top: 2rem;">
                    <div class="span-4">
                        <div class="stat-card">
                            <div style="font-size: 0.8rem; letter-spacing: 0.1em; opacity: 0.6; margin-bottom: 0.5rem;">
                                ACTIVE ENTITIES</div>
                            <div style="font-size: 2rem; font-weight: 800; color: var(--text-header);">
                                <?= $fmtCompanies ?>
                            </div>
                        </div>
                    </div>
                    <div class="span-4">
                        <div class="stat-card" style="border-color:var(--accent);">
                            <div
                                style="font-size: 0.8rem; letter-spacing: 0.1em; opacity: 0.6; margin-bottom: 0.5rem; color: var(--accent);">
                                VERIFIED EMAILS</div>
                            <div style="font-size: 2rem; font-weight: 800; color: var(--accent);">
                                <?= $fmtEmails ?>
                            </div>
                        </div>
                    </div>
                    <div class="span-4">
                        <div class="stat-card">
                            <div style="font-size: 0.8rem; letter-spacing: 0.1em; opacity: 0.6; margin-bottom: 0.5rem;">
                                WEB
                                DOMAINS</div>
                            <div style="font-size: 2rem; font-weight: 800; color: var(--text-header);">
                                <?= $fmtDomains ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cta-group span-12">
                    <a href="<?= $basePath ?>/contact/" class="btn-institutional primary">Request Pro Access</a>
                    <a href="#compare" class="btn-institutional secondary">Compare Open vs Pro</a>
                    <div style="margin-top:1rem; width:100%; display:flex; gap:2rem; align-items:center;">
                        <a href="<?= $basePath ?>/standard/"
                            style="font-size: 0.75rem; text-decoration: underline; opacity: 0.6; color:inherit;">Read
                            the Standard</a>
                        <a href="<?= $basePath ?>/pro/status/"
                            style="font-size: 0.75rem; text-decoration: underline; opacity: 0.6; color:var(--accent);">Check
                            Application Status</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Why Pro exists</h2>
                    <p style="font-size: 1.25rem; line-height: 1.6; opacity: 0.8; margin-bottom: 3rem;">
                        Central.Enterprises is moving toward a foundation model in Spain to permanently steward open
                        company data under CC0. Pro exists to finance that stewardship: faster refresh, stronger
                        provenance, higher coverage, and enriched business contact channels for legitimate professional
                        use. The result is a public core anyone can build on—and a professional layer for teams who need
                        operational depth.
                    </p>

                    <div class="grid-container" style="padding:0">
                        <div class="span-6 feature-card">
                            <span class="feature-num">01</span>
                            <h3>High-Frequency Refresh</h3>
                            <p>Priority updates and faster sync cycles for operational environments.</p>
                        </div>
                        <div class="span-6 feature-card">
                            <span class="feature-num">02</span>
                            <h3>Enrichment Layer</h3>
                            <p>Website, business contact channels, and classification signals.</p>
                        </div>
                        <div class="span-6 feature-card">
                            <span class="feature-num">03</span>
                            <h3>Stable Identifiers</h3>
                            <p>Cleaner joins and consistent IDs across snapshots for analytics and pipelines.</p>
                        </div>
                        <div class="span-6 feature-card">
                            <span class="feature-num">04</span>
                            <h3>Full Provenance</h3>
                            <p>Provenance-first records including timestamps, sources, and confidence tracking.</p>
                        </div>
                    </div>
                </div>

                <div class="span-4">
                    <div class="protocol-card"
                        style="padding: 2rem; background: var(--bg-secondary); border: 1px solid var(--structural-line);">
                        <h4 class="titan-label">DELIVERY PROTOCOLS</h4>
                        <ul class="compare-list" style="margin-top: 1rem;">
                            <li>Bulk JSON/CSV Exports</li>
                            <li>REST API Access</li>
                            <li>Integration Support</li>
                            <li>SLA Guarantees [Enterprise]</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" style="border-top: 1px solid var(--structural-line); padding: 5rem 0;">
            <div class="grid-container">
                <div class="span-12" style="text-align: center;">
                    <h2 style="font-size: 1.5rem; font-weight: 800; font-family: var(--font-header);">Built to be cited,
                        not just consumed.</h2>
                    <p style="opacity: 0.6; margin-top: 1rem; max-width: 700px; margin-left: auto; margin-right: auto;">
                        We treat provenance, versioning, and integrity as product features. Pro users benefit from
                        stronger guarantees around update discipline and record continuity—while the CC0 core remains
                        freely reusable.
                    </p>
                </div>
            </div>
        </section>

        <section class="section" id="compare" style="background: var(--bg-secondary); padding: 8rem 0;">
            <div class="grid-container">
                <div class="section-meta">ARCHITECTURE</div>
                <div class="span-12">
                    <h2 class="section-title">Open vs Pro</h2>
                    <div class="pro-compare-grid">
                        <div class="compare-card">
                            <h4 class="titan-label">OPEN (CC0 PUBLIC CORE)</h4>
                            <p style="margin-bottom: 1.5rem;">Designed for broad reuse, research, and public
                                infrastructure. Company-level facts with provenance and versioning. Built to avoid
                                personal data.</p>
                            <a href="<?= $basePath ?>/data/" class="btn-institutional secondary"
                                style="width: 100%; justify-content: center;">Explore Open Data</a>
                        </div>
                        <div class="compare-card pro">
                            <h4 class="titan-label" style="color:var(--accent)">PRO (PAID ENRICHMENT LAYER)</h4>
                            <p style="margin-bottom: 1.5rem;">Designed for operations. Adds enrichment and faster
                                updates. Built for legitimate B2B workflows where traceability and freshness matter.</p>
                            <a href="<?= $basePath ?>/contact/" class="btn-institutional primary"
                                style="width: 100%; justify-content: center;">Request Pro Access</a>
                        </div>
                    </div>

                    <div
                        style="margin-top: 4rem; text-align: center; opacity: 0.6; font-size: 0.9rem; max-width: 700px; margin-left: auto; margin-right: auto;">
                        <strong>A foundation-led promise:</strong> When the foundation is registered, it will steward
                        CC0 releases and the standard. Pro revenue is explicitly aligned with funding data stewardship
                        and long-term availability.
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="grid-container">
                <div class="section-meta">ACCESS PLANS</div>
                <div class="span-12">
                    <div class="pricing-grid">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <span class="pricing-title">OPEN</span>
                                <div class="pricing-price">Informed</div>
                            </div>
                            <ul class="pricing-features">
                                <li>CC0 Downloads</li>
                                <li>Standard Access</li>
                                <li>Public Documentation</li>
                            </ul>
                            <a href="<?= $basePath ?>/data/" class="btn-institutional secondary">Explore Open Data</a>
                        </div>
                        <div class="pricing-card featured premium-glow">
                            <div class="pricing-header">
                                <span class="pricing-title text-gradient">PRO</span>
                                <div class="pricing-price">Operational</div>
                            </div>
                            <ul class="pricing-features">
                                <li>Enrichment Layer</li>
                                <li>Higher Cadence</li>
                                <li>API Keys</li>
                                <li>Bulk Exports</li>
                            </ul>
                            <a href="<?= $basePath ?>/contact/" class="btn-institutional primary">Request Pro Access</a>
                        </div>
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <span class="pricing-title">ENTERPRISE</span>
                                <div class="pricing-price">Strategic</div>
                            </div>
                            <ul class="pricing-features">
                                <li>Custom Refresh</li>
                                <li>Dedicated Support</li>
                                <li>Governance Alignment</li>
                                <li>Compliance Tooling</li>
                            </ul>
                            <a href="<?= $basePath ?>/contact/" class="btn-institutional secondary">Talk to Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>
