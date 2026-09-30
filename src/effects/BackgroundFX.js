/**
 * ============================================================================
 * BackgroundFX — Interactive Cyber Grid, Dynamic Aurora & Fluid Light Field
 * Tracks cursor movements smoothly across the entire viewport and creates
 * a living, responsive background ambient effect for Rakta Infotech.
 * ============================================================================
 */
export class BackgroundFX {
  constructor() {
    this.canvas = document.getElementById('bg-interactive-canvas');
    if (!this.canvas) return;

    this.ctx = this.canvas.getContext('2d', { alpha: true });
    if (!this.ctx) return;

    // Check prefers-reduced-motion
    this.prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Cursor tracking with smooth lerp
    this.mouse = {
      x: window.innerWidth * 0.5,
      y: window.innerHeight * 0.3,
      targetX: window.innerWidth * 0.5,
      targetY: window.innerHeight * 0.3,
      vx: 0,
      vy: 0,
      prevX: window.innerWidth * 0.5,
      prevY: window.innerHeight * 0.3,
      speed: 0,
      active: true,
      radius: 380
    };

    // Responsive sizing
    this.width = window.innerWidth;
    this.height = window.innerHeight;
    this.dpr = Math.min(window.devicePixelRatio || 1, 1.75);

    // Interactive digital grid nodes
    this.gridSpacing = 64; // Distance between grid intersections
    this.nodes = [];
    this.ambientParticles = [];
    this.ripples = [];

    this.isRunning = false;
    this.animId = null;
    this.lastTime = performance.now();

    this.init();
  }

  init() {
    this.resize();
    this.initGridNodes();
    this.initAmbientParticles();
    this.bindEvents();
    this.start();
  }

  resize() {
    this.width = window.innerWidth;
    this.height = window.innerHeight;
    this.canvas.width = Math.floor(this.width * this.dpr);
    this.canvas.height = Math.floor(this.height * this.dpr);
    this.canvas.style.width = `${this.width}px`;
    this.canvas.style.height = `${this.height}px`;
    this.ctx.setTransform(this.dpr, 0, 0, this.dpr, 0, 0);

    // Reinitialize grid nodes according to new dimensions
    this.initGridNodes();
  }

  initGridNodes() {
    this.nodes = [];
    const cols = Math.ceil(this.width / this.gridSpacing) + 1;
    const rows = Math.ceil(this.height / this.gridSpacing) + 1;

    for (let c = 0; c < cols; c++) {
      for (let r = 0; r < rows; r++) {
        this.nodes.push({
          baseX: c * this.gridSpacing,
          baseY: r * this.gridSpacing,
          x: c * this.gridSpacing,
          y: r * this.gridSpacing,
          intensity: 0,
          targetIntensity: 0,
          size: 1.5,
          pulse: Math.random() * Math.PI * 2
        });
      }
    }
  }

  initAmbientParticles() {
    this.ambientParticles = [];
    const count = Math.min(Math.floor((this.width * this.height) / 22000), 55);

    for (let i = 0; i < count; i++) {
      this.ambientParticles.push({
        x: Math.random() * this.width,
        y: Math.random() * this.height,
        vx: (Math.random() - 0.5) * 0.35,
        vy: (Math.random() - 0.5) * 0.35,
        size: Math.random() * 2.2 + 0.8,
        alpha: Math.random() * 0.35 + 0.1,
        baseAlpha: Math.random() * 0.35 + 0.1,
        phase: Math.random() * Math.PI * 2,
        color: Math.random() > 0.4 ? 'rgba(0, 229, 255,' : 'rgba(0, 102, 255,'
      });
    }
  }

  bindEvents() {
    window.addEventListener('resize', () => this.resize(), { passive: true });

    window.addEventListener('pointermove', (e) => {
      this.mouse.targetX = e.clientX;
      this.mouse.targetY = e.clientY;
      this.mouse.active = true;

      // Update global CSS custom properties for elements that use CSS-based cursor reveal
      const pctX = ((e.clientX / this.width) * 100).toFixed(2);
      const pctY = ((e.clientY / this.height) * 100).toFixed(2);
      document.documentElement.style.setProperty('--cursor-x', `${e.clientX}px`);
      document.documentElement.style.setProperty('--cursor-y', `${e.clientY}px`);
      document.documentElement.style.setProperty('--cursor-pct-x', `${pctX}%`);
      document.documentElement.style.setProperty('--cursor-pct-y', `${pctY}%`);

      // Spawn subtle momentum ripples if cursor moves rapidly
      const dx = e.clientX - this.mouse.prevX;
      const dy = e.clientY - this.mouse.prevY;
      const dist = Math.hypot(dx, dy);

      if (dist > 35 && this.ripples.length < 8 && !this.prefersReducedMotion) {
        this.ripples.push({
          x: e.clientX,
          y: e.clientY,
          radius: 10,
          maxRadius: 180 + Math.min(dist * 1.5, 120),
          alpha: 0.35,
          speed: 4 + dist * 0.05
        });
      }

      this.mouse.prevX = e.clientX;
      this.mouse.prevY = e.clientY;
    }, { passive: true });

    window.addEventListener('pointerleave', () => {
      this.mouse.active = false;
    });

    window.addEventListener('pointerdown', (e) => {
      // Create an energetic click wave
      if (!this.prefersReducedMotion) {
        this.ripples.push({
          x: e.clientX,
          y: e.clientY,
          radius: 15,
          maxRadius: 320,
          alpha: 0.7,
          speed: 7
        });
      }
    });

    // Pause when tab hidden to preserve GPU/battery
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        this.stop();
      } else {
        this.start();
      }
    });
  }

  start() {
    if (this.isRunning) return;
    this.isRunning = true;
    this.lastTime = performance.now();
    this.loop();
  }

  stop() {
    this.isRunning = false;
    if (this.animId) {
      cancelAnimationFrame(this.animId);
      this.animId = null;
    }
  }

  loop() {
    if (!this.isRunning) return;

    this.render();
    this.animId = requestAnimationFrame(() => this.loop());
  }

  render() {
    const ctx = this.ctx;
    const now = performance.now();
    const dt = Math.min((now - this.lastTime) / 1000, 0.1);
    this.lastTime = now;

    // Smooth cursor interpolation (lerp)
    const lerpFactor = this.prefersReducedMotion ? 1 : 0.09;
    this.mouse.x += (this.mouse.targetX - this.mouse.x) * lerpFactor;
    this.mouse.y += (this.mouse.targetY - this.mouse.y) * lerpFactor;

    // Clear entire viewport
    ctx.clearRect(0, 0, this.width, this.height);

    // 1. Draw Cursor Aurora Light Field (Volumetric Radial Gradient)
    if (this.mouse.active) {
      const auraGradient = ctx.createRadialGradient(
        this.mouse.x,
        this.mouse.y,
        0,
        this.mouse.x,
        this.mouse.y,
        this.mouse.radius
      );

      // Deep cyan/electric blue multi-stop aura
      auraGradient.addColorStop(0, 'rgba(0, 229, 255, 0.16)');
      auraGradient.addColorStop(0.25, 'rgba(0, 114, 255, 0.11)');
      auraGradient.addColorStop(0.6, 'rgba(10, 25, 60, 0.06)');
      auraGradient.addColorStop(1, 'rgba(0, 0, 0, 0)');

      ctx.save();
      ctx.fillStyle = auraGradient;
      ctx.fillRect(0, 0, this.width, this.height);
      ctx.restore();
    }

    // 2. Draw Subtle Dynamic Cyber Tech Grid
    this.drawGrid(ctx);

    // 3. Draw Ripples / Dynamic Wake
    this.drawRipples(ctx, dt);

    // 4. Draw Floating Cyber Voxel Particles
    this.drawAmbientParticles(ctx, dt, now);
  }

  drawGrid(ctx) {
    const mouseX = this.mouse.x;
    const mouseY = this.mouse.y;
    const activeRadius = this.mouse.radius * 0.95;
    const activeRadiusSq = activeRadius * activeRadius;

    ctx.save();

    for (let i = 0; i < this.nodes.length; i++) {
      const node = this.nodes[i];
      const dx = mouseX - node.baseX;
      const dy = mouseY - node.baseY;
      const distSq = dx * dx + dy * dy;

      if (distSq < activeRadiusSq && this.mouse.active) {
        const dist = Math.sqrt(distSq);
        const factor = 1 - (dist / activeRadius);
        node.targetIntensity = Math.pow(factor, 1.8);

        // Subtle magnetic pull towards the cursor (max 4px displacement)
        if (!this.prefersReducedMotion) {
          node.x = node.baseX + (dx / dist) * (factor * 4);
          node.y = node.baseY + (dy / dist) * (factor * 4);
        }
      } else {
        node.targetIntensity = 0;
        node.x += (node.baseX - node.x) * 0.1;
        node.y += (node.baseY - node.y) * 0.1;
      }

      // Smooth intensity transition
      node.intensity += (node.targetIntensity - node.intensity) * 0.15;

      // Base idle dot visibility (very faint) vs active highlighted state
      if (node.intensity > 0.02) {
        const glowAlpha = node.intensity * 0.75;
        const radius = node.size + node.intensity * 1.8;

        // Outer glow
        ctx.beginPath();
        ctx.arc(node.x, node.y, radius * 2.2, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(0, 229, 255, ${glowAlpha * 0.25})`;
        ctx.fill();

        // Inner bright core
        ctx.beginPath();
        ctx.arc(node.x, node.y, radius, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(255, 255, 255, ${glowAlpha * 0.95})`;
        ctx.fill();
      } else {
        // Very subtle background cyber dot
        ctx.beginPath();
        ctx.arc(node.baseX, node.baseY, 0.9, 0, Math.PI * 2);
        ctx.fillStyle = 'rgba(255, 255, 255, 0.04)';
        ctx.fill();
      }
    }

    ctx.restore();
  }

  drawRipples(ctx, dt) {
    if (this.ripples.length === 0) return;

    ctx.save();
    for (let i = this.ripples.length - 1; i >= 0; i--) {
      const rip = this.ripples[i];
      rip.radius += rip.speed;
      rip.alpha -= dt * 0.45;

      if (rip.alpha <= 0 || rip.radius >= rip.maxRadius) {
        this.ripples.splice(i, 1);
        continue;
      }

      ctx.beginPath();
      ctx.arc(rip.x, rip.y, rip.radius, 0, Math.PI * 2);
      ctx.strokeStyle = `rgba(0, 229, 255, ${Math.max(0, rip.alpha * 0.5)})`;
      ctx.lineWidth = 1.5;
      ctx.stroke();

      // Second soft echo ring
      ctx.beginPath();
      ctx.arc(rip.x, rip.y, Math.max(0, rip.radius - 18), 0, Math.PI * 2);
      ctx.strokeStyle = `rgba(0, 102, 255, ${Math.max(0, rip.alpha * 0.25)})`;
      ctx.lineWidth = 1;
      ctx.stroke();
    }
    ctx.restore();
  }

  drawAmbientParticles(ctx, dt, now) {
    ctx.save();

    for (let i = 0; i < this.ambientParticles.length; i++) {
      const p = this.ambientParticles[i];

      // Update position
      p.x += p.vx;
      p.y += p.vy;

      // Wrap around edges
      if (p.x < 0) p.x = this.width;
      if (p.x > this.width) p.x = 0;
      if (p.y < 0) p.y = this.height;
      if (p.y > this.height) p.y = 0;

      // Mouse proximity interaction: gently push away or illuminate
      const dx = this.mouse.x - p.x;
      const dy = this.mouse.y - p.y;
      const dist = Math.hypot(dx, dy);

      let alpha = p.baseAlpha + Math.sin(now * 0.002 + p.phase) * 0.08;

      if (dist < 220 && this.mouse.active) {
        const proximity = 1 - (dist / 220);
        alpha = Math.min(1, alpha + proximity * 0.55);

        // Push away slightly
        if (!this.prefersReducedMotion) {
          p.x -= (dx / dist) * proximity * 1.5;
          p.y -= (dy / dist) * proximity * 1.5;
        }
      }

      ctx.fillStyle = `${p.color} ${Math.max(0, alpha)})`;

      // Draw subtle digital voxel (small square)
      ctx.fillRect(p.x, p.y, p.size, p.size);
    }

    ctx.restore();
  }
}
