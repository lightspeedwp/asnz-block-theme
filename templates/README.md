# Template Reference

This README documents all templates in the `templates` folder. Each template defines the structure and layout for a specific page type or content context in the theme, using block patterns, section styles, and theme.json tokens for scalable, accessible, and maintainable design.

## Templates Overview

- **404.html**
  - Custom 404 error page using the `asnz/template-page-404` pattern.

- **Archive Templates**
  - `archive.html`, `archive-accommodation.html`, `archive-destination.html`, `archive-review.html`, `archive-tour.html`, `archive-travel-style.html`, `category.html`
  - Used for listing posts, accommodations, destinations, reviews, tours, and travel styles. Common features:
    - Header template part
    - Hero cover section (image, overlay, title)
    - Breadcrumbs (`is-style-section-breadcrumbs`)
    - Archive description and content areas
    - Query blocks for listing items
    - Section styles: hero, page-section, archive-heading, archive-content, tour-description, website-cta

- **Front Page** (`front-page.html`)
  - Home page template with hero image, title/subtitle, search block, scroll icon, and featured sections. Uses hero and custom section styles.

- **Index** (`index.html`)
  - Default blog listing; hero cover, breadcrumbs, blog intro, and post list.

- **Page Templates**
  - `page.html`, `page-no-title.html`, `page-with-sidebar.html`
  - Standard, no-title, and sidebar page layouts. Some use block patterns (`asnz/template-page-full`, `asnz/template-page-right-sidebar`, `asnz/template-page-wide`).

- **Search** (`search.html`)
  - Search results page; hero cover, breadcrumbs, CTA, and results listing.

- **Single Templates**
  - `single.html`, `single-accommodation.html`, `single-country.html`, `single-destination.html`, `single-region.html`, `single-review.html`, `single-tour.html`
  - Used for individual posts, accommodations, countries, destinations, regions, reviews, and tours. Common features:
    - Header template part
    - Hero cover (featured image, overlay, title)
    - Breadcrumbs
    - Secondary sticky navigation (`is-style-section-secondary-sticky-nav`)
    - Main content area with section styles
    - Custom blocks for price, meta, and related content

- **Taxonomy Template** (`taxonomy-travel-style.html`)
  - For travel style taxonomy archives; hero cover, breadcrumbs, description, CTA, and content columns.

## Section & Block Styles
- Templates use section styles from the [`styles/README.md`](../styles/README.md) and block styles from [`styles/blocks/README.md`](../styles/blocks/README.md) for layout, color, and typography.

## Notes
- All templates are built with WordPress blocks and patterns for full compatibility with the block editor.
- Update this README when new templates are added or existing ones are changed.

---
Sources: BTSTRUCT, SECTSTY
