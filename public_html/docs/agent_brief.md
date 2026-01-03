# Central.Enterprises — Agent Brief (Conversation Consolidation)

This document consolidates the full conversation context and all deliverables produced so far, so an agent can implement the website and legal/compliance layer with zero ambiguity.

---

## 1) Conversation timeline (condensed transcript)

- User: “What stands out about the legal figure of a foundation?”
- Assistant: Explained what makes a Spanish foundation distinct (asset dedicated to public interest, governance via Patronato, registration, reporting, donor certificates, potential tax incentives, etc.).

- User: “I want to set up a worldwide open data foundation with headquarters in Spain, sharing open company data under a standard.”
- Assistant: Proposed a Spain-based foundation structure, plus a technical plan: CC0 licensing, DCAT-style catalog metadata, and an “Open Company Data Standard v1” with governance/versioning/validator.

- User: “We will use CC0 / public domain. There will also be paid versions with contact/email/website. We must create a standard. While building the foundation, we will notify that it is currently under Pablo Cirre’s private tax ID and address Spain, Trajano 8. Learn central.enterprises and give me a giant prompt to perfect the site for another agent.”
- Assistant: Produced a large “do everything” prompt: IA structure, copy tasks, standard definition, licensing framework, compliance, SEO, deliverables.

- User: “Give me legal/compliance copy for the agent.”
- Assistant: Produced an initial legal/compliance copy pack and implementation requirements, then extended English-only versions.

- User: “I need it to mention much more that we will be a foundation and what will change at that moment.”
- Assistant: Produced a “Foundation Transition Copy Pack” with site-wide banner/footer, a dedicated transition plan page, and required insertions across legal pages.

- User: “I like commercial, but subtle and elegant.”
- Assistant: Produced a refined “Pro” and licensing copy set: premium tone, quiet conversion, strict anti-spam posture, strong foundation narrative.

- User: “Make me a .md with the whole conversation for an agent to understand well.”
- Assistant: This document.

---

## 2) Project goals (non-negotiable)

### Mission

Build Central.Enterprises as global infrastructure for open company data:

- Publish **Open Data under CC0 / public domain dedication**.
- Maintain a **public, adoptable Open Company Data Standard v1** with versioning, governance, and validation.
- Sustain operations with a **paid Pro layer** (subtle, elegant commercial tone) providing enrichment such as:
  - company website
  - business contact channels (including emails)
  - contact-related fields

### Legal trajectory

- Central.Enterprises is **transitioning to a Spain-based foundation**.
- Until the foundation is registered, the site must clearly state it is **currently operated by Pablo Cirre** with address:
  - **España, Trajano 8 (Spain)**
  - Tax ID: **[ADD NIF/CIF]** (placeholder; do not invent)
  - Legal email: **[LEGAL@CENTRAL.ENTERPRISES]** (placeholder unless provided)
- The site must repeatedly and clearly communicate:
  - “Foundation in formation”
  - what changes at registration (operator identity, governance, transparency, donation handling, standard stewardship)

---

## 3) Data model decision: two-layer standard

### CC0 Public Core (Open Data)

- Must be designed to **avoid personal data**.
- Focus on business entities, provenance, timestamps, and versioning.
- Releases remain CC0 permanently.

### Paid Pro Enrichment Layer

- Adds operational fields and higher cadence.
- Includes business contact channels and may include emails.
- Must include:
  - strict acceptable-use language (no unlawful unsolicited marketing)
  - suppression/removal request workflow
  - transparency about what’s intended (role-based emails preferred, minimize personal data)

---

## 4) Site architecture requirements

### Primary navigation (recommended baseline)

- Home
- Data
- Standard
- Foundation
- Pro
- Docs
- About
- Contact

### Legal pages (must exist)

- `/legal-notice` — Legal Notice / Imprint (Spain operator identification + foundation transition)
- `/privacy` — Privacy Policy (clear separation: website data vs datasets, and foundation transition)
- `/cookies` — Cookies Policy + CMP requirements
- `/terms` — Website Terms of Use
- `/open-data` — Open Data Terms (CC0)
- `/pro-license` — Pro Data License + Acceptable Use
- `/data-requests` — Correction / Removal / Suppression Requests
- `/donations` — Donations & Tax Deductibility (no misleading claims pre-registration)

### Foundation transition page (must exist)

- `/foundation-transition` — Foundation Transition Plan (the “what changes at registration” source of truth)

### Site-wide components (must exist)

- **Top banner**: Foundation in formation + link to transition plan + link to Pro
- **Footer notice**: consistent foundation notice and links to all legal pages

---

## 5) Implementation rules (do not break)

1) **Do not claim donation tax deductibility** until the foundation is registered and eligible.
2) **Cookie banner must follow AEPD-style consent design**:
   - Accept / Reject / Configure on same layer
   - no consent by scroll or inaction
   - withdrawal as easy as consent
3) Keep tone “infrastructure-grade”: calm, precise, premium, no hype.
4) Keep Open vs Pro distinction crystal clear in under 20 seconds.
5) Do not invent missing legal values: use explicit placeholders.
6) Pro is commercial, but subtle: sell by governance, provenance, refresh discipline.

---

## 6) “Mega prompt” for the agent (full website perfection)

### MEGA PROMPT (website / product / standard / SEO / legal)

Act as a senior team (Product + UX Writer + Tech SEO + Legal/Compliance + Data Architect) and make central.enterprises perfect for the launch of a worldwide Open Company Data foundation headquartered in Spain.

CONTEXT

- Project: Central.Enterprises (central.enterprises).
- Goal: a foundation-led global reference layer for open company data.
- Open license: CC0 / public domain dedication for Open Data.
- Paid layer: Pro datasets/services with enrichment (e.g., website, email, contact channels) + API access.
- Transition: currently operated under Pablo Cirre’s private tax identity; address Spain, Trajano 8; must be shown transparently until foundation registration.

WORK (no questions; make best assumptions)

1) Audit the site: navigation, copy, CTAs, legal clarity, trust, SEO, accessibility, performance.
2) Redesign IA: pages, menu, URLs, and content blocks.
3) Write final copy in English: short, technical, confident.
4) Define “Open Company Data Standard v1”:
   - schema: required/optional fields, types, examples JSON+CSV
   - two layers: CC0 Public Core vs Paid Enrichment Layer
   - privacy minimization, especially for emails
   - provenance, timestamps, checksums, changelog, confidence score
   - validation: JSON Schema + lint rules + conceptual validator endpoint
5) Licensing:
   - CC0 for Open Data (clear terms + disclaimers)
   - Pro license/ToS for paid datasets (redistribution limits, anti-abuse, acceptable use)
6) Foundation pages:
   - Foundation page: mission, public interest purpose, governance placeholders, transparency plan
   - Donations page: no tax claims until legally real; explain future change
7) Tech SEO:
   - titles/meta/canonical/robots/OG for every page
   - sitemap.xml + robots.txt
   - structured data: Organization + Dataset
8) Trust & compliance:
   - LSSI/GDPR basics: operator ID, contact, purposes, bases, rights, cookies compliance
   - Align “no personal data” claims with Pro reality (emails might be personal data)
9) Pro product:
   - 3 tiers: Open / Pro / Enterprise
   - describe features without prices; use “from / request access”
10) Deliverables:
   A) New sitemap
   B) Copy per page
   C) Standard v1 spec
   D) Implementation checklist
   E) quick wins + long-term improvements

RULES

- Do not invent tax ID or registry details: use placeholders.
- Keep commercial tone subtle and elegant.
- Make foundation transition extremely visible and consistent across the site.

---

## 7) Foundation Transition Copy Pack (must be implemented)

### 7.1 Site-wide top banner (premium)

**Central.Enterprises is becoming a Spain-based foundation.**  
CC0 Open Data stays open. Pro access funds stewardship, quality, and long-term availability.  
[Foundation Transition] [Pro Access]

### 7.2 Footer foundation notice

**Foundation Notice:** Central.Enterprises is transitioning to a Spain-based foundation. Until registration, it is operated by Pablo Cirre (see Legal Notice). After registration, the foundation becomes the steward of the standard, governance, and CC0 releases.

### 7.3 Dedicated page: /foundation-transition (core content)

Include:

- what CE is becoming (foundation, Spain)
- current status (operated by Pablo Cirre, Trajano 8, placeholders)
- exact changes at registration:
  - operator/controller changes
  - governance via Patronato
  - transparency/reporting
  - donation handling (no claims until eligible)
  - licensing entity clarity
  - standard stewardship
- what does NOT change:
  - CC0 remains CC0
  - Open vs Pro separation remains
- timeline placeholders
- FAQ (not a foundation yet, CC0 remains, Pro exists, tax deductibility not claimed yet)
- Foundation Change Log section with date-stamped entries to be filled later

### 7.4 Mandatory “Foundation insertion” block in EVERY legal page

Use a consistent paragraph:

- “Foundation in formation (Spain)…”
- “Currently operated by Pablo Cirre…”
- “On registration, foundation becomes operator and steward; pages updated with registry details; governance transfer documented.”

---

## 8) English-only Legal / Compliance Copy (extended)

### 8.1 /legal-notice — Legal Notice (Imprint)

Central.Enterprises is a global open company data initiative. It is transitioning into a **Spain-based foundation** that will become the official legal operator and steward of governance, compliance, CC0 releases, and the Open Company Data Standard.

**Temporary operator (until foundation registration):**  
Name: **Pablo Cirre**  
Address (legal notices): **España, Trajano 8 (Spain)**  
Tax ID (NIF/CIF): **[ADD NIF/CIF]**  
Legal contact: **[LEGAL@CENTRAL.ENTERPRISES]**

**What changes at registration:**  
Once the foundation is officially registered, the foundation will become the legal operator of Central.Enterprises, publish its registry details here, and assume stewardship of governance and compliance. This page and all policies will be updated with effective dates.

**Purpose of the website:**  

- CC0 Open Data downloads and documentation  
- Pro access: paid enrichment and delivery (exports and/or APIs), under a separate Pro license

**Disclaimers:**  
Company information changes. Data is provided “as is” without warranties.

**IP:**  
Website content is protected unless stated otherwise. Open Data CC0 is governed by /open-data.

**External links:**  
No responsibility for third-party content.

**Contact:**  
Legal/privacy/data requests: **[LEGAL@CENTRAL.ENTERPRISES]** or /data-requests

---

### 8.2 /terms — Website Terms of Use

By using the site you agree to:

- lawful use
- no abuse (no bypassing limits, no unauthorized access)
- no misrepresentation of endorsement
- Pro data must be used per /pro-license

**Foundation transition notice:**  
Central.Enterprises is moving to a foundation model in Spain. When the foundation is registered, the foundation becomes the operator and the licensing/contracting entity (or will publicly designate the correct entity). Updated terms will be published with effective dates.

---

### 8.3 /privacy — Privacy Policy (foundation-first)

**Foundation transition:**  
Central.Enterprises is being established as a foundation in Spain for durable stewardship of open data releases, governance, and compliance. During formation, the controller is the temporary operator listed below. After registration, this policy will be updated to reflect the foundation’s official identity, registry details, and contact points.

**Data controller (temporary):** Pablo Cirre, España Trajano 8, [NIF/CIF], [LEGAL@...]

**What this covers:**  

- website visitors
- contact requests
- Pro customers/users
- data subjects whose personal data may appear in Pro (e.g., personal-name email)

**Open vs Pro distinction:**  
Open Data (CC0) is intended to avoid personal data.  
Pro may include business contact channels (websites/emails). We prioritize role-based emails and provide suppression requests.

**Sources:**  
Public business websites, listings, open data portals, partners (where permitted).

**Rights:**  
Access, rectification, erasure, restriction, objection, portability; AEPD complaint.

**Suppression:**  
/data-requests or [LEGAL@...]

**Retention:**  
Contact requests limited; billing per legal obligations; security logs limited; suppression markers may be retained minimally to prevent reintroduction.

---

### 8.4 /cookies — Cookies Policy + consent text

Banner must show: **Accept / Reject / Configure** on same layer.  
No consent by scroll.

Cookie categories:

- Necessary (always on)
- Analytics (optional)
- Functional (optional)
- Marketing (optional)

Provide “Cookie Preferences” link in footer.

---

### 8.5 /open-data — Open Data Terms (CC0)

Unless a dataset says otherwise, Open Data is released under **CC0**.  
No endorsement; no warranties; intended to avoid personal data; report issues via /data-requests.

**Foundation stewardship line:**  
When the foundation is registered, it becomes the steward of CC0 releases (versioning, provenance requirements, long-term availability). CC0 releases remain CC0.

---

### 8.6 /pro-license — Pro Data License (subtle commercial + strict)

Pro exists to fund stewardship (refresh cycles, validation, provenance discipline) without compromising CC0 openness.

**Allowed use:** market intelligence, segmentation, enrichment for internal CRMs, due diligence, analytics.

**Contact channels (elegant wording):**  
Pro may include business contact channels such as websites and emails. These fields are provided for professional context and operational workflows. We aim to prioritize role-based business addresses and provide a straightforward suppression process for any address that should not appear.

**Prohibited use:** unlawful unsolicited bulk marketing, harassment, republishing/reselling, credential sharing, bypassing limits.

**Customer compliance:** customer is responsible for lawful communications, opt-out, suppression handling.

**Enforcement:** suspend access for abuse; terminate for breach.

**Foundation transition:** licensing entity will be updated/published at registration.

---

### 8.7 /data-requests — Correction / Removal / Suppression

Allow:

- correction of company info
- suppression of contact channels/emails
- source review

Require:

- record ID
- requested change
- minimal verification

State that minimal suppression markers may be retained to prevent reintroduction.

---

### 8.8 /donations — Donations & Tax Deductibility (no misleading claims)

**Foundation-led support:**  
Central.Enterprises is being established as a foundation in Spain to steward CC0 Open Data and the standard.

**Today (pre-registration):** operated by Pablo Cirre; support treated accordingly.  
**After registration:** foundation becomes the recipient entity; governance and transparency become formal.

**Tax deductibility:**  
Do not present donations as deductible until foundation is registered and eligible to issue valid certificates.

**Why support matters:**  
Open data at scale needs infrastructure, validation, refresh discipline, and documentation. Pro funds stewardship; donations accelerate expansion of CC0 core and standard adoption.

---

## 9) Commercial but subtle “Pro” copy (for conversion without SaaS spam)

### 9.1 Pro page hero

**Pro Access for infrastructure-grade company intelligence.**  
CC0 is the public core. Pro is the funding layer that keeps the standard, validation, and refresh cycles sustainable—without compromising openness.

CTAs:

- Request Pro Access
- Compare Open vs Pro
- Read the Standard

### 9.2 The key conversion paragraph (use on Home + Pro page)

Central.Enterprises is moving toward a **foundation model in Spain** to permanently steward open company data under CC0. Pro exists to finance that stewardship: faster refresh, stronger provenance, higher coverage, and enriched business contact channels for legitimate professional use. The result is a public core anyone can build on—and a professional layer for teams who need operational depth.

### 9.3 Plans (no pricing)

Open: CC0 downloads, standard, public docs  
Pro: enrichment + higher cadence + API keys + operational exports  
Enterprise: custom refresh + dedicated support + compliance tooling

---

## 10) Placeholders (do not invent)

- [ADD NIF/CIF]
- [LEGAL@CENTRAL.ENTERPRISES]
- [Foundation registry details]
- [Effective dates for transition change log]
- [Cookie list populated from actual CMP]

---

## 11) Final note to agent

The main success metric is trust:

- Foundation transition must be visible everywhere and consistent.
- CC0 openness must be unambiguous and permanent.
- Pro must be premium, subtle, and legally disciplined (anti-spam, suppression workflow, privacy minimization).
- Standard must be adoptable: schema + examples + validator + governance.

End.
