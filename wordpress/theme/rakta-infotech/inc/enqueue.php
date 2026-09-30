<?php
/**
 * Enqueue scripts and styles
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

function rakta_enqueue_assets() {
    // Google Fonts: Inter & Space Grotesk
    wp_enqueue_style(
        'rakta-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // Theme Core CSS
    wp_enqueue_style(
        'rakta-theme-main',
        RAKTA_THEME_URI . '/assets/css/style.css',
        [],
        RAKTA_THEME_VERSION
    );

    // Enqueue GSAP & Three.js vendors
    wp_enqueue_script(
        'rakta-gsap-vendor',
        RAKTA_THEME_URI . '/assets/js/gsap-vendor.js',
        [],
        RAKTA_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'rakta-three-vendor',
        RAKTA_THEME_URI . '/assets/js/three-vendor.js',
        [],
        RAKTA_THEME_VERSION,
        true
    );

    // Main Theme Application Script
    wp_enqueue_script(
        'rakta-theme-app',
        RAKTA_THEME_URI . '/assets/js/main.js',
        ['rakta-gsap-vendor', 'rakta-three-vendor'],
        RAKTA_THEME_VERSION,
        true
    );

    // Pass REST API nonces & endpoints to JavaScript
    wp_localize_script('rakta-theme-app', 'raktaSettings', [
        'root'  => esc_url_raw(rest_url()),
        'nonce' => wp_create_nonce('wp_rest'),
        'ajaxUrl' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'rakta_enqueue_assets');
