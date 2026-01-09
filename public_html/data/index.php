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
                <!-- GRID VIEW FOR JURISDICTIONS -->
                <?php foreach ($groupedCatalog as $jurisdiction => $ds): ?>
                    <div class="span-4" style="margin-bottom: 2rem;">
                        <div
                            style="background: var(--bg-secondary); border: 1px solid var(--structural-line); height: 100%; display: flex; flex-direction: column;">
                            <!-- Card Header -->
                            <div
                                style="padding: 1.5rem; border-bottom: 1px solid var(--structural-line); display: flex; justify-content: space-between; align-items: center;">
                                <h3 class="titan-label" style="font-size: 1rem; margin:0;"><?= strtoupper($ds['name']) ?>
                                </h3>
                                <span style="font-size: 0.7rem; opacity: 0.6;">ISO:
                                    <?= $ds['iso'] ?></span>
                            </div>

                            <!-- Rich Stats -->
                            <div style="padding: 1.5rem; flex-grow: 1;">
                                <div
                                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                                    <!-- Companies -->
                                    <div>
                                        <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Companies
                                        </div>
                                        <div style="font-size: 1.2rem; font-weight: 800; color: var(--text-header);">
                                            <?= number_format($ds['metrics']['companies']) ?>
                                        </div>
                                    </div>
                                    <!-- Emails -->
                                    <div>
                                        <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Emails
                                        </div>
                                        <div style="font-size: 1.2rem; font-weight: 800; color: var(--text-header);">
                                            <?= number_format($ds['metrics']['emails']) ?>
                                        </div>
                                    </div>
                                    <!-- Domains -->
                                    <div>
                                        <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Domains
                                        </div>
                                        <div style="font-size: 1.2rem; font-weight: 800; color: var(--text-header);">
                                            <?= number_format($ds['metrics']['web_domains']) ?>
                                        </div>
                                    </div>
                                    <!-- Categories -->
                                    <div>
                                        <div style="font-size: 0.7rem; opacity: 0.6; text-transform: uppercase;">Categories
                                        </div>
                                        <div style="font-size: 1.2rem; font-weight: 800; color: var(--accent);">
                                            <?= number_format($ds['metrics']['categories']) ?>
                                        </div>
                                    </div>
                                </div>

                                <div style="font-size: 0.7rem; opacity: 0.5;">
                                    Updated: <?= date('Y-m-d', strtotime($ds['updated_at'])) ?>
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
                <?php foreach ($groupedCatalog as $jurisdiction => $ds): ?>
                    <div id="assets-<?= $jurisdiction ?>" class="span-12"
                        style="margin-top: 4rem; padding-top: 4rem; border-top: 1px solid var(--structural-line);">
                        <div
                            style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 3rem;">
                            <h3 class="titan-label" style="font-size: 1.5rem; color:white;"><?= strtoupper($ds['name']) ?>
                                | REPOSITORY</h3>
                            <a href="#" style="font-size: 0.8rem; opacity: 0.6; text-decoration: none;">↑ Back to Top</a>
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
                                            Full masked dataset for <?= $ds['name'] ?>. Includes Company Names, IDs, Cities, and masked emails.
                                        </div>
                                        
                                        <div style="display: flex; gap: 0.5rem; flex-wrap:wrap;">
                                            <?php foreach ($ds['links'] as $format => $link): 
                                                $icon = '📎';
                                                if($format === 'ZIP') $icon = '📦';
                                                if($format === 'CSV') $icon = '📄';
                                                if($format === 'Excel') $icon = '📊';
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
                                <h4 class="titan-label" style="margin-bottom: 2rem; color:var(--accent);">🔒 PREMIUM DATA (FULL CONTACTS)</h4>
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