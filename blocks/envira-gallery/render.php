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
$meta_field  = isset($attributes['metaField']) ? sanitize_key($attributes['metaField']) : 'envira_gallery';
$override_id = isset($attributes['overrideId']) ? absint($attributes['overrideId']) : 0;

$gallery_id = 0;

if ($override_id) {
    $gallery_id = $override_id;
} elseif (function_exists('get_field')) {
    // Advanced Custom Fields (SCF) path.
    $gallery_id = absint(get_field($meta_field));
} else {
    // Fallback to post meta.
    $gallery_id = absint(get_post_meta(get_the_ID(), $meta_field, true));
}

if ($gallery_id) {
    // Shortcode execution: Envira handles its own internal escaping.
    return do_shortcode(sprintf('[envira-gallery id="%d"]', $gallery_id));
}

// Accessible fallback message.
return '<p class="envira-gallery--empty" aria-live="polite">' .
    esc_html__('No gallery assigned to this post.', 'asnz') .
    '</p>';
