<?php
/**
 * Rakta Infotech - TGM Plugin Activation Configuration
 *
 * Configures required and recommended plugins for Theme functionality,
 * 100% Speed Optimization, and #1 Google SEO Ranking.
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once RAKTA_THEME_DIR . '/inc/class-tgm-plugin-activation.php';

function rakta_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = [
        // =====================================================================
        // 1. MANDATORY THEME CORE & 3D PLUGINS
        // =====================================================================
        [
            'name'               => esc_html__('Elementor Page Builder', 'rakta-infotech'),
            'slug'               => 'elementor',
            'required'           => true,
            'version'            => '3.20.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ],
        [
            'name'               => esc_html__('Rakta Core (CPTs, REST Leads CRM & Shortcodes)', 'rakta-infotech'),
            'slug'               => 'rakta-core',
            'source'             => RAKTA_THEME_DIR . '/inc/plugins/rakta-core.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ],
        [
            'name'               => esc_html__('Rakta 3D Engine (Three.js WebGL & Elementor Widgets)', 'rakta-infotech'),
            'slug'               => 'rakta-3d-engine',
            'source'             => RAKTA_THEME_DIR . '/inc/plugins/rakta-3d-engine.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ],

        // =====================================================================
        // 2. PLUGINS FOR #1 GOOGLE SEO RANKING & RICH SNIPPETS
        // =====================================================================
        [
            'name'     => esc_html__('Rank Math SEO (Top Recommendation for #1 Google Ranking & Rich Snippets)', 'rakta-infotech'),
            'slug'     => 'seo-by-rank-math',
            'required' => false,
        ],
        [
            'name'     => esc_html__('Instant Indexing for Google (Fast 5-Min Google Crawling & Indexing)', 'rakta-infotech'),
            'slug'     => 'fast-indexing-api',
            'required' => false,
        ],

        // =====================================================================
        // 3. PLUGINS FOR 95+ CORE WEB VITALS SPEED & OPTIMIZATION
        // =====================================================================
        [
            'name'     => esc_html__('LiteSpeed Cache (High-Performance Caching & CWV Optimization)', 'rakta-infotech'),
            'slug'     => 'litespeed-cache',
            'required' => false,
        ],
        [
            'name'     => esc_html__('Converter for Media (Next-Gen WebP/AVIF Automated Image Compression)', 'rakta-infotech'),
            'slug'     => 'webp-converter-for-media',
            'required' => false,
        ],

        // =====================================================================
        // 4. PLUGINS FOR HIGH CONVERSIONS, FORMS & SECURITY
        // =====================================================================
        [
            'name'     => esc_html__('Fluent Forms (Fast Lead Generation, Project Inquiries & Anti-Spam)', 'rakta-infotech'),
            'slug'     => 'fluentform',
            'required' => false,
        ],
    ];

    /*
     * Array of configuration settings.
     */
    $config = [
        'id'           => 'rakta-infotech',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
        'strings'      => [
            'page_title'                      => esc_html__('Install Required & Recommended Plugins', 'rakta-infotech'),
            'menu_title'                      => esc_html__('Theme Plugins', 'rakta-infotech'),
            'installing'                      => esc_html__('Installing Plugin: %s', 'rakta-infotech'),
            'updating'                        => esc_html__('Updating Plugin: %s', 'rakta-infotech'),
            'oops'                            => esc_html__('Something went wrong with the plugin API.', 'rakta-infotech'),
            'notice_can_install_required'     => _n_noop(
                '⚡ Rakta Infotech Theme requires the following plugin: %1$s.',
                '⚡ Rakta Infotech Theme requires the following plugins: %1$s.',
                'rakta-infotech'
            ),
            'notice_can_install_recommended' => _n_noop(
                '🚀 For Top Google Ranking (#1 SEO) and Maximum Speed Optimization, this theme recommends: %1$s.',
                '🚀 For Top Google Ranking (#1 SEO) and Maximum Speed Optimization, this theme recommends: %1$s.',
                'rakta-infotech'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version: %1$s.',
                'The following plugins need to be updated to their latest version: %1$s.',
                'rakta-infotech'
            ),
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'rakta-infotech'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'rakta-infotech'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'rakta-infotech'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'rakta-infotech'
            ),
            'return'                          => esc_html__('Return to Required Plugins Installer', 'rakta-infotech'),
            'plugin_activated'                 => esc_html__('Plugin activated successfully.', 'rakta-infotech'),
            'activated_successfully'          => esc_html__('The following plugin was activated successfully:', 'rakta-infotech'),
            'plugin_already_active'           => esc_html__('No action taken. Plugin %1$s was already active.', 'rakta-infotech'),
            'complete'                        => esc_html__('All plugins installed and activated successfully. %1$s', 'rakta-infotech'),
            'dismiss'                         => esc_html__('Dismiss this notice', 'rakta-infotech'),
            'notice_cannot_install_activate'  => esc_html__('There are one or more required or recommended plugins to install, update or activate.', 'rakta-infotech'),
            'contact_admin'                   => esc_html__('Please contact the administrator of this site for help.', 'rakta-infotech'),
            'nag_type'                        => 'updated',
        ],
    ];

    tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'rakta_register_required_plugins');
