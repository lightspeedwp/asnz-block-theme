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
 * Override / re-register Tour Operator plugin Tour Card pattern with extended meta.
 * The plugin registers its patterns on init priority 10; we run late so our version wins.
 */
function override_tour_card_pattern() {
	// Ensure pattern registration functions exist (WP 6.0+).
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$slug = 'lsx-tour-operator/tour-card';

	// If already registered (by plugin), remove it so we can replace.
	if ( function_exists( 'unregister_block_pattern' ) && \WP_Block_Patterns_Registry::get_instance()->is_registered( $slug ) ) {
		unregister_block_pattern( $slug );
	}

	$pattern_file = get_template_directory() . '/patterns/tour-card.php';
	$content = '';
	$title = 'Tour Card';
	$description = 'Tour Card';

	if ( file_exists( $pattern_file ) ) {
		$pattern_array = require $pattern_file;

		if ( is_array( $pattern_array ) ) {
			if ( isset( $pattern_array['content'] ) ) {
				$content = $pattern_array['content'];
			}
			if ( isset( $pattern_array['title'] ) ) {
				$title = $pattern_array['title'];
			}
			if ( isset( $pattern_array['description'] ) ) {
				$description = $pattern_array['description'];
			}
		}
	}

	register_block_pattern(
		$slug,
		array(
			'title'       => $title,
			'description' => $description,
			'categories'  => array( 'lsx-tour-operator' ),
			'content'     => $content,
			'inserter'    => true,
		)
	);
}
add_action( 'init', __NAMESPACE__ . '\override_tour_card_pattern', 99 );




