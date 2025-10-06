<?php
/**
 * Title: Header Light
 * Slug: asnz/header-light
 * Description: Header with primary navigation and optional social links on a light background.
 * Categories: header
 * Keywords: header, navigation, nav, links, button, menu
 * Viewport Width: 1500
 * Block Types: core/template-part/header
 * Post Types: wp_template
 * Inserter: true
 * Sync: true
 * Provides: site-header, navigation
 * Version: 1.1.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: asnz-block-theme
 * Notes: Unified pattern metadata schema.
 */
?>
<!-- wp:group {"metadata":{"name":"Header Wrapper"},"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"blockGap":"0"},"border":{"bottom":{"color":"var:preset|color|tertiary-500","width":"1px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="border-bottom-color:var(--wp--preset--color--tertiary-500);border-bottom-width:1px;padding-top:0;padding-bottom:0"><!-- wp:group {"metadata":{"name":"Top Utility Bar"},"align":"full","className":"has-base-color has-text-color has-link-color is-style-section-top-header","layout":{"type":"constrained","justifyContent":"right"}} -->
<div class="wp-block-group alignfull has-base-color has-text-color has-link-color is-style-section-top-header"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|spacing-30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|spacing-10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"","label":"Book an Appointment","width":24} -->
<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:24px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" aria-label="Book an Appointment"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.75 2.75C7.16421 2.75 7.5 3.08579 7.5 3.5V5H16.5V3.5C16.5 3.08579 16.8358 2.75 17.25 2.75C17.6642 2.75 18 3.08579 18 3.5V5H18.75C20.4069 5 21.75 6.34315 21.75 8V19.25C21.75 20.9069 20.4069 22.25 18.75 22.25H5.25C3.59315 22.25 2.25 20.9069 2.25 19.25V8C2.25 6.34315 3.59315 5 5.25 5H6V3.5C6 3.08579 6.33579 2.75 6.75 2.75ZM20.25 11.75C20.25 10.9216 19.5784 10.25 18.75 10.25H5.25C4.42157 10.25 3.75 10.9216 3.75 11.75V19.25C3.75 20.0784 4.42157 20.75 5.25 20.75H18.75C19.5784 20.75 20.25 20.0784 20.25 19.25V11.75Z" fill="#F7941C"></path></svg></div></div>
<!-- /wp:outermost/icon-block -->

<!-- wp:paragraph -->
<p><a href="#">Book an Appointment</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|spacing-10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"","label":"Travel Agents","width":24} -->
<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:24px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" aria-label="Travel Agents"><path d="M21.9998 6.5H20V22.5002H21.9998C23.0996 22.5002 23.9999 21.5996 23.9999 20.4998V8.4998C23.9999 7.40029 23.0996 6.5 21.9998 6.5Z" fill="#F7941C"></path><path d="M15.9999 6.4999V4.5001C15.9999 3.40029 15.0996 2.5 14.0001 2.5H9.9999C8.90039 2.5 8.0001 3.40029 8.0001 4.5001V6.4999H6V22.5001H18V6.4999H15.9999ZM14.0001 6.4999H9.9999V4.4998H14.0001V6.4999Z" fill="#F7941C"></path><path d="M2.0001 6.5C0.900293 6.5 0 7.40029 0 8.5001V20.5001C0 21.5999 0.900293 22.5005 2.0001 22.5005H3.9999V6.5H2.0001Z" fill="#F7941C"></path></svg></div></div>
<!-- /wp:outermost/icon-block -->

<!-- wp:paragraph -->
<p><a href="#">Travel Agents</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|spacing-10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"","label":"Newsletter","width":24} -->
<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:24px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" aria-label="Newsletter"><path d="M1.5 9.1691V17.75C1.5 19.4069 2.84315 20.75 4.5 20.75H19.5C21.1569 20.75 22.5 19.4069 22.5 17.75V9.1691L13.5723 14.6631C12.6081 15.2564 11.3919 15.2564 10.4277 14.6631L1.5 9.1691Z" fill="#F7941C"></path><path d="M22.5 7.40783V7.25C22.5 5.59315 21.1569 4.25 19.5 4.25H4.5C2.84315 4.25 1.5 5.59315 1.5 7.25V7.40783L11.2139 13.3856C11.696 13.6823 12.304 13.6823 12.7861 13.3856L22.5 7.40783Z" fill="#F7941C"></path></svg></div></div>
<!-- /wp:outermost/icon-block -->

<!-- wp:paragraph -->
<p><a href="#">Newsletter</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|spacing-10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"","label":"Call NZ","width":24} -->
<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:24px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" aria-label="Call NZ"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.5 5C1.5 3.34315 2.84315 2 4.5 2H5.87163C6.732 2 7.48197 2.58556 7.69064 3.42025L8.79644 7.84343C8.97941 8.5753 8.70594 9.34555 8.10242 9.79818L6.8088 10.7684C6.67447 10.8691 6.64527 11.0167 6.683 11.1197C7.81851 14.2195 10.2805 16.6815 13.3803 17.817C13.4833 17.8547 13.6309 17.8255 13.7316 17.6912L14.7018 16.3976C15.1545 15.7941 15.9247 15.5206 16.6566 15.7036L21.0798 16.8094C21.9144 17.018 22.5 17.768 22.5 18.6284V20C22.5 21.6569 21.1569 23 19.5 23H17.25C8.55151 23 1.5 15.9485 1.5 7.25V5Z" fill="#F7941C"></path></svg></div></div>
<!-- /wp:outermost/icon-block -->

<!-- wp:paragraph -->
<p><a href="tel:+6492709440">NZ (09) 270 9440</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|spacing-10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"","label":"Call AU","width":24} -->
<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:24px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" aria-label="Call AU"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.5 5C1.5 3.34315 2.84315 2 4.5 2H5.87163C6.732 2 7.48197 2.58556 7.69064 3.42025L8.79644 7.84343C8.97941 8.5753 8.70594 9.34555 8.10242 9.79818L6.8088 10.7684C6.67447 10.8691 6.64527 11.0167 6.683 11.1197C7.81851 14.2195 10.2805 16.6815 13.3803 17.817C13.4833 17.8547 13.6309 17.8255 13.7316 17.6912L14.7018 16.3976C15.1545 15.7941 15.9247 15.5206 16.6566 15.7036L21.0798 16.8094C21.9144 17.018 22.5 17.768 22.5 18.6284V20C22.5 21.6569 21.1569 23 19.5 23H17.25C8.55151 23 1.5 15.9485 1.5 7.25V5Z" fill="#F7941C"></path></svg></div></div>
<!-- /wp:outermost/icon-block -->

<!-- wp:paragraph -->
<p><a href="tel:+61370478440">AU (03) 7047 8440</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"layout":{"selfStretch":"fixed","flexSize":""}},"layout":{"type":"flex","orientation":"horizontal"}} -->
<div class="wp-block-buttons"><!-- wp:button {"width":100,"className":"is-style-button-top-header cta-button-hover"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-button-top-header cta-button-hover"><a class="wp-block-button__link wp-element-button">Enquire Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Main Header"},"align":"wide","className":"is-style-section-main-header","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"stretch","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide is-style-section-main-header" style="padding-top:0;padding-bottom:0"><!-- wp:group {"metadata":{"name":"Logo"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|spacing-30","bottom":"var:preset|spacing|spacing-30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--spacing-30);padding-bottom:var(--wp--preset--spacing--spacing-30)"><!-- wp:site-logo {"width":180,"shouldSyncIcon":false} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"ref":4,"openSubmenusOnClick":true,"metadata":{"name":"Primary Navigation"},"className":"is-style-nav-hover","style":{"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"flex","justifyContent":"center"}} /-->

<!-- wp:group {"metadata":{"name":"Search"},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search","widthUnit":"px","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true,"className":"is-style-header-search"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->