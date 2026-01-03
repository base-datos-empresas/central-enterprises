<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Status | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=8">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
    <style>
        .status-grid {
            margin-top: 4rem;
        }

        .status-item {
            padding: 2rem;
            border-top: 1px solid var(--structural-line);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-item:hover {
            background: var(--bg-secondary);
        }

        .status-info h3 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .status-info p {
            font-size: 0.85rem;
            opacity: 0.6;
        }

        .status-indicator {
            font-family: var(--font-header);
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.5rem 1rem;
            border: 1px solid currentColor;
        }

        .uptime-chart {
            height: 40px;
            display: flex;
            gap: 2px;
            align-items: flex-end;
            margin-top: 1rem;
        }

        .uptime-bar {
            width: 4px;
            background: var(--accent);
            opacity: 0.2;
            height: 100%;
        }

        .uptime-bar.active {
            opacity: 1;
        }
    </style>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">INFRASTRUCTURE</div>
                <h1 class="hero-title">SYSTEM <br>STATUS.</h1>
                <div class="hero-desc">
                    Real-time monitoring of the Central.Enterprises open data gateway and processing pipelines.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-12">
                    <div class="status-grid">
                        <div class="status-item">
                            <div class="status-info">
                                <h3>API GATEWAY [v1]</h3>
                                <p>Global endpoint for data consumption and reconciliation.</p>
                                <div class="uptime-chart"
                                    style="background:var(--bg-secondary); height:4px; margin-top:1rem; width:100%;">
                                    <div style="width:100%; height:100%; background:var(--accent);"></div>
                                </div>
                            </div>
                            <div class="status-indicator status-operational">OPERATIONAL</div>
                        </div>

                        <div class="status-item">
                            <div class="status-info">
                                <h3>DATA SYNC PIPELINE</h3>
                                <p>Automated ingestion from sovereign registries and public signals.</p>
                            </div>
                            <div class="status-indicator status-operational">OPERATIONAL</div>
                        </div>

                        <div class="status-item">
                            <div class="status-info">
                                <h3>GEOGRAPHIC PROCESSING LAYER</h3>
                                <p>Coordinate reconciliation and administrative area mapping.</p>
                            </div>
                            <div class="status-indicator status-operational">OPERATIONAL</div>
                        </div>

                        <div class="status-item">
                            <div class="status-info">
                                <h3>SEARCH INDEX [GLOBAL]</h3>
                                <p>Cross-jurisdiction entity resolution and indexing.</p>
                            </div>
                            <div class="status-indicator status-operational">OPERATIONAL</div>
                        </div>
                    </div>
                </div>

                <div class="span-6" style="margin-top: 5rem;">
                    <h3 class="heading" style="font-size: 1.25rem; margin-bottom: 2rem;">Incident History</h3>
                    <div style="font-size: 0.9rem; opacity: 0.7;">
                        <p style="margin-bottom: 1.5rem;"><strong>2025-12-25:</strong> Scheduled maintenance on US-East
                            data cluster completed successfully.</p>
                        <p style="margin-bottom: 1.5rem;"><strong>2025-12-10:</strong> API Gateway upgrade to v1.2.
                            Improved latency by 15%.</p>
                    </div>
                </div>

                <div class="span-6"
                    style="margin-top: 5rem; border-left: 1px solid var(--structural-line); padding-left: 2rem;">
                    <h3 class="heading" style="font-size: 1.25rem; margin-bottom: 2rem;">Uptime Commitment</h3>
                    <p style="font-size: 0.95rem; line-height: 1.6;">
                        Central.Enterprises is built for reliability. We maintain a 99.9% uptime target for our core API
                        protocols, ensuring that researchers and institutions can depend on our infrastructure as a
                        shared reality.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>