<?php
/**
 * Rakta Metrics & Live Stats Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Stats extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_stats';
    }

    public function get_title() {
        return esc_html__('Rakta Metrics & Stats', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-counter';
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
                'default' => 'Proven Engineering Metrics',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => esc_html__('Heading Title', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'ARCHITECTED FOR MEASURABLE IMPACT',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Subtitle Description', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Real-world technical benchmarks and business metrics achieved across high-scale platforms.',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // --- Stats Repeater ---
        $this->start_controls_section(
            'section_stats',
            [
                'label' => esc_html__('Stats Counters', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'target_number',
            [
                'label'   => esc_html__('Target Number', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 99,
            ]
        );

        $repeater->add_control(
            'suffix',
            [
                'label'   => esc_html__('Suffix (e.g. %, +, ms)', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '%',
            ]
        );

        $repeater->add_control(
            'label',
            [
                'label'       => esc_html__('Stat Label', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Core Web Vitals Pass Rate',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label'       => esc_html__('Brief Explanation', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Exceeding Google standards for FCP, LCP, and CLS performance.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'glow_color',
            [
                'label'   => esc_html__('Accent Glow Color', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#FF1744',
            ]
        );

        $this->add_control(
            'stats_items',
            [
                'label'       => esc_html__('Counters List', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'target_number' => 99,
                        'suffix'        => '%',
                        'label'         => 'Core Web Vitals',
                        'desc'          => 'Sub-second first contentful paint and instant interactivity.',
                        'glow_color'    => '#FF1744',
                    ],
                    [
                        'target_number' => 500,
                        'suffix'        => 'ms',
                        'label'         => 'Average AI Inference',
                        'desc'          => 'Ultra-fast conversational response times across custom models.',
                        'glow_color'    => '#D90429',
                    ],
                    [
                        'target_number' => 42,
                        'suffix'        => '%',
                        'label'         => 'Conversion Rate Surge',
                        'desc'          => 'Average revenue conversion increase following checkout optimization.',
                        'glow_color'    => '#FF1744',
                    ],
                    [
                        'target_number' => 100,
                        'suffix'        => '%',
                        'label'         => 'Hands-Off Automation',
                        'desc'          => 'Seamless webhook synchronization across CRM and databases.',
                        'glow_color'    => '#D90429',
                    ],
                ],
                'title_field' => '{{{ label }}} ({{{ target_number }}}{{{ suffix }}})',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $stats = !empty($settings['stats_items']) ? $settings['stats_items'] : [];
        ?>
        <section class="section stats-section" aria-label="<?php echo esc_attr($settings['heading_text']); ?>">
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

                <div class="stats-grid">
                    <?php foreach ($stats as $item) : ?>
                        <div class="glass-card stat-card" style="border-top: 2px solid <?php echo esc_attr($item['glow_color']); ?>;">
                            <div class="stat-number-wrap">
                                <span class="stat-value-num" data-target="<?php echo esc_attr($item['target_number']); ?>">
                                    <?php echo esc_html($item['target_number']); ?>
                                </span>
                                <span class="stat-suffix" style="color: <?php echo esc_attr($item['glow_color']); ?>;">
                                    <?php echo esc_html($item['suffix']); ?>
                                </span>
                            </div>
                            <h3 class="stat-title"><?php echo esc_html($item['label']); ?></h3>
                            <p class="stat-desc text-muted"><?php echo esc_html($item['desc']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
