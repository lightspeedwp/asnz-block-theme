# ASNZ Block Theme

A modern WordPress block theme for [African Safaris New Zealand](https://www.africansafaris.co.nz/), built by [LightSpeed Development](https://lightspeedwp.agency/). Based on OllieWP, this theme leverages a custom Figma Design System ([Figma link](https://www.figma.com/design/skzvQSTH1rAJPYu6sopTM1/ASNZ-Design-System?node-id=6807-46947&t=rGIaUSeosdqVcEkx-1)) for consistent, scalable design.

## Features

- **Block-based architecture:** Uses WordPress block patterns and template parts for flexible layouts.
- **Design tokens:** Centralized in `theme.json` for colors, spacing, and typography.
- **Plugin support:** Built to integrate with [Tour Operator](https://touroperator.solutions/) and Wetu Importer plugins.
- **Accessibility & performance:** Semantic markup, color contrast, lazy media, and minimal inline styles.
- **Internationalization:** All user-facing strings are translatable.

## Structure

```
asnz-block-theme/
├── assets/
│   ├── icons/                # SVG icons for UI
│   ├── fonts/                # Custom font families
│   │   └── source-sans-pro/
│   │       └── static/
│   └── styles/
├── patterns/                 # Block patterns (see below)
│   ├── tour-card.php
│   ├── blog-card.php
│   ├── destination-card.php
│   ├── archive-card.php
│   ├── full-width-cover-cta.php
│   ├── full-width-cta-mountains.php
│   ├── full-width-cta-sunset.php
│   ├── full-width-cta-lion.php
│   ├── full-width-cta-desert.php
│   ├── website-cta.php
│   ├── header.php
│   ├── footer.php
│   └── ...
│   └── README.md             # [Patterns Reference](patterns/README.md)
├── parts/
│   ├── header.html
│   ├── footer.html
│   ├── room-card.html
│   ├── accommodation-card.html
│   ├── tour-card.html
│   ├── archive-card.html
│   ├── blog-card.html
│   ├── destination-card.html
│   ├── sidebar.html
│   └── ...
├── styles/
│   ├── section-blog-card-meta.json
│   ├── section-breadcrumbs.json
│   ├── section-card-content.json
│   ├── section-card-image.json
│   ├── section-card-title.json
│   ├── section-card.json
│   ├── section-fast-facts.json
│   ├── section-footer.json
│   ├── section-full-width-cta.json
│   ├── section-hero.json
│   ├── section-main-header.json
│   ├── section-page-section.json
│   ├── section-page-section-tertiary.json
│   ├── section-post-pagination.json
│   ├── section-post-tags.json
│   ├── section-secondary-sticky-nav.json
│   ├── section-top-header.json
│   ├── section-tour-description.json
│   ├── section-tour-info-row.json
│   ├── section-tour-info.json
│   ├── section-website-cta.json
│   ├── blocks/
│   │   ├── button/
│   │   │   ├── button-card-button.json
│   │   │   ├── button-cta.json
│   │   │   ├── button-dark.json
│   │   │   ├── button-light.json
│   │   │   ├── button-summary-nav.json
│   │   │   ├── button-top-header.json
│   │   ├── separator/
│   │   │   └── vertical.json
│   │   ├── read-more/
│   │   │   ├── description.json
│   │   │   └── itinerary.json
│   └── README.md             # [Section Styles Reference](styles/README.md)
│   └── blocks/README.md      # [Block Styles Reference](styles/blocks/README.md)
├── templates/
│   ├── 404.html
│   ├── archive.html
│   ├── archive-accommodation.html
│   ├── archive-destination.html
│   ├── archive-review.html
│   ├── archive-tour.html
│   ├── archive-travel-style.html
│   ├── category.html
│   ├── front-page.html
│   ├── index.html
│   ├── page.html
│   ├── page-no-title.html
│   ├── page-with-sidebar.html
│   ├── search.html
│   ├── single.html
│   ├── single-accommodation.html
│   ├── single-country.html
│   ├── single-destination.html
│   ├── single-region.html
│   ├── single-review.html
│   ├── single-tour.html
│   ├── taxonomy-travel-style.html
│   └── README.md             # [Template Reference](templates/README.md)
├── theme.json
├── functions.php
├── composer.json
├── readme.txt
└── README.md
```

## Setup

1. Install via the WordPress admin or upload to `/wp-content/themes/`.
2. Activate the theme.
3. Install and activate the Tour Operator and Wetu Importer plugins for full functionality.

## Patterns

All patterns are listed in [`patterns/README.md`](patterns/README.md). Key patterns include:

- Tour Card, Blog Card, Destination Card, Archive Card
- Full Width Cover CTA, Full Width CTA (Mountains, Sunset, Lion, Desert), Website CTA
- Header, Footer

See the [Patterns Reference](patterns/README.md) for details and usage.

## Section & Block Styles

Section styles are documented in [`styles/README.md`](styles/README.md). Block styles (buttons, read-more, etc.) are in [`styles/blocks/README.md`](styles/blocks/README.md).

See the [Section Styles Reference](styles/README.md) and [Block Styles Reference](styles/blocks/README.md) for all available styles and their usage.

## Templates

All templates are listed in [`templates/README.md`](templates/README.md). Key templates include:

- 404, Archive (multiple types), Category, Front Page, Index, Page (variants), Search, Single (multiple types), Taxonomy

See the [Template Reference](templates/README.md) for details and usage.

## Development

- Patterns and styles are managed via Figma and exported for use in the theme.
- Follow WordPress coding standards and block theme best practices.
- Contributions welcome via [LightSpeed Development](https://lightspeedwp.agency/).

## Credits

- Theme by LightSpeed Development.
- Design System by LightSpeed (Figma).
- Based on OllieWP.

## License

GPLv2 or later.

---

Sources: BTSTRUCT, BDG, BTJSON
