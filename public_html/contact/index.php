<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=isometric">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=10">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">COMMUNICATION PROTOCOLS</div>
                <h1 class="hero-title">GET IN <br>TOUCH.</h1>
                <div class="hero-desc">
                    Connect with the Central.Enterprises engineering team and foundation stewards.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-4">
                    <h2 class="section-title">Institutional</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">For matters regarding the
                        Foundation's formation, governance, or partnerships.</p>
                    <div
                        style="padding: 2rem; border-left: 2px solid var(--accent); background: rgba(255,255,255,0.02);">
                        <p
                            style="font-weight: 800; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; color: var(--accent);">
                            Direct Channel</p>
                        <p style="font-size: 1.15rem; margin-top: 0.5rem;">FOUNDATION@CENTRAL.ENTERPRISES</p>
                    </div>
                </div>

                <div class="span-4">
                    <h2 class="section-title">Pro Access</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">Request commercial access, API keys,
                        or bulk data exports for professional use.</p>
                    <div
                        style="padding: 2rem; border-left: 2px solid var(--text-header); background: rgba(255,255,255,0.02);">
                        <p
                            style="font-weight: 800; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; color: var(--text-header);">
                            Commercial Dept</p>
                        <p style="font-size: 1.15rem; margin-top: 0.5rem;">PRO@CENTRAL.ENTERPRISES</p>
                    </div>
                    <p style="font-size: 0.75rem; opacity: 0.5; margin-top: 1rem;">
                        Note: All Pro requests must confirm: "I will use Pro data for lawful professional purposes and
                        respect suppression/opt-out requests."
                    </p>
                </div>

                <div class="span-4">
                    <h2 class="section-title">Technical Support</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">Data quality reports, schema
                        feedback, or integration issues regarding the standard.</p>
                    <div
                        style="padding: 2rem; border-left: 2px solid var(--structural-line); background: rgba(255,255,255,0.02);">
                        <p
                            style="font-weight: 800; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; color: var(--text-header);">
                            Engineering</p>
                        <p style="font-size: 1.15rem; margin-top: 0.5rem;">ENGINEERING@CENTRAL.ENTERPRISES</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" style="border-top: 1px solid var(--structural-line); margin-top: 5rem;">
            <div class="grid-container">
                <div class="span-12" style="text-align: center; padding: 4rem 0;">
                    <h2 style="font-size: 1rem; color: var(--accent); margin-bottom: 1.5rem;">LOCATION</h2>
                    <p style="font-size: 1.5rem; font-weight: 800; font-family: var(--font-header);">Trajano 8, 18002
                        Granada, Spain</p>
                    <p style="opacity: 0.6; margin-top: 0.5rem;">Visits by appointment only for institutional board
                        matters.</p>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>