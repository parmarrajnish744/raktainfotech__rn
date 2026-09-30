<?php
/**
 * 3D Ecosystem template part
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="ecosystem" class="section ecosystem-section" aria-label="<?php esc_attr_e('Interactive 3D Technology Ecosystem', 'rakta-infotech'); ?>">
    <div class="container">
        <div class="section-header">
            <div class="badge-tag"><?php esc_html_e('Live 3D Ecosystem', 'rakta-infotech'); ?></div>
            <h2 class="heading-section text-gradient"><?php esc_html_e('TECHNOLOGY THAT MOVES WITH YOU', 'rakta-infotech'); ?></h2>
            <p class="text-muted">
                <?php esc_html_e('Hover over the orbital nodes to see our integrated technology matrix synchronize in real time.', 'rakta-infotech'); ?>
            </p>
        </div>

        <div class="ecosystem-wrapper">
            <div class="ecosystem-canvas-container" aria-hidden="true">
                <canvas id="ecosystem-canvas"></canvas>
            </div>

            <div class="ecosystem-interactive-column">
                <div class="ecosystem-nodes-grid" id="ecosystem-nodes-container">
                    <!-- Populated by Rakta 3D Plugin -->
                </div>

                <div class="node-detail-panel" aria-live="polite">
                    <h3 class="detail-title"><?php esc_html_e('Autonomous AI Intelligence', 'rakta-infotech'); ?></h3>
                    <p class="detail-desc text-muted">
                        <?php esc_html_e('Multi-agent systems, tailored RAG architectures, and fine-tuned LLMs running seamlessly across customer touchpoints.', 'rakta-infotech'); ?>
                    </p>
                    <div class="detail-stats"><?php esc_html_e('Sub-500ms inference • Secure private data isolation', 'rakta-infotech'); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
