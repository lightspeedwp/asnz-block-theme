<?php

/**
 * Theme bootstrap for the ASNZ Block Theme.
 *
 * Rebranded from the original Ollie theme; all pattern category slugs, text domains,
 * and metadata have been updated to use the `asnz` namespace.
 *
 * @package   asnz-block-theme
 * @category  Theme
 * @author    Lightspeed WP
 * @license   GNU General Public License v2 or later
 * @link      https://lightspeedwp.agency
 * @since     1.0.0
 * @php       7.4
 */

namespace ASNZ;

/**
 * Set up theme defaults and register various WordPress features.
 */
function setup()
{

    // Enqueue editor styles and fonts.
    add_editor_style('style.css');

    // Remove core block patterns.
    remove_theme_support('core-block-patterns');
}
add_action('after_setup_theme', __NAMESPACE__ . '\setup');


/**
 * Enqueue styles.
 */
function enqueue_style_sheet()
{
    wp_enqueue_style(sanitize_title(__NAMESPACE__), get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_style_sheet', 100);


/**
 * Register pattern categories.
 */
function pattern_categories()
{

    $block_pattern_categories = array(
        'asnz/card'           => array(
            'label' => __('Cards', 'asnz-block-theme'),
        ),
        'asnz/call-to-action' => array(
            'label' => __('Call To Action', 'asnz-block-theme'),
        ),
        'asnz/features'       => array(
            'label' => __('Features', 'asnz-block-theme'),
        ),
        'asnz/hero'           => array(
            'label' => __('Hero', 'asnz-block-theme'),
        ),
        'asnz/pages'          => array(
            'label' => __('Pages', 'asnz-block-theme'),
        ),
        'asnz/posts'          => array(
            'label' => __('Posts', 'asnz-block-theme'),
        ),
        'asnz/pricing'        => array(
            'label' => __('Pricing', 'asnz-block-theme'),
        ),
        'asnz/testimonial'    => array(
            'label' => __('Testimonials', 'asnz-block-theme'),
        ),
        'asnz/menu'    => array(
            'label' => __('Menu', 'asnz-block-theme'),
        )
    );

    foreach ($block_pattern_categories as $name => $properties) {
        register_block_pattern_category($name, $properties);
    }
}
add_action('init', __NAMESPACE__ . '\pattern_categories', 9);


/**
 * Remove last separator on blog/archive if no pagination exists.
 */
function is_paginated()
{
    global $wp_query;
    if ($wp_query->max_num_pages < 2) {
        echo '<style>.blog .wp-block-post-template .wp-block-post:last-child .entry-content + .wp-block-separator, .archive .wp-block-post-template .wp-block-post:last-child .entry-content + .wp-block-separator, .blog .wp-block-post-template .wp-block-post:last-child .entry-content + .wp-block-separator, .search .wp-block-post-template .wp-block-post:last-child .wp-block-post-excerpt + .wp-block-separator { display: none; }</style>';
    }
}
add_action('wp_head', __NAMESPACE__ . '\is_paginated');


/**
 * Add a Sidebar template part area
 */
function template_part_areas(array $areas)
{
    $areas[] = array(
        'area'        => 'sidebar',
        'area_tag'    => 'section',
        'label'       => __('Sidebar', 'asnz-block-theme'),
        'description' => __('The Sidebar template defines a page area that can be found on the Page (With Sidebar) template.', 'asnz-block-theme'),
        'icon'        => 'sidebar',
    );

    return $areas;
}
add_filter('default_wp_template_part_areas', __NAMESPACE__ . '\template_part_areas');

// Facet Mobile expanding menus. Only emitted when FacetWP is active — otherwise
// fUtil()/FWP are undefined and this errored on every page and pulled jQuery
// site-wide for no reason.
add_action('wp_head', function () {
    if (! function_exists('FWP')) {
        return;
    }
    ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        fUtil().on('click', '.flyout-row h3', function() {
          fUtil(this).closest('.flyout-row').toggleClass('expanded');
        });
      });
    </script>
<?php });


add_action('wp_head', function () {
    if (! function_exists('FWP')) {
        return;
    }
    ?>
    <script>
      (function($) {
        $(function() {
          if ('object' != typeof FWP) return;
 
          /* Modify the flyout wrapper HTML */
          FWP.hooks.addFilter('facetwp/flyout/flyout_html', function(flyout_html) {
                        return flyout_html.replace(
                            ' <div class="facetwp-flyout-close">x</div>',
                            ' <div class="facetwp-flyout-close">'
                                + '<h3>Filters</h3>'
                                + '<button type="button" aria-label="Close filters" >'
                                + '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 18L18 6M6 6L18 18" stroke="#090909" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'
                                + '</button>'
                                + '</div>'
                        );
          });
 
        });
      })(jQuery);
    </script>
  <?php
}, 100);


/**
 * Register custom blocks.
 * Assets are loaded automatically via block.json file references.
 */
add_action(
    'init',
    function () {
        $blocks = array(
            'best-time-to-visit',
            'envira-gallery',
            'envira-video-gallery',
            'highlights',
        );

        foreach ($blocks as $block) {
            register_block_type(get_template_directory() . '/blocks/' . $block);
        }
    }
);

/**
 * Split a list meta value into its individual items.
 *
 * `included` and `not_included` are CMB2 wysiwyg fields that the WETU importer
 * also writes to verbatim, so the same field arrives in several shapes and none
 * of the separators are interchangeable:
 *
 * - `<p>One<br>Two</p>`    TinyMCE soft breaks, and every WETU payload.
 * - `<p>One</p><p>Two</p>` TinyMCE hard breaks.
 * - `"One\r\nTwo"`         Legacy plain text, entered before the fields were wysiwyg.
 *
 * Every separator is normalised to one delimiter before splitting, so importing
 * a tour or editing the field cannot collapse the list into a single item.
 *
 * @param string $value  The raw meta value.
 *
 * @return array List items, trimmed, with empty items removed.
 */
function asnz_split_list_meta_value($value)
{
    $delimiter = "\n";

    // Normalise every separator variant to the delimiter.
    $value = preg_replace('/<br\s*\/?\s*>/i', $delimiter, $value);
    $value = preg_replace('/<\/?p\b[^>]*>/i', $delimiter, $value);
    $value = preg_replace('/\r\n|\r/', $delimiter, $value);

    $items = array_map(
        function ($item) {
            // Non-breaking spaces are what empty wysiwyg paragraphs leave behind.
            $item = str_replace(array('&nbsp;', "\xc2\xa0"), ' ', $item);
            return trim($item);
        },
        explode($delimiter, $value)
    );

    return array_values(array_filter($items, 'strlen'));
}

/**
 * Add the icon list class to the list tags in already-formatted meta markup.
 *
 * Values entered as real lists in the editor keep their own markup, but still
 * need the class so the icons can be injected on render.
 *
 * @param string $html  The meta markup.
 * @param string $list_class  The class to add.
 *
 * @return string Markup with the class applied to its list tags.
 */
function asnz_add_list_meta_class($html, $list_class)
{
    if (!class_exists('\WP_HTML_Tag_Processor')) {
        return $html;
    }

    $tags = new \WP_HTML_Tag_Processor($html);

    while ($tags->next_tag()) {
        if (!in_array($tags->get_tag(), array('UL', 'OL'), true)) {
            continue;
        }

        $tags->add_class($list_class);
    }

    return $tags->get_updated_html();
}

/**
 * Process list meta fields (included/not_included) to ensure consistent list output.
 *
 * Converts the value into an HTML list while preserving existing list markup.
 * Icons are added separately, by the render_block filter below.
 *
 * @param string $return_html  The formatted HTML output.
 * @param string $meta_key  The meta key being queried.
 * @param mixed  $value  The raw meta value.
 * @param string $before  HTML before content.
 * @param string $after  HTML after content.
 *
 * @return string Processed HTML with list formatting.
 */
add_filter(
    'lsx_to_custom_field_query',
    function ($return_html, $meta_key, $value, $before, $after) {
        // Only process included and not_included fields
        if (!in_array($meta_key, array('included', 'not_included'), true)) {
            return $return_html;
        }

        if (!is_string($value) || '' === trim($value)) {
            return $return_html;
        }

        $list_class = 'lsx-' . $meta_key . '-list';

        // Values already stored as list markup only need the class adding.
        if (preg_match('/<[ou]l\b/i', $value)) {
            return $before . asnz_add_list_meta_class($value, $list_class) . $after;
        }

        $items = asnz_split_list_meta_value($value);

        // Whitespace-only markup, such as the paragraph an emptied wysiwyg leaves behind.
        if (empty($items)) {
            return '';
        }

        $output = '<ul class="' . esc_attr($list_class) . '">';
        foreach ($items as $item) {
            $output .= '<li>' . wp_kses_post($item) . '</li>';
        }
        $output .= '</ul>';

        return $before . $output . $after;
    },
    10,
    5
);

/**
 * Add icons to included/not_included lists via render_block filter.
 *
 * This filter runs after block bindings have been processed, allowing us to
 * inject SVG icons into the final rendered HTML.
 *
 * @param string $block_content  The block content.
 * @param array  $block  The block data.
 *
 * @return string Modified block content with icons.
 */
add_filter(
    'render_block',
    function ($block_content, $block) {
        // Only process paragraph blocks with LSX post-meta bindings
        if ('core/paragraph' !== $block['blockName']) {
            return $block_content;
        }

        // Define icons, keyed by the list class they belong to
        $icons = array(
            'lsx-included-list'     => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" '
                . 'xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
                . '<path d="M9 12.75L11.25 15L15 9.75M21 12C21 16.9706 16.9706 21 12 21'
                . 'C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 '
                . '7.02944 21 12Z" stroke="currentColor" stroke-width="1.5" '
                . 'stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'lsx-not_included-list' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" '
                . 'xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
                . '<path d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12C21 '
                . '16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 '
                . '7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" '
                . 'stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>'
                . '</svg>',
        );

        foreach ($icons as $list_class => $icon) {
            // Check if this has our list class
            if (false === strpos($block_content, $list_class)) {
                continue;
            }

            // A bound paragraph holds exactly one meta value, so every list item in
            // the block belongs to this list, including any the editor nested.
            $block_content = preg_replace('/(<li\b[^>]*>)/i', '$1' . $icon, $block_content);

            break;
        }

        return $block_content;
    },
    10,
    2
);

/**
 * Conditionally hide specific wrapper group blocks based on related field data.
 *
 * This targets `core/group` blocks that use one of the following wrapper classes:
 * - `envira-gallery-wrapper` (hidden when the associated `envira_gallery` ACF field
 *   or `envira_gallery` post meta is empty).
 * - `envira-video-gallery-wrapper` (hidden when the associated `envira_video` ACF field
 *   or `envira_video` post meta is empty).
 * - `best-time-wrapper` (hidden when both `best_time_to_visit` and
 *   `shoulder_months_to_visit` ACF fields or post meta are empty).
 *
 * @param string   $block_content The block content.
 * @param array    $parsed_block  The parsed block.
 * @param WP_Block $block_obj     The block object.
 * @return string Modified block content, or an empty string when a wrapper is hidden.
 */
function asnz_maybe_hide_empty_wrappers($block_content, $parsed_block, $block_obj)
{
    // Only process core/group blocks
    if (! isset($parsed_block['blockName']) || 'core/group' !== $parsed_block['blockName']) {
        return $block_content;
    }

    // Check for wrapper class
    if (! isset($parsed_block['attrs']['className']) || empty($parsed_block['attrs']['className'])) {
        return $block_content;
    }

    $classes = $parsed_block['attrs']['className'];

    // Early return if none of the target wrapper classes are present
    if (
        ! str_contains($classes, 'envira-gallery-wrapper') &&
        ! str_contains($classes, 'envira-video-gallery-wrapper') &&
        ! str_contains($classes, 'best-time-wrapper')
    ) {
        return $block_content;
    }

    // 1. Envira Gallery Wrapper
    if (str_contains($classes, 'envira-gallery-wrapper')) {
        $gallery_id = 0;
        if (function_exists('get_field')) {
            $gallery_id = absint(get_field('envira_gallery'));
        } else {
            $gallery_id = absint(get_post_meta(get_the_ID(), 'envira_gallery', true));
        }

        if (! $gallery_id) {
            return '';
        }
    }

    // 2. Envira Video Gallery Wrapper
    if (str_contains($classes, 'envira-video-gallery-wrapper')) {
        $video_id = 0;
        if (function_exists('get_field')) {
            $video_id = absint(get_field('envira_video'));
        } else {
            $video_id = absint(get_post_meta(get_the_ID(), 'envira_video', true));
        }

        if (! $video_id) {
            return '';
        }
    }

    // 3. Best Time to Visit Wrapper
    if (str_contains($classes, 'best-time-wrapper')) {
        $has_content = false;
        $best        = '';
        $shoulder    = '';

        if (function_exists('get_field')) {
            $best     = get_field('best_time_to_visit');
            $shoulder = get_field('shoulder_months_to_visit');
        } else {
            $best     = get_post_meta(get_the_ID(), 'best_time_to_visit', true);
            $shoulder = get_post_meta(get_the_ID(), 'shoulder_months_to_visit', true);
        }

        if (! empty($best) || ! empty($shoulder)) {
            $has_content = true;
        }
        if (! $has_content) {
            return '';
        }
    }

    return $block_content;
}
add_filter('render_block', __NAMESPACE__ . '\asnz_maybe_hide_empty_wrappers', 10, 3);


/**
 * Register Mega Menu block style.
 */
function register_mega_menu_style()
{
    $blocks = array('core/group', 'core/navigation', 'core/columns', 'core/cover');

    foreach ($blocks as $block) {
        register_block_style(
            $block,
            array(
                'name'         => 'mega-menu',
                'label'        => __('Mega Menu', 'asnz-block-theme'),
            )
        );
    }
}
add_action('init', __NAMESPACE__ . '\register_mega_menu_style');


/**
 * Register the TO Gallery block style.
 *
 * Tour Operator registers `lsx-tour-operator/gallery` as a core/gallery variation
 * and injects its images server-side from the `gallery` post meta. The layout that
 * makes it read like the Envira galleries it replaces — four fixed-size images per
 * row, 2px gutter, 4:3 crop — lives in style.css behind `.is-style-to-gallery`.
 * Registering it as a block style makes it selectable and previewable in the editor.
 */
function register_to_gallery_style()
{
    register_block_style(
        'core/gallery',
        array(
            'name'  => 'to-gallery',
            'label' => __('TO Gallery', 'asnz-block-theme'),
        )
    );
}
add_action('init', __NAMESPACE__ . '\register_to_gallery_style');


/**
 * Finish off the Tour Operator gallery's front-end markup.
 *
 * Two passes over the figure the plugin builds:
 *
 * 1. Add `is-style-to-gallery`. The single-* templates ship the class so the editor
 *    previews the right layout, but the variation can be inserted anywhere, and
 *    Tour_Operator's own render_block callback rebuilds the gallery <figure> from
 *    whatever classes the saved markup carried.
 *
 * 2. Give each image alt text. The plugin hardcodes `alt=""` on every gallery image,
 *    which leaves them unlabelled for screen readers and — because Tour Operator's
 *    slick-lightbox is configured to read its caption from the alt attribute — leaves
 *    the lightbox caption blank where Envira showed the image title. The attachment
 *    ID is available: the plugin keys the `gallery` meta by it and writes it out as
 *    `wp-image-{id}`. Existing alt text is never overwritten.
 *
 * Priority 11: the plugin's callback runs at 10 and replaces the whole figure, so
 * anything added earlier would be thrown away.
 *
 * @param string $block_content The block content.
 * @param array  $parsed_block  The parsed block.
 * @return string Block content with the style class and alt text applied.
 */
function asnz_to_gallery_markup($block_content, $parsed_block)
{
    if (! isset($parsed_block['blockName']) || 'core/gallery' !== $parsed_block['blockName']) {
        return $block_content;
    }

    $source = $parsed_block['attrs']['metadata']['bindings']['content']['source'] ?? '';

    if ('lsx/gallery' !== $source) {
        return $block_content;
    }

    // The plugin returns an empty string when the post has no gallery images.
    if ('' === trim($block_content)) {
        return $block_content;
    }

    $tags    = new \WP_HTML_Tag_Processor($block_content);
    $changed = false;

    if ($tags->next_tag(array('class_name' => 'wp-block-gallery'))) {
        if (! str_contains($block_content, 'is-style-to-gallery')) {
            $tags->add_class('is-style-to-gallery');
            $changed = true;
        }
    }

    while ($tags->next_tag(array('tag_name' => 'IMG'))) {
        if ('' !== (string) $tags->get_attribute('alt')) {
            continue;
        }

        if (! preg_match('/\bwp-image-(\d+)\b/', (string) $tags->get_attribute('class'), $match)) {
            continue;
        }

        $attachment_id = (int) $match[1];
        $alt           = trim((string) get_post_meta($attachment_id, '_wp_attachment_image_alt', true));

        if ('' === $alt) {
            $alt = trim((string) get_the_title($attachment_id));
        }

        if ('' !== $alt) {
            $tags->set_attribute('alt', $alt);
            $changed = true;
        }
    }

    return $changed ? $tags->get_updated_html() : $block_content;
}
add_filter('render_block', __NAMESPACE__ . '\asnz_to_gallery_markup', 11, 2);


/**
 * Add the thumbnail strip to the Tour Operator gallery lightbox.
 *
 * Tour Operator already binds slick-lightbox to `.wp-block-gallery.has-nested-images`
 * in its custom.js, and the `.slick-lightbox` rules in style.css skin it to match the
 * Envira lightbox this replaces. The thumbnail strip is the one part with no
 * slick-lightbox equivalent, so it is built in JS — see the file for why it has to
 * watch for the modal rather than hook an event.
 *
 * Gated on the plugin's script actually being enqueued: it registers on
 * `wp_enqueue_scripts` at priority 1, so by the time this runs the answer is known,
 * and without slick-lightbox there is no lightbox for the strip to attach to.
 */
function enqueue_gallery_lightbox()
{
    if (! wp_script_is('slick-lightbox', 'enqueued')) {
        return;
    }

    wp_enqueue_script(
        'asnz-gallery-lightbox',
        get_template_directory_uri() . '/assets/js/gallery-lightbox.js',
        array('jquery', 'slick-lightbox'),
        wp_get_theme()->get('Version'),
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_gallery_lightbox', 100);


/**
 * Apply Ollie mega menu panel geometry at hydration instead of at window.load.
 *
 * Ollie Menu Designer sizes its full-width panels from view.js and defers that to
 * the `window.load` event, which on this site lands 1-2s after first paint. Until
 * then a `.menu-width-full` panel has no width from any stylesheet and collapses
 * to a thin column. See assets/js/mega-menu-init.js for the full explanation.
 *
 * Only enqueued when the plugin providing the block is actually active, and only
 * on the front end — the editor renders panels through its own code path.
 */
function enqueue_mega_menu_init()
{
    // The panels live in the header template part rather than post content, so
    // gate on the block type existing at all, not on has_block().
    if (! \WP_Block_Type_Registry::get_instance()->is_registered('ollie/mega-menu')) {
        return;
    }

    wp_enqueue_script(
        'asnz-mega-menu-init',
        get_template_directory_uri() . '/assets/js/mega-menu-init.js',
        array(),
        wp_get_theme()->get('Version'),
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_mega_menu_init');


/**
 * Output TouristTrip JSON-LD on single tour pages.
 *
 * Yoast already emits the Organization / WebPage / BreadcrumbList graph, so this
 * adds only the tour-specific type Yoast does not know about — improving how
 * search engines and AI agents understand tour pages. Price is intentionally
 * omitted: the tour price is a free-text field, not a clean number, so emitting
 * a schema.org Offer from it would be unreliable. Extend via the
 * `asnz_tour_schema` filter to add offers/duration once a numeric source exists.
 */
function tour_jsonld()
{
    if (! is_singular('tour')) {
        return;
    }

    $post = get_queried_object();
    if (! $post instanceof \WP_Post) {
        return;
    }

    $description = has_excerpt($post) ? get_the_excerpt($post) : wp_trim_words(wp_strip_all_tags($post->post_content), 55);

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'TouristTrip',
        'name'        => get_the_title($post),
        'description' => trim($description),
        'url'         => get_permalink($post),
        'provider'    => array(
            '@type' => 'TravelAgency',
            'name'  => get_bloginfo('name'),
            'url'   => home_url('/'),
        ),
    );

    $image = get_the_post_thumbnail_url($post, 'full');
    if ($image) {
        $schema['image'] = $image;
    }

    /**
     * Filter the tour TouristTrip schema before output.
     *
     * @param array   $schema The schema array.
     * @param \WP_Post $post   The tour post.
     */
    $schema = apply_filters('asnz_tour_schema', $schema, $post);

    if (empty($schema)) {
        return;
    }

    echo "\n" . '<script type="application/ld+json">'
        . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . '</script>' . "\n";
}
add_action('wp_head', __NAMESPACE__ . '\tour_jsonld', 20);


/**
 * Preload the LCP hero image on the front page.
 *
 * The hero lives deep inside a Cover block, so the browser discovers it late.
 * Preloading it (as the front page's largest contentful paint element) lets the
 * request start immediately, improving LCP — especially on mobile.
 */
function preload_front_page_hero()
{
    if (! is_front_page()) {
        return;
    }

    $hero = get_template_directory_uri() . '/assets/img/front-page-hero-image.webp';
    echo '<link rel="preload" as="image" href="' . esc_url($hero) . '" fetchpriority="high">' . "\n";
}
add_action('wp_head', __NAMESPACE__ . '\preload_front_page_hero', 1);


/**
 * Preload the three font files every page actually uses above the fold:
 * Source Sans 3 (body copy, variable weight) and Lato Regular/Bold (headings,
 * nav). These are requested at VeryHigh priority regardless, but the browser
 * only discovers them once it parses the @font-face rules inside style.css —
 * preloading lets the fetch start in parallel with that CSS parse instead of
 * after it. The other five registered Lato faces (Light/Italic/BoldItalic)
 * are not preloaded: they're only used in copy that varies by page and are
 * not guaranteed to be above the fold everywhere.
 */
function preload_core_fonts()
{
    $fonts = [
        get_template_directory_uri() . '/assets/fonts/source-sans-pro/SourceSans3-VariableFont_wght.woff2',
        get_template_directory_uri() . '/assets/fonts/lato/Lato-Regular.woff2',
        get_template_directory_uri() . '/assets/fonts/lato/Lato-Bold.woff2',
    ];

    foreach ($fonts as $font) {
        echo '<link rel="preload" as="font" type="font/woff2" href="' . esc_url($font) . '" crossorigin="anonymous">' . "\n";
    }
}
add_action('wp_head', __NAMESPACE__ . '\preload_core_fonts', 1);
