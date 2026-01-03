<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation | Central.Enterprises</title>
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
                <div class="section-meta">TECHNICAL IMPLEMENTATION</div>
                <h1 class="hero-title">BUILT FOR <br>INTEGRATION.</h1>
                <div class="hero-desc">
                    Resources for engineers and data scientists to ingest global corporate registry signals.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Ingestion Patterns</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">The Central.Enterprises registry is
                        designed to be ingested by machines first. We provide standardized JSON and CSV outputs that
                        follow the Open Company Data Standard v1.</p>

                    <div style="margin-bottom: 4rem;">
                        <h3 class="heading" style="font-size: 1rem; color: var(--accent); margin-bottom: 1rem;">1.
                            Download CC0 Core</h3>
                        <p style="opacity: 0.7; line-height: 1.8;">Fetch the latest jurisdictional dumps (bulk) from the
                            <a href="<?= $basePath ?>/data" style="color:var(--accent)">Data Catalog</a>. These files
                            are updated in weekly and monthly sync cycles.
                        </p>
                    </div>

                    <div style="margin-bottom: 4rem;">
                        <h3 class="heading" style="font-size: 1rem; color: var(--accent); margin-bottom: 1rem;">2.
                            Verify Integrity</h3>
                        <p style="opacity: 0.7; line-height: 1.8;">Standard practice: always verify the
                            <code>record_hash</code> against your local ingestion. Our SHA-256 signatures ensure that
                            the neutrality of the data is preserved from the source to your database.
                        </p>
                    </div>

                    <div style="margin-bottom: 4rem;">
                        <h3 class="heading" style="font-size: 1rem; color: var(--accent); margin-bottom: 1rem;">3.
                            Schema Mapping</h3>
                        <p style="opacity: 0.7; line-height: 1.8;">Use the <a href="<?= $basePath ?>/standard"
                                style="color:var(--accent)">Standard v1 specification</a> to map internal fields. We
                            maintain stable <code>entity_id</code> identifiers to allow for high-confidence
                            reconciliation across different data providers.</p>
                    </div>
                </div>

                <div class="span-4">
                    <div style="padding: 2rem; border: 1px solid var(--structural-line);">
                        <h4 class="titan-label">RESOURCES</h4>
                        <ul class="compare-list" style="margin-top: 1rem; font-size: 0.85rem;">
                            <li><a href="<?= $basePath ?>/standard/">Standard v1 Schema</a></li>
                            <li><a href="<?= $basePath ?>/docs/manifesto.php">Institutional Manifesto</a></li>
                            <li><a href="<?= $basePath ?>/docs/methodology.php">Data Methodology</a></li>
                            <li><a href="<?= $basePath ?>/docs/updates.php">Technical Updates</a></li>
                            <li><a href="<?= $basePath ?>/docs/status.php">System Status</a></li>
                            <li><a href="https://github.com/base-datos-empresas" target="_blank">GitHub Repository</a>
                            </li>
                            <li><a href="<?= $basePath ?>/pro/">Pro API Docs (REST)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>