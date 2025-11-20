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

// Define months with localized abbreviations
$months = array(
    'january'   => date_i18n('M', strtotime('January')),
    'february'  => date_i18n('M', strtotime('February')),
    'march'     => date_i18n('M', strtotime('March')),
    'april'     => date_i18n('M', strtotime('April')),
    'may'       => date_i18n('M', strtotime('May')),
    'june'      => date_i18n('M', strtotime('June')),
    'july'      => date_i18n('M', strtotime('July')),
    'august'    => date_i18n('M', strtotime('August')),
    'september' => date_i18n('M', strtotime('September')),
    'october'   => date_i18n('M', strtotime('October')),
    'november'  => date_i18n('M', strtotime('November')),
    'december'  => date_i18n('M', strtotime('December')),
);

if (! function_exists('asnz_get_month_class')) {
/**
 * Get month CSS class based on selection.
 *
 * @param string $month_name Full month name in lowercase.
 * @param array  $best       Array of best months.
 * @param array  $shoulder   Array of shoulder months.
 * @return string CSS class name.
 */
function asnz_get_month_class($month_name, $best, $shoulder)
{
    if (in_array($month_name, $best, true)) {
        return 'best-time-month--best';
    } elseif (in_array($month_name, $shoulder, true)) {
        return 'best-time-month--good';
    } else {
        return 'best-time-month--mixed';
    }
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

    // If no content on frontend, hide ancestor with specific class
    // Generate unique ID for this instance
    $unique_id = 'best-time-to-visit-empty-' . wp_unique_id();
    $script_handle = 'asnz-best-time-hide-' . $unique_id;

    // Register and enqueue inline script using WordPress script handling
    wp_register_script($script_handle, false, array(), false, array('in_footer' => true));
    wp_enqueue_script($script_handle);

    // Add inline script to hide ancestor with .best-time-wrapper class
    $inline_script = sprintf(
        '(function(){var m=document.querySelector(".%s");if(m){var e=m.closest(".best-time-wrapper");if(e){e.style.display="none";}}})();',
        esc_js($unique_id)
    );
    wp_add_inline_script($script_handle, $inline_script);

    // Output marker with unique ID
    echo '<div class="' . esc_attr($unique_id) . '" style="display:none;"></div>';

    return;
}

// Output the block markup - just the months row
$align_class = isset($attributes['align']) ? 'align' . $attributes['align'] : '';
?>
<div class="best-time-months-container <?php echo esc_attr($align_class); ?>">
    <?php
    $month_index = 0;
foreach ($months as $month_full => $month_abbr) :
    $month_class = asnz_get_month_class($month_full, $best_months, $shoulder_months);
    $month_index++;
    $data_attr = ($month_index === 7) ? ' data-row-break="true"' : '';
    // Map CSS class to season label for accessibility
    switch ($month_class) {
        case 'best-time-month--best':
            $season_label = __('Best time to visit', 'asnz-block-theme');
            break;
        case 'best-time-month--good':
            $season_label = __('Good time to visit', 'asnz-block-theme');
            break;
        default:
            $season_label = __('Alternative time to visit', 'asnz-block-theme');
            break;
    }
    ?>
        <div class="best-time-month <?php echo esc_attr($month_class); ?>"<?php echo $data_attr; ?> aria-label="<?php echo esc_attr($month_abbr . ': ' . $season_label); ?>">
            <p class="best-time-month__label"><?php echo esc_html($month_abbr); ?></p>
        </div>
    <?php endforeach; ?>
</div>
