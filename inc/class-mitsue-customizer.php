<?php
/**
 * Mitsue_Customizer
 *
 * Registers Customizer panels, sections, and controls using a config-array
 * pattern (same approach as Astra's class-astra-customizer.php).
 *
 * Controls are declared as plain arrays in get_config() and processed in
 * bulk by process_config(). Adding a new control means adding one array
 * entry — no imperative WP_Customize_Manager calls scattered around.
 *
 * @package Mitsue
 */

if ( ! class_exists( 'Mitsue_Customizer' ) ) {

	class Mitsue_Customizer {

		private static ?Mitsue_Customizer $instance = null;

		public static function get_instance(): self {
			if ( self::$instance === null ) {
				self::$instance = new self();
				self::$instance->init();
			}
			return self::$instance;
		}

		private function init(): void {
			add_action( 'customize_register', [ $this, 'register' ] );
		}

		/* ── Config declaration ─────────────────────────────────────────── */

		/**
		 * All panels, sections, settings and controls in one place.
		 *
		 * Supported types:
		 *   panel    → WP panel
		 *   section  → WP section (assign to panel with 'panel' key)
		 *   setting  → WP setting  (transport defaults to 'refresh')
		 *   control  → WP control  (control type in 'control' key, defaults to 'text')
		 *   color    → shorthand for setting + WP_Customize_Color_Control
		 */
		private function get_config(): array {
			return [

				/* ────────────────────────────────────────────────────── */
				/* Panel: Brand & Identity                                 */
				/* ────────────────────────────────────────────────────── */
				[
					'type'     => 'panel',
					'id'       => 'mitsue_panel_brand',
					'title'    => __( 'Mitsue — Brand & Identity', 'mitsue' ),
					'priority' => 30,
				],

				/* Section: Logo & Navigation */
				[
					'type'  => 'section',
					'id'    => 'mitsue_section_logo',
					'title' => __( 'Logo & Navigation', 'mitsue' ),
					'panel' => 'mitsue_panel_brand',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_logo_mark',
					'default' => '御',
					'sanitize'=> 'wp_kses_post',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_logo_mark',
					'section' => 'mitsue_section_logo',
					'label'   => __( 'Logo glyph (kanji character)', 'mitsue' ),
					'control' => 'text',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_logo_jp',
					'default' => '御杖プロジェクト',
					'sanitize'=> 'sanitize_text_field',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_logo_jp',
					'section' => 'mitsue_section_logo',
					'label'   => __( 'JP wordmark (below logo)', 'mitsue' ),
					'control' => 'text',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_nav_cta',
					'default' => 'For Investors',
					'sanitize'=> 'sanitize_text_field',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_nav_cta',
					'section' => 'mitsue_section_logo',
					'label'   => __( 'Nav CTA button label', 'mitsue' ),
					'control' => 'text',
				],

				/* Section: Utility Bar */
				[
					'type'  => 'section',
					'id'    => 'mitsue_section_utility',
					'title' => __( 'Utility Bar', 'mitsue' ),
					'panel' => 'mitsue_panel_brand',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_utility_phase',
					'default' => 'Phase 0 · Pre-Foundation',
					'sanitize'=> 'sanitize_text_field',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_utility_phase',
					'section' => 'mitsue_section_utility',
					'label'   => __( 'Phase / status text', 'mitsue' ),
					'control' => 'text',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_utility_location',
					'default' => 'Mitsue Village · Nara Prefecture · Japan',
					'sanitize'=> 'sanitize_text_field',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_utility_location',
					'section' => 'mitsue_section_utility',
					'label'   => __( 'Location text', 'mitsue' ),
					'control' => 'text',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_utility_horizon',
					'default' => '25-year horizon · est. April 2026',
					'sanitize'=> 'sanitize_text_field',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_utility_horizon',
					'section' => 'mitsue_section_utility',
					'label'   => __( 'Horizon / date text', 'mitsue' ),
					'control' => 'text',
				],

				/* Section: Footer */
				[
					'type'  => 'section',
					'id'    => 'mitsue_section_footer',
					'title' => __( 'Footer', 'mitsue' ),
					'panel' => 'mitsue_panel_brand',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_footer_tagline',
					'default' => 'A 25-year initiative for forest restoration, distributed renewable energy, and community-owned digital infrastructure in rural Japan.',
					'sanitize'=> 'sanitize_text_field',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_footer_tagline',
					'section' => 'mitsue_section_footer',
					'label'   => __( 'Tagline paragraph', 'mitsue' ),
					'control' => 'textarea',
				],

				/* ────────────────────────────────────────────────────── */
				/* Panel: Colours                                          */
				/* ────────────────────────────────────────────────────── */
				[
					'type'     => 'panel',
					'id'       => 'mitsue_panel_colours',
					'title'    => __( 'Mitsue — Colours', 'mitsue' ),
					'priority' => 31,
				],

				/* Section: Background & Text */
				[
					'type'  => 'section',
					'id'    => 'mitsue_section_colours_base',
					'title' => __( 'Background & Text', 'mitsue' ),
					'panel' => 'mitsue_panel_colours',
				],
				[
					'type'    => 'color',
					'id'      => 'mitsue_color_bg',
					'section' => 'mitsue_section_colours_base',
					'label'   => __( 'Page background', 'mitsue' ),
					'default' => '#f5f1ea',
				],
				[
					'type'    => 'color',
					'id'      => 'mitsue_color_bg_2',
					'section' => 'mitsue_section_colours_base',
					'label'   => __( 'Secondary background', 'mitsue' ),
					'default' => '#efeae0',
				],
				[
					'type'    => 'color',
					'id'      => 'mitsue_color_paper',
					'section' => 'mitsue_section_colours_base',
					'label'   => __( 'Panel / card background', 'mitsue' ),
					'default' => '#fbf8f1',
				],
				[
					'type'    => 'color',
					'id'      => 'mitsue_color_ink',
					'section' => 'mitsue_section_colours_base',
					'label'   => __( 'Primary text', 'mitsue' ),
					'default' => '#1c1c1a',
				],
				[
					'type'    => 'color',
					'id'      => 'mitsue_color_ink_soft',
					'section' => 'mitsue_section_colours_base',
					'label'   => __( 'Secondary text', 'mitsue' ),
					'default' => '#3a3a36',
				],
				[
					'type'    => 'color',
					'id'      => 'mitsue_color_ink_mute',
					'section' => 'mitsue_section_colours_base',
					'label'   => __( 'Muted / caption text', 'mitsue' ),
					'default' => '#6c6a62',
				],
				[
					'type'    => 'color',
					'id'      => 'mitsue_color_rule',
					'section' => 'mitsue_section_colours_base',
					'label'   => __( 'Borders & rules', 'mitsue' ),
					'default' => '#d8d2c5',
				],

				/* Section: Accent */
				[
					'type'  => 'section',
					'id'    => 'mitsue_section_colours_accent',
					'title' => __( 'Accent Colours', 'mitsue' ),
					'panel' => 'mitsue_panel_colours',
				],
				/* accent/clay use free-text so oklch / hsl values are accepted */
				[
					'type'    => 'setting',
					'id'      => 'mitsue_color_accent',
					'default' => 'oklch(0.42 0.05 150)',
					'sanitize'=> 'wp_strip_all_tags',
				],
				[
					'type'        => 'control',
					'id'          => 'mitsue_color_accent',
					'section'     => 'mitsue_section_colours_accent',
					'label'       => __( 'Forest / accent — any CSS colour value', 'mitsue' ),
					'description' => __( 'Supports oklch(), hsl(), hex, named colours.', 'mitsue' ),
					'control'     => 'text',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_color_accent_deep',
					'default' => 'oklch(0.30 0.04 150)',
					'sanitize'=> 'wp_strip_all_tags',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_color_accent_deep',
					'section' => 'mitsue_section_colours_accent',
					'label'   => __( 'Forest deep (italic headline tint)', 'mitsue' ),
					'control' => 'text',
				],
				[
					'type'    => 'setting',
					'id'      => 'mitsue_color_clay',
					'default' => 'oklch(0.58 0.08 60)',
					'sanitize'=> 'wp_strip_all_tags',
				],
				[
					'type'    => 'control',
					'id'      => 'mitsue_color_clay',
					'section' => 'mitsue_section_colours_accent',
					'label'   => __( 'Clay / secondary accent (CTA italic)', 'mitsue' ),
					'control' => 'text',
				],

			]; // end config
		}

		/* ── Process config & register with WP ──────────────────────── */

		public function register( WP_Customize_Manager $wp ): void {
			foreach ( $this->get_config() as $cfg ) {
				switch ( $cfg['type'] ) {

					case 'panel':
						$wp->add_panel( $cfg['id'], [
							'title'    => $cfg['title'],
							'priority' => $cfg['priority'] ?? 100,
						] );
						break;

					case 'section':
						$wp->add_section( $cfg['id'], [
							'title'    => $cfg['title'],
							'panel'    => $cfg['panel'] ?? '',
							'priority' => $cfg['priority'] ?? 100,
						] );
						break;

					case 'setting':
						$wp->add_setting( $cfg['id'], [
							'default'           => $cfg['default'] ?? '',
							'sanitize_callback' => $cfg['sanitize'] ?? 'sanitize_text_field',
							'transport'         => $cfg['transport'] ?? 'refresh',
						] );
						break;

					case 'control':
						$args = [
							'label'       => $cfg['label'] ?? '',
							'description' => $cfg['description'] ?? '',
							'section'     => $cfg['section'],
							'type'        => $cfg['control'] ?? 'text',
							'priority'    => $cfg['priority'] ?? 100,
						];
						$wp->add_control( $cfg['id'], $args );
						break;

					case 'color':
						// Colour controls: register setting + WP_Customize_Color_Control together.
						$wp->add_setting( $cfg['id'], [
							'default'           => $cfg['default'] ?? '#000000',
							'sanitize_callback' => 'sanitize_hex_color',
							'transport'         => $cfg['transport'] ?? 'refresh',
						] );
						$wp->add_control( new WP_Customize_Color_Control( $wp, $cfg['id'], [
							'label'    => $cfg['label'] ?? '',
							'section'  => $cfg['section'],
							'priority' => $cfg['priority'] ?? 100,
						] ) );
						break;
				}
			}
		}
	}

	Mitsue_Customizer::get_instance();
}
