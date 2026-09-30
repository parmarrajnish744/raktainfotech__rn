import * as THREE from 'three';

export class HeroCore {
  constructor() {
    this.group = new THREE.Group();
    this.rings = [];
    this.nodes = [];
    this.nodeLines = null;

    this.initCore();
    this.initLatticeShell();
    this.initEnergyRings();
    this.initDigitalNodes();
  }

  initCore() {
    // Futuristic dark metallic sphere with royal blue emissive reflection
    const sphereGeo = new THREE.SphereGeometry(1.5, 64, 64);
    const sphereMat = new THREE.MeshStandardMaterial({
      color: 0x060B18,
      metalness: 0.95,
      roughness: 0.15,
      emissive: 0x002244,
      emissiveIntensity: 0.5
    });

    this.coreMesh = new THREE.Mesh(sphereGeo, sphereMat);
    this.group.add(this.coreMesh);
  }

  initLatticeShell() {
    // Outer geometric digital wireframe facet in cyan
    const latticeGeo = new THREE.IcosahedronGeometry(1.65, 2);
    const latticeMat = new THREE.MeshBasicMaterial({
      color: 0x00F0FF,
      wireframe: true,
      transparent: true,
      opacity: 0.3,
      blending: THREE.AdditiveBlending
    });

    this.latticeMesh = new THREE.Mesh(latticeGeo, latticeMat);
    this.group.add(this.latticeMesh);
  }

  initEnergyRings() {
    const ringConfigs = [
      { radius: 2.2, tube: 0.022, rotX: Math.PI / 3, rotY: Math.PI / 6, speed: 0.4, color: 0x0066FF },
      { radius: 2.65, tube: 0.016, rotX: -Math.PI / 4, rotY: Math.PI / 3, speed: -0.3, color: 0x00F0FF },
      { radius: 3.1, tube: 0.012, rotX: Math.PI / 6, rotY: -Math.PI / 4, speed: 0.2, color: 0x38BDF8 }
    ];

    ringConfigs.forEach((cfg) => {
      const ringGeo = new THREE.TorusGeometry(cfg.radius, cfg.tube, 16, 120);
      const ringMat = new THREE.MeshBasicMaterial({
        color: cfg.color,
        transparent: true,
        opacity: 0.8,
        blending: THREE.AdditiveBlending
      });

      const ring = new THREE.Mesh(ringGeo, ringMat);
      ring.rotation.x = cfg.rotX;
      ring.rotation.y = cfg.rotY;

      this.group.add(ring);
      this.rings.push({ mesh: ring, speed: cfg.speed });
    });
  }

  initDigitalNodes() {
    const nodeCount = 28;
    const positions = [];
    const pointsGeo = new THREE.BufferGeometry();
    const nodePositions = new Float32Array(nodeCount * 3);

    for (let i = 0; i < nodeCount; i++) {
      const theta = Math.random() * Math.PI * 2;
      const phi = Math.acos(Math.random() * 2 - 1);
      const r = 1.9 + Math.random() * 0.7;

      const x = r * Math.sin(phi) * Math.cos(theta);
      const y = r * Math.sin(phi) * Math.sin(theta);
      const z = r * Math.cos(phi);

      nodePositions[i * 3] = x;
      nodePositions[i * 3 + 1] = y;
      nodePositions[i * 3 + 2] = z;
      positions.push(new THREE.Vector3(x, y, z));
    }

    pointsGeo.setAttribute('position', new THREE.BufferAttribute(nodePositions, 3));
    const pointsMat = new THREE.PointsMaterial({
      color: 0x00F0FF,
      size: 0.075,
      transparent: true,
      opacity: 0.95,
      blending: THREE.AdditiveBlending
    });

    this.nodesMesh = new THREE.Points(pointsGeo, pointsMat);
    this.group.add(this.nodesMesh);

    // Build connections between nearby nodes
    const lineIndices = [];
    for (let i = 0; i < positions.length; i++) {
      for (let j = i + 1; j < positions.length; j++) {
        const dist = positions[i].distanceTo(positions[j]);
        if (dist < 1.35) {
          lineIndices.push(
            positions[i].x, positions[i].y, positions[i].z,
            positions[j].x, positions[j].y, positions[j].z
          );
        }
      }
    }

    const lineGeo = new THREE.BufferGeometry();
    lineGeo.setAttribute('position', new THREE.Float32BufferAttribute(lineIndices, 3));
    const lineMat = new THREE.LineBasicMaterial({
      color: 0x0066FF,
      transparent: true,
      opacity: 0.35,
      blending: THREE.AdditiveBlending
    });

    this.nodeLines = new THREE.LineSegments(lineGeo, lineMat);
    this.group.add(this.nodeLines);
  }

  update(time, delta) {
    // Ambient core rotation
    this.coreMesh.rotation.y = time * 0.15;
    this.latticeMesh.rotation.y = -time * 0.12;
    this.latticeMesh.rotation.x = Math.sin(time * 0.1) * 0.15;

    // Energy rings independent rotation
    this.rings.forEach((r, idx) => {
      r.mesh.rotation.z += r.speed * delta;
      // Subtle pulsing opacity
      r.mesh.material.opacity = 0.55 + Math.sin(time * 2 + idx) * 0.25;
    });

    // Orbiting nodes & network line slow rotation
    if (this.nodesMesh) {
      this.nodesMesh.rotation.y = time * 0.08;
      this.nodesMesh.rotation.z = Math.sin(time * 0.05) * 0.1;
    }
    if (this.nodeLines) {
      this.nodeLines.rotation.y = time * 0.08;
      this.nodeLines.rotation.z = Math.sin(time * 0.05) * 0.1;
    }

    // Gentle vertical floating motion
    this.group.position.y = Math.sin(time * 0.8) * 0.08;
  }
}
