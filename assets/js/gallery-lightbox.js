/**
 * Thumbnail strip for the Tour Operator gallery lightbox.
 *
 * Tour Operator already opens a lightbox for the TO gallery: its custom.js binds
 * slick-lightbox to `.wp-block-gallery.has-nested-images` on window.load, and our
 * templates link each image to the media file so there is an <a> for it to catch.
 * The one part of the Envira lightbox it has no equivalent for is the thumbnail
 * strip along the bottom, which this adds. Everything else — backdrop, arrows,
 * caption, keyboard nav, Escape, backdrop click — is slick-lightbox plus the
 * `.slick-lightbox` rules in style.css.
 *
 * slick-lightbox appends its modal to <body> with no reference back to the gallery
 * that opened it, so we note the gallery on the way in (capture phase, before
 * slick-lightbox's own delegated handler) and watch for the modal being inserted.
 *
 * @package asnz-block-theme
 */

(function () {
	'use strict';

	var GALLERY = '.wp-block-gallery.has-nested-images';
	var STRIP_CLASS = 'to-lightbox-thumbs';

	/** @type {HTMLElement|null} The gallery whose image was clicked most recently. */
	var openedFrom = null;

	/**
	 * Remember which gallery is opening the lightbox.
	 *
	 * Capture phase so this runs before slick-lightbox's delegated click handler
	 * builds the modal, which is what the MutationObserver below reacts to.
	 */
	document.addEventListener(
		'click',
		function (event) {
			var link = event.target.closest ? event.target.closest(GALLERY + ' a') : null;
			if (link) {
				openedFrom = link.closest(GALLERY);
			}
		},
		true
	);

	/**
	 * Collect the image sources for the strip, in gallery order.
	 *
	 * @param {HTMLElement} gallery The gallery the lightbox was opened from.
	 * @return {Array<{src: string, alt: string}>} One entry per linked image.
	 */
	function collectThumbs(gallery) {
		return Array.prototype.map.call(
			gallery.querySelectorAll('a img'),
			function (img) {
				return { src: img.currentSrc || img.src, alt: img.getAttribute('alt') || '' };
			}
		);
	}

	/**
	 * Build the strip and keep it in step with the lightbox's slick instance.
	 *
	 * @param {HTMLElement} modal   The `.slick-lightbox` element.
	 * @param {HTMLElement} gallery The gallery the lightbox was opened from.
	 */
	function addThumbs(modal, gallery) {
		var $ = window.jQuery;
		var slider = modal.querySelector('.slick-lightbox-slick');

		if (!$ || !slider || modal.querySelector('.' + STRIP_CLASS)) {
			return;
		}

		var thumbs = collectThumbs(gallery);

		// A strip of one is just noise, and slick hides its arrows in that case too.
		if (thumbs.length < 2) {
			return;
		}

		var strip = document.createElement('div');
		strip.className = STRIP_CLASS;

		var list = document.createElement('ul');

		thumbs.forEach(function (thumb, index) {
			var item = document.createElement('li');
			var button = document.createElement('button');

			button.type = 'button';
			button.setAttribute(
				'aria-label',
				// translators: 1: image position, 2: total number of images.
				'Show image ' + (index + 1) + ' of ' + thumbs.length
			);

			var image = document.createElement('img');
			image.src = thumb.src;
			image.alt = '';
			image.loading = 'lazy';
			button.appendChild(image);

			button.addEventListener('click', function () {
				$(slider).slick('slickGoTo', index);
			});

			item.appendChild(button);
			list.appendChild(item);
		});

		strip.appendChild(list);
		modal.appendChild(strip);

		var items = list.children;

		/**
		 * Mark the current thumbnail and scroll it into view.
		 *
		 * @param {number} index Zero-based slide index.
		 */
		function setCurrent(index) {
			Array.prototype.forEach.call(items, function (item, i) {
				var button = item.firstChild;
				var isCurrent = i === index;

				item.classList.toggle('is-current', isCurrent);

				if (isCurrent) {
					button.setAttribute('aria-current', 'true');
					if (button.scrollIntoView) {
						button.scrollIntoView({ block: 'nearest', inline: 'nearest' });
					}
				} else {
					button.removeAttribute('aria-current');
				}
			});
		}

		$(slider).on('afterChange', function (event, slick, current) {
			setCurrent(current);
		});

		setCurrent($(slider).slick('slickCurrentSlide'));
	}

	// slick-lightbox creates its modal on demand, so wait for it to be inserted.
	new MutationObserver(function (mutations) {
		mutations.forEach(function (mutation) {
			Array.prototype.forEach.call(mutation.addedNodes, function (node) {
				if (
					node.nodeType === 1 &&
					node.classList.contains('slick-lightbox') &&
					openedFrom
				) {
					addThumbs(node, openedFrom);
				}
			});
		});
	}).observe(document.body, { childList: true });
})();
