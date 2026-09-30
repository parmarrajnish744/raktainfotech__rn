# RAKTA INFOTECH — 3D AI DIGITAL AGENCY
> **"Digital Experiences Powered by AI, Web & Automation."**

A futuristic, high-performance 3D agency digital product and enterprise web platform engineered with **Three.js**, **GSAP**, modern vanilla web standards, and prepared for seamless deployment as a commercial **WordPress Theme & Plugin Ecosystem**.

---

## ⚡ Quick Start & Running Locally

### Prerequisites
- Node.js (v18.0.0 or higher recommended, tested on v22.13.1)
- npm (v9.0.0 or higher)

### 1. Install Dependencies
```bash
npm install
```

### 2. Launch Local Development Server
```bash
npm run dev
```
The application will launch immediately at `http://localhost:3000` with hot module reloading.

### 3. Build for Production
```bash
npm run build
```
Creates an optimized, tree-shaken, and minified production bundle in `/dist` with split vendor chunks for Three.js, GSAP, and core CSS.

---

## 💎 Project Highlights

- **Interactive 3D Digital Core (Hero)**: Real-time WebGL metallic sphere surrounded by 3 counter-rotating glowing red energy rings, 800+ ambient floating particle nebula, and neural network node lines with mouse parallax damping.
- **Interactive 3D Technology Ecosystem**: 6 orbital satellite nodes (`AI`, `WEB`, `AUTOMATION`, `ECOMMERCE`, `API`, `CLOUD`) that activate glowing laser beams, dynamically rotate the central 3D core, and reveal live capabilities on hover.
- **Black + Rakta Red + Glass Design System**: Deep void background (`#050505`), Rakta Crimson (`#D90429`), electric red accents (`#FF1744`), and frosted glassmorphic card surfaces (`backdrop-filter: blur(16px)`).
- **Sub-Second Performance & CWV Ready**: Automatic WebGL detection, adaptive device pixel ratio throttling (capped at 2.0x, scales to 1.0x on low-end hardware), `prefers-reduced-motion` compliance, and viewport culling via `IntersectionObserver`.
- **Accessible Lead Generation Modal**: Built on native HTML5 `<dialog>` with keyboard focus trapping, Esc dismissal, light dismiss, client validation, and simulated AJAX pipeline.
- **WordPress Ecosystem Architecture**: Complete scaffolding for:
  - Theme: `rakta-infotech/` (Gutenberg & WooCommerce ready)
  - Core Plugin: `rakta-core/` (Custom Post Types, Taxonomies, REST API lead handling)
  - 3D Plugin: `rakta-3d-engine/` (Shortcodes `[rakta_3d_scene]`, Elementor widget integration)

---

## 📁 Repository Directory Structure

```
├── index.html                 # Semantic master template with SEO & JSON-LD
├── package.json               # Vite, Three.js, GSAP dependencies
├── vite.config.js             # Chunk optimization & dev server config
├── public/
│   ├── favicon.svg            # Rakta Red emblem vector favicon
│   └── robots.txt             # SEO crawler instructions
├── src/
│   ├── main.js                # Application bootstrapper
│   ├── style.css              # Design system tokens & glassmorphic styling
│   ├── 3d/                    # Modular Three.js Engine
│   │   ├── core/              # SceneManager, CameraManager, LightingManager
│   │   ├── objects/           # HeroCore, TechEcosystem
│   │   ├── systems/           # ParticleSystem
│   │   └── utils/             # PerformanceManager, WebGLFallback
│   ├── animations/            # GSAP ScrollTrigger & micro-motion
│   ├── components/            # Header, LeadModal, InteractiveNodes
│   └── data/                  # Centralized content (Services, Solutions, Projects, etc.)
├── wordpress/                 # Production WordPress Theme & Plugins
│   ├── theme/rakta-infotech/  # Complete theme files
│   └── plugins/
│       ├── rakta-core/        # CPTs, REST API endpoints, shortcodes
│       └── rakta-3d-engine/   # Three.js runtime & Elementor widget
└── docs/                      # Technical Documentation Suite
    ├── ARCHITECTURE.md        # Technical architecture & state flow
    ├── DESIGN-SYSTEM.md       # Colors, typography, and UI tokens
    ├── 3D-ENGINE.md           # Three.js scene graph, shaders & performance
    ├── WORDPRESS-MIGRATION.md # Guide to compiling & deploying to WordPress
    ├── PLUGIN-ARCHITECTURE.md # CPT, REST API, and shortcode specs
    ├── PERFORMANCE.md         # CWV optimization & DPR capping
    └── TESTING.md             # Cross-device and accessibility checklists
```

---

## 📖 Documentation Suite
For detailed architectural blueprints and deployment guides, consult the `/docs` directory:
- [ARCHITECTURE.md](docs/ARCHITECTURE.md)
- [DESIGN-SYSTEM.md](docs/DESIGN-SYSTEM.md)
- [3D-ENGINE.md](docs/3D-ENGINE.md)
- [WORDPRESS-MIGRATION.md](docs/WORDPRESS-MIGRATION.md)
- [PLUGIN-ARCHITECTURE.md](docs/PLUGIN-ARCHITECTURE.md)
- [PERFORMANCE.md](docs/PERFORMANCE.md)
- [TESTING.md](docs/TESTING.md)
