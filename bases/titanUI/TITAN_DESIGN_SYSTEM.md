# TITAN Design System: Global Infrastructure Authority

## 1. Aesthetic Vision

The TITAN design system is built to convey **Institutional Authority**, **Security**, and **Sovereign Scale**. It moves away from "playful" UI towards a "Serious International Corporation" aesthetic (think high-frequency trading, global infrastructure, or state-level intelligence).

- **Core Principles:** Architectural lines, high contrast, zero border-radius, and asymmetric structural precision.
- **Tone:** Objective, authoritative, and systemic.

---

## 2. Color System

TITAN uses two high-contrast modes.

### TITAN DARK (Primary/Default)

- **Background Deep:** `#050505`
- **Background Secondary:** `#0a0a0a`
- **Text Header:** `#ffffff` (Pure White)
- **Text Body:** `#999999` (Muted Grey)
- **Accent:** `#007aff` (Infrastructure Blue)
- **Structural Lines:** `#1a1a1a` (Hairline borders)

### TITAN LIGHT (Institutional Clarity)

- **Background Primary:** `#ffffff`
- **Background Secondary:** `#f5f5f7`
- **Text Header:** `#000000` (Pure Black)
- **Text Body:** `#444444` (Serious Charcoal)
- **Accent:** `#007aff`
- **Structural Lines:** `#e0e0e0`

---

## 3. Typography

A strict pairing of modern, objective sans-serifs.

- **Headings (H1-H4):** `Sora`
  - Weight: 800 (Extra Bold)
  - Transform: Uppercase
  - Letter-spacing: 0.1em to 0.3em
- **Body Text:** `Inter`
  - Weight: 400 - 500
  - Line-height: 1.6
- **Monospace (Data):** System Mono or Inter adjusted for tabular alignment.

---

## 4. Architectural Grid

TITAN rejects symmetric "boxed" layouts in favor of an **Asymmetric Architectural Grid**.

- **Structure:** 12-column CSS Grid.
- **Lines:** Visible "Structural Lines" (hairline borders) that emphasize the foundation.
- **Composition:**
  - Use wide offsets (e.g., `offset-2`).
  - Asymmetric spans (e.g., a `7 col` main section with a `3 col` sidebar, or `8 col` stats with a floating `4 col` table).
  - Vertical lines should be continuous to suggest "Infrastructure".

---

## 5. Components

### Data Tables

- High contrast headers with extra letter-spacing.
- Status indicators must use semantic colors but shifted for theme contrast:
  - **Operational:** Green
  - **Maintenance:** Orange/Amber
  - **Critical:** Red/Crimson
- **Light Mode Rule:** Darken semantic colors (e.g., `#008000`) to maintain legibility on white.

### Access Mandates (Pricing)

- 3-tier vertical grids.
- Comparative labels (e.g., "Standard Protocol", "Advanced Authority", "Sovereign Entity").
- Feature lists with dot-indicators (`●` for enabled, `○` for disabled).

### Action Protocols (CTAs)

- **Institutional Weight:** Large, bold buttons with directional arrows (`→`).
- Avoid rounded corners (`0px` border-radius).
- High-contrast hover states (Invert colors or shift to Accent).

---

## 6. Theme Logic

- Initial state should detect OS preference via `prefers-color-scheme`.
- Manual overrides persist via `localStorage.getItem('preferred-titan-theme')`.
- Attributes applied to `<body>` or `<html>` via `data-theme="titan-dark"` or `data-theme="titan-light"`.

---

## 7. Content Voice

Use terminology that reflects systemic scale:

- *Deployment Handshake*
- *Sovereign Protocols*
- *Intelligence Infrastructure*
- *Access Mandates*
- *Systemic Oversight*
