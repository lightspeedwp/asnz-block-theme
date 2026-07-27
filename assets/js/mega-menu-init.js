/**
 * Make Ollie mega menus measure themselves at hydration instead of at window.load.
 *
 * Ollie Menu Designer ships no CSS width for `.menu-width-full` panels — view.js
 * measures the viewport and writes the geometry inline, but defers that to the
 * `window.load` event. On production `load` trails hydration by ~2.7s (images, a
 * YouTube embed, GTM, Chaty, Popup Maker, Font Awesome from a third-party CDN), and
 * a panel hovered in between opens as a shrink-wrapped column instead of a
 * full-width bar. Locally `load` fires immediately, which is why it only showed on
 * live. The plugin re-runs the same measurement from its own resize handler, so a
 * single dispatched `resize` gets the correct geometry via the plugin's own path.
 *
 * Three things are load-bearing here — please don't simplify them away:
 *
 * 1. Fire once, at hydration. `handleResize()` calls `clearHoverTimeout()`, so a
 *    resize landing inside the plugin's 150ms hover-open delay silently cancels the
 *    open. Hydration is the one safe moment: the handler that would start a hover
 *    did not exist a tick earlier. `aria-expanded` is absent from the served markup
 *    and bound via data-wp-bind, so its arrival marks that point.
 *
 * 2. Clear the inline geometry on `load`. `adjustMegaMenu()` sets
 *    `left = -rect.left`, which is only right while `left` is at its stylesheet
 *    value. The plugin's load handler calls it without the reset its resize handler
 *    does, so it would re-measure the panel we already corrected and push it back
 *    off by its own offset. This listener is registered before hydration, hence
 *    before the plugin's, so the plugin re-measures a clean panel.
 *
 * 3. Keep the backstop. If that ordering ever fails, it repairs the geometry after
 *    all load handlers have run. It only fires when the offset is actually wrong.
 *
 * @package asnz-block-theme
 */

(function () {
	'use strict';

	var panels = document.querySelectorAll(
		'.wp-block-ollie-mega-menu__menu-container.menu-width-full'
	);
	var toggles = document.querySelectorAll( '.wp-block-ollie-mega-menu__toggle' );

	// Nothing to bring forward if there are no full-width panels, or if the plugin
	// already measured inline because the document was complete.
	if ( ! panels.length || ! toggles.length || 'complete' === document.readyState ) {
		return;
	}

	function reflow() {
		window.dispatchEvent( new Event( 'resize' ) );
	}

	var pendingHydrations = toggles.length;

	function markHydrated() {
		pendingHydrations--;
		if ( 0 === pendingHydrations ) {
			reflow();
		}
	}

	for ( var i = 0; i < toggles.length; i++ ) {
		if ( toggles[ i ].hasAttribute( 'aria-expanded' ) ) {
			markHydrated();
			continue;
		}

		new window.MutationObserver( function ( mutations, observer ) {
			observer.disconnect();
			markHydrated();
		} ).observe( toggles[ i ], {
			attributes: true,
			attributeFilter: [ 'aria-expanded' ],
		} );
	}

	window.addEventListener(
		'load',
		function () {
			var i;

			for ( i = 0; i < panels.length; i++ ) {
				panels[ i ].style.left = '';
				panels[ i ].style.width = '';
				panels[ i ].style.maxWidth = '';
			}

			window.setTimeout( function () {
				for ( i = 0; i < panels.length; i++ ) {
					// An empty offset, or the `0px` that measure-and-negate
					// produces when it re-reads an already-corrected panel.
					if ( ! panels[ i ].style.left || '0px' === panels[ i ].style.left ) {
						reflow();
						return;
					}
				}
			}, 0 );
		},
		{ once: true }
	);
})();
