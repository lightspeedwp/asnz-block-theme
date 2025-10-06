<?php
/**
 * Title: Tour Card
 * Slug: lsx-tour-operator/tour-card
 * Description: Figma-aligned tour card: Featured image, title, condensed info rows (From, Duration, Experiences, Destinations), excerpt and button. Uses Section style "Card".
 * Categories: lsx-tour-operator
 * Keywords: tour, trip, itinerary, travel, card, duration, price
 * Viewport Width: 600
 * Block Types: core/post-template, core/query
 * Inserter: true
 * Sync: true
 * Provides: tour, listing, itinerary, card
 * Version: 1.1.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: tour-operator
 * Notes: Mirrors plugin pattern slug for override precedence. Keep slug EXACT.
 */
?>
<!-- wp:group {"metadata":{"name":"Tour Card","categories":["lsx-tour-operator"],"patternName":"lsx-tour-operator/tour-card"},"className":"lsx-tour-card is-style-section-card","style":{"shadow":"var:preset|shadow|extra-large-dark"},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group lsx-tour-card is-style-section-card has-base-background-color has-background" style="box-shadow:var(--wp--preset--shadow--extra-large-dark)"><!-- wp:group {"metadata":{"name":"Card Image"},"className":"tour-card-image","layout":{"type":"constrained"}} -->
<div class="wp-block-group tour-card-image"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content"},"className":"tour-card-content is-style-default","style":{"spacing":{"padding":{"right":"var:preset|spacing|small","left":"var:preset|spacing|small"}}}} -->
<div class="wp-block-group tour-card-content is-style-default" style="padding-right:var(--wp--preset--spacing--small);padding-left:var(--wp--preset--spacing--small)"><!-- wp:group {"metadata":{"name":"Tour Card Title"},"className":"tour-card-title"} -->
<div class="wp-block-group tour-card-title"><!-- wp:post-title {"textAlign":"center","level":3,"isLink":true} /--></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"tour-card-stroke top","backgroundColor":"tertiary-500"} -->
<hr class="wp-block-separator has-text-color has-tertiary-500-color has-alpha-channel-opacity has-tertiary-500-background-color has-background tour-card-stroke top"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Tour Info"},"className":"tour-info","style":{"spacing":{"blockGap":"var:preset|spacing|x-small","padding":{"right":"var:preset|spacing|x-small","left":"var:preset|spacing|x-small"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group tour-info" style="padding-right:var(--wp--preset--spacing--x-small);padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:group {"className":"lsx-price-wrapper info-row","textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group lsx-price-wrapper info-row has-contrast-700-color has-text-color"><!-- wp:paragraph {"className":"label"} -->
<p class="label"><strong>From:</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"lsx/post-meta","args":{"key":"price"}}}},"className":"amount value"} -->
<p class="amount value"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"lsx-duration-wrapper info-row","textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group lsx-duration-wrapper info-row has-contrast-700-color has-text-color"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"label"} -->
<p class="label"><strong>Duration:</strong></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"lsx/post-meta","args":{"key":"duration"}}}},"className":"value"} -->
<p class="value"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"value"} -->
<p class="value">Days</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"lsx-travel-style-wrapper info-row","textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group lsx-travel-style-wrapper info-row has-contrast-700-color has-text-color"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"label"} -->
<p class="label"><strong>Experiences:</strong></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"travel-style","className":"value has-primary-500-color has-text-color"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"lsx-destination-to-tour-wrapper info-row","textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group lsx-destination-to-tour-wrapper info-row has-contrast-700-color has-text-color"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"label"} -->
<p class="label"><strong>Destinations:</strong></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"lsx/post-connection","args":{"key":"destination_to_tour"}}}},"className":"value has-primary-500-color has-text-color"} -->
<p class="value has-primary-500-color has-text-color"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"tour-card-stroke bottom","backgroundColor":"tertiary-500"} -->
<hr class="wp-block-separator has-text-color has-tertiary-500-color has-alpha-channel-opacity has-tertiary-500-background-color has-background tour-card-stroke bottom"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Excerpt"},"className":"tour-card-excerpt","layout":{"type":"constrained"}} -->
<div class="wp-block-group tour-card-excerpt"><!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":25} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Card Footer"},"className":"tour-card-footer"} -->
<div class="wp-block-group tour-card-footer"><!-- wp:buttons {"className":"tour-card-button"} -->
<div class="wp-block-buttons tour-card-button"><!-- wp:button {"width":100,"className":"is-style-card-button"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-card-button"><a class="wp-block-button__link wp-element-button">View Tour</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
