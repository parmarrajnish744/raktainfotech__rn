import * as THREE from 'three';
import { CameraManager } from './CameraManager.js';
import { LightingManager } from './LightingManager.js';
import { PerformanceManager } from '../utils/PerformanceManager.js';

export class SceneManager {
  constructor(canvasElement, options = {}) {
    this.canvas = canvasElement;
    this.options = options;
    this.perf = new PerformanceManager();
    this.isRendering = false;
    this.clock = new THREE.Clock();
    this.updatables = [];

    this.initScene();
    this.initCamera();
    this.initRenderer();
    this.initLighting();
    this.initResizeListener();
    this.initVisibilityObserver();
  }

  initScene() {
    this.scene = new THREE.Scene();
  }

  initCamera() {
    this.cameraManager = new CameraManager(this.options.fov || 45);
    this.camera = this.cameraManager.camera;
  }

  initRenderer() {
    this.renderer = new THREE.WebGLRenderer({
      canvas: this.canvas,
      antialias: true,
      alpha: true,
      powerPreference: 'high-performance'
    });

    this.renderer.setSize(this.canvas.clientWidth, this.canvas.clientHeight, false);
    this.renderer.setPixelRatio(this.perf.getOptimalPixelRatio());
    this.renderer.toneMapping = THREE.ACESFilmicToneMapping;
    this.renderer.toneMappingExposure = 1.1;
    this.renderer.outputColorSpace = THREE.SRGBColorSpace;
  }

  initLighting() {
    this.lightingManager = new LightingManager(this.scene);
    this.updatables.push(this.lightingManager);
  }

  add(object) {
    if (object.group) {
      this.scene.add(object.group);
    } else {
      this.scene.add(object);
    }
    if (typeof object.update === 'function') {
      this.updatables.push(object);
    }
  }

  initResizeListener() {
    this.resizeObserver = new ResizeObserver(() => {
      this.onResize();
    });
    this.resizeObserver.observe(this.canvas.parentElement || document.body);
  }

  onResize() {
    const parent = this.canvas.parentElement;
    const width = parent ? parent.clientWidth : window.innerWidth;
    const height = parent ? parent.clientHeight : window.innerHeight;

    if (width === 0 || height === 0) return;

    this.renderer.setSize(width, height, false);
    this.renderer.setPixelRatio(this.perf.getOptimalPixelRatio());
    this.cameraManager.onResize(width, height);
  }

  initVisibilityObserver() {
    this.intersectionObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          this.start();
        } else {
          this.stop();
        }
      });
    }, { threshold: 0.05 });

    this.intersectionObserver.observe(this.canvas);
  }

  start() {
    if (this.isRendering) return;
    this.isRendering = true;
    this.clock.start();
    this.tick();
  }

  stop() {
    this.isRendering = false;
    this.clock.stop();
  }

  tick() {
    if (!this.isRendering) return;

    requestAnimationFrame(() => this.tick());

    const delta = this.clock.getDelta();
    const elapsedTime = this.clock.getElapsedTime();

    // Check FPS & auto-adjust if low
    const performanceDowngraded = this.perf.updateFPS();
    if (performanceDowngraded) {
      this.renderer.setPixelRatio(this.perf.getOptimalPixelRatio());
    }

    // Update camera parallax with lerp
    this.cameraManager.update(this.perf.isReducedMotion);

    // Update registered objects
    for (let i = 0; i < this.updatables.length; i++) {
      this.updatables[i].update(elapsedTime, delta);
    }

    this.renderer.render(this.scene, this.camera);
  }

  destroy() {
    this.stop();
    if (this.resizeObserver) this.resizeObserver.disconnect();
    if (this.intersectionObserver) this.intersectionObserver.disconnect();
    this.renderer.dispose();
  }
}
