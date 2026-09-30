<?php
/**
 * Rakta Elementor Integration Manager
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Elementor_Manager {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        // Register Widget Category
        add_action('elementor/elements/categories_registered', [$this, 'register_categories']);

        // Register Widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Enqueue Elementor frontend & editor scripts
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
    }

    public function register_categories($elements_manager) {
        $elements_manager->add_category(
            'rakta-elements',
            [
                'title' => esc_html__('Rakta 3D & Digital', 'rakta-core'),
                'icon'  => 'fa fa-cube',
            ]
        );
    }

    public function enqueue_frontend_scripts() {
        wp_enqueue_script(
            'rakta-elementor-bridge',
            RAKTA_CORE_URI . 'assets/js/elementor-bridge.js',
            ['jquery'],
            RAKTA_CORE_VERSION,
            true
        );
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
            $path = RAKTA_CORE_DIR . 'inc/elementor/widgets/' . $file;
            if (file_exists($path)) {
                require_once $path;
                if (class_exists($class_name)) {
                    $widgets_manager->register(new $class_name());
                }
            }
        }
    }
}

Rakta_Elementor_Manager::instance();
