<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";
$registryFile = __DIR__ . '/../../data/registry_index.json';
$registry = [];

if (file_exists($registryFile)) {
    $registry = json_decode(file_get_contents($registryFile), true);
} else {
    // Log error but allow page to load with empty registry
    error_log("Titan Registry: Index file not found at " . $registryFile);
}

// Group by jurisdiction to show in table
// Intelligent Asset Tree Processing
$assetTree = [];
$formatMap = [
    'csv' => ['icon' => '📄', 'label' => 'CSV'],
    'json' => ['icon' => '📎', 'label' => 'JSON'], // Added JSON
    'xlsx' => ['icon' => '📊', 'label' => 'EXCEL'],
    'zip' => ['icon' => '📦', 'label' => 'ZIP'],
    'gz' => ['icon' => '🗜️', 'label' => 'GZIP']
];

foreach ($registry as $asset) {
    if ($asset['tier'] !== 'Open')
        continue;

    // 1. FILTER: Noise reduction
    if (strpos($asset['asset_name'], 'INFO-') !== false)
        continue;
    if (strpos($asset['asset_name'], 'COLUMN-AUDIT') !== false)
        continue;
    if (strpos($asset['asset_name'], '.txt') !== false)
        continue;

    $jurisdiction = $asset['jurisdiction'];

    // 2. NORMALIZE: Base Name Detection
    // Remove standard suffixes to find the "concept"
    // e.g. "Poland-IT-Companies-OpenData.xlsx" -> "Poland-IT-Companies"
    $baseName = str_replace(
        ['-OpenData', '-Premium', '.xlsx', '.csv', '.zip', '.gz'],
        '',
        $asset['asset_name']
    );
    $ext = strtolower(pathinfo($asset['asset_name'], PATHINFO_EXTENSION));

    // 3. CLASSIFY: MegaPack vs Sector
    $category = 'sectors';
    if (strpos($baseName, 'MegaPack') !== false || strpos($baseName, 'Databases') !== false) {
        $category = 'full_archives';
    }

    // 4. GROUP: Merge formats
    if (!isset($assetTree[$jurisdiction])) {
        $assetTree[$jurisdiction] = [
            'full_archives' => [],
            'sectors' => [],
            'updated_at' => $asset['last_sync']
        ];
    }

    if (!isset($assetTree[$jurisdiction][$category][$baseName])) {
        $assetTree[$jurisdiction][$category][$baseName] = [
            'name' => $baseName,
            'clean_name' => str_replace([$jurisdiction . '-'], '', $baseName), // "IT-Companies"
            'source' => $asset['source_registry'] ?? 'Central.Enterprises Index',
            'hash' => $asset['sha256'] ?? null,
            'formats' => []
        ];
    }

    $assetTree[$jurisdiction][$category][$baseName]['formats'][] = [
        'type' => $ext,
        'size' => $asset['size_bytes'],
        'url' => $asset['dropbox_url'], // Ensure this maps correctly from registry
        'meta' => $formatMap[$ext] ?? ['icon' => '📎', 'label' => strtoupper($ext)]
    ];
}

// Assign to groupedCatalog for backwards compatibility loop (metrics calc)
// Note: Metrics calc still iterates this structure in Pass 1 below
$groupedCatalog = $assetTree;
// URL Rewrite handling (Nginx passes jurisdiction via GET)
$filterJurisdiction = $_GET['jurisdiction'] ?? null;
$filterSector = $_GET['sector'] ?? null; // NEW: Deep Link parameter

if ($filterJurisdiction) {
    $filterJurisdiction = ucfirst($filterJurisdiction); // Normalize e.g. "poland" -> "Poland"

    // Filter by Jurisdiction
    if (isset($groupedCatalog[$filterJurisdiction])) {
        $groupedCatalog = [$filterJurisdiction => $groupedCatalog[$filterJurisdiction]];

        // Filter by Sector (Deep Registry)
        if ($filterSector) {
            // Find matching sector by clean name
            $sectorAssets = [];
            foreach ($groupedCatalog[$filterJurisdiction]['sectors'] as $baseName => $data) {
                if (strcasecmp($data['clean_name'], $filterSector) === 0) {
                    $sectorAssets[$baseName] = $data;
                }
            }

            // Overwrite the sectors list with ONLY the filtered one
            $groupedCatalog[$filterJurisdiction]['sectors'] = $sectorAssets;
            // Clear full archives for sector-specific view to reduce noise
            $groupedCatalog[$filterJurisdiction]['full_archives'] = [];
        }
    }
}

// --- SEO METADATA GENERATION ---
$pageTitle = "Dataset Catalog | The Global Reference Layer";
$metaDescription = "Access the world's most comprehensive open repository of business data. Verify companies, download official registries, and integrate global market intelligence.";
$canonicalUrl = "https://central.enterprises/data/";

// Dynamic SEO based on active view
if ($filterJurisdiction && count($groupedCatalog) === 1) {
    // We are in a specific view
    $ds = current($groupedCatalog);

    if ($filterSector) {
        // SECTOR VIEW
        $sectorName = str_replace('-', ' ', $filterSector);
        $pageTitle = "{$filterJurisdiction} {$sectorName} Database - Verified Business List 2025";
        $metaDescription = "Download the official list of {$sectorName} in {$filterJurisdiction}. Complete registry with verified contacts, emails, and legal status. Updated 2025.";
        $canonicalUrl = "https://central.enterprises/data/" . urlencode($filterJurisdiction) . "/" . urlencode($filterSector);
    } else {
        // COUNTRY LANDING PAGE
        $pageTitle = "{$filterJurisdiction} Business Registry - Open Data";
        $metaDescription = "Official Open Data Record for {$filterJurisdiction}. Access active companies and verified contacts. Download the full {$filterJurisdiction} dataset.";
        $canonicalUrl = "https://central.enterprises/data/" . urlencode($filterJurisdiction);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
    <meta name="robots" content="index, follow">
    <title><?= htmlspecialchars($pageTitle) ?> | Central.Enterprises</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=11">
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=isometric">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">GLOBAL INVENTORY</div>
                <h1 class="hero-title">DATASET <br>CATALOG.</h1>
                <div class="hero-desc">
                    Browse and inspect the institutional datasets currently managed by the Central.Enterprises sovereign
                    infrastructure.
                    <?php if ($filterJurisdiction): ?>
                        <div style="margin-top: 1.5rem;">
                            <a href="<?= $basePath ?>/data"
                                style="font-size: 0.8rem; color: var(--accent); text-transform: uppercase; letter-spacing: 0.05em; text-decoration: none;">←
                                Return to Global Catalog</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            </div>
            </div>
        </header>

        <!-- SEARCH BAR -->
        <div class="test-search-container"
            style="background:var(--bg-secondary); border-top:1px solid var(--structural-line); border-bottom:1px solid var(--structural-line);">
            <div class="grid-container" style="padding: 1rem 2rem;">
                <input type="text" id="catalog-search"
                    placeholder="SEARCH CATALOG (e.g. 'Spain', 'Tax', 'Companies')..." class="titan-input"
                    style="font-size:1.2rem; padding:1.5rem; background:transparent; border:none; width:100%; color:var(--text-header);">
            </div>
        </div>

        <section class="section">
            <div class="grid-container">
                <!-- GRID VIEW FOR JURISDICTIONS -->
                <?php foreach ($groupedCatalog as $jurisdiction => $ds):
                    // Attempt to load rich metadata from JSON
                    $jsonPath = __DIR__ . "/../../data/XPublicar1/{$jurisdiction}/{$jurisdiction}-OpenData/{$jurisdiction}-Companies-Metrics-OpenData.json";
                    $meta = null;
                    if (file_exists($jsonPath)) {
                        $meta = json_decode(file_get_contents($jsonPath), true);
                    }
                    ?>
                    <div class="span-4" style="margin-bottom: 2rem;">
                        <div
                            style="background: var(--bg-secondary); border: 1px solid var(--structural-line); height: 100%; display: flex; flex-direction: column;">
                            <!-- Card Header -->
                            <div
                                style="padding: 1.5rem; border-bottom: 1px solid var(--structural-line); display: flex; justify-content: space-between; align-items: center;">
                                <h3 class="titan-label" style="font-size: 1rem; margin:0;"><?= strtoupper($jurisdiction) ?>
                                </h3>
                                <span style="font-size: 0.7rem; opacity: 0.6;">ISO:
                                    <?= strtoupper(substr($jurisdiction, 0, 2)) ?></span>
                            </div>

                            <!-- Rich Stats or Basic Info -->
                            <div style="padding: 1.5rem; flex-grow: 1;">
                                <?php if ($meta && isset($meta['totals'])): ?>
                                    <div
                                        style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                                        <div>
                                            <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Companies
                                            </div>
                                            <div style="font-size: 1.2rem; font-weight: 800; color: var(--text-header);">
                                                <?= number_format($meta['totals']['companies_unique']) ?>
                                            </div>
                                        </div>
                                        <div>
                                            <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Emails
                                            </div>
                                            <div style="font-size: 1.2rem; font-weight: 800; color: var(--text-header);">
                                                <?= number_format($meta['totals']['unique_emails']) ?>
                                            </div>
                                        </div>
                                        <div>
                                            <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Domains
                                            </div>
                                            <div style="font-size: 1.2rem; font-weight: 800; color: var(--text-header);">
                                                <?= number_format($meta['totals']['web_domains_unique']) ?>
                                            </div>
                                        </div>
                                        <div>
                                            <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Verified
                                                Fields
                                            </div>
                                            <div style="font-size: 1.2rem; font-weight: 800; color: var(--accent);">
                                                <?= isset($meta['totals']['fields_verified']) ? $meta['totals']['fields_verified'] : '5/5' ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div style="margin-bottom: 1.5rem;">
                                        <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Total
                                            Collections</div>
                                        <div style="font-size: 1.5rem; font-weight: 800; color: var(--text-header);">
                                            <?= count($ds['sectors'] ?? []) + count($ds['full_archives'] ?? []) ?> Categories
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div style="font-size: 0.7rem; opacity: 0.5;">
                                    Last Snapshot: <?= date('Y-m-d', strtotime($ds['updated_at'])) ?>
                                </div>
                            </div>

                            <!-- Action -->
                            <div style="padding: 1rem; border-top: 1px solid var(--structural-line);">
                                <a href="#assets-<?= $jurisdiction ?>" class="btn-institutional"
                                    style="width: 100%; justify-content: center; text-align: center;">INSPECT FILES</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ASSET LISTING SECTION -->
        <section class="section" style="padding-top: 0;">
            <div class="grid-container">
                <?php foreach ($groupedCatalog as $jurisdiction => $groups): ?>
                    <div id="assets-<?= $jurisdiction ?>" class="span-12"
                        style="margin-top: 4rem; padding-top: 4rem; border-top: 1px solid var(--structural-line);">
                        <div
                            style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 3rem;">
                            <h3 class="titan-label" style="font-size: 1.5rem; color:white;"><?= strtoupper($jurisdiction) ?>
                                | REPOSITORY</h3>
                            <a href="#" style="font-size: 0.8rem; opacity: 0.6; text-decoration: none;">↑ Back to Top</a>
                        </div>

                        <!-- SECTION 1: FULL ARCHIVES -->
                        <?php if (!empty($groups['full_archives'])): ?>
                            <div style="margin-bottom: 4rem;">
                                <h4 class="titan-label" style="margin-bottom: 2rem;">📦 COMPLETE ARCHIVES (GOLD STANDARD)</h4>
                                <div class="grid-container" style="padding:0">
                                    <?php foreach ($groups['full_archives'] as $asset): ?>
                                        <div class="span-6"
                                            style="background: var(--bg-secondary); padding: 2rem; border: 1px solid var(--accent);">
                                            <div
                                                style="font-weight: 800; font-size: 1.2rem; margin-bottom: 0.5rem; color: var(--text-header);">
                                                <?= $asset['clean_name'] ?>
                                            </div>
                                            <div style="font-size: 0.9rem; opacity: 0.7; margin-bottom: 1.5rem;">
                                                Complete jurisdiction snapshot. Includes all sectors, identifiers, and metadata.
                                                <?php if ($asset['source']): ?>
                                                    <div
                                                        style="margin-top:0.5rem; font-size:0.75rem; color:var(--accent); text-transform:uppercase; letter-spacing:0.05em;">
                                                        Source: <?= $asset['source'] ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($asset['hash']): ?>
                                                    <div class="hash-container" title="Click to Copy"
                                                        onclick="navigator.clipboard.writeText('<?= $asset['hash'] ?>'); alert('Hash Copied!');"
                                                        style="cursor:pointer; font-family:monospace; background:rgba(0,0,0,0.3); padding:0.4rem; margin-top:0.5rem; border-radius:4px; font-size:0.7rem; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; border:1px solid var(--structural-line);">
                                                        SHA256: <?= $asset['hash'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <?php foreach ($asset['formats'] as $fmt): ?>
                                                    <a href="<?= $fmt['url'] ?>" target="_blank" class="btn-institutional primary"
                                                        style="padding: 0.75rem 1.5rem; font-size: 0.7rem;">
                                                        <span style="margin-right: 0.5rem;"><?= $fmt['meta']['icon'] ?></span>
                                                        DOWNLOAD <?= $fmt['meta']['label'] ?>
                                                        <span
                                                            style="opacity:0.6; margin-left:0.3rem;">(<?= round($fmt['size'] / (1024 * 1024), 2) ?>
                                                            MB)</span>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- SECTION 2: SECTOR BREAKDOWNS -->
                        <?php if (!empty($groups['sectors'])): ?>
                            <div>
                                <?php if (!$filterSector): ?>
                                    <h4 class="titan-label" style="margin-bottom: 2rem;">📂 SECTOR BREAKDOWNS (SPECIFIC VERTICALS)
                                    </h4>
                                <?php endif; ?>

                                <div class="grid-container" style="padding:0">
                                    <?php foreach ($groups['sectors'] as $asset): ?>
                                        <div class="span-4"
                                            style="background: var(--bg-secondary); padding: 1.5rem; border: 1px solid var(--structural-line); margin-bottom: 1rem;">
                                            <div
                                                style="margin-bottom: 1rem; height: 2.5rem; overflow: hidden; display:flex; align-items:center;">
                                                <a href="#"
                                                    style="font-weight: 800; font-size: 0.95rem; color: var(--text-header); text-decoration: none;">
                                                    <?= $asset['clean_name'] ?>
                                                </a>
                                            </div>

                                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                                <?php foreach ($asset['formats'] as $fmt): ?>
                                                    <a href="<?= $fmt['url'] ?>" target="_blank"
                                                        style="padding: 0.5rem 1rem; border: 1px solid var(--structural-line); font-size: 0.7rem; color: var(--text-body); text-decoration: none; display: flex; align-items: center; border-radius: 4px;">
                                                        <span style="margin-right: 0.3rem;"><?= $fmt['meta']['icon'] ?></span>
                                                        <?= $fmt['meta']['label'] ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <div class="span-12"
                    style="margin-top: 5rem; padding: 4rem; background: var(--bg-secondary); border: 1px solid var(--structural-line);">
                    <div class="grid-container" style="padding: 0;">
                        <div class="span-8">
                            <h2 class="heading" style="font-size: 1.5rem; margin-bottom: 2rem;">Dataset Access Protocols
                            </h2>
                            <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">
                                All datasets listed here are synchronized via our Hybrid Cloud Storage (HCS) protocol.
                                By downloading, you agree to our terms.
                            </p>
                            <a href="<?= $basePath ?>/contact/" class="btn-institutional primary">Request API Access</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>

    <script>
        // Simple Client-Side Search
        document.getElementById('catalog-search').addEventListener('input', function (e) {
            const term = e.target.value.toLowerCase();

            // Search Jurisdiction Cards
            document.querySelectorAll('.span-4').forEach(card => {
                const text = card.innerText.toLowerCase();
                card.style.display = text.includes(term) ? 'block' : 'none';
            });

            // Search Asset Cards
            document.querySelectorAll('.span-6, .span-4').forEach(card => {
                const text = card.innerText.toLowerCase();
                // Keep visible if parent section is visible? logic simplification: just search text
                if (card.closest('#assets-ES') || card.closest('#assets-US')) {
                    card.style.display = text.includes(term) ? 'block' : 'none';
                }
            });
        });
    </script>
</body>

</html>