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
    'links' => []
];

if (isset($library[$currentCountryName])) {
    $libData = $library[$currentCountryName];
    // Use OpenData metrics if available, otherwise Premium
    $metrics = $libData['OpenData']['metrics'] ?? $libData['Premium']['metrics'] ?? [];
    $stats['total_companies'] = $metrics['companies'] ?? 0;
    $stats['total_emails'] = $metrics['emails'] ?? 0;
    $stats['total_domains'] = $metrics['web_domains'] ?? 0;
    $stats['total_categories'] = $metrics['categories'] ?? 0;
    $stats['links'] = $libData['OpenData']['links'] ?? [];
}

// 4. Load Sector Metadata (The "Perfect Landing" Data)
$sectors = [];
// Path convention: Outputs/{CountryName}/{CountryName}-OpenData/METADATA.json
$metaFile = __DIR__ . "/../../Outputs/{$currentCountryName}/{$currentCountryName}-OpenData/METADATA.json";
if (file_exists($metaFile)) {
    $meta = json_decode(file_get_contents($metaFile), true);
    if (isset($meta['sector_breakdown'])) {
        $sectors = $meta['sector_breakdown'];
        // Sort by count descending
        usort($sectors, function ($a, $b) {
            return $b[1] <=> $a[1];
        });
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($stats['landing_title']) ?> | Central.Enterprises</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <meta name="description" content="<?= htmlspecialchars($stats['landing_description']) ?>">
    <link rel="stylesheet" href="/assets/titan.css?v=seo_1">
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main>
        <header class="hero" style="padding: 6rem 0 4rem 0;">
            <div class="grid-container">
                <div class="span-12">
                    <span class="feature-num" style="font-size: 1rem;"><?= $iso ?>-INFRA-<?= date('Y') ?></span>
                    <h1 class="hero-title"><?= htmlspecialchars($currentCountryName) ?> <br>DATA ASSET.</h1>
                    <div class="hero-desc">
                        <?= htmlspecialchars($stats['landing_description']) ?>
                        <div class="cta-group" style="margin-top: 3rem;">
                            <?php if (isset($stats['links']['ZIP'])): ?>
                                <a href="<?= $stats['links']['ZIP'] ?>" class="btn-institutional primary">Download Full ZIP
                                    <span class="arrow">↓</span></a>
                            <?php endif; ?>
                            <a href="#sectors" class="btn-institutional secondary">Inspect Sectors</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="section-meta">GLOBAL INVENTORY</div>
                <div class="section-content">
                    <h2 class="section-title">Verified Datasets</h2>

                    <div class="grid-container" style="padding:0; gap:1.5rem; margin-bottom: 4rem;">
                        <div class="span-3 stat-card">
                            <span class="stat-val"><?= number_format($stats['total_companies']) ?></span>
                            <span class="stat-label">Companies</span>
                        </div>
                        <div class="span-3 stat-card">
                            <span class="stat-val"><?= number_format($stats['total_emails']) ?></span>
                            <span class="stat-label">Emails</span>
                        </div>
                        <div class="span-3 stat-card">
                            <span class="stat-val"><?= number_format($stats['total_domains']) ?></span>
                            <span class="stat-label">Domains</span>
                        </div>
                        <div class="span-3 stat-card">
                            <span class="stat-val"><?= number_format($stats['total_categories']) ?></span>
                            <span class="stat-label">Sectors</span>
                        </div>
                    </div>

                    <div id="sectors" style="margin-top: 5rem;">
                        <h3 style="margin-bottom: 2rem;">Sector Dominance Index</h3>
                        <p style="margin-bottom: 2rem; opacity: 0.7;">High-fidelity distribution of commercial
                            activities within the <?= $currentCountryName ?> jurisdiction.</p>

                        <table class="titan-table">
                            <thead>
                                <tr>
                                    <th>Activity Group</th>
                                    <th style="text-align:right">Estimated Entities</th>
                                    <th style="text-align:right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sectors)): ?>
                                    <?php foreach (array_slice($sectors, 0, 15) as $sector):
                                        $label = str_replace(['ES\\', 'ES-', 'US-', '_extracted.csv', '.csv'], '', $sector[0]);
                                        $label = str_replace('_', ' ', $label);
                                        ?>
                                        <tr>
                                            <td style="font-weight:600;"><?= htmlspecialchars(ucwords($label)) ?></td>
                                            <td style="text-align:right; font-family: monospace;">
                                                <?= number_format($sector[1]) ?>
                                            </td>
                                            <td style="text-align:right;"><span class="status-operational">READY</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" style="text-align:center; opacity: 0.5; padding: 4rem;">Metadata
                                            indexing in progress for this jurisdiction.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div
                        style="margin-top: 5rem; padding: 3rem; background: var(--bg-secondary); border-left: 4px solid var(--accent);">
                        <h3>Access Protocols</h3>
                        <p style="margin-top: 1rem; margin-bottom: 2rem;">Downloads are provided via the
                            Central.Enterprises Foundation distributed infrastructure.</p>
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                            <?php foreach ($stats['links'] as $format => $url): ?>
                                <a href="<?= $url ?>"
                                    class="btn-institutional <?= $format === 'ZIP' ? 'primary' : 'secondary' ?>"
                                    style="font-size: 0.7rem; padding: 0.8rem 1.5rem;">
                                    DOWNLOAD <?= $format ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>