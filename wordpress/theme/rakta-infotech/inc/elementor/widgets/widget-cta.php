<?php
/**
 * Rakta Call to Action (CTA) Banner Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_CTA extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_cta';
    }

    public function get_title() {
        return esc_html__('Rakta CTA Banner', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return ['rakta-elements'];
    }

    protected function register_controls() {
        // --- Content Section ---
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Banner Content', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'   => esc_html__('Badge Tag', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Ready to Transform Your Digital Reality?',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => esc_html__('Main Headline', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => "LET'S ARCHITECT YOUR NEXT BREAKTHROUGH",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Subtitle Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Whether you need a high-conversion modern web platform, autonomous AI agents, or automated enterprise pipelines, our senior engineers are ready to build.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'primary_btn_text',
            [
                'label'   => esc_html__('Primary Button Text', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Schedule Strategic Consultation',
            ]
        );

        $this->add_control(
            'primary_is_modal',
            [
                'label'        => esc_html__('Open Lead Inquiry Modal?', 'rakta-core'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'primary_url',
            [
                'label'     => esc_html__('Primary Button URL', 'rakta-core'),
                'type'      => \Elementor\Controls_Manager::URL,
                'condition' => [
                    'primary_is_modal!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'secondary_btn_text',
            [
                'label'   => esc_html__('Secondary Button Text', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Case Studies',
            ]
        );

        $this->add_control(
            'secondary_url',
            [
                'label'   => esc_html__('Secondary Button URL', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#work',
                ],
            ]
        );

        $this->add_control(
            'trust_text',
            [
                'label'       => esc_html__('Trust Signals Footer', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Zero Technical Debt • Sub-Second Speed Target • Enterprise Security Hardened',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $is_modal = ($settings['primary_is_modal'] === 'yes');
        $primary_url = !empty($settings['primary_url']['url']) ? esc_url($settings['primary_url']['url']) : '#';
        $secondary_url = !empty($settings['secondary_url']['url']) ? esc_url($settings['secondary_url']['url']) : '#work';
        ?>
        <section class="section cta-section" aria-label="<?php echo esc_attr($settings['heading_text']); ?>">
            <div class="container">
                <div class="glass-card cta-card">
                    <div class="cta-content">
                        <?php if (!empty($settings['badge_text'])) : ?>
                            <div class="badge-tag" style="margin-bottom: 1.25rem;"><?php echo esc_html($settings['badge_text']); ?></div>
                        <?php endif; ?>

                        <h2 class="heading-section text-gradient" style="margin-bottom: 1.25rem;">
                            <?php echo esc_html($settings['heading_text']); ?>
                        </h2>

                        <?php if (!empty($settings['description_text'])) : ?>
                            <p class="cta-desc text-muted" style="max-width: 660px; margin: 0 auto 2.5rem; font-size: 1.1rem; line-height: 1.7;">
                                <?php echo esc_html($settings['description_text']); ?>
                            </p>
                        <?php endif; ?>

                        <div class="hero-ctas" style="justify-content: center; margin-bottom: 2rem;">
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

                        <?php if (!empty($settings['trust_text'])) : ?>
                            <div class="cta-trust-signals" style="font-size: 0.85rem; color: var(--text-muted);">
                                <?php echo esc_html($settings['trust_text']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
