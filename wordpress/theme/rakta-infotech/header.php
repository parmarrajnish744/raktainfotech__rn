<?php
/**
 * Theme Header
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php if (!has_site_icon()) : ?>
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.svg'); ?>">
    <link rel="icon" type="image/png" sizes="64x64" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/apple-touch-icon.png'); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Full-Viewport Interactive Cyber Grid & Cursor Lightfield Canvas -->
<canvas id="bg-interactive-canvas"></canvas>

<header class="site-header" role="banner">
    <div class="container header-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" rel="home">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/rakta-logo-nav.png'); ?>" alt="<?php bloginfo('name'); ?>" class="brand-logo-img" width="180" height="42">
        </a>

        <nav class="nav-desktop" aria-label="<?php esc_attr_e('Primary Navigation', 'rakta-infotech'); ?>">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                ]);
            } else {
                ?>
                <a href="#hero" class="nav-link">Home</a>
                <a href="#services" class="nav-link">Services</a>
                <a href="#ecosystem" class="nav-link">Ecosystem</a>
                <a href="#solutions" class="nav-link">Solutions</a>
                <a href="#work" class="nav-link">Work</a>
                <a href="#process" class="nav-link">Process</a>
                <a href="#why-us" class="nav-link">Why Us</a>
                <a href="#tech" class="nav-link">Tech</a>
                <?php
            }
            ?>
        </nav>

        <div class="header-cta">
            <button type="button" class="btn btn-primary btn-glow" data-open-lead-modal>
                <?php esc_html_e('Start a Project', 'rakta-infotech'); ?>
            </button>
        </div>

        <button type="button" class="mobile-menu-btn" aria-label="<?php esc_attr_e('Toggle mobile menu', 'rakta-infotech'); ?>" aria-expanded="false">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div class="mobile-nav-drawer" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Mobile Navigation', 'rakta-infotech'); ?>">
    <nav class="mobile-nav-links">
        <a href="#hero" class="mobile-nav-link">Home</a>
        <a href="#services" class="mobile-nav-link">Services</a>
        <a href="#ecosystem" class="mobile-nav-link">Ecosystem</a>
        <a href="#solutions" class="mobile-nav-link">Solutions</a>
        <a href="#work" class="mobile-nav-link">Work</a>
        <a href="#process" class="mobile-nav-link">Process</a>
        <a href="#why-us" class="mobile-nav-link">Why Us</a>
        <a href="#tech" class="mobile-nav-link">Tech</a>
    </nav>
    <button type="button" class="btn btn-primary btn-glow" style="width: 100%;" data-open-lead-modal>
        <?php esc_html_e('Start a Project', 'rakta-infotech'); ?>
    </button>
</div>

<main id="primary" class="site-main">
