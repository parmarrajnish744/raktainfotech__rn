<?php
/**
 * Rakta Infotech - Enterprise Technical SEO & Structured Data Engine
 *
 * Provides automated Schema.org JSON-LD, Open Graph, Twitter Cards,
 * Canonical URLs, and Robots meta tags for #1 Google search ranking.
 * Gracefully integrates and yields to Rank Math / Yoast SEO if active.
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if a third-party SEO plugin is currently active.
 *
 * @return bool True if Rank Math, Yoast, or AIOSEO is active.
 */
function rakta_is_seo_plugin_active() {
    return defined('RANK_MATH_VERSION') || 
           defined('WPSEO_VERSION') || 
           defined('AIOSEO_VERSION') || 
           class_exists('RankMath') || 
           class_exists('WPSEO_Frontend');
}

/**
 * Output Core SEO Meta Tags in <head>
 */
function rakta_output_seo_meta_tags() {
    // If a dedicated SEO plugin is handling head meta tags, do not duplicate
    if (rakta_is_seo_plugin_active()) {
        return;
    }

    $site_name   = get_bloginfo('name');
    $site_desc   = get_bloginfo('description');
    $current_url = home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''));
    if (!empty($_SERVER['REQUEST_URI'])) {
        $current_url = home_url(esc_url_raw($_SERVER['REQUEST_URI']));
    }

    // Default Title & Description
    $meta_title = wp_get_document_title();
    $meta_desc  = !empty($site_desc) ? $site_desc : 'Digital Experiences Powered by AI, Web & Automation. Enterprise WordPress, AI Agents, and Scalable Automation.';
    $og_type    = 'website';
    $og_image   = get_template_directory_uri() . '/assets/images/rakta-logo-nav.png';

    if (is_singular()) {
        global $post;
        if ($post) {
            $og_type = is_single() ? 'article' : 'website';
            
            // Generate description from excerpt or content
            if (!empty($post->post_excerpt)) {
                $meta_desc = strip_tags($post->post_excerpt);
            } elseif (!empty($post->post_content)) {
                $meta_desc = wp_trim_words(strip_shortcodes(strip_tags($post->post_content)), 25, '...');
            }

            // Featured Image
            if (has_post_thumbnail($post->ID)) {
                $thumb_id  = get_post_thumbnail_id($post->ID);
                $image_src = wp_get_attachment_image_src($thumb_id, 'large');
                if (!empty($image_src[0])) {
                    $og_image = $image_src[0];
                }
            }
        }
    }

    $meta_desc = esc_attr(trim(preg_replace('/\s+/', ' ', $meta_desc)));
    $meta_title = esc_attr($meta_title);
    $canonical  = esc_url(is_singular() ? get_permalink() : (is_home() ? get_permalink(get_option('page_for_posts')) : home_url('/')));
    ?>
    <!-- Rakta Technical SEO Master Tags -->
    <meta name="description" content="<?php echo $meta_desc; ?>">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="<?php echo $canonical; ?>">

    <!-- Open Graph / Social Media -->
    <meta property="og:locale" content="<?php echo esc_attr(get_locale()); ?>">
    <meta property="og:type" content="<?php echo esc_attr($og_type); ?>">
    <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:description" content="<?php echo $meta_desc; ?>">
    <meta property="og:url" content="<?php echo $canonical; ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($site_name); ?>">
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">

    <!-- Twitter Card Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $meta_title; ?>">
    <meta name="twitter:description" content="<?php echo $meta_desc; ?>">
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
    <?php
}
add_action('wp_head', 'rakta_output_seo_meta_tags', 1);

/**
 * Output Rich Schema.org JSON-LD Structured Data
 */
function rakta_output_schema_jsonld() {
    if (rakta_is_seo_plugin_active()) {
        return;
    }

    $site_url  = esc_url(home_url('/'));
    $site_name = esc_attr(get_bloginfo('name'));
    $site_desc = esc_attr(get_bloginfo('description'));
    $logo_url  = esc_url(get_template_directory_uri() . '/assets/images/rakta-logo-nav.png');

    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            // 1. Organization Schema
            [
                '@type'       => 'Organization',
                '@id'         => $site_url . '#organization',
                'name'        => $site_name,
                'url'         => $site_url,
                'logo'        => [
                    '@type'      => 'ImageObject',
                    '@id'        => $site_url . '#logo',
                    'url'        => $logo_url,
                    'caption'    => $site_name,
                ],
                'description' => $site_desc,
                'email'       => 'contact@raktainfotech.com',
                'contactPoint' => [
                    [
                        '@type'       => 'ContactPoint',
                        'telephone'   => '+91 98765 43210',
                        'contactType' => 'customer support',
                        'areaServed'  => 'Worldwide',
                        'availableLanguage' => ['English', 'Hindi']
                    ]
                ],
                'sameAs'      => [
                    'https://linkedin.com/company/raktainfotech',
                    'https://github.com/raktainfotech',
                    'https://youtube.com/@raktainfotech'
                ]
            ],

            // 2. WebSite with Sitelinks SearchBox
            [
                '@type'           => 'WebSite',
                '@id'             => $site_url . '#website',
                'url'             => $site_url,
                'name'            => $site_name,
                'description'     => $site_desc,
                'publisher'       => ['@id' => $site_url . '#organization'],
                'potentialAction' => [
                    [
                        '@type'       => 'SearchAction',
                        'target'      => $site_url . '?s={search_term_string}',
                        'query-input' => 'required name=search_term_string'
                    ]
                ]
            ],

            // 3. Professional Service / Digital Agency Schema
            [
                '@type'       => 'ProfessionalService',
                '@id'         => $site_url . '#service',
                'name'        => $site_name,
                'url'         => $site_url,
                'logo'        => $logo_url,
                'image'       => $logo_url,
                'description' => 'Digital Experiences Powered by AI, Web & Automation. Enterprise WordPress, AI Agents, and Scalable Automation.',
                'priceRange'  => '$$$',
                'currenciesAccepted' => 'USD, INR, EUR, GBP',
                'paymentAccepted'    => 'Credit Card, Stripe, Bank Transfer, Razorpay',
                'openingHours'       => 'Mo-Sa 09:00-19:00',
                'address'     => [
                    '@type'           => 'PostalAddress',
                    'addressLocality' => 'Tech City',
                    'addressRegion'   => 'Karnataka',
                    'addressCountry'  => 'IN'
                ]
            ]
        ]
    ];

    // 4. BreadcrumbList for Inner Pages
    if (is_singular() && !is_front_page()) {
        global $post;
        $breadcrumb = [
            '@type'           => 'BreadcrumbList',
            '@id'             => get_permalink() . '#breadcrumb',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => $site_url
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => get_the_title($post),
                    'item'     => get_permalink($post)
                ]
            ]
        ];
        $schema['@graph'][] = $breadcrumb;
    }

    echo "\n<!-- Rakta Schema.org Structured Data -->\n";
    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n";
    echo "</script>\n";
}
add_action('wp_head', 'rakta_output_schema_jsonld', 2);

/**
 * Semantic Breadcrumb Navigation Generator
 *
 * @param string $separator Custom breadcrumb separator symbol.
 */
function rakta_breadcrumbs($separator = '›') {
    if (is_front_page()) {
        return;
    }

    echo '<nav class="rakta-breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'rakta-infotech') . '">';
    echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList">';
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a itemprop="item" href="' . esc_url(home_url('/')) . '"><span itemprop="name">' . esc_html__('Home', 'rakta-infotech') . '</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '</li>';

    if (is_singular()) {
        global $post;
        echo ' <span class="breadcrumb-separator">' . esc_html($separator) . '</span> ';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . esc_html(get_the_title($post)) . '</span>';
        echo '<meta itemprop="position" content="2" />';
        echo '</li>';
    } elseif (is_category() || is_tax()) {
        echo ' <span class="breadcrumb-separator">' . esc_html($separator) . '</span> ';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . esc_html(single_term_title('', false)) . '</span>';
        echo '<meta itemprop="position" content="2" />';
        echo '</li>';
    } elseif (is_archive()) {
        echo ' <span class="breadcrumb-separator">' . esc_html($separator) . '</span> ';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . esc_html(post_type_archive_title('', false)) . '</span>';
        echo '<meta itemprop="position" content="2" />';
        echo '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}
