# RAKTA INFOTECH — 3D ENGINE ARCHITECTURE SPECIFICATION

## 1. Engine Core Overview
The 3D subsystem is built upon **Three.js** (WebGL 2.0 / WebGL 1.0) with zero external physics bloat. It runs two independent scenes:
1. **Hero 3D Scene (`#hero-canvas`)**: Futuristic Digital Core with counter-rotating red energy rings and particle dust.
2. **Ecosystem 3D Scene (`#ecosystem-canvas`)**: Orbiting technology satellites responding to user hover and click events.

---

## 2. Class Hierarchy & Subsystems

```
SceneManager
 ├── WebGLRenderer (ACESFilmicToneMapping, sRGB, anti-aliased)
 ├── CameraManager (PerspectiveCamera, responsive FOV, mouse parallax damping)
 ├── LightingManager (Ambient base, Directional key, Crimson & Specular point lights)
 ├── PerformanceManager (DPR capping, FPS monitor, WebGL check)
 └── Updatables:
      ├── HeroCore
      │    ├── Metallic Sphere (MeshStandardMaterial, metalness: 0.94)
      │    ├── Lattice Shell (Icosahedron wireframe)
      │    ├── 3x Energy Torus Rings (AdditiveBlending, pulsing opacity)
      │    └── Neural Lattice Nodes & Connection Lines
      ├── ParticleSystem (800+ 3D volumetric particles with spherical distribution)
      └── TechEcosystem (6 satellite orbital nodes, glowing energy laser beams)
```

---

## 3. Shader & Material Strategies
- **Emissive Pulse**: Torus energy rings use additive blending (`THREE.AdditiveBlending`) combined with sinusoidal opacity modulation:
  ```javascript
  ring.material.opacity = 0.55 + Math.sin(time * 2 + idx) * 0.25;
  ```
- **Depth Writing**: Particle clouds have `depthWrite: false` to allow seamless visual stacking without sorting artifacts.
- **Lighting Dynamics**: Ambient breathing lights oscillate dynamically around `#FF1744` and `#D90429`.

---

## 4. Performance & Hardware Resilience
- **DPR Throttling**: Device pixel ratio is capped at `Math.min(window.devicePixelRatio, 2.0)`. On screens below 768px or during low-FPS detection, DPR drops to 1.0x-1.5x.
- **Visibility Pausing**: Uses `IntersectionObserver` to completely halt `requestAnimationFrame` when the canvas is off-screen.
- **Graceful WebGL Fallback**: If WebGL initialization fails, `WebGLFallback` cleanly hides the canvas and displays the hardware-accelerated CSS/2D pulsating core.
