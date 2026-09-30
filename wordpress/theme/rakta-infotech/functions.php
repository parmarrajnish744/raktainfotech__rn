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

// WooCommerce Compatibility
if (class_exists('WooCommerce')) {
    require_once RAKTA_THEME_DIR . '/woocommerce/woocommerce.php';
}
