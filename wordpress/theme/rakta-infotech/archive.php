<?php
/**
 * Archive Template
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
        <header class="section-header">
            <h1 class="heading-section text-gradient"><?php the_archive_title(); ?></h1>
            <div class="text-muted"><?php the_archive_description(); ?></div>
        </header>

        <div class="projects-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('glass-card project-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="project-media-wrap">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </div>
                        <?php endif; ?>
                        <h2 class="heading-card" style="margin-bottom: 0.75rem;">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p class="text-muted" style="font-size: 0.9rem;"><?php the_excerpt(); ?></p>
                    </article>
                    <?php
                endwhile;
                the_posts_navigation();
            else :
                ?>
                <p class="text-muted"><?php esc_html_e('No entries found.', 'rakta-infotech'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
