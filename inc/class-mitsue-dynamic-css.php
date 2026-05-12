<?php
/**
 * Mitsue_Dynamic_CSS
 *
 * Generates a :root{} override block from Customizer values.
 * Inspired by Astra's class-astra-dynamic-css.php approach:
 *  - define pairs of (css-var => [theme_mod_key, default_value])
 *  - only output vars that differ from the default
 *  - singleton so it's only computed once per request
 *
 * @package Mitsue
 */

if ( ! class_exists( 'Mitsue_Dynamic_CSS' ) ) {

	class Mitsue_Dynamic_CSS {

		private static ?Mitsue_Dynamic_CSS $instance = null;

		public static function get_instance(): self {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		private function __construct() {}

		/**
		 * CSS-var → [ theme_mod_key, default_value ] map.
		 * Extend this array to add more design-token overrides.
		 */
		private function token_map(): array {
			return [
				'--bg'         => [ 'mitsue_color_bg',        '#f5f1ea' ],
				'--bg-2'       => [ 'mitsue_color_bg_2',      '#efeae0' ],
				'--ink'        => [ 'mitsue_color_ink',       '#1c1c1a' ],
				'--ink-soft'   => [ 'mitsue_color_ink_soft',  '#3a3a36' ],
				'--ink-mute'   => [ 'mitsue_color_ink_mute',  '#6c6a62' ],
				'--rule'       => [ 'mitsue_color_rule',      '#d8d2c5' ],
				'--paper'      => [ 'mitsue_color_paper',     '#fbf8f1' ],
				// These accept any CSS value (oklch, hsl, hex, …)
				'--accent'     => [ 'mitsue_color_accent',    'oklch(0.42 0.05 150)' ],
				'--accent-deep'=> [ 'mitsue_color_accent_deep','oklch(0.30 0.04 150)' ],
				'--clay'       => [ 'mitsue_color_clay',      'oklch(0.58 0.08 60)' ],
			];
		}

		/**
		 * Build and return the CSS string (empty if nothing changed).
		 */
		public function generate(): string {
			$lines = [];

			foreach ( $this->token_map() as $var => [ $mod_key, $default ] ) {
				$val = get_theme_mod( $mod_key, $default );
				if ( $val !== $default ) {
					// Sanitize: strip tags but allow CSS function syntax (oklch, hsl…)
					$safe = wp_strip_all_tags( $val );
					$lines[] = sprintf( '  %s: %s;', esc_attr( $var ), $safe );
				}
			}

			if ( empty( $lines ) ) return '';
			return ':root {' . "\n" . implode( "\n", $lines ) . "\n}";
		}
	}
}
