<?php
/**
 * Rakta Solutions & Capabilities Tabbed Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Solutions extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_solutions';
    }

    public function get_title() {
        return esc_html__('Rakta Solutions & Capabilities', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-tabs';
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
                'default' => 'End-to-End Capabilities',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => esc_html__('Heading Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'ENGINEERED SOLUTIONS',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Subtitle Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Explore our full spectrum of modern digital competencies structured across distinct industry verticals.',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // --- Categories Repeater ---
        $this->start_controls_section(
            'section_categories',
            [
                'label' => esc_html__('Capability Categories', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'cat_id',
            [
                'label'   => esc_html__('Category Slug (lowercase)', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'ai',
            ]
        );

        $repeater->add_control(
            'cat_name',
            [
                'label'   => esc_html__('Tab Button Label', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'AI Solutions',
            ]
        );

        $repeater->add_control(
            'cat_badge',
            [
                'label'   => esc_html__('Category Badge', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Next-Gen AI',
            ]
        );

        $repeater->add_control(
            'cat_desc',
            [
                'label'       => esc_html__('Category Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Intelligent autonomous tools engineered to automate workflows, analyze big data, and deliver superhuman response times.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'items_raw',
            [
                'label'       => esc_html__('Solution Items (JSON or Pipe format)', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => "AI Chatbots & Conversational Engines | Custom RAG-powered chatbots trained on business knowledge. | LLM, RAG, Vector DB\nAutonomous AI Agents | Goal-driven multi-agent systems executing complex workflows. | Auto-GPT, Python, API\nDocument & Workflow Intelligence | Automated parsing of complex invoices and contracts. | Vision AI, OCR, Pipelines\nCustom AI Business Tools | Tailored internal copilots empowering team productivity. | Copilots, Next.js, FastAPI",
                'description' => esc_html__('Format per line: Title | Description | Tags (comma separated)', 'rakta-core'),
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'       => esc_html__('Categories List', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'cat_id'    => 'ai',
                        'cat_name'  => 'AI Solutions',
                        'cat_badge' => 'Next-Gen AI',
                        'cat_desc'  => 'Intelligent autonomous tools engineered to automate workflows, analyze big data, and deliver superhuman response times.',
                        'items_raw' => "AI Chatbots & Conversational Engines | Custom RAG-powered chatbots trained exclusively on business knowledge. | LLM, RAG, Vector DB\nAutonomous AI Agents | Goal-driven multi-agent systems executing complex multi-step workflows. | Auto-GPT, Tool Calling, Python\nAI Document Automation | Automated parsing, extraction, and validation of complex invoices and contracts. | Vision AI, OCR, Pipelines\nCustom AI Business Tools | Tailored internal web interfaces and copilot extensions empowering team productivity. | Copilots, FastAPI, Next.js",
                    ],
                    [
                        'cat_id'    => 'web',
                        'cat_name'  => 'Web Solutions',
                        'cat_badge' => 'Engineered For Speed',
                        'cat_desc'  => 'Clean, bespoke web experiences that represent brand prestige while achieving top-tier lighthouse performance scores.',
                        'items_raw' => "Corporate Platforms | Architected for global digital prestige, enterprise security, and omnichannel scalability. | Architecture, Enterprise, Global CDN\nHigh-Converting Landing Pages | Data-driven psychological UX paired with sub-second loading speeds. | CRO, A/B Testing, Speed\nBespoke Modern WordPress | Custom WordPress featuring tailored block libraries without bloated plugins. | Custom Blocks, PHP 8.3+, Zero Bloat\nCustom Web Applications | Full-stack scalable cloud apps with role-based access control and reactive state. | React, Node.js, PostgreSQL",
                    ],
                    [
                        'cat_id'    => 'commerce',
                        'cat_name'  => 'Commerce & Retail',
                        'cat_badge' => 'High-Velocity Revenue',
                        'cat_desc'  => 'Robust e-commerce infrastructure built to eliminate cart friction and withstand massive seasonal traffic spikes effortlessly.',
                        'items_raw' => "WooCommerce Enterprise | Hardened WooCommerce stores optimized to manage 50,000+ SKUs with instant search. | WooCommerce, Redis Cache, Custom Hooks\nInteractive 3D Showcases | Three.js powered 360-degree interactive product viewers that elevate immersion. | Three.js, GLTF, Web3D\nFrictionless Global Payments | Stripe, Razorpay, PayPal, Apple Pay with intelligent failover routing. | Stripe, Razorpay, PCI-DSS\nAutomated Inventory Pipelines | Real-time two-way synchronization between online storefronts and ERP systems. | Inventory, Webhooks, ERP",
                    ],
                    [
                        'cat_id'    => 'automation',
                        'cat_name'  => 'Business Automation',
                        'cat_badge' => 'Zero Manual Overhead',
                        'cat_desc'  => 'Interconnect all business applications into a single synchronized, autonomous digital nervous system.',
                        'items_raw' => "WhatsApp Business Workflows | Interactive WhatsApp ordering, automated payment notifications, and self-service. | Meta Cloud API, Chatbot, Broadcasts\nn8n Self-Hosted Automation | Secure, cost-effective automation pipelines connecting 200+ internal tools. | n8n, Docker, Self-Hosted\nCRM & ERP Synchronizations | Continuous bidirectional pipeline sync for Salesforce, HubSpot, and PostgreSQL. | HubSpot, Zoho, Postgres\nCustom REST & GraphQL APIs | Bespoke middleware linking legacy systems with modern web applications. | GraphQL, REST, Microservices",
                    ],
                ],
                'title_field' => '{{{ cat_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $categories = !empty($settings['categories']) ? $settings['categories'] : [];
        ?>
        <section id="solutions" class="section solutions-section" aria-label="<?php echo esc_attr($settings['heading_text']); ?>">
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

                <div class="solutions-tabs-nav" role="tablist">
                    <?php foreach ($categories as $idx => $cat) : ?>
                        <button type="button" class="solution-tab-btn <?php echo $idx === 0 ? 'active' : ''; ?>" data-tab="<?php echo esc_attr($cat['cat_id']); ?>" role="tab">
                            <span><?php echo esc_html($cat['cat_name']); ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="solutions-panels" id="solutions-panels-container">
                    <?php foreach ($categories as $idx => $cat) :
                        $lines = array_filter(array_map('trim', explode("\n", $cat['items_raw'])));
                        ?>
                        <div class="solutions-content-panel <?php echo $idx === 0 ? 'active' : ''; ?>" data-category="<?php echo esc_attr($cat['cat_id']); ?>" role="tabpanel">
                            <div style="margin-bottom: 2rem; max-width: 680px;">
                                <div class="badge-tag" style="margin-bottom: 0.5rem;"><?php echo esc_html($cat['cat_badge']); ?></div>
                                <p class="text-muted" style="font-size: 1.05rem;"><?php echo esc_html($cat['cat_desc']); ?></p>
                            </div>

                            <div class="solutions-grid">
                                <?php foreach ($lines as $line) :
                                    $parts = array_map('trim', explode('|', $line));
                                    $title = !empty($parts[0]) ? $parts[0] : '';
                                    $desc  = !empty($parts[1]) ? $parts[1] : '';
                                    $tags  = !empty($parts[2]) ? array_map('trim', explode(',', $parts[2])) : [];
                                    ?>
                                    <div class="solution-item-card">
                                        <h3 class="solution-item-title"><?php echo esc_html($title); ?></h3>
                                        <p class="text-muted" style="font-size: 0.9rem;"><?php echo esc_html($desc); ?></p>
                                        <?php if (!empty($tags)) : ?>
                                            <div class="solution-item-tags">
                                                <?php foreach ($tags as $t) : ?>
                                                    <span class="solution-tag"><?php echo esc_html($t); ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
