<?php
/**
 * Title: Page Full Width
 * Slug: asnz/template-page-full
 * Description: Full-width page layout without sidebars.
 * Categories: asnz/pages
 * Template Types: page
 * Keywords: page, full width, layout
 * Viewport Width: 1500
 * Inserter: false
 * Sync: true
 * Provides: layout, page-template
 * Version: 1.1.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: asnz-block-theme
 * Notes: Unified pattern metadata schema.
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"className":"site-content"} -->
<main class="wp-block-group site-content" style="margin-top:0;margin-bottom:0"><!-- wp:post-content {"layout":{"type":"constrained"}} /--></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->
