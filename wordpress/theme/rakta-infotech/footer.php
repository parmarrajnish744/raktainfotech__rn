<?php
/**
 * Theme Footer
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
</div><!-- #content -->

<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" style="margin-bottom: 1.25rem;">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/rakta-logo-dark.png'); ?>" alt="<?php bloginfo('name'); ?>" class="footer-logo-img" width="190" height="48">
                </a>
                <p>
                    <?php esc_html_e('Digital Experiences Powered by AI, Web & Automation. Enterprise WordPress engineering and intelligent workflows.', 'rakta-infotech'); ?>
                </p>
                <div style="font-size: 0.8rem; color: var(--text-muted);">
                    <?php esc_html_e('BUILD. AUTOMATE. GROW.', 'rakta-infotech'); ?>
                </div>
            </div>

            <div class="footer-col">
                <h4 class="footer-col-title"><?php esc_html_e('Navigation', 'rakta-infotech'); ?></h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>" class="footer-link"><?php esc_html_e('Home', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>" class="footer-link"><?php esc_html_e('About Us', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" class="footer-link"><?php esc_html_e('Services', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="footer-link"><?php esc_html_e('Portfolio', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="footer-link"><?php esc_html_e('Blog', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>" class="footer-link"><?php esc_html_e('Contact Us', 'rakta-infotech'); ?></a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-col-title"><?php esc_html_e('Services', 'rakta-infotech'); ?></h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" class="footer-link"><?php esc_html_e('WordPress Development', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" class="footer-link"><?php esc_html_e('WooCommerce Stores', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" class="footer-link"><?php esc_html_e('AI Solutions & Agents', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" class="footer-link"><?php esc_html_e('WhatsApp Automation', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" class="footer-link"><?php esc_html_e('Business Automation', 'rakta-infotech'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" class="footer-link"><?php esc_html_e('Custom Web Apps', 'rakta-infotech'); ?></a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-col-title"><?php esc_html_e('Connect', 'rakta-infotech'); ?></h4>
                <ul class="footer-links">
                    <li><span style="color: var(--text-muted);">Email:</span> <a href="mailto:<?php echo esc_attr(get_theme_mod('rakta_contact_email', 'contact@raktainfotech.com')); ?>" class="footer-link"><?php echo esc_html(get_theme_mod('rakta_contact_email', 'contact@raktainfotech.com')); ?></a></li>
                    <li><span style="color: var(--text-muted);">Phone:</span> <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_theme_mod('rakta_contact_phone', '+919876543210'))); ?>" class="footer-link"><?php echo esc_html(get_theme_mod('rakta_contact_phone', '+91 98765 43210')); ?></a></li>
                    <li><span style="color: var(--text-muted);">HQ:</span> Silicon Hub, Tech City, India</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div>&copy; <?php echo date('Y'); ?> <?php esc_html_e('Rakta Infotech. All Rights Reserved.', 'rakta-infotech'); ?></div>
            <div class="footer-legal-links">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-link"><?php esc_html_e('Privacy Policy', 'rakta-infotech'); ?></a>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-link"><?php esc_html_e('Terms & Conditions', 'rakta-infotech'); ?></a>
                <a href="#top" class="footer-link" style="color: var(--red-bright);" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;"><?php esc_html_e('Back to Top ↑', 'rakta-infotech'); ?></a>
            </div>
        </div>
    </div>
</footer>

<!-- Lead Generation Modal (<dialog>) -->
<dialog class="lead-modal" aria-labelledby="modal-heading">
    <div class="modal-header">
        <div>
            <div class="badge-tag" style="margin-bottom: 0.5rem;"><?php esc_html_e('Project Inquiry', 'rakta-infotech'); ?></div>
            <h3 id="modal-heading" class="heading-card"><?php esc_html_e('Start a Project with Rakta Infotech', 'rakta-infotech'); ?></h3>
        </div>
        <button type="button" class="modal-close-btn" aria-label="<?php esc_attr_e('Close dialog', 'rakta-infotech'); ?>">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <div class="modal-body">
        <form id="lead-project-form">
            <div class="lead-form-grid">
                <div class="form-group">
                    <label for="lead-name" class="form-label"><?php esc_html_e('Full Name *', 'rakta-infotech'); ?></label>
                    <input type="text" id="lead-name" name="name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="lead-email" class="form-label"><?php esc_html_e('Work Email *', 'rakta-infotech'); ?></label>
                    <input type="email" id="lead-email" name="email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="lead-phone" class="form-label"><?php esc_html_e('Phone / WhatsApp', 'rakta-infotech'); ?></label>
                    <input type="tel" id="lead-phone" name="phone" class="form-input">
                </div>
                <div class="form-group">
                    <label for="lead-company" class="form-label"><?php esc_html_e('Company / Brand', 'rakta-infotech'); ?></label>
                    <input type="text" id="lead-company" name="company" class="form-input">
                </div>
                <div class="form-group form-full">
                    <label for="lead-service" class="form-label"><?php esc_html_e('Service Required *', 'rakta-infotech'); ?></label>
                    <select id="lead-service" name="service" class="form-select" required>
                        <option value="" disabled selected><?php esc_html_e('Select Primary Solution', 'rakta-infotech'); ?></option>
                        <option value="WordPress Development">WordPress Development</option>
                        <option value="WooCommerce & E-Commerce">WooCommerce & E-Commerce</option>
                        <option value="AI Solutions & Agents">AI Solutions & Autonomous Agents</option>
                        <option value="WhatsApp Automation">WhatsApp Automation</option>
                        <option value="Business Automation">Business Automation (n8n)</option>
                        <option value="Custom Web App">Custom Web Application</option>
                    </select>
                </div>
                <div class="form-group form-full">
                    <label class="form-label"><?php esc_html_e('Estimated Budget Range', 'rakta-infotech'); ?></label>
                    <div class="budget-pills">
                        <label class="budget-pill-label"><input type="radio" name="budget" value="< $2,500"><span class="budget-pill-text">&lt; $2,500</span></label>
                        <label class="budget-pill-label"><input type="radio" name="budget" value="$2,500 - $5,000" checked><span class="budget-pill-text">$2,500 – $5,000</span></label>
                        <label class="budget-pill-label"><input type="radio" name="budget" value="$5,000 - $10,000"><span class="budget-pill-text">$5,000 – $10,000</span></label>
                        <label class="budget-pill-label"><input type="radio" name="budget" value="$10,000+"><span class="budget-pill-text">$10,000+ Enterprise</span></label>
                    </div>
                </div>
                <div class="form-group form-full">
                    <label for="lead-message" class="form-label"><?php esc_html_e('Project Brief', 'rakta-infotech'); ?></label>
                    <textarea id="lead-message" name="message" class="form-textarea"></textarea>
                </div>
            </div>

            <div class="form-feedback" role="alert"></div>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary btn-glow" style="width: 100%;">
                    <?php esc_html_e('Start My Project', 'rakta-infotech'); ?>
                </button>
            </div>
        </form>
    </div>
</dialog>

<?php wp_footer(); ?>
</body>
</html>
