<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Foundation | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=10">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">INSTITUTIONAL STEWARDSHIP</div>
                <h1 class="hero-title">STEWARDING THE <br>GLOBAL REGISTRY.</h1>
                <div class="hero-desc">
                    Central.Enterprises is transitioning to a Spain-based non-profit Foundation to ensure the long-term
                    stability of the Open Company Data Standard.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Our Mission</h2>
                    <p style="font-size: 1.25rem; line-height: 1.6; opacity: 0.8; margin-bottom: 2rem;">
                        To ensure that basic corporate identity data remains a public good. We believe corporate
                        existence is a public fact, and the data describing it should be accessible without friction.
                    </p>

                    <div style="margin-bottom: 4rem;">
                        <h3 class="heading" style="font-size: 1rem; color: var(--accent); margin-bottom: 1rem;">
                            Governance & Transparency</h3>
                        <p style="opacity: 0.7; line-height: 1.8;">
                            Central.Enterprises is currently operated by Pablo Cirre (Granada, Spain) while the official
                            Foundation bylaws are under legal review for registration in the Spanish National Registry
                            of Foundations.
                        </p>
                    </div>

                    <div style="margin-bottom: 4rem;">
                        <h3 class="heading" style="font-size: 1rem; color: var(--accent); margin-bottom: 1rem;">The Open
                            Commitment</h3>
                        <p style="opacity: 0.7; line-height: 1.8;">
                            All datasets released under CC0 during this transition phase will remain CC0 in perpetuity.
                            The Foundation's role is to ensure these datasets are refreshed, validated, and kept
                            accessible to the public.
                        </p>
                    </div>

                    <a href="<?= $basePath ?>/donations.php" class="btn-institutional primary">Support the Mission</a>
                </div>

                <div class="span-4">
                    <div style="padding: 2rem; border-left: 1px solid var(--accent);">
                        <h4 class="titan-label">LEGAL STATUS</h4>
                        <p style="font-size: 0.9rem; margin-top: 1rem; opacity: 0.8;">
                            <strong>Foundation:</strong> In Formation<br>
                            <strong>Jurisdiction:</strong> Spain<br>
                            <strong>Operator:</strong> Pablo Cirre<br>
                            <strong>Address:</strong> Trajano 8, Granada
                        </p>
                    </div>

                    <div style="padding: 2rem; margin-top: 2rem; border-left: 1px solid var(--structural-line);">
                        <h4 class="titan-label">ROADMAP</h4>
                        <ul class="compare-list" style="margin-top: 1rem; font-size: 0.85rem;">
                            <li>Q1: Bylaws Finalization</li>
                            <li>Q2: Official Registration</li>
                            <li>Q3: Board Appointment</li>
                            <li>Q4: First Annual Report</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>