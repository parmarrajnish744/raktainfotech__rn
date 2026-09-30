<?php
/**
 * Template Name: Elementor Full Width
 * Template Post Type: post, page
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
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
get_footer();
