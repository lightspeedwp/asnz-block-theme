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
$when_to_go_text_field = isset($attributes['whenToGoTextField'])
    ? sanitize_key($attributes['whenToGoTextField'])
    : 'when_to_go_text';
$when_to_go_title_field = isset($attributes['whenToGoTitleField'])
    ? sanitize_key($attributes['whenToGoTitleField'])
    : 'when_to_go_title';

// Get field values
$shoulder_months = array();
$best_months = array();
$when_to_go_text = '';
$when_to_go_title = '';

if (function_exists('get_field')) {
    $shoulder_months_raw = get_field($shoulder_months_field);
    $best_months_raw = get_field($best_months_field);
    $when_to_go_text = get_field($when_to_go_text_field);
    $when_to_go_title = get_field($when_to_go_title_field);
} else {
    $shoulder_months_raw = get_post_meta(get_the_ID(), $shoulder_months_field, true);
    $best_months_raw = get_post_meta(get_the_ID(), $best_months_field, true);
    $when_to_go_text = get_post_meta(get_the_ID(), $when_to_go_text_field, true);
    $when_to_go_title = get_post_meta(get_the_ID(), $when_to_go_title_field, true);
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

// Default title
if (empty($when_to_go_title)) {
    $when_to_go_title = __('Best time to visit', 'asnz-block-theme');
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
            'bg_color' => '#deffd0',
            'text_color' => 'var(--wp--preset--color--contrast)',
        );
    }
}

// Check if we have content
$has_content = ! empty($when_to_go_title) || ! empty($when_to_go_text);

if (! $has_content) {
    // No content - show placeholder in editor, nothing on frontend
    $is_editor = defined('REST_REQUEST') && REST_REQUEST;

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
    }
    return;
}

// Output the block markup
?>
<!-- wp:group {"metadata":{"name":"Best Time to Visit"},"className":"is-style-section-page-section-tertiary","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div id="best-time" class="wp-block-group is-style-section-page-section-tertiary">
    <!-- wp:group {"metadata":{"name":"Title & Description"},"align":"wide","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:group {"metadata":{"name":"Title"},"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group alignwide">
            <!-- wp:separator {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"backgroundColor":"primary"} -->
            <hr class="wp-block-separator has-text-color has-primary-color has-alpha-channel-opacity has-primary-background-color has-background"/>
            <!-- /wp:separator -->

            <!-- wp:heading {"textAlign":"center"} -->
            <h2 class="wp-block-heading has-text-align-center"><?php echo esc_html($when_to_go_title); ?></h2>
            <!-- /wp:heading -->

            <!-- wp:separator {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"backgroundColor":"primary"} -->
            <hr class="wp-block-separator has-text-color has-primary-color has-alpha-channel-opacity has-primary-background-color has-background"/>
            <!-- /wp:separator -->
        </div>
        <!-- /wp:group -->

        <?php if (! empty($when_to_go_text)) : ?>
        <!-- wp:group {"metadata":{"name":"Description"},"align":"wide","layout":{"type":"constrained","contentSize":"900px"}} -->
        <div class="wp-block-group alignwide">
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"400"} -->
            <p class="has-text-align-center has-400-font-size" style="font-style:normal;font-weight:500"><?php echo wp_kses_post(wpautop($when_to_go_text)); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
        <?php endif; ?>
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"metadata":{"name":"Months"},"align":"wide","style":{"border":{"radius":"4px"},"spacing":{"padding":{"right":"var:preset|spacing|20","left":"var:preset|spacing|20"},"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide" style="border-radius:4px;padding-right:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)">
        <?php foreach ($months as $month_full => $month_abbr) : ?>
            <?php $styles = asnz_get_month_styles($month_full, $best_months, $shoulder_months); ?>
            <!-- wp:group {"metadata":{"name":"<?php echo esc_attr($month_abbr); ?>"},"style":{"layout":{"selfStretch":"fill","flexSize":null},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}},"color":{"background":"<?php echo esc_attr($styles['bg_color']); ?>","text":"<?php echo esc_attr($styles['text_color']); ?>"},"border":{"radius":"4px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="border-radius:4px;background-color:<?php echo esc_attr($styles['bg_color']); ?>;color:<?php echo esc_attr($styles['text_color']); ?>;padding-top:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10)">
                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center"><?php echo esc_html($month_abbr); ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        <?php endforeach; ?>
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|60"}}}} -->
    <div class="wp-block-columns">
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-section-shadow-1","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}},"border":{"radius":"4px","width":"0px","style":"none"}},"backgroundColor":"brand-dark","textColor":"base","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-section-shadow-1 has-base-color has-brand-dark-background-color has-text-color has-background has-link-color" style="border-style:none;border-width:0px;border-radius:4px;padding-top:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10)">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} -->
                <p class="has-text-align-center" style="font-style:normal;font-weight:600"><?php echo esc_html__('Best', 'asnz-block-theme'); ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-section-shadow-1","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}},"border":{"radius":"4px","width":"0px","style":"none"}},"backgroundColor":"brand","textColor":"base","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-section-shadow-1 has-base-color has-brand-background-color has-text-color has-background has-link-color" style="border-style:none;border-width:0px;border-radius:4px;padding-top:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10)">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} -->
                <p class="has-text-align-center" style="font-style:normal;font-weight:600"><?php echo esc_html__('Good', 'asnz-block-theme'); ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-section-shadow-1","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}},"border":{"radius":"4px","width":"0px","style":"none"},"color":{"background":"#deffd0"}},"textColor":"contrast","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-section-shadow-1 has-contrast-color has-text-color has-background has-link-color" style="border-style:none;border-width:0px;border-radius:4px;background-color:#deffd0;padding-top:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10)">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} -->
                <p class="has-text-align-center" style="font-style:normal;font-weight:600"><?php echo esc_html__('Mixed', 'asnz-block-theme'); ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
