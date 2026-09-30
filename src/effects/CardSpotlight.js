/**
 * ============================================================================
 * CardSpotlight — Dynamic Cursor Radial Spotlight & Subtle 3D Card Physics
 * Calculates mouse position relative to each card for radial border glow,
 * reflective glass illumination, and subtle 3D tilt.
 * ============================================================================
 */
export class CardSpotlight {
  constructor() {
    this.prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    this.init();
  }

  init() {
    const cards = document.querySelectorAll(
      '.glass-card, .service-card, .node-card, .project-card, .bento-card, .tech-card, .solution-item-card'
    );

    cards.forEach((card) => {
      this.attachCard(card);
    });

    // Support dynamically rendered cards as well
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        mutation.addedNodes.forEach((node) => {
          if (node.nodeType === Node.ELEMENT_NODE) {
            if (node.matches && node.matches('.glass-card, .service-card, .node-card, .project-card, .bento-card, .tech-card, .solution-item-card')) {
              this.attachCard(node);
            }
            const nested = node.querySelectorAll && node.querySelectorAll('.glass-card, .service-card, .node-card, .project-card, .bento-card, .tech-card, .solution-item-card');
            if (nested) {
              nested.forEach((c) => this.attachCard(c));
            }
          }
        });
      });
    });

    observer.observe(document.body, { childList: true, subtree: true });
  }

  attachCard(card) {
    if (card._hasSpotlight) return;
    card._hasSpotlight = true;

    card.addEventListener('pointermove', (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      card.style.setProperty('--mouse-x', `${x}px`);
      card.style.setProperty('--mouse-y', `${y}px`);

      if (!this.prefersReducedMotion) {
        // Subtle 3D tilt
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = ((y - centerY) / centerY) * -4.5;
        const rotateY = ((x - centerX) / centerX) * 4.5;

        card.style.setProperty('--card-rot-x', `${rotateX.toFixed(2)}deg`);
        card.style.setProperty('--card-rot-y', `${rotateY.toFixed(2)}deg`);
      }
    }, { passive: true });

    card.addEventListener('pointerleave', () => {
      card.style.setProperty('--mouse-x', `-999px`);
      card.style.setProperty('--mouse-y', `-999px`);
      card.style.setProperty('--card-rot-x', `0deg`);
      card.style.setProperty('--card-rot-y', `0deg`);
    });
  }
}
