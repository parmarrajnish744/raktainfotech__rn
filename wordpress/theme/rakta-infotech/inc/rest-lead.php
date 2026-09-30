<?php
/**
 * REST API Lead Generation Endpoint for Theme
 *
 * @package Rakta_Infotech
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('rakta_theme_register_lead_rest_route')) {
    function rakta_theme_register_lead_rest_route() {
        register_rest_route('rakta/v1', '/lead', [
            'methods'             => 'POST',
            'callback'            => 'rakta_theme_handle_lead_submission',
            'permission_callback' => '__return_true',
        ]);
    }
    add_action('rest_api_init', 'rakta_theme_register_lead_rest_route');

    function rakta_theme_handle_lead_submission($request) {
        $params = $request->get_json_params();

        // Sanitize input fields
        $name    = isset($params['name']) ? sanitize_text_field($params['name']) : '';
        $email   = isset($params['email']) ? sanitize_email($params['email']) : '';
        $phone   = isset($params['phone']) ? sanitize_text_field($params['phone']) : '';
        $company = isset($params['company']) ? sanitize_text_field($params['company']) : '';
        $service = isset($params['service']) ? sanitize_text_field($params['service']) : '';
        $budget  = isset($params['budget']) ? sanitize_text_field($params['budget']) : '';
        $message = isset($params['message']) ? sanitize_textarea_field($params['message']) : '';

        // Validation
        if (empty($name) || empty($email) || !is_email($email)) {
            return new WP_Error('invalid_data', esc_html__('Please provide a valid name and email address.', 'rakta-infotech'), ['status' => 400]);
        }

        // Email notification to Admin
        $to = get_option('admin_email');
        $subject = sprintf('[New Project Inquiry] %s - %s', $name, $service);
        $body = "New lead submitted via Rakta Infotech website:\n\n"
              . "Name: $name\n"
              . "Email: $email\n"
              . "Phone: $phone\n"
              . "Company: $company\n"
              . "Service Required: $service\n"
              . "Estimated Budget: $budget\n"
              . "Brief:\n$message\n\n"
              . "Submission Date: " . current_time('mysql');

        wp_mail($to, $subject, $body);

        // Action hook for external CRM / n8n webhook pipeline
        do_action('rakta_lead_received', [
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'company' => $company,
            'service' => $service,
            'budget'  => $budget,
            'message' => $message,
        ]);

        return rest_ensure_response([
            'success' => true,
            'message' => esc_html__('Inquiry received successfully. Our team will contact you shortly.', 'rakta-infotech')
        ]);
    }
}
