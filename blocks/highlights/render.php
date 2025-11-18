<?php

/**
 * Highlights dynamic block render file.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block content (unused).
 * @param WP_Block $block      Block instance.
 *
 * @package asnz-block-theme
 */

if (! isset($attributes) || ! is_array($attributes)) {
    return '';
}

// Sanitize field names
$heading_field = isset($attributes['headingField'])
    ? sanitize_key($attributes['headingField'])
    : 'asnz_highlights_heading';
$text_field = isset($attributes['textField'])
    ? sanitize_key($attributes['textField'])
    : 'asnz_highlights_text';

// Get field values
$heading = '';
$text = '';

if (function_exists('get_field')) {
    $heading = get_field($heading_field);
    $text = get_field($text_field);
} else {
    $heading = get_post_meta(get_the_ID(), $heading_field, true);
    $text = get_post_meta(get_the_ID(), $text_field, true);
}

// Check if we have content
$has_content = ! empty($heading) || ! empty($text);

if ($has_content) {
    echo '<div class="highlights-block">';

    if (! empty($heading)) {
        // Strip any HTML tags from heading
        $clean_heading = wp_strip_all_tags($heading);
        echo '<h3 class="highlights-heading has-medium-font-size" ' .
            'style="margin-top: 0; padding-top: 0;">' .
            esc_html($clean_heading) .
            '</h3>';
    }

    if (! empty($text)) {
        // Apply wpautop to convert line breaks to <p> and <br> tags
        $formatted_text = wpautop($text);

        echo '<div class="highlights-text">' .
            '<style>' .
            '.highlights-text strong { font-weight: 700; }' .
            '.highlights-text p { margin: 0.5em 0; }' .
            '</style>' .
            wp_kses_post($formatted_text) .
            '</div>';
    }

    echo '</div>';
    return;
}

// No content - show placeholder in editor, nothing on frontend
$is_editor = defined('REST_REQUEST') && REST_REQUEST;

if ($is_editor) {
    echo '<div class="highlights-placeholder" ' .
        'style="padding: 1.5rem; background: #f0f0f1; ' .
        'border: 1px dashed #8c8f94; border-radius: 2px; ' .
        'text-align: center; color: #50575e;">' .
        '<p style="margin: 0 0 0.5rem; font-weight: 600;">' .
        esc_html__('Highlights', 'asnz-block-theme') .
        '</p>' .
        '<p style="margin: 0; font-size: 0.875rem;">' .
        esc_html__(
            'Add highlights heading and text in the post custom fields.',
            'asnz-block-theme'
        ) .
        '</p>' .
        '</div>';
}
