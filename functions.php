<?php
/**
 * Mitsue Project — functions.php
 *
 * Architecture (inspired by Astra):
 *  • All settings live in ONE option array: get_option('mitsue_options').
 *  • mitsue_get() / mitsue_rows() read from that array with built-in defaults.
 *  • Customizer controls live in inc/customizer/ config classes.
 *  • Dynamic CSS is generated from option values by Mitsue_Dynamic_CSS.
 *  • Content settings live in Settings → Mitsue Content (inc/admin-page.php).
 *
 * @package Mitsue
 */

if ( ! defined( 'MITSUE_VERSION' ) ) define( 'MITSUE_VERSION', '2.0.0' );
if ( ! defined( 'MITSUE_DIR' ) )     define( 'MITSUE_DIR', get_stylesheet_directory() );
if ( ! defined( 'MITSUE_URI' ) )     define( 'MITSUE_URI', get_stylesheet_directory_uri() );

/* ── Theme supports ─────────────────────────────────────────────────────── */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'style', 'script', 'caption', 'comment-list', 'comment-form', 'gallery', 'search-form' ] );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	register_nav_menus( [
		'primary' => __( 'Primary navigation', 'mitsue' ),
		'footer'  => __( 'Footer navigation', 'mitsue' ),
	] );
} );

/* ── Enqueue front-end assets ───────────────────────────────────────────── */
/* JP fonts with font-display:optional — loads without blocking, no swap = no CLS */
add_action( 'wp_head', function () {
	// display=optional: browser uses font only if cached/fast; no swap, no layout shift
	$jp_url = 'https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;500;600&family=Noto+Sans+JP:wght@300;400;500;600&display=optional';
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="stylesheet" href="' . esc_url( $jp_url ) . '" media="print" onload="this.media=\'all\'">' . "\n";
	echo '<noscript><link rel="stylesheet" href="' . esc_url( $jp_url ) . '"></noscript>' . "\n";
	// Preload the two most-visible Latin fonts (Cormorant regular + IBM Plex Sans regular)
	echo '<link rel="preload" as="font" type="font/woff2" crossorigin href="' . esc_url( get_stylesheet_directory_uri() . '/assets/fonts/co3bmX5slCNuHLi8bLeY9MK7whWMhyjYqXtK.woff2' ) . '">' . "\n";
	echo '<link rel="preload" as="font" type="font/woff2" crossorigin href="' . esc_url( get_stylesheet_directory_uri() . '/assets/fonts/zYXzKVElMYYaJe8bpLHnCwDKr932-G7dytD-Dmu1syxeKYY.woff2' ) . '">' . "\n";
}, 1 );

add_action( 'wp_enqueue_scripts', function () {
	// Latin fonts self-hosted — no external request, no render block
	wp_enqueue_style(
		'mitsue-fonts',
		MITSUE_URI . '/assets/fonts/latin-fonts.css',
		[], MITSUE_VERSION
	);
	wp_enqueue_style( 'mitsue', get_stylesheet_uri(), [ 'mitsue-fonts' ], MITSUE_VERSION );

	// Dynamic CSS overrides from Customizer (colours, etc.).
	$dynamic = Mitsue_Dynamic_CSS::get_instance()->generate();
	if ( $dynamic ) {
		wp_add_inline_style( 'mitsue', $dynamic );
	}
	wp_enqueue_script( 'mitsue-lightbox', MITSUE_URI . '/assets/lightbox.js', [], MITSUE_VERSION, true );
	wp_enqueue_script( 'mitsue-nav', MITSUE_URI . '/assets/nav.js', [], MITSUE_VERSION, true );
} );

/* ── Options helper ─────────────────────────────────────────────────────── */

/**
 * Central option store — everything in one WP option.
 * Returns the full array, or a single key when $key is given.
 */
function mitsue_options( string $key = '' ) {
	static $opts = null;
	if ( $opts === null ) {
		$opts = (array) get_option( 'mitsue_options', [] );
	}
	if ( $key === '' ) return $opts;
	return $opts[ $key ] ?? null;
}

/**
 * Get a scalar option value, with fallback default.
 */
function mitsue_get( string $key, string $default = '' ): string {
	$val = mitsue_options( $key );
	return ( $val !== null && $val !== '' ) ? (string) $val : $default;
}

/**
 * Get a repeater (returns array of row arrays), with fallback defaults.
 * Stored as a JSON string under the same key.
 */
function mitsue_rows( string $key, array $defaults = [] ): array {
	$raw = mitsue_options( $key );
	if ( is_string( $raw ) && $raw !== '' ) {
		$decoded = json_decode( $raw, true );
		if ( is_array( $decoded ) && count( $decoded ) ) return $decoded;
	}
	return $defaults;
}

/* ── Load inc files ─────────────────────────────────────────────────────── */
require_once MITSUE_DIR . '/inc/class-mitsue-dynamic-css.php';
require_once MITSUE_DIR . '/inc/class-mitsue-customizer.php';

if ( is_admin() ) {
	require_once MITSUE_DIR . '/inc/class-mitsue-admin-page.php';
}
