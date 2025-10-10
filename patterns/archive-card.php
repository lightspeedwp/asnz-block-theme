<?php
/**
 * Title: Archive Card
 * Slug: asnz/archive-card
 * Description: A grid display card for archives including featured image, title, excerpt and CTA button.
 * Categories: Cards
 * Keywords: archive, travel, location, card, listing
 * Viewport Width: 600
 * Block Types: core/post-template, core/query
 * Inserter: true
 * Sync: true
 * Provides: archive, card, listing
 * Version: 1.1.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: tour-operator

 */
?>
<!-- wp:group {"metadata":{"name":"Archive Card","categories":["Cards"],"patternName":"asnz/archive-card"},"className":"is-style-section-card","style":{"spacing":{"padding":{"right":"0","left":"0"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-card" style="padding-right:0;padding-left:0"><!-- wp:group {"metadata":{"name":"Card Image"},"className":"is-style-section-card-image","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-card-image"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"21/9","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content"},"className":"is-style-section-card-content","style":{"spacing":{"padding":{"right":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}}}} -->
<div class="wp-block-group is-style-section-card-content" style="padding-right:var(--wp--preset--spacing--spacing-10);padding-left:var(--wp--preset--spacing--spacing-10)"><!-- wp:group {"metadata":{"name":"Card Title"},"className":"card-title is-style-section-card-title"} -->
<div class="wp-block-group card-title is-style-section-card-title"><!-- wp:post-title {"textAlign":"center","level":4,"isLink":true} /--></div>
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
<div class="wp-block-buttons"><!-- wp:button {"width":100,"metadata":{"name":"Permalink"},"className":"is-style-card-button lsx-to-link permalink"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-card-button lsx-to-link permalink"><a class="wp-block-button__link wp-element-button" href="#permalink">Read more</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->