<?php
/**
 * Theme Customizer configurations
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

function rakta_customize_register($wp_customize) {
    // Add Rakta Brand Settings Section
    $wp_customize->add_section('rakta_brand_section', [
        'title'       => esc_html__('Rakta Agency Settings', 'rakta-infotech'),
        'priority'    => 30,
        'description' => esc_html__('Configure contact details, WhatsApp, and agency statistics.', 'rakta-infotech'),
    ]);

    // Contact Email
    $wp_customize->add_setting('rakta_contact_email', [
        'default'           => 'contact@raktainfotech.com',
        'sanitize_callback' => 'sanitize_email',
    ]);
    $wp_customize->add_control('rakta_contact_email', [
        'label'    => esc_html__('Contact Email', 'rakta-infotech'),
        'section'  => 'rakta_brand_section',
        'type'     => 'email',
    ]);

    // Phone / WhatsApp
    $wp_customize->add_setting('rakta_contact_phone', [
        'default'           => '+91 98765 43210',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rakta_contact_phone', [
        'label'    => esc_html__('Contact Phone', 'rakta-infotech'),
        'section'  => 'rakta_brand_section',
        'type'     => 'text',
    ]);

    // WhatsApp Direct Number (Without spaces/dashes)
    $wp_customize->add_setting('rakta_whatsapp_number', [
        'default'           => '919876543210',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rakta_whatsapp_number', [
        'label'       => esc_html__('WhatsApp Clean Number', 'rakta-infotech'),
        'description' => esc_html__('Country code followed by number (e.g. 919876543210)', 'rakta-infotech'),
        'section'     => 'rakta_brand_section',
        'type'        => 'text',
    ]);
}
add_action('customize_register', 'rakta_customize_register');
