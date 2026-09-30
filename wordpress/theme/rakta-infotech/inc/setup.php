<?php
/**
 * Theme setup functions
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

function rakta_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true);

    // Switch default core markup for search form, comment form, and comments to output valid HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Register navigation menus
    register_nav_menus([
        'primary' => esc_html__('Primary Navigation', 'rakta-infotech'),
        'footer'  => esc_html__('Footer Navigation', 'rakta-infotech'),
    ]);

    // Selective Refresh for Widgets in Customizer
    add_theme_support('customize-selective-refresh-widgets');

    // Wide and full alignments for Elementor and block editor
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'rakta_theme_setup');
