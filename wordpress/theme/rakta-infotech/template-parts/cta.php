<?php
/**
 * CTA template part
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section class="section cta-section" aria-label="<?php esc_attr_e('Call to Action', 'rakta-infotech'); ?>">
    <div class="container">
        <div class="cta-box">
            <div class="badge-tag" style="margin-bottom: 1.5rem;"><?php esc_html_e('Ready to Innovate?', 'rakta-infotech'); ?></div>
            <h2 class="heading-section text-gradient"><?php esc_html_e("LET'S BUILD SOMETHING DIFFERENT.", 'rakta-infotech'); ?></h2>
            <p class="text-muted">
                <?php esc_html_e("Have an idea, enterprise requirement, or digital product in mind? Let's turn it into a high-performance working reality.", 'rakta-infotech'); ?>
            </p>
            <div class="cta-buttons">
                <button type="button" class="btn btn-primary btn-glow" data-open-lead-modal>
                    <?php esc_html_e('Start a Project', 'rakta-infotech'); ?>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
                <a href="https://wa.me/<?php echo esc_attr(get_theme_mod('rakta_whatsapp_number', '919876543210')); ?>?text=Hi%20Rakta%20Infotech%2C%20I%20would%20like%20to%20discuss%20a%20project." target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                    <?php esc_html_e('Talk to Us on WhatsApp', 'rakta-infotech'); ?>
                </a>
            </div>
        </div>
    </div>
</section>
