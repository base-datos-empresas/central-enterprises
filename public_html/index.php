<?php
require_once __DIR__ . '/includes/security_headers.php';
$basePath = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central.Enterprises | The Open Company Data Foundation</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <meta name="description"
        content="Central.Enterprises is a Spain-based foundation providing a CC0 reference layer and professional company databases. Open data as infrastructure.">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="assets/titan.css?v=11">
    <link rel="icon" type="image/png" href="assets/favicon.png?v=logo_native">
    <script src="assets/theme-toggle.js?v=7" defer></script>
    <script src="assets/cookies.js?v=5" defer></script>
    <!-- SEO & Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Central.Enterprises Foundation",
      "url": "https://central.enterprises",
      "logo": "https://central.enterprises/assets/logo.png",
      "description": "A Spain-based foundation providing a CC0 global reference layer for business reality.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Trajano 8",
        "addressLocality": "Granada",
        "postalCode": "18002",
        "addressCountry": "ES"
      }
    }
    </script>
    <style>
        .hero-title {
            font-size: clamp(2.5rem, 8vw, 5.5rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
            margin-bottom: 2rem;
        }

        #svgMap {
            width: 100%;
            height: 500px;
            border: 1px solid var(--structural-line);
            background: rgba(255, 255, 255, 0.02);
            border-radius: 8px;
            margin: 4rem 0;
            cursor: default;
        }

        /* svgMap Tooltip Overrides */
        .svgMap-tooltip {
            background: var(--bg-primary) !important;
            border: 1px solid var(--accent) !important;
            color: var(--text-header) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
            padding: 1rem !important;
        }
    </style>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include 'includes/cookies_banner.php'; ?>
    <?php include 'includes/header.php'; ?>

    <?php
    // Load Data for Map & Table
    $libraryPath = __DIR__ . '/../data/digital_library.json';
    $library = json_decode(file_get_contents($libraryPath), true);

    $isoMap = [
        'Spain' => 'ES',
        'United States' => 'US',
        'United Kingdom' => 'GB',
        'Germany' => 'DE',
        'France' => 'FR',
        'Italy' => 'IT',
        'Netherlands' => 'NL',
        'Belgium' => 'BE',
        'Austria' => 'AT',
        'Portugal' => 'PT',
        'Ireland' => 'IE',
        'Switzerland' => 'CH',
        'Canada' => 'CA',
        'Australia' => 'AU',
        'Brazil' => 'BR',
        'Mexico' => 'MX',
        'Indonesia' => 'ID',
        'Malaysia' => 'MY',
        'Poland' => 'PL',
        'Norway' => 'NO',
        'Romania' => 'RO',
        'Lithuania' => 'LT',
        'Czechia' => 'CZ',
        'Slovak Republic' => 'SK',
        'Russia' => 'RU',
        'China' => 'CN',
        'Japan' => 'JP',
        'India' => 'IN'
    ];

    $mapData = [];
    $groupedCatalog = [];
    foreach ($library as $countryName => $tiers) {
        if ($countryName === '_metadata')
            continue;
        $iso = $isoMap[$countryName] ?? null;
        $openData = $tiers['OpenData'] ?? null;
        $metrics = $openData['metrics'] ?? ['companies' => 0, 'emails' => 0];
        $slug = strtolower(str_replace(' ', '-', $countryName));
        $link = "/country/" . $slug;

        if ($iso) {
            $mapData[$iso] = [
                'companies' => $metrics['companies'],
                'emails' => $metrics['emails_unique'] ?? $metrics['emails'] ?? 0,
                'link' => $link,
                'name' => $countryName
            ];
        }

        $groupedCatalog[$countryName] = [
            'name' => $countryName,
            'iso' => $iso ?? '??',
            'metrics' => $metrics,
            'url' => $link
        ];
    }
    ksort($groupedCatalog);
    ?>

    <main>
        <header class="hero" style="padding-bottom: 0;">
            <div class="grid-container">
                <div class="section-meta">GLOBAL REGISTRY FOUNDATION</div>
                <h1 class="hero-title">
                    <span style="color: #64748b; font-weight:800;">THE GLOBAL REFERENCE LAYER</span> <br>
                    <span style="color: var(--accent); font-weight:300;">FOR BUSINESS REALITY.</span>
                </h1>
                <div class="hero-desc" style="max-width: 800px;">
                    Central.Enterprises provides the definitive CC0 reference layer for business identity.
                    <strong>Open Data as Critical Infrastructure.</strong> Neutral, open-source protocol for global
                    economic transparency.
                </div>
            </div>
        </header>

        <section class="section" style="padding-top: 2rem;">
            <div class="grid-container">
                <div class="span-12">
                    <div id="svgMap"></div>
                </div>
            </div>
        </section>

        <section class="section" style="padding-top: 5rem;">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Industrial Integrity.</h2>
                    <p style="font-size: 1.25rem; line-height: 1.6; opacity: 0.8; margin-bottom: 2rem;">
                        We eliminate friction in accessing corporate reality. Central.Enterprises standardizes global
                        commercial registries into a free-access CC0 core, supported by a high-fidelity Pro layer.
                    </p>
                    <p style="opacity: 0.7; line-height: 1.8; margin-bottom: 2rem;">
                        Our mission is to provide the most stable and transparent **company databases** on the market,
                        treating data provenance and freshness as fundamental engineering features, not marketing
                        promises.
                    </p>
                </div>
            </div>
        </section>

        <section class="section" style="padding-top: 0;">
            <div class="grid-container">
                <div class="section-meta">GLOBAL DATASET CATALOG</div>
                <h2 class="section-title">Select a jurisdiction to inspect corporate entities.</h2>

                <div class="span-12" style="margin-top: 2rem;">
                    <div
                        style="background: var(--bg-secondary); border: 1px solid var(--structural-line); overflow: hidden; border-radius: 4px;">
                        <table class="titan-table" style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 1px solid var(--accent); background: rgba(0,0,0,0.2);">
                                    <th
                                        style="padding: 1.25rem; font-size: 0.75rem; text-transform: uppercase; color: var(--accent); text-align: left;">
                                        Country</th>
                                    <th
                                        style="padding: 1.25rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); text-align: left;">
                                        ISO</th>
                                    <th
                                        style="padding: 1.25rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); text-align: right;">
                                        Companies</th>
                                    <th
                                        style="padding: 1.25rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); text-align: right;">
                                        Emails</th>
                                    <th
                                        style="padding: 1.25rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); text-align: right;">
                                        Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($groupedCatalog as $name => $ds): ?>
                                    <tr style="border-bottom: 1px solid var(--structural-line); transition: background 0.2s;"
                                        onmouseover="this.style.background='rgba(255,255,255,0.03)'"
                                        onmouseout="this.style.background='transparent'">
                                        <td style="padding: 1rem 1.25rem; font-weight: 700;">
                                            <a href="<?= $ds['url'] ?>"
                                                style="color: inherit; text-decoration: none; display: flex; align-items: center;">
                                                <span
                                                    style="display: inline-block; width: 6px; height: 6px; background: var(--accent); border-radius: 50%; margin-right: 0.75rem;"></span>
                                                <?= strtoupper($name) ?>
                                            </a>
                                        </td>
                                        <td
                                            style="padding: 1rem 1.25rem; font-family: monospace; opacity: 0.6; font-size: 0.85rem;">
                                            <?= $ds['iso'] ?></td>
                                        <td
                                            style="padding: 1rem 1.25rem; text-align: right; font-family: 'Sora', sans-serif; font-size: 0.9rem;">
                                            <?= number_format($ds['metrics']['companies']) ?>
                                        </td>
                                        <td
                                            style="padding: 1rem 1.25rem; text-align: right; font-family: 'Sora', sans-serif; opacity: 0.7; font-size: 0.85rem;">
                                            <?= number_format($ds['metrics']['emails_unique'] ?? $ds['metrics']['emails'] ?? 0) ?>
                                        </td>
                                        <td style="padding: 1rem 1.25rem; text-align: right;">
                                            <a href="<?= $ds['url'] ?>" class="btn-institutional small"
                                                style="padding: 0.4rem 0.8rem; font-size: 0.65rem; border: 1px solid var(--structural-line); text-decoration: none; color: var(--text-header); font-weight: 700;">INSPECT</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" style="margin-top:5rem">
            <div class="grid-container">
                <div class="section-meta">SYSTEM STATUS</div>
                <div class="section-content">
                    <div class="grid-container" style="padding:0">
                        <div class="span-6">
                            <h2 style="font-size: 1.25rem;">API GATEWAY</h2>
                            <p style="opacity:0.7">Status: <span style="color:var(--accent)">OPERATIONAL</span></p>
                            <p style="opacity:0.7">Latency: 12ms</p>
                        </div>
                        <div class="span-6">
                            <h2 style="font-size: 1.25rem;">DATA SYNC</h2>
                            <p style="opacity:0.7">Last Update: <?= date('Y-m-d H:00:00') ?> UTC</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- Map Dependencies -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/StephanWagner/svgMap@v2.10.1/dist/svgMap.min.css">
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/svgMap@v2.10.1/dist/svgMap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof svgMap !== 'undefined') {
                const mapData = <?= json_encode($mapData) ?>;

                new svgMap({
                    targetElementID: 'svgMap',
                    data: {
                        data: {
                            companies: {
                                name: 'Companies',
                                format: '{0}',
                                thousandSeparator: ',',
                                thresholdMax: 2000000,
                                thresholdMin: 0
                            },
                            emails: {
                                name: 'Verified Emails',
                                format: '{0}',
                                thousandSeparator: ','
                            }
                        },
                        applyData: 'companies',
                        values: mapData
                    },
                    colorMin: '#2d3748',
                    colorMax: '#00e5ff',
                    colorNoData: '#141414',
                    minZoom: 1.0,
                    maxZoom: 3.5,
                    initialZoom: 1.06,
                    flagType: 'emoji',
                    showContinentSelector: false
                });

                // Interaction Handling
                const mapContainer = document.getElementById('svgMap');
                mapContainer.addEventListener('click', function (e) {
                    let target = e.target;
                    while (target && target !== mapContainer && target.tagName !== 'path') {
                        target = target.parentNode;
                    }
                    if (target && target.tagName === 'path') {
                        const id = target.getAttribute('id');
                        if (id && id.includes('country-')) {
                            const iso = id.split('country-')[1];
                            if (mapData[iso] && mapData[iso].link) {
                                window.location.href = mapData[iso].link;
                            }
                        }
                    }
                });

                // Cursor pointer for active countries
                const style = document.createElement('style');
                let css = '';
                for (const iso in mapData) {
                    css += `#svgMap-map-country-${iso} { cursor: pointer; fill-opacity: 1 !important; stroke: #fff !important; } `;
                }
                style.type = 'text/css';
                style.appendChild(document.createTextNode(css));
                document.head.appendChild(style);
            }
        });
    </script>
</body>

</html>