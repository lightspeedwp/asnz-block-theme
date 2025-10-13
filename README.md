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
│   │       └── static/       # SourceSans3 font files
│   └── styles/               # CSS for core blocks and components
├── patterns/                 # Block patterns (PHP, MD)
│   ├── header-light.php
│   ├── footer-light.php
│   └── ...                   # Many more pattern files
├── parts/                    # Template parts (HTML)
│   ├── header.html
│   ├── footer.html
│   └── ...                   # Cards, sidebars, etc.
├── styles/
│   ├── blocks/
│   │   ├── button/
│   │   │   ├── button-light.json
│   │   │   └── ...
│   │   ├── separator/
│   │   │   └── vertical.json
│   │   └── read-more/
│   │       └── description.json
│   ├── section-hero.json
│   └── ...                   # Section and block style JSONs
├── templates/
│   ├── archive.html
│   ├── single-tour.html
│   ├── front-page.html
│   └── ...                   # Many more template files
├── theme.json                # Global styles, tokens, settings
├── functions.php             # Theme setup, plugin integrations
├── composer.json             # PHP dependencies
├── readme.txt                # WordPress.org readme
└── README.md                 # Developer documentation
```

## Setup

1. Install via the WordPress admin or upload to `/wp-content/themes/`.
2. Activate the theme.
3. Install and activate the Tour Operator and Wetu Importer plugins for full functionality.

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
