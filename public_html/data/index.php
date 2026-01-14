<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";

// 1. Load Registry (Digital Library)
$registryFile = __DIR__ . '/../../data/digital_library.json';
$library = [];

if (file_exists($registryFile)) {
    $library = json_decode(file_get_contents($registryFile), true);
} else {
    error_log("Titan Registry: Library file not found at " . $registryFile);
}

// 2. ISO Mapping (Ensure correct map rendering)
$isoMap = [
    'Spain' => 'ES',
    'United States' => 'US',
    'Germany' => 'DE',
    'France' => 'FR',
    'Italy' => 'IT',
    'United Kingdom' => 'GB',
    'Austria' => 'AT',
    'Belgium' => 'BE',
    'Brazil' => 'BR',
    'Canada' => 'CA',
    'Switzerland' => 'CH',
    'Indonesia' => 'ID',
    'Ireland' => 'IE',
    'Lithuania' => 'LT',
    'Malaysia' => 'MY',
    'Netherlands' => 'NL',
    'Norway' => 'NO',
    'Poland' => 'PL',
    'Portugal' => 'PT',
    'Romania' => 'RO',
    'Australia' => 'AU',
    'Chile' => 'CL',
    'Colombia' => 'CO',
    'Mexico' => 'MX',
    'Argentina' => 'AR',
    'Peru' => 'PE',
    'Russia' => 'RU',
    'China' => 'CN',
    'Japan' => 'JP',
    'India' => 'IN',
    'South Korea' => 'KR',
    'Singapore' => 'SG',
    'Sweden' => 'SE',
    'Denmark' => 'DK',
    'Finland' => 'FI',
    'Greece' => 'GR',
    'Turkey' => 'TR',
    'Czech Republic' => 'CZ',
    'Hungary' => 'HU',
    'Slovakia' => 'SK',
    'Croatia' => 'HR',
    'Bulgaria' => 'BG',
    'Serbia' => 'RS',
    'Slovenia' => 'SI',
    'Estonia' => 'EE',
    'Latvia' => 'LV',
    'Ukraine' => 'UA',
    'South Africa' => 'ZA',
    'United Arab Emirates' => 'AE',
    'Saudi Arabia' => 'SA',
    'Thailand' => 'TH',
    'Vietnam' => 'VN',
    'Philippines' => 'PH',
    'New Zealand' => 'NZ',
    'Czechia' => 'CZ',
    'Slovak Republic' => 'SK'
];

// 3. Prepare Catalog Data & Map Data
$groupedCatalog = [];
$mapValues = [];

foreach ($library as $countryName => $tiers) {
    if ($countryName === '_metadata')
        continue;

    $openData = $tiers['OpenData'] ?? null;
    $premium = $tiers['Premium'] ?? null;
    $metrics = $openData['metrics'] ?? ['companies' => 0, 'emails' => 0];

    // Resolve ISO
    $iso = $isoMap[$countryName] ?? strtoupper(substr($countryName, 0, 2));
    $slug = strtolower(str_replace(' ', '-', $countryName));
    $link = "/country/" . $slug;

    $groupedCatalog[$countryName] = [
        'name' => $countryName,
        'iso' => $iso,
        'metrics' => $metrics,
        'links' => $openData['links'] ?? [],
        'updated_at' => $library['_metadata']['last_update'] ?? date('Y-m-d'),
        'slug' => $slug,
        'url' => $link
    ];

    // Prepare Data for Map
    // Ensure we only map valid ISOs (2 characters)
    if (strlen($iso) === 2 && ($metrics['companies'] > 0 || $metrics['emails'] > 0)) {
        $mapValues[$iso] = [
            'companies' => $metrics['companies'],
            'emails' => $metrics['emails'],
            'link' => $link,
            'name' => $countryName
        ];
    }
}

// Sort alphabetically
ksort($groupedCatalog);

// 4. Filter Handling
$filterJurisdiction = $_GET['jurisdiction'] ?? null;

if ($filterJurisdiction) {
    foreach ($groupedCatalog as $name => $data) {
        if (strcasecmp($name, $filterJurisdiction) === 0) {
            $groupedCatalog = [$name => $data];
            break;
        }
    }
}

// 5. SEO
$pageTitle = "Dataset Map & Catalog | Central.Enterprises";
$metaDescription = "Interactive global dataset map. Access verified business registries, company records, and contact data for over 50 jurisdictions.";

if ($filterJurisdiction && count($groupedCatalog) === 1) {
    $ds = current($groupedCatalog);
    $pageTitle = "{$ds['name']} Dataset | Central.Enterprises";
    $metaDescription = "Download verified {$ds['name']} business data. Companies: " . number_format($ds['metrics']['companies']) . ".";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
    <title><?= htmlspecialchars($pageTitle) ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">

    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=12">
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=logo_native">

    <!-- Map Libraries (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/svg-pan-zoom@3.6.1/dist/svg-pan-zoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/svgmap@2.18.1/dist/svgMap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/svgmap@2.18.1/dist/svgMap.min.css" rel="stylesheet">

    <style>
        /* Map Customization for Titan Dark */
        .svgMap-map-wrapper {
            background: transparent !important;
            padding-bottom: 0 !important;
            /* Fix aspect ratio weirdness if needed */
        }

        .svgMap-map-image {
            background: transparent !important;
        }

        .svgMap-country {
            stroke: #333 !important;
            stroke-width: 1px;
            transition: all 0.3s ease;
        }

        .svgMap-tooltip {
            background: rgba(10, 10, 10, 0.95) !important;
            border: 1px solid var(--accent) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
            border-radius: 4px !important;
            font-family: 'Inter', sans-serif !important;
        }

        .svgMap-tooltip .svgMap-tooltip-content-container .svgMap-tooltip-flag-container {
            display: none !important;
            /* Hide flags for cleaner look */
        }

        .svgMap-tooltip-title {
            font-family: 'Sora', sans-serif !important;
            font-weight: 800 !important;
            color: var(--text-header) !important;
            font-size: 1.1rem !important;
            text-transform: uppercase;
        }

        .svgMap-tooltip-content {
            margin-top: 0.5rem;
        }

        .svgMap-tooltip-content table td {
            color: var(--text-muted) !important;
            font-size: 0.85rem !important;
            padding: 2px 5px !important;
        }

        .svgMap-tooltip-content table td span {
            color: var(--accent) !important;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="grid-bg"></div>
    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero" style="padding-bottom: 2rem;">
            <div class="grid-container">
                <div class="section-meta">GLOBAL INTELLIGENCE LAYER</div>
                <h1 class="hero-title">DATASET MAP.</h1>
                <div class="hero-desc">
                    Interactive visualization of sovereign registry coverage. Select a jurisdiction to inspect available
                    datasets.
                </div>
            </div>
        </header>

        <!-- MAP SECTION -->
        <?php if (!$filterJurisdiction): ?>
            <section class="section" style="padding-top: 0;">
                <div class="grid-container">
                    <div class="span-12">
                        <div id="svgMap"
                            style="width: 100%; height: 600px; border: 1px solid var(--structural-line); background: rgba(255,255,255,0.02); border-radius: 8px;">
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- SEARCH -->
        <div class="test-search-container"
            style="background:var(--bg-secondary); border-top:1px solid var(--structural-line); border-bottom:1px solid var(--structural-line); margin-top: 2rem;">
            <div class="grid-container" style="padding: 1rem 2rem;">
                <input type="text" id="catalog-search" placeholder="SEARCH CATALOG (e.g. 'Spain', 'Companies')..."
                    class="titan-input"
                    style="font-size:1.2rem; padding:1.5rem; background:transparent; border:none; width:100%; color:var(--text-header);">
            </div>
        </div>

        <!-- TABLE SECTION -->
        <section class="section">
            <div class="grid-container">
                <!-- TABLE VIEW -->
                <?php if (!$filterJurisdiction): ?>
                    <div class="span-12">
                        <div
                            style="background: var(--bg-secondary); border: 1px solid var(--structural-line); overflow: hidden;">
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
                                            Verified Entities</th>
                                        <th
                                            style="padding: 1.5rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; color: var(--text-muted); text-align: right; letter-spacing: 0.1em;">
                                            Market Context</th>
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
                                                <?= $ds['iso'] ?></td>
                                            <td
                                                style="padding: 1.25rem; text-align: right; font-family: 'Sora', sans-serif; font-size: 0.9rem; font-weight: 600;">
                                                <?= number_format($ds['metrics']['companies']) ?>
                                            </td>
                                            <td
                                                style="padding: 1.25rem; text-align: right; font-family: 'Inter', sans-serif; opacity: 0.6; font-size: 0.75rem;">
                                                <?= number_format($ds['metrics']['emails_unique'] ?? $ds['metrics']['emails'] ?? 0) ?>
                                                Signals
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
                <?php else: ?>
                    <!-- SINGLE COUNTRY VIEW (Legacy fallback or specific view) -->
                    <?php $ds = current($groupedCatalog); ?>
                    <div class="span-12" style="margin-top: 2rem;">
                        <a href="<?= $basePath ?>/data" style="margin-bottom:2rem; display:block;">← Back to Map</a>
                        <h2 class="section-title"><?= $ds['name'] ?></h2>
                        <a href="<?= $ds['url'] ?>" class="btn-institutional primary">Go to Country Page</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>

    <!-- Theme Toggle Logic -->
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=2"></script>

    <!-- Map Initialization Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Only init map if container exists
            if (document.getElementById('svgMap')) {
                var mapData = <?= json_encode($mapValues) ?>;

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
                                name: 'Emails',
                                format: '{0}',
                                thousandSeparator: ','
                            }
                        },
                        applyData: 'companies',
                        values: mapData
                    },
                    colorMin: '#2d3748',
                    colorMax: '#00e5ff', // Titan Accent Cyan
                    colorNoData: '#141414',
                    minZoom: 1.0,
                    maxZoom: 3.5,
                    initialZoom: 1.06,
                    flagType: 'emoji', // Lightweight
                    showContinentSelector: false,
                });

                // Custom Click Handling for Navigation
                var mapContainer = document.getElementById('svgMap');
                mapContainer.addEventListener('click', function (e) {
                    var target = e.target;
                    while (target && target !== mapContainer && target.tagName !== 'path') {
                        target = target.parentNode;
                    }

                    if (target && target.tagName === 'path') {
                        var id = target.getAttribute('id');
                        if (id && id.includes('country-')) {
                            var iso = id.split('country-')[1]; // ES
                            if (mapData[iso] && mapData[iso].link) {
                                window.location.href = mapData[iso].link;
                            }
                        }
                    }
                });

                // Add cursor pointer styles dynamically
                var styleElement = document.createElement('style');
                var css = '';
                for (var iso in mapData) {
                    css += '#svgMap-map-country-' + iso + ' { cursor: pointer; fill-opacity: 1 !important; stroke: #fff !important; } ';
                }
                styleElement.type = 'text/css';
                styleElement.appendChild(document.createTextNode(css));
                document.head.appendChild(styleElement);
            }

            // Search Filter
            document.getElementById('catalog-search').addEventListener('input', function (e) {
                const term = e.target.value.toLowerCase();
                document.querySelectorAll('table.titan-table tbody tr').forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(term) ? 'table-row' : 'none';
                });
            });
        });
    </script>
</body>

</html>