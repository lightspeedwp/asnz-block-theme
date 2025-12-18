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
 * Enqueue small enhancement scripts (scrollspy for secondary sticky nav)
 */
function enqueue_scripts()
{
    wp_enqueue_script(
        'asnz-scrollspy',
        get_template_directory_uri() . '/assets/js/scrollspy.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_scripts');



/**
 * Enqueue WooCommerce specific stylesheet
 */
function enqueue_woocommerce_styles()
{

    // Only enqueue if WooCommerce is active
    if (class_exists('WooCommerce')) {
        wp_enqueue_style(
            'theme-woocommerce-style',
            get_template_directory_uri() . '/assets/styles/woocommerce.css',
            array(),
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_woocommerce_styles');


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

// Facet Mobile expanding menus
add_action('wp_head', function () {
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
 * Process list meta fields (included/not_included) to ensure consistent list output.
 *
 * Converts newline-separated text into HTML lists while preserving existing list
 * markup. Adds appropriate icons for included/excluded items.
 *
 * @param string $return_html  The formatted HTML output.
 * @param string $meta_key  The meta key being queried.
 * @param mixed  $value  The raw meta value.
 * @param string $before  HTML before content.
 * @param string $after  HTML after content.
 *
 * @return string Processed HTML with list formatting and icons.
 */
add_filter(
    'lsx_to_custom_field_query',
    function ($return_html, $meta_key, $value, $before, $after) {
        // Only process included and not_included fields
        if (!in_array($meta_key, array('included', 'not_included'), true)) {
            return $return_html;
        }

        if (empty($value)) {
            return $return_html;
        }

        // Strip out paragraph tags that WYSIWYG editors often add
        $processed_value = preg_replace('/<p[^>]*>|<\/p>/i', '', $value);

        // If already contains list markup, keep as-is for now
        if (preg_match('/<[ou]l[^>]*>/i', $processed_value)) {
            return $before . $processed_value . $after;
        }

        // Split by line breaks (handles different line ending types)
        $lines = preg_split('/\r\n|\r|\n/', $processed_value);

        // Filter out empty lines
        $lines = array_filter(array_map('trim', $lines));

        if (empty($lines)) {
            return $return_html;
        }

        // Build unordered list without icons (icons added via render_block filter)
        $output = '<ul class="lsx-' . esc_attr($meta_key) . '-list">';
        foreach ($lines as $line) {
            $output .= '<li>' . wp_kses_post($line) . '</li>';
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

        // Check if this has our list classes
        $has_included = strpos($block_content, 'lsx-included-list') !== false;
        $has_excluded = strpos($block_content, 'lsx-not_included-list') !== false;

        if (!$has_included && !$has_excluded) {
            return $block_content;
        }

        // Define icons
        $check_icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" '
            . 'xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
            . '<path d="M9 12.75L11.25 15L15 9.75M21 12C21 16.9706 16.9706 21 12 21'
            . 'C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 '
            . '7.02944 21 12Z" stroke="currentColor" stroke-width="1.5" '
            . 'stroke-linecap="round" stroke-linejoin="round"/></svg>';

        $cross_icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" '
            . 'xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
            . '<path d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12C21 '
            . '16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 '
            . '7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" '
            . 'stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>'
            . '</svg>';

        // Inject check icon into included list items
        if ($has_included) {
            $block_content = preg_replace_callback(
                '/<ul[^>]*class="[^"]*lsx-included-list[^"]*"[^>]*>(.*?)<\/ul>/si',
                function ($matches) use ($check_icon) {
                    $ul_content = $matches[1];
                    // Add check icon to each <li> in this ul
                    $ul_content = preg_replace('/(<li>)/i', '$1' . $check_icon, $ul_content);
                    // Rebuild the ul
                    // Find the opening <ul ...> tag
                    preg_match('/^<ul[^>]*class="[^"]*lsx-included-list[^"]*"[^>]*>/i', $matches[0], $ul_open);
                    $ul_tag = $ul_open[0];
                    return $ul_tag . $ul_content . '</ul>';
                },
                $block_content
            );
        }

        // Inject cross icon into not_included list items
        if ($has_excluded) {
            $block_content = preg_replace_callback(
                '/<ul[^>]*class="[^"]*lsx-not_included-list[^"]*"[^>]*>(.*?)<\/ul>/si',
                function ($matches) use ($cross_icon) {
                    $ul_content = $matches[1];
                    // Add cross icon to each <li> in this ul
                    $ul_content = preg_replace('/(<li>)/i', '$1' . $cross_icon, $ul_content);
                    // Rebuild the ul
                    // Find the opening <ul ...> tag
                    preg_match('/^<ul[^>]*class="[^"]*lsx-not_included-list[^"]*"[^>]*>/i', $matches[0], $ul_open);
                    $ul_tag = $ul_open[0];
                    return $ul_tag . $ul_content . '</ul>';
                },
                $block_content
            );
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
        strpos($classes, 'envira-gallery-wrapper') === false &&
        strpos($classes, 'envira-video-gallery-wrapper') === false &&
        strpos($classes, 'best-time-wrapper') === false
    ) {
        return $block_content;
    }

    // 1. Envira Gallery Wrapper
    if (strpos($classes, 'envira-gallery-wrapper') !== false) {
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
    if (strpos($classes, 'envira-video-gallery-wrapper') !== false) {
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
    if (strpos($classes, 'best-time-wrapper') !== false) {
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
