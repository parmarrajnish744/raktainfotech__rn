<?php
/**
 * Rakta Infotech Automated 3D Elementor Page & Demo Setup Engine
 *
 * Automatically creates and configures all 3D website pages in Elementor
 * upon theme activation or 1-click admin action. Zero manual JSON importing required.
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Hook into theme activation
 */
function rakta_after_theme_switch() {
    // Only auto-run if not previously completed
    if (!get_option('rakta_demo_pages_installed')) {
        rakta_auto_setup_pages_and_content(false);
    }
}
add_action('after_switch_theme', 'rakta_after_theme_switch');

/**
 * Register Admin Menu under Appearance > 3D Theme Setup
 */
function rakta_register_admin_setup_page() {
    add_theme_page(
        esc_html__('3D Theme Setup', 'rakta-infotech'),
        esc_html__('3D Theme Setup', 'rakta-infotech'),
        'manage_options',
        'rakta-3d-setup',
        'rakta_render_admin_setup_page'
    );
}
add_action('admin_menu', 'rakta_register_admin_setup_page');

/**
 * Admin action to trigger 1-click setup / reset
 */
function rakta_handle_admin_setup_action() {
    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('Unauthorized access.', 'rakta-infotech'));
    }

    check_admin_referer('rakta_setup_action_nonce', 'rakta_nonce');

    rakta_auto_setup_pages_and_content(true);

    wp_safe_redirect(add_query_arg([
        'page'    => 'rakta-3d-setup',
        'success' => '1',
    ], admin_url('themes.php')));
    exit;
}
add_action('admin_post_rakta_install_demo_pages', 'rakta_handle_admin_setup_action');

/**
 * Admin Setup Notice
 */
function rakta_admin_setup_notice() {
    $screen = get_current_screen();
    if ($screen && $screen->id === 'appearance_page_rakta-3d-setup') {
        return;
    }

    $is_installed = get_option('rakta_demo_pages_installed');
    if (!$is_installed) {
        ?>
        <div class="notice notice-info is-dismissible" style="border-left-color: #00F0FF; padding: 12px 16px;">
            <p style="font-size: 14px; margin: 0 0 8px;">
                <strong>⚡ Rakta Infotech 3D Theme:</strong> You are 1 click away from setting up all pre-built 3D Elementor pages (Home, About, Services, Portfolio, Contact, Blog)!
            </p>
            <p style="margin: 0;">
                <a href="<?php echo esc_url(admin_url('themes.php?page=rakta-3d-setup')); ?>" class="button button-primary" style="background: #0066FF; border-color: #0055DD;">
                    <?php esc_html_e('Open 1-Click 3D Theme Setup', 'rakta-infotech'); ?>
                </a>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'rakta_admin_setup_notice');

/**
 * Render the Admin Setup Page
 */
function rakta_render_admin_setup_page() {
    $is_installed = get_option('rakta_demo_pages_installed');
    $success = isset($_GET['success']);
    ?>
    <div class="wrap" style="max-width: 900px; margin-top: 20px;">
        <div style="background: #060B18; color: #FFFFFF; padding: 30px; border-radius: 12px; border: 1px solid rgba(0, 240, 255, 0.2); box-shadow: 0 10px 30px rgba(0,0,0,0.4);">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <span style="display: inline-block; width: 14px; height: 14px; border-radius: 50%; background: #00F0FF; box-shadow: 0 0 12px #00F0FF;"></span>
                <h1 style="color: #FFFFFF; margin: 0; font-size: 26px; font-weight: 700; letter-spacing: -0.5px;">
                    Rakta Infotech — 3D Elementor Automated Setup
                </h1>
            </div>

            <?php if ($success) : ?>
                <div style="background: rgba(0, 255, 128, 0.15); border: 1px solid #00FF80; color: #00FF80; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                    ✓ All 3D Elementor Pages, Menus, and Sample CPTs have been generated successfully!
                </div>
            <?php endif; ?>

            <p style="color: #94A3B8; font-size: 15px; line-height: 1.6; margin-bottom: 24px;">
                Zero manual JSON template imports required! This automated engine programmatically generates all 6 core pages
                (<strong>Home</strong>, <strong>About Us</strong>, <strong>Services</strong>, <strong>Portfolio</strong>, <strong>Contact Us</strong>, and <strong>Blog</strong>),
                pre-populates their full 3D interactive Elementor builder data, sets the Homepage and Blog display options, and assigns the Primary Navigation Menu.
            </p>

            <div style="background: rgba(255, 255, 255, 0.04); border-radius: 8px; padding: 20px; margin-bottom: 25px; border: 1px solid rgba(255,255,255,0.08);">
                <h3 style="color: #00F0FF; margin-top: 0; font-size: 16px;">What Gets Automatically Configured:</h3>
                <ul style="color: #CBD5E1; line-height: 1.8; margin-bottom: 0;">
                    <li>✓ <strong>Home Page:</strong> Complete 10-section 3D experience with Three.js Hero Core, 3D Ecosystem, Services & Portfolio.</li>
                    <li>✓ <strong>About Us Page:</strong> 3D particle hero, milestones counter, engineering values & team showcase.</li>
                    <li>✓ <strong>Services Page:</strong> 3D hero, detailed 6-service grid, solutions matrix & delivery timeline.</li>
                    <li>✓ <strong>Portfolio Page:</strong> 3D hero, filterable project case studies with 3D tilt effects & ROI benchmarks.</li>
                    <li>✓ <strong>Contact Us Page:</strong> 3D hero, interactive project proposal form, office coordinates & FAQs.</li>
                    <li>✓ <strong>Blog Page:</strong> Configured as your official WordPress Posts page.</li>
                    <li>✓ <strong>Primary Navigation Menu:</strong> Automatically linked and assigned to Header & Footer.</li>
                    <li>✓ <strong>Sample Data:</strong> Seeded Custom Post Types for Services and Portfolio projects.</li>
                </ul>
            </div>

            <!-- Required & Recommended Plugins Status Panel -->
            <div style="background: rgba(255, 255, 255, 0.04); border-radius: 8px; padding: 20px; margin-bottom: 25px; border: 1px solid rgba(0, 240, 255, 0.25);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                    <h3 style="color: #00F0FF; margin: 0; font-size: 17px; display: flex; align-items: center; gap: 8px;">
                        <span>🧩</span> Required Plugins & Optimization Ecosystem
                    </h3>
                    <a href="<?php echo esc_url(admin_url('themes.php?page=tgmpa-install-plugins')); ?>" class="button button-primary" style="background: #00F0FF; color: #040711; font-weight: 700; border: none; box-shadow: 0 0 10px rgba(0, 240, 255, 0.4);">
                        ⚡ 1-Click Install / Activate All Plugins (TGMPA)
                    </a>
                </div>

                <p style="color: #94A3B8; font-size: 13.5px; margin-top: 0; margin-bottom: 16px;">
                    To achieve <strong>100% Mobile Responsiveness</strong>, <strong>95+ PageSpeed Optimization</strong>, and <strong>Top #1 Google Ranking</strong>, ensure these plugins are active:
                </p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 12px;">
                    <?php
                    $check_plugins = [
                        [
                            'name'     => 'Elementor Page Builder',
                            'badge'    => 'REQUIRED',
                            'role'     => '3D Visual Page Builder & Layouts',
                            'active'   => did_action('elementor/loaded') || class_exists('\Elementor\Plugin'),
                            'install'  => admin_url('plugin-install.php?tab=plugin-information&plugin=elementor'),
                        ],
                        [
                            'name'     => 'Rakta Core',
                            'badge'    => 'REQUIRED',
                            'role'     => 'CPTs, REST Leads CRM & Shortcodes',
                            'active'   => class_exists('Rakta_Core') || defined('RAKTA_CORE_VERSION'),
                            'install'  => admin_url('themes.php?page=tgmpa-install-plugins'),
                        ],
                        [
                            'name'     => 'Rakta 3D Engine',
                            'badge'    => 'REQUIRED',
                            'role'     => 'Three.js WebGL Core & Elementor 3D Widgets',
                            'active'   => defined('RAKTA_3D_ENGINE_VERSION') || class_exists('Rakta_3D_Engine'),
                            'install'  => admin_url('themes.php?page=tgmpa-install-plugins'),
                        ],
                        [
                            'name'     => 'Rank Math SEO',
                            'badge'    => 'TOP RANKING #1',
                            'role'     => 'Google Schema JSON-LD, XML Sitemaps & Rich Snippets',
                            'active'   => defined('RANK_MATH_VERSION') || class_exists('RankMath'),
                            'install'  => admin_url('plugin-install.php?tab=plugin-information&plugin=seo-by-rank-math'),
                        ],
                        [
                            'name'     => 'LiteSpeed / WP Cache',
                            'badge'    => 'SPEED 95+',
                            'role'     => 'Full Page Caching, Critical CSS & Core Web Vitals',
                            'active'   => defined('LSCWP_V') || defined('W3TC') || defined('WP_ROCKET_VERSION'),
                            'install'  => admin_url('plugin-install.php?tab=plugin-information&plugin=litespeed-cache'),
                        ],
                        [
                            'name'     => 'Converter for Media',
                            'badge'    => 'IMAGE OPTIMIZER',
                            'role'     => 'Automated Next-Gen WebP/AVIF Image Compression',
                            'active'   => defined('WEBPC_VERSION'),
                            'install'  => admin_url('plugin-install.php?tab=plugin-information&plugin=webp-converter-for-media'),
                        ],
                        [
                            'name'     => 'Fluent Forms',
                            'badge'    => 'LEAD CAPTURE',
                            'role'     => 'High-Converting Proposal Forms & Anti-Spam Turnstile',
                            'active'   => defined('FLUENTFORM') || function_exists('wpFluentForm'),
                            'install'  => admin_url('plugin-install.php?tab=plugin-information&plugin=fluentform'),
                        ],
                    ];

                    foreach ($check_plugins as $p) {
                        $is_active = $p['active'];
                        ?>
                        <div style="background: rgba(0, 0, 0, 0.4); border: 1px solid <?php echo $is_active ? 'rgba(0, 255, 128, 0.3)' : 'rgba(255, 255, 255, 0.1)'; ?>; border-radius: 6px; padding: 12px; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 4px;">
                                    <strong style="color: #FFFFFF; font-size: 14px;"><?php echo esc_html($p['name']); ?></strong>
                                    <span style="font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 4px; background: <?php echo strpos($p['badge'], 'REQ') !== false ? 'rgba(0, 102, 255, 0.3)' : 'rgba(0, 240, 255, 0.2)'; ?>; color: <?php echo strpos($p['badge'], 'REQ') !== false ? '#38BDF8' : '#00F0FF'; ?>;">
                                        <?php echo esc_html($p['badge']); ?>
                                    </span>
                                </div>
                                <div style="color: #94A3B8; font-size: 12px; margin-bottom: 8px;">
                                    <?php echo esc_html($p['role']); ?>
                                </div>
                            </div>
                            <div>
                                <?php if ($is_active) : ?>
                                    <span style="color: #00FF80; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                        ✓ Active & Optimized
                                    </span>
                                <?php else : ?>
                                    <a href="<?php echo esc_url($p['install']); ?>" style="color: #00F0FF; font-size: 12px; text-decoration: underline; font-weight: 500;">
                                        Install / Activate →
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="rakta_install_demo_pages">
                <?php wp_nonce_field('rakta_setup_action_nonce', 'rakta_nonce'); ?>

                <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                    <button type="submit" class="button button-primary button-hero" style="background: linear-gradient(135deg, #0066FF, #00F0FF); border: none; font-weight: 700; color: #000; padding: 12px 28px; border-radius: 6px; box-shadow: 0 4px 15px rgba(0, 240, 255, 0.4); cursor: pointer;">
                        ⚡ <?php echo $is_installed ? esc_html__('Re-Generate / Reset All 3D Pages', 'rakta-infotech') : esc_html__('1-Click Auto Setup All 3D Pages', 'rakta-infotech'); ?>
                    </button>

                    <?php if ($is_installed) : ?>
                        <a href="<?php echo esc_url(admin_url('edit.php?post_type=page')); ?>" class="button button-secondary button-hero" style="color: #FFFFFF; background: transparent; border: 1px solid rgba(255,255,255,0.3);">
                            <?php esc_html_e('View & Edit Pages in Elementor →', 'rakta-infotech'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <?php
}

/**
 * Main Setup Function: Programmatically Creates Pages, Menu, CPTs, and Settings
 *
 * @param bool $force Force recreate/update even if already installed
 */
function rakta_auto_setup_pages_and_content($force = false) {
    // 1. Ensure CPTs are registered
    rakta_theme_register_cpts();

    // 2. Pre-seed Sample Services
    rakta_seed_sample_services($force);

    // 3. Pre-seed Sample Projects
    rakta_seed_sample_projects($force);

    // 4. Create and Configure Pages
    $pages_config = [
        'home' => [
            'title'     => 'Home',
            'slug'      => 'home',
            'json_file' => 'page-home.json',
        ],
        'about' => [
            'title'     => 'About Us',
            'slug'      => 'about',
            'json_file' => 'page-about.json',
        ],
        'services' => [
            'title'     => 'Services',
            'slug'      => 'services',
            'json_file' => 'page-services.json',
        ],
        'portfolio' => [
            'title'     => 'Portfolio',
            'slug'      => 'portfolio',
            'json_file' => 'page-portfolio.json',
        ],
        'contact' => [
            'title'     => 'Contact Us',
            'slug'      => 'contact',
            'json_file' => 'page-contact.json',
        ],
        'blog' => [
            'title'     => 'Blog',
            'slug'      => 'blog',
            'json_file' => null, // Standard archive
        ],
    ];

    $created_page_ids = [];
    $demo_dir = get_template_directory() . '/inc/demo-data/';

    foreach ($pages_config as $key => $config) {
        $existing = get_page_by_path($config['slug'], OBJECT, 'page');

        if (!$existing) {
            $page_id = wp_insert_post([
                'post_title'     => $config['title'],
                'post_name'      => $config['slug'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
            ]);
        } else {
            $page_id = $existing->ID;
            if ($force) {
                wp_update_post([
                    'ID'          => $page_id,
                    'post_title'  => $config['title'],
                    'post_status' => 'publish',
                ]);
            }
        }

        if ($page_id && !is_wp_error($page_id)) {
            $created_page_ids[$key] = $page_id;

            // If page has Elementor JSON data
            if (!empty($config['json_file'])) {
                $json_path = $demo_dir . $config['json_file'];
                if (file_exists($json_path)) {
                    $json_raw = file_get_contents($json_path);
                    $json_data = json_decode($json_raw, true);

                    if ($json_data && isset($json_data['content'])) {
                        rakta_sanitize_elementor_columns($json_data['content']);

                        // Set Page Template
                        update_post_meta($page_id, '_wp_page_template', 'templates/template-elementor-fullwidth.php');

                        // Set Elementor Builder Meta
                        update_post_meta($page_id, '_elementor_edit_mode', 'builder');
                        update_post_meta($page_id, '_elementor_version', '3.20.0');
                        update_post_meta($page_id, '_elementor_template_type', 'wp-page');

                        // Save Elementor Data (wp_slash required for stringified JSON in post meta)
                        $elementor_data = wp_slash(json_encode($json_data['content']));
                        update_post_meta($page_id, '_elementor_data', $elementor_data);
                    }
                }
            }
        }
    }

    // 5. Configure WordPress Reading Settings
    if (!empty($created_page_ids['home'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $created_page_ids['home']);
    }

    if (!empty($created_page_ids['blog'])) {
        update_option('page_for_posts', $created_page_ids['blog']);
    }

    // 6. Automatically Create & Assign Primary Navigation Menu
    rakta_setup_primary_menu($created_page_ids);

    // 7. Mark demo installed & flush rewrite rules
    update_option('rakta_demo_pages_installed', time());
    flush_rewrite_rules(false);
}

/**
 * Create Primary Menu and Assign Locations
 */
function rakta_setup_primary_menu($page_ids) {
    $menu_name = 'Rakta Primary Menu';
    $menu_obj  = wp_get_nav_menu_object($menu_name);

    if (!$menu_obj) {
        $menu_id = wp_create_nav_menu($menu_name);
    } else {
        $menu_id = $menu_obj->term_id;
    }

    if ($menu_id && !is_wp_error($menu_id)) {
        // Clear existing items if we created or re-running
        $existing_items = wp_get_nav_menu_items($menu_id);
        if (empty($existing_items)) {
            $menu_order = 1;
            $items = [
                'home'      => 'Home',
                'about'     => 'About Us',
                'services'  => 'Services',
                'portfolio' => 'Portfolio',
                'blog'      => 'Blog',
                'contact'   => 'Contact Us',
            ];

            foreach ($items as $slug => $label) {
                if (!empty($page_ids[$slug])) {
                    wp_update_nav_menu_item($menu_id, 0, [
                        'menu-item-title'     => $label,
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $page_ids[$slug],
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                        'menu-item-position'  => $menu_order++,
                    ]);
                }
            }
        }

        // Assign to theme menu locations
        $locations = get_theme_mod('nav_menu_locations');
        if (!is_array($locations)) {
            $locations = [];
        }
        $locations['primary'] = $menu_id;
        $locations['footer']  = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}

/**
 * Pre-seed Sample Services
 */
function rakta_seed_sample_services($force = false) {
    $sample_services = [
        [
            'title'   => 'Custom WordPress & Enterprise Engineering',
            'excerpt' => 'High-performance bespoke theme engineering, scalable architectures, and sub-second load times tailored for high-traffic enterprises.',
            'type'    => 'WordPress',
        ],
        [
            'title'   => 'Autonomous AI Agents & Intelligent Automation',
            'excerpt' => 'Custom AI chatbots, autonomous customer support agents, and predictive machine learning models integrated directly into your workflows.',
            'type'    => 'AI Solutions',
        ],
        [
            'title'   => 'High-Converting WooCommerce & E-Commerce',
            'excerpt' => 'Custom 3D product visualizers, 1-click checkout funnels, and enterprise ERP integrations engineered for maximum conversion velocity.',
            'type'    => 'E-Commerce',
        ],
        [
            'title'   => 'Business Automation & n8n Workflow Pipelines',
            'excerpt' => 'Autonomous data bridges, CRM synchronization, invoice automation, and multi-platform event triggers saving hundreds of hours weekly.',
            'type'    => 'Automation',
        ],
        [
            'title'   => 'WhatsApp Business Automation & AI Chatbots',
            'excerpt' => 'Official WhatsApp Cloud API integrations with 24/7 conversational AI agents, order tracking, and broadcast marketing automation.',
            'type'    => 'Automation',
        ],
        [
            'title'   => 'Custom Web Applications (React / Three.js / Next.js)',
            'excerpt' => 'Immersive WebGL 3D interfaces, interactive SaaS dashboards, and headless web platforms delivering jaw-dropping user experiences.',
            'type'    => 'Web Apps',
        ],
    ];

    foreach ($sample_services as $svc) {
        $existing = get_page_by_title($svc['title'], OBJECT, 'service');
        if (!$existing) {
            $post_id = wp_insert_post([
                'post_title'   => $svc['title'],
                'post_excerpt' => $svc['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'service',
            ]);

            if ($post_id && !is_wp_error($post_id)) {
                wp_set_object_terms($post_id, $svc['type'], 'service_type', true);
            }
        }
    }
}

/**
 * Pre-seed Sample Projects
 */
function rakta_seed_sample_projects($force = false) {
    $sample_projects = [
        [
            'title'   => 'Neural Commerce Engine',
            'excerpt' => 'Interactive 3D product configurator and automated checkout platform delivering a 3.4x boost in buyer engagement.',
            'cat'     => 'E-Commerce',
        ],
        [
            'title'   => 'Quantum Flow CRM',
            'excerpt' => 'AI-driven workflow orchestration system processing over 50,000 multi-step automation events daily.',
            'cat'     => 'Automation',
        ],
        [
            'title'   => 'CyberPulse Telemetry Dashboard',
            'excerpt' => 'Real-time WebGL 3D operational telemetry monitor with ultra-low latency WebSocket streaming.',
            'cat'     => '3D Web',
        ],
        [
            'title'   => 'Apex FinTech Global Core',
            'excerpt' => 'Mission-critical enterprise WordPress portal with zero-downtime microservice architecture and PCI-DSS compliance.',
            'cat'     => 'Enterprise',
        ],
    ];

    foreach ($sample_projects as $proj) {
        $existing = get_page_by_title($proj['title'], OBJECT, 'project');
        if (!$existing) {
            $post_id = wp_insert_post([
                'post_title'   => $proj['title'],
                'post_excerpt' => $proj['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'project',
            ]);

            if ($post_id && !is_wp_error($post_id)) {
                wp_set_object_terms($post_id, $proj['cat'], 'project_category', true);
            }
        }
    }
}

/**
 * Recursively sanitize all columns in an Elementor content array to ensure
 * _column_size and _inline_size are always defined (prevents PHP 8 warnings).
 */
function rakta_sanitize_elementor_columns(&$elements) {
    if (!is_array($elements)) {
        return;
    }

    foreach ($elements as &$el) {
        if (isset($el['elType']) && $el['elType'] === 'column') {
            if (!isset($el['settings']) || !is_array($el['settings'])) {
                $el['settings'] = [];
            }
            if (!isset($el['settings']['_column_size'])) {
                $el['settings']['_column_size'] = 100;
            }
            if (!array_key_exists('_inline_size', $el['settings'])) {
                $el['settings']['_inline_size'] = null;
            }
        }
        if (isset($el['elements']) && is_array($el['elements'])) {
            rakta_sanitize_elementor_columns($el['elements']);
        }
    }
}

/**
 * Self-healing migration for existing database pages:
 * Ensures all existing Elementor pages in database have _column_size set.
 */
function rakta_auto_migrate_elementor_columns() {
    if (get_option('rakta_elementor_columns_migrated_v3')) {
        return;
    }

    $pages = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'any',
        'posts_per_page' => -1,
        'meta_key'       => '_elementor_edit_mode',
        'meta_value'     => 'builder',
    ]);

    foreach ($pages as $p) {
        $raw = get_post_meta($p->ID, '_elementor_data', true);
        if (!empty($raw)) {
            $content = is_array($raw) ? $raw : json_decode($raw, true);
            if (is_array($content)) {
                rakta_sanitize_elementor_columns($content);
                update_post_meta($p->ID, '_elementor_data', wp_slash(json_encode($content)));
            }
        }
    }

    update_option('rakta_elementor_columns_migrated_v3', 1);
}
add_action('admin_init', 'rakta_auto_migrate_elementor_columns');

/**
 * Auto-repair rewrite rules on first load to guarantee static Elementor pages
 * (/services/, /portfolio/) are immediately reachable without CPT archive interception.
 */
function rakta_auto_repair_permalinks() {
    if (!get_option('rakta_cpt_slugs_fixed_v6')) {
        rakta_theme_register_cpts();
        flush_rewrite_rules(false);
        update_option('rakta_cpt_slugs_fixed_v6', 1);
    }
}
add_action('init', 'rakta_auto_repair_permalinks', 99);

