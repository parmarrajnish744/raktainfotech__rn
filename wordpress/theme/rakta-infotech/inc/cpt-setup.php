<?php
/**
 * Theme CPT and Taxonomy Registrations
 *
 * Ensures Services and Projects post types exist even if companion plugin is not activated.
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

function rakta_theme_register_cpts() {
    // 1. Service Custom Post Type
    if (!post_type_exists('service')) {
        $service_labels = [
            'name'               => esc_html__('Services', 'rakta-infotech'),
            'singular_name'      => esc_html__('Service', 'rakta-infotech'),
            'menu_name'          => esc_html__('Rakta Services', 'rakta-infotech'),
            'add_new'            => esc_html__('Add New Service', 'rakta-infotech'),
            'add_new_item'       => esc_html__('Add New Service', 'rakta-infotech'),
            'edit_item'          => esc_html__('Edit Service', 'rakta-infotech'),
            'new_item'           => esc_html__('New Service', 'rakta-infotech'),
            'view_item'          => esc_html__('View Service', 'rakta-infotech'),
            'search_items'       => esc_html__('Search Services', 'rakta-infotech'),
            'not_found'          => esc_html__('No services found', 'rakta-infotech'),
        ];

        $service_args = [
            'labels'             => $service_labels,
            'public'             => true,
            'has_archive'        => false,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-hammer',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'elementor'],
            'rewrite'            => ['slug' => 'service', 'with_front' => false],
        ];

        register_post_type('service', $service_args);

        // Service Type Taxonomy
        if (!taxonomy_exists('service_type')) {
            register_taxonomy('service_type', ['service'], [
                'labels' => [
                    'name'          => esc_html__('Service Types', 'rakta-infotech'),
                    'singular_name' => esc_html__('Service Type', 'rakta-infotech'),
                ],
                'hierarchical'      => true,
                'show_ui'           => true,
                'show_in_rest'      => true,
                'rewrite'           => ['slug' => 'service-type'],
            ]);
        }
    }

    // 2. Project / Portfolio Custom Post Type
    if (!post_type_exists('project')) {
        $project_labels = [
            'name'               => esc_html__('Projects', 'rakta-infotech'),
            'singular_name'      => esc_html__('Project', 'rakta-infotech'),
            'menu_name'          => esc_html__('Rakta Portfolio', 'rakta-infotech'),
            'add_new'            => esc_html__('Add New Project', 'rakta-infotech'),
            'add_new_item'       => esc_html__('Add New Project', 'rakta-infotech'),
            'edit_item'          => esc_html__('Edit Project', 'rakta-infotech'),
            'new_item'           => esc_html__('New Project', 'rakta-infotech'),
            'view_item'          => esc_html__('View Project', 'rakta-infotech'),
            'search_items'       => esc_html__('Search Projects', 'rakta-infotech'),
            'not_found'          => esc_html__('No projects found', 'rakta-infotech'),
        ];

        $project_args = [
            'labels'             => $project_labels,
            'public'             => true,
            'has_archive'        => false,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'elementor'],
            'rewrite'            => ['slug' => 'project', 'with_front' => false],
        ];

        register_post_type('project', $project_args);

        // Project Category Taxonomy
        if (!taxonomy_exists('project_category')) {
            register_taxonomy('project_category', ['project'], [
                'labels' => [
                    'name'          => esc_html__('Project Categories', 'rakta-infotech'),
                    'singular_name' => esc_html__('Category', 'rakta-infotech'),
                ],
                'hierarchical'      => true,
                'show_ui'           => true,
                'show_in_rest'      => true,
                'rewrite'           => ['slug' => 'project-category'],
            ]);
        }
    }
}
add_action('init', 'rakta_theme_register_cpts', 5);
