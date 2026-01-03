<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support the Foundation | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=transparent">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=11">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">MISSION STEWARDSHIP</div>
                <h1 class="hero-title">SUPPORT THE <br>FOUNDATION.</h1>
                <div class="hero-desc">
                    Helping build a global open standard for corporate reality. Central.Enterprises is becoming a
                    Spain-based foundation to steward CC0 Open Data and the Open Company Data Standard long-term. This
                    is not a marketing promise—it’s an operating model designed for permanence, governance, and
                    transparency.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Where we are today</h2>
                    <p style="font-size: 1.25rem; line-height: 1.6; opacity: 0.8; margin-bottom: 2rem;">
                        Until the foundation is registered, Central.Enterprises is operated by Pablo Cirre (Spain,
                        Trajano 8), and any support is treated accordingly.
                    </p>

                    <h2 class="section-title">What changes at registration</h2>
                    <p style="opacity: 0.7; line-height: 1.8; margin-bottom: 1rem;">When the foundation is registered:
                    </p>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li>The foundation becomes the official steward of the standard and CC0 releases.</li>
                        <li>Governance becomes formal including trustees, published decisions, and version policy.</li>
                        <li>Transparency reporting becomes a scheduled obligation.</li>
                        <li>Donation mechanics will be updated to reflect the foundation’s legal status.</li>
                    </ul>

                    <h2 class="section-title">Tax Deductibility</h2>
                    <p style="opacity: 0.7; line-height: 1.8; margin-bottom: 3rem;">
                        We will only describe donations as tax-deductible once the foundation is registered and eligible
                        to issue the required certificates. Until then, we do not present support as deductible.
                    </p>

                    <h2 class="section-title">Why support matters</h2>
                    <p style="opacity: 0.7; line-height: 1.8; margin-bottom: 2rem;">
                        Open data at scale is not “free to run.” Stewardship requires infrastructure, validation,
                        refresh cycles, and documentation. Pro funds this through professional access; support helps
                        expand the CC0 core faster and keep the standard stable for everyone.
                    </p>

                    <a href="<?= $basePath ?>/contact/" class="btn-institutional primary">Support the Foundation
                        Mission</a>
                </div>

                <div class="span-4">
                    <div
                        style="padding: 2rem; border-left: 1px solid var(--accent); background: rgba(var(--accent-rgb), 0.05);">
                        <h4 class="titan-label">SUPPORT STATUS</h4>
                        <p style="font-size: 0.85rem; margin-top: 1rem;">
                            <strong>Eligibility:</strong> Pending registration.<br>
                            <strong>Stewardship:</strong> Central.Enterprises Foundation (in formation).
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>
