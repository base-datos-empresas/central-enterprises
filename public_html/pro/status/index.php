<?php
$basePath = "../..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Status | Central.Enterprises</title>
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
                <div class="section-meta">TRANSACTIONAL SIGNAL</div>
                <h1 class="hero-title">REQUEST <br>RECEIVED.</h1>
                <div class="hero-desc">
                    Your Pro access request is being processed.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <p style="font-size: 1.25rem; line-height: 1.6; opacity: 0.8; margin-bottom: 3rem;">
                        You’ll receive your delivery method (export links and/or API key) and the current dataset
                        version notes shortly.
                    </p>

                    <div
                        style="padding: 2rem; border: 1px solid var(--accent); background: rgba(var(--accent-rgb), 0.05); margin-bottom: 3rem;">
                        <h3
                            style="font-size: 0.8rem; letter-spacing: 0.1em; color: var(--accent); margin-bottom: 1rem;">
                            COMPLIANCE ALIGNMENT</h3>
                        <p style="opacity: 0.7; font-size: 0.95rem; line-height: 1.6;">
                            If you need a suppression file workflow or specific compliance alignment for your
                            jurisdiction, please request <strong>Enterprise Access</strong> or reply to your onboarding
                            email.
                        </p>
                    </div>

                    <a href="<?= $basePath ?>/" class="btn-institutional secondary">Return to Home</a>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>