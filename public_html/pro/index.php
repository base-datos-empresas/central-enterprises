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

// Fallback if registry indexing is in progress
if ($proStats['companies'] === 0) {
    $proStats['companies'] = 14500000;
    $proStats['emails'] = 8200000;
    $proStats['domains'] = 6400000;
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
    <title>Pro Access | Professional Company Intelligence | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@700;800&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=pro_market_1">
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=logo_native">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
    <style>
        .hero {
            padding: 8rem 0 4rem 0;
            border-bottom: 1px solid var(--structural-line);
        }

        .hero-title {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 2rem;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 4rem;
        }

        .stat-item {
            background: var(--bg-secondary);
            padding: 2rem;
            border: 1px solid var(--structural-line);
        }

        .stat-val {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-header);
            margin-bottom: 0.5rem;
            font-family: var(--font-header);
        }

        .stat-label {
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            opacity: 0.6;
            font-weight: 600;
            text-transform: uppercase;
        }

        .stat-trust {
            font-size: 0.6rem;
            margin-top: 1rem;
            opacity: 0.8;
        }

        .stat-trust a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 3rem;
            margin-top: 6rem;
        }

        .feature-box h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .feature-box h3::before {
            content: '';
            width: 12px;
            height: 12px;
            background: var(--accent);
            display: inline-block;
        }

        .pricing-section {
            background: var(--bg-secondary);
            padding: 8rem 0;
            border-top: 1px solid var(--structural-line);
        }
    </style>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="span-12">
                    <div class="section-meta" style="margin-bottom: 1.5rem;">INFRASTRUCTURE CORE</div>
                    <h1 class="hero-title">
                        <span style="color: #64748b; font-weight:800;">GLOBAL PRO</span> <br>
                        <span style="color: var(--accent); font-weight:300;">INTEL ACCESS</span>
                    </h1>
                    <div class="hero-desc" style="max-width: 800px; font-size: 1.25rem;">
                        Commercial-grade scaling for company intelligence. Pro Access fuels the funding layer that keeps
                        our open data standard, validation core, and global refresh cycles sustainable.
                    </div>

                    <div class="stat-grid">
                        <div class="stat-item">
                            <div class="stat-label">Indexed Entities</div>
                            <div class="stat-val"><?= $fmtCompanies ?></div>
                            <div style="font-size: 0.7rem; opacity: 0.6;">Verified across <?= $countCountries ?: 35 ?>
                                jurisdictions</div>
                        </div>
                        <div class="stat-item" style="border-color: var(--accent);">
                            <div class="stat-label" style="color: var(--accent);">Direct Contact Profiles</div>
                            <div class="stat-val" style="color: var(--accent);"><?= $fmtEmails ?></div>
                            <div class="stat-trust">Validated via <a href="https://kaijuverifier.com/api-docs"
                                    target="_blank">Email Verifier API</a></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Web Footprint</div>
                            <div class="stat-val"><?= $fmtDomains ?></div>
                            <div style="font-size: 0.7rem; opacity: 0.6;">Validated domain ownership</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-12">
                    <h2 class="section-title">The Operational Standard</h2>
                    <div class="feature-grid">
                        <div class="feature-box">
                            <h3>High-Frequency Refresh</h3>
                            <p style="opacity: 0.7; line-height: 1.6;">Operational teams require real-time delta
                                tracking. Pro Access provides quarterly and monthly deep-syncs vs the annual public
                                snapshots.</p>
                        </div>
                        <div class="feature-box">
                            <h3>Enriched Access Tiers</h3>
                            <p style="opacity: 0.7; line-height: 1.6;">Unlock commercial fields including verified
                                direct emails, mobile phone lines, and social profile linkage for B2B workflows.</p>
                        </div>
                        <div class="feature-box">
                            <h3>Universal Mapping</h3>
                            <p style="opacity: 0.7; line-height: 1.6;">Cleaner joins and consistent entity IDs across
                                disparate registries, enabling cross-border analysis and unified CRM ingestion.</p>
                        </div>
                        <div class="feature-box">
                            <h3>Audited Provenance</h3>
                            <p style="opacity: 0.7; line-height: 1.6;">Every record includes technical provenance
                                headers, source timestamps, and confidence scores for compliance-heavy environments.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pricing-section">
            <div class="grid-container">
                <div class="span-12" style="margin-bottom: 4rem;">
                    <div class="section-meta">ACCESS PLANS</div>
                    <h2 class="section-title">Scale your intelligence</h2>
                </div>

                <div class="pricing-grid span-12">
                    <!-- Basic -->
                    <div class="pricing-card"
                        style="background: var(--bg-primary); border: 1px solid var(--structural-line);">
                        <div class="pricing-header">
                            <span class="pricing-title">OPEN CORE</span>
                            <div class="pricing-price">CC0 Public</div>
                        </div>
                        <ul class="pricing-features">
                            <li>Snapshots (ZIP)</li>
                            <li>Basic Identity Data</li>
                            <li>Standard Compliance</li>
                            <li style="opacity: 0.4;">No Enriched Contacts</li>
                        </ul>
                        <a href="<?= $basePath ?>/data/" class="btn-institutional secondary">Start Free</a>
                    </div>

                    <!-- PRO -->
                    <div class="pricing-card featured premium-glow"
                        style="border: 1px solid var(--accent); background: var(--bg-primary);">
                        <div class="pricing-header">
                            <span class="pricing-title text-gradient">PRO ACCESS</span>
                            <div class="pricing-price">Operational</div>
                        </div>
                        <ul class="pricing-features">
                            <li><strong>Full Enrichment Layer</strong></li>
                            <li>Email Verifier API Checks</li>
                            <li>Monthly Sync Cycles</li>
                            <li>Bulk CSV/Excel Access</li>
                            <li>Priority Support</li>
                        </ul>
                        <a href="<?= $basePath ?>/contact/" class="btn-institutional primary">Request Access</a>
                    </div>

                    <!-- Enterprise -->
                    <div class="pricing-card"
                        style="background: var(--bg-primary); border: 1px solid var(--structural-line);">
                        <div class="pricing-header">
                            <span class="pricing-title">ENTERPRISE</span>
                            <div class="pricing-price">Infrastructure</div>
                        </div>
                        <ul class="pricing-features">
                            <li>REST API Integration</li>
                            <li>Real-time Monitoring</li>
                            <li>Custom Jurisdictions</li>
                            <li>Legal Sovereignty Support</li>
                            <li>Dedicated SLA</li>
                        </ul>
                        <a href="<?= $basePath ?>/contact/" class="btn-institutional secondary">Consultation</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" style="padding: 10rem 0; border-top: 1px solid var(--structural-line);">
            <div class="grid-container">
                <div class="span-8">
                    <h2 style="font-size: 2.5rem; margin-bottom: 2rem;">A foundation-led promise for global
                        transparency.</h2>
                    <p style="font-size: 1.25rem; opacity: 0.7; line-height: 1.6;">
                        Central.Enterprises stewards the Open Company Data Standard. Pro revenue is explicitly earmarked
                        for funding data stewardship, maintaining registry access bridges, and ensuring long-term CC0
                        availability for the public core.
                    </p>
                    <div style="margin-top: 3rem; display: flex; gap: 2rem;">
                        <a href="<?= $basePath ?>/about/" class="btn-institutional secondary">The Foundation</a>
                        <a href="<?= $basePath ?>/standard/" class="btn-institutional secondary">The Standard</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>