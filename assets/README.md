# ASNZ Block Theme — Assets Directory Reference

This directory contains all static assets used by the theme, organized for clarity, performance, and maintainability. Assets are grouped by type and usage, supporting block styles, templates, and UI components.

## Structure

```
assets/
├── icons/      # SVG icons for UI elements (search, phone, appointment, agents, newsletter, call)
├── fonts/      # Custom font families (Big Shoulders, DM Sans, Fraunces, Montagu Slab, Source Sans Pro, Space Grotesk)
│   └── source-sans-pro/
│       └── static/   # SourceSans3 font files (TTF, WOFF2)
├── styles/     # CSS for core blocks and theme components
│   ├── core-button.css
│   ├── core-calendar.css
│   ├── core-code.css
│   ├── core-columns.css
│   ├── core-cover.css
│   ├── core-gallery.css
│   ├── core-group.css
│   ├── core-image.css
│   ├── core-list.css
│   ├── core-navigation.css
│   ├── core-post-author.css
│   ├── core-post-excerpt.css
│   ├── core-post-terms.css
│   ├── core-post-template.css
│   ├── core-preformatted.css
│   ├── core-pullquote.css
│   ├── core-query-pagination-numbers.css
│   ├── core-separator.css
│   ├── core-table.css
│   ├── core-video.css
│   ├── woocommerce.css
│   └── ...
├── js/         # JavaScript for theme interactivity
│   └── scrollspy.js   # Scrollspy for navigation highlighting
```

## Icons

- SVGs for header, footer, and navigation UI, optimized for accessibility and performance.

## Fonts

- Variable and static font files for all theme typography, supporting multiple weights and styles.

## Styles

- CSS files for block-level and component-level styling, used for advanced selectors and features not yet supported in theme.json.
- Follows WordPress block naming conventions for easy mapping.

## JavaScript

- `js/scrollspy.js`: Adds scrollspy functionality for navigation highlighting and improved user experience.

## Usage & Standards

- All assets are loaded conditionally for performance.
- SVGs and fonts are optimized for web use.
- CSS files supplement theme.json and block styles for advanced layout and effects.
- JavaScript is modular and loaded only when required for specific features.

## Extending

- Add new assets in the appropriate subfolder.
- Update this README when new asset types or files are added.

---

Sources: BTSTRUCT, BDG, SECTSTY
