<?php
$basePath = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Data Terms | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="assets/titan.css?v=11">
    <script src="assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include 'includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">CC0 1.0 UNIVERSAL</div>
                <h1 class="hero-title">OPEN DATA <br>TERMS.</h1>
                <div class="hero-desc">
                    Licensing and best practices for reusing Central.Enterprises open datasets.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">1. License (CC0)</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">
                        Unless stated otherwise, Central.Enterprises releases Open Data under <strong>CC0 1.0 Universal
                            (Public Domain Dedication)</strong>. You may copy, modify, and distribute the data without
                        asking permission.
                    </p>

                    <h2 class="section-title">2. No Endorsement</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        You may not imply that Central.Enterprises endorses you or your use of the data.
                    </p>

                    <h2 class="section-title">3. No Warranties</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Open Data is provided “as is” without warranties of any kind, including accuracy or fitness for
                        a particular purpose.
                    </p>

                    <h2 class="section-title">4. Minimization</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        If you discover personal data within Open Data, notify us via <a href="data-requests.php"
                            style="color:var(--accent)">/data-requests</a> and do not attempt to re-identify
                        individuals.
                    </p>

                    <h2 class="section-title">5. Best Practices</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 1rem;">To keep the ecosystem trustworthy:
                    </p>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li>Keep dataset version identifiers and timestamps.</li>
                        <li>Document transformations and enrichment steps.</li>
                        <li>Preserve provenance fields (retrieved_at, schema_version).</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>