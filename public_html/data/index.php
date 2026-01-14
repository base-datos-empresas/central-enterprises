<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";

// 1. Load Registry (Digital Library)
// This file is the single source of truth for all countries and links
$registryFile = __DIR__ . '/../../data/digital_library.json';
$library = [];

if (file_exists($registryFile)) {
    $library = json_decode(file_get_contents($registryFile), true);
} else {
    error_log("Titan Registry: Library file not found at " . $registryFile);
}

// 2. Prepare Catalog Data
// We iterate the library to build the view structure
$groupedCatalog = [];

foreach ($library as $countryName => $tiers) {
    if ($countryName === '_metadata')
        continue;

    // Check availability
    $openData = $tiers['OpenData'] ?? null;
    $premium = $tiers['Premium'] ?? null;

    // We only list if there is Open Data available (or at least placeholder)
    $groupedCatalog[$countryName] = [
        'name' => $countryName,
        'iso' => strtoupper(substr($countryName, 0, 2)), // Approximation, or use a map if needed
        'metrics' => $openData['metrics'] ?? ['companies' => 0],
        'links' => $openData['links'] ?? [],
        'premium_links' => $premium['links'] ?? [], // For upselling logic if needed
        'updated_at' => $library['_metadata']['last_update'] ?? date('Y-m-d')
    ];
}

// Sort alphabetically
ksort($groupedCatalog);

// 3. Filter Handling (Search/URL)
$filterJurisdiction = $_GET['jurisdiction'] ?? null;

if ($filterJurisdiction) {
    // Case insensitive search
    foreach ($groupedCatalog as $name => $data) {
        if (strcasecmp($name, $filterJurisdiction) === 0) {
            $groupedCatalog = [$name => $data];
            break;
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
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=logo_native">
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
                <!-- TABLE VIEW FOR GLOBAL CATALOG -->
                <?php if (!$filterJurisdiction): ?>
                    <div class="span-12">
                        <div
                            style="background: var(--bg-secondary); border: 1px solid var(--structural-line); overflow: hidden;">
                            <table class="titan-table" style="width: 100%; border-collapse: collapse; text-align: left;">
                                <thead>
                                    <tr style="border-bottom: 1px solid var(--accent); background: rgba(0,0,0,0.2);">
                                        <th
                                            style="padding: 1.5rem; font-size: 0.8rem; text-transform: uppercase; color: var(--accent); letter-spacing: 0.05em;">
                                            Country</th>
                                        <th
                                            style="padding: 1.5rem; font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em;">
                                            ISO</th>
                                        <th
                                            style="padding: 1.5rem; font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em; text-align: right;">
                                            Companies</th>
                                        <th
                                            style="padding: 1.5rem; font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em; text-align: right;">
                                            Emails</th>
                                        <th
                                            style="padding: 1.5rem; font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em; text-align: right;">
                                            Categories</th>
                                        <th
                                            style="padding: 1.5rem; font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em;">
                                            Latest Sync</th>
                                        <th
                                            style="padding: 1.5rem; font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em; text-align: right;">
                                            Access</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($groupedCatalog as $jurisdiction => $ds): ?>
                                        <tr style="border-bottom: 1px solid var(--structural-line); transition: background 0.2s;"
                                            onmouseover="this.style.background='rgba(255,255,255,0.02)'"
                                            onmouseout="this.style.background='transparent'">
                                            <td style="padding: 1.5rem; font-weight: 700; color: var(--text-header);">
                                                <?php $slug = strtolower(str_replace(' ', '-', $ds['name'])) . '-business-databases-b2b'; ?>
                                                <a href="/country/<?= $slug ?>"
                                                    style="color: inherit; text-decoration: none; display: flex; align-items: center;">
                                                    <span
                                                        style="display: inline-block; width: 8px; height: 8px; background: var(--accent); border-radius: 50%; margin-right: 1rem;"></span>
                                                    <?= strtoupper($ds['name']) ?>
                                                </a>
                                            </td>
                                            <td style="padding: 1.5rem; font-family: monospace; opacity: 0.7;"><?= $ds['iso'] ?>
                                            </td>
                                            <td style="padding: 1.5rem; text-align: right; font-family: 'Sora', sans-serif;">
                                                <?= number_format($ds['metrics']['companies']) ?>
                                            </td>
                                            <td
                                                style="padding: 1.5rem; text-align: right; font-family: 'Sora', sans-serif; opacity: 0.8;">
                                                <?= number_format($ds['metrics']['emails']) ?>
                                            </td>
                                            <td
                                                style="padding: 1.5rem; text-align: right; font-family: 'Sora', sans-serif; opacity: 0.8;">
                                                <?= number_format($ds['metrics']['categories']) ?>
                                            </td>
                                            <td style="padding: 1.5rem; font-size: 0.85rem; opacity: 0.6;">
                                                <?= date('M d, Y', strtotime($ds['updated_at'])) ?>
                                            </td>
                                            <td style="padding: 1.5rem; text-align: right;">
                                                <a href="/country/<?= strtolower(str_replace(' ', '-', $ds['name'])) ?>-business-databases-b2b"
                                                    class="btn-institutional small"
                                                    style="padding: 0.5rem 1rem; font-size: 0.7rem; border: 1px solid var(--structural-line); text-decoration: none; color: var(--text-header);">
                                                    INSPECT
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- SINGLE COUNTRY VIEW -->
                    <?php
                    // Since filter logic (ln 94 approx) effectively reduces groupedCatalog to 1 item
                    // We can just iterate the single item
                    $ds = current($groupedCatalog);
                    $jurisdiction = key($groupedCatalog);
                    ?>
                    <div id="assets-<?= $jurisdiction ?>" class="span-12"
                        style="margin-top: 4rem; padding-top: 4rem; border-top: 1px solid var(--structural-line);">
                        <div
                            style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 3rem;">
                            <h3 class="titan-label" style="font-size: 1.5rem; color:white;"><?= strtoupper($ds['name']) ?>
                                | REPOSITORY</h3>
                            <a href="?" style="font-size: 0.8rem; opacity: 0.6; text-decoration: none;">← Back to Index</a>
                        </div>

                        <!-- OPEN DATA ASSETS -->
                        <?php if (!empty($ds['links'])): ?>
                            <div style="margin-bottom: 4rem;">
                                <h4 class="titan-label" style="margin-bottom: 2rem;">🔓 OPEN DATA (PUBLIC LICENSE)</h4>
                                <div class="grid-container" style="padding:0">
                                    <div class="span-12"
                                        style="background: var(--bg-secondary); padding: 2rem; border: 1px solid var(--accent);">
                                        <div
                                            style="font-weight: 800; font-size: 1.2rem; margin-bottom: 0.5rem; color: var(--text-header);">
                                            <?= $ds['name'] ?> Official Registry (Open Data)
                                        </div>
                                        <div style="font-size: 0.9rem; opacity: 0.7; margin-bottom: 1.5rem;">
                                            Full masked dataset for <?= $ds['name'] ?>. Includes Company Names, IDs, Cities, and
                                            masked emails.
                                        </div>

                                        <div style="display: flex; gap: 0.5rem; flex-wrap:wrap;">
                                            <?php foreach ($ds['links'] as $format => $link):
                                                $icon = '📎';
                                                if ($format === 'ZIP')
                                                    $icon = '📦';
                                                if ($format === 'CSV')
                                                    $icon = '📄';
                                                if ($format === 'Excel')
                                                    $icon = '📊';
                                                ?>
                                                <a href="<?= $link ?>" target="_blank" class="btn-institutional primary"
                                                    style="padding: 0.75rem 1.5rem; font-size: 0.7rem;">
                                                    <span style="margin-right: 0.5rem;"><?= $icon ?></span>
                                                    DOWNLOAD <?= strtoupper($format) ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- PREMIUM ASSETS (UPSCREEN) -->
                        <?php if (!empty($ds['premium_links'])): ?>
                            <div>
                                <h4 class="titan-label" style="margin-bottom: 2rem; color:var(--accent);">🔒 PREMIUM DATA (FULL
                                    CONTACTS)</h4>
                                <div class="grid-container" style="padding:0">
                                    <div class="span-12"
                                        style="background: rgba(255,255,255,0.05); padding: 2rem; border: 1px dashed var(--structural-line);">
                                        <div
                                            style="font-weight: 800; font-size: 1.2rem; margin-bottom: 0.5rem; color: var(--text-muted);">
                                            <?= $ds['name'] ?> Complete Marketing Database
                                        </div>
                                        <div style="font-size: 0.9rem; opacity: 0.6; margin-bottom: 1.5rem;">
                                            Includes unmasked emails, direct phone numbers, and full executive contacts.
                                        </div>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="/pro" class="btn-institutional secondary" style="opacity:0.7">
                                                Upgrade to Access
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>

    <script>
        // Simple Client-Side Search
        document.getElementById('catalog-search').addEventListener('input', function (e) {
            const term = e.target.value.toLowerCase();
            const isTable = document.querySelector('table.titan-table');

            if (isTable) {
                // Filter Table Rows
                document.querySelectorAll('table.titan-table tbody tr').forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(term) ? 'table-row' : 'none';
                });
            } else {
                // Filter Asset Cards (Single View)
                // In single view, we probably don't need search as much, or just search sections?
                // For now, let's just ensure we don't break.
            }
        });
    </script>
</body>

</html>