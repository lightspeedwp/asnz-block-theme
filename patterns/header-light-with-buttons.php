<?php
/**
 * Title: Header Light With Buttons
 * Slug: asnz/header-light-with-buttons
 * Description: Header with nav and social icons
 * Categories: header
 * Keywords: header, nav, links, button
 * Viewport Width: 1500
 * Block Types: core/template-part/header
 * Post Types: wp_template
 * Inserter: true
 */
?>
<!-- wp:group {"metadata":{"name":"Header"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|spacing-30","bottom":"var:preset|spacing|spacing-30","right":"var:preset|spacing|spacing-30","left":"var:preset|spacing|spacing-30"},"margin":{"top":"0px"}},"border":{"bottom":{"color":"var:preset|color|border-light","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="border-bottom-color:var(--wp--preset--color--border-light);border-bottom-width:1px;margin-top:0px;padding-top:var(--wp--preset--spacing--spacing-30);padding-right:var(--wp--preset--spacing--spacing-30);padding-bottom:var(--wp--preset--spacing--spacing-30);padding-left:var(--wp--preset--spacing--spacing-30)"><!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:site-title {"level":0} /-->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|spacing-10"}}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Download Now', 'asnz-block-theme' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-secondary-button"} -->
<div class="wp-block-button is-style-secondary-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Learn More', 'asnz-block-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
