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
?>

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

<?php
get_footer();
