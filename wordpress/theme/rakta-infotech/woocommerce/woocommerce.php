<?php
/**
 * WooCommerce Compatibility and Setup
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

// Declare WooCommerce theme support
function rakta_woocommerce_setup() {
    add_theme_support('woocommerce', [
        'thumbnail_image_width' => 450,
        'single_image_width'    => 800,
        'product_grid'          => [
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 6,
            'default_columns' => 3,
            'min_columns'     => 1,
            'max_columns'     => 4,
        ],
    ]);
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'rakta_woocommerce_setup');

// Wrap WooCommerce content in Rakta dark-mode glass container
function rakta_woocommerce_wrapper_before() {
    echo '<div class="container section"><div class="glass-card" style="padding: 2.5rem;">';
}
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content', 'rakta_woocommerce_wrapper_before', 10);

function rakta_woocommerce_wrapper_after() {
    echo '</div></div>';
}
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'rakta_woocommerce_wrapper_after', 10);

// Disable default WooCommerce stylesheet bloat in favor of theme styling
add_filter('woocommerce_enqueue_styles', '__return_empty_array');
