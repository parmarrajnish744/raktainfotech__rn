export class PerformanceManager {
  constructor() {
    this.isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    this.hasWebGL = this.checkWebGLSupport();
    this.fps = 60;
    this.frames = 0;
    this.prevTime = performance.now();
    this.lowFpsThreshold = 30;
    this.isLowEnd = false;
  }

  checkWebGLSupport() {
    try {
      const canvas = document.createElement('canvas');
      const gl = canvas.getContext('webgl2') || canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
      return !!(window.WebGLRenderingContext && gl);
    } catch (e) {
      return false;
    }
  }

  getOptimalPixelRatio() {
    const dpr = window.devicePixelRatio || 1;
    // Cap at 2.0 on high-res displays, drop to 1.0 on low-end/mobile
    if (this.isLowEnd || window.innerWidth < 768) {
      return Math.min(dpr, 1.5);
    }
    return Math.min(dpr, 2.0);
  }

  updateFPS() {
    this.frames++;
    const now = performance.now();
    if (now >= this.prevTime + 1000) {
      this.fps = Math.round((this.frames * 1000) / (now - this.prevTime));
      this.frames = 0;
      this.prevTime = now;

      if (this.fps < this.lowFpsThreshold && !this.isLowEnd) {
        this.isLowEnd = true;
        return true; // Indicates performance downgrade triggered
      }
    }
    return false;
  }
}
