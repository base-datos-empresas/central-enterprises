<?php
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Company Data Standard | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <!-- Titan Core Styles -->
    <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=10">
    <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png">
    <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include $basePath . '/includes/header.php'; ?>

    <main>
        <header class="hero">
            <div class="grid-container">
                <div class="section-meta">SPECIFICATION V1.0</div>
                <h1 class="hero-title">A STANDARD <br>FOR REALITY.</h1>
                <div class="hero-desc">
                    The Open Company Data Standard (v1) provides a unified schema for corporate identity, provenance,
                    and data integrity across jurisdictions.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="span-12">
                    <h2 class="section-title">CC0 Public Core</h2>
                    <p style="margin-bottom: 2rem; opacity: 0.8;">The minimum required fields for a record to be
                        considered interoperable within the Central.Enterprises ecosystem.</p>

                    <div style="overflow-x: auto;">
                        <table class="data-table" style="width: 100%; border-collapse: collapse; margin-bottom: 3rem;">
                            <thead>
                                <tr style="border-bottom: 2px solid var(--accent); text-align: left;">
                                    <th style="padding: 1rem;">Field</th>
                                    <th style="padding: 1rem;">Type</th>
                                    <th style="padding: 1rem;">Description</th>
                                </tr>
                            </thead>
                            <tbody style="opacity: 0.8;">
                                <tr style="border-bottom: 1px solid var(--structural-line);">
                                    <td style="padding: 1rem;"><code>entity_id</code></td>
                                    <td style="padding: 1rem;">UUID</td>
                                    <td style="padding: 1rem;">Stable identifier across sync cycles.</td>
                                </tr>
                                <tr style="border-bottom: 1px solid var(--structural-line);">
                                    <td style="padding: 1rem;"><code>name</code></td>
                                    <td style="padding: 1rem;">String</td>
                                    <td style="padding: 1rem;">Official registered name.</td>
                                </tr>
                                <tr style="border-bottom: 1px solid var(--structural-line);">
                                    <td style="padding: 1rem;"><code>jurisdiction</code></td>
                                    <td style="padding: 1rem;">ISO2</td>
                                    <td style="padding: 1rem;">Country code (e.g., ES, US, UK).</td>
                                </tr>
                                <tr style="border-bottom: 1px solid var(--structural-line);">
                                    <td style="padding: 1rem;"><code>reg_number</code></td>
                                    <td style="padding: 1rem;">String</td>
                                    <td style="padding: 1rem;">Official identifier (NIF, EIN, CRN).</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 class="section-title">Provenance & Integrity</h2>
                    <div class="grid-container" style="padding: 0; gap: 2rem;">
                        <div class="span-6">
                            <h3 class="heading" style="font-size: 1rem; color: var(--accent); margin-bottom: 1rem;">
                                Trust but Verify</h3>
                            <p style="opacity: 0.7; line-height: 1.8;"> Every record contains a <code>record_hash</code>
                                (SHA-256) and a <code>retrieved_at</code> timestamp. This allows users to verify that
                                data has not been modified since its extraction from the official source.</p>
                        </div>
                        <div class="span-6">
                            <h3 class="heading" style="font-size: 1rem; color: var(--accent); margin-bottom: 1rem;">
                                Interoperable</h3>
                            <p style="opacity: 0.7; line-height: 1.8;">The standard is designed to be compatible with
                                DCAT-AP and other global data catalog specifications, ensuring it can be integrated into
                                governmental and academic workflows.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>