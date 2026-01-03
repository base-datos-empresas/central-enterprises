<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifesto | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=isometric">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=8">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
    <script src="<?= $basePath ?>/assets/cookies.js?v=5" defer></script>
    <style>
        .manifesto-content p {
            margin-bottom: 2rem;
            font-size: 1.15rem;
            line-height: 1.7;
            max-width: 800px;
        }

        .manifesto-content h2 {
            margin-top: 4rem;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            border-left: 4px solid var(--accent);
            padding-left: 2rem;
        }

        .manifesto-content ul {
            margin-bottom: 3rem;
            list-style: none;
        }

        .manifesto-content ul li {
            padding: 1rem 0;
            border-bottom: 1px solid var(--structural-line);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            font-size: 1.1rem;
        }

        .manifesto-content ul li::before {
            content: "→";
            color: var(--accent);
            font-weight: bold;
            font-family: var(--font-header);
        }

        .toc-sidebar {
            position: sticky;
            top: 6rem;
        }

        .toc-sidebar h4 {
            font-size: 0.7rem;
            letter-spacing: 0.3em;
            color: var(--accent);
            margin-bottom: 2rem;
            text-transform: uppercase;
        }

        .toc-link {
            display: block;
            margin-bottom: 1rem;
            font-family: var(--font-header);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-body);
            transition: color 0.3s ease;
        }

        .toc-link:hover,
        .toc-link.active {
            color: var(--accent);
        }
    </style>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/cookies_banner.php'; ?>
    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero" style="padding-bottom: 5rem;">
            <div class="grid-container">
                <div class="section-meta"
                    style="grid-column: 1 / 13; margin-bottom: 2rem; border-top:none; padding-top:0;">THE STANDARD</div>
                <h1 class="hero-title">THE <br>MANIFESTO.</h1>
                <div class="hero-desc">
                    Defining the future of open company data. <br>
                    Transparency, quality, and universal access to business reality.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <!-- Sidebar TOC -->
                <div class="span-3">
                    <div class="toc-sidebar">
                        <h4>SECTIONS</h4>
                        <a href="#infrastructure" class="toc-link">Infrastructure</a>
                        <a href="#why-now" class="toc-link">Why Open Data</a>
                        <a href="#definition" class="toc-link">Our Definition</a>
                        <a href="#reference" class="toc-link">Reference Layer</a>
                        <a href="#trust" class="toc-link">Building Trust</a>
                        <a href="#mission" class="toc-link">The Mission</a>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="span-8 offset-1 manifesto-content">
                    <div id="infrastructure" style="scroll-margin-top: 8rem;">
                        <p><strong>Open data is not a trend. It is infrastructure.</strong></p>
                        <p>It is the difference between an economy where only the largest actors can see what is
                            happening, and an economy where researchers, small businesses, students, journalists,
                            developers, and public institutions work from a shared reality.</p>
                        <p>When data is open, competition levels out, innovation accelerates, and opportunities are no
                            longer reserved for those who can afford closed databases.</p>
                        <p>Central.Enterprises exists because we believe that company data must be accessible,
                            verifiable, and useful at scale. We are building a world where business information is not
                            trapped behind walls, outdated PDFs, or proprietary intermediaries.</p>
                    </div>

                    <div id="why-now" style="scroll-margin-top: 8rem;">
                        <h2>Why Open Data, Why Now</h2>
                        <p>Because the world moves too fast for closed systems. Markets change weekly. Sectors shift
                            month by month. Local economies evolve daily. Closures, openings, rebrandings, website
                            migrations, and platform changes happen constantly.</p>
                        <p>If data is locked away, it ages and dies. If data is open, it is tested, reused, improved,
                            referenced, and questioned. Openness creates accountability. Accountability creates quality.
                            Quality creates trust.</p>
                        <ul>
                            <li>A dataset can turn into hundreds or thousands of projects.</li>
                            <li>A publication can trigger local solutions.</li>
                            <li>A clear structure can become a standard adopted by others.</li>
                        </ul>
                    </div>

                    <div id="definition" style="scroll-margin-top: 8rem;">
                        <h2>What is Open Company Data?</h2>
                        <p>Our principle is simple: respect for privacy, respect for the law, focus on companies, and
                            total transparency. Open company data is not personal data. It is about organizations and
                            their public presence: the information they publish to be found and that customers use to
                            decide.</p>
                        <ul>
                            <li>We work with company-level information.</li>
                            <li>We prioritize public signals and sources with reuse rights.</li>
                            <li>We design datasets for research and legitimate commercial use.</li>
                            <li>We treat quality as an engineering discipline.</li>
                        </ul>
                    </div>

                    <div id="reference" style="scroll-margin-top: 8rem;">
                        <h2>The Global Reference Layer</h2>
                        <p>Our goal is to be the reference layer: the place people point to to understand the business
                            reality of a city, a province, a region, or a country. We want to publish data that other
                            systems can depend on.</p>
                        <p>That means clarity of structure, consistency across regions, complete documentation, and
                            versioning. That is infrastructure.</p>
                    </div>

                    <div id="trust" style="scroll-margin-top: 8rem;">
                        <h2>How We Build Trust</h2>
                        <p>Trust requires discipline. Open data without discipline becomes noise. And when noise wins,
                            the mission dies. Central.Enterprises builds trust with engineering and publishing
                            discipline.</p>
                        <p>We ensure deduplication, geographic coherence, link integrity, and freshness. We believe in
                            providing a shared foundation that empowers everyone, from small players to large
                            institutions.</p>
                    </div>

                    <div id="mission" style="scroll-margin-top: 8rem;">
                        <h2>The Mission</h2>
                        <p><strong>To make open company data rigorous enough to trust, accessible enough to use, and
                                scalable enough to matter.</strong></p>
                        <p>We are not here to be a page. We are here to be infrastructure.</p>
                        <p>Central.Enterprises. <br> Built with discipline. Published with responsibility. Open by
                            conviction. Global by design.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>