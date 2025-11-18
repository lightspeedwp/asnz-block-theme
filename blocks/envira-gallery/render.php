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
$section_title_field = isset($attributes['gallerySectionTitleField'])
    ? sanitize_key($attributes['gallerySectionTitleField'])
    : 'gallery_section_title';

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

// If no gallery ID, don't render anything (frontend & editor)
if (! $gallery_id) {
    return '';
}

// Get section title
$section_title = '';
if (function_exists('get_field')) {
    $section_title = get_field($section_title_field);
} else {
    $section_title = get_post_meta(get_the_ID(), $section_title_field, true);
}

// Sanitize and escape section title
$section_title = ! empty($section_title) ? wp_strip_all_tags($section_title) : '';

// Check if we're in the editor context (REST API request)
$is_editor = defined('REST_REQUEST') && REST_REQUEST;

// Output the gallery section wrapper
$section_classes = implode(
    ' ',
    array(
        'wp-block-group',
        'envira-gallery-wrapper',
        'is-style-section-page-section',
    )
);
?>

<section id="gallery" class="<?php echo esc_attr($section_classes); ?>" style="margin-top:0;margin-bottom:0">
    <?php if (! empty($section_title)) : ?>
    <div class="wp-block-group alignwide">
        <hr class="wp-block-separator has-text-color has-primary-color has-alpha-channel-opacity has-primary-background-color has-background"/>
        <h2 class="wp-block-heading has-text-align-center">
            <?php echo esc_html($section_title); ?>
        </h2>
        <hr class="wp-block-separator has-text-color has-primary-color has-alpha-channel-opacity has-primary-background-color has-background"/>
    </div>
    <?php endif; ?>

    <div class="wp-block-group alignwide">
        <?php
        // Shortcode execution: Envira handles its own internal escaping.
        echo do_shortcode(sprintf('[envira-gallery id="%d"]', $gallery_id));
?>
    </div>
</section>


