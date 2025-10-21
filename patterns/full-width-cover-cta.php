<?php
/**
 * Title: Full Width Cover CTA
 * Slug: asnz/full-width-cover-cta
 * Description: Full width cover image with right-aligned call to action panel using section style full-width-cta and button-cta.
 * Categories: banner, featured, text
 * Keywords: cover, hero, cta, banner, enquiry, adventure
 * Viewport Width: 1500
 * Block Types: core/post-content
 * Inserter: true
 * Sync: true
 * Provides: full-width-cta, hero-cta, cover-cta
 * Version: 1.0.0
 * Author: Lightspeed
 * License: GPL-2.0-or-later
 * Text Domain: asnz-block-theme
 * Notes: Image URL intentionally blank so user can supply appropriate hero image. Overlay color matches design token intent (custom for now).
 */
?>
<!-- wp:cover {"url":"","id":0,"dimRatio":0,"customOverlayColor":"#b98001","isUserOverlayColor":false,"isDark":false,"sizeSlug":"large","metadata":{"name":"Full Width CTA","categories":["banner","featured","text"],"patternName":"asnz/full-width-cover-cta"},"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-light">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#b98001"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:group {"align":"wide","layout":{"type":"constrained","justifyContent":"right"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:group {"className":"is-style-section-full-width-cta","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-section-full-width-cta">
				<!-- wp:heading -->
				<h2 class="wp-block-heading">Ready to plan your next adventure?</h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p>Our website shows only a small, handpicked selection of itineraries. With 30+ years experience and trusted African connections, our Africa experts can connect you to a full range of tours and safaris not listed on the website, including small-group and tailor-made options. Speak to an expert to explore more.</p>
				<!-- /wp:paragraph -->

				<!-- wp:columns -->
				<div class="wp-block-columns">
					<!-- wp:column -->
					<div class="wp-block-column">
						<!-- wp:buttons -->
						<div class="wp-block-buttons">
							<!-- wp:button {"width":100,"className":"is-style-button-cta cta-button-hover"} -->
							<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-button-cta cta-button-hover"><a class="wp-block-button__link wp-element-button">Talk to an expert</a></div>
							<!-- /wp:button -->
						</div>
						<!-- /wp:buttons -->
					</div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"></div>
					<!-- /wp:column -->
				</div>
				<!-- /wp:columns -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
