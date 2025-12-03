# Best Time to Visit Block

Dynamic block that displays a color-coded monthly calendar showing the best times to visit a destination, using data from ACF/SCF custom fields.

## Setup

The block is automatically registered by the theme. After any changes to `index.js` or `style.css`, rebuild:

```bash
cd wp-content/themes/asnz-block-theme/blocks/best-time-to-visit
npm run build
```

## Development

Start watch mode:

```bash
npm run start
```

## Usage

### Adding the Block

1. Add the block to any post/page in the editor
2. The block reads from two SCF custom fields:
    - `best_time_to_visit` - Array or comma-separated list of best months
    - `shoulder_months_to_visit` - Array or comma-separated list of good/shoulder months

### Month Data Format

Month names must be full lowercase names:

- `january`, `february`, `march`, `april`, `may`, `june`
- `july`, `august`, `september`, `october`, `november`, `december`

### Color Coding

- **Best months** (dark green): Months in `best_time_to_visit`
- **Good months** (medium green): Months in `shoulder_months_to_visit`
- **Mixed months** (light green): Months not selected in either field

### Auto-Hide Feature

To automatically hide the entire section when no month data is present:

1. Wrap the block in a parent Group block
2. Add the CSS class `best-time-wrapper` to the parent Group
3. The section will hide on the frontend if no months are selected

Example structure:

```
Group (with class "best-time-wrapper")
  └─ Heading/Description blocks
  └─ Best Time to Visit Block
```

## Responsive Layout

- **≥ 1100px**: All 12 months in a single row
- **769-1099px**: 6 months per row (2 rows)
- **481-768px**: 3 months per row (4 rows)
- **≤ 480px**: 2 months per row (6 rows)

## Files

- `index.js` - Editor component (source)
- `build/index.js` - Compiled editor script
- `build/index.asset.php` - Auto-generated dependencies
- `render.php` - Server-side render callback with month logic
- `block.json` - Block metadata
- `style.css` - Block styles (grid layout, color states, responsive)
- `webpack.config.js` - Build configuration

## Customization

### Colors

Month colors are defined in `style.css` using theme.json tokens:

- `.best-time-month--best` - Uses `--wp--preset--color--brand-dark`
- `.best-time-month--good` - Uses `--wp--preset--color--brand`
- `.best-time-month--mixed` - Uses `#bdf2a1` (custom light green)

### Spacing

Padding and spacing use theme.json spacing presets:

- `var(--wp--preset--spacing--10)` for vertical padding
- Grid gap controlled via CSS Grid properties

## Security

- All output is properly escaped (`esc_html`, `esc_attr`)
- Input is sanitized (`sanitize_key`)
- No user input is directly rendered
- Read-only block (no nonces required)
