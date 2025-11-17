<?php

/**
 * Envira Gallery dynamic block render file.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block (unused here).
 * @param WP_Block $block      Block instance.
 *
 * @package asnz-block-theme
 */

if (! isset($attributes) || ! is_array($attributes)) {
    return '';
}

// Sanitize expected attribute keys.
$meta_field = isset($attributes['metaField'])
    ? sanitize_key($attributes['metaField'])
    : 'envira_gallery';
$override_id = isset($attributes['overrideId'])
    ? absint($attributes['overrideId'])
    : 0;

$gallery_id = 0;

if ($override_id) {
    $gallery_id = $override_id;
} elseif (function_exists('get_field')) {
    // Advanced Custom Fields (SCF) path.
    $raw_value = get_field($meta_field);
    $gallery_id = absint($raw_value);
} else {
    // Fallback to post meta.
    $gallery_id = absint(get_post_meta(get_the_ID(), $meta_field, true));
}

if ($gallery_id) {
    // Shortcode execution: Envira handles its own internal escaping.
    echo '<div class="envira-gallery-content">';
    echo do_shortcode(sprintf('[envira-gallery id="%d"]', $gallery_id));
    echo '</div>';
    return;
}

// No gallery ID assigned
// Check if we're in the editor context (REST API request)
$is_editor = defined('REST_REQUEST') && REST_REQUEST;

if ($is_editor) {
    // Editor: show placeholder message
    echo '<div class="envira-gallery-placeholder" ' .
        'style="padding: 1.5rem; background: #f0f0f1; ' .
        'border: 1px dashed #8c8f94; border-radius: 2px; ' .
        'text-align: center; color: #50575e;">' .
        '<p style="margin: 0 0 0.5rem; font-weight: 600;">' .
        esc_html__('Envira Gallery', 'asnz-block-theme') .
        '</p>' .
        '<p style="margin: 0; font-size: 0.875rem;">' .
        esc_html__(
            'Add an Envira Gallery ID to the post custom field ' .
            'to display the gallery.',
            'asnz-block-theme'
        ) .
        '</p>' .
        '</div>';
} else {
    // Frontend: hide the ancestor .envira-gallery-wrapper
    ?>
    <script>
    (function() {
        const hideWrapper = function() {
            const placeholders = document.querySelectorAll(
                '.envira-gallery-empty-marker'
            );
            placeholders.forEach(function(marker) {
                const wrapper = marker.closest('.envira-gallery-wrapper');
                if (wrapper) {
                    wrapper.style.display = 'none';
                }
            });
        };
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', hideWrapper);
        } else {
            hideWrapper();
        }
    })();
    </script>
    <div class="envira-gallery-empty-marker"></div>
    <?php
}
