<?php
/**
 * Rakta Infotech - Enterprise Performance & Core Web Vitals Optimization Engine
 *
 * Implements Google PageSpeed 95+ optimizations:
 * - Preconnect & DNS-Prefetch for fonts and critical CDNs
 * - Defer non-critical scripts
 * - Native lazy loading & asynchronous decoding for all images
 * - Strip version query strings from static assets for edge caching
 * - Remove redundant WordPress head bloat & emojis
 * - Disable XML-RPC pingbacks
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clean up unnecessary WordPress head output
 */
function rakta_clean_head() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    remove_action('wp_head', 'feed_links_extra', 3);

    // Remove Emoji scripts & styles
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'rakta_clean_head');

/**
 * Preconnect and DNS Prefetch for Google Fonts and Critical Resources
 */
function rakta_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = [
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => 'use-credentials',
        ];
        $urls[] = [
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    } elseif ('dns-prefetch' === $relation_type) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://fonts.gstatic.com';
    }
    return $urls;
}
add_filter('wp_resource_hints', 'rakta_resource_hints', 10, 2);

/**
 * Add defer attribute to non-critical theme scripts
 */
function rakta_defer_scripts($tag, $handle, $src) {
    if (is_admin()) {
        return $tag;
    }
    // Defer Rakta scripts
    if (strpos($handle, 'rakta-') !== false && strpos($tag, 'defer') === false) {
        return str_replace(' src', ' defer="defer" src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'rakta_defer_scripts', 10, 3);

/**
 * Remove query strings from static resources for aggressive edge/proxy caching
 */
function rakta_remove_script_version($src) {
    if (is_admin()) {
        return $src;
    }
    if (strpos($src, '?ver=') || strpos($src, '&ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'rakta_remove_script_version', 15, 1);
add_filter('script_loader_src', 'rakta_remove_script_version', 15, 1);

/**
 * Enforce native lazy loading and async decoding on all images
 */
function rakta_optimize_image_attributes($attr, $attachment, $size) {
    if (!isset($attr['loading'])) {
        $attr['loading'] = 'lazy';
    }
    if (!isset($attr['decoding'])) {
        $attr['decoding'] = 'async';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'rakta_optimize_image_attributes', 10, 3);

/**
 * Disable Self Pingbacks for speed and database hygiene
 */
function rakta_disable_self_pingbacks(&$links) {
    $home_url = home_url();
    foreach ($links as $l => $link) {
        if (0 === strpos($link, $home_url)) {
            unset($links[$l]);
        }
    }
}
add_action('pre_ping', 'rakta_disable_self_pingbacks');

/**
 * Disable XML-RPC Pingback Header
 */
function rakta_disable_xmlrpc_pingback_header($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'rakta_disable_xmlrpc_pingback_header');
