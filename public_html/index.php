<?php
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
        content="Central.Enterprises is a Spain-based foundation (in formation) providing a CC0 global reference layer for business reality. Open data as infrastructure.">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="assets/titan.css?v=11">
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
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include 'includes/cookies_banner.php'; ?>
    <?php include 'includes/foundation_banner.php'; ?>
    <?php include 'includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <h1 class="hero-title">OPEN DATA <br>IS INFRASTRUCTURE.</h1>
                <div class="hero-desc">
                    A CC0 global reference layer for business reality. Managed by the Central.Enterprises Foundation (in
                    formation) to ensure corporate data remains a neutral public good.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="section-meta">ACCESS PROTOCOLS</div>
                <div class="section-content">
                    <h2 class="section-title">Select a jurisdiction to inspect corporate entities.</h2>

                    <div class="grid-container" style="padding:0; margin-top:3rem; gap: 1.5rem;">
                        <!-- Country Cards -->
                        <a href="/country/es" class="feature-card span-4"
                            style="text-decoration:none; color:inherit; display:block">
                            <span class="feature-num">EU-01</span>
                            <h3>Spain Registry</h3>
                            <p>CC0 standardization for the Kingdom of Spain.</p>
                            <span class="btn-institutional primary" style="margin-top:1rem; display:inline-block">Get
                                Data (CC0) →</span>
                        </a>

                        <a href="/country/us" class="feature-card span-4"
                            style="text-decoration:none; color:inherit; display:block">
                            <span class="feature-num">NA-01</span>
                            <h3>United States</h3>
                            <p>Federal and state-level entity reconciliation.</p>
                            <span class="btn-institutional secondary" style="margin-top:1rem; display:inline-block">Get
                                Data (CC0) →</span>
                        </a>

                        <a href="/pro.php" class="feature-card span-4"
                            style="text-decoration:none; color:inherit; display:block; border-color: var(--accent);">
                            <span class="feature-num" style="color: var(--accent);">PRO</span>
                            <h3>Enrichment Layer</h3>
                            <p>Commercial signals: domains, emails, and social footprint.</p>
                            <span class="btn-institutional primary"
                                style="margin-top:1rem; display:inline-block; background: var(--accent); color: var(--bg-primary);">Request
                                Pro Access →</span>
                        </a>
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
</body>

</html>