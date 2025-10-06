<?php
/**
 * Title: Destination Card
 * Slug: lsx-tour-operator/destination-card
 * Description: A grid display card for destinations including featured image, title, excerpt and CTA button.
 * Categories: lsx-tour-operator
 * Keywords: destination, travel, location, card, listing
 * Viewport Width: 600
 * Block Types: core/post-template, core/query
 * Inserter: true
 * Sync: true
 * Provides: destination, card, listing
 * Version: 1.1.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: tour-operator
 * Notes: Override of plugin pattern. Keep slug EXACT for precedence.
 */
?>
<!-- wp:group {"metadata":{"name":"Destination Card"},"className":"is-style-section-card","style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-card" style="padding-right:0;padding-left:0"><!-- wp:group {"metadata":{"name":"Card Image"},"className":"tour-card-image is-style-section-card-image","layout":{"type":"constrained"}} -->
<div class="wp-block-group tour-card-image is-style-section-card-image"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content"},"className":"is-style-section-card-content","style":{"spacing":{"padding":{"right":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}}}} -->
<div class="wp-block-group is-style-section-card-content" style="padding-right:var(--wp--preset--spacing--spacing-10);padding-left:var(--wp--preset--spacing--spacing-10)"><!-- wp:group {"metadata":{"name":"Destination Card Title"},"className":"s-style-default is-style-section-card-title","style":{"layout":{"selfStretch":"fixed","flexSize":"100%"},"spacing":{"padding":{"right":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}},"dimensions":{"minHeight":"2rem"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-card-title"><!-- wp:post-title {"textAlign":"center","level":4,"isLink":true} /-->

<!-- wp:paragraph {"align":"center","metadata":{"name":"Tagline","bindings":{"content":{"source":"lsx/post-meta","args":{"key":"tagline"}}}},"className":"lsx-tagline-wrapper","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"font-size-300"} -->
<p class="has-text-align-center lsx-tagline-wrapper has-font-size-300-font-size" style="font-style:normal;font-weight:500"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"tour-card-stroke top","backgroundColor":"tertiary-500"} -->
<hr class="wp-block-separator has-text-color has-tertiary-500-color has-alpha-channel-opacity has-tertiary-500-background-color has-background tour-card-stroke top"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Excerpt"},"className":"tour-card-excerpt","style":{"spacing":{"padding":{"right":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group tour-card-excerpt" style="padding-right:var(--wp--preset--spacing--spacing-10);padding-left:var(--wp--preset--spacing--spacing-10)"><!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":35} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Card Footer"}} -->
<div class="wp-block-group"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"width":100,"className":"is-style-card-button"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-card-button"><a class="wp-block-button__link wp-element-button">View Destination</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->