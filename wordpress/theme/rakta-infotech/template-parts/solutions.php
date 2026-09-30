<?php
/**
 * Solutions template part
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="solutions" class="section solutions-section" aria-label="<?php esc_attr_e('Enterprise Solutions', 'rakta-infotech'); ?>">
    <div class="container">
        <div class="section-header">
            <div class="badge-tag"><?php esc_html_e('End-to-End Capabilities', 'rakta-infotech'); ?></div>
            <h2 class="heading-section text-gradient"><?php esc_html_e('ENGINEERED FOR MODERN BUSINESS', 'rakta-infotech'); ?></h2>
            <p class="text-muted">
                <?php esc_html_e('Explore our targeted solutions built for measurable growth, streamlined workflows, and high performance.', 'rakta-infotech'); ?>
            </p>
        </div>

        <div class="solutions-nav" role="tablist">
            <button type="button" class="solution-tab-btn active" role="tab" data-tab="ai" aria-selected="true"><?php esc_html_e('AI Solutions', 'rakta-infotech'); ?></button>
            <button type="button" class="solution-tab-btn" role="tab" data-tab="web" aria-selected="false"><?php esc_html_e('Web Solutions', 'rakta-infotech'); ?></button>
            <button type="button" class="solution-tab-btn" role="tab" data-tab="commerce" aria-selected="false"><?php esc_html_e('Commerce & Retail', 'rakta-infotech'); ?></button>
            <button type="button" class="solution-tab-btn" role="tab" data-tab="automation" aria-selected="false"><?php esc_html_e('Business Automation', 'rakta-infotech'); ?></button>
        </div>

        <div id="solutions-panels-container">
            <!-- Injected dynamically or rendered via WordPress Custom Post Types -->
        </div>
    </div>
</section>
