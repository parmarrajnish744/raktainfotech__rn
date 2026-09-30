# RAKTA INFOTECH — WORDPRESS MIGRATION & DEPLOYMENT GUIDE

This document explains step-by-step how to convert the working Google Antigravity prototype into a live production WordPress installation.

---

## 1. Directory Mapping
The project has already been scaffolded into WordPress directory structures inside `/wordpress/`:

```
/wordpress/
├── theme/
│   └── rakta-infotech/      ──> Copy to wp-content/themes/rakta-infotech/
└── plugins/
    ├── rakta-core/          ──> Copy to wp-content/plugins/rakta-core/
    └── rakta-3d-engine/     ──> Copy to wp-content/plugins/rakta-3d-engine/
```

---

## 2. Compiling Assets for WordPress
To compile the production JavaScript bundles and CSS:
1. Run `npm run build`.
2. Inspect the generated files in `/dist/assets/`:
   - `index-*.css` $\to$ Copy to `wordpress/theme/rakta-infotech/assets/css/style.css`
   - `index-*.js` $\to$ Copy to `wordpress/theme/rakta-infotech/assets/js/main.js`
   - `three-*.js` $\to$ Copy to `wordpress/theme/rakta-infotech/assets/js/three-vendor.js`
   - `gsap-*.js` $\to$ Copy to `wordpress/theme/rakta-infotech/assets/js/gsap-vendor.js`

---

## 3. Activation in WordPress Admin
1. Navigate to **Appearance > Themes** and activate **Rakta Infotech**.
2. Navigate to **Plugins** and activate:
   - **Rakta Core Functionality**
   - **Rakta 3D Engine & Animation Runtime**
3. Create a static page titled "Home" and assign it as the **Front page** in **Settings > Reading**.
4. Configure company phone, email, and WhatsApp number in **Appearance > Customize > Rakta Agency Settings**.

---

## 4. Elementor & Gutenberg Integration
- **Gutenberg**: Insert the shortcodes `[rakta_3d_scene scene="hero"]` or `[rakta_services]` into any Shortcode or Custom HTML block.
- **Elementor**: Drag and drop the **Rakta 3D Scene** widget directly into any Elementor column, choose between "Hero" or "Ecosystem", and set custom canvas height.
