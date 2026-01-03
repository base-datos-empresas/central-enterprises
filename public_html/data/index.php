<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataset Catalog | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=10">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">CC0 PUBLIC CORE</div>
                <h1 class="hero-title">DATASET <br>CATALOG.</h1>
                <div class="hero-desc">
                    High-integrity corporate registry data. Standardized, versioned, and released under CC0 (Public
                    Domain).
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <!-- Country Listing -->
                <div class="span-4">
                    <div style="padding: 2rem; border: 1px solid var(--structural-line); height: 100%;">
                        <h3 class="titan-label">EUROPE-01</h3>
                        <h2 style="font-size: 1.5rem; margin: 1rem 0;">Spain</h2>
                        <p style="opacity: 0.7; font-size: 0.9rem; margin-bottom: 2rem;">Full jurisdictional
                            standardization of the Spanish Mercantile Registry.</p>
                        <ul class="compare-list" style="margin-bottom: 2rem; font-size: 0.8rem;">
                            <li>Core Records: 3M+</li>
                            <li>Last Sync:
                                <?= date('Y-m-d') ?>
                            </li>
                            <li>Format: JSON / CSV</li>
                        </ul>
                        <a href="<?= $basePath ?>/country/es" class="btn-institutional primary"
                            style="width: 100%; text-align: center;">View Files →</a>
                    </div>
                </div>

                <div class="span-4">
                    <div style="padding: 2rem; border: 1px solid var(--structural-line); height: 100%;">
                        <h3 class="titan-label">NORTH AMERICA-01</h3>
                        <h2 style="font-size: 1.5rem; margin: 1rem 0;">United States</h2>
                        <p style="opacity: 0.7; font-size: 0.9rem; margin-bottom: 2rem;">Inter-state reconciliation for
                            federal identifiers and state-level registration.</p>
                        <ul class="compare-list" style="margin-bottom: 2rem; font-size: 0.8rem;">
                            <li>Core Records: 15M+</li>
                            <li>Last Sync:
                                <?= date('Y-m-d') ?>
                            </li>
                            <li>Format: JSON / CSV</li>
                        </ul>
                        <a href="<?= $basePath ?>/country/us" class="btn-institutional secondary"
                            style="width: 100%; text-align: center;">View Files →</a>
                    </div>
                </div>

                <div class="span-4">
                    <div
                        style="padding: 2rem; border: 1px solid var(--accent); background: rgba(var(--accent-rgb), 0.05); height: 100%;">
                        <h3 class="titan-label" style="color: var(--accent);">ENRICHED</h3>
                        <h2 style="font-size: 1.5rem; margin: 1rem 0;">Pro Layer</h2>
                        <p style="opacity: 0.7; font-size: 0.9rem; margin-bottom: 2rem;">Global enrichment: domains,
                            verified emails, and digital footprint signals.</p>
                        <ul class="compare-list" style="margin-bottom: 2rem; font-size: 0.8rem;">
                            <li>Active Monitoring</li>
                            <li>API Delivery</li>
                            <li>Digital Footprint</li>
                        </ul>
                        <a href="<?= $basePath ?>/pro.php" class="btn-institutional primary"
                            style="width: 100%; text-align: center; background: var(--accent); color: var(--bg-primary);">Request
                            Pro Access →</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>