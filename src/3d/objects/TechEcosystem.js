import * as THREE from 'three';
import { ecosystemNodes } from '../../data/technologies.js';

export class TechEcosystem {
  constructor() {
    this.group = new THREE.Group();
    this.satellites = new Map();
    this.beams = new Map();
    this.activeNodeId = null;
    this.targetRotationY = 0;

    this.initCentralCore();
    this.initSatelliteNodes();
  }

  initCentralCore() {
    // Inner pulsating core
    const coreGeo = new THREE.IcosahedronGeometry(0.85, 1);
    const coreMat = new THREE.MeshStandardMaterial({
      color: 0x090D18,
      metalness: 0.9,
      roughness: 0.2,
      emissive: 0x0066FF,
      emissiveIntensity: 0.6
    });
    this.coreMesh = new THREE.Mesh(coreGeo, coreMat);
    this.group.add(this.coreMesh);

    // Outer wireframe halo in cyan
    const haloGeo = new THREE.IcosahedronGeometry(1.05, 2);
    const haloMat = new THREE.MeshBasicMaterial({
      color: 0x00F0FF,
      wireframe: true,
      transparent: true,
      opacity: 0.4,
      blending: THREE.AdditiveBlending
    });
    this.haloMesh = new THREE.Mesh(haloGeo, haloMat);
    this.group.add(this.haloMesh);
  }

  initSatelliteNodes() {
    const orbitRadius = 2.6;

    ecosystemNodes.forEach((node, idx) => {
      const angle = (idx / ecosystemNodes.length) * Math.PI * 2;
      const x = Math.cos(angle) * orbitRadius;
      const z = Math.sin(angle) * orbitRadius;
      const y = Math.sin(angle * 2) * 0.35; // Slight wave elevation

      // Satellite sphere
      const satGeo = new THREE.SphereGeometry(0.2, 16, 16);
      const satMat = new THREE.MeshStandardMaterial({
        color: 0x0B0B12,
        metalness: 0.8,
        roughness: 0.25,
        emissive: new THREE.Color(node.color),
        emissiveIntensity: 0.6
      });

      const satMesh = new THREE.Mesh(satGeo, satMat);
      satMesh.position.set(x, y, z);
      satMesh.userData = { id: node.id, angle, baseScale: 1 };
      this.group.add(satMesh);
      this.satellites.set(node.id, satMesh);

      // Energy beam line from center to satellite
      const beamGeo = new THREE.BufferGeometry().setFromPoints([
        new THREE.Vector3(0, 0, 0),
        new THREE.Vector3(x, y, z)
      ]);

      const beamMat = new THREE.LineBasicMaterial({
        color: new THREE.Color(node.color),
        transparent: true,
        opacity: 0.2,
        blending: THREE.AdditiveBlending
      });

      const beam = new THREE.Line(beamGeo, beamMat);
      this.group.add(beam);
      this.beams.set(node.id, beam);
    });
  }

  setActiveNode(id) {
    this.activeNodeId = id;
    const sat = this.satellites.get(id);

    if (sat) {
      // Calculate target rotation so center core faces the active satellite
      this.targetRotationY = -sat.userData.angle + Math.PI / 2;
    }

    // Update glowing beam and satellite appearance
    this.beams.forEach((beam, key) => {
      if (key === id) {
        beam.material.opacity = 0.95;
        beam.material.linewidth = 2;
      } else {
        beam.material.opacity = 0.15;
        beam.material.linewidth = 1;
      }
    });

    this.satellites.forEach((satellite, key) => {
      if (key === id) {
        satellite.scale.set(1.4, 1.4, 1.4);
        satellite.material.emissiveIntensity = 1.4;
      } else {
        satellite.scale.set(1.0, 1.0, 1.0);
        satellite.material.emissiveIntensity = 0.45;
      }
    });
  }

  update(time, delta) {
    // Gentle ambient orbit tilt
    this.group.rotation.x = 0.35 + Math.sin(time * 0.4) * 0.05;

    // Smoothly interpolate rotation to face active node
    if (this.activeNodeId) {
      this.group.rotation.y += (this.targetRotationY - this.group.rotation.y) * 0.08;
    } else {
      this.group.rotation.y += delta * 0.25;
    }

    // Core pulsing animation
    this.coreMesh.rotation.x = time * 0.3;
    this.coreMesh.rotation.z = time * 0.2;
    this.haloMesh.rotation.y = -time * 0.4;

    const pulse = 1.0 + Math.sin(time * 2.5) * 0.06;
    this.coreMesh.scale.set(pulse, pulse, pulse);
  }
}
