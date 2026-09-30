<?php
/**
 * About Us Page Template
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
        <section class="hero-section" style="min-height: 70vh;">
            <canvas id="hero-canvas" class="rakta-hero-canvas"></canvas>
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <div class="badge-tag">Architecting the Future</div>
                <h1 class="hero-title">
                    <span class="hero-title-line">WHO WE ARE</span>
                    <span class="hero-title-line text-gradient">PIONEERING 3D & AI WEB SYSTEMS</span>
                </h1>
                <p class="hero-subtitle">
                    We are an elite software engineering and digital transformation studio specializing in enterprise WordPress, immersive 3D web experiences, and autonomous AI automation.
                </p>
                <div class="hero-actions">
                    <button type="button" class="btn btn-primary btn-glow" data-open-lead-modal>Start a Project</button>
                    <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-secondary">Our Capabilities</a>
                </div>
            </div>
        </section>

        <?php
        get_template_part('template-parts/stats');
        get_template_part('template-parts/why-us');
        get_template_part('template-parts/ecosystem');
        get_template_part('template-parts/process');
        get_template_part('template-parts/cta');
        ?>
    </main>
    <?php
}

get_footer();
