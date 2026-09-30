<?php
/**
 * Rakta Services Grid Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Services extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_services';
    }

    public function get_title() {
        return esc_html__('Rakta Services Grid', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-apps';
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
                'default' => 'Specialized Capabilities',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => esc_html__('Heading Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'WHAT WE BUILD',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Subtitle Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'We merge cutting-edge technology with high-conversion product design to engineer systems that scale effortlessly.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'   => esc_html__('Columns', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => esc_html__('2 Columns', 'rakta-core'),
                    '3' => esc_html__('3 Columns', 'rakta-core'),
                    '4' => esc_html__('4 Columns', 'rakta-core'),
                ],
            ]
        );

        $this->end_controls_section();

        // --- Services List Repeater ---
        $this->start_controls_section(
            'section_services_list',
            [
                'label' => esc_html__('Services Items', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Service Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'WordPress Development',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tagline',
            [
                'label'   => esc_html__('Tagline / Sub-badge', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'High-Performance Modern WP',
            ]
        );

        $repeater->add_control(
            'short_desc',
            [
                'label'       => esc_html__('Short Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Enterprise-grade, security-hardened WordPress themes and block ecosystems built without bloated page builders.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'icon_svg',
            [
                'label'       => esc_html__('Custom Icon SVG or HTML', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="m3.6 9 8.4 12 3.6-7.2L12 3.6 3.6 9z"/><path d="M12 3.6 20.4 9l-4.8 11.4"/></svg>',
                'description' => esc_html__('Paste SVG icon code or HTML.', 'rakta-core'),
            ]
        );

        $repeater->add_control(
            'features_list',
            [
                'label'       => esc_html__('Feature Bullets (One per line)', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => "Custom Gutenberg Blocks\nHeadless / Hybrid WP\nSub-second Load Times\nBank-Grade Security",
                'description' => esc_html__('Type each feature on a separate new line.', 'rakta-core'),
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'label'   => esc_html__('Button Text', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Learn More & Consult',
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
            'services',
            [
                'label'       => esc_html__('Service Cards', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'         => 'WordPress Development',
                        'tagline'       => 'High-Performance Modern WP',
                        'short_desc'    => 'Enterprise-grade, security-hardened WordPress themes and block ecosystems built without bloated page builders.',
                        'features_list' => "Custom Gutenberg Blocks\nHeadless / Hybrid WP\nSub-second Load Times\nBank-Grade Security",
                        'icon_svg'      => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="m3.6 9 8.4 12 3.6-7.2L12 3.6 3.6 9z"/><path d="M12 3.6 20.4 9l-4.8 11.4"/></svg>',
                    ],
                    [
                        'title'         => 'WooCommerce & E-Commerce',
                        'tagline'       => 'Conversion-Engineered Commerce',
                        'short_desc'    => 'Custom WooCommerce digital storefronts engineered for high conversions, friction-free checkout, and seamless inventory sync.',
                        'features_list' => "Instant AJAX Cart & Search\nGlobal Payment Gateways\nInventory & ERP Sync\n3D Product Showcase Ready",
                        'icon_svg'      => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>',
                    ],
                    [
                        'title'         => 'AI Solutions & Agents',
                        'tagline'       => 'Autonomous Intelligence',
                        'short_desc'    => 'Production-ready autonomous AI agents, intelligent knowledge retrieval (RAG), and tailored LLM integrations for enterprise operations.',
                        'features_list' => "Custom Trained AI Agents\nRAG Knowledge Bases\nMultimodal Analysis\nAutonomous Task Routing",
                        'icon_svg'      => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2v4"/><path d="m4.93 4.93 2.83 2.83"/><path d="M2 12h4"/><path d="m4.93 19.07 2.83-2.83"/><path d="M12 22v-4"/><path d="m19.07 19.07-2.83-2.83"/><path d="M22 12h-4"/><path d="m19.07 4.93-2.83 2.83"/><circle cx="12" cy="12" r="4"/></svg>',
                    ],
                    [
                        'title'         => 'WhatsApp Automation',
                        'tagline'       => 'Official Meta Cloud API',
                        'short_desc'    => 'Intelligent conversational chatbots, automated booking funnels, and CRM synchronizations powered by the official WhatsApp Cloud API.',
                        'features_list' => "Meta Cloud API Approved\nAutomated Booking & Pay\nHubSpot / Zoho CRM Sync\nInteractive Menus & CTAs",
                        'icon_svg'      => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>',
                    ],
                    [
                        'title'         => 'Business Automation',
                        'tagline'       => 'Zero-Latency Workflows',
                        'short_desc'    => 'Custom workflow automation pipelines connecting your CRM, databases, payment gateways, and communication channels seamlessly.',
                        'features_list' => "n8n & Webhook Pipelines\nAutomated Invoice & Billing\nMulti-Database Sync\nReal-Time Telemetry",
                        'icon_svg'      => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                    ],
                    [
                        'title'         => 'Custom Web Applications',
                        'tagline'       => 'Scalable Full-Stack Engineering',
                        'short_desc'    => 'Bespoke modern web applications, interactive dashboards, and SaaS platforms engineered for extreme responsiveness and speed.',
                        'features_list' => "Real-time Cloud Architecture\nInteractive WebGL Graphics\nRole-Based Access Control\n99.99% Reliability Target",
                        'icon_svg'      => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $services = !empty($settings['services']) ? $settings['services'] : [];
        $col_class = 'cols-' . (!empty($settings['columns']) ? $settings['columns'] : '3');
        ?>
        <section id="services" class="section services-section" aria-label="<?php echo esc_attr($settings['heading_text']); ?>">
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

                <div class="services-grid <?php echo esc_attr($col_class); ?>">
                    <?php foreach ($services as $idx => $svc) :
                        $features = array_filter(array_map('trim', explode("\n", $svc['features_list'])));
                        $is_modal = ($svc['is_modal'] === 'yes');
                        $link_url = !empty($svc['link_url']['url']) ? esc_url($svc['link_url']['url']) : '#';
                        ?>
                        <div class="glass-card service-card" data-service-id="svc-<?php echo esc_attr($idx); ?>">
                            <div class="service-icon-box" aria-hidden="true">
                                <?php echo !empty($svc['icon_svg']) ? $svc['icon_svg'] : ''; ?>
                            </div>
                            <div class="service-tagline"><?php echo esc_html($svc['tagline']); ?></div>
                            <h3 class="heading-card service-title"><?php echo esc_html($svc['title']); ?></h3>
                            <p class="text-muted" style="font-size: 0.9rem;"><?php echo esc_html($svc['short_desc']); ?></p>

                            <?php if (!empty($features)) : ?>
                                <ul class="service-features">
                                    <?php foreach ($features as $f) : ?>
                                        <li class="service-feature-item">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <span><?php echo esc_html($f); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <div class="service-footer">
                                <?php if ($is_modal) : ?>
                                    <button type="button" class="service-link" data-open-lead-modal>
                                        <span><?php echo esc_html($svc['btn_text']); ?></span>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </button>
                                <?php else : ?>
                                    <a href="<?php echo $link_url; ?>" class="service-link">
                                        <span><?php echo esc_html($svc['btn_text']); ?></span>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
