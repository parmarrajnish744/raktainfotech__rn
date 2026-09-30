<?php
/**
 * Contact Page Template
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$is_elementor = false;
if (class_exists('\Elementor\Plugin')) {
    $document = \Elementor\Plugin::$instance->documents->get(get_the_ID());
    if ($document && $document->is_built_with_elementor()) {
        $is_elementor = true;
    }
}

if ($is_elementor) {
    ?>
    <main id="primary" class="site-main rakta-elementor-page">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </main>
    <?php
} else {
    ?>
    <main id="primary" class="site-main">
        <section class="hero-section" style="min-height: 60vh;">
            <canvas id="hero-canvas" class="rakta-hero-canvas"></canvas>
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <div class="badge-tag">Direct Communication Channel</div>
                <h1 class="hero-title">
                    <span class="hero-title-line">GET IN TOUCH</span>
                    <span class="hero-title-line text-gradient">START YOUR PROJECT TODAY</span>
                </h1>
                <p class="hero-subtitle">
                    Connect directly with our engineering leadership to scope your next platform, discuss architecture, or request a custom proposal.
                </p>
            </div>
        </section>

        <section class="container section">
            <div class="glass-card" style="max-width: 800px; margin: 0 auto; padding: 2.5rem;">
                <h2 class="heading-section text-gradient" style="margin-bottom: 1.5rem; text-align: center;">Project Inquiry Brief</h2>
                <form id="lead-page-form" class="lead-project-form">
                    <div class="lead-form-grid">
                        <div class="form-group">
                            <label for="p-lead-name" class="form-label">Full Name *</label>
                            <input type="text" id="p-lead-name" name="name" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="p-lead-email" class="form-label">Work Email *</label>
                            <input type="email" id="p-lead-email" name="email" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="p-lead-phone" class="form-label">Phone / WhatsApp</label>
                            <input type="tel" id="p-lead-phone" name="phone" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="p-lead-company" class="form-label">Company / Brand</label>
                            <input type="text" id="p-lead-company" name="company" class="form-input">
                        </div>
                        <div class="form-group form-full">
                            <label for="p-lead-service" class="form-label">Primary Service Required *</label>
                            <select id="p-lead-service" name="service" class="form-select" required>
                                <option value="" disabled selected>Select Primary Solution</option>
                                <option value="WordPress Development">WordPress Development</option>
                                <option value="WooCommerce & E-Commerce">WooCommerce & E-Commerce</option>
                                <option value="AI Solutions & Agents">AI Solutions & Autonomous Agents</option>
                                <option value="WhatsApp Automation">WhatsApp Automation</option>
                                <option value="Business Automation">Business Automation (n8n)</option>
                                <option value="Custom Web App">Custom Web Application</option>
                            </select>
                        </div>
                        <div class="form-group form-full">
                            <label for="p-lead-message" class="form-label">Project Scope / Brief</label>
                            <textarea id="p-lead-message" name="message" class="form-textarea" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-feedback" role="alert"></div>
                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary btn-glow" style="width: 100%;">
                            Submit Inquiry & Get Proposal
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <?php
        get_template_part('template-parts/why-us');
        get_template_part('template-parts/cta');
        ?>
    </main>
    <?php
}

get_footer();
