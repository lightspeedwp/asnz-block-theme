<?php
/**
 * Title: Blog Card
 * Slug: asnz/blog-card
 * Description: Blog/archive card with featured image, title, meta (author, date, categories, tags), excerpt and button. Uses Section Card styles.
 * Categories: Cards
 * Keywords: blog, post, article, card, meta, author, date, categories, tags
 * Viewport Width: 600
 * Block Types: core/post-template, core/query
 * Inserter: true
 * Sync: true
 * Provides: blog, post, card
 * Version: 1.0.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: asnz-block-theme
 */
?>
<!-- wp:group {"metadata":{"name":"Blog Card","categories":["Cards"],"patternName":"asnz/blog-card"},"className":"is-style-section-card","style":{"spacing":{"padding":{"right":"0","left":"0"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-card" style="padding-right:0;padding-left:0"><!-- wp:group {"metadata":{"name":"Card Image"},"className":"tour-card-image is-style-section-card-image","layout":{"type":"constrained"}} -->
<div class="wp-block-group tour-card-image is-style-section-card-image"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"21/9","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content"},"className":"is-style-section-card-content"} -->
<div class="wp-block-group is-style-section-card-content"><!-- wp:group {"metadata":{"name":"Card Title"},"className":"card-title is-style-section-card-title","style":{"spacing":{"padding":{"right":"0","left":"0"}}}} -->
<div class="wp-block-group card-title is-style-section-card-title" style="padding-right:0;padding-left:0"><!-- wp:post-title {"textAlign":"left","level":3,"isLink":true} /--></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"tour-card-stroke top","backgroundColor":"tertiary-500"} -->
<hr class="wp-block-separator has-text-color has-tertiary-500-color has-alpha-channel-opacity has-tertiary-500-background-color has-background tour-card-stroke top"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Meta"},"className":"is-style-section-blog-card-meta","style":{"spacing":{"blockGap":"5px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-blog-card-meta"><!-- wp:group {"style":{"spacing":{"blockGap":"5px"}},"textColor":"contrast-700","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group has-contrast-700-color has-text-color"><!-- wp:paragraph {"className":"label","fontSize":"font-size-200"} -->
<p class="label has-font-size-200-font-size">
    <?php echo esc_html__( 'By', 'asnz-block-theme' ); ?>
</p>

<!-- wp:post-author-name {"isLink":true,"fontSize":"font-size-200"} /-->

<!-- wp:paragraph {"fontSize":"font-size-200"} -->
<p class="has-font-size-200-font-size">on</p>
<!-- /wp:paragraph -->

<!-- wp:post-date {"fontSize":"font-size-200"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"5px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div><!-- wp:paragraph {"className":"label","fontSize":"font-size-200"} -->
<p class="label has-font-size-200-font-size">
    <?php echo esc_html__( 'Posted in:', 'asnz-block-theme' ); ?>
</p>
<!-- /wp:paragraph -->

<!-- wp:post-terms {"term":"category","className":"value"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"5px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div><!-- wp:paragraph {"className":"label","fontSize":"font-size-200"} -->
<p class="label has-font-size-200-font-size">
    <?php echo esc_html__( 'Tags:', 'asnz-block-theme' ); ?>
</p>
<!-- /wp:paragraph -->

<!-- wp:post-terms {"term":"post_tag","className":"value"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"tour-card-stroke top","backgroundColor":"tertiary-500"} -->
<hr class="wp-block-separator has-text-color has-tertiary-500-color has-alpha-channel-opacity has-tertiary-500-background-color has-background tour-card-stroke top"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Excerpt"},"style":{"spacing":{"padding":{"right":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--spacing-10);padding-left:var(--wp--preset--spacing--spacing-10)"><!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":35} /--></div>
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