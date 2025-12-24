<?php
$basePath = "../../";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COOKIES | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../assets/titan.css?v=8">
    <script src="../../assets/theme-toggle.js?v=7" defer></script>
    <script src="../../assets/cookies.js?v=5" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include '../../includes/cookies_banner.php'; ?>

    <nav>
        <div class="grid-container">
            <div class="nav-content">
                <div class="logo">
                    <a href="/" style="text-decoration:none; color:inherit">CENTRAL ENTERPRISES</a>
                </div>
                <button id="theme-toggle" class="theme-btn" title="Toggle Theme"></button>
            </div>
        </div>
    </nav>

    <main>
        <section class="section" style="padding-top:8rem">
            <div class="grid-container">
                <div class="section-meta">COOKIE POLICY</div>
                <div class="section-content">
                    <h1 class="hero-title" style="font-size:3.5rem; margin-bottom:3rem; grid-column: span 12;">COOKIE
                        PROTOCOLS</h1>

                    <div style="margin-top:4rem">
                        <p style="margin-bottom:2rem"><strong>1. TECHNICAL COOKIES</strong></p>
                        <p style="opacity:0.8; line-height:1.8">We use essential technical cookies to maintain site
                            stability and theme preferences. These do not track personal identities.</p>

                        <div style="margin-top:3rem"></div>

                        <p style="margin-bottom:2rem"><strong>2. ANALYTICS</strong></p>
                        <p style="opacity:0.8; line-height:1.8">Minimal, privacy-first analytics may be used to measure
                            load performance across regions. No behavioral profiling is active.</p>

                        <div style="margin-top:3rem"></div>

                        <p style="margin-bottom:2rem"><strong>3. CONSENT MANAGEMENT</strong></p>
                        <p style="opacity:0.8; line-height:1.8">Users can acknowledge or decline non-essential technical
                            markers at any time. Decline state is honored per session.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>