<?php
$basePath = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="assets/titan.css?v=8">
    <script src="assets/theme-toggle.js?v=7" defer></script>
    <script src="assets/cookies.js?v=5" defer></script>
    <style>
        .about-content p {
            margin-bottom: 2rem;
            font-size: 1.25rem;
            line-height: 1.6;
            color: var(--text-header);
        }

        .vision-card {
            padding: 3rem;
            background: var(--bg-secondary);
            border: 1px solid var(--structural-line);
            margin-top: 4rem;
        }

        .vision-card h3 {
            margin-bottom: 1.5rem;
            color: var(--accent);
        }
    </style>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include 'includes/cookies_banner.php'; ?>
    <?php include 'includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta"
                    style="grid-column: 1 / 13; margin-bottom: 2rem; border-top:none; padding-top:0;">ABOUT US</div>
                <h1 class="hero-title">BEYOND <br>THE DATA.</h1>
                <div class="hero-desc">
                    Central.Enterprises is an open-data project initiated in Granada, Spain,
                    with a global vision for business transparency.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8 about-content">
                    <p>We are a team of engineers, publishers, and educators who believe that knowledge shouldn't stay
                        trapped behind corporate walls.</p>
                    <p>Building from Granada is a statement: valuable infrastructure can be built anywhere if the
                        discipline is real. We prioritize resilience over hype, and real work over vanity metrics.</p>

                    <div class="vision-card">
                        <h3>Our Commitment</h3>
                        <p style="font-size: 1.1rem; opacity: 0.8;">We provide the mission-critical foundation for
                            international business verification, aggregating data from sovereign registries into a
                            single authoritative platform that respects privacy and the law.</p>
                        <a href="manifesto.php" class="btn-institutional primary">Read our full Manifesto →</a>
                    </div>
                </div>

                <div class="span-4">
                    <div style="border-top: 1px solid var(--accent); padding-top: 1rem;">
                        <h4
                            style="font-size: 0.7rem; letter-spacing: 0.2em; color: var(--accent); margin-bottom: 2rem;">
                            LOCATION</h4>
                        <p style="font-family: var(--font-header); font-weight: 800; text-transform: uppercase;">
                            Granada, Spain</p>
                        <p style="font-size: 0.9rem; opacity: 0.6; margin-top: 0.5rem;">EU South Hub</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>