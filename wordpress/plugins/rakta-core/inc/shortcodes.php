<?php
/**
 * Reusable Shortcodes for Services, Portfolio, and Stats
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

// Shortcode: [rakta_services]
function rakta_shortcode_services($atts) {
    ob_start();
    get_template_part('template-parts/services');
    return ob_get_clean();
}
add_shortcode('rakta_services', 'rakta_shortcode_services');

// Shortcode: [rakta_portfolio]
function rakta_shortcode_portfolio($atts) {
    ob_start();
    get_template_part('template-parts/portfolio');
    return ob_get_clean();
}
add_shortcode('rakta_portfolio', 'rakta_shortcode_portfolio');

// Shortcode: [rakta_stats]
function rakta_shortcode_stats($atts) {
    ob_start();
    get_template_part('template-parts/stats');
    return ob_get_clean();
}
add_shortcode('rakta_stats', 'rakta_shortcode_stats');
