<?php
/**
 * Rakta Infotech functions and definitions
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('RAKTA_THEME_VERSION', '1.0.0');
define('RAKTA_THEME_DIR', get_template_directory());
define('RAKTA_THEME_URI', get_template_directory_uri());

// Require theme modules
require_once RAKTA_THEME_DIR . '/inc/setup.php';
require_once RAKTA_THEME_DIR . '/inc/enqueue.php';
require_once RAKTA_THEME_DIR . '/inc/customizer.php';
require_once RAKTA_THEME_DIR . '/inc/performance.php';
require_once RAKTA_THEME_DIR . '/inc/security.php';

// Custom Post Types & REST API
require_once RAKTA_THEME_DIR . '/inc/cpt-setup.php';
require_once RAKTA_THEME_DIR . '/inc/rest-lead.php';

// 3D Elementor Integration (Embedded in Theme)
require_once RAKTA_THEME_DIR . '/inc/elementor/class-rakta-theme-elementor.php';

// 1-Click Automated 3D Pages & Demo Setup Engine
require_once RAKTA_THEME_DIR . '/inc/auto-setup.php';

// SEO & Structured Data Engine (#1 Google Ranking)
require_once RAKTA_THEME_DIR . '/inc/seo.php';

// TGM Plugin Activation (Required & Recommended Plugins)
require_once RAKTA_THEME_DIR . '/inc/tgmpa-config.php';

// WooCommerce Compatibility
if (class_exists('WooCommerce')) {
    require_once RAKTA_THEME_DIR . '/woocommerce/woocommerce.php';
}
