<?php
/**
 * Register 'service' Custom Post Type and 'service_type' Taxonomy
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

function rakta_register_cpt_services() {
    $labels = [
        'name'               => esc_html__('Services', 'rakta-core'),
        'singular_name'      => esc_html__('Service', 'rakta-core'),
        'menu_name'          => esc_html__('Rakta Services', 'rakta-core'),
        'add_new'            => esc_html__('Add New Service', 'rakta-core'),
        'add_new_item'       => esc_html__('Add New Service', 'rakta-core'),
        'edit_item'          => esc_html__('Edit Service', 'rakta-core'),
        'new_item'           => esc_html__('New Service', 'rakta-core'),
        'view_item'          => esc_html__('View Service', 'rakta-core'),
        'search_items'       => esc_html__('Search Services', 'rakta-core'),
        'not_found'          => esc_html__('No services found', 'rakta-core'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true, // Enables Gutenberg and REST API
        'menu_icon'          => 'dashicons-hammer',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'rewrite'            => ['slug' => 'service', 'with_front' => false],
    ];

    register_post_type('service', $args);

    // Register Taxonomy
    register_taxonomy('service_type', ['service'], [
        'labels' => [
            'name'          => esc_html__('Service Types', 'rakta-core'),
            'singular_name' => esc_html__('Service Type', 'rakta-core'),
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'service-type'],
    ]);
}
add_action('init', 'rakta_register_cpt_services');
