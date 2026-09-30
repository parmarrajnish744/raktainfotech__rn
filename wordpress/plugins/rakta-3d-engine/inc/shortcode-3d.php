<?php
/**
 * Shortcodes for 3D Scenes
 *
 * @package Rakta_3D_Engine
 */

if (!defined('ABSPATH')) {
    exit;
}

// Shortcode: [rakta_3d_scene scene="hero|ecosystem"]
function rakta_shortcode_3d_scene($atts) {
    $args = shortcode_atts([
        'scene' => 'hero',
        'height' => '600px',
    ], $atts, 'rakta_3d_scene');

    $scene_id = sanitize_key($args['scene']);
    $height = esc_attr($args['height']);

    ob_start();
    if ($scene_id === 'ecosystem') {
        ?>
        <div class="ecosystem-canvas-container" style="height: <?php echo $height; ?>;" aria-hidden="true">
            <canvas id="ecosystem-canvas"></canvas>
        </div>
        <?php
    } else {
        ?>
        <div class="hero-3d-container" style="height: <?php echo $height; ?>;" aria-hidden="true">
            <canvas id="hero-canvas"></canvas>
        </div>
        <?php
    }
    return ob_get_clean();
}
add_shortcode('rakta_3d_scene', 'rakta_shortcode_3d_scene');
