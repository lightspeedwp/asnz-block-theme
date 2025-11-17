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
    echo do_shortcode(sprintf('[envira-gallery id="%d"]', $gallery_id));
    return;
}

// Debug info for editor or when no gallery found
$debug_status = function_exists('get_field')
    ? 'SCF available'
    : 'Using post meta';

$raw_field_value = function_exists('get_field')
    ? get_field($meta_field)
    : get_post_meta(get_the_ID(), $meta_field, true);

echo '<div class="envira-gallery--debug" ' .
    'style="padding: 1rem; background: #fff3cd; ' .
    'border: 2px solid #ffc107; margin: 1rem 0;">' .
    '<p><strong>⚠️ Envira Gallery Block (No Gallery Found)</strong></p>' .
    '<p>Field name: <code>' . esc_html($meta_field) . '</code></p>' .
    '<p>Post ID: ' . esc_html(get_the_ID() ?: 'unknown') . '</p>' .
    '<p>Raw field value: <code>' .
    esc_html(is_scalar($raw_field_value) ? $raw_field_value : 'non-scalar') .
    '</code></p>' .
    '<p>Gallery ID after absint: <code>' .
    esc_html($gallery_id ?: 'none') . '</code></p>' .
    '<p>Status: ' . esc_html($debug_status) . '</p>' .
    '<p><em>Set the "' . esc_html($meta_field) .
    '" field on this post to a gallery ID.</em></p>' .
    '</div>';
