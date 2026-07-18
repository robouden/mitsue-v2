<?php
/**
 * BIOMASS ENERGY & AI — functions.php
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

if ( ! defined( 'MITSUE_VERSION' ) ) define( 'MITSUE_VERSION', '2.0.9' );
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

/* ── SEO: drop the users sitemap (avoids exposing WP usernames via /author/) ── */
add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}, 10, 2 );

/* ── SEO: title, meta description, Open Graph, canonical ───────────────── */
add_filter( 'document_title_parts', function ( $parts ) {
	if ( is_front_page() ) {
		$parts = [ 'title' => '御杖村バイオマスエネルギー＆AIプロジェクト | 奈良県御杖村' ];
	}
	return $parts;
} );

add_action( 'wp_head', function () {
	$is_home = is_front_page();
	$desc    = $is_home
		? '奈良県御杖村で進む地域主導のバイオマスエネルギー＆AIデータセンター構想。森林資源を活用し、再生可能エネルギーと地方創生を両立する25年計画。'
		: wp_strip_all_tags( get_the_excerpt() );
	$title   = $is_home ? '御杖村バイオマスエネルギー＆AIプロジェクト | 奈良県御杖村' : wp_get_document_title();
	$url     = $is_home ? home_url( '/' ) : get_permalink();
	$image   = MITSUE_URI . '/assets/images/mitsue04.jpg';

	echo "\n" . '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	echo '<meta property="og:locale" content="ja_JP">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";

	if ( $is_home ) {
		echo '<meta name="keywords" content="Rob Oudendijk, ロブ・アウデンダイク, Henry Seiichi Takata, 高田誠一, Ray Ozzie, レイ・オジー, Takuo Dome, 堂目卓生, Elvin Zoet, エルヴィン・ズート, Yoshiko Zoet-Susuki, 鈴木佳子, Joi Ito, 伊藤穰一, 御杖村, Mitsue Village, バイオマスエネルギー, biomass energy, AI data center, 奈良県">' . "\n";

		$json_ld = [
			'@context' => 'https://schema.org',
			'@type'    => 'Organization',
			'name'     => 'BIOMASS ENERGY & AI — Mitsue Village Project',
			'alternateName' => '御杖村バイオマスエネルギー＆AIプロジェクト',
			'url'      => home_url( '/' ),
			'member'   => [
				[
					'@type'    => 'Person',
					'name'     => 'Rob Oudendijk',
					'alternateName' => 'ロブ・アウデンダイク',
					'jobTitle' => 'Founder',
					'url'      => 'https://about.me/robouden',
				],
				[
					'@type'    => 'Person',
					'name'     => 'Henry Seiichi Takata',
					'alternateName' => '高田誠一',
					'jobTitle' => 'Advisory Board Member',
				],
				[
					'@type'    => 'Person',
					'name'     => 'Ray Ozzie',
					'alternateName' => 'レイ・オジー',
					'jobTitle' => 'Advisory Board Member',
					'url'      => 'https://en.wikipedia.org/wiki/Ray_Ozzie',
				],
				[
					'@type'    => 'Person',
					'name'     => 'Takuo Dome',
					'alternateName' => '堂目卓生',
					'jobTitle' => 'Advisory Board Member',
				],
				[
					'@type'    => 'Person',
					'name'     => 'Elvin Zoet',
					'alternateName' => 'エルヴィン・ズート',
					'jobTitle' => 'Advisory Board Member',
				],
				[
					'@type'    => 'Person',
					'name'     => 'Yoshiko Zoet-Susuki',
					'alternateName' => '鈴木佳子（ズート）',
					'jobTitle' => 'Advisory Board Member',
				],
			],
			'mentions' => [
				[
					'@type'    => 'Person',
					'name'     => 'Joi Ito',
					'alternateName' => '伊藤穰一',
					'description' => 'Referral / inspiration contact for outreach; not yet a formal advisor or partner.',
				],
			],
		];
		echo '<script type="application/ld+json">' . wp_json_encode( $json_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
	}
}, 2 );

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
