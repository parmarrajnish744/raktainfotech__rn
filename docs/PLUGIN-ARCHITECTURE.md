# RAKTA INFOTECH — WORDPRESS PLUGIN ARCHITECTURE

## 1. Separation of Concerns
To ensure data longevity and avoid vendor lock-in, business logic and post types are decoupled from the theme into **Rakta Core**, while WebGL and animation runtimes are managed by **Rakta 3D Engine**.

---

## 2. Plugin 1: `rakta-core`
### Purpose:
Manages Custom Post Types, taxonomies, lead generation workflows, and shortcodes.

### Modules:
- **`inc/cpt-services.php`**: Registers `service` CPT with taxonomy `service_type`.
- **`inc/cpt-portfolio.php`**: Registers `project` CPT with taxonomy `project_category`.
- **`inc/rest-lead.php`**: Registers `/wp-json/rakta/v1/lead` with sanitization, email notifications, and the `rakta_lead_received` action hook for external webhook integration (e.g. n8n, Zapier, WhatsApp Cloud API).
- **`inc/shortcodes.php`**: Exposes `[rakta_services]`, `[rakta_portfolio]`, and `[rakta_stats]`.

---

## 3. Plugin 2: `rakta-3d-engine`
### Purpose:
Manages the WebGL Three.js scenes, particle systems, and page builder widgets.

### Modules:
- **`inc/shortcode-3d.php`**: Shortcode `[rakta_3d_scene scene="hero|ecosystem" height="600px"]`.
- **`inc/elementor-widget.php`**: Registers the native Elementor widget with interactive control panel for administrators.
