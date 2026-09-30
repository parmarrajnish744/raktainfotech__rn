<?php
/**
 * Rakta Process Roadmap Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Process extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_process';
    }

    public function get_title() {
        return esc_html__('Rakta Process Roadmap', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-time-line';
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
                'default' => 'Systematic Execution',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => esc_html__('Heading Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'HOW WE DELIVER SUCCESS',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Subtitle Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'A disciplined 6-stage engineering lifecycle transforming ambitious concepts into high-reliability production systems.',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // --- Process Steps Repeater ---
        $this->start_controls_section(
            'section_steps',
            [
                'label' => esc_html__('Timeline Steps', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'step',
            [
                'label'   => esc_html__('Step Number', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '01',
            ]
        );

        $repeater->add_control(
            'phase',
            [
                'label'   => esc_html__('Phase Name', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Discover',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Step Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Deep Requirement Discovery',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__('Step Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'We conduct in-depth architecture and business discovery to map goals, data flows, and automation opportunities.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'deliverable',
            [
                'label'       => esc_html__('Key Output / Deliverable', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Technical Scope & Feasibility Matrix',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'steps',
            [
                'label'       => esc_html__('Roadmap Steps', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'step'        => '01',
                        'phase'       => 'Discover',
                        'title'       => 'Deep Requirement Discovery',
                        'description' => 'We conduct in-depth architecture and business discovery to map goals, audience personas, data flows, and automation opportunities.',
                        'deliverable' => 'Technical Scope & Feasibility Matrix',
                    ],
                    [
                        'step'        => '02',
                        'phase'       => 'Strategy',
                        'title'       => 'Technology & UX Blueprint',
                        'description' => 'We architect the optimal technology stack, database schemas, API interfaces, and user journey wireframes for maximum longevity.',
                        'deliverable' => 'System Architecture & Wireframes',
                    ],
                    [
                        'step'        => '03',
                        'phase'       => 'Design',
                        'title'       => 'High-Fidelity 3D & UI Design',
                        'description' => 'We create a distinctive visual identity, dark-mode glassmorphic components, 3D graphics, and responsive micro-interactions.',
                        'deliverable' => 'Interactive Design System & Prototypes',
                    ],
                    [
                        'step'        => '04',
                        'phase'       => 'Build',
                        'title'       => 'Clean Modular Development',
                        'description' => 'Our engineers build clean, modular code with modern WordPress standards, WebGL Three.js scenes, and robust webhook pipelines.',
                        'deliverable' => 'Production Codebase & API Integrations',
                    ],
                    [
                        'step'        => '05',
                        'phase'       => 'Test',
                        'title'       => 'Rigorous QA & Core Web Vitals',
                        'description' => 'Every component is stress-tested across 15+ screen sizes, audited for accessibility, and optimized for 95+ PageSpeed scores.',
                        'deliverable' => 'Performance & Security Audit Report',
                    ],
                    [
                        'step'        => '06',
                        'phase'       => 'Launch',
                        'title'       => 'Zero-Downtime Launch & Scale',
                        'description' => 'We execute zero-downtime DNS deployment, CDN configuration, SEO indexing, and set up continuous monitoring telemetry.',
                        'deliverable' => 'Live Production Platform & Documentation',
                    ],
                ],
                'title_field' => '{{{ step }}} - {{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $steps = !empty($settings['steps']) ? $settings['steps'] : [];
        ?>
        <section id="process" class="section process-section" aria-label="<?php echo esc_attr($settings['heading_text']); ?>">
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

                <div class="timeline-container">
                    <div class="timeline-track" aria-hidden="true">
                        <div class="timeline-line-fill"></div>
                    </div>

                    <div class="timeline-steps" id="process-steps-container">
                        <?php foreach ($steps as $idx => $s) : ?>
                            <div class="timeline-step <?php echo $idx === 0 ? 'active' : ''; ?>" data-step="<?php echo esc_attr($s['step']); ?>">
                                <div class="step-node" aria-hidden="true"><?php echo esc_html($s['step']); ?></div>
                                <div class="step-content glass-card">
                                    <div class="step-header">
                                        <span class="step-phase"><?php echo esc_html($s['phase']); ?></span>
                                    </div>
                                    <h3 class="heading-card" style="margin-bottom: 0.5rem;"><?php echo esc_html($s['title']); ?></h3>
                                    <p class="text-muted" style="font-size: 0.9rem;"><?php echo esc_html($s['description']); ?></p>
                                    <div class="step-deliverable">
                                        <strong><?php esc_html_e('Key Output:', 'rakta-core'); ?></strong> <?php echo esc_html($s['deliverable']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
