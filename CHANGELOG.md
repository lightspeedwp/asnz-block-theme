# Changelog

All notable changes to this project will be documented in this file.

> Format: Inspired by [Keep a Changelog](https://keepachangelog.com/en/1.1.0/). Dates use `YYYY-MM-DD`.

---

## 2026-08-06

### Fixed

- Price Includes/Excludes lists collapsed into a single bullet whenever a tour
  was imported from WETU or the field was touched in the editor. `included` and
  `not_included` are CMB2 wysiwyg fields that the WETU importer also writes to
  verbatim, so a value arrives in one of four shapes: `<p>One<br>Two</p>`
  (TinyMCE soft breaks, and every WETU payload), `<p>One</p><p>Two</p>`
  (TinyMCE hard breaks), `"One\r\nTwo"` (legacy plain text, the only shape that
  worked), and `<ul><li>One</li></ul>` (real list markup, passed through
  without the class, so it never received its icons). The filter split on
  newline characters only, so only 4 of 76 stored values were in the shape it
  understood.
  - Fix: normalise `<br>`, `<p>`/`</p>` and `\r\n`/`\r` to one delimiter before
    splitting, and add the list class to values already stored as list markup
    so those also get icons. `&nbsp;` is collapsed too, so an emptied wysiwyg
    field renders nothing instead of a stray non-breaking space. Icon
    injection now matches `<li>` with attributes and handles `<ol>` and nested
    lists, collapsing two near-identical branches into one loop; the CSS drops
    its `ul` qualifier so an editor-entered `<ol>` keeps the layout.
  - Verified against every stored value on a local copy of the site: 76/76
    rows render as multi-item lists (563 items, up from ~76), 563/563 icons
    injected, correct icon on all 76 lists, plus a 12-case edge matrix. No
    stored data changed; the fix is entirely in the render path.

## 2026-07-28 (2)

### Fixed

- Pair each mega-menu panel with its own toggle structurally instead of by list
  index. `panels` is filtered to `.menu-width-full` while `toggles` is not, so
  `toggles[ i ]` only described `panels[ i ]` while every mega menu happened to be
  full-width — true today, but set one to Content or Wide in the editor and every
  index shifts. Demonstrated by setting "Destinations" to Content width with "About"
  open: `panels` becomes 4 against 5 toggles, and the open About panel reads as
  closed (so it would be cleared mid-view) while the closed Blog panel reads as open
  (so it would be skipped). The structural lookup — `closest( '.wp-block-ollie-mega-menu' )`
  then its own toggle — gets both right.

- Corrected the `capture: true` comment on the `load` listener. It claimed capture
  runs the handler ahead of the plugin's regardless of registration order; it does
  not. `load` is fired at `window` with the legacy-target-override flag, so `window`
  is the only object in the propagation path — the listener is `AT_TARGET`, and
  at-target listeners run in registration order whatever the capture flag says.
  Running first depends on this script executing before hydration (measured: theme
  registers at ~3.7s, the plugin's five at ~5.1s), with the backstop as the covering
  guarantee. Behaviour unchanged; only the comment was wrong, and it was the kind of
  wrong that invites someone to lean on it.

### Resolved without a code change

- The "About panel opens empty, only a decorative icon" report (see (4) and (5) under
  2026-07-27) is the *same defect* as the client's misalignment report, already fixed
  in 0.1.10 — not a separate hydration or collapse bug. Proof: force `left: 0px` (what
  the defect wrote) on the About panel at 1440px and the panel spans x=983→2408. Its
  layout is icon-column-first, so column 1 stays on screen at x=1075 while column 2 —
  all 13 links — lands at x=1502, past the 1440px edge. Measured `iconOnScreen: true`,
  `visibleLinks: 0/13`: exactly "only a decorative icon visible, no links/text".
  - So the 0.1.8 "collapsed panel" recovery was chasing a symptom of the `left: 0px`
    write, which is why a fixed-delay re-check could never fix it and instead broke
    hover-open. Confirmed unreproducible on 0.1.10 across 1200-1920px and three
    cold-cache loads hovering About at hydration (13/13 links every time).
  - The 0x0-with-content measurement in that report is explained too: below ~1100px
    the desktop nav collapses to the mobile overlay, so every panel measures 0x0 at
    `visibility: hidden` while still holding its links. That is normal, not a fault.

## 2026-07-28

### Fixed

- Mega menu panel permanently offset by its own x-position when a visitor opened it
  before `window.load`. Reported by the client, reproduced at 1920px: open the page
  fresh, hover a mega menu quickly enough to catch it, and the panel renders starting
  at its nav item instead of the viewport edge, overflowing right with the last column
  cut off. It stays wrong until a reload.
  - Cause: 0.1.6 added a guard skipping any panel with `aria-expanded="true"` in the
    `load` handler, to avoid a visible reset of an open panel. The guard was applied to
    the backstop as well as the clear loop, which removed *both* defences from the one
    panel a visitor can actually see. The plugin's own `load` handler still runs its
    reset-less `adjustMegaMenu()` on it, re-measures a panel we already corrected
    (`menuRect.left === 0`) and writes `left: 0px` — and with the backstop also
    skipping it, nothing ever detected or repaired that.
  - Fix: the backstop now checks every panel, including an open one. The clear loop
    still skips open panels, so 0.1.6's reason for the guard is preserved. Repairing an
    open panel costs one frame at the wrong offset; leaving it broken cost the whole
    pageview.
  - Verified A/B against live at 1920px with a menu held open through `load`: deployed
    build leaves exactly one broken panel (the open one, `left: 0px`), this build
    leaves none.

## 2026-07-27 (5)

### Fixed

- Reverted the 0.1.8 "collapsed panel" recovery (see (4) below) — it was the
  cause of a new regression, not the fix: user confirmed on a fresh
  cache-cleared incognito load, "About" rendered correctly for an instant
  then broke. The plugin holds a just-opened panel at `visibility:hidden`
  for 100-175ms (its own CSS transition-delay) before it's actually laid
  out. Our recovery checked one `requestAnimationFrame` (~16ms) after
  `aria-expanded` flipped true — squarely inside that window — read a
  legitimately-still-hidden panel as "collapsed", and dispatched another
  `resize`, which (per point 1 above) cancels an in-progress hover-open.
  So the fix broke the exact case it was trying to catch. Removed; the
  original "About" panel blank-render report is still unresolved and needs
  a different approach — do not re-add a fixed-delay check without first
  confirming it runs after the plugin's transition (175ms) has settled.

## 2026-07-27 (4)

### Fixed

- Reported: the "About" mega-menu panel opening visually empty (only a
  decorative icon visible, no links/text). Could not get a clean, reliable
  repro across 1024-1440px viewports or hover vs. click — but did catch it
  once: the panel opens with correct `aria-expanded`/geometry/visibility, yet
  its entire render chain collapses to a 0x0 box while still containing real
  content (12 links). This is consistent with a narrower window of the same
  hydration race documented above (#1) rather than a fixed-width breakpoint
  bug. `assets/js/mega-menu-init.js` now checks a panel a frame after its
  toggle's `aria-expanded` flips to `true`; if it's still 0x0, it dispatches
  another `resize` to force the plugin to re-run its layout pass. Please
  confirm if this recurs — if it does, the exact viewport width/browser and
  whether it was a fresh page load will help nail down the real trigger.

## 2026-07-27 (3)

### Fixed

- Mega menu `menu-width-full` panels overflowed past the right edge of the
  viewport on every desktop width (reproduced at 1280px and 1440px). Ollie
  Menu Designer's `view.js` sizes the panel from `window.innerWidth`, which
  includes the scrollbar gutter and is ~15-17px wider than
  `document.documentElement.clientWidth` (the actual visible viewport) on any
  page with a vertical scrollbar. `assets/js/mega-menu-init.js` now clamps
  each panel's inline `width`/`max-width` to `clientWidth` via a
  `MutationObserver` on its `style` attribute, so the correction applies no
  matter which code path (resize, the plugin's own `load` handler, or our
  hydration reflow) set the oversized geometry.

## 2026-07-27 (2)

### Performance

- Preload the 3 font files actually used above the fold on every page
  (Source Sans 3 variable, Lato Regular, Lato Bold) via `<link rel="preload">`
  in `wp_head`, so the fetch starts in parallel with the CSS parse instead of
  after the browser discovers the `@font-face` rules. Follow-up to the WOFF2
  switch below.

- Serve the theme's registered font faces as WOFF2 instead of raw TTF. The eight
  faces in `theme.json` drop from 1427KB to 458KB (68% smaller); the three actually
  fetched on the home page — Source Sans 3 variable, Lato Regular, Lato Bold — drop
  from 774KB to 221KB.
  - Why it mattered beyond bytes: fonts are fetched at `VeryHigh` priority, while
    `<script type="module">` and `defer` scripts get `Low`. The mega menu's
    Interactivity module sat behind 1307KB of `VeryHigh`/`High` requests, and module
    scripts block `DOMContentLoaded`, so hydration — the point at which the nav can
    respond to a hover at all — was gated on the font download.
  - Measured on dev at 1440px, cold cache: blocking the fonts entirely moved
    hydration from 4472ms to 2892ms, so this is the dominant term.
  - Conversion used `woff2_compress` (Google's reference encoder) and is lossless:
    glyph counts, cmap coverage (1615 codepoints on the variable faces) and the
    `wght 200-900` axis are identical, verified with fontTools plus an in-browser
    load and axis-rendering check.
  - The superseded `.ttf` files are left in place for now — nothing references them,
    so they are never fetched. Pruning them is a separate call.

## 2026-07-27

### Fixed

- Reserved 20x20px for `.wpsr-show-logo` (WP Social Reviews' Google icon).
  Confirmed via Chrome's layout-shift culprit trace as the single largest
  CLS contributor on the front page (desktop 0.16, mobile 0.35 — poor) —
  the plugin's own CSS sets no dimensions on it, and it loads late (~7-12s
  after paint), shoving all following content down when it finally renders.
- Layout shift when opening/browsing past the header nav.
  - `assets/js/mega-menu-init.js`'s `window.load` handler cleared inline
    `left`/`width`/`maxWidth` on every mega-menu panel, including one a visitor
    already had open if `load` fired mid-hover (plausible given the ~2.7s load
    delay from GTM/YouTube/Chaty/Font Awesome noted above) — resetting a
    painted, visible panel's geometry for a frame before it got re-measured is
    a real layout shift. The cleanup now skips any panel whose toggle has
    `aria-expanded="true"`.
  - `style.css`: added `html { scrollbar-gutter: stable; }` so the vertical
    scrollbar's width is always reserved. Without it, navigating between a
    tall page (scrollbar present) and a short one (no scrollbar) changes the
    viewport's content width by ~15-17px, shifting the whole centred layout —
    including the sticky nav — sideways. This is what "menu should remain
    static when browsing through the site" was pointing at.
  - Could not reproduce a `layout-shift` PerformanceObserver entry from
    opening/closing the mega menu or mobile drawer on desktop (1280px) or
    mobile (375px) viewports in this environment — the panel is
    `position: absolute`/`fixed` and the drawer render was instant, so no
    shift fired here. The `mega-menu-init.js` fix targets the exact race the
    file's own doc comment already flags as live-only (fast local loads never
    hit it); the `scrollbar-gutter` fix is a general hardening for the
    cross-page "remain static" ask. Please confirm on a slow connection/live
    if the reported shift persists.
- Mega menus no longer open as narrow columns overlapping the header. Ollie Menu
  Designer ships no CSS width for `.menu-width-full` panels — view.js measures the
  viewport and writes the geometry inline, but defers that to the `window.load`
  event. On production `load` waits on ~70 eager images, a YouTube embed, GTM,
  Chaty, Popup Maker and Font Awesome from a third-party CDN, so for 2.7s after
  hydration a hovered panel opened as a ~626px shrink-wrapped box at the wrong
  offset. Locally `load` fires immediately, which is why it only showed on live.
  - New `assets/js/mega-menu-init.js` dispatches a single `resize` once the
    Interactivity store hydrates, so the plugin measures via its own handler.
    Measured at 1440px, the window in which a panel can open mis-sized drops from
    2699ms to 18ms.
  - It fires exactly once, at hydration, because the plugin's resize handler clears
    the pending hover timeout — a resize inside the 150ms hover-open delay silently
    cancels the open. It also clears the inline geometry on `load`, because the
    plugin's load handler calls `adjustMegaMenu()` without the reset its resize
    handler does and would otherwise re-measure an already-corrected panel.
- Mega menu stacking now targets the Ollie panel element
  (`.wp-block-ollie-mega-menu__menu-container`) instead of
  `.wp-block-navigation__submenu-container`, which never matches these panels, and
  drops the LSX sticky menu below it.
- Removed gap below the header on the front page by wrapping the front-page content in a `<main>` landmark with zero top/bottom margin.
- Hid the redundant facts block on the final itinerary day.

## 2025-10-17

### Added

- Mega Menu template parts for Destinations, Tours, Planning Your Safari, Blog, and About, each with block-based navigation, background images, and tokenized spacing.
- New section styles: blog card meta, breadcrumbs, card content/image/title, fast facts, footer, full-width CTA, hero, main/top header, page/tertiary section, post pagination/tags, secondary sticky nav, tour description/info/row, website CTA. All styles leverage theme.json tokens for scalable, accessible design.
- Expanded block styles for buttons (card-button, cta, dark, light, summary-nav, top-header) and read-more (description, itinerary), documented in styles/blocks/README.md.
- Additional card patterns (accommodation, room) and CTA patterns (full-width themed variants) for broader template coverage.
- Template parts for accommodation-card, room-card, and expanded sidebar.
- Documentation updates: all READMEs (root, patterns, styles, blocks, templates, parts) now reflect current structure and usage.

### Changed

- Refactored and organized style.css: clear sections for base config, forms, header/mobile utilities, block helpers, button/card/hero/search/nav/mega menu/mobile menu/facetwp styles. All selectors use theme tokens and modern CSS features for performance and maintainability.
- Standardized all templates (archive, single, page, taxonomy, search, front-page, 404) to use modular template parts, section styles, and block patterns. Improved vertical rhythm, tokenized spacing, and unified structure for maintainability and editor compatibility.
- Unified pattern metadata schemas for overrides and plugin compatibility.
- All patterns and template parts now use block-based markup, section styles, and theme tokens for spacing, color, and typography.

### Improvements

- Accessibility: semantic markup, color contrast, keyboard navigation, ARIA roles across all templates and patterns.
- Performance: minimized inline styles, reusable parts/patterns, conditional assets.
- Security: escaped output, sanitized input, no unsafe PHP.
- Internationalization: all user-facing strings wrapped for translation.
- Contributor onboarding: documentation and cross-linking between patterns, styles, templates, and parts.

### Fixed

- Addressed any legacy ad-hoc CSS, replaced with theme.json tokens and block supports.
- Ensured all template parts and patterns are referenced correctly in templates and documentation.

### Notes

- Continue quarterly audits for unused patterns/styles.
- Add Figma references/screenshots for visual documentation.
- Monitor for new core block/theme APIs and update accordingly.

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

- Pass through sweep for consistent section spacing on archive/landing templates (vertical rhythm with `10/20/30`).

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

- `templates/archive-travel-style.html`: replaced inline destination card markup with reusable `archive-card` pattern inside `post-template`; unified gaps to `40`.
- `templates/index.html`: replaced previous single pattern with full Query Loop using `blog-card` + pagination.
- `templates/single-destination.html`: introduced banded layout (Fast Facts, Related Tours, Related Accommodation, Gallery, Reviews) using section styles; normalised padding/gaps to `10/20/30`.

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
  - Font size to `400` (from `300`)
  - Font weight `400` (from `500`)
  - Uses primary font family; hover handled by `cta-button-hover`.
- `styles/section-website-cta.json`: corrected padding tokens (`20`), added `8px` radius, background `brand-dark`, shadow token.
- Global shadow presets in `theme.json` (elevation-1/2/3) intensified for clearer depth.
- `section-website-cta`: enhanced with `shadow: elevation-2`.
- `section-full-width-cta.json`: introduced with contrast-600 background (interpreting “60% contrast”) and padding.
- `section-breadcrumbs.json`: added vertical padding via `10`, link colours/hover, base `fontWeight` (500); later removed unnecessary horizontal padding.
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
