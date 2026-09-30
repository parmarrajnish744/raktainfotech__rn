<?php
/**
 * Rakta Why Choose Us Bento Grid Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Why_Us extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_why_us';
    }

    public function get_title() {
        return esc_html__('Rakta Why Us Bento', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_categories() {
        return ['rakta-elements'];
    }

    protected function register_controls() {
        // --- Header Section ---
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__('Section Header', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'   => esc_html__('Badge Text', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Strategic Advantage',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => esc_html__('Heading Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'WHY CHOOSE RAKTA INFOTECH',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Subtitle Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'We engineer digital products with uncompromising craftsmanship, architectural longevity, and measurable ROI.',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // --- Cards Repeater ---
        $this->start_controls_section(
            'section_cards',
            [
                'label' => esc_html__('Bento Value Cards', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tag',
            [
                'label'   => esc_html__('Pill Tag', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Future-Proof',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Card Heading', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'AI-First Engineering',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__('Explanation Text', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'We do not tack on AI as an afterthought. We embed intelligent agents, automated reasoning, and natural language interfaces right into your core architecture.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'cards',
            [
                'label'       => esc_html__('Advantage Items', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tag'         => 'Future-Proof',
                        'title'       => 'AI-First Engineering',
                        'description' => 'We don’t tack on AI as an afterthought. We embed intelligent agents, automated reasoning, and natural language interfaces right into your core product architecture.',
                    ],
                    [
                        'tag'         => 'Zero Bloat',
                        'title'       => 'Modern WordPress Architecture',
                        'description' => 'Say goodbye to 50 conflicting plugins and sluggish visual builders. We engineer clean custom themes with native Gutenberg blocks that load in under 1 second.',
                    ],
                    [
                        'tag'         => 'Sub-Second FCP',
                        'title'       => 'Performance-Focused Development',
                        'description' => 'Every kilobyte matters. We optimize CSS delivery, leverage WebGL shaders, cap device pixel ratios, and guarantee exceptional Core Web Vitals scores.',
                    ],
                    [
                        'tag'         => '100% Tailored',
                        'title'       => 'Bespoke Custom Solutions',
                        'description' => 'We never force generic templates onto unique businesses. Every line of code, database schema, and interactive animation is crafted specifically for your growth targets.',
                    ],
                    [
                        'tag'         => 'Maximum ROI',
                        'title'       => 'Automation-First Thinking',
                        'description' => 'If a task is performed twice, it should be automated. We build resilient pipelines connecting your web apps, CRM, WhatsApp, and inventory without recurring SaaS gouging.',
                    ],
                    [
                        'tag'         => 'Bank-Grade',
                        'title'       => 'Enterprise Scalability & Security',
                        'description' => 'From day one, our architectures follow strict WordPress security guidelines, nonces, sanitized inputs, rate limiting, and scalable cloud edge hosting.',
                    ],
                ],
                'title_field' => '{{{ tag }}} - {{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $cards = !empty($settings['cards']) ? $settings['cards'] : [];
        ?>
        <section id="why-us" class="section why-us-section" aria-label="<?php echo esc_attr($settings['heading_text']); ?>">
            <div class="container">
                <div class="section-header">
                    <?php if (!empty($settings['badge_text'])) : ?>
                        <div class="badge-tag"><?php echo esc_html($settings['badge_text']); ?></div>
                    <?php endif; ?>

                    <h2 class="heading-section text-gradient"><?php echo esc_html($settings['heading_text']); ?></h2>

                    <?php if (!empty($settings['description_text'])) : ?>
                        <p class="text-muted"><?php echo esc_html($settings['description_text']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="why-us-grid" id="why-us-container">
                    <?php foreach ($cards as $item) : ?>
                        <div class="glass-card bento-card">
                            <div class="bento-tag"><?php echo esc_html($item['tag']); ?></div>
                            <h3 class="heading-card" style="margin-bottom: 0.75rem;"><?php echo esc_html($item['title']); ?></h3>
                            <p class="text-muted" style="font-size: 0.9rem;"><?php echo esc_html($item['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
