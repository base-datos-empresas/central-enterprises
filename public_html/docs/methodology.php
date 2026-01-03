<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Methodology | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=transparent">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=8">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
    <style>
        .methodology-content h2 {
            margin-top: 4rem;
            margin-bottom: 2rem;
            font-size: 2rem;
            color: var(--accent);
        }

        .methodology-content p {
            font-size: 1.15rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            color: var(--text-body);
        }

        .protocol-card {
            padding: 3rem;
            background: var(--bg-secondary);
            border: 1px solid var(--structural-line);
            margin-bottom: 2rem;
        }

        .protocol-card h3 {
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
        }

        .quality-metric {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--structural-line);
        }

        .quality-metric span:first-child {
            font-family: var(--font-header);
            font-weight: 800;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .quality-metric span:last-child {
            font-size: 0.9rem;
            opacity: 0.7;
        }
    </style>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">PRIME DIRECTIVE</div>
                <h1 class="hero-title">PROTOCOL <br>& QUALITY.</h1>
                <div class="hero-desc">
                    Defining the engineering standards that transform raw public signals into a global reference layer
                    for business intelligence.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8 methodology-content">
                    <h2>The Quality Index</h2>
                    <p>Trust in open data requires discipline. Our "Quality Index" is not a marketing promise; it is a
                        calculated score based on five key engineering metrics that ensure our datasets are actionable
                        for institutional use.</p>

                    <div class="protocol-card">
                        <div class="quality-metric">
                            <span>Deduplication [D1]</span>
                            <span>Entity uniqueness across snapshots</span>
                        </div>
                        <div class="quality-metric">
                            <span>Geographic Coherence [G1]</span>
                            <span>Coordinate-to-address alignment</span>
                        </div>
                        <div class="quality-metric">
                            <span>Link Integrity [L1]</span>
                            <span>Verified corporate web presence</span>
                        </div>
                        <div class="quality-metric">
                            <span>Freshness [F1]</span>
                            <span>Time since last registry sync</span>
                        </div>
                        <div class="quality-metric">
                            <span>Categorization [C1]</span>
                            <span>Taxonomy mapping accuracy</span>
                        </div>
                    </div>

                    <h2>Standardized Taxonomy</h2>
                    <p>We map all corporate entities into a uniform sectoral taxonomy. This allows for
                        cross-jurisdiction analysis, where a tech startup in Granada can be compared with one in San
                        Francisco using the same structural parameters.</p>

                    <h2>Snapshots vs. Real-time</h2>
                    <p>We provide "Truth in the form of a snapshot." While the world changes daily, research and
                        intelligent decision-making require stable points of reference. Our monthly releases allow for
                        longitudinal studies and reliable benchmarking.</p>
                </div>

                <div class="span-4">
                    <div class="sidebar-toc">
                        <h4 class="titan-label">DOCUMENTATION</h4>
                        <a href="<?= $basePath ?>/docs/manifesto.php" class="toc-item">Read Manifesto</a>
                        <a href="<?= $basePath ?>/docs/status.php" class="toc-item">System Status</a>
                        <div style="margin-top: 3rem; border-top: 1px solid var(--accent); padding-top: 1rem;">
                            <h4 class="titan-label">COMPLIANCE</h4>
                            <p style="font-size: 0.8rem; opacity: 0.7; line-height: 1.5;">
                                Our methodology respects the General Data Protection Regulation (GDPR) by focusing
                                exclusively on corporate entity data and public professional signals.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>
