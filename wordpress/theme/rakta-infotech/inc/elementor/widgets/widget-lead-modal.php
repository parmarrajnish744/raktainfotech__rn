<?php
/**
 * Rakta Lead Capture Modal & Form Elementor Widget
 *
 * @package Rakta_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

class Rakta_Widget_Lead_Modal extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rakta_lead_modal';
    }

    public function get_title() {
        return esc_html__('Rakta Lead Capture Dialog', 'rakta-core');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return ['rakta-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_modal_settings',
            [
                'label' => esc_html__('Modal & Form Content', 'rakta-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Modal Heading', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Initiate Your Project Brief',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'       => esc_html__('Modal Subtitle', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Direct consultation with our senior systems architect. Strictly confidential NDA guaranteed.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'services_list',
            [
                'label'       => esc_html__('Services Dropdown Options (One per line)', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => "WordPress / Custom CMS Engineering\nWooCommerce & Global E-Commerce\nAutonomous AI Solutions & Agents\nWhatsApp Cloud API Workflows\nEnterprise Business Automation\nCustom Web App (React / Full-Stack)",
                'description' => esc_html__('Type each service option on a new line.', 'rakta-core'),
            ]
        );

        $this->add_control(
            'privacy_text',
            [
                'label'       => esc_html__('Privacy Assurance Note', 'rakta-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Strict NDA protection guaranteed. Zero third-party telemetry sharing.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'submit_btn_text',
            [
                'label'   => esc_html__('Submit Button Label', 'rakta-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Transmit Project Scope',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $options = array_filter(array_map('trim', explode("\n", $settings['services_list'])));
        ?>
        <dialog class="lead-modal" aria-labelledby="modal-lead-title" aria-modal="true">
            <div class="modal-card glass-card">
                <button type="button" class="modal-close-btn" aria-label="<?php esc_attr_e('Close Dialog', 'rakta-core'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>

                <div class="modal-header">
                    <div class="badge-tag" style="margin-bottom: 0.5rem;"><?php esc_html_e('Architecture Consultation', 'rakta-core'); ?></div>
                    <h2 id="modal-lead-title" class="heading-section text-gradient" style="font-size: 1.8rem; margin-bottom: 0.5rem;">
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                    <p class="text-muted" style="font-size: 0.95rem;">
                        <?php echo esc_html($settings['subtitle']); ?>
                    </p>
                </div>

                <form id="lead-project-form" class="lead-form" novalidate>
                    <?php wp_nonce_field('rakta_lead_nonce', 'security'); ?>
                    <div class="form-feedback" role="alert" style="display: none;"></div>

                    <div class="form-group-grid">
                        <div class="form-field">
                            <label for="lead-name" class="field-label"><?php esc_html_e('Your Name *', 'rakta-core'); ?></label>
                            <input type="text" id="lead-name" name="name" class="form-input" placeholder="e.g. Alexander Vance" required>
                        </div>
                        <div class="form-field">
                            <label for="lead-email" class="field-label"><?php esc_html_e('Work Email *', 'rakta-core'); ?></label>
                            <input type="email" id="lead-email" name="email" class="form-input" placeholder="alex@company.com" required>
                        </div>
                    </div>

                    <div class="form-group-grid">
                        <div class="form-field">
                            <label for="lead-company" class="field-label"><?php esc_html_e('Company / Organization', 'rakta-core'); ?></label>
                            <input type="text" id="lead-company" name="company" class="form-input" placeholder="Vance Global Media">
                        </div>
                        <div class="form-field">
                            <label for="lead-service" class="field-label"><?php esc_html_e('Primary Requirement *', 'rakta-core'); ?></label>
                            <select id="lead-service" name="service" class="form-input" required>
                                <option value="" disabled selected><?php esc_html_e('Select Core Capability...', 'rakta-core'); ?></option>
                                <?php foreach ($options as $opt) : ?>
                                    <option value="<?php echo esc_attr($opt); ?>"><?php echo esc_html($opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="lead-scope" class="field-label"><?php esc_html_e('Project Goals & Architecture Scope', 'rakta-core'); ?></label>
                        <textarea id="lead-scope" name="scope" rows="3" class="form-input" placeholder="<?php esc_attr_e('Provide a brief overview of your technical goals, integrations, and desired launch timeframe...', 'rakta-core'); ?>"></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-glow" style="width: 100%; justify-content: center;">
                            <?php echo esc_html($settings['submit_btn_text']); ?>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </div>

                    <?php if (!empty($settings['privacy_text'])) : ?>
                        <div class="form-footer-privacy">
                            <?php echo esc_html($settings['privacy_text']); ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </dialog>
        <?php
    }
}
