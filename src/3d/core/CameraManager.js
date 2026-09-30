import * as THREE from 'three';

export class CameraManager {
  constructor(fov = 45, near = 0.1, far = 1000) {
    this.fov = fov;
    this.near = near;
    this.far = far;
    this.camera = new THREE.PerspectiveCamera(this.fov, window.innerWidth / window.innerHeight, this.near, this.far);
    this.camera.position.set(0, 0, 7);

    // Mouse tracking with lerp damping
    this.mouse = { x: 0, y: 0 };
    this.targetMouse = { x: 0, y: 0 };
    this.damping = 0.05;

    this.initEventListeners();
  }

  initEventListeners() {
    window.addEventListener('mousemove', (e) => {
      this.targetMouse.x = (e.clientX / window.innerWidth) * 2 - 1;
      this.targetMouse.y = -(e.clientY / window.innerHeight) * 2 + 1;
    });

    // Device orientation support for mobile
    if (window.DeviceOrientationEvent) {
      window.addEventListener('deviceorientation', (e) => {
        if (e.gamma !== null && e.beta !== null) {
          this.targetMouse.x = Math.max(-1, Math.min(1, e.gamma / 30));
          this.targetMouse.y = Math.max(-1, Math.min(1, (e.beta - 45) / 30));
        }
      });
    }
  }

  update(reducedMotion = false) {
    if (reducedMotion) return;

    this.mouse.x += (this.targetMouse.x - this.mouse.x) * this.damping;
    this.mouse.y += (this.targetMouse.y - this.mouse.y) * this.damping;

    // Smooth subtle camera tilt
    this.camera.position.x = this.mouse.x * 0.5;
    this.camera.position.y = this.mouse.y * 0.4;
    this.camera.lookAt(0, 0, 0);
  }

  onResize(width, height) {
    this.camera.aspect = width / height;
    // Responsive camera distance adjustment on smaller screens
    if (width < 768) {
      this.camera.position.z = 9.5;
    } else if (width < 1024) {
      this.camera.position.z = 8.2;
    } else {
      this.camera.position.z = 7;
    }
    this.camera.updateProjectionMatrix();
  }
}
