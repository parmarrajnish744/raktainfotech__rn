/**
 * ============================================================================
 * InteractiveCursor — Advanced Cybernetic Cursor & Trailing Voxel Sparks
 * Features:
 * - Fluid dual-state cursor (precision core dot + outer lagging aura)
 * - Trailing stream of glowing digital voxel cubes (matching Rakta logo pixels)
 * - Magnetic attraction to interactive elements
 * - Click shockwaves & responsive hover states
 * ============================================================================
 */
export class InteractiveCursor {
  constructor() {
    // Only initialize on desktop devices with fine pointer
    if (window.matchMedia('(pointer: coarse)').matches) {
      return;
    }

    this.prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    this.pos = { x: -100, y: -100 };
    this.target = { x: -100, y: -100 };
    this.prev = { x: -100, y: -100 };
    this.velocity = { x: 0, y: 0 };
    this.speed = 0;

    this.isHovered = false;
    this.isClicking = false;
    this.magneticTarget = null;
    this.trailParticles = [];
    this.maxTrailParticles = 40;

    this.initDOM();
    this.initTrailCanvas();
    this.bindEvents();
    this.animate();
  }

  initDOM() {
    // Root container
    this.container = document.createElement('div');
    this.container.className = 'custom-cursor-container';
    this.container.setAttribute('aria-hidden', 'true');

    // Inner precision dot
    this.dot = document.createElement('div');
    this.dot.className = 'custom-cursor-dot';

    // Outer lagging ring
    this.ring = document.createElement('div');
    this.ring.className = 'custom-cursor-ring';

    this.container.appendChild(this.ring);
    this.container.appendChild(this.dot);
    document.body.appendChild(this.container);
  }

  initTrailCanvas() {
    this.canvas = document.createElement('canvas');
    this.canvas.className = 'custom-cursor-trail-canvas';
    this.canvas.setAttribute('aria-hidden', 'true');
    document.body.appendChild(this.canvas);

    this.ctx = this.canvas.getContext('2d', { alpha: true });
    this.dpr = Math.min(window.devicePixelRatio || 1, 2);

    this.resizeCanvas();
    window.addEventListener('resize', () => this.resizeCanvas(), { passive: true });
  }

  resizeCanvas() {
    this.canvas.width = Math.floor(window.innerWidth * this.dpr);
    this.canvas.height = Math.floor(window.innerHeight * this.dpr);
    this.canvas.style.width = `${window.innerWidth}px`;
    this.canvas.style.height = `${window.innerHeight}px`;
    this.ctx.setTransform(this.dpr, 0, 0, this.dpr, 0, 0);
  }

  bindEvents() {
    window.addEventListener('pointermove', (e) => {
      this.target.x = e.clientX;
      this.target.y = e.clientY;

      // First move entry
      if (this.pos.x === -100) {
        this.pos.x = e.clientX;
        this.pos.y = e.clientY;
      }

      // Calculate speed
      const dx = e.clientX - this.prev.x;
      const dy = e.clientY - this.prev.y;
      this.speed = Math.hypot(dx, dy);

      // Emit trailing digital voxels on movement
      if (this.speed > 2 && !this.prefersReducedMotion) {
        this.spawnTrailParticle(e.clientX, e.clientY, dx, dy);
      }

      this.prev.x = e.clientX;
      this.prev.y = e.clientY;
    }, { passive: true });

    window.addEventListener('pointerdown', () => {
      this.isClicking = true;
      this.container.classList.add('cursor-clicking');
    });

    window.addEventListener('pointerup', () => {
      this.isClicking = false;
      this.container.classList.remove('cursor-clicking');
    });

    window.addEventListener('pointerleave', () => {
      this.container.classList.add('cursor-hidden');
    });

    window.addEventListener('pointerenter', () => {
      this.container.classList.remove('cursor-hidden');
    });

    // Delegate hover detection for clickable / interactive elements
    this.initHoverDelegation();
  }

  initHoverDelegation() {
    const interactiveSelectors = 'a, button, input, select, textarea, .btn, .nav-link, .service-link, .node-card, .solution-item-card, .glass-card, .bento-card, .project-card, [role="button"], [data-cursor-interactive]';

    document.addEventListener('mouseover', (e) => {
      const target = e.target.closest(interactiveSelectors);
      if (target) {
        this.isHovered = true;
        this.container.classList.add('cursor-hovering');

        // Check if magnetic
        if (target.matches('.btn, .nav-link, .mobile-menu-btn, .service-link')) {
          this.magneticTarget = target;
        }
      }
    }, { passive: true });

    document.addEventListener('mouseout', (e) => {
      const target = e.target.closest(interactiveSelectors);
      if (target) {
        this.isHovered = false;
        this.container.classList.remove('cursor-hovering');
        this.magneticTarget = null;
      }
    }, { passive: true });
  }

  spawnTrailParticle(x, y, dx, dy) {
    if (this.trailParticles.length >= this.maxTrailParticles) {
      this.trailParticles.shift();
    }

    // Colors matching Rakta Infotech logo (cyan, royal blue, silver-white)
    const colors = [
      '#00F0FF',
      '#0066FF',
      '#38BDF8',
      '#FFFFFF'
    ];
    const color = colors[Math.floor(Math.random() * colors.length)];

    this.trailParticles.push({
      x: x + (Math.random() - 0.5) * 6,
      y: y + (Math.random() - 0.5) * 6,
      vx: -dx * 0.15 + (Math.random() - 0.5) * 1.5,
      vy: -dy * 0.15 + (Math.random() - 0.5) * 1.5,
      size: Math.random() * 4.5 + 2.5, // Pixel voxel square
      rotation: Math.random() * Math.PI,
      rotSpeed: (Math.random() - 0.5) * 0.1,
      alpha: 0.85,
      decay: Math.random() * 0.035 + 0.02,
      color: color
    });
  }

  animate() {
    // Smooth interpolation for cursor dot and ring
    let targetX = this.target.x;
    let targetY = this.target.y;

    // Magnetic pull if hovering a button or link
    if (this.magneticTarget) {
      const rect = this.magneticTarget.getBoundingClientRect();
      const centerX = rect.left + rect.width / 2;
      const centerY = rect.top + rect.height / 2;
      targetX = targetX + (centerX - targetX) * 0.35;
      targetY = targetY + (centerY - targetY) * 0.35;
    }

    // Dot tracks closely
    this.dot.style.transform = `translate3d(${this.target.x}px, ${this.target.y}px, 0)`;

    // Lagging follower ring lerp
    const lerpSpeed = this.isHovered ? 0.22 : 0.14;
    this.pos.x += (targetX - this.pos.x) * lerpSpeed;
    this.pos.y += (targetY - this.pos.y) * lerpSpeed;

    this.ring.style.transform = `translate3d(${this.pos.x}px, ${this.pos.y}px, 0)`;

    // Render trailing digital voxel particles on canvas
    this.renderTrail();

    requestAnimationFrame(() => this.animate());
  }

  renderTrail() {
    const ctx = this.ctx;
    ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);

    if (this.trailParticles.length === 0) return;

    for (let i = this.trailParticles.length - 1; i >= 0; i--) {
      const p = this.trailParticles[i];

      p.x += p.vx;
      p.y += p.vy;
      p.rotation += p.rotSpeed;
      p.alpha -= p.decay;

      if (p.alpha <= 0) {
        this.trailParticles.splice(i, 1);
        continue;
      }

      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate(p.rotation);
      ctx.globalAlpha = p.alpha;
      ctx.fillStyle = p.color;

      // Draw digital voxel cube
      const half = p.size / 2;
      ctx.fillRect(-half, -half, p.size, p.size);

      // Subtle glow on brighter particles
      if (p.alpha > 0.4) {
        ctx.strokeStyle = '#00F0FF';
        ctx.lineWidth = 0.5;
        ctx.strokeRect(-half, -half, p.size, p.size);
      }

      ctx.restore();
    }
  }
}
