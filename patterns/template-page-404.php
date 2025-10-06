<?php
/**
 * Title: Page 404
 * Slug: asnz/template-page-404
 * Description: 404 not found page layout with helpful navigation.
 * Categories: asnz/pages
 * Template Types: page
 * Keywords: page, 404, error
 * Viewport Width: 1500
 * Inserter: false
 * Sync: true
 * Provides: layout, page-template, error
 * Version: 1.1.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: asnz-block-theme
 * Notes: Unified pattern metadata schema.
 */
?>
<?php
/**
 * Title: 404 Page
 * Slug: asnz/template-page-404
 * Description: The page that shows when no other page is found.
 * Categories: asnz/pages
 * Keywords: page, full-width
 * Viewport Width: 1500
 * Inserter: false
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|xx-large","top":"var:preset|spacing|xx-large"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|spacing-20"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--xx-large);padding-bottom:var(--wp--preset--spacing--xx-large)"><!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="has-text-align-center"><?php esc_html_e( 'Page Not Found', 'asnz-block-theme' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"secondary"} -->
<p class="has-text-align-center has-secondary-color has-text-color"><?php esc_html_e( 'Unfortunately, the page you are looking for no longer exists, or has been moved. Please try searching for your content below.', 'asnz-block-theme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"}}},"backgroundColor":"tertiary","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-tertiary-background-color has-background" style="padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:search {"showLabel":false,"placeholder":"<?php esc_attr_e( 'Search', 'asnz-block-theme' ); ?>","widthUnit":"px","buttonText":"<?php esc_attr_e( 'Search', 'asnz-block-theme' ); ?>"} /--></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->
