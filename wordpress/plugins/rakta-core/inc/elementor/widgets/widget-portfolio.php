<?php
/**
 * Rakta Portfolio & Case Studies Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Portfolio extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_portfolio';
    }

    public function get_title() {
        return esc_html__('Rakta Portfolio Showcase', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
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
                'default' => 'Demonstrated Production Work',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => esc_html__('Heading Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'FEATURED CASE STUDIES',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Subtitle Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Real-world deployment outcomes engineered for international enterprises, agencies, and high-growth startups.',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // --- Projects Repeater ---
        $this->start_controls_section(
            'section_projects',
            [
                'label' => esc_html__('Case Studies List', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Project Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'AI Business Assistant & Copilot',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'client',
            [
                'label'   => esc_html__('Client / Brand Name', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Nexus Global Operations',
            ]
        );

        $repeater->add_control(
            'category_filter',
            [
                'label'   => esc_html__('Filter Category Slug', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'ai',
                'options' => [
                    'ai'         => esc_html__('AI & Agents', 'rakta-core'),
                    'commerce'   => esc_html__('E-Commerce', 'rakta-core'),
                    'automation' => esc_html__('Automation', 'rakta-core'),
                    'web'        => esc_html__('Web & CMS', 'rakta-core'),
                ],
            ]
        );

        $repeater->add_control(
            'category_label',
            [
                'label'   => esc_html__('Category Label Tag', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'AI & Agents',
            ]
        );

        $repeater->add_control(
            'short_desc',
            [
                'label'       => esc_html__('Short Summary', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Autonomous multi-agent assistant delivering intelligent internal knowledge retrieval, customer triage, and real-time report generation.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'metrics',
            [
                'label'   => esc_html__('Impact Metric', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '74% Faster Resolution • 12k Monthly Queries',
            ]
        );

        $repeater->add_control(
            'tech_stack',
            [
                'label'       => esc_html__('Technologies (comma-separated)', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Gemini 1.5 Pro, Python, Vector RAG, FastAPI, Next.js',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'label'   => esc_html__('Action Button Text', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'View Architecture Brief',
            ]
        );

        $repeater->add_control(
            'is_modal',
            [
                'label'        => esc_html__('Open Lead Inquiry Modal?', 'rakta-core'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            'link_url',
            [
                'label'     => esc_html__('Custom Link URL', 'rakta-core'),
                'type'      => \Elementor\Controls_Manager::URL,
                'condition' => [
                    'is_modal!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'projects',
            [
                'label'       => esc_html__('Projects List', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'           => 'AI Business Assistant & Copilot',
                        'client'          => 'Nexus Global Operations',
                        'category_filter' => 'ai',
                        'category_label'  => 'AI & Agents',
                        'short_desc'      => 'Autonomous multi-agent assistant delivering intelligent internal knowledge retrieval, customer triage, and real-time report generation.',
                        'metrics'         => '74% Faster Resolution • 12k Monthly Queries',
                        'tech_stack'      => 'Gemini 1.5 Pro, Python, Vector RAG, FastAPI, Next.js',
                    ],
                    [
                        'title'           => 'High-Scale WooCommerce Store',
                        'client'          => 'Aura Luxury Apparel',
                        'category_filter' => 'commerce',
                        'category_label'  => 'E-Commerce',
                        'short_desc'      => 'Ultra-fast headless WooCommerce storefront featuring 3D product previews, instant checkout, and automated multi-currency switching.',
                        'metrics'         => '98/100 CWV Score • +42% Checkout Conversion',
                        'tech_stack'      => 'WooCommerce, WordPress Headless, Three.js 3D, Stripe, Redis',
                    ],
                    [
                        'title'           => 'WhatsApp Appointment Booking Engine',
                        'client'          => 'Apex Health & Wellness',
                        'category_filter' => 'automation',
                        'category_label'  => 'Automation',
                        'short_desc'      => 'Automated two-way conversational booking engine with real-time calendar syncing, payment collection, and reminder broadcasts.',
                        'metrics'         => '89% Drop in No-Shows • 100% Hands-Off Booking',
                        'tech_stack'      => 'WhatsApp Cloud API, n8n, Node.js, PostgreSQL, Stripe',
                    ],
                    [
                        'title'           => 'AI Website Generator & Block Studio',
                        'client'          => 'Synapse Web Labs',
                        'category_filter' => 'web',
                        'category_label'  => 'Web & CMS',
                        'short_desc'      => 'Intelligent block composition engine allowing agency clients to generate customized, responsive WordPress block layouts in seconds.',
                        'metrics'         => '10x Faster Prototyping • 100% Native WP Blocks',
                        'tech_stack'      => 'React, WordPress Gutenberg, Claude API, Three.js',
                    ],
                    [
                        'title'           => 'Enterprise Automation Command Center',
                        'client'          => 'Vanguard Logistics',
                        'category_filter' => 'automation',
                        'category_label'  => 'Automation',
                        'short_desc'      => 'Centralized operational telemetry dashboard connecting fleet GPS, warehouse inventory, and automated customer dispatch alerts.',
                        'metrics'         => '600+ Hours Saved / Mo • 99.98% Pipeline Uptime',
                        'tech_stack'      => 'n8n Enterprise, PostgreSQL, WebSockets, Docker, REST',
                    ],
                ],
                'title_field' => '{{{ title }}} ({{{ client }}})',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $projects = !empty($settings['projects']) ? $settings['projects'] : [];
        ?>
        <section id="work" class="section portfolio-section" aria-label="<?php echo esc_attr($settings['heading_text']); ?>">
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

                <div class="portfolio-filter-nav" style="display: flex; gap: 0.5rem; justify-content: center; margin-bottom: 2.5rem; flex-wrap: wrap;">
                    <button type="button" class="btn btn-secondary portfolio-filter-btn active" data-filter="all" style="padding: 0.4rem 1rem; font-size: 0.85rem;">All Works</button>
                    <button type="button" class="btn btn-secondary portfolio-filter-btn" data-filter="ai" style="padding: 0.4rem 1rem; font-size: 0.85rem;">AI & Agents</button>
                    <button type="button" class="btn btn-secondary portfolio-filter-btn" data-filter="commerce" style="padding: 0.4rem 1rem; font-size: 0.85rem;">E-Commerce</button>
                    <button type="button" class="btn btn-secondary portfolio-filter-btn" data-filter="automation" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Automation</button>
                    <button type="button" class="btn btn-secondary portfolio-filter-btn" data-filter="web" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Web & CMS</button>
                </div>

                <div class="portfolio-grid" id="projects-container">
                    <?php foreach ($projects as $idx => $p) :
                        $pills = array_map('trim', explode(',', $p['tech_stack']));
                        $is_modal = ($p['is_modal'] === 'yes');
                        $link_url = !empty($p['link_url']['url']) ? esc_url($p['link_url']['url']) : '#';
                        ?>
                        <div class="glass-card project-card" data-category="<?php echo esc_attr($p['category_filter']); ?>" data-project-id="p-<?php echo esc_attr($idx); ?>">
                            <div class="project-media-wrap">
                                <div class="project-media-content" style="background: linear-gradient(135deg, rgba(217,4,41,0.2) 0%, rgba(139,0,21,0.05) 100%);">
                                    <span class="badge-tag" style="margin-bottom: 1rem;"><?php echo esc_html($p['category_label']); ?></span>
                                    <h4 style="font-family: var(--font-display); font-size: 1.4rem; color: #FFFFFF; margin-bottom: 0.5rem;"><?php echo esc_html($p['title']); ?></h4>
                                    <div style="font-size: 0.85rem; color: var(--red-bright);"><?php echo esc_html($p['client']); ?></div>
                                </div>
                            </div>

                            <div class="project-meta-row">
                                <span class="project-category"><?php echo esc_html($p['category_label']); ?></span>
                                <span class="project-metrics"><?php echo esc_html($p['metrics']); ?></span>
                            </div>

                            <h3 class="heading-card" style="margin-bottom: 0.5rem;"><?php echo esc_html($p['title']); ?></h3>
                            <p class="text-muted" style="font-size: 0.9rem;"><?php echo esc_html($p['short_desc']); ?></p>

                            <?php if (!empty($pills)) : ?>
                                <div class="project-tech-pills">
                                    <?php foreach ($pills as $pill) : ?>
                                        <span class="tech-pill"><?php echo esc_html($pill); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                                <?php if ($is_modal) : ?>
                                    <button type="button" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;" data-open-lead-modal>
                                        <?php echo esc_html($p['btn_text']); ?>
                                    </button>
                                <?php else : ?>
                                    <a href="<?php echo $link_url; ?>" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                                        <?php echo esc_html($p['btn_text']); ?>
                                    </a>
                                <?php endif; ?>
                                <span style="font-size: 0.8rem; color: var(--red-bright); font-weight: 600;">Enterprise Solution &rarr;</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
