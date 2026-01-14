<?php
$basePath = "../..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Requests | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=11">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">RECTIFICATION & SUPPRESSION</div>
                <h1 class="hero-title">DATA <br>REQUESTS.</h1>
                <div class="hero-desc">
                    Correction, removal, and suppression requests for the Central.Enterprises signals.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Enforce your rights</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        If you believe information about you appears in our datasets, or you represent a business
                        needing a correction, you can submit a request below.
                    </p>

                    <h2 class="section-title">What you can request</h2>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li>Correction of inaccurate company information.</li>
                        <li>Removal/suppression of a contact channel.</li>
                        <li>Review of data provenance.</li>
                        <li>Restriction of processing.</li>
                    </ul>

                    <h2 class="section-title">How to submit</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">
                        Email <strong>INFO@CENTRAL.ENTERPRISES</strong> with the following details:
                    </p>
                    <div
                        style="padding: 2rem; border: 1px solid var(--structural-line); background: rgba(255,255,255,0.02); margin-bottom: 3rem;">
                        <ul style="list-style: none; padding: 0;">
                            <li style="margin-bottom: 1rem;">1. Record ID or dataset reference.</li>
                            <li style="margin-bottom: 1rem;">2. The exact field(s) to correct or remove.</li>
                            <li style="margin-bottom: 1rem;">3. Corrected value (if applicable).</li>
                            <li>4. Minimal verification to prevent fraud.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>