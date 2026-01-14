# SuperDataCloud Data Schema Reference

**Document Version:** 1.0  
**Last Updated:** 2026-01-08  
**Prepared by:** Central Data Enterprises Foundation  
**Contact:** <Pablo@centraldecomunicacion.es>

---

## 1. Overview

SuperDataCloud provides B2B company datasets in two access tiers:

| Tier | Description | Use Case |
|:---|:---|:---|
| **Premium** | Full dataset with all fields (contact, social, ownership) | Commercial B2B campaigns, sales prospecting, market research |
| **OpenData** | Redacted dataset with sensitive fields masked | Educational projects, academic research, public dashboards |

Both tiers share **identical company records** and **identical row counts**. The difference lies solely in which columns contain actual values versus redacted placeholders.

---

## 2. Complete Column Schema (35 Fields)

All datasets follow a **fixed column order** for maximum interoperability. Below is the full schema with visibility per tier.

| 12 | `workday_timing` | Opening hours / schedule | ✅ | ✅ |
| 13 | `is_temporarily_closed` | Boolean: temporarily closed status | ✅ | ✅ |
| 14 | `closed_on` | Days when the business is closed | ✅ | ✅ |
| 15 | `can_claim` | Boolean: GMB listing claimable | ✅ | ✅ |
| 16 | `owner_name` | Verified owner name | ✅ | ❌ Masked |
| 17 | `owner_profile_link` | Owner's Google profile URL | ✅ | ❌ Masked |
| 18 | `featured_image` | Cover image URL | ✅ | ✅ |
| 19 | `link` | Google Maps listing URL | ✅ | ✅ |
| 20 | `is_spending_on_ads` | Boolean: running Google Ads | ✅ | ✅ |
| 21 | `competitors` | Related/competing businesses | ✅ | ✅ |
| 22 | `LinkedIn` | LinkedIn company page URL | ✅ | ❌ Masked |
| 23 | `Instagram` | Instagram profile URL | ✅ | ❌ Masked |
| 24 | `Facebook` | Facebook page URL | ✅ | ❌ Masked |
| 25 | `YouTube` | YouTube channel URL | ✅ | ❌ Masked |
| 26 | `TikTok` | TikTok profile URL | ✅ | ❌ Masked |
| 27 | `Twitter` | Twitter/X profile URL | ✅ | ❌ Masked |
| 28 | `Pinterest` | Pinterest profile URL | ✅ | ❌ Masked |
| 29 | `WhatsApp` | WhatsApp contact link | ✅ | ❌ Masked |
| 30 | `Telegram` | Telegram channel/contact URL | ✅ | ❌ Masked |
| 31 | `RSS` | RSS/Atom feed URL | ✅ | ✅ |
| 32 | `GitHub` | GitHub organization URL | ✅ | ❌ Masked |
| 33 | `VK` | VKontakte profile URL | ✅ | ❌ Masked |
| 34 | `WeChat` | WeChat ID or URL | ✅ | ❌ Masked |
| 35 | `Weibo` | Weibo profile URL | ✅ | ❌ Masked |
| 36 | `Medium` | Medium publication URL | ✅ | ❌ Masked |

---

## 3. Masked Columns Summary (OpenData)

The following **18 columns** are masked (set to empty string `""`) in the OpenData tier to protect personal contact information and direct communication channels:

### Contact Information (3 fields)

- `emails`
- `phone`
- `owner_name`
- `owner_profile_link`

### Social Media Profiles (14 fields)

- `LinkedIn`
- `Instagram`
- `Facebook`
- `YouTube`
- `TikTok`
- `Twitter`
- `Pinterest`
- `WhatsApp`
- `Telegram`
- `GitHub`
- `VK`
- `WeChat`
- `Weibo`
- `Medium`

> [!IMPORTANT]
> The `RSS` field is **NOT masked** in OpenData, as RSS feeds are publicly available broadcast channels, not personal contact information.

---

## 4. Available Columns in OpenData (17 fields)

These columns contain full data in both Premium and OpenData tiers:

| Category | Columns |
|:---|:---|
| **Identity** | `name`, `address`, `featured_image`, `link` |
| **Classification** | `main_category`, `categories` |
| **Digital Presence** | `website`, `RSS` |
| **Reputation** | `rating`, `reviews`, `review_keywords`, `description` |
| **Operations** | `workday_timing`, `is_temporarily_closed`, `closed_on` |
| **Business Intelligence** | `can_claim`, `is_spending_on_ads`, `competitors` |

---

## 5. Technical Specifications

| Property | Value |
|:---|:---|
| **Encoding** | UTF-8 |
| **CSV Delimiter** | Comma (`,`) |
| **Quoting** | Minimal (RFC 4180 compliant) |
| **Empty Values** | Empty string (`""`) |
| **Multi-value Separator** | Comma within field (e.g., `cat1, cat2, cat3`) |
| **Boolean Fields** | `True` / `False` (Python style) |
| **Deduplication Key** | Google `place_id` (unique per record) |

---

## 6. Legal & Compliance Notes

- **Premium datasets** are licensed for internal B2B use only. Distribution or resale is prohibited.
- **OpenData datasets** may be used for educational, research, and public-interest applications under Creative Commons Attribution (CC BY 4.0) terms.
- When using contact fields (emails, phones), users must comply with applicable laws including GDPR (EU), CAN-SPAM (US), CASL (Canada), and similar regulations.

---

## 7. Version History

| Version | Date | Changes |
|:---|:---|:---|
| 1.0 | 2026-01-08 | Initial schema documentation |

---

**© 2026 Central Data Enterprises**  
centraldecomunicacion.es | companiesdata.cloud | centraldata.cloud | central.enterprises
