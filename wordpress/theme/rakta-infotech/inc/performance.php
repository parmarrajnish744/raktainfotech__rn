<?php
/**
 * Theme performance optimizations
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

// Clean up unnecessary WordPress head output
function rakta_clean_head() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

    // Remove Emoji scripts & styles
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'rakta_clean_head');

// Add defer attribute to non-critical scripts
function rakta_defer_scripts($tag, $handle, $src) {
    if (is_admin()) {
        return $tag;
    }
    if (strpos($handle, 'rakta-') !== false) {
        return str_replace(' src', ' defer="defer" src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'rakta_defer_scripts', 10, 3);
