<?php
/**
 * Theme bootstrap for the ASNZ Block Theme.
 *
 * Rebranded from the original Ollie theme; all pattern category slugs, text domains,
 * and metadata have been updated to use the `asnz` namespace.
 *
 * @package asnz-block-theme
 * @author  Lightspeed WP
 * @license GNU General Public License v2 or later
 * @link    https://lightspeedwp.agency
 */

namespace ASNZ;

/**
 * Set up theme defaults and register various WordPress features.
 */
function setup() {

	// Enqueue editor styles and fonts.
	add_editor_style( 'style.css' );

	// Remove core block patterns.
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\setup' );


/**
 * Enqueue styles.
 */
function enqueue_style_sheet() {
	wp_enqueue_style( sanitize_title( __NAMESPACE__ ), get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_style_sheet' );

/**
 * Register custom button styles: CTA (large primary) and Card (compact full-width)
 */
function register_button_styles() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style( 'core/button', array(
			'name'  => 'cta',
			'label' => __( 'CTA', 'asnz-block-theme' ),
		) );
		register_block_style( 'core/button', array(
			'name'  => 'card',
			'label' => __( 'Card', 'asnz-block-theme' ),
		) );
	}
}
add_action( 'init', __NAMESPACE__ . '\register_button_styles' );


/**
 * Enqueue WooCommerce specific stylesheet
 */
function enqueue_woocommerce_styles() {

	// Only enqueue if WooCommerce is active
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style(
			'theme-woocommerce-style',
			get_template_directory_uri() . '/assets/styles/woocommerce.css',
			array(),
			'1.0.0'
		);
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_woocommerce_styles' );


/**
 * Register pattern categories.
 */
function pattern_categories() {

	$block_pattern_categories = array(
		'asnz/card'           => array(
			'label' => __( 'Cards', 'asnz-block-theme' ),
		),
		'asnz/call-to-action' => array(
			'label' => __( 'Call To Action', 'asnz-block-theme' ),
		),
		'asnz/features'       => array(
			'label' => __( 'Features', 'asnz-block-theme' ),
		),
		'asnz/hero'           => array(
			'label' => __( 'Hero', 'asnz-block-theme' ),
		),
		'asnz/pages'          => array(
			'label' => __( 'Pages', 'asnz-block-theme' ),
		),
		'asnz/posts'          => array(
			'label' => __( 'Posts', 'asnz-block-theme' ),
		),
		'asnz/pricing'        => array(
			'label' => __( 'Pricing', 'asnz-block-theme' ),
		),
		'asnz/testimonial'    => array(
			'label' => __( 'Testimonials', 'asnz-block-theme' ),
		),
		'asnz/menu'    => array(
			'label' => __( 'Menu', 'asnz-block-theme' ),
		)
	);

	foreach ( $block_pattern_categories as $name => $properties ) {
		register_block_pattern_category( $name, $properties );
	}
}
add_action( 'init', __NAMESPACE__ . '\pattern_categories', 9 );


/**
 * Remove last separator on blog/archive if no pagination exists.
 */
function is_paginated() {
	global $wp_query;
	if ( $wp_query->max_num_pages < 2 ) {
		echo '<style>.blog .wp-block-post-template .wp-block-post:last-child .entry-content + .wp-block-separator, .archive .wp-block-post-template .wp-block-post:last-child .entry-content + .wp-block-separator, .blog .wp-block-post-template .wp-block-post:last-child .entry-content + .wp-block-separator, .search .wp-block-post-template .wp-block-post:last-child .wp-block-post-excerpt + .wp-block-separator { display: none; }</style>';
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\is_paginated' );


/**
 * Add a Sidebar template part area
 */
function template_part_areas( array $areas ) {
	$areas[] = array(
		'area'        => 'sidebar',
		'area_tag'    => 'section',
		'label'       => __( 'Sidebar', 'asnz-block-theme' ),
		'description' => __( 'The Sidebar template defines a page area that can be found on the Page (With Sidebar) template.', 'asnz-block-theme' ),
		'icon'        => 'sidebar',
	);

	return $areas;
}
add_filter( 'default_wp_template_part_areas', __NAMESPACE__ . '\template_part_areas' );


/**
 * Late override of Tour Operator plugin patterns using the theme's inline pattern files.
 *
 * Strategy (Option A):
 * 1. Allow core + plugin to register their patterns normally (priority 10).
 * 2. At very late priority (999) unregister plugin versions for selected slugs.
 * 3. Re-register using the theme's pattern file markup (inline docblock + HTML) without executing the file (avoids accidental output).
 *
 * This preserves the clean inline editing authoring style while ensuring our markup wins.
 */
function override_plugin_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return; // Older WP guard.
	}

	// Ensure the category exists even if the plugin is disabled.
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category( 'lsx-tour-operator', array( 'label' => __( 'Tour Operator', 'tour-operator' ) ) );
	}

	$slugs = array(
		'tour-card',
		'accommodation-card',
		'destination-card',
		'room-card',
		'itinerary-list',
		'travel-information',
	);

	$registry = \WP_Block_Patterns_Registry::get_instance();

	foreach ( $slugs as $short ) {
		$full_slug = 'lsx-tour-operator/' . $short;
		$file      = get_template_directory() . '/patterns/' . $short . '.php';
		if ( ! file_exists( $file ) ) {
			continue; // Theme does not supply an override file.
		}

		// If a pattern with this slug is already registered (plugin or core), unregister it so ours replaces it.
		if ( method_exists( $registry, 'is_registered' ) && $registry->is_registered( $full_slug ) && function_exists( 'unregister_block_pattern' ) ) {
			unregister_block_pattern( $full_slug );
		}

		$raw = file_get_contents( $file );
		if ( false === $raw ) {
			continue; // Read failure safeguard.
		}

		// Extract first docblock for meta (optional / best-effort).
		$title       = null;
		$description = null;
		$viewport    = null;

		if ( preg_match( '/\/\*\*(.*?)\*\//s', $raw, $m ) ) {
			$header = $m[1];
			if ( preg_match( '/^\s*\*\s*Title:\s*(.+)$/mi', $header, $mm ) ) {
				$title = trim( $mm[1] );
			}
			if ( preg_match( '/^\s*\*\s*Description:\s*(.+)$/mi', $header, $mm ) ) {
				$description = trim( $mm[1] );
			}
			if ( preg_match( '/^\s*\*\s*Viewport Width:\s*(.+)$/mi', $header, $mm ) ) {
				$viewport = (int) preg_replace( '/[^0-9]/', '', $mm[1] );
			}
		}

		// Remove PHP opening/closing and docblock to isolate pure block markup.
		$content = $raw;
		// Strip leading php open tag + docblock + closing tag pattern.
		$content = preg_replace( '/^<\?php\s*\/\*\*.*?\*\/\s*\?>/s', '', $content, 1 );
		$content = trim( $content );

		// Safety: If still contains a starting PHP tag (e.g., duplicate headers), remove them iteratively.
		while ( preg_match( '/^<\?php/', $content ) && preg_match( '/^<\?php\s*\/\*\*.*?\*\/\s*\?>/s', $content ) ) {
			$content = preg_replace( '/^<\?php\s*\/\*\*.*?\*\/\s*\?>/s', '', $content, 1 );
			$content = trim( $content );
		}

		// Fallback title / description if not parsed.
		if ( ! $title ) {
			$title = ucwords( str_replace( '-', ' ', $short ) );
		}
		if ( ! $description ) {
			$description = $title;
		}

		$args = array(
			'title'       => esc_html__( $title, 'tour-operator' ),
			'description' => esc_html__( $description, 'tour-operator' ),
			'categories'  => array( 'lsx-tour-operator' ),
			'content'     => $content,
			'inserter'    => true,
		);
		if ( $viewport ) {
			$args['viewportWidth'] = $viewport;
		}

		register_block_pattern( $full_slug, $args );
	}
}
add_action( 'init', __NAMESPACE__ . '\override_plugin_patterns', 999 );





