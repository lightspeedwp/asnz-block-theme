<?php

/**
 * Envira Video Gallery dynamic block render file.
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
    : 'envira_video';
$override_id = isset($attributes['overrideId'])
    ? absint($attributes['overrideId'])
    : 0;
$section_title_field = isset($attributes['videoSectionTitleField'])
    ? sanitize_key($attributes['videoSectionTitleField'])
    : 'videos_section_title';

$video_id = 0;

if ($override_id) {
    $video_id = $override_id;
} elseif (function_exists('get_field')) {
    // Advanced Custom Fields (SCF) path.
    $raw_value = get_field($meta_field);
    $video_id = absint($raw_value);
} else {
    // Fallback to post meta.
    $video_id = absint(get_post_meta(get_the_ID(), $meta_field, true));
}

// Get section title
$section_title = '';
if (function_exists('get_field')) {
    $section_title = get_field($section_title_field);
} else {
    $section_title = get_post_meta(get_the_ID(), $section_title_field, true);
}

// Sanitize and escape section title, fallback to "Videos" if empty
$section_title = ! empty($section_title) ? wp_strip_all_tags($section_title) : '';
if (empty($section_title)) {
    $section_title = __('Videos', 'asnz-block-theme');
}

// Check if we're in the editor context (REST API request)
$is_editor = defined('REST_REQUEST') && REST_REQUEST;

// If no video ID in editor, show placeholder
if (! $video_id && $is_editor) {
    echo '<div class="envira-video-gallery-placeholder" ' .
        'style="padding: 1.5rem; background: #f0f0f1; ' .
        'border: 1px dashed #8c8f94; border-radius: 2px; ' .
        'text-align: center; color: #50575e;">' .
        '<p style="margin: 0 0 0.5rem; font-weight: 600;">' .
        esc_html__('Envira Video Gallery', 'asnz-block-theme') .
        '</p>' .
        '<p style="margin: 0; font-size: 0.875rem;">' .
        esc_html__(
            'Add an Envira Video Gallery ID and section title to display the video gallery.',
            'asnz-block-theme'
        ) .
        '</p>' .
        '</div>';
    return;
}

// If no video ID on frontend, hide ancestor groups with CSS
if (! $video_id) {
    // Generate unique ID for this instance
    $unique_id = 'envira-video-empty-' . wp_unique_id();

    // Output marker with unique ID
    echo '<div class="' . esc_attr($unique_id) . '" style="display:none;"></div>';

    // Output CSS to hide parent groups
    echo '<style type="text/css">';
    echo '.wp-block-group:has(.' . esc_attr($unique_id) . ') { display: none !important; }';
    echo '</style>';

    return;
}

// Output the video gallery section wrapper
$section_classes = implode(
    ' ',
    array(
        'wp-block-group',
        'envira-video-gallery-wrapper',
        'is-style-section-page-section',
    )
);

$heading_wrapper_style = 'display:flex;' .
    'flex-wrap:nowrap;' .
    'align-items:center;' .
    'gap:var(--wp--preset--spacing--20);' .
    'margin-bottom:var(--wp--preset--spacing--40)';

$separator_style = 'flex-grow:1;' .
    'margin-top:0;' .
    'margin-bottom:0';
?>

<div id="videos" class="<?php echo esc_attr($section_classes); ?>" style="margin-top:0;margin-bottom:0">
    <div class="wp-block-group alignwide" style="<?php echo esc_attr($heading_wrapper_style); ?>">
        <hr class="wp-block-separator has-text-color has-primary-color has-alpha-channel-opacity has-primary-background-color has-background" style="<?php echo esc_attr($separator_style); ?>"/>
        <h2 class="wp-block-heading has-text-align-center" style="margin:0">
            <?php echo esc_html($section_title); ?>
        </h2>
        <hr class="wp-block-separator has-text-color has-primary-color has-alpha-channel-opacity has-primary-background-color has-background" style="<?php echo esc_attr($separator_style); ?>"/>
    </div>

    <div class="wp-block-group alignwide">
        <?php
        // Shortcode execution: Envira handles its own internal escaping.
        echo do_shortcode(sprintf('[envira-gallery id="%d"]', $video_id));
?>
    </div>
</div>
