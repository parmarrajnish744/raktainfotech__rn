# RAKTA INFOTECH — PERFORMANCE OPTIMIZATION AUDIT & CRITERIA

## 1. Core Web Vitals Targets
- **Largest Contentful Paint (LCP)**: < 1.2s
- **Interaction to Next Paint (INP)**: < 100ms
- **Cumulative Layout Shift (CLS)**: < 0.02
- **First Contentful Paint (FCP)**: < 0.8s

---

## 2. Engineering Optimizations Implemented

1. **Vendor Code-Splitting**: Three.js and GSAP are split into discrete vendor chunks via Rollup manual chunks in `vite.config.js`.
2. **Device Pixel Ratio Throttling**: Caps canvas DPR at 2.0 on Retina screens and drops to 1.0–1.5 on mobile devices to prevent GPU fill-rate bottlenecks.
3. **Intersection Observer Culling**: Halts 3D animation ticks completely when canvases are scrolled outside the viewport.
4. **Zero Layout Shifts**: CSS dimensions on 3D containers and responsive clamps preserve strict aspect ratios before assets load.
5. **Native HTML Overlays**: Replaced bulky JavaScript modal libraries with native `<dialog>` and modern CSS backdrop-filter.
6. **SVG Inlining**: All icons are loaded inline as SVGs, eliminating extraneous HTTP network roundtrips.
