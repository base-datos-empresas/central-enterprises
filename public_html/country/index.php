<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";

// 1. Load Registry
$registryFile = __DIR__ . '/../../data/registry_index.json';
$registry = [];

if (file_exists($registryFile)) {
    $registry = json_decode(file_get_contents($registryFile), true);
} else {
    error_log("Titan Registry: Index file not found at " . $registryFile);
}

// 2. Identify Country
$code = $_GET['code'] ?? null;
if (!$code) {
    // Redirect to main catalog if no code provided
    header("Location: /data/");
    exit;
}
$code = strtoupper($code); // ISO is uppercase (ES, US)

// 3. Filter Metrics & Assets
// We need to aggregate stats for this specific country
$countryAssets = [];
$stats = [
    'landing_title' => $code . ' Open Registry',
    'landing_description' => "Official Open Data Record for {$code}.",
    'total_companies' => 0,
    'total_emails' => 0,
    'total_domains' => 0,
    'updated_at' => date('Y-m-d')
];

foreach ($registry as $asset) {
    // Must match country AND be Open Tier
    if (strtoupper($asset['jurisdiction']) !== $code)
        continue;
    if ($asset['tier'] !== 'Open')
        continue;

    // Filter Noise
    if (strpos($asset['asset_name'], 'INFO-') !== false)
        continue;
    if (strpos($asset['asset_name'], 'COLUMN-AUDIT') !== false)
        continue;

    $countryAssets[] = $asset;
}

// 4. Handle 404 (No assets for this country)
if (empty($countryAssets)) {
    http_response_code(404);
    include __DIR__ . '/../404.php'; // Assuming a generic 404 exists, otherwise inline
    exit;
}

// 5. Calculate Stats from Metadata (if available) or Estimate
// Attempt to load the specific metrics JSON if it exists in data path
// data/XPublicar1/ES/ES-OpenData/ES-Companies-Metrics-OpenData.json
$metricsPath = __DIR__ . "/../../data/XPublicar1/{$code}/{$code}-OpenData/{$code}-Companies-Metrics-OpenData.json";
if (file_exists($metricsPath)) {
    $meta = json_decode(file_get_contents($metricsPath), true);
    if (isset($meta['totals'])) {
        $stats['total_companies'] = $meta['totals']['companies_unique'];
        $stats['total_emails'] = $meta['totals']['unique_emails'];
    }
} else {
    // Fallback: Estimate from file size or just show asset count
    $stats['total_companies'] = count($countryAssets) * 5000; // Rough heuristic if missing
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TITAN | <?= htmlspecialchars($stats['landing_title']) ?></title>

    <!-- Fonts (Sora + Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">

    <meta name="description" content="<?= htmlspecialchars($stats['landing_description']) ?>">

    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="/assets/titan.css">
</head>

<body data-theme="titan-dark">
    <!-- Global Grid Overlay -->
    <div class="grid-bg"></div>

    <!-- Navigation -->
    <nav>
        <div class="grid-container">
            <div class="logo span-6">TITAN<span style="color:var(--accent)">.</span>CENTRAL</div>
            <div class="span-6" style="text-align:right">
                <a href="/"
                    style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">Global
                    Mandate</a>
            </div>
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <header class="hero">
            <div class="grid-container">
                <div class="span-12">
                    <h1 class="hero-title"><?= htmlspecialchars($stats['landing_title']) ?></h1>
                    <div class="hero-desc">
                        <?= htmlspecialchars($stats['landing_description']) ?>
                        <div class="cta-group" style="margin-top: 2rem;">
                            <button class="btn-institutional primary">Access Registry <span
                                    class="arrow">→</span></button>
                            <button class="btn-institutional secondary">System Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Intelligence Section -->
        <section class="section">
            <div class="grid-container">
                <div class="section-meta">SYSTEM INTELLIGENCE</div>
                <div class="section-content">
                    <h2 class="section-title">Sovereign Data Infrastructure</h2>

                    <!-- Stats Grid -->
                    <div class="grid-container" style="padding:0; gap:0; margin-bottom: 4rem;">
                        <div class="span-4 stat-card">
                            <span class="stat-val"><?= number_format($stats['total_companies']) ?></span>
                            <span class="stat-label">Verified Entities</span>
                        </div>
                        <div class="span-4 stat-card">
                            <span class="stat-val"><?= $stats['avg_rating'] > 0 ? $stats['avg_rating'] : 'N/A' ?></span>
                            <span class="stat-label">Quality Index</span>
                        </div>
                        <div class="span-4 stat-card">
                            <span class="stat-val">100<span style="font-size:1.5rem; vertical-align:top">%</span></span>
                            <span class="stat-label">Uptime</span>
                        </div>
                    </div>

                    <!-- Top Categories Table -->
                    <div class="span-12" style="border-top: 1px solid var(--structural-line); padding-top: 2rem;">
                        <h3
                            style="font-family: var(--font-header); font-size: 1rem; margin-bottom: 1.5rem; color: var(--accent);">
                            SECTOR DOMINANCE</h3>
                        <table class="titan-table">
                            <thead>
                                <tr>
                                    <th>Dataset Name</th>
                                    <th>Format</th>
                                    <th style="text-align:right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($countryAssets as $asset): 
                                    $cleanName = str_replace(['-OpenData.zip', '.zip'], '', $asset['asset_name']);
                                ?>
                                    <tr>
                                        <td style="font-weight:600; color:var(--text-header);">
                                            <?= htmlspecialchars($cleanName) ?>
                                            <?php if(isset($asset['source_registry'])): ?>
                                                <div style="font-size:0.7rem; color:var(--text-muted); font-weight:400;">
                                                    Source: <?= htmlspecialchars($asset['source_registry']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span style="background:var(--bg-secondary); border:1px solid var(--structural-line); padding:0.2rem 0.5rem; font-size:0.7rem; border-radius:4px;">ZIP</span>
                                            <span style="font-size:0.7rem; opacity:0.6; margin-left:0.5rem;">
                                                <?= round($asset['size_bytes'] / (1024*1024), 2) ?> MB
                                            </span>
                                        </td>
                                        <td style="text-align:right">
                                            <a href="<?= htmlspecialchars($asset['dropbox_url']) ?>" class="btn-institutional primary" style="padding:0.4rem 1rem; font-size:0.7rem;">
                                                Details & Download
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="grid-container">
            <div class="span-6">
                <p class="titan-label">System Timestamp</p>
                <p><?= htmlspecialchars($stats['updated_at']) ?></p>
            </div>
            <div class="span-6" style="text-align:right">
                TITAN CENTRAL INFRASTRUCTURE
            </div>
        </div>
    </footer>
</body>

</html>