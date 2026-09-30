<?php
/**
 * Rakta Theme Elementor Integration Manager
 *
 * Automatically registers all Rakta 3D Elementor widgets and editor bridges.
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

if (class_exists('Rakta_Theme_Elementor_Manager')) {
    return;
}

class Rakta_Theme_Elementor_Manager {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        // Register Custom Elementor Widget Category
        add_action('elementor/elements/categories_registered', [$this, 'register_categories']);

        // Register Custom 3D Widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Enqueue Elementor frontend & editor scripts
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
    }

    public function register_categories($elements_manager) {
        $elements_manager->add_category(
            'rakta-elements',
            [
                'title' => esc_html__('Rakta 3D & Digital', 'rakta-infotech'),
                'icon'  => 'fa fa-cube',
            ]
        );
    }

    public function enqueue_frontend_scripts() {
        if (!wp_script_is('rakta-elementor-bridge', 'enqueued')) {
            wp_enqueue_script(
                'rakta-elementor-bridge',
                get_template_directory_uri() . '/assets/js/elementor-bridge.js',
                ['jquery'],
                RAKTA_THEME_VERSION,
                true
            );
        }
    }

    public function register_widgets($widgets_manager) {
        $widgets = [
            'widget-hero-3d.php'        => '\Rakta_Widget_Hero_3D',
            'widget-ecosystem-3d.php'   => '\Rakta_Widget_Ecosystem_3D',
            'widget-services.php'       => '\Rakta_Widget_Services',
            'widget-stats.php'          => '\Rakta_Widget_Stats',
            'widget-solutions.php'      => '\Rakta_Widget_Solutions',
            'widget-portfolio.php'      => '\Rakta_Widget_Portfolio',
            'widget-process.php'        => '\Rakta_Widget_Process',
            'widget-why-us.php'         => '\Rakta_Widget_Why_Us',
            'widget-cta.php'            => '\Rakta_Widget_CTA',
            'widget-lead-modal.php'     => '\Rakta_Widget_Lead_Modal',
        ];

        foreach ($widgets as $file => $class_name) {
            $path = get_template_directory() . '/inc/elementor/widgets/' . $file;
            if (file_exists($path)) {
                require_once $path;
                if (class_exists($class_name)) {
                    // Check if widget is already registered
                    if (method_exists($widgets_manager, 'get_widget_types')) {
                        $types = $widgets_manager->get_widget_types();
                        $sample_obj = new $class_name();
                        if (isset($types[$sample_obj->get_name()])) {
                            continue;
                        }
                    }
                    $widgets_manager->register(new $class_name());
                }
            }
        }
    }
}

Rakta_Theme_Elementor_Manager::instance();
