<?php
$basePath = "../../";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRIVACY | Central.Enterprises</title>
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
                <div class="section-meta">DATA PROTECTION</div>
                <div class="section-content">
                    <h1 class="hero-title" style="font-size:3.5rem; margin-bottom:3rem; grid-column: span 12;">DATA
                        PRIVACY PROTOCOLS</h1>

                    <div style="margin-top:4rem">
                        <p style="margin-bottom:2rem"><strong>1. DATA COLLECTION</strong></p>
                        <p style="opacity:0.8; line-height:1.8">Central Enterprises collects minimal operational data
                            required for system functionality and
                            communication. This includes contact information provided voluntarily via secure uplinks.
                        </p>

                        <div style="margin-top:3rem"></div>

                        <p style="margin-bottom:2rem"><strong>2. DATA USAGE</strong></p>
                        <p style="opacity:0.8; line-height:1.8">Data is used solely for operational communication and
                            service delivery. We do not distribute
                            payload data to third-party entities without explicit authorization.</p>

                        <div style="margin-top:3rem"></div>

                        <p style="margin-bottom:2rem"><strong>3. SECURITY</strong></p>
                        <p style="opacity:0.8; line-height:1.8">All stored data is encrypted using standard industry
                            protocols. Access is restricted to
                            authorized personnel only.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>