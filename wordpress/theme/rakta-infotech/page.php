<?php
/**
 * Generic Page Template
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
?>

<main id="primary" class="site-main <?php echo $is_elementor ? 'rakta-elementor-page' : ''; ?>">
    <?php if ($is_elementor) : ?>
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    <?php else : ?>
        <div class="container section">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="section-header">
                        <h1 class="heading-section text-gradient"><?php the_title(); ?></h1>
                    </header>

                    <div class="glass-card" style="line-height: 1.8; color: var(--text-secondary);">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();
