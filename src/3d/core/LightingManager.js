import * as THREE from 'three';

export class LightingManager {
  constructor(scene) {
    this.scene = scene;
    this.initLights();
  }

  initLights() {
    // Ambient light with cool dark tone
    this.ambientLight = new THREE.AmbientLight(0x0f0f18, 1.8);
    this.scene.add(this.ambientLight);

    // Main directional key light
    this.keyLight = new THREE.DirectionalLight(0xffffff, 2.2);
    this.keyLight.position.set(5, 5, 6);
    this.scene.add(this.keyLight);

    // Rakta crimson accent rim light
    this.rimLight = new THREE.PointLight(0xD90429, 4.5, 20);
    this.rimLight.position.set(-4, -2, 3);
    this.scene.add(this.rimLight);

    // Electric red specular glow light
    this.accentLight = new THREE.PointLight(0xFF1744, 3.5, 15);
    this.accentLight.position.set(3, -4, 2);
    this.scene.add(this.accentLight);
  }

  update(time) {
    // Subtle breathing light motion
    if (this.accentLight) {
      this.accentLight.intensity = 3.0 + Math.sin(time * 1.5) * 0.8;
    }
  }
}
