<?php
/**
 * Title: Mobile Menu 5
 * Slug: asnz/mobile-menu-5
 * Description: Mobile menu variant with dual section grouping.
 * Categories: asnz/menu
 * Keywords: mobile, menu, navigation, dropdown, links
 * Viewport Width: 600
 * Block Types: core/template-part/menu
 * Inserter: true
 * Sync: true
 * Provides: mobile-navigation
 * Version: 1.1.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: asnz-block-theme
 * Notes: Unified pattern metadata schema.
 */
?>
<?php
/**
 * Title: Mobile Menu 5
 * Slug: asnz/mobile-menu-5
 * Description:
 * Categories: asnz/menu
 * Keywords: menu, drop down, mobile, card
 * Viewport Width: 600
 * Block Types: core/template-part/menu
 * Post Types:
 * Inserter: true
 */
?>
<!-- wp:group {"metadata":{"name":"Menu"},"className":"is-style-default","style":{"position":{"type":""},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30","top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|50"},"border":{"radius":"10px"}},"backgroundColor":"tertiary","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group is-style-default has-tertiary-background-color has-background" style="border-radius:10px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:group {"metadata":{"name":"Section"},"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"textColor":"neutral-600","fontSize":"400","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-neutral-600-color has-text-color has-font-size-400"><!-- wp:paragraph {"style":{"typography":{"textDecoration":"none"}}} -->
<p style="text-decoration:none"><a href="#"><?php esc_html_e('Library', 'asnz-block-theme'); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="#"></a><a href="#"><?php esc_html_e('Collections', 'asnz-block-theme'); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="#"></a><a href="#"><?php esc_html_e('Workflows', 'asnz-block-theme'); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="#"></a><a href="#"><?php esc_html_e('Analytics', 'asnz-block-theme'); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="#"></a><a href="#"><?php esc_html_e('Marketplace', 'asnz-block-theme'); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-separator-thin","backgroundColor":"neutral-300"} -->
<hr class="wp-block-separator has-text-color has-neutral-300-color has-alpha-channel-opacity has-neutral-300-background-color has-background is-style-separator-thin"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Section"},"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:columns {"isStackedOnMobile":false} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase"}},"fontSize":"300"} -->
<p class="has-font-size-300" style="text-transform:uppercase"><strong><?php esc_html_e('Company', 'asnz-block-theme'); ?></strong></p>
<!-- /wp:paragraph -->

<!-- wp:group {"metadata":{"name":"Links"},"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"300"} -->
<p class="has-font-size-300"><?php esc_html_e('Blog', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e('Careers', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e('Pricing', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e('Customers', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase"}},"fontSize":"300"} -->
<p class="has-font-size-300" style="text-transform:uppercase"><strong><?php esc_html_e('Resources', 'asnz-block-theme'); ?></strong></p>
<!-- /wp:paragraph -->

<!-- wp:group {"metadata":{"name":"Links"},"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"300"} -->
<p class="has-font-size-300"><?php esc_html_e('Docs', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e('FAQs', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e('Press', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e('Developers', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"layout":{"selfStretch":"fit","flexSize":null}}} -->
<div class="wp-block-buttons"><!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button"><?php esc_html_e('Get Started Today', 'asnz-block-theme'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"metadata":{"name":"Section"},"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:social-links {"iconColor":"base","iconBackgroundColor":"contrast","className":"is-style-pill-shape","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|10"}}}} -->
<ul class="wp-block-social-links has-icon-color has-icon-background-color is-style-pill-shape"><!-- wp:social-link {"url":"#","service":"youtube"} /-->

<!-- wp:social-link {"url":"#","service":"x"} /-->

<!-- wp:social-link {"url":"#","service":"linkedin"} /-->

<!-- wp:social-link {"url":"#","service":"mail"} /--></ul>
<!-- /wp:social-links -->

<!-- wp:paragraph {"fontSize":"100"} -->
<p class="has-font-size-100"><?php esc_html_e('We\'re hiring! Join our growing team today.', 'asnz-block-theme'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
