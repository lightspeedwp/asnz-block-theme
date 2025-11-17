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
    return do_shortcode(sprintf('[envira-gallery id="%d"]', $gallery_id));
}

// Debug info in editor context
if (defined('REST_REQUEST') && REST_REQUEST) {
    $debug_status = function_exists('get_field')
        ? 'SCF available'
        : 'Using post meta';
    return '<div class="envira-gallery--debug" ' .
        'style="padding: 1rem; background: #f0f0f0; ' .
        'border: 1px dashed #999;">' .
        '<p><strong>Envira Gallery Block (Debug)</strong></p>' .
        '<p>Field name: <code>' . esc_html($meta_field) . '</code></p>' .
        '<p>Post ID: ' . esc_html(get_the_ID()) . '</p>' .
        '<p>Gallery ID: ' . esc_html($gallery_id ?: 'none') . '</p>' .
        '<p>Status: ' . esc_html($debug_status) . '</p>' .
        '</div>';
}

// Accessible fallback message.
return '<p class="envira-gallery--empty" aria-live="polite">' .
    esc_html__('No gallery assigned to this post.', 'asnz-block-theme') .
    '</p>';
