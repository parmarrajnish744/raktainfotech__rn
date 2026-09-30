# RAKTA INFOTECH — TESTING, QA & VERIFICATION MATRIX

## 1. Cross-Device Matrix

| Viewport | Target Device | Tests Performed | Status |
| :--- | :--- | :--- | :--- |
| **1920x1080** | Desktop Cinema | 3D Hero Parallax, 3D Ecosystem, GSAP reveals | Passed |
| **1440x900** | Standard Laptop | Grid alignments, glassmorphism blur, stats counters | Passed |
| **1024x768** | Tablet Landscape | Bento-grid 2-col shift, 3D responsiveness | Passed |
| **768x1024** | Tablet Portrait | Mobile menu drawer, timeline stacking | Passed |
| **375x812** | Mobile (iPhone/Pixel) | Touch targets, zero horizontal overflow, DPR cap | Passed |

---

## 2. Interactive Feature Verification
- **Lead Generation Modal**: Tested opening via "Start a Project" and "Talk to Us", validation of required fields, simulated AJAX delay, and escape/outside-click dismissal.
- **3D Interactive Ecosystem**: Tested hover across all 6 orbital nodes (`AI`, `WEB`, `AUTOMATION`, `ECOMMERCE`, `API`, `CLOUD`), verified 3D core rotation and detail panel update.
- **WebGL Fallback**: Tested simulated failure to ensure CSS fallback sphere renders smoothly.
- **Accessibility & Keyboard Navigation**: Verified tab order across navigation, focus rings (`:focus-visible`), and ARIA attributes.
