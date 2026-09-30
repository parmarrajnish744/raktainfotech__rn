<?php
/**
 * Plugin Name: Rakta Core Functionality
 * Plugin URI: https://raktainfotech.com/
 * Description: Core business logic, Custom Post Types (Services, Projects), REST API Lead Capture, and reusable shortcodes for Rakta Infotech.
 * Version: 1.0.0
 * Author: Rakta Infotech
 * Author URI: https://raktainfotech.com/
 * Text Domain: rakta-core
 * License: GPLv2 or later
 */

if (!defined('ABSPATH')) {
    exit;
}

define('RAKTA_CORE_VERSION', '1.0.0');
define('RAKTA_CORE_DIR', plugin_dir_path(__FILE__));
define('RAKTA_CORE_URI', plugin_dir_url(__FILE__));

// Load Custom Post Types & Taxonomies
require_once RAKTA_CORE_DIR . 'inc/cpt-services.php';
require_once RAKTA_CORE_DIR . 'inc/cpt-portfolio.php';

// Load REST API Endpoints
require_once RAKTA_CORE_DIR . 'inc/rest-lead.php';

// Load Reusable Shortcodes
require_once RAKTA_CORE_DIR . 'inc/shortcodes.php';

// Load Elementor Custom Widgets Integration
if (did_action('elementor/loaded') || true) {
    require_once RAKTA_CORE_DIR . 'inc/elementor/class-rakta-elementor.php';
}

// Activation & Flush rewrite rules
function rakta_core_activate() {
    rakta_register_cpt_services();
    rakta_register_cpt_portfolio();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'rakta_core_activate');

function rakta_core_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'rakta_core_deactivate');
