<?php
$basePath = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies Policy | Central.Enterprises</title>
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
                <div class="section-meta">AEPD COMPLIANCE</div>
                <h1 class="hero-title">COOKIES <br>POLICY.</h1>
                <div class="hero-desc">
                    How we use cookies to operate and improve the Central.Enterprises signals.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">1. What are cookies?</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Cookies are small files stored on your device. Some are necessary for the website to function;
                        others help us understand how the site is used.
                    </p>

                    <h2 class="section-title">2. Categories</h2>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li><strong>Necessary (Always on):</strong> Required for core functionality and security.</li>
                        <li><strong>Analytics (Optional):</strong> Help us measure usage and improve content.</li>
                        <li><strong>Functional (Optional):</strong> Remember preferences beyond what is strictly
                            necessary.</li>
                    </ul>

                    <h2 class="section-title">3. Consent Implementation</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        We do not set non-essential cookies unless you provide valid consent via our banner. Your
                        consent must be an active choice.
                    </p>

                    <h2 class="section-title">4. Managing Consent</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        You can change your choice at any time using the "Configure" option in the cookie banner or the
                        link in the footer.
                    </p>

                    <h2 class="section-title">5. Cookie List</h2>
                    <table class="data-table" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--accent); text-align: left;">
                                <th style="padding: 1rem;">Name</th>
                                <th style="padding: 1rem;">Provider</th>
                                <th style="padding: 1rem;">Purpose</th>
                                <th style="padding: 1rem;">Duration</th>
                            </tr>
                        </thead>
                        <tbody style="opacity: 0.8;">
                            <tr style="border-bottom: 1px solid var(--structural-line);">
                                <td style="padding: 1rem;"><code>titan_theme</code></td>
                                <td style="padding: 1rem;">Central.Enterprises</td>
                                <td style="padding: 1rem;">Theme preference</td>
                                <td style="padding: 1rem;">Session</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>