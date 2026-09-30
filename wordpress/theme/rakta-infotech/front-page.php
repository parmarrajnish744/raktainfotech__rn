<?php
/**
 * Front Page Template
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Check if page is built with Elementor
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
        <?php
        // Modular Homepage Template Parts Fallback
        get_template_part('template-parts/hero');
        get_template_part('template-parts/stats');
        get_template_part('template-parts/services');
        get_template_part('template-parts/ecosystem');
        get_template_part('template-parts/solutions');
        get_template_part('template-parts/portfolio');
        get_template_part('template-parts/process');
        get_template_part('template-parts/why-us');
        get_template_part('template-parts/cta');
        ?>
    </main>
    <?php
}

get_footer();
