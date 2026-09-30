<?php
/**
 * Hero template part
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="hero" class="hero-section" aria-label="<?php esc_attr_e('Hero Introduction', 'rakta-infotech'); ?>">
    <div class="hero-3d-container" aria-hidden="true">
        <canvas id="hero-canvas"></canvas>
    </div>

    <div class="hero-fallback" aria-hidden="true">
        <div class="hero-fallback-sphere"></div>
    </div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-brand-badge">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/rakta-icon.png'); ?>" alt="<?php bloginfo('name'); ?>" class="hero-brand-badge-icon" width="26" height="26">
                <span>Rakta Infotech &bull; Digital Experiences &amp; AI</span>
            </div>
            <div class="badge-tag"><?php esc_html_e('Powered by AI, Web & Automation', 'rakta-infotech'); ?></div>
            <h1 class="heading-hero text-gradient">
                WE BUILD<br>
                <span class="text-gradient-red">DIGITAL EXPERIENCES</span>
            </h1>
            <p class="hero-subtitle">
                <?php esc_html_e('AI-powered websites, high-converting e-commerce platforms and intelligent business automation built for modern digital enterprises.', 'rakta-infotech'); ?>
            </p>
            <div class="hero-ctas">
                <button type="button" class="btn btn-primary btn-glow" data-open-lead-modal>
                    <?php esc_html_e('Start a Project', 'rakta-infotech'); ?>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
                <a href="#work" class="btn btn-secondary">
                    <?php esc_html_e('Explore Our Work', 'rakta-infotech'); ?>
                </a>
            </div>
        </div>
    </div>
</section>
