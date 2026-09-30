import * as THREE from 'three';

export class ParticleSystem {
  constructor(count = 800, radius = 10) {
    this.count = count;
    this.radius = radius;
    this.group = new THREE.Group();

    this.initParticles();
  }

  initParticles() {
    const geometry = new THREE.BufferGeometry();
    const positions = new Float32Array(this.count * 3);
    const colors = new Float32Array(this.count * 3);
    const sizes = new Float32Array(this.count);

    const colorCyan = new THREE.Color(0x00F0FF);
    const colorRoyalBlue = new THREE.Color(0x0066FF);
    const colorSky = new THREE.Color(0x38BDF8);
    const colorWhite = new THREE.Color(0xEEEEFF);

    for (let i = 0; i < this.count; i++) {
      // Spherical distribution with random radius
      const u = Math.random();
      const v = Math.random();
      const theta = u * 2.0 * Math.PI;
      const phi = Math.acos(2.0 * v - 1.0);
      const r = Math.cbrt(Math.random()) * this.radius;

      const sinPhi = Math.sin(phi);
      positions[i * 3] = r * sinPhi * Math.cos(theta);
      positions[i * 3 + 1] = r * sinPhi * Math.sin(theta);
      positions[i * 3 + 2] = r * Math.cos(phi);

      // Color variation: 45% cyan, 35% royal blue, 20% silver-white
      const rand = Math.random();
      const chosenColor = rand < 0.45 ? colorCyan : (rand < 0.8 ? colorRoyalBlue : colorWhite);

      colors[i * 3] = chosenColor.r;
      colors[i * 3 + 1] = chosenColor.g;
      colors[i * 3 + 2] = chosenColor.b;

      sizes[i] = Math.random() * 2.5 + 1.0;
    }

    geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
    geometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1));

    // Particle Material with additive blending
    const material = new THREE.PointsMaterial({
      size: 0.05,
      vertexColors: true,
      transparent: true,
      opacity: 0.75,
      blending: THREE.AdditiveBlending,
      depthWrite: false
    });

    this.points = new THREE.Points(geometry, material);
    this.group.add(this.points);
  }

  update(time, delta) {
    if (!this.points) return;
    this.points.rotation.y = time * 0.03;
    this.points.rotation.x = Math.sin(time * 0.02) * 0.05;
  }
}
