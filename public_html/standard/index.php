<?php
require_once __DIR__ . '/../includes/security_headers.php';
$basePath = "..";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Global Company Data Standard v1.1 | Central.Enterprises</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
    rel="stylesheet">
  <!-- Titan Core Styles -->
  <link rel="stylesheet" href="<?= $basePath ?>/assets/titan.css?v=101">
  <link rel="icon" type="image/png" href="<?= $basePath ?>/assets/favicon.png?v=logo_native">
  <script src="<?= $basePath ?>/assets/theme-toggle.js?v=7" defer></script>
</head>

<body data-theme="titan-dark">
  <div class="grid-bg"></div>
  <?php include $basePath . '/includes/header.php'; ?>

  <main>
    <header class="hero">
      <div class="grid-container">
        <div class="section-meta">TECHNICAL SPECIFICATION</div>
        <h1 class="hero-title">
          <span style="color: #64748b; font-weight:800;">STANDARD</span> <br>
          <span style="color: var(--accent); font-weight:300;">v1.1 SPECIFICATION</span>
        </h1>
        <div class="hero-desc" style="max-width: 700px;">
          The definitive open schema for normalized corporate registry data.
          Designed for strict interoperability, legal safety, and citation at scale.
        </div>
      </div>
    </header>

    <section class="section">
      <div class="grid-container">
        <div class="span-8">

          <!-- 1. MISSION -->
          <h2 class="heading" style="margin-bottom:1.5rem;">Why This Standard Exists</h2>
          <p style="margin-bottom:2rem; opacity:0.8; line-height:1.6;">
            Company data is currently fragmented across thousands of local formats and proprietary silos.
            Central.Enterprises provides a <strong>unified global layer</strong> that serves as public infrastructure
            for economic development, academic research, and system interoperability. By normalizing data into a single,
            predictable format, we enable anyone to build reliable tools on top of the world's business registry.
          </p>

          <!-- 2. TWO-TIER MODEL -->
          <h2 class="heading" style="margin-top:3rem; margin-bottom:1.5rem;">Two-Tier Data Model</h2>
          <p style="margin-bottom:2rem; opacity:0.8; line-height:1.6;">
            To balance public transparency with commercial viability and safety, we operate two strict data tiers
            that share <strong>identical structure</strong> (same rows, same columns).
          </p>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:2rem;">
            <div style="background:var(--bg-secondary); padding:1.5rem; border:1px solid var(--structural-line);">
              <div style="display:flex; justify-content:space-between; margin-bottom: 0.5rem;">
                <h3 class="titan-label" style="color:var(--text-header);">1. OpenData Tier</h3>
                <span class="tier-badge tier-od">OpenData</span>
              </div>
              <p style="font-size:0.9rem; opacity:0.8;">
                Published for education, research, and public interest. Sensitive or proprietary fields (like direct
                contacts) are <strong>masked</strong> to ensure safety while maintaining structural integrity.
              </p>
            </div>
            <div style="background:var(--bg-secondary); padding:1.5rem; border:1px solid var(--accent);">
              <div style="display:flex; justify-content:space-between; margin-bottom: 0.5rem;">
                <h3 class="titan-label" style="color:var(--accent);">2. Premium (Pro) Tier</h3>
                <span class="tier-badge tier-premium">Premium</span>
              </div>
              <p style="font-size:0.9rem; opacity:0.8;">
                Designed for operational intelligence. Includes full enrichment values for all columns, such as verified
                direct emails, active social signals, and spending indicators.
              </p>
            </div>
          </div>

          <!-- 3. GLOBAL IDENTITY -->
          <h2 class="heading" style="margin-top:3rem; margin-bottom:1.5rem;">Global Identity Strategy</h2>
          <p style="margin-bottom:1.5rem; opacity:0.8;">
            Identifying a unique company globally is a complex challenge. We employ a tripartite strategy:
          </p>
          <ul class="titan-list" style="margin-bottom:2rem; opacity:0.9;">
            <li><strong>Stable ID (sdc_id):</strong> An internal alphanumeric identifier for long-term tracking,
              ensuring references remain stable across merges or updates.</li>
            <li><strong>Digital Identity (Domain):</strong> We treat a company's primary website domain as its most
              practical global key, enabling reproducible research on digital presence.</li>
            <li><strong>Official Registry (Canonical):</strong> We normalize local government identifiers (CIF, EIN,
              CRN) into a standardized <code>COUNTRY-NUMBER</code> format to support cross-border economic analysis.
            </li>
          </ul>

          <!-- 4. CORE SCHEMA TABLE -->
          <h2 class="heading" style="margin-top:3rem; margin-bottom:1.5rem;">Core Schema v1.1</h2>
          <p style="margin-bottom:2rem; opacity:0.8;">
            The Standard enforces a fixed 37-column layout. The column order is immutable to ensure CSV parser
            compatibility.
          </p>

          <div style="overflow-x:auto; border:1px solid var(--structural-line);">
            <table style="width:100%; text-align:left; border-collapse:collapse; background:var(--bg-secondary);">
              <thead>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <th style="padding:.8rem; color:var(--text-header); font-size:0.75rem;">IDX</th>
                  <th style="padding:.8rem; color:var(--text-header); font-size:0.75rem;">FIELD NAME</th>
                  <th style="padding:.8rem; color:var(--text-header); font-size:0.75rem;">OPENDATA STATUS</th>
                  <th style="padding:.8rem; color:var(--text-header); font-size:0.75rem;">DESCRIPTION</th>
                </tr>
              </thead>
              <tbody style="font-family:'Inter', sans-serif; font-size:0.85rem; color:var(--text-body);">
                <!-- 1 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">1</td>
                  <td style="padding:.8rem;">sdc_id</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">Stable internal UUID.</td>
                </tr>
                <!-- 2 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">2</td>
                  <td style="padding:.8rem;">name</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">Legal registered name.</td>
                </tr>
                <!-- 3 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">3</td>
                  <td style="padding:.8rem;">website</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">Primary domain (normalized).</td>
                </tr>
                <!-- 4 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">4</td>
                  <td style="padding:.8rem;">country_code</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">ISO 3166-1 alpha-2.</td>
                </tr>
                <!-- 5 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">5</td>
                  <td style="padding:.8rem;">province_region</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">Administrative region.</td>
                </tr>
                <!-- 6 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">6</td>
                  <td style="padding:.8rem;">city</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">City or municipality.</td>
                </tr>
                <!-- 7 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">7</td>
                  <td style="padding:.8rem;">reg_number</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Local identifier (e.g. B12345678).</td>
                </tr>
                <!-- 8 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">8</td>
                  <td style="padding:.8rem;">reg_number_type</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Label of ID (e.g. "NIF").</td>
                </tr>
                <!-- 9 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">9</td>
                  <td style="padding:.8rem;">reg_number_country</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Country of registration.</td>
                </tr>
                <!-- 10 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">10</td>
                  <td style="padding:.8rem;">reg_number_canonical</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Format: <code>CC-NUMBER</code>.</td>
                </tr>
                <!-- 11 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">11</td>
                  <td style="padding:.8rem;">main_category</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">Primary taxonomy classification.</td>
                </tr>
                <!-- 12 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">12</td>
                  <td style="padding:.8rem;">categories</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">Full taxonomy list (pipe-separated).</td>
                </tr>
                <!-- 13 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">13</td>
                  <td style="padding:.8rem;">RSS</td>
                  <td style="padding:.8rem;"><span style="color:var(--success);">OPEN</span></td>
                  <td style="padding:.8rem;">News feed URL.</td>
                </tr>
                <!-- 14-37 -->
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">14</td>
                  <td style="padding:.8rem;">emails</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Verified contact emails.</td>
                </tr>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">15</td>
                  <td style="padding:.8rem;">phone</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Main switchboard number.</td>
                </tr>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">16</td>
                  <td style="padding:.8rem;">address</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Full postal address.</td>
                </tr>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">17</td>
                  <td style="padding:.8rem;">CentralRating</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Internal trust score.</td>
                </tr>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">18</td>
                  <td style="padding:.8rem;">description</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Company description text.</td>
                </tr>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">19-20</td>
                  <td style="padding:.8rem;">workday_timing / closed_on</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Operational hours data.</td>
                </tr>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">21</td>
                  <td style="padding:.8rem;">featured_image</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Primary brand image URL.</td>
                </tr>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">22-23</td>
                  <td style="padding:.8rem;">is_spending_on_ads / competitors</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">Commercial signals.</td>
                </tr>
                <tr style="border-bottom:1px solid var(--structural-line);">
                  <td style="padding:.8rem; color:var(--text-muted);">24-37</td>
                  <td style="padding:.8rem;">Social Fields (LinkedIn...Medium)</td>
                  <td style="padding:.8rem; opacity:0.5;">MASKED</td>
                  <td style="padding:.8rem;">14 platform-specific columns.</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- 5. TECHNICAL SPECS -->
          <h2 class="heading" style="margin-top:3rem; margin-bottom:1.5rem;">Technical Specifications</h2>
          <div style="background:var(--bg-secondary); padding:1.5rem; border:1px solid var(--structural-line);">
            <ul class="titan-list" style="columns: 2; margin:0;">
              <li><strong>Format:</strong> CSV (Comma Separated)</li>
              <li><strong>Encoding:</strong> UTF-8</li>
              <li><strong>Quoting:</strong> RFC 4180 Compliant</li>
              <li><strong>Line Break:</strong> CRLF or LF</li>
              <li><strong>True/False:</strong> output as <code>true</code> / <code>false</code></li>
              <li><strong>Empty Values:</strong> Empty string <code>""</code></li>
              <li><strong>Dates:</strong> ISO 8601 (YYYY-MM-DD)</li>
              <li><strong>Multivalue:</strong> Pipe separator <code>|</code></li>
            </ul>
            <p style="margin-top:1.5rem; border-top:1px solid var(--structural-line); padding-top:1rem; opacity:0.8;">
              <strong>Normalization Rules:</strong> Websites are canonicalized (lowercase host). Country codes are
              strict ISO 3166-1 alpha-2. Registry numbers are stripped of delimiters for the canonical field. Builds are
              deterministic; the same input always yields the same SHA-256 hash.
            </p>
          </div>

          <!-- 6. MANIFEST & GOVERNANCE -->
          <h2 class="heading" style="margin-top:3rem; margin-bottom:1.5rem;">Dataset Manifest & Provenance</h2>
          <p style="margin-bottom:1.5rem; opacity:0.8;">
            Every distribution is accompanied by a <code>dataset_manifest.json</code> providing cryptographic proof of
            integrity and build metadata.
          </p>
          <div
            style="background:var(--code-bg); padding:1.5rem; border:1px solid var(--structural-line); overflow-x:auto;">
            <pre style="color:var(--text-mono); font-family:monospace; font-size:0.85rem;">
{
  "schema_version": "sdc-1.1",
  "tier": "opendata",
  "build_id": "2026-01-09-PUBLIC",
  "generated_at": "2026-01-09T12:00:00Z",
  "files": [
    {
      "filename": "companies_es.csv",
      "rows": 52000,
      "sha256": "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"
    }
  ],
  "maintainer": "Central.Enterprises Foundation",
  "license": "CC BY 4.0",
  "notes": "Masked fields are exported as empty strings."
}</pre>
          </div>

          <p style="margin-top:1.5rem; opacity:0.8;">
            <strong>Provenance:</strong> OpenData values are populated only when the source provenance allows for open
            redistribution. If the data source is restrictive, the value is masked in the Open tier but preserved in the
            Premium tier, ensuring total legal compliance.
          </p>

          <!-- 7. EXAMPLE DATA -->
          <h2 class="heading" style="margin-top:3rem; margin-bottom:1.5rem;">Data Examples</h2>

          <h3 class="titan-label" style="margin-bottom:0.5rem; color:var(--text-header);">CSV Header</h3>
          <div
            style="background:var(--code-bg); padding:1rem; border:1px solid var(--structural-line); overflow-x:auto; margin-bottom:1.5rem;">
            <code
              style="font-family:monospace; white-space:nowrap; color:var(--text-mono);">sdc_id,name,website,country_code,province_region,city,reg_number,reg_number_type...[full list]...Medium</code>
          </div>

          <h3 class="titan-label" style="margin-bottom:0.5rem; color:var(--success);">OpenData Row Example</h3>
          <div
            style="background:var(--code-bg); padding:1rem; border:1px solid var(--success); overflow-x:auto; margin-bottom:1.5rem;">
            <code style="font-family:monospace; white-space:nowrap; color:var(--text-mono);">
              "550e8400-e29b-41d4-a716-446655440000","Acme Corp","acme.com","US","California","San Francisco","","","","", "Technology","Tech|Software","https://acme.com/rss","","","","","","","","","","","","","","","","","","","","","","","",""
            </code>
          </div>

          <h3 class="titan-label" style="margin-bottom:0.5rem; color:var(--accent);">Premium Row Example</h3>
          <div style="background:var(--code-bg); padding:1rem; border:1px solid var(--accent); overflow-x:auto;">
            <code style="font-family:monospace; white-space:nowrap; color:var(--text-mono);">
              "550e8400-e29b-41d4-a716-446655440000","Acme Corp","acme.com","US","California","San Francisco","12-3456789","EIN","US","US-123456789", "Technology","Tech|Software","https://acme.com/rss","contact@acme.com","+1-555-0199","1 Market St","A+","Global leader in widgets...","09:00-17:00","Sun","https://acme.com/logo.png","true","WidgetCo|GadgetInc","acme-corp","@acme","acme","acmevideo",...
            </code>
          </div>

        </div>

        <!-- SIDEBAR -->
        <div class="span-4">
          <div style="position:sticky; top:8rem; padding:2rem; border-left:1px solid var(--structural-line);">
            <div class="titan-label" style="margin-bottom:1rem;">ACTIONS</div>
            <a href="<?= $basePath ?>/data/" class="btn-institutional primary"
              style="width:100%; margin-bottom:1rem; text-align:center;">Browse Data</a>
            <a href="<?= $basePath ?>/pro/" class="btn-institutional secondary"
              style="width:100%; text-align:center; color:var(--accent); border-color:var(--accent);">Get Premium
              Access</a>

            <div style="margin-top:3rem;">
              <div class="titan-label" style="margin-bottom:1rem;">VERSIONING</div>
              <p style="font-size:0.85rem; opacity:0.8; margin-bottom:0.5rem;"><strong>Current:</strong> v1.1 (Stable)
              </p>
              <p style="font-size:0.85rem; opacity:0.8;">We adhere to semantic versioning. 1.0 -> 1.1 implies
                backward-compatible field additions. 2.0 would imply breaking changes.</p>
            </div>
          </div>
        </div>

      </div>
    </section>
  </main>

  <?php include $basePath . '/includes/footer.php'; ?>
</body>

</html>