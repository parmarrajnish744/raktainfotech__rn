<?php
/**
 * Elementor 3D Scene Widget Class
 *
 * @package Rakta_3D_Engine
 */

if (!defined('ABSPATH')) {
    exit;
}

if (class_exists('\Elementor\Widget_Base')) {
    class Rakta_Elementor_3D_Widget extends \Elementor\Widget_Base {

        public function get_name() {
            return 'rakta_3d_scene';
        }

        public function get_title() {
            return esc_html__('Rakta 3D Scene', 'rakta-3d-engine');
        }

        public function get_icon() {
            return 'eicon-cube';
        }

        public function get_categories() {
            return ['general'];
        }

        protected function register_controls() {
            $this->start_controls_section(
                'content_section',
                [
                    'label' => esc_html__('3D Configuration', 'rakta-3d-engine'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'scene_type',
                [
                    'label' => esc_html__('Select Scene', 'rakta-3d-engine'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'hero',
                    'options' => [
                        'hero' => esc_html__('Hero Digital Core & Rings', 'rakta-3d-engine'),
                        'ecosystem' => esc_html__('Interactive Tech Ecosystem', 'rakta-3d-engine'),
                    ],
                ]
            );

            $this->add_control(
                'canvas_height',
                [
                    'label' => esc_html__('Canvas Height (px)', 'rakta-3d-engine'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => 500,
                ]
            );

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            $scene = esc_attr($settings['scene_type']);
            $height = esc_attr($settings['canvas_height']) . 'px';

            echo do_shortcode('[rakta_3d_scene scene="' . $scene . '" height="' . $height . '"]');
        }
    }
}
