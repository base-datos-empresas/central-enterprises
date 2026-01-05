<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technical Updates | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=logo_native">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=8">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
    <style>
        .timeline-container {
            position: relative;
        }

        /* Continuous Vertical Line */
        .timeline-line {
            position: absolute;
            left: 20%;
            top: 0;
            bottom: 0;
            width: 1px;
            background: var(--structural-line);
            z-index: 0;
        }

        .update-entry {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: var(--column-gap);
            margin-bottom: 8rem;
            position: relative;
            z-index: 1;
        }

        .update-meta {
            grid-column: span 3;
            text-align: right;
            padding-right: 3rem;
        }

        .update-date {
            font-family: var(--font-header);
            font-size: 0.85rem;
            color: var(--accent);
            font-weight: 700;
            letter-spacing: 0.1em;
            position: sticky;
            top: 10rem;
            background: var(--bg-primary);
            /* Mask line behind text if needed */
            padding: 0.5rem 0;
            display: inline-block;
        }

        .update-marker {
            position: absolute;
            right: -6px;
            /* Half of width (11px) plus gap adjustment */
            top: 0.8rem;
            width: 11px;
            height: 11px;
            background: var(--bg-primary);
            border: 2px solid var(--accent);
            border-radius: 0;
            /* Square for Titan */
            z-index: 2;
        }

        .update-content {
            grid-column: span 7;
            padding-top: 0.2rem;
        }

        .update-title {
            font-size: 2.5rem;
            line-height: 1.1;
            margin-bottom: 2rem;
            background: linear-gradient(to right, var(--text-header), rgba(255, 255, 255, 0.5));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .update-body p {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            opacity: 0.9;
            color: var(--text-body);
        }

        .update-feature-list {
            margin: 3rem 0;
            list-style: none;
            background: var(--bg-secondary);
            border: 1px solid var(--structural-line);
            padding: 0;
        }

        .update-feature-list li {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--structural-line);
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 2rem;
            align-items: baseline;
            transition: background 0.2s;
        }

        .update-feature-list li:last-child {
            border-bottom: none;
        }

        .update-feature-list li:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .update-feature-list li strong {
            font-family: var(--font-header);
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--accent);
            letter-spacing: 0.05em;
        }

        .update-feature-list li span {
            font-size: 0.95rem;
            opacity: 0.8;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .timeline-line {
                display: none;
            }

            .update-entry {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .update-meta {
                text-align: left;
                padding: 0;
                margin-bottom: 1rem;
            }

            .update-marker {
                display: none;
            }

            .update-feature-list li {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">LOGS & EVOLUTION</div>
                <h1 class="hero-title">TECHNICAL <br>UPDATES.</h1>
                <div class="hero-desc">
                    Tracking the structural evolution of the Central.Enterprises global reference layer.
                </div>
            </div>
        </header>

        <section class="section" style="padding-bottom: 10rem;">
            <div class="grid-container timeline-container">

                <!-- TIMELINE LINE (Visual Anchor) -->
                <div class="span-3 timeline-line"></div>

                <!-- ENTRY 0: Deep Registry & Pro Core -->
                <article class="update-entry span-12">
                    <div class="update-meta">
                        <div class="update-date">
                            DEC 28, 2025
                            <div class="update-marker"></div>
                        </div>
                        <div style="font-size: 0.7rem; opacity: 0.5; margin-top: 0.5rem; letter-spacing: 0.05em;">PHASE
                            3 EXPANSION</div>
                    </div>
                    <div class="update-content">
                        <h2 class="update-title">Deep Registry & Pro Infrastructure</h2>
                        <div class="update-body">
                            <p>We completed the "Deep Registry" architecture, exposing over 50,000 sector-specific
                                landing pages and activating the dynamic commercial intelligence layer. The platform now
                                distinguishes autonomously between the Public Core (CC0) and the Professional Enrichment
                                Layer.</p>

                            <ul class="update-feature-list">
                                <li>
                                    <strong>Deep Registry URLs</strong>
                                    <span>Moved beyond flat lists to hierarchical semantic paths (e.g.,
                                        <code>/registry/Poland/IT-Companies</code>). Every sector in every country now
                                        has a dedicated, indexable entrance.</span>
                                </li>
                                <li>
                                    <strong>Hybrid Sitemap</strong>
                                    <span>Developed a JSON-native Sitemap Generator that maps assets across the Hybrid
                                        Storage Cloud without needing physical file access, submitting 100% of the
                                        registry to search engines instantly.</span>
                                </li>
                                <li>
                                    <strong>Dynamic Pro Layer</strong>
                                    <span>The Pro Dashboard is no longer static. It recursively aggregates metadata from
                                        the <code>Premium</code> logic tier to display real-time global footprints
                                        (e.g., "5.0M+ Verified Contacts") and per-jurisdiction coverage
                                        availability.</span>
                                </li>
                                <li>
                                    <strong>Data Structure Standard</strong>
                                    <span>Formalized the "Twin Folder" schema (`*-OpenData` vs `*-Premium`) to guarantee
                                        separation of concerns between public infrastructure and commercial
                                        sustainability layers.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>

                <!-- ENTRY 1: Hybrid Cloud -->
                <article class="update-entry span-12">
                    <div class="update-meta">
                        <div class="update-date">
                            DEC 27, 2025
                            <div class="update-marker"></div>
                        </div>
                        <div style="font-size: 0.7rem; opacity: 0.5; margin-top: 0.5rem; letter-spacing: 0.05em;">PHASE
                            2 DEPLOYMENT</div>
                    </div>
                    <div class="update-content">
                        <h2 class="update-title">Hybrid Cloud & Data-Centric Evolution</h2>
                        <div class="update-body">
                            <p>We have successfully deployed the "Phase 2" architecture, solving the critical storage
                                constraints while accurately representing the massive scale of the dataset. This shift
                                transforms the platform from a file repository into a true Business Intelligence engine.
                            </p>

                            <ul class="update-feature-list">
                                <li>
                                    <strong>Hybrid Storage</strong>
                                    <span>Decoupled the "Control Plane" (Oracle Autonomous DB) from the "Data Plane"
                                        (77GB on Dropbox), ensuring zero server saturation while maintaining instant
                                        asset availability via High-Speed Downloads.</span>
                                </li>
                                <li>
                                    <strong>Catalog Grid</strong>
                                    <span>Retired the legacy tabular view in favor of a responsive <strong>Institutional
                                            Card Grid</strong>. Each jurisdiction (Spain, Poland, etc.) is now a
                                        sovereign visual entity complete with embedded real-time statistics.</span>
                                </li>
                                <li>
                                    <strong>Programmatic SEO</strong>
                                    <span>Implemented a deep-crawl engine that reads 2,000+ hidden JSON metadata files
                                        to generate dynamic Titles and Meta Descriptions (e.g., "651,292 Companies") for
                                        search engines.</span>
                                </li>
                                <li>
                                    <strong>Landing Pages</strong>
                                    <span>Activated clean URL rewrites (e.g., <code>/catalog/Spain</code>) that function
                                        as dedicated sovereign landing pages, complete with valid Schema.org
                                        <code>DataCatalog</code> definitions.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>

                <!-- ENTRY 2: Initial Foundation -->
                <article class="update-entry span-12">
                    <div class="update-meta">
                        <div class="update-date">
                            DEC 27, 2025
                            <div class="update-marker"></div>
                        </div>
                        <div style="font-size: 0.7rem; opacity: 0.5; margin-top: 0.5rem; letter-spacing: 0.05em;">PHASE
                            1 AUDIT</div>
                    </div>
                    <div class="update-content">
                        <h2 class="update-title">Transition to Institutional Infrastructure</h2>
                        <div class="update-body">
                            <p>Today marks a significant milestone in the Central.Enterprises project. We have
                                successfully transitioned from a data processing pipeline to a multi-layered
                                institutional infrastructure designed for global scale.</p>

                            <ul class="update-feature-list">
                                <li>
                                    <strong>Dataset Catalog</strong>
                                    <span>A centralized inventory of all managed datasets, featuring quality indexes
                                        (D1-C1) and automated snapshot tracking for data provenance.</span>
                                </li>
                                <li>
                                    <strong>System Status</strong>
                                    <span>Real-time monitoring of our API Gateway and Data Sync pipelines to ensure
                                        99.9% reliability for institutional partners and researchers.</span>
                                </li>
                                <li>
                                    <strong>Legacy Fixes</strong>
                                    <span>Full compatibility with PHP 8.4 environments and enhanced data ingestion
                                        robustness for heterogeneous CSV sources across multiple jurisdictions.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>

            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>
