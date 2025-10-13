# Changelog

All notable changes to this project will be documented in this file.

> Format: Inspired by [Keep a Changelog](https://keepachangelog.com/en/1.1.0/). Dates use `YYYY-MM-DD`.

---

## 2025-10-13

### Added

- Documentation READMEs to improve contributor onboarding and parity with repo structure:
  - Root-level `README.md` (theme overview, structure, setup, patterns, styles, templates).
  - `styles/README.md` (section styles catalogue and usage notes).
  - `styles/blocks/README.md` (button/read-more block styles reference).
  - `templates/README.md` (template catalogue and common features).
  - `patterns/README.md` (card & CTA patterns catalogue).

### Improvements

- Cross-linked docs between Patterns, Styles and Templates for faster discovery.
- Clarified dependency expectations (Tour Operator, Wetu Importer) and design-system link.

---

## 2025-10-10

### Fixed

- Normalised archive and cover image references in templates to stable theme asset paths and/or root-relative URLs (removed any environment-specific or localhost references) in archive templates.
- Corrected residual padding token misuse in updated templates (migrated any legacy labels like `small/medium` to canonical spacing tokens).

### Improvements

- Pass through sweep for consistent section spacing on archive/landing templates (vertical rhythm with `spacing-10/20/30`).

---

## 2025-10-09

### Added

- Fast Facts and Tour Info row styling applied across relevant single templates using section styles:
  - `is-style-section-fast-facts`
  - `is-style-section-tour-info-row`
- Secondary sticky navigation section style adopted on single templates for long-form pages:
  - `is-style-section-secondary-sticky-nav`

### Changed

- Unified banded sections (headings + content blocks) on single templates to use section styles rather than ad-hoc wrappers for maintainability.

---

## 2025-10-08

### Added

- Template parts for reusable cards (blog/destination/tour/archive) and sidebar, referenced by archive and single templates to reduce duplication.

### Improvements

- Increased consistency of block gaps and inner padding across card patterns by leaning on section styles (card, card-image, card-title, card-content) rather than per-pattern inline tweaks.

---

## 2025-10-07

### Added

- Section style variations for archive pages and detail bands:

  - `section-archive-heading`
  - `section-archive-description`
  - `section-archive-content`
  - `section-archive-pagination`
  - `section-archive-region-heading`
  - `section-facts-panel`
  - `section-related-destination-band`
  - `section-gallery-band`
  - `section-tour-info-row` (info-row alignment utility for tour cards & facts)

- Patterns:
  - `patterns/archive-card.php` (standardised archive grid card).
  - Integrated `blog-card` pattern into `index.html` via Query Loop (3-column responsive grid + pagination).

### Changed

- `templates/archive-travel-style.html`: replaced inline destination card markup with reusable `archive-card` pattern inside `post-template`; unified gaps to `spacing-40`.
- `templates/index.html`: replaced previous single pattern with full Query Loop using `blog-card` + pagination.
- `templates/single-destination.html`: introduced banded layout (Fast Facts, Related Tours, Related Accommodation, Gallery, Reviews) using section styles; normalised padding/gaps to `spacing-10/20/30`.

### Improvements

- DRY: removed duplicated inline card markup in archives; centralised on `archive-card`.
- Token governance: continued migration to canonical spacing scale.
- Readability: Query Loop patterns explicitly reflect intent (archive/blog).

---

## 2025-10-06

### Added

- Utility CSS class `cta-button-hover` (hover + focus-visible transitions for CTA buttons).
- Button style variation `styles/blocks/button/button-card-button.json`.
- Section styles:
  - `section-card-content`
  - `section-card-image`
  - `section-card-title`
  - `section-hero`
  - `section-page-section`
  - `section-website-cta`
  - `section-full-width-cta`
  - `section-breadcrumbs`
- Patterns:
  - `patterns/website-cta.php`
  - `patterns/full-width-cover-cta.php` (full-width cover CTA).

### Changed

- `styles/blocks/button/button-cta.json`:
  - Border radius set to `4px` (from `0`)
  - Font size to `font-size-400` (from `300`)
  - Font weight `400` (from `500`)
  - Uses primary font family; hover handled by `cta-button-hover`.
- `styles/section-website-cta.json`: corrected padding tokens (`spacing-20`), added `8px` radius, background `primary-800`, shadow token.
- Global shadow presets in `theme.json` (elevation-1/2/3) intensified for clearer depth.
- `section-website-cta`: enhanced with `shadow: elevation-2`.
- `section-full-width-cta.json`: introduced with contrast-600 background (interpreting “60% contrast”) and padding.
- `section-breadcrumbs.json`: added vertical padding via `spacing-10`, link colours/hover, base `fontWeight` (500); later removed unnecessary horizontal padding.
- `templates/archive-destination.html`: updated image paths to theme assets then normalised to root-relative URLs.

### Fixed

- `patterns/full-width-cover-cta.php`: corrected malformed markup (extra closing `</div>`, misaligned block close comments).
- Replaced invalid `small/medium` padding labels with design tokens.
- Fixed broken relative image references in `archive-destination.html`.

### Improvements

- Consistent hover transitions across CTA and card buttons (utility + variation alignment).
- Shadow system scaling refined while preserving depth hierarchy.
- Link hover colour semantics added to breadcrumbs for UX consistency.

### Pending

- Consider dynamic asset paths via `get_stylesheet_directory_uri()` for hardening.

---

## 2025-10-03

### Added

- Archive templates specific to project domain (in addition to Ollie’s general set):  
  `archive-accommodation.html`, `archive-destination.html`, `archive-review.html`, `archive-tour.html`, `archive-travel-style.html`, plus `category.html`.
- Single templates aligned to domain objects:  
  `single-accommodation.html`, `single-country.html`, `single-destination.html`, `single-region.html`, `single-review.html`, `single-tour.html`.
- Section style `section-breadcrumbs` applied to archives and singles for consistent nav trails.

### Changed

- Adopted section styles (`hero`, `page-section`, `tour-description`, `website-cta`) across templates to replace ad-hoc styling.

### Improvements

- Standardised template structure (header part, hero cover, breadcrumbs, description/content areas, query blocks) to accelerate page assembly and keep parity with the design system.

---

## 2025-10-02

### Added

- Project scaffold based on Ollie, adapted for African Safaris NZ requirements:
  - Patterns: `tour-card.php`, `blog-card.php`, `destination-card.php`, `archive-card.php`, `full-width-cover-cta.php`, themed Full Width CTA variants (mountains/sunset/lion/desert), `website-cta.php`, plus header & footer patterns.
  - Templates & parts: full set of WordPress block templates (404, index, page variants, search, taxonomy, etc.) and parts (`header.html`, `footer.html`, cards, sidebar).
  - Section styles: card/hero/page-section/footer/website-cta/top-header/main-header/post-pagination/post-tags/fast-facts/tour-info/tour-info-row.
  - Block styles: Button variants (card-button, cta, dark, light, summary-nav, top-header) and Read More variants (description, itinerary).
  - Assets: fonts (Source Sans Pro), icons, style tokens in `theme.json`.

### Changed

- Tokenisation aligned with project design system: colours/spacing/typography consolidated in `theme.json` and referenced by patterns & styles.
- Composer and theme bootstrap files added for standards and i18n readiness.

### Notes

- Intentional divergence from Ollie:
  - Domain-specific CPT templates (Tours, Destinations, Accommodation).
  - Travel-oriented CTA patterns and sticky secondary navigation.
  - Closer coupling to Tour Operator/Wetu workflows and ASNZ design tokens.

---
