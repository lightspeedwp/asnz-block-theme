# Envira Gallery Block

Dynamic block that displays an Envira Gallery assigned to a post via ACF/SCF custom field.

## Setup

The block is automatically registered by the theme. After any changes to `index.js`, rebuild:

```bash
cd wp-content/themes/asnz-block-theme/blocks/envira-gallery
npm run build
```

## Development

Start watch mode:

```bash
npm run start
```

## Usage

1. Add the block to any post/page in the editor
2. The gallery is pulled from the `envira_gallery` custom field (set via ACF/SCF)
3. Optional: Override with specific gallery ID via block attribute

## Files

- `index.js` - Editor component (source)
- `build/index.js` - Compiled editor script
- `build/index.asset.php` - Auto-generated dependencies
- `render.php` - Server-side render callback
- `block.json` - Block metadata
- `webpack.config.js` - Build configuration
