<?php
/**
 * Theme security hardening
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

// Disable XML-RPC if not needed
add_filter('xmlrpc_enabled', '__return_false');

// Remove WordPress version query string from static assets
function rakta_remove_script_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'rakta_remove_script_version', 9999);
add_filter('script_loader_src', 'rakta_remove_script_version', 9999);
