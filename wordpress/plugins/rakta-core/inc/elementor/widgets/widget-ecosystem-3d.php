<?php
/**
 * Rakta 3D Tech Ecosystem Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Ecosystem_3D extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_ecosystem_3d';
    }

    public function get_title() {
        return esc_html__('Rakta 3D Tech Ecosystem', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-circle-o';
    }

    public function get_categories() {
        return ['rakta-elements'];
    }

    protected function register_controls() {
        // --- Content Section ---
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Header & Description', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'   => esc_html__('Badge Text', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Interactive Architecture',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => esc_html__('Heading Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'CONNECTED TECH ECOSYSTEM',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Section Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'An integrated 3D computational nexus connecting AI intelligence, modern headless web, automated workflows, and global commerce.',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // --- Ecosystem Nodes Repeater ---
        $this->start_controls_section(
            'section_nodes',
            [
                'label' => esc_html__('Ecosystem Nodes (Satellites)', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'node_id',
            [
                'label'   => esc_html__('Node Unique ID (lowercase slug)', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'ai',
            ]
        );

        $repeater->add_control(
            'label',
            [
                'label'   => esc_html__('Pill Label', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'AI & Agents',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Full Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Autonomous AI Intelligence',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__('Detailed Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Multi-agent systems, tailored RAG architectures, and fine-tuned LLMs running seamlessly across customer touchpoints.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'stats',
            [
                'label'   => esc_html__('Stats / Metrics Callout', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Sub-500ms inference • Secure private data isolation',
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label'   => esc_html__('Satellite Glow Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#FF1744',
            ]
        );

        $this->add_control(
            'nodes_list',
            [
                'label'       => esc_html__('Ecosystem Satellites', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'node_id'     => 'ai',
                        'label'       => 'AI & Agents',
                        'title'       => 'Autonomous AI Intelligence',
                        'description' => 'Multi-agent systems, tailored RAG architectures, and fine-tuned LLMs running seamlessly across customer touchpoints.',
                        'stats'       => 'Sub-500ms inference • Secure private data isolation',
                        'color'       => '#FF1744',
                    ],
                    [
                        'node_id'     => 'web',
                        'label'       => 'Modern Web',
                        'title'       => 'Bespoke Web Platforms',
                        'description' => 'Lightning-fast, accessible web experiences engineered with modern semantic code, custom WordPress, and headless architectures.',
                        'stats'       => '95+ Mobile CWV • Zero bloated page builders',
                        'color'       => '#D90429',
                    ],
                    [
                        'node_id'     => 'automation',
                        'label'       => 'Automation',
                        'title'       => 'Autonomous Workflows',
                        'description' => 'Self-hosted n8n and webhook pipelines eliminating repetitive human overhead across CRM, billing, and logistics.',
                        'stats'       => 'Hundreds of manual hours saved monthly',
                        'color'       => '#FF1744',
                    ],
                    [
                        'node_id'     => 'ecommerce',
                        'label'       => 'E-Commerce',
                        'title'       => 'High-Conversion Commerce',
                        'description' => 'Hardened WooCommerce stores optimized for high order concurrency, sub-second checkout, and global payment gateways.',
                        'stats'       => '40%+ average checkout conversion surge',
                        'color'       => '#D90429',
                    ],
                    [
                        'node_id'     => 'api',
                        'label'       => 'API & Sync',
                        'title'       => 'Omnichannel Connectors',
                        'description' => 'WhatsApp Business Cloud API, enterprise REST endpoints, and GraphQL microservices linking all business tools.',
                        'stats'       => 'Real-time bi-directional telemetry',
                        'color'       => '#FF1744',
                    ],
                    [
                        'node_id'     => 'cloud',
                        'label'       => 'Cloud & Speed',
                        'title'       => 'Edge Cloud Infrastructure',
                        'description' => 'Distributed CDN edge delivery, Redis object caching, automated backups, and bank-grade SSL security hardening.',
                        'stats'       => '99.99% uptime guarantee with DDoS shield',
                        'color'       => '#D90429',
                    ],
                ],
                'title_field' => '{{{ label }}}',
            ]
        );

        $this->end_controls_section();

        // --- 3D Scene Controls ---
        $this->start_controls_section(
            'section_3d_controls',
            [
                'label' => esc_html__('3D Visual Parameters', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'core_color',
            [
                'label'   => esc_html__('Central Core Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#090D18',
            ]
        );

        $this->add_control(
            'emissive_color',
            [
                'label'   => esc_html__('Emissive Glow Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#0066FF',
            ]
        );

        $this->add_control(
            'halo_color',
            [
                'label'   => esc_html__('Wireframe Halo Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#00F0FF',
            ]
        );

        $this->add_control(
            'orbit_radius',
            [
                'label'   => esc_html__('Orbit Radius', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [
                        'min'  => 1.5,
                        'max'  => 4.0,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 2.6,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $nodes = !empty($settings['nodes_list']) ? $settings['nodes_list'] : [];

        $clean_nodes = [];
        foreach ($nodes as $n) {
            $clean_nodes[] = [
                'id'          => sanitize_key($n['node_id']),
                'label'       => sanitize_text_field($n['label']),
                'title'       => sanitize_text_field($n['title']),
                'description' => sanitize_text_field($n['description']),
                'stats'       => sanitize_text_field($n['stats']),
                'color'       => sanitize_hex_color($n['color']) ?: '#FF1744',
            ];
        }

        $config = [
            'coreColor'     => $settings['core_color'],
            'emissiveColor' => $settings['emissive_color'],
            'haloColor'     => $settings['halo_color'],
            'orbitRadius'   => !empty($settings['orbit_radius']['size']) ? (float)$settings['orbit_radius']['size'] : 2.6,
            'nodes'         => $clean_nodes,
        ];
        $config_json = esc_attr(wp_json_encode($config));

        $first_node = !empty($clean_nodes[0]) ? $clean_nodes[0] : [
            'title'       => 'Select a Node',
            'description' => 'Hover over any satellite node to inspect system specifications.',
            'stats'       => 'Real-Time Interactivity',
        ];
        ?>
        <section id="ecosystem" class="section ecosystem-section rakta-ecosystem-wrap" aria-label="<?php echo esc_attr($settings['heading_text']); ?>">
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

                <div class="ecosystem-viewport">
                    <div class="ecosystem-canvas-container" aria-hidden="true">
                        <canvas class="rakta-ecosystem-canvas" id="ecosystem-canvas" data-scene-config="<?php echo $config_json; ?>"></canvas>
                    </div>

                    <div class="ecosystem-overlay-controls">
                        <div class="ecosystem-nodes-grid" id="ecosystem-nodes-container">
                            <?php foreach ($clean_nodes as $idx => $node) : ?>
                                <div class="node-card <?php echo $idx === 0 ? 'active' : ''; ?>" data-node-id="<?php echo esc_attr($node['id']); ?>" tabindex="0" role="button" aria-label="<?php echo esc_attr('Activate ' . $node['label'] . ' Node'); ?>">
                                    <div class="node-card-header">
                                        <span class="node-label"><?php echo esc_html($node['label']); ?></span>
                                        <span class="node-status-dot" aria-hidden="true" style="background-color: <?php echo esc_attr($node['color']); ?>;"></span>
                                    </div>
                                    <p class="node-desc"><?php echo esc_html($node['title']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="node-detail-panel glass-card" aria-live="polite">
                            <div class="node-detail-header">
                                <span class="badge-tag" style="margin-bottom: 0.5rem;"><?php esc_html_e('Node Telemetry', 'rakta-core'); ?></span>
                                <h3 class="detail-title text-gradient"><?php echo esc_html($first_node['title']); ?></h3>
                            </div>
                            <p class="detail-desc text-muted"><?php echo esc_html($first_node['description']); ?></p>
                            <div class="detail-stats"><?php echo esc_html($first_node['stats']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
