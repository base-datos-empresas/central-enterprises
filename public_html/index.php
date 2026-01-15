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
    <link rel="stylesheet" href="assets/titan.css?v=100">
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

    // Sort by verified companies count (descending)
    uasort($groupedCatalog, function ($a, $b) {
        return ($b['metrics']['companies'] ?? 0) <=> ($a['metrics']['companies'] ?? 0);
    });
    ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">GLOBAL REGISTRY FOUNDATION</div>
                <h1 class="hero-title">
                    The Reference <br> Layer for Global <br> Business Reality.
                </h1>
                <div class="hero-desc" style="max-width: 800px;">
                    Central.Enterprises provides the definitive CC0 reference layer for business identity.
                    <strong>Open Data as Critical Infrastructure.</strong> Neutral, open-source protocol for global
                    economic transparency.
                </div>
            </div>
        </header>

        <section class="section map-section" style="padding-top: 4rem; position: relative;">
            <div class="grid-container">
                <div class="span-12">
                    <div id="svgMap"
                        style="margin-top: 2rem; margin-bottom: 2rem; min-height: 500px; background: transparent;">
                    </div>
                </div>
            </div>
        </section>

        <section id="infrastructure" class="section" style="padding-top: 10rem; position: relative; z-index: 10;">
            <div class="grid-container">
                <div class="section-meta">INFRASTRUCTURE</div>
                <div class="span-8">
                    <h2 class="section-title">Global Data infrastructure.</h2>
                    <p style="font-size: 1.25rem; line-height: 1.6; opacity: 0.8; margin-bottom: 2rem;">
                        Open data is not a trend. It is infrastructure. We believe that company data must be accessible,
                        verifiable, and useful at scale.
                    </p>
                    <p style="opacity: 0.7; line-height: 1.8; margin-bottom: 2rem;">
                        The Central.Enterprises Foundation eliminates technical and economic friction in accessing
                        corporate reality. We standardize global commercial registries into a unified reference layer,
                        enabling researchers and developers to build on absolute transparency.
                    </p>
                </div>
            </div>
        </section>

        <section class="section"
            style="padding-top: 5rem; background: rgba(var(--accent-rgb), 0.02); position: relative; z-index: 10;">
            <div class="grid-container">
                <div class="span-4">
                    <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; color: var(--accent);">Architectural Stability.
                    </h2>
                    <p style="font-size: 0.9rem; opacity: 0.7;">We treat quality as an engineering discipline. Every
                        dataset is versioned, standardized, and published with cryptographic integrity proofs.</p>
                </div>
                <div class="span-4">
                    <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; color: var(--accent);">Neutral Access.</h2>
                    <p style="font-size: 0.9rem; opacity: 0.7;">Business information should not be trapped behind
                        proprietary walls. We provide a CC0 core available to everyone, from startups to public
                        institutions.</p>
                </div>
                <div class="span-4">
                    <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; color: var(--accent);">Global Reach.</h2>
                    <p style="font-size: 0.9rem; opacity: 0.7;">Covering 44+ jurisdictions with a single unified schema.
                        One protocol, infinite possibilities for economic development.</p>
                </div>
            </div>
        </section>

        <section class="section" style="padding-top: 8rem;">
            <div class="grid-container">
                <div class="section-meta">THE STANDARD</div>
                <div class="span-8">
                    <h2 class="section-title" style="font-size: 2.5rem;">Technical Specification v1.1</h2>
                    <p style="font-size: 1.1rem; opacity: 0.7; line-height: 1.7; margin-bottom: 2rem;">Our immutable
                        37-column schema ensures that data from Madrid, New York, and Jakarta can be processed by the
                        same machine-learning models without modification.</p>
                    <a href="/standard/" class="btn-institutional primary">View Specification →</a>
                </div>
            </div>
        </section>

        <section class="section" style="padding-top: 8rem; border-top: 1px solid var(--structural-line);">
            <div class="grid-container">
                <div class="span-6">
                    <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem;">Ethical Data Stewardship</h2>
                    <p style="opacity: 0.7; margin-bottom: 2rem;">We distinguish between organization data and personal
                        privacy. Our stewardship model focuses on transparency for legal entities while strictly masking
                        sensitive individual endpoints.</p>
                </div>
                <div class="span-6">
                    <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem;">Universal Data Scale</h2>
                    <p style="opacity: 0.7; margin-bottom: 2rem;">Managing over 12 million verified signals across 11
                        million corporate entities. We provide the scale required for global supply chain analysis and
                        economic research.</p>
                </div>
            </div>
        </section>

        <section class="section" style="padding-top: 0;">
            <div class="grid-container">
                <div class="section-meta">GLOBAL DATASET CATALOG</div>
                <div
                    style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem; margin-top: 2rem;">
                    <div>
                        <h2 class="section-title" style="margin-bottom: 0.5rem;">Global Corporate Intelligence.</h2>
                        <p style="opacity: 0.6; font-size: 0.9rem;">Select a jurisdiction to inspect verified entities
                            and market signals.</p>
                    </div>
                    <div style="position: relative; width: 300px; margin-bottom: 2rem;">
                        <input type="text" id="catalogSearch" placeholder="SEARCH JURISDICTIONS..."
                            style="width: 100%; background: var(--bg-secondary); border: 1px solid var(--structural-line); padding: 0.75rem 1rem; color: var(--text-header); font-family: var(--font-header); font-size: 0.7rem; letter-spacing: 0.1em; border-radius: 0; outline: none; transition: border-color 0.3s;"
                            onfocus="this.style.borderColor='var(--accent)'"
                            onblur="this.style.borderColor='var(--structural-line)'">
                    </div>
                </div>

                <div class="span-12" style="margin-top: 2rem;">
                    <h2 class="section-title" style="font-size: 1.5rem; margin-bottom: 1.5rem;">The Reference Layer for
                        44+ Jurisdictions.</h2>
                    <p style="max-width: 800px; margin-bottom: 2rem; opacity: 0.7;">We normalize local government
                        identifiers and digital presence signals into a single, predictable format. Our standard v1.1
                        ensures total interoperability across borders.</p>
                    <div
                        style="background: var(--bg-secondary); border: 1px solid var(--structural-line); overflow: hidden; border-radius: 4px;">
                        <div style="overflow-x: auto;">
                            <!-- Table remains here -->
                            <table class="titan-table" style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 2px solid var(--accent); background: rgba(0,0,0,0.4);">
                                        <th
                                            style="padding: 1.5rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; color: var(--text-header); text-align: left; letter-spacing: 0.1em;">
                                            Jurisdiction</th>
                                        <th
                                            style="padding: 1.5rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; color: var(--text-muted); text-align: left; letter-spacing: 0.1em;">
                                            ISO</th>
                                        <th
                                            style="padding: 1.5rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; color: var(--text-muted); text-align: right; letter-spacing: 0.1em;">
                                            Empresas</th>
                                        <th
                                            style="padding: 1.5rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; color: var(--text-muted); text-align: right; letter-spacing: 0.1em;">
                                            Signals (Emails)</th>
                                        <th
                                            style="padding: 1.5rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; color: var(--text-muted); text-align: right; letter-spacing: 0.1em;">
                                            Websites</th>
                                        <th
                                            style="padding: 1.5rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; color: var(--text-muted); text-align: right; letter-spacing: 0.1em;">
                                            Protocol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($groupedCatalog as $name => $ds): ?>
                                        <tr style="border-bottom: 1px solid var(--structural-line); transition: all 0.2s;"
                                            onmouseover="this.style.background='rgba(59, 130, 246, 0.05)'"
                                            onmouseout="this.style.background='transparent'">
                                            <td style="padding: 1.25rem; font-weight: 800;">
                                                <a href="<?= $ds['url'] ?>"
                                                    style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 1rem;">
                                                    <span
                                                        style="width: 8px; height: 8px; background: var(--accent); border-radius: 0;"></span>
                                                    <?= strtoupper($name) ?>
                                                </a>
                                            </td>
                                            <td
                                                style="padding: 1.25rem; font-family: monospace; opacity: 0.4; font-size: 0.8rem;">
                                                <?= $ds['iso'] ?>
                                            </td>
                                            <td
                                                style="padding: 1.25rem; text-align: right; font-family: 'Sora', sans-serif; font-size: 0.9rem; font-weight: 600;">
                                                <?= number_format($ds['metrics']['companies']) ?>
                                            </td>
                                            <td
                                                style="padding: 1.25rem; text-align: right; font-family: 'Inter', sans-serif; opacity: 0.6; font-size: 0.75rem;">
                                                <?= number_format($ds['metrics']['emails_unique'] ?? $ds['metrics']['emails'] ?? 0) ?>
                                            </td>
                                            <td
                                                style="padding: 1.25rem; text-align: right; font-family: 'Inter', sans-serif; opacity: 0.6; font-size: 0.75rem;">
                                                <?= number_format($ds['metrics']['web_domains'] ?? 0) ?>
                                            </td>
                                            <td style="padding: 1.25rem; text-align: right;">
                                                <a href="<?= $ds['url'] ?>" class="btn-institutional secondary"
                                                    style="padding: 0.5rem 1rem; font-size: 0.6rem; border-color: var(--structural-line); text-decoration: none; color: var(--text-header); font-weight: 800; border-radius: 0;">ACCESS
                                                    LAYER →</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>

        <section class="section" style="padding-top: 15rem; border-top: 1px solid var(--structural-line);">
            <div class="grid-container">
                <div class="section-meta">INSTITUTIONAL COMMITMENT</div>
                <div class="span-8">
                    <h2 class="section-title">A Shared Reality for the Global Economy.</h2>
                    <p style="font-size: 1.1rem; opacity: 0.7; line-height: 1.7;">Our goal is to be the reference layer:
                        the place people point to to understand the business reality of a region. We publish data that
                        other systems can depend on, built with engineering discipline and published with absolute
                        responsibility.</p>
                </div>
            </div>
        </section>

        <section class="section" style="padding-top: 8rem; border-top: 1px solid var(--structural-line);">
            <div class="grid-container">
                <div class="span-4">
                    <h2 style="font-size: 1.25rem; margin-bottom: 1.5rem; color: var(--accent);">Engineering Discipline.
                    </h2>
                    <p style="font-size: 0.85rem; opacity: 0.6; line-height: 1.6;">We don't just scrape data; we
                        engineer it. Every record undergoes a validation pipeline that checks for syntactic correctness,
                        temporal freshness, and cross-reference validity before reaching the reference layer.</p>
                </div>
                <div class="span-4">
                    <h2 style="font-size: 1.25rem; margin-bottom: 1.5rem; color: var(--accent);">Global
                        Interoperability.</h2>
                    <p style="font-size: 0.85rem; opacity: 0.6; line-height: 1.6;">By normalizing disparate
                        jurisdictional formats into the SuperDataCloud Standard, we enable cross-border economic
                        analysis that was previously impossible without significant manual labor.</p>
                </div>
                <div class="span-4">
                    <h2 style="font-size: 1.25rem; margin-bottom: 1.5rem; color: var(--accent);">Cryptographic Trust.
                    </h2>
                    <p style="font-size: 0.85rem; opacity: 0.6; line-height: 1.6;">The foundation is working towards
                        implementing cryptographic hashing for all dataset versions, ensuring that the data you consume
                        today can be audited for integrity years into the future.</p>
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
                    colorNoData: 'rgba(0,0,0,0)', /* TRUE TRANSPARENCY */
                    minZoom: 1.0,
                    maxZoom: 3.5,
                    initialZoom: 1.06,
                    flagType: 'emoji',
                    showContinentSelector: false
                });

                // Interaction Handling
                const mapContainer = document.getElementById('svgMap');

                // Trigger resize calculation for responsive libs
                window.addEventListener('resize', () => {
                    if (window.svgMapInstance) { /* No-op or re-init if needed */ }
                });

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
                    css += `#svgMap-map-country-${iso} { cursor: pointer; } `;
                }
                style.type = 'text/css';
                style.appendChild(document.createTextNode(css));
                document.head.appendChild(style);
            }
            document.head.appendChild(style);
        }

            // Force Resize Calculation
            window.addEventListener('resize', function () {
            const mapWrapper = document.querySelector('.svgMap-map-wrapper');
            if (mapWrapper) {
                mapWrapper.style.width = '100%';
                mapWrapper.style.height = 'auto';
            }
        });
        });
        // Catalog Table Filter
        const searchInput = document.getElementById('catalogSearch');
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const query = this.value.toLowerCase();
                const rows = document.querySelectorAll('.titan-table tbody tr');

                rows.forEach(row => {
                    const countryName = row.querySelector('td:first-child').textContent.toLowerCase();
                    const iso = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                    if (countryName.includes(query) || iso.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    </script>
</body>

</html>