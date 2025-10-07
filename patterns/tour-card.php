<?php
/**
 * Title: Tour Card
 * Slug: asnz/tour-card
 * Description: Figma-aligned tour card: Featured image, title, condensed info rows (From, Duration, Experiences, Destinations), excerpt and button. Uses Section style "Card".
 * Categories: asnz
 * Keywords: tour, trip, itinerary, travel, card, duration, price
 * Viewport Width: 600
 * Block Types: core/post-template, core/query
 * Inserter: true
 * Sync: true
 * Provides: tour, listing, itinerary, card
 * Version: 1.1.1
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: asnz-block-theme

 */
?>
<!-- wp:group {"metadata":{"name":"Tour Card","categories":["asnz"],"patternName":"asnz/tour-card"},"className":"is-style-section-card","backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-card has-base-background-color has-background"><!-- wp:group {"metadata":{"name":"Card Image"},"className":"is-style-section-card-image","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-card-image"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content"},"className":"is-style-section-card-content"} -->
<div class="wp-block-group is-style-section-card-content"><!-- wp:group {"metadata":{"name":"Tour Card Title"},"className":"card-title is-style-section-card-title"} -->
<div class="wp-block-group card-title is-style-section-card-title"><!-- wp:post-title {"textAlign":"center","level":3,"isLink":true} /--></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"tour-card-stroke top","backgroundColor":"tertiary-500"} -->
<hr class="wp-block-separator has-text-color has-tertiary-500-color has-alpha-channel-opacity has-tertiary-500-background-color has-background tour-card-stroke top"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Tour Info"},"className":"is-style-section-tour-info","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-tour-info"><!-- wp:group {"className":"lsx-price-wrapper info-row","style":{"spacing":{"margin":{"top":"var:preset|spacing|spacing-10","bottom":"var:preset|spacing|spacing-10"},"blockGap":"var:preset|spacing|spacing-10"}},"textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group lsx-price-wrapper info-row has-contrast-700-color has-text-color" style="margin-top:var(--wp--preset--spacing--spacing-10);margin-bottom:var(--wp--preset--spacing--spacing-10)"><!-- wp:paragraph {"className":"label"} -->
<p class="label"><strong>From:</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"lsx/post-meta","args":{"key":"price"}}}},"className":"amount value"} -->
<p class="amount value"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"lsx-duration-wrapper info-row","style":{"spacing":{"margin":{"top":"var:preset|spacing|spacing-10","bottom":"var:preset|spacing|spacing-10"},"blockGap":"var:preset|spacing|spacing-10"}},"textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group lsx-duration-wrapper info-row has-contrast-700-color has-text-color" style="margin-top:var(--wp--preset--spacing--spacing-10);margin-bottom:var(--wp--preset--spacing--spacing-10)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"label"} -->
<p class="label"><strong>Duration:</strong></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"5px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"lsx/post-meta","args":{"key":"duration"}}}},"className":"value"} -->
<p class="value"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"value"} -->
<p class="value">Days</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"lsx-travel-style-wrapper info-row","style":{"spacing":{"margin":{"top":"var:preset|spacing|spacing-10","bottom":"var:preset|spacing|spacing-10"},"blockGap":"var:preset|spacing|spacing-10"}},"textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group lsx-travel-style-wrapper info-row has-contrast-700-color has-text-color" style="margin-top:var(--wp--preset--spacing--spacing-10);margin-bottom:var(--wp--preset--spacing--spacing-10)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"label"} -->
<p class="label"><strong>Experiences:</strong></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"travel-style","className":"value has-primary-500-color has-text-color"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"lsx-destination-to-tour-wrapper info-row","style":{"spacing":{"margin":{"top":"var:preset|spacing|spacing-10","bottom":"var:preset|spacing|spacing-10"},"blockGap":"var:preset|spacing|spacing-10"}},"textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group lsx-destination-to-tour-wrapper info-row has-contrast-700-color has-text-color" style="margin-top:var(--wp--preset--spacing--spacing-10);margin-bottom:var(--wp--preset--spacing--spacing-10)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
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

<!-- wp:group {"metadata":{"name":"Excerpt"},"className":"tour-card-excerpt is-style-section-tour-info","layout":{"type":"constrained"}} -->
<div class="wp-block-group tour-card-excerpt is-style-section-tour-info"><!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":25} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Card Footer"},"className":"tour-card-footer"} -->
<div class="wp-block-group tour-card-footer"><!-- wp:buttons {"className":"tour-card-button"} -->
<div class="wp-block-buttons tour-card-button"><!-- wp:button {"width":100,"metadata":{"name":"Permalink"},"className":"is-style-card-button lsx-to-link permalink"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-card-button lsx-to-link permalink"><a class="wp-block-button__link wp-element-button" href="#permalink">View Tour</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->