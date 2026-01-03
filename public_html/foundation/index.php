<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=11">
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=isometric">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>
    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">INSTITUTIONAL</div>
                <h1 class="hero-title">THE<br>FOUNDATION.</h1>
                <div class="hero-desc">
                    Central.Enterprises is transitioning into a non-profit Foundation based in Spain to steward the Open
                    Standard forever.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="heading" style="margin-bottom:2rem;">Governance Model</h2>
                    <p style="margin-bottom:2rem; opacity:0.8; font-size:1.1rem; line-height:1.6;">
                        Data infrastructure should not be owned by a private monopoly. Our mission is to treat corporate
                        registry data as a public utility—available to all, verified by cryptographic proof, and
                        sustained by a high-fidelity paid layer.
                    </p>

                    <div style="margin-bottom:4rem;">
                        <h3 class="titan-label" style="margin-bottom:1rem;">Status: In Formation</h3>
                        <p style="opacity:0.8; line-height:1.6;">
                            The "Central.Enterprises Foundation" is currently undergoing registration with the Spanish
                            Ministry of Justice.
                            During this interim period, the platform is legally operated by Pablo Cirre as a steward.
                            Upon official inscription, all assets and intellectual property will transfer to the
                            Foundation.
                        </p>
                    </div>

                    <h2 class="heading" style="margin-bottom:2rem;">Roadmap 2026</h2>
                    <ul class="compare-list" style="margin-bottom:3rem;">
                        <li
                            style="margin-bottom:1rem; padding-bottom:1rem; border-bottom:1px solid var(--structural-line);">
                            <strong style="color:var(--text-header);">Q1: Legal Registration</strong><br>
                            Completion of statutes and endowment registration in Granada, Spain.
                        </li>
                        <li
                            style="margin-bottom:1rem; padding-bottom:1rem; border-bottom:1px solid var(--structural-line);">
                            <strong style="color:var(--text-header);">Q2: Standard v2.0</strong><br>
                            Expansion of the JSON schema to include beneficial ownership signals.
                        </li>
                        <li
                            style="margin-bottom:1rem; padding-bottom:1rem; border-bottom:1px solid var(--structural-line);">
                            <strong style="color:var(--text-header);">Q3: Automated Snapshots</strong><br>
                            Daily cryptographic proofs posted to public immutable logs.
                        </li>
                    </ul>

                </div>

                <div class="span-4">
                    <div style="background:var(--bg-secondary); padding:2rem; border:1px solid var(--accent);">
                        <h3 class="titan-label" style="color:var(--accent);">Transparency</h3>
                        <div style="margin-top:1.5rem;">
                            <div style="display:flex; justify-content:space-between; margin-bottom:1rem;">
                                <span style="opacity:0.7;">Jurisdiction</span>
                                <strong>Spain (EU)</strong>
                            </div>
                            <div style="display:flex; justify-content:space-between; margin-bottom:1rem;">
                                <span style="opacity:0.7;">Registry</span>
                                <strong>Min. Justicia</strong>
                            </div>
                            <div style="display:flex; justify-content:space-between; margin-bottom:1rem;">
                                <span style="opacity:0.7;">Status</span>
                                <strong style="color:var(--status-maintenance);">Formation</strong>
                            </div>
                        </div>
                        <a href="<?= $basePath ?>/legal/notice/" class="btn-institutional secondary"
                            style="width:100%; text-align:center; margin-top:1rem;">Legal Details</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>