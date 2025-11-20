<?php
/**
 * Best Time to Visit dynamic block render file.
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
$shoulder_months_field = isset($attributes['shoulderMonthsField'])
    ? sanitize_key($attributes['shoulderMonthsField'])
    : 'shoulder_months_to_visit';
$best_months_field = isset($attributes['bestMonthsField'])
    ? sanitize_key($attributes['bestMonthsField'])
    : 'best_time_to_visit';

// Get field values
$shoulder_months = array();
$best_months = array();

if (function_exists('get_field')) {
    $shoulder_months_raw = get_field($shoulder_months_field);
    $best_months_raw = get_field($best_months_field);
} else {
    $shoulder_months_raw = get_post_meta(get_the_ID(), $shoulder_months_field, true);
    $best_months_raw = get_post_meta(get_the_ID(), $best_months_field, true);
}

// Normalize month arrays
if (is_array($shoulder_months_raw)) {
    $shoulder_months = array_map('strtolower', $shoulder_months_raw);
} elseif (is_string($shoulder_months_raw)) {
    $shoulder_months = array_map('trim', array_map('strtolower', explode(',', $shoulder_months_raw)));
}

if (is_array($best_months_raw)) {
    $best_months = array_map('strtolower', $best_months_raw);
} elseif (is_string($best_months_raw)) {
    $best_months = array_map('trim', array_map('strtolower', explode(',', $best_months_raw)));
}

// Define months
$months = array(
    'january' => 'Jan',
    'february' => 'Feb',
    'march' => 'Mar',
    'april' => 'Apr',
    'may' => 'May',
    'june' => 'Jun',
    'july' => 'Jul',
    'august' => 'Aug',
    'september' => 'Sep',
    'october' => 'Oct',
    'november' => 'Nov',
    'december' => 'Dec',
);

/**
 * Get month styling classes and inline styles.
 *
 * @param string $month_name Full month name in lowercase.
 * @param array  $best       Array of best months.
 * @param array  $shoulder   Array of shoulder months.
 * @return array Array with 'bg_color' and 'text_color' keys.
 */
function asnz_get_month_styles($month_name, $best, $shoulder)
{
    if (in_array($month_name, $best, true)) {
        return array(
            'bg_color' => 'var(--wp--preset--color--brand-dark)',
            'text_color' => 'var(--wp--preset--color--base)',
        );
    } elseif (in_array($month_name, $shoulder, true)) {
        return array(
            'bg_color' => 'var(--wp--preset--color--brand)',
            'text_color' => 'var(--wp--preset--color--base)',
        );
    } else {
        return array(
            'bg_color' => '#bdf2a1',
            'text_color' => 'var(--wp--preset--color--contrast)',
        );
    }
}

// Check if we have at least one month selection
$has_content = ! empty($best_months) || ! empty($shoulder_months);

// Check if we're in the editor context (REST API request)
$is_editor = defined('REST_REQUEST') && REST_REQUEST;

if (! $has_content) {
    // No content - show placeholder in editor, hide on frontend
    if ($is_editor) {
        echo '<div class="best-time-to-visit-placeholder" ' .
            'style="padding: 1.5rem; background: #f0f0f1; ' .
            'border: 1px dashed #8c8f94; border-radius: 2px; ' .
            'text-align: center; color: #50575e;">' .
            '<p style="margin: 0 0 0.5rem; font-weight: 600;">' .
            esc_html__('Best Time to Visit', 'asnz-block-theme') .
            '</p>' .
            '<p style="margin: 0; font-size: 0.875rem;">' .
            esc_html__(
                'Add best time to visit data in the post custom fields.',
                'asnz-block-theme'
            ) .
            '</p>' .
            '</div>';
        return;
    }

    // If no content on frontend, hide ancestor groups with CSS
    // Generate unique ID for this instance
    $unique_id = 'best-time-to-visit-empty-' . wp_unique_id();

    // Output marker with unique ID
    echo '<div class="' . esc_attr($unique_id) . '" style="display:none;"></div>';

    // Output inline script using direct output to avoid escaping
    // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<script>';
    echo '(function(){';
    echo 'var m=document.querySelector(".' . esc_js($unique_id) . '");';
    echo 'if(m){';
    echo 'var e=m.parentElement;';
    echo 'var c=0;';
    echo 'while(e&&c<3){';
    echo 'if(e.classList.contains("wp-block-group")){';
    echo 'e.style.display="none";';
    echo 'c++;';
    echo '}';
    echo 'e=e.parentElement;';
    echo '}';
    echo '}';
    echo '})();';
    echo '</script>';
    // phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped

    return;
}

// Output the block markup - just the months row
?>
<!-- wp:group {"metadata":{"name":"Months"},"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group alignwide">
    <?php foreach ($months as $month_full => $month_abbr) : ?>
        <?php $styles = asnz_get_month_styles($month_full, $best_months, $shoulder_months); ?>
        <!-- wp:group {"metadata":{"name":"<?php echo esc_attr($month_abbr); ?>"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}},"color":{"background":"<?php echo esc_attr($styles['bg_color']); ?>","text":"<?php echo esc_attr($styles['text_color']); ?>"},"border":{"radius":"4px"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group" style="border-radius:4px;background-color:<?php echo esc_attr($styles['bg_color']); ?>;color:<?php echo esc_attr($styles['text_color']); ?>;padding-top:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20)">
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}}} -->
            <p class="has-text-align-center" style="font-size:0.875rem"><?php echo esc_html($month_abbr); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    <?php endforeach; ?>
</div>
<!-- /wp:group -->
