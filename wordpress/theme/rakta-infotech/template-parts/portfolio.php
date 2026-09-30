<?php
/**
 * Portfolio template part
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="work" class="section portfolio-section" aria-label="<?php esc_attr_e('Featured Projects', 'rakta-infotech'); ?>">
    <div class="container">
        <div class="section-header">
            <div class="badge-tag"><?php esc_html_e('Proven Results', 'rakta-infotech'); ?></div>
            <h2 class="heading-section text-gradient"><?php esc_html_e('FEATURED WORK', 'rakta-infotech'); ?></h2>
            <p class="text-muted">
                <?php esc_html_e('Real-world case studies demonstrating our engineering depth across AI, commerce, and automation.', 'rakta-infotech'); ?>
            </p>
        </div>

        <div class="projects-grid" id="projects-container">
            <!-- Dynamically populated or rendered via WordPress 'project' Custom Post Type query -->
        </div>
    </div>
</section>
