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

        // Define icons based on field type
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

        $icon = ('included' === $meta_key) ? $check_icon : $cross_icon;

        // Define allowed HTML tags for wp_kses (including SVG)
        $allowed_html = wp_kses_allowed_html('post');
        $allowed_html['svg'] = array(
            'width' => true,
            'height' => true,
            'viewbox' => true,
            'fill' => true,
            'xmlns' => true,
            'aria-hidden' => true,
            'class' => true,
        );
        $allowed_html['path'] = array(
            'd' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
            'fill' => true,
        );

        // Strip out paragraph tags that WYSIWYG editors often add
        $processed_value = preg_replace('/<p[^>]*>|<\/p>/i', '', $value);

        // If already contains list markup, inject icons into existing list items
        if (preg_match('/<[ou]l[^>]*>/i', $processed_value)) {
            $processed_value = preg_replace(
                '/(<li[^>]*>)/',
                '$1' . $icon,
                $processed_value
            );
            return $before . wp_kses($processed_value, $allowed_html) . $after;
        }

        // Split by line breaks (handles different line ending types)
        $lines = preg_split('/\r\n|\r|\n/', $processed_value);

        // Filter out empty lines
        $lines = array_filter(array_map('trim', $lines));

        if (empty($lines)) {
            return $return_html;
        }

        // Build unordered list with icons
        $output = '<ul class="lsx-' . esc_attr($meta_key) . '-list">';
        foreach ($lines as $line) {
            $output .= '<li>' . $icon . wp_kses($line, $allowed_html) . '</li>';
        }
        $output .= '</ul>';

        return $before . $output . $after;

        return $before . $output . $after;
    },
    10,
    5
);
