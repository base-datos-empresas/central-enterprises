<?php
$basePath = "../..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal Notice | Central.Enterprises</title>
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
                <div class="section-meta">LSSI COMPLIANCE</div>
                <h1 class="hero-title">LEGAL <br>NOTICE.</h1>
                <div class="hero-desc">
                    Official identification and ownership of the Central.Enterprises platform.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Foundation in formation (Spain)</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Central.Enterprises is transitioning into a Spain-based foundation that will become the official
                        legal operator and steward of CC0 releases and the Open Company Data Standard. During formation,
                        the project is operated by Pablo Cirre. On registration, the foundation’s registry details and
                        official contact points will be published here, and governance will formally transfer.
                    </p>

                    <h2 class="section-title">1. Who we are</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">
                        As noted, the foundation is being registered in Spain. Until then, the temporary operator is:
                    </p>
                    <div
                        style="padding: 2rem; border-left: 2px solid var(--accent); background: rgba(var(--accent-rgb), 0.05); margin-bottom: 2rem;">
                        <p style="margin-bottom: 0.5rem;"><strong>Legal Operator:</strong> Pablo Cirre (acting as
                            Steward for Central.Enterprises Foundation in Formation)</p>
                        <p style="margin-bottom: 0.5rem;"><strong>Tax ID (NIF):</strong> [Pending Registration]</p>
                        <p style="margin-bottom: 0.5rem;"><strong>Address:</strong> Trajano 8, Granada, Spain (18002)
                        </p>
                        <p style="margin-bottom: 0.5rem;"><strong>Jurisdiction:</strong> Courts of Granada, Spain.</p>
                        <p style="font-size:0.8rem; margin-top:1rem; opacity:0.7;"><em>Note: Upon official inscripion in
                                the Registry of Foundations, ownership and governance will formally transfer to the
                                Foundation entity.</em></p>
                    </div>
                    <p style="opacity: 0.7; font-size: 0.9rem; margin-bottom: 3rem;">
                        This Legal Notice is provided to comply with Spanish information society rules (LSSI).
                    </p>

                    <h2 class="section-title">2. Purpose of this website</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 1rem;">Central.Enterprises provides:</p>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li><strong>Open Data:</strong> Company data released under CC0 (public domain), intended for
                            broad reuse and research.</li>
                        <li><strong>Pro Access:</strong> Optional paid datasets and services, subject to a separate Pro
                            license and acceptable use policy.</li>
                    </ul>

                    <h2 class="section-title">3. Scope & Disclaimers</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">
                        While we apply quality controls, data may be incomplete or outdated. This website is provided
                        “as is”, without warranties of any kind. You are responsible for validating information before
                        acting on it.
                    </p>

                    <h2 class="section-title">4. Intellectual Property</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Website texts, design, and brand assets are protected by law. Open data is governed by the Open
                        Data Terms (CC0).
                    </p>

                    <h2 class="section-title">5. External Links</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        We do not control and are not responsible for the content or practices of third-party websites
                        linked from this site.
                    </p>

                    <h2 class="section-title">6. Contact</h2>
                    <p style="opacity: 0.8; line-height: 1.6;">
                        For legal notices or data requests, please use our official
                        <a href="<?= $basePath ?>/contact/" style="color:var(--accent)">Contact Form</a> or the
                        <a href="<?= $basePath ?>/data/requests/" style="color:var(--accent)">Data Requests</a>
                        channel.
                        channel.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>