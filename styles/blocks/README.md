# Block Styles Reference

This README describes each block style available in the `styles/blocks` folder of the theme. Each style is defined via a JSON file and applies to specific WordPress blocks, using theme tokens for color, spacing, and typography for consistency and maintainability.

## Button Block Styles (`button/`)

- **Card Button** ([button-card-button.json](button/button-card-button.json))

  - Applies to: `core/button`
  - Features: Rounded bottom corners, primary background, base text, medium font size, and padding for card-style buttons.

- **CTA** ([button-cta.json](button/button-cta.json))

  - Applies to: `core/button`
  - Features: Slightly rounded corners, CTA color background, contrast text, larger font size, and balanced padding for call-to-action buttons.

- **Dark** ([button-dark.json](button/button-dark.json))

  - Applies to: `core/button`
  - Features: Main color background, base text, for dark-themed buttons.

- **Light** ([button-light.json](button/button-light.json))

  - Applies to: `core/button`
  - Features: Base color background, main color text, for light-themed buttons.

- **Summary Nav** ([button-summary-nav.json](button/button-summary-nav.json))

  - Applies to: `core/button`
  - Features: No border radius, uppercase text, contrast color, extra padding for navigation summary buttons.

- **Top Header** ([button-top-header.json](button/button-top-header.json))
  - Applies to: `core/button`
  - Features: No border radius, CTA color background, contrast text, medium font size, and padding for header buttons.

## Read More Block Styles (`read-more/`)

- **Description** ([description.json](read-more/description.json))

  - Applies to: `core/read-more`
  - Features: Contrast text, bold and large font, hover effect for links with primary color.

- **Itinerary** ([itinerary.json](read-more/itinerary.json))
  - Applies to: `core/read-more`
  - Features: Contrast text, bold and medium font, hover effect for links with primary color.

## Notes

- All styles use theme.json tokens for colors, spacing, and typography, ensuring consistency and easy customization.
- For details on each style, see the referenced JSON files.
- If new block styles are added, update this README to maintain documentation.

---

Sources: BDG, BTJSON
