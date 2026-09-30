<?php
/**
 * Rakta 3D Hero Section Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Hero_3D extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_hero_3d';
    }

    public function get_title() {
        return esc_html__('Rakta 3D Hero Section', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['rakta-elements'];
    }

    protected function register_controls() {
        // --- Content Controls ---
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Hero Content', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'       => esc_html__('Top Badge Text', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Powered by AI, Web & Automation',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'brand_badge_text',
            [
                'label'       => esc_html__('Brand Pill Text', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Rakta Infotech • Digital Experiences & AI',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading_line_1',
            [
                'label'       => esc_html__('Heading Line 1', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'WE BUILD',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading_line_2',
            [
                'label'       => esc_html__('Heading Line 2 (Gradient Highlight)', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'DIGITAL EXPERIENCES',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'       => esc_html__('Subtitle Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'AI-powered websites, high-converting e-commerce platforms and intelligent business automation built for modern digital enterprises.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'primary_btn_text',
            [
                'label'   => esc_html__('Primary Button Text', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Start a Project',
            ]
        );

        $this->add_control(
            'primary_btn_is_modal',
            [
                'label'        => esc_html__('Open Lead Inquiry Modal?', 'rakta-core'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'rakta-core'),
                'label_off'    => esc_html__('No', 'rakta-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'primary_btn_url',
            [
                'label'         => esc_html__('Primary Button URL', 'rakta-core'),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => 'https://raktainfotech.com/contact',
                'condition'     => [
                    'primary_btn_is_modal!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'secondary_btn_text',
            [
                'label'   => esc_html__('Secondary Button Text', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Our Work',
            ]
        );

        $this->add_control(
            'secondary_btn_url',
            [
                'label'         => esc_html__('Secondary Button Link', 'rakta-core'),
                'type'          => \Elementor\Controls_Manager::URL,
                'default'       => [
                    'url' => '#work',
                ],
            ]
        );

        $this->end_controls_section();

        // --- 3D Scene Configuration Tab ---
        $this->start_controls_section(
            'section_3d_config',
            [
                'label' => esc_html__('3D Engine Controls', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'core_color',
            [
                'label'   => esc_html__('3D Core Base Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#060B18',
            ]
        );

        $this->add_control(
            'emissive_color',
            [
                'label'   => esc_html__('Core Emissive Glow Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#002244',
            ]
        );

        $this->add_control(
            'lattice_color',
            [
                'label'   => esc_html__('Outer Lattice Wireframe Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#00F0FF',
            ]
        );

        $this->add_control(
            'ring_color_1',
            [
                'label'   => esc_html__('Energy Ring 1 Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#0066FF',
            ]
        );

        $this->add_control(
            'ring_color_2',
            [
                'label'   => esc_html__('Energy Ring 2 Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#00F0FF',
            ]
        );

        $this->add_control(
            'speed_multiplier',
            [
                'label'   => esc_html__('3D Rotation Speed', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [
                        'min'  => 0.1,
                        'max'  => 3.0,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 1.0,
                ],
            ]
        );

        $this->add_control(
            'particle_count',
            [
                'label'   => esc_html__('Particle Density', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 100,
                'max'     => 2000,
                'step'    => 50,
                'default' => 800,
            ]
        );

        $this->add_responsive_control(
            'canvas_height',
            [
                'label'      => esc_html__('Section Height (px)', 'rakta-core'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 450,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 50,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 680,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hero-section' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $config = [
            'coreColor'       => $settings['core_color'],
            'emissiveColor'   => $settings['emissive_color'],
            'latticeColor'    => $settings['lattice_color'],
            'ringColor1'      => $settings['ring_color_1'],
            'ringColor2'      => $settings['ring_color_2'],
            'speedMultiplier' => !empty($settings['speed_multiplier']['size']) ? (float)$settings['speed_multiplier']['size'] : 1.0,
            'particleCount'   => !empty($settings['particle_count']) ? (int)$settings['particle_count'] : 800,
        ];
        $config_json = esc_attr(wp_json_encode($config));

        $is_modal = ($settings['primary_btn_is_modal'] === 'yes');
        $primary_url = !empty($settings['primary_btn_url']['url']) ? esc_url($settings['primary_btn_url']['url']) : '#';
        $secondary_url = !empty($settings['secondary_btn_url']['url']) ? esc_url($settings['secondary_btn_url']['url']) : '#work';
        ?>
        <section class="hero-section rakta-3d-hero-wrap" aria-label="<?php echo esc_attr($settings['heading_line_1'] . ' ' . $settings['heading_line_2']); ?>">
            <div class="hero-3d-container" aria-hidden="true">
                <canvas class="rakta-hero-canvas" id="hero-canvas" data-scene-config="<?php echo $config_json; ?>"></canvas>
            </div>

            <div class="hero-fallback" aria-hidden="true">
                <div class="hero-fallback-sphere"></div>
            </div>

            <div class="container">
                <div class="hero-content">
                    <?php if (!empty($settings['brand_badge_text'])) : ?>
                        <div class="hero-brand-badge">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/rakta-icon.png'); ?>" alt="<?php bloginfo('name'); ?>" class="hero-brand-badge-icon" width="26" height="26">
                            <span><?php echo esc_html($settings['brand_badge_text']); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($settings['badge_text'])) : ?>
                        <div class="badge-tag"><?php echo esc_html($settings['badge_text']); ?></div>
                    <?php endif; ?>

                    <h1 class="heading-hero text-gradient">
                        <?php echo esc_html($settings['heading_line_1']); ?><br>
                        <span class="text-gradient-red"><?php echo esc_html($settings['heading_line_2']); ?></span>
                    </h1>

                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="hero-subtitle">
                            <?php echo esc_html($settings['subtitle']); ?>
                        </p>
                    <?php endif; ?>

                    <div class="hero-ctas">
                        <?php if ($is_modal) : ?>
                            <button type="button" class="btn btn-primary btn-glow" data-open-lead-modal>
                                <?php echo esc_html($settings['primary_btn_text']); ?>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        <?php else : ?>
                            <a href="<?php echo $primary_url; ?>" class="btn btn-primary btn-glow">
                                <?php echo esc_html($settings['primary_btn_text']); ?>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($settings['secondary_btn_text'])) : ?>
                            <a href="<?php echo $secondary_url; ?>" class="btn btn-secondary">
                                <?php echo esc_html($settings['secondary_btn_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
