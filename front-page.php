<?php
/**
 * Front page — BIOMASS ENERGY & AI investor landing
 * @package Mitsue
 */
get_header();

get_template_part('template-parts/section', 'hero');
get_template_part('template-parts/section', 'programme');
get_template_part('template-parts/section', 'imagery');
get_template_part('template-parts/section', 'rationale');
get_template_part('template-parts/section', 'endorsement');
get_template_part('template-parts/section', 'timeline');
get_template_part('template-parts/section', 'governance');
get_template_part('template-parts/section', 'funding');
get_template_part('template-parts/section', 'principles');
get_template_part('template-parts/section', 'status');
get_template_part('template-parts/section', 'cta');

get_footer();
