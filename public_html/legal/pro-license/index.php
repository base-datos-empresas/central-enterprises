<?php
$basePath = "../..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro Data License | Central.Enterprises</title>
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
                <div class="section-meta">COMMERCIAL TERMS</div>
                <h1 class="hero-title">PRO DATA <br>LICENSE.</h1>
                <div class="hero-desc">
                    Pro is licensed access to enrichment and delivery mechanisms (exports and/or APIs). It exists to
                    fund the stewardship of CC0 releases and the Open Company Data Standard under a foundation-led
                    model.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-8">
                    <h2 class="section-title">Foundation Transition</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Central.Enterprises is in formation as a Spain-based foundation. Until registration, the service
                        is operated by Pablo Cirre (see <a href="<?= $basePath ?>/legal/notice/"
                            style="color:var(--accent)">Legal Notice</a>). Once registered, the foundation becomes the
                        steward of governance and public releases, and the licensing entity will be clearly published.
                        All changes will be documented with effective dates.
                    </p>

                    <h2 class="section-title">Intended Use</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 1rem;">Pro is intended for:</p>
                    <ul class="compare-list" style="margin-bottom: 3rem;">
                        <li>Market intelligence and segmentation.</li>
                        <li>Data enrichment for internal CRMs.</li>
                        <li>Partner qualification and due diligence.</li>
                        <li>Research, analytics, and internal tooling.</li>
                    </ul>

                    <h2 class="section-title">Contact Channels</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Pro may include business contact channels such as websites and emails. These fields are provided
                        for professional context and operational workflows. We aim to prioritize role-based business
                        addresses and provide a straightforward suppression process for any address that should not
                        appear.
                    </p>

                    <h2 class="section-title">Acceptable Use</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        You must use Pro data lawfully and responsibly. Pro is not a “spam list,” and it must not be
                        used for unlawful unsolicited outreach, harassment, or misuse. Customers are responsible for
                        compliance with applicable communications and privacy laws, including opt-out handling and
                        suppression requests.
                    </p>

                    <h2 class="section-title">Redistribution</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Pro data may not be republished, resold, or made available to third parties except as explicitly
                        permitted under an enterprise agreement.
                    </p>

                    <h2 class="section-title">Quality & Change</h2>
                    <p style="opacity: 0.8; line-height: 1.6; margin-bottom: 3rem;">
                        Pro data is updated and can change. We do not guarantee deliverability of emails or permanence
                        of contact channels. Provenance and timestamps are provided so you can build robust workflows.
                    </p>

                    <h2 class="section-title">Enforcement</h2>
                    <p style="opacity: 0.8; line-height: 1.6;">
                        We may suspend access if we detect credential sharing, automated abuse, or use that conflicts
                        with acceptable use rules.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>
