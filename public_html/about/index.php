<?php
$basePath = "..";
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
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=8">
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=isometric">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
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

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">

                <div class="section-meta">ENGINEERING PHILOSOPHY</div>
                <h1 class="hero-title">DATA AS A <br>PUBLIC FACT.</h1>
                <div class="hero-desc">
                    Central.Enterprises is an engineering-driven project based in Granada, Spain, focused on the
                    neutrality and accessibility of global corporate data.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Why Central.Enterprises?</h2>
                    <p style="font-size: 1.25rem; line-height: 1.6; opacity: 0.8; margin-bottom: 2rem;">
                        We believe that corporate identity data is the common infrastructure of the global economy. By
                        providing a neutral, open, and high-quality data layer, we enable a more transparent and
                        efficient business world.
                    </p>
                    <p style="opacity: 0.7; line-height: 1.8;">
                        Our approach is rooted in "Engineering Discipline." We don't believe in marketing hype; we
                        believe in stable schemas, rigorous validation cycles, and institutional transparency.
                    </p>

                    <div
                        style="margin-top: 4rem; padding: 3rem; background: var(--bg-secondary); border: 1px solid var(--structural-line);">
                        <h3 style="color: var(--accent); margin-bottom: 1rem;">The Granada Statement</h3>
                        <p style="opacity: 0.8; font-size: 1.1rem;">Valuable global infrastructure can be built anywhere
                            if the discipline is real. Building from Granada is a statement of intent: we prioritize
                            resilience and engineering excellence over geographic hype.</p>
                        <a href="<?= $basePath ?>/manifesto.php" class="btn-institutional primary"
                            style="margin-top: 1.5rem; display: inline-block;">Read our full Manifesto →</a>
                    </div>
                </div>

                <div class="span-4">
                    <div style="padding: 2rem; border-left: 1px solid var(--accent);">
                        <h4 class="titan-label">CORE VALUES</h4>
                        <ul class="compare-list" style="margin-top: 1rem;">
                            <li>Data Neutrality</li>
                            <li>Schema Stability</li>
                            <li>Public Stewardship</li>
                            <li>Privacy by Design</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>