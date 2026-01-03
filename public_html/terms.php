<?php
$basePath = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Use | Central.Enterprises</title>
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
                <div class="section-meta">USER AGREEMENT</div>
                <h1 class="hero-title">WEBSITE <br>TERMS OF USE.</h1>
                <div class="hero-desc">
                    Rules and conditions for accessing the Central.Enterprises platform.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">1. Acceptance</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        By accessing or using this website, you agree to these Terms of Use. If you do not agree, do not
                        use the website.
                    </p>

                    <h2 class="section-title">2. Permitted Use</h2>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li>Read documentation and policies.</li>
                        <li>Browse dataset catalog pages.</li>
                        <li>Download Open Data (CC0) where available.</li>
                        <li>Request access to Pro services.</li>
                    </ul>

                    <h2 class="section-title">3. Prohibited Use</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 1rem;">You agree not to:</p>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li>Attempt unauthorized access or vulnerability scanning.</li>
                        <li>Circumvent security measures or rate limits.</li>
                        <li>Violate applicable laws (privacy, consumer protection).</li>
                        <li>Misrepresent affiliation with Central.Enterprises.</li>
                        <li>Use contact channels for unlawful unsolicited marketing.</li>
                    </ul>

                    <h2 class="section-title">4. Service Availability</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        We may change, suspend, or discontinue any part of the website at any time, including download
                        endpoints or Pro access methods.
                    </p>

                    <h2 class="section-title">5. Updates</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        We may update these terms. Continued use after publication of changes means acceptance of the
                        updated terms.
                    </p>

                    <h2 class="section-title">6. Related Policies</h2>
                    <ul class="compare-list">
                        <li><a href="privacy.php">Privacy Policy</a></li>
                        <li><a href="cookies.php">Cookies Policy</a></li>
                        <li><a href="open-data.php">Open Data Terms (CC0)</a></li>
                        <li><a href="pro-license.php">Pro Data License</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>