/**
 * Apply Ollie mega menu panel geometry at hydration instead of at window.load.
 *
 * Ollie Menu Designer ships no CSS width for `.menu-width-full` panels — view.js
 * measures the viewport and writes top/width/maxWidth/left as inline styles. It
 * runs that from `callbacks.initMenuLayout`, which defers to `window.load`:
 *
 *     initMenuLayout() {
 *       document.readyState === 'complete'
 *         ? actions.adjustMegaMenu()
 *         : window.addEventListener( 'load', withScope( () => actions.adjustMegaMenu() ), { once: true } );
 *     }
 *
 * `load` waits on every image, iframe and script on the page. Measured on the
 * production home page at 1440px, the panels were still unsized 2.7s after
 * DOMContentLoaded — an absolutely positioned box with width:auto, shrink-wrapped
 * to a ~460-710px column at the wrong offset. Hover a nav item inside that window
 * and that is what you get. Locally `load` fires almost immediately, which is why
 * it only ever showed up on live.
 *
 * The plugin re-runs the same measurement from its own resize handler
 * (`data-wp-on-window--resize="actions.handleResize"` on each mega menu <li>), so
 * dispatching `resize` once the Interactivity store has hydrated applies the
 * plugin's own geometry, on the plugin's own code path, seconds earlier — no
 * forking or patching of the plugin's script module.
 *
 * Two things make this less trivial than it sounds:
 *
 * 1. Hydration has no public "ready" signal, so phase one polls briefly and
 *    dispatches only while a full-width panel is still missing its inline width.
 *    In practice hydration lands within a tick or two.
 *
 * 2. `adjustMegaMenu()` is measure-and-negate: it reads the panel's current rect
 *    and sets `left = -rect.left`, which is only correct if `left` is still at its
 *    stylesheet value. `handleResize()` is safe because it calls
 *    `resetMenuPositionStyles()` first, but the `load` handler calls
 *    `adjustMegaMenu()` bare. So once we have positioned the panels early, the
 *    plugin's own load handler re-measures an already-corrected panel and pushes
 *    it back off by its own offset. Phase two runs after that handler and restores
 *    the correct geometry via the reset-first path.
 *
 * Both phases go through `handleResize()`, which is idempotent, so the worst case
 * is redundant work rather than a wrong position. If this script never runs at all
 * the panels still get sane width and vertical placement from the stylesheet — see
 * "Mega Menu: Full-width panel geometry before JS initialises" in style.css.
 *
 * @package asnz-block-theme
 */

(function () {
	'use strict';

	var SELECTOR = '.wp-block-ollie-mega-menu__menu-container.menu-width-full';
	var INTERVAL_MS = 100;
	var MAX_ATTEMPTS = 8;

	var panels = document.querySelectorAll( SELECTOR );

	if ( ! panels.length ) {
		return;
	}

	/**
	 * Trigger the plugin's reset-then-measure path on every mega menu.
	 */
	function reflow() {
		window.dispatchEvent( new Event( 'resize' ) );
	}

	/**
	 * Whether view.js has written its inline width to every full-width panel.
	 *
	 * @return {boolean} True once all panels have been measured and sized.
	 */
	function isSized() {
		for ( var i = 0; i < panels.length; i++ ) {
			if ( ! panels[ i ].style.width ) {
				return false;
			}
		}

		return true;
	}

	// Phase one: nudge until the store has hydrated and the panels are sized.
	var attempts = 0;

	function nudgeUntilSized() {
		// Either the plugin has sized them, or `load` has fired and its own
		// handler has already done the work. Nothing left to do here.
		if ( isSized() || 'complete' === document.readyState ) {
			return;
		}

		if ( ++attempts > MAX_ATTEMPTS ) {
			return;
		}

		reflow();
		window.setTimeout( nudgeUntilSized, INTERVAL_MS );
	}

	if ( 'complete' !== document.readyState ) {
		window.setTimeout( nudgeUntilSized, 0 );

		// Phase two: the plugin's `load` handler runs a reset-less adjust that
		// undoes phase one. setTimeout(0) from a load listener lands after every
		// load handler, whatever order they registered in.
		window.addEventListener(
			'load',
			function () {
				window.setTimeout( reflow, 0 );
			},
			{ once: true }
		);
	}
})();
