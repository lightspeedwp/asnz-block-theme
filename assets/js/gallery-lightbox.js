/**
 * Thumbnail strip for the Tour Operator gallery lightbox.
 *
 * Tour Operator already opens a lightbox for the TO gallery: its custom.js binds
 * slick-lightbox to `.wp-block-gallery.has-nested-images` on window.load, and our
 * templates link each image to the media file so there is an <a> for it to catch.
 * The two parts of the Envira lightbox it has no equivalent for are added here:
 * the thumbnail strip along the bottom, and the arrows and close button sitting
 * just inside the image's own edges. Everything else — backdrop, caption,
 * keyboard nav, Escape, backdrop click — is slick-lightbox plus the
 * `.slick-lightbox` rules in style.css.
 *
 * The chrome needs JavaScript because slick's arrows are siblings of the slide
 * track: nothing in CSS can see the image box, and it changes with every
 * slide's aspect ratio.
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

	/**
	 * The box that a positioned child of `el` measures its insets against.
	 *
	 * Both the arrows and the close button are absolutely positioned, but they sit
	 * in different parents inside the modal, and Tour Operator gives at least one
	 * of them `position: relative` — so neither can be assumed to resolve against
	 * the viewport. Insets resolve against the containing block's padding box,
	 * hence discounting the border.
	 *
	 * @param {HTMLElement} el The positioned element.
	 * @return {{left: number, right: number, top: number}} Viewport-relative edges.
	 */
	function chromeOrigin(el) {
		var parent = el.offsetParent;

		if (!parent || parent === document.body || parent === document.documentElement) {
			return { left: 0, right: window.innerWidth, top: 0 };
		}

		var rect = parent.getBoundingClientRect();
		var style = window.getComputedStyle(parent);

		return {
			left: rect.left + (parseFloat(style.borderLeftWidth) || 0),
			right: rect.right - (parseFloat(style.borderRightWidth) || 0),
			top: rect.top + (parseFloat(style.borderTopWidth) || 0)
		};
	}

	/**
	 * Pull the arrows and close button in to the active image's edges.
	 *
	 * @param {HTMLElement} modal The `.slick-lightbox` element.
	 */
	function positionChrome(modal) {
		var slide = modal.querySelector('.slick-slide.slick-active');
		var image = slide && slide.querySelector('.slick-lightbox-slick-img');

		if (!image) {
			return;
		}

		var box = image.getBoundingClientRect();

		// Zero while the photo is still loading; a later call will catch it.
		if (!box.width || !box.height) {
			return;
		}

		var inset =
			parseFloat(
				window.getComputedStyle(modal).getPropertyValue('--to-lb-chrome-inset')
			) || 10;

		var prev = modal.querySelector('.slick-prev');
		var next = modal.querySelector('.slick-next');
		var close = modal.querySelector('.slick-lightbox-close');
		var origin;

		/*
		 * The arrows also need their vertical position from the image. Their `top:
		 * 50%` resolves against the slide track, which is the full viewport, but
		 * the image is centred inside the slide's padding box — and that padding is
		 * deliberately lopsided to leave room for the thumbnail strip, so the two
		 * centres are tens of pixels apart. `translateY(-50%)` still does the
		 * centring; this just moves the point it centres on.
		 */
		if (prev) {
			origin = chromeOrigin(prev);
			prev.style.left = box.left - origin.left + inset + 'px';
			prev.style.top = box.top - origin.top + box.height / 2 + 'px';
		}

		if (next) {
			origin = chromeOrigin(next);
			next.style.right = origin.right - box.right + inset + 'px';
			next.style.top = box.top - origin.top + box.height / 2 + 'px';
		}

		if (close) {
			origin = chromeOrigin(close);
			close.style.top = box.top - origin.top + inset + 'px';
			close.style.right = origin.right - box.right + inset + 'px';
		}
	}

	/**
	 * Keep the chrome on the image for as long as the modal is open.
	 *
	 * @param {HTMLElement} modal The `.slick-lightbox` element.
	 */
	function trackChrome(modal) {
		var $ = window.jQuery;
		var slider = modal.querySelector('.slick-lightbox-slick');
		var observer = null;

		var reposition = function () {
			// slick-lightbox drops the modal on close; stop listening with it.
			if (!modal.isConnected) {
				window.removeEventListener('resize', reposition);

				if (observer) {
					observer.disconnect();
				}

				return;
			}

			positionChrome(modal);
		};

		if ($ && slider) {
			$(slider).on('afterChange setPosition', reposition);
		}

		window.addEventListener('resize', reposition);

		/*
		 * The photos are usually still loading when the modal opens, so the box we
		 * need is not final yet. Watching the images covers that and any later
		 * reflow, without polling.
		 */
		if (window.ResizeObserver) {
			observer = new window.ResizeObserver(reposition);
			Array.prototype.forEach.call(
				modal.querySelectorAll('.slick-lightbox-slick-img'),
				function (image) {
					observer.observe(image);
				}
			);
		}

		reposition();
	}

	// slick-lightbox creates its modal on demand, so wait for it to be inserted.
	new MutationObserver(function (mutations) {
		mutations.forEach(function (mutation) {
			Array.prototype.forEach.call(mutation.addedNodes, function (node) {
				if (node.nodeType !== 1 || !node.classList.contains('slick-lightbox')) {
					return;
				}

				// Also wanted on the unit-image galleries, which get no strip.
				trackChrome(node);

				if (openedFrom) {
					addThumbs(node, openedFrom);
				}
			});
		});
	}).observe(document.body, { childList: true });
})();
