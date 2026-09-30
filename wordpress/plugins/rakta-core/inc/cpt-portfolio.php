<?php
/**
 * Register 'project' Custom Post Type and 'project_category' Taxonomy
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

function rakta_register_cpt_portfolio() {
    $labels = [
        'name'               => esc_html__('Projects', 'rakta-core'),
        'singular_name'      => esc_html__('Project', 'rakta-core'),
        'menu_name'          => esc_html__('Rakta Portfolio', 'rakta-core'),
        'add_new'            => esc_html__('Add New Project', 'rakta-core'),
        'add_new_item'       => esc_html__('Add New Project', 'rakta-core'),
        'edit_item'          => esc_html__('Edit Project', 'rakta-core'),
        'new_item'           => esc_html__('New Project', 'rakta-core'),
        'view_item'          => esc_html__('View Project', 'rakta-core'),
        'search_items'       => esc_html__('Search Projects', 'rakta-core'),
        'not_found'          => esc_html__('No projects found', 'rakta-core'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'rewrite'            => ['slug' => 'portfolio'],
    ];

    register_post_type('project', $args);

    // Register Taxonomy
    register_taxonomy('project_category', ['project'], [
        'labels' => [
            'name'          => esc_html__('Project Categories', 'rakta-core'),
            'singular_name' => esc_html__('Category', 'rakta-core'),
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'project-category'],
    ]);
}
add_action('init', 'rakta_register_cpt_portfolio');
