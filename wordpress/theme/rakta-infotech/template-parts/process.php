<?php
/**
 * Process template part
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="process" class="section process-section" aria-label="<?php esc_attr_e('Development Process', 'rakta-infotech'); ?>">
    <div class="container">
        <div class="section-header">
            <div class="badge-tag"><?php esc_html_e('Predictable Delivery', 'rakta-infotech'); ?></div>
            <h2 class="heading-section text-gradient"><?php esc_html_e('FROM IDEA TO LAUNCH', 'rakta-infotech'); ?></h2>
            <p class="text-muted">
                <?php esc_html_e('A disciplined, 6-step engineering methodology engineered for speed, transparency, and flawless execution.', 'rakta-infotech'); ?>
            </p>
        </div>

        <div class="timeline-track">
            <div class="timeline-line" aria-hidden="true">
                <div class="timeline-line-fill"></div>
            </div>

            <div id="process-steps-container">
                <!-- Timeline steps injected dynamically or through Gutenberg block -->
            </div>
        </div>
    </div>
</section>
