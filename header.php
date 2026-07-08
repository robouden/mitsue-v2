<?php /** @package Mitsue */ ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php wp_head(); ?>
<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/favicon.svg' ); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/favicon-32.png' ); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/favicon-16.png' ); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/favicon-180.png' ); ?>">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="disclaimer-banner" role="note">
  <div class="wrap">
    <span>&#9888;&nbsp; This is an independent community project and is <strong>not affiliated with, endorsed by, or operated by Mitsue Village Government (御杖村役場)</strong>.</span>
    <span class="jp">&#9888;&nbsp; 本サイトは民間の独立プロジェクトであり、<strong>御杖村役場とは一切関係ありません</strong>。</span>
  </div>
</div>

<div class="utility">
  <div class="wrap">
    <div class="row">
      <div class="left">
        <span class="mono"><span class="dot"></span>&nbsp;&nbsp;<?php echo esc_html( get_theme_mod('mitsue_utility_phase', 'Phase 0 · Pre-Foundation') ); ?></span>
        <span class="mono"><?php echo esc_html( get_theme_mod('mitsue_utility_location', 'Mitsue Village · Nara Prefecture · Japan') ); ?></span>
      </div>
      <div class="right">
        <span class="mono"><?php echo esc_html( get_theme_mod('mitsue_utility_horizon', '25-year horizon · est. April 2026') ); ?></span>
        <span class="lang" role="group" aria-label="Language">
          <button class="active" aria-pressed="true">EN</button>
          <span aria-hidden="true" style="color:var(--rule);">|</span>
          <button aria-pressed="false">日本語</button>
        </span>
      </div>
    </div>
  </div>
</div>

<nav class="primary" role="navigation" aria-label="<?php esc_attr_e('Primary navigation','mitsue'); ?>">
  <div class="wrap">
    <div class="row">
      <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>" style="text-decoration:none;color:inherit;">
        <div class="mark" aria-hidden="true"><?php echo esc_html( get_theme_mod('mitsue_logo_mark', '御') ); ?></div>
        <div class="name">
          <div class="en"><?php bloginfo('name'); ?></div>
          <div class="jp"><?php echo esc_html( get_theme_mod('mitsue_logo_jp', '御杖プロジェクト') ); ?></div>
        </div>
      </a>
      <button class="nav-toggle" aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
      <div class="navlinks">
        <?php
        if ( has_nav_menu('primary') ) {
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'depth'          => 1,
          ]);
        } else {
          foreach ( ['#programme'=>'Programme','#timeline'=>'Timeline','#governance'=>'Governance','#funding'=>'Funding','#status'=>'Status'] as $href => $label ) {
            printf( '<a href="%s">%s</a>', esc_url($href), esc_html($label) );
          }
        }
        ?>
        <a href="#contact" class="nav-cta">
          <?php echo esc_html( get_theme_mod('mitsue_nav_cta', 'For Investors') ); ?>
          <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true"><path d="M1 5 H9 M5 1 L9 5 L5 9"/></svg>
        </a>
      </div>
    </div>
  </div>
</nav>
