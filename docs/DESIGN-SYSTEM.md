# RAKTA INFOTECH — DESIGN SYSTEM TOKENS & GUIDELINES

## 1. Visual Vibe & Tone
**BLACK + RED + GLASS + 3D + AI + PREMIUM**
The visual identity projects technical sophistication, futuristic precision, and enterprise authority. Red is used strategically as an energy accelerator rather than an overpowering flood.

---

## 2. Color Palette Tokens

| Token Name | Hex / CSS Value | Semantic Role |
| :--- | :--- | :--- |
| `--bg-primary` | `#050505` | Deep void canvas background |
| `--bg-secondary` | `#0B0B0F` | Secondary background, footer, deep layers |
| `--bg-card` | `rgba(15, 15, 22, 0.75)` | Glassmorphic card surface |
| `--bg-glass` | `rgba(255, 255, 255, 0.03)` | Subtle glass button and node background |
| `--red-primary` | `#D90429` | Deep Rakta Red core brand color |
| `--red-dark` | `#8B0015` | Shading, deep gradient endpoints |
| `--red-bright` | `#FF1744` | Neon electric red accent, interactive hovers |
| `--red-glow` | `rgba(217, 4, 41, 0.35)` | Ambient emissive box-shadows |
| `--border-subtle` | `rgba(255, 255, 255, 0.08)`| Subtle glass component outlines |
| `--border-red` | `rgba(217, 4, 41, 0.40)` | Active/hover glowing card border |
| `--text-main` | `#FFFFFF` | Primary headers and high-contrast text |
| `--text-secondary`| `#A1A1AA` | Readable body copy, comfortable contrast |
| `--text-muted` | `#71717A` | Captions, meta tags, and subtitles |

---

## 3. Typography Scale

- **Display & Headings**: `Space Grotesk` (Geometric, technical)
- **Body & Interface**: `Inter` / `Manrope` (Clean, legible, modern sans-serif)

```css
--font-display: 'Space Grotesk', sans-serif;
--font-body: 'Inter', sans-serif;

/* Fluid Clamped Scale */
H1 Hero:    clamp(2.75rem, 6.5vw, 5.5rem)
H2 Section: clamp(2.00rem, 4.5vw, 3.25rem)
H3 Card:    clamp(1.25rem, 2.0vw, 1.65rem)
Body:       1.00rem (16px) / 1.65 line-height
Badges:     0.75rem / 0.12em letter-spacing (uppercase)
```

---

## 4. Glassmorphism Specification
```css
.glass-card {
  background: rgba(15, 15, 22, 0.75);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
}
```

---

## 5. Responsive Breakpoints
- **Desktop Extra Large**: 1920px & 1440px
- **Desktop Standard**: 1280px
- **Tablet Landscape**: 1024px
- **Tablet Portrait**: 768px
- **Mobile Handset**: 480px, 390px, 375px, 320px
- **Rule**: Zero horizontal scrollbar, minimum 44px tap target size, font sizes dynamically clamped.
