export class WebGLFallback {
  static activate(containerSelector, fallbackSelector) {
    const container = document.querySelector(containerSelector);
    const fallback = document.querySelector(fallbackSelector);

    if (container) {
      const canvas = container.querySelector('canvas');
      if (canvas) canvas.style.display = 'none';
    }

    if (fallback) {
      fallback.style.display = 'flex';
    }
  }
}
