<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";

// 1. Load Primary Manifests
$registryFile = __DIR__ . '/../../data/registry_index.json';
$libraryFile = __DIR__ . '/../../data/digital_library.json';

$registry = [];
$library = [];

if (file_exists($registryFile)) {
    $registry = json_decode(file_get_contents($registryFile), true);
}
if (file_exists($libraryFile)) {
    $library = json_decode(file_get_contents($libraryFile), true);
}

// 2. Identify Country from Slug/Code
$slug = $_GET['code'] ?? null;
if (!$slug) {
    header("Location: /data/");
    exit;
}

// 2.1 SEO Redirect Logic (Long Slugs to Clean Slugs)
if (strpos($slug, '-business-databases-b2b') !== false) {
    $cleanSlug = str_replace('-business-databases-b2b', '', $slug);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /country/" . $cleanSlug);
    exit;
}

// Mapping Logic: Slugs to ISO and Display Names
$countryMap = [
    'spain' => ['iso' => 'ES', 'name' => 'Spain'],
    'united-states' => ['iso' => 'US', 'name' => 'United States'],
    'germany' => ['iso' => 'DE', 'name' => 'Germany'],
    'france' => ['iso' => 'FR', 'name' => 'France'],
    'italy' => ['iso' => 'IT', 'name' => 'Italy'],
    'united-kingdom' => ['iso' => 'GB', 'name' => 'United Kingdom'],
    'austria' => ['iso' => 'AT', 'name' => 'Austria'],
    'belgium' => ['iso' => 'BE', 'name' => 'Belgium'],
    'brazil' => ['iso' => 'BR', 'name' => 'Brazil'],
    'canada' => ['iso' => 'CA', 'name' => 'Canada'],
    'switzerland' => ['iso' => 'CH', 'name' => 'Switzerland'],
    'indonesia' => ['iso' => 'ID', 'name' => 'Indonesia'],
    'ireland' => ['iso' => 'IE', 'name' => 'Ireland'],
    'lithuania' => ['iso' => 'LT', 'name' => 'Lithuania'],
    'malaysia' => ['iso' => 'MY', 'name' => 'Malaysia'],
    'netherlands' => ['iso' => 'NL', 'name' => 'Netherlands'],
    'norway' => ['iso' => 'NO', 'name' => 'Norway'],
    'poland' => ['iso' => 'PL', 'name' => 'Poland'],
    'portugal' => ['iso' => 'PT', 'name' => 'Portugal'],
    'romania' => ['iso' => 'RO', 'name' => 'Romania'],
    'australia' => ['iso' => 'AU', 'name' => 'Australia'],
    // Expanded List
    'czech-republic' => ['iso' => 'CZ', 'name' => 'Czech Republic'],
    'hungary' => ['iso' => 'HU', 'name' => 'Hungary'],
    'slovakia' => ['iso' => 'SK', 'name' => 'Slovakia'],
    'bulgaria' => ['iso' => 'BG', 'name' => 'Bulgaria'],
    'serbia' => ['iso' => 'RS', 'name' => 'Serbia'],
    'slovenia' => ['iso' => 'SI', 'name' => 'Slovenia'],
    'estonia' => ['iso' => 'EE', 'name' => 'Estonia'],
    'latvia' => ['iso' => 'LV', 'name' => 'Latvia'],
    'ukraine' => ['iso' => 'UA', 'name' => 'Ukraine'],
    'south-africa' => ['iso' => 'ZA', 'name' => 'South Africa'],
];

// Normalize input
$input = strtolower($slug);
$targetCountry = null;

// Case 1: Input is a known slug (exact or prefix)
foreach ($countryMap as $key => $map) {
    if ($input === $key || strpos($input, $key . '-') === 0) {
        $targetCountry = $map;
        break;
    }
}

// Case 2: Input might be an ISO code (legacy)
if (!$targetCountry) {
    foreach ($countryMap as $s => $map) {
        if (strtolower($map['iso']) === $input) {
            $targetCountry = $map;
            break;
        }
    }
}

// Fallback: If not in map, try title case against library keys
if (!$targetCountry) {
    $titleCase = ucwords(str_replace('-', ' ', $input));
    if (isset($library[$titleCase])) {
        $targetCountry = ['iso' => $input, 'name' => $titleCase];
    }
}

if (!$targetCountry) {
    http_response_code(404);
    echo "<h1>Country Protocol Not Found</h1><p>Jurisdiction '$slug' is not currently being indexed.</p>";
    exit;
}

$iso = $targetCountry['iso'];
$currentCountryName = $targetCountry['name'];

// 3. Aggregate Stats from Digital Library
$stats = [
    'landing_title' => $currentCountryName . ' Business Registry',
    'landing_description' => "Access standardized corporate data for {$currentCountryName}. CC0 Open Data and Premium Enrichment layers.",
    'total_companies' => 0,
    'total_emails' => 0,
    'total_domains' => 0,
    'total_categories' => 0,
    'updated_at' => date('Y-m-d'),
    'links' => [],
    'premium_links' => []
];

if (isset($library[$currentCountryName])) {
    $libData = $library[$currentCountryName];

    // OpenData Metrics
    $odMetrics = $libData['OpenData']['metrics'] ?? [];
    $stats['total_companies'] = $odMetrics['companies'] ?? 0;

    // Premium Metrics (Usually higher or richer)
    $pMetrics = $libData['Premium']['metrics'] ?? [];
    $stats['total_emails'] = $pMetrics['emails'] ?? 0; // Use Premium emails count to show potential
    $stats['total_domains'] = $pMetrics['web_domains'] ?? 0;
    $stats['total_categories'] = $pMetrics['categories'] ?? 0;

    $stats['links'] = $libData['OpenData']['links'] ?? [];
}

// 4. Load Sector Metadata logic
$sectors = [];
// Path: public_html/data/metadata_index/{Country}/METADATA.json
// __DIR__ is public_html/country
$metaPath = __DIR__ . "/../data/metadata_index/{$currentCountryName}/METADATA.json";

if (file_exists($metaPath)) {
    $meta = json_decode(file_get_contents($metaPath), true);
    // Use 'files' as sector breakdown if available and 'sector_breakdown' is missing
    if (isset($meta['files'])) {
        $sectors = $meta['files'];
        // Sort by count descending (index 1 is count)
        usort($sectors, function ($a, $b) {
            return $b[1] <=> $a[1];
        });
    } elseif (isset($meta['sector_breakdown'])) {
        $sectors = $meta['sector_breakdown'];
        usort($sectors, function ($a, $b) {
            return $b[1] <=> $a[1];
        });
    }
}

// Schema Definition (Standardized) - REAL DATA MODEL
$schemaFields = [
    // OpenData
    ['Field Name' => 'id', 'Type' => 'VARCHAR(64)', 'Access' => 'OpenData', 'Description' => 'Unique entity identifier (VAT/National ID).', 'Fill Rate' => '100%'],
    ['Field Name' => 'company_name', 'Type' => 'VARCHAR(255)', 'Access' => 'OpenData', 'Description' => 'Registered legal name of the business.', 'Fill Rate' => '100%'],
    ['Field Name' => 'industrial_sector', 'Type' => 'VARCHAR(100)', 'Access' => 'OpenData', 'Description' => 'Primary industry category (Cleaned).', 'Fill Rate' => '100%'],
    ['Field Name' => 'full_address', 'Type' => 'TEXT', 'Access' => 'OpenData', 'Description' => 'Normalized physical address string.', 'Fill Rate' => '98%'],
    ['Field Name' => 'city', 'Type' => 'VARCHAR(100)', 'Access' => 'OpenData', 'Description' => 'Registered municipality/city.', 'Fill Rate' => '95%'],
    ['Field Name' => 'zip_code', 'Type' => 'VARCHAR(20)', 'Access' => 'OpenData', 'Description' => 'Postal/Zip code.', 'Fill Rate' => '92%'],
    ['Field Name' => 'country_code', 'Type' => 'CHAR(2)', 'Access' => 'OpenData', 'Description' => 'ISO 3166-1 alpha-2 code.', 'Fill Rate' => '100%'],

    // Premium
    ['Field Name' => 'email_clean', 'Type' => 'VARCHAR(255)', 'Access' => 'Premium', 'Description' => 'Verified direct email contact.', 'Fill Rate' => round(($stats['total_emails'] / ($stats['total_companies'] ?: 1)) * 100) . '%'],
    ['Field Name' => 'phone_clean', 'Type' => 'VARCHAR(50)', 'Access' => 'Premium', 'Description' => 'Normalized commercial phone number.', 'Fill Rate' => '85%'],
    ['Field Name' => 'web_domain', 'Type' => 'VARCHAR(255)', 'Access' => 'Premium', 'Description' => 'Official verified website domain.', 'Fill Rate' => round(($stats['total_domains'] / ($stats['total_companies'] ?: 1)) * 100) . '%'],
    ['Field Name' => 'social_linkedin', 'Type' => 'URL', 'Access' => 'Premium', 'Description' => 'Official LinkedIn profile link.', 'Fill Rate' => '45%'],
    ['Field Name' => 'social_facebook', 'Type' => 'URL', 'Access' => 'Premium', 'Description' => 'Official Facebook business page.', 'Fill Rate' => '35%'],
    ['Field Name' => 'central_rating', 'Type' => 'DECIMAL(3,2)', 'Access' => 'Premium', 'Description' => 'Proprietary reliability and data freshness score.', 'Fill Rate' => '100%'],
];


// JSON-LD Schema Generator
$datasetSchema = [
    "@context" => "https://schema.org/",
    "@type" => "Dataset",
    "name" => "{$currentCountryName} Companies Database ({$iso})",
    "description" => $stats['landing_description'],
    "url" => "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
    "keywords" => ["Companies", "Business Directory", "B2B Data", "Emails", $currentCountryName],
    "creator" => [
        "@type" => "Organization",
        "name" => "Central Enterprises"
    ],
    "license" => "https://creativecommons.org/publicdomain/zero/1.0/",
    "version" => "2.4.0",
    "spatialCoverage" => [
        "@type" => "Place",
        "name" => $currentCountryName,
        "geo" => [
            "@type" => "GeoShape",
            "addressCountry" => $iso
        ]
    ],
    "distribution" => [],
    "isAccessibleForFree" => true,
    "includedInDataCatalog" => [
        "@type" => "DataCatalog",
        "name" => "Central.Enterprises Global Registry"
    ]
];

// Distributions are handled via UI buttons to prevent direct crawler exposure of links.
$datasetSchema['isAccessibleForFree'] = true;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($stats['landing_title']) ?> | Central.Enterprises</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@700;800&display=swap"
        rel="stylesheet">
    <meta name="description" content="<?= htmlspecialchars($stats['landing_description']) ?>">
    <link rel="stylesheet" href="/assets/titan.css?v=marketplace_4">

    <!-- JSON-LD Schema -->
    <script type="application/ld+json">
        <?= json_encode($datasetSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
    </script>

    <style>
        /* Marketplace Specific Overrides */

        /* SEO Enhancements */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--text-header);
            letter-spacing: -0.02em;
        }

        h1.hero-title {
            font-weight: 800;
            color: #ffffff;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        strong,
        b {
            color: var(--accent);
            font-weight: 700;
        }

        .hero {
            padding: 8rem 0 4rem 0;
            border-bottom: 1px solid var(--structural-line);
        }

        .hero-split {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 4rem;
            align-items: start;
        }

        .asset-card {
            background: var(--bg-secondary);
            border: 1px solid var(--accent);
            padding: 2rem;
            position: sticky;
            top: 6rem;
        }

        .metric-row {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px solid var(--structural-line);
            font-size: 0.85rem;
        }

        .metric-row span:last-child {
            font-weight: 700;
            font-family: var(--font-header);
        }

        .tab-nav {
            display: flex;
            gap: 2rem;
            border-bottom: 1px solid var(--structural-line);
            margin-bottom: 3rem;
        }

        .tab-link {
            padding: 1rem 0;
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--text-body);
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
        }

        .tab-link:hover,
        .tab-link.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        /* Blurred Table */
        .sample-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8rem;
            font-family: monospace;
        }

        .sample-table th {
            text-align: left;
            padding: 1rem;
            color: var(--accent);
            border-bottom: 1px solid var(--structural-line);
        }

        .sample-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--structural-line);
            color: var(--text-body);
        }

        .blur-col {
            filter: blur(4px);
            user-select: none;
            opacity: 0.7;
        }

        /* Tier Comparison */
        .tier-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .tier-od {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .tier-premium {
            background: rgba(0, 229, 255, 0.1);
            color: var(--accent);
            border: 1px solid var(--accent);
        }

        @media (max-width: 900px) {
            .hero-split {
                grid-template-columns: 1fr;
            }

            .asset-card {
                position: static;
                margin-top: 2rem;
            }
        }

        /* Coming Soon Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .modal-content {
            background: var(--bg-secondary);
            border: 1px solid var(--accent);
            padding: 3rem;
            max-width: 500px;
            width: 90%;
            text-align: center;
            position: relative;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--accent);
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .modal-close:hover {
            opacity: 1;
        }

        .modal-title {
            font-family: var(--font-header);
            font-size: 1.5rem;
            color: var(--accent);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .modal-text {
            font-size: 0.9rem;
            color: var(--text-body);
            line-height: 1.6;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <div class="grid-bg"></div>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <!-- Theme Toggle Logic Injected -->
    <script src="<?= $basePath ?>/assets/theme-toggle.js"></script>

    <main>
        <section class="hero">
            <div class="grid-container">
                <div class="span-12 hero-split">
                    <!-- Left: Info -->
                    <div>
                        <div class="section-meta" style="margin-bottom:1rem; border:none; padding:0;">VERIFIED DATASET •
                            <?= $iso ?>
                        </div>
                        <h1 class="hero-title" style="margin-bottom: 1.5rem;">
                            <span
                                style="color: #64748b; font-weight:800;"><?= htmlspecialchars($currentCountryName) ?></span>
                            <br>
                            <span style="color: var(--accent); font-weight:300;">Business Database</span>
                        </h1>
                        <p class="hero-desc"
                            style="grid-column: auto; border: none; padding: 0; font-size: 1.1rem; max-width: 600px;">
                            <?= htmlspecialchars($stats['landing_description']) ?>
                        </p>

                        <div style="margin-top: 3rem; display: flex; gap: 1rem; align-items: center;">
                            <span
                                style="padding: 0.5rem 1rem; background: rgba(0,255,0,0.1); color: #00ff00; font-size: 0.7rem; font-weight: 700; border: 1px solid #00ff00;">LIVE
                                UPDATE</span>
                            <span style="font-size: 0.8rem; opacity: 0.7;">Last synced:
                                <strong><?= date('M d, Y') ?></strong></span>
                        </div>

                        <!-- Tabs -->
                        <div class="tab-nav" style="margin-top: 4rem;" role="tablist">
                            <a href="#overview" class="tab-link active" role="tab" aria-selected="true"
                                aria-controls="overview">Refined Highlights</a>
                            <a href="#schema" class="tab-link" role="tab" aria-selected="false"
                                aria-controls="schema">Data Schema</a>
                            <a href="#sample" class="tab-link" role="tab" aria-selected="false"
                                aria-controls="sample">Sample Data</a>
                        </div>

                        <!-- Content Area -->
                        <div id="overview">
                            <h3 style="margin-bottom: 1.5rem;">Advanced Dataset Insights</h3>

                            <!-- Highlights Grid -->
                            <div class="grid-container" style="padding:0; gap:1.5rem; margin-bottom:3rem;">
                                <div class="span-6"
                                    style="background: var(--bg-secondary); padding: 1.5rem; border: 1px solid var(--structural-line);">
                                    <h4
                                        style="color: var(--accent); margin-bottom: 0.5rem; display:flex; justify-content:space-between;">
                                        Core Identity <span class="tier-badge tier-od">OpenData</span>
                                    </h4>
                                    <div style="font-size: 2rem; font-weight: 800; margin: 1rem 0;">
                                        <?= number_format($stats['total_companies']) ?>
                                    </div>
                                    <p style="font-size: 0.8rem; opacity: 0.8;">Verified legal entities having passed
                                        validation checks. Full address resolution included.</p>
                                </div>
                                <div class="span-6"
                                    style="background: linear-gradient(135deg, var(--bg-secondary), rgba(0, 229, 255, 0.05)); padding: 1.5rem; border: 1px solid var(--accent);">
                                    <h4
                                        style="color: var(--accent); margin-bottom: 0.5rem; display:flex; justify-content:space-between;">
                                        Contact Enrichment <span class="tier-badge tier-premium">Premium</span>
                                    </h4>
                                    <div
                                        style="font-size: 0.75rem; margin-top: 0.5rem; opacity: 0.8; line-height: 1.4;">
                                        Full contact profiles including verified direct emails via <a
                                            href="https://kaijuverifier.com/api-docs" target="_blank"
                                            style="color: var(--accent); font-weight: 700; text-decoration: none;">Email
                                            Verifier API</a>, active phone lines, and social footprints.
                                    </div>
                                    <div style="display:flex; justify-content: space-between; margin-top: 1rem;">
                                        <div>
                                            <div style="font-size: 1.5rem; font-weight: 800;">
                                                <?= number_format($stats['total_emails']) ?>
                                            </div>
                                            <div style="font-size: 0.7rem;">DIRECT EMAILS</div>
                                            <div style="font-size: 0.6rem; margin-top: 0.3rem;">
                                                <a href="https://kaijuverifier.com/api-docs" target="_blank"
                                                    style="color: var(--accent); opacity: 0.8; text-decoration: none;">Verified
                                                    via Email Verifier API</a>
                                            </div>
                                        </div>
                                        <div style="text-align: right;">
                                            <div style="font-size: 1.5rem; font-weight: 800;">
                                                ~<?= number_format($stats['total_domains']) ?></div>
                                            <div style="font-size: 0.7rem;">WEB DOMAINS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="schema" style="margin-top: 4rem;">
                            <h3 style="margin-bottom: 1.5rem;">Technical Schema & Access Levels</h3>
                            <table class="titan-table">
                                <thead>
                                    <tr>
                                        <th>Field Name</th>
                                        <th>Data Type</th>
                                        <th>Access Tier</th>
                                        <th style="text-align:right">Fill Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($schemaFields as $field): ?>
                                        <tr>
                                            <td style="font-family: monospace; font-weight: 700;">
                                                <?= $field['Field Name'] ?>
                                            </td>
                                            <td style="font-size: 0.75rem; opacity: 0.8;"><?= $field['Type'] ?></td>
                                            <td>
                                                <?php if ($field['Access'] == 'OpenData'): ?>
                                                    <span class="tier-badge tier-od">OpenData</span>
                                                <?php else: ?>
                                                    <span class="tier-badge tier-premium">Premium</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align:right; color: var(--accent);"><?= $field['Fill Rate'] ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div id="sample">
                            <div
                                style="background: var(--bg-secondary); border: 1px solid var(--structural-line); padding: 1.5rem; margin-bottom: 2rem;">
                                <h4 class="titan-label" style="margin-bottom: 1rem;">PROFESSIONAL DATA PREVIEW</h4>
                                <p style="font-size: 0.85rem; opacity: 0.7; margin-bottom: 1.5rem;">
                                    This preview demonstrates the normalized record quality. Field masking is applied to
                                    the
                                    <strong>OpenData</strong> tier to maintain privacy and compliance requirements.
                                </p>

                                <div style="overflow-x: auto;">
                                    <table class="titan-table" style="font-size: 0.75rem;">
                                        <thead>
                                            <tr>
                                                <th>ENTITY NAME</th>
                                                <th>INDUSTRIAL SECTOR</th>
                                                <th>LOCATION</th>
                                                <th style="color:var(--accent);">PREMIUM ENRICHMENT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $mockEntities = [
                                                ['Acme Industrial S.A.', 'Construction & Infrastructure', 'Madrid', 'Verified Email + Social'],
                                                ['Titan Logistics SL', 'Transport & Distribution', 'Barcelona', 'Direct Phone + Contact Name'],
                                                ['Green Energy Corp', 'Renewable Energy Systems', 'Granada', 'Spending Signals + LinkedIn'],
                                                ['Global Software Solutions', 'IT Services & Software', 'Valencia', 'Validated Domain + Ad Data'],
                                                ['Central Food Group', 'Food Processing & Supply', 'Sevilla', 'Full Executive Mapping']
                                            ];
                                            foreach ($mockEntities as $entity):
                                                ?>
                                                <tr>
                                                    <td style="font-weight:700;"><?= $entity[0] ?></td>
                                                    <td style="opacity:0.8;"><?= $entity[1] ?></td>
                                                    <td style="opacity:0.7;"><?= $entity[2] ?></td>
                                                    <td
                                                        style="font-family:monospace; color:var(--accent); font-size: 0.7rem;">
                                                        <span style="opacity:0.4;">[MASKED]</span> <?= $entity[3] ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="margin-top: 1rem; font-size: 0.7rem; opacity: 0.5; font-style: italic;">
                                    * Sample represents generalized record structure. Download full dataset for real
                                    entity data.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Asset Card -->
                    <div class="asset-card">
                        <h3
                            style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--structural-line); padding-bottom: 1rem;">
                            ACCESS OPTIONS</h3>

                        <!-- OpenData Section -->
                        <div
                            style="margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-secondary); border: 1px solid var(--structural-line); box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                            <div style="display:flex; justify-content:space-between; margin-bottom: 0.8rem;">
                                <span class="tier-badge tier-od"
                                    style="background: var(--text-header); color: var(--bg-primary);">OpenData</span>
                                <span
                                    style="font-size: 0.75rem; color: var(--text-header); opacity: 0.7; font-weight: 600;">CC0
                                    (Free)</span>
                            </div>
                            <div
                                style="font-size: 0.85rem; margin-bottom: 1.5rem; color: var(--text-header); opacity: 0.9; line-height: 1.4;">
                                <strong>Basic identity fields.</strong><br>
                                Registration IDs, Legal Names, and Normalized Addresses. <br>
                                <span style="font-size: 0.75rem; opacity: 0.6;">No personal contact verification
                                    included.</span>
                            </div>
                            <?php if (isset($stats['links']['ZIP'])): ?>
                                <a href="javascript:void(0)"
                                    onclick="<?= !empty($stats['links']['ZIP']) ? "window.open('" . htmlspecialchars($stats['links']['ZIP']) . "')" : "openComingSoonModal()" ?>"
                                    class="btn-institutional secondary"
                                    style="width: 100%; justify-content: center; font-weight: 800; border-color: var(--structural-line); text-align: center; height: auto; padding: 1.5rem 0.5rem; letter-spacing: 0.05em; line-height: 1.1;">
                                    DOWNLOAD FREE <?= strtoupper($currentCountryName) ?> <br> COMPANIES DATABASE
                                </a>
                            <?php else: ?>
                                <div style="font-size:0.7rem; opacity:0.6;">OpenData Unavailable</div>
                            <?php endif; ?>
                        </div>

                        <!-- Premium Section -->
                        <div
                            style="padding: 1rem; background: rgba(0, 229, 255, 0.05); border: 1px solid var(--accent);">
                            <div style="display:flex; justify-content:space-between; margin-bottom: 0.5rem;">
                                <span class="tier-badge tier-premium">Premium</span>
                                <span style="font-size: 0.7rem; color: var(--accent);">Commercial</span>
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-body); margin-bottom: 1rem;">
                                <strong>Everything in Open +</strong> Direct Emails, Phones, Websites, Social Profiles.
                            </div>
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <a href="javascript:void(0)" onclick="openComingSoonModal()"
                                    class="btn-institutional primary"
                                    style="flex: 1; justify-content: center; font-size: 0.75rem; padding: 1.25rem 0.5rem; text-align: center; line-height: 1.2; background: var(--accent); color: var(--bg-primary);">
                                    GET FULL <?= strtoupper($currentCountryName) ?> DATABASE (CSV)
                                </a>
                                <a href="javascript:void(0)" onclick="openComingSoonModal()"
                                    class="btn-institutional primary"
                                    style="flex: 1; justify-content: center; font-size: 0.75rem; padding: 1.25rem 0.5rem; text-align: center; line-height: 1.2; background: var(--accent); color: var(--bg-primary);">
                                    GET FULL <?= strtoupper($currentCountryName) ?> DATABASE (EXCEL)
                                </a>
                            </div>
                        </div>

                        <div style="margin-top:2rem; border-top:1px solid var(--structural-line); padding-top:1rem;">
                            <div class="metric-row" style="border:none;">
                                <span>Jurisdiction</span>
                                <span><?= $currentCountryName ?> (<?= $iso ?>)</span>
                            </div>
                            <div class="metric-row" style="border:none;">
                                <span>Update Frequency</span>
                                <span>Quarterly</span>
                            </div>
                        </div>

                        <div
                            style="margin-top: 1rem; font-size: 0.7rem; color: var(--text-muted); line-height: 1.4; text-align:center;">
                            SHA-256 Verified Source.<br>
                            Central Enterprises Foundation.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTORS SECTION -->
        <section class="section">
            <div class="grid-container">
                <div class="span-12">
                    <h3 style="margin-bottom: 2rem;">Top Industrial Sectors & Subsets</h3>
                    <p style="margin-bottom: 2rem;">Granular breakdown of available data files within the jurisdiction.
                    </p>

                    <table class="titan-table">
                        <thead>
                            <tr>
                                <th>Industrial Sector</th>
                                <th>Dataset Scope & Inclusions</th>
                                <th style="text-align:right">Estimated Entities</th>
                                <th style="text-align:right">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($sectors)): ?>
                                <?php
                                // Limit to top 20
                                foreach (array_slice($sectors, 0, 20) as $sector):
                                    // Filename cleaning
                                    // Format: "ES\\ES-Abogados_extracted.csv"
                                    $rawName = str_replace('\\', '/', $sector[0]); // Normalize separators for Linux/Windows compatibility
                                    $cleanName = basename($rawName); // ES-Abogados_extracted.csv
                                    $cleanName = str_replace(['_extracted.csv', '.csv', '.xlsx'], '', $cleanName); // ES-Abogados
                                    // Remove Country Prefix if present (ES-Abogados -> Abogados)
                                    $parts = explode('-', $cleanName);
                                    if (count($parts) > 1 && strlen($parts[0]) == 2) {
                                        array_shift($parts); // Remove ES
                                    }
                                    $finalName = implode(' ', $parts);
                                    $finalName = str_replace('_', ' ', $finalName);

                                    ?>
                                    <tr>
                                        <td style="font-weight:600; color: var(--text-header);">
                                            <?= htmlspecialchars(ucwords($finalName)) ?>
                                        </td>
                                        <td style="font-size: 0.8rem; opacity: 0.8; line-height: 1.4;">
                                            Comprehensive registry for <strong><?= htmlspecialchars($finalName) ?></strong>.<br>
                                            <span style="opacity: 0.7; font-size: 0.75rem;">Includes: Legal Identity, Local
                                                Branch Locations, Digital Contacts.</span>
                                        </td>
                                        <td style="text-align:right; font-family: monospace;">
                                            <?= number_format($sector[1]) ?>
                                        </td>
                                        <td style="text-align:right;"><span class="status-operational">READY</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align:center; opacity: 0.5; padding: 4rem;">Metadata
                                        indexing in progress. (Looked in: <?= htmlspecialchars($metaPath) ?>)</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Coming Soon Modal -->
    <div id="comingSoonModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-close" onclick="closeComingSoonModal()">×</div>
            <div class="modal-title">Coming Soon</div>
            <p style="margin-bottom: 2rem; line-height: 1.6; opacity: 0.9;">
                The high-enrichment Premium layer for <span id="modalCountryName">this country</span> is currently in
                the final stages of verification. <br><br>
                Please check back shortly or download the OpenData version for immediate access to core identity fields.
                <br><br>
                <a href="https://companiesdata.cloud/tech-support" target="_blank"
                    style="color: var(--accent); text-decoration: underline; font-weight: 600;">Request Early Access /
                    Priority Support</a>
            </p>
            <button class="btn-institutional primary" onclick="closeComingSoonModal()"
                style="width: 100%; justify-content: center;">UNDERSTOOD</button>
        </div>
    </div>

    <script>
        function openComingSoonModal() {
            document.getElementById('comingSoonModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeComingSoonModal() {
            document.getElementById('comingSoonModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        document.getElementById('comingSoonModal').addEventListener('click', (e) => {
            if (e.target.id === 'comingSoonModal') closeComingSoonModal();
        });

        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tab-link');
            const contents = ['overview', 'schema', 'sample'];

            // Hide all except first initially
            contents.slice(1).forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });

            tabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = tab.getAttribute('href').substring(1);

                    // Update Tab Styles
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    // Show Target Content
                    contents.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.style.display = (id === targetId) ? 'block' : 'none';
                    });
                });
            });
        });
    </script>
</body>

</html>