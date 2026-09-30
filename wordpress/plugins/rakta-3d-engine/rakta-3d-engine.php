<?php
/**
 * Plugin Name: Rakta 3D Engine & Animation Runtime
 * Plugin URI: https://raktainfotech.com/
 * Description: Modular WebGL Three.js 3D engine, Particle Systems, and GSAP Animation Runtime for Rakta Infotech.
 * Version: 1.0.0
 * Author: Rakta Infotech
 * Author URI: https://raktainfotech.com/
 * Text Domain: rakta-3d-engine
 * License: GPLv2 or later
 */

if (!defined('ABSPATH')) {
    exit;
}

define('RAKTA_3D_VERSION', '1.0.0');
define('RAKTA_3D_DIR', plugin_dir_path(__FILE__));
define('RAKTA_3D_URI', plugin_dir_url(__FILE__));

// Load Shortcodes
require_once RAKTA_3D_DIR . 'inc/shortcode-3d.php';

// Elementor Widget Registration Hook
function rakta_register_elementor_3d_widget($widgets_manager) {
    if (file_exists(RAKTA_3D_DIR . 'inc/elementor-widget.php')) {
        require_once RAKTA_3D_DIR . 'inc/elementor-widget.php';
        $widgets_manager->register(new \Rakta_Elementor_3D_Widget());
    }
}
add_action('elementor/widgets/register', 'rakta_register_elementor_3d_widget');
