<?php
/**
 * Front Page Template
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Modular Homepage Template Parts
get_template_part('template-parts/hero');
get_template_part('template-parts/stats');
get_template_part('template-parts/services');
get_template_part('template-parts/ecosystem');
get_template_part('template-parts/solutions');
get_template_part('template-parts/portfolio');
get_template_part('template-parts/process');
get_template_part('template-parts/why-us');
get_template_part('template-parts/cta');

get_footer();
