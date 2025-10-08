<?php
/**
 * Title: Destinations Hero
 * Slug: asnz/destinations-hero
 * Description: Hero cover section for the Destinations archive with overlay and centered archive title.
 * Categories: featured, banner
 * Keywords: destinations, hero, archive header, cover
 * Viewport Width: 1600
 * Block Types: core/template-part, core/post-content
 * Inserter: true
 * Sync: true
 * Provides: destinations-hero, hero
 * Version: 1.0.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: asnz-block-theme
 * Notes: Uses assets/img/destinations-landing-cover-image.png as background.
 */
?>
<!-- wp:cover {"url":"/wp-content/themes/asnz-block-theme/assets/img/destinations-landing-cover-image.png","id":999999,"dimRatio":20,"overlayColor":"contrast","isUserOverlayColor":true,"minHeight":300,"minHeightUnit":"px","sizeSlug":"large","metadata":{"name":"Destinations Hero"},"align":"full","style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;min-height:300px"><img class="wp-block-cover__image-background size-large" alt="" src="/wp-content/themes/asnz-block-theme/assets/img/destinations-landing-cover-image.png" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-20 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"full","className":"is-style-section-hero","layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group alignfull is-style-section-hero"><!-- wp:query-title {"type":"archive","textAlign":"center","showPrefix":false} /--></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
