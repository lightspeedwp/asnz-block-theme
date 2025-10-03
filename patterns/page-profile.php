<?php
/**
 * Title: Profile Box
 * Slug: asnz/profile-box
 * Description: A profile box with an avatar, links to social media, and buttons
 * Categories: asnz/call-to-action, asnz/pages
 * Keywords: links, linktree, buttons, profile, bio
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 */
?>
<!-- wp:group {"metadata":{"name":"Profile Box"},"align":"full","style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0"><!-- wp:group {"metadata":{"name":"Hero"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|spacing-50","bottom":"var:preset|spacing|spacing-50","right":"var:preset|spacing|spacing-40","left":"var:preset|spacing|spacing-40"}}},"backgroundColor":"tertiary","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-tertiary-background-color has-background" style="padding-top:var(--wp--preset--spacing--spacing-50);padding-right:var(--wp--preset--spacing--spacing-40);padding-bottom:var(--wp--preset--spacing--spacing-50);padding-left:var(--wp--preset--spacing--spacing-40)"><!-- wp:image {"id":57,"width":"132px","height":"132px","sizeSlug":"full","linkDestination":"none","align":"center","className":"is-style-rounded-full"} -->
<figure class="wp-block-image aligncenter size-full is-resized is-style-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-2.webp" alt="" class="wp-image-57" style="width:132px;height:132px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"metadata":{"name":"Titles"},"style":{"spacing":{"blockGap":"var:preset|spacing|spacing-20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"medium"} -->
<p class="has-text-align-center has-medium-font-size" style="font-style:normal;font-weight:600"><?php esc_html_e( 'Sandra Voyager', 'ollie' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","textColor":"secondary"} -->
<p class="has-text-align-center has-secondary-color has-text-color"><?php esc_html_e( 'Use this page as a LinkTree alternative. Link your social media accounts to this page so your followers can find all of your important links.', 'ollie' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:social-links {"iconBackgroundColor":"main","iconBackgroundColorValue":"#14111f","align":"center","className":"is-style-default","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|spacing-20","left":"var:preset|spacing|spacing-20"},"margin":{"top":"var:preset|spacing|spacing-30"}}}} -->
<ul class="wp-block-social-links aligncenter has-icon-background-color is-style-default" style="margin-top:var(--wp--preset--spacing--spacing-30)"><!-- wp:social-link {"url":"#","service":"twitter"} /-->

<!-- wp:social-link {"url":"#","service":"dribbble"} /-->

<!-- wp:social-link {"url":"#","service":"linkedin"} /-->

<!-- wp:social-link {"url":"#","service":"facebook"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"CTA Buttons"},"align":"full","style":{"spacing":{"margin":{"top":"var:preset|spacing|spacing-50","bottom":"var:preset|spacing|spacing-50"},"padding":{"right":"var:preset|spacing|spacing-30","left":"var:preset|spacing|spacing-30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:var(--wp--preset--spacing--spacing-50);margin-bottom:var(--wp--preset--spacing--spacing-50);padding-right:var(--wp--preset--spacing--spacing-30);padding-left:var(--wp--preset--spacing--spacing-30)"><!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|spacing-20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-buttons"><!-- wp:button {"width":100,"style":{"spacing":{"padding":{"top":"var:preset|spacing|spacing-10","right":"var:preset|spacing|spacing-10","bottom":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}}},"fontSize":"font-size-300"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 has-custom-font-size has-font-size-font-size-300"><a class="wp-block-button__link wp-element-button" href="#" style="padding-top:var(--wp--preset--spacing--spacing-20);padding-right:var(--wp--preset--spacing--spacing-20);padding-bottom:var(--wp--preset--spacing--spacing-20);padding-left:var(--wp--preset--spacing--spacing-20)"><?php esc_html_e( 'Visit My Website', 'ollie' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"width":100,"className":"is-style-fill","style":{"spacing":{"padding":{"top":"var:preset|spacing|spacing-10","right":"var:preset|spacing|spacing-10","bottom":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}}},"fontSize":"font-size-300"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 has-custom-font-size is-style-fill has-font-size-font-size-300"><a class="wp-block-button__link wp-element-button" href="#" style="padding-top:var(--wp--preset--spacing--spacing-20);padding-right:var(--wp--preset--spacing--spacing-20);padding-bottom:var(--wp--preset--spacing--spacing-20);padding-left:var(--wp--preset--spacing--spacing-20)"><?php esc_html_e( 'Follow on Twitter', 'ollie' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"width":100,"style":{"spacing":{"padding":{"top":"var:preset|spacing|spacing-10","right":"var:preset|spacing|spacing-10","bottom":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}}},"fontSize":"font-size-300"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 has-custom-font-size has-font-size-font-size-300"><a class="wp-block-button__link wp-element-button" href="#" style="padding-top:var(--wp--preset--spacing--spacing-20);padding-right:var(--wp--preset--spacing--spacing-20);padding-bottom:var(--wp--preset--spacing--spacing-20);padding-left:var(--wp--preset--spacing--spacing-20)"><?php esc_html_e( 'Buy My Creator Course', 'ollie' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"width":100,"style":{"spacing":{"padding":{"top":"var:preset|spacing|spacing-10","right":"var:preset|spacing|spacing-10","bottom":"var:preset|spacing|spacing-10","left":"var:preset|spacing|spacing-10"}}},"fontSize":"font-size-300"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 has-custom-font-size has-font-size-font-size-300"><a class="wp-block-button__link wp-element-button" href="#" style="padding-top:var(--wp--preset--spacing--spacing-20);padding-right:var(--wp--preset--spacing--spacing-20);padding-bottom:var(--wp--preset--spacing--spacing-20);padding-left:var(--wp--preset--spacing--spacing-20)"><?php esc_html_e( 'Join my Patreon', 'ollie' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
