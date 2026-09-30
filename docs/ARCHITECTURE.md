# RAKTA INFOTECH — SYSTEM ARCHITECTURE SPECIFICATION

## 1. Architectural Philosophy
The Rakta Infotech digital product is engineered using an **Uncoupled, Layered Architecture**. The application avoids rigid framework lock-in by separating concerns across four independent layers:

```
┌────────────────────────────────────────────────────────┐
│                   Presentation Layer                   │
│   (HTML5 Semantic DOM, Native <dialog>, SVG Vectors)   │
├────────────────────────────────────────────────────────┤
│                   Design System Layer                  │
│       (CSS Custom Properties, Glassmorphism, HSL)      │
├────────────────────────────────────────────────────────┤
│                 Creative & Motion Layer                │
│    (Modular Three.js Engine, GSAP ScrollTrigger Runtime)│
├────────────────────────────────────────────────────────┤
│                    Data & State Layer                  │
│ (siteConfig, services, projects, REST API Endpoints)   │
└────────────────────────────────────────────────────────┘
```

This strict decoupling ensures that every frontend component can be exported without modification into WordPress Gutenberg blocks, Elementor widgets, or traditional PHP template parts.

---

## 2. 3D Engine Decoupling
Rather than embedding WebGL logic into UI event listeners, the 3D subsystem is encapsulated within `/src/3d/`:

- **Lifecycle Isolation**: `SceneManager` handles creation, window resizing via `ResizeObserver`, and RAF execution.
- **Viewport Culling**: Rendering is automatically suspended when a canvas is off-screen using `IntersectionObserver`, reducing idle GPU usage to 0%.
- **Object Modularity**: `HeroCore` and `TechEcosystem` implement standardized `update(elapsedTime, delta)` interfaces.
- **Dynamic Damping**: `CameraManager` decouples raw mouse pointer events from the camera orientation, applying lerped inertia for cinematic smoothness.

---

## 3. WordPress Bridge & Portability Model
All visual components follow the **Single Responsibility Principle**:
1. **Presentation**: Standardized markup in `/src/data/` mirrors the schema of WordPress Custom Post Types (`service` and `project`).
2. **Shortcodes**: WordPress shortcodes `[rakta_services]`, `[rakta_portfolio]`, and `[rakta_3d_scene]` wrap around the identical DOM identifiers.
3. **Data Hydration**: In WordPress production mode, PHP renders initial server-side HTML for instant indexing and SEO; the client-side JavaScript engine subsequently hydrates interactive features (tilt, 3D canvas, motion counters).
