<?php
require_once __DIR__ . '/../lib/TitanData.php';

// Configuration - Adjust Path to DATA OUTPUTS
$DATA_DIR = __DIR__ . '/../../data/outputs';

// Router Simulation (In production Nginx handles this, here we query param or path)
// Assuming /country/index.php?code=es OR mapped via rewrite
$code = $_GET['code'] ?? 'es';

$titan = new TitanData($DATA_DIR);
$data = $titan->getCountryData($code);

if (!$data) {
    http_response_code(404);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>TITAN | PROTOCOL ERROR</title>
        <link rel="stylesheet" href="/assets/titan.css">
    </head>

    <body data-theme="titan-dark">
        <div class="grid-bg"></div>
        <main style="display:flex; align-items:center; justify-content:center; height:100vh; text-align:center;">
            <div class="grid-container">
                <div class="span-12">
                    <h1 class="hero-title" style="font-size: 4rem; color: var(--accent);">SIGNAL LOST</h1>
                    <p class="hero-desc" style="border:none; padding:0; margin-top:1rem;">
                        PROTOCOL ERROR: Data Sector [<?= htmlspecialchars($code) ?>] not found in central registry.
                    </p>
                    <div class="cta-group" style="justify-content:center; margin-top:2rem;">
                        <a href="/" class="btn-institutional primary">Return to Base</a>
                    </div>
                </div>
            </div>
        </main>
    </body>

    </html>
    <?php
    exit;
}

$stats = $data['stats'];
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
                                    <th>Sector Protocol</th>
                                    <th>Entity Count</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($data['categories'], 0, 5) as $cat): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($cat['category']) ?></td>
                                        <td><?= number_format($cat['count']) ?></td>
                                        <td><span class="status-operational">ACTIVE</span></td>
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
