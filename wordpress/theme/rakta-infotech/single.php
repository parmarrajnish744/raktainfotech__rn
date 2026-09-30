<?php
/**
 * Single Post / Project Template
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main">
    <div class="container section">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="section-header">
                    <div class="badge-tag" style="margin-bottom: 0.75rem;">Project & Insights</div>
                    <h1 class="heading-section text-gradient"><?php the_title(); ?></h1>
                    <div class="text-muted" style="margin-top: 0.5rem;">
                        Published on <?php echo get_the_date(); ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div style="margin-bottom: 2.5rem; border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle);">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>

                <div class="glass-card" style="line-height: 1.85; font-size: 1.05rem; color: var(--text-secondary);">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
