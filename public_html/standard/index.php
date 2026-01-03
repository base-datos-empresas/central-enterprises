<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Open Company Data Standard v1.1 | Central.Enterprises</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
    rel="stylesheet">
  <!-- Titan Core Styles -->
  <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=11">
  <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png">
  <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
  <div class="grid-bg"></div>
  <?php include $basePath . '/includes/header.php'; ?>

  <main>
    <header class="hero">
      <div class="grid-container">
        <div class="section-meta">TECHNICAL SPECIFICATION</div>
        <h1 class="hero-title">STANDARD v1.1</h1>
        <div class="hero-desc">
          The schema definition for normalized corporate registry data. Version 1.1 emphasizes verifiability
          through cryptographic hashing.
        </div>
      </div>
    </header>

    <section class="section">
      <div class="grid-container">
        <div class="span-8">
          <h2 class="heading" style="margin-bottom:2rem;">Core Schema Definition</h2>
          <p style="margin-bottom:2rem; opacity:0.8;">
            Central.Enterprises normalizes diverse jurisdictional formats into a single, predictable JSON
            object.
          </p>

          <div
            style="background:var(--bg-secondary); border:1px solid var(--structural-line); padding:2rem; overflow-x:auto;">
            <pre style="color:var(--text-body); font-family:monospace; font-size:0.9rem;">
{
  "$schema": "https://central.enterprises/schemas/v1.1/company.json",
  "type": "object",
  "properties": {
    "entity_id": {
      "type": "string",
      "format": "uuid",
      "description": "Immutable internal ID, persistent across snapshots."
    },
    "jurisdiction": {
      "type": "string",
      "pattern": "^[A-Z]{2}$",
      "description": "ISO 3166-1 alpha-2 code (e.g., ES, US)."
    },
    "reg_number": {
      "type": "string",
      "description": "Official local identifier (NIF, EIN, CRN)."
    },
    "name": {
      "type": "string",
      "description": "Registered legal name."
    },
    "status": {
      "type": "string",
      "enum": ["active", "dissolved", "liquidation", "unknown"],
      "default": "unknown"
    },
    "founding_date": {
      "type": "string",
      "format": "date"
    },
    "retrieved_at": {
      "type": "string",
      "format": "date-time",
      "description": "ISO 8601 timestamp of extraction."
    },
    "record_hash": {
      "type": "string",
      "description": "SHA-256 hash of the source record for verifiability."
    },
    "source_url": {
      "type": "string",
      "format": "uri"
    }
  },
  "required": ["entity_id", "jurisdiction", "name", "reg_number", "retrieved_at"]
}
</pre>
          </div>

          <h2 class="heading" style="margin-top:4rem; margin-bottom:2rem;">Manifest Protocol</h2>
          <p style="margin-bottom:2rem; opacity:0.8;">
            Every dataset download includes a `dataset_manifest.json` for integrity verification.
          </p>

          <div
            style="background:var(--bg-secondary); border:1px solid var(--structural-line); padding:2rem; overflow-x:auto;">
            <pre style="color:var(--text-body); font-family:monospace; font-size:0.9rem;">
{
  "build_id": "20260103-ES-FULL",
  "generated_at": "2026-01-03T09:00:00Z",
  "files": [
    {
      "name": "companies.csv",
      "rows": 10420,
      "sha256": "a1b2c3d4..."
    }
  ],
  "maintainer": "Central.Enterprises Foundation"
}
</pre>
          </div>

        </div>

        <div class="span-4">
          <div style="position:sticky; top:8rem; padding:2rem; border-left:1px solid var(--structural-line);">
            <div class="titan-label" style="margin-bottom:1rem;">Actions</div>
            <a href="#" class="btn-institutional primary" style="width:100%; margin-bottom:1rem;">Download
              JSON Schema</a>
            <a href="<?= $basePath ?>/data" class="btn-institutional secondary" style="width:100%;">View
              Live Data</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>
