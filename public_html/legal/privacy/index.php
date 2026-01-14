<?php
$basePath = "../..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=logo_native">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=11">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">GDPR COMPLIANCE</div>
                <h1 class="hero-title">PRIVACY <br>POLICY.</h1>
                <div class="hero-desc">
                    How we handle personal data during the Central.Enterprises foundation transition.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Foundation transition and stewardship model</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Central.Enterprises is being established as a foundation in Spain to ensure durable stewardship
                        of open data releases, governance, and compliance. During formation, the controller is the
                        temporary operator listed below. After registration, this policy will be updated to reflect the
                        foundation’s official identity and responsibilities.
                    </p>

                    <h2 class="section-title">1. Data Controller</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">
                        As noted, during the foundation formation period, the temporary controller is:
                    </p>
                    <div
                        style="padding: 2rem; border-left: 2px solid var(--accent); background: rgba(var(--accent-rgb), 0.05); margin-bottom: 2rem;">
                        <p><strong>Pablo Cirre</strong><br>
                            Address: España, Trajano 8, Granada (Spain)<br>
                            Tax ID: ESB74657091 (Provisional)<br>
                            Email: INFO@CENTRAL.ENTERPRISES</p>
                    </div>

                    <h2 class="section-title">2. Scope</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        This policy applies to website visitors, people who contact us, Pro customers, and data subjects
                        whose information may appear in Pro datasets.
                    </p>

                    <h2 class="section-title">3. Categories of Data</h2>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li><strong>Contact details:</strong> Name, email, messge content.</li>
                        <li><strong>Account data:</strong> Billing details, invoices.</li>
                        <li><strong>Technical logs:</strong> IP address, user agent, timestamps.</li>
                        <li><strong>Cookies:</strong> Preference signals.</li>
                    </ul>

                    <h2 class="section-title">4. Purposes & Legal Bases</h2>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li><strong>Operation & Security:</strong> Legitimate interest.</li>
                        <li><strong>Responding to requests:</strong> Legitimate interest / Pre-contractual.</li>
                        <li><strong>Pro services:</strong> Performance of a contract.</li>
                        <li><strong>Compliance:</strong> Legal obligation (tax/accounting).</li>
                    </ul>

                    <h2 class="section-title">5. Open Data vs Pro Data</h2>
                    <div style="margin-bottom: 3rem;">
                        <p style="margin-bottom: 1rem;"><strong>Open Data (CC0):</strong> Intended to focus on business
                            entities and avoid personal data. We assess and remove personal data if discovered.</p>
                        <p><strong>Pro Datasets (Paid):</strong> May include business contact channels. We prioritize
                            role-based emails (info@) and avoid personal-name emails by default.</p>
                    </div>

                    <h2 class="section-title">6. Rights & Requests</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 2rem;">
                        You have the right to access, rectification, erasure, and objection. You can also lodge a
                        complaint with the AEPD.
                    </p>
                    <p style="opacity: 0.8; line-height: 1.6;">
                        Submit correction or removal requests at <a href="<?= $basePath ?>/data/requests/"
                            style="color:var(--accent)">/data-requests</a> or email
                        <strong>INFO@CENTRAL.ENTERPRISES</strong>.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>