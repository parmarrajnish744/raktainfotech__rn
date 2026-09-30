import './style.css';
import { servicesData } from './data/services.js';
import { solutionsCategories } from './data/solutions.js';
import { projectsData } from './data/projects.js';
import { processSteps } from './data/processSteps.js';
import { ecosystemNodes, techStackData, whyUsData } from './data/technologies.js';

import { SceneManager } from './3d/core/SceneManager.js';
import { HeroCore } from './3d/objects/HeroCore.js';
import { TechEcosystem } from './3d/objects/TechEcosystem.js';
import { ParticleSystem } from './3d/systems/ParticleSystem.js';
import { PerformanceManager } from './3d/utils/PerformanceManager.js';
import { WebGLFallback } from './3d/utils/WebGLFallback.js';

import { Header } from './components/Header.js';
import { LeadModal } from './components/LeadModal.js';
import { InteractiveNodes } from './components/InteractiveNodes.js';
import { MotionDesigner } from './animations/gsapScroll.js';

import { BackgroundFX } from './effects/BackgroundFX.js';
import { InteractiveCursor } from './effects/InteractiveCursor.js';
import { CardSpotlight } from './effects/CardSpotlight.js';

class RaktaApp {
  constructor() {
    this.perf = new PerformanceManager();
    this.init();
  }

  init() {
    // 1. Populate dynamic DOM sections from modular data
    this.renderServices();
    this.renderEcosystemNodes();
    this.renderSolutions();
    this.renderProjects();
    this.renderProcess();
    this.renderWhyUs();
    this.renderTechStack();

    // 2. Initialize UI Components
    this.header = new Header();
    this.leadModal = new LeadModal();

    // 3. Initialize 3D Engine
    this.init3DScenes();

    // 4. Initialize GSAP Motion & Interaction Design
    this.motion = new MotionDesigner();

    // 5. Initialize Interactive Background & Cybernetic Cursor System
    this.backgroundFX = new BackgroundFX();
    this.cursor = new InteractiveCursor();
    this.cardSpotlight = new CardSpotlight();
  }

  renderServices() {
    const container = document.getElementById('services-container');
    if (!container) return;

    container.innerHTML = servicesData.map((svc) => `
      <div class="glass-card service-card" data-service-id="${svc.id}">
        <div class="service-icon-box" aria-hidden="true">
          ${svc.icon}
        </div>
        <div class="service-tagline">${svc.tagline}</div>
        <h3 class="heading-card service-title">${svc.title}</h3>
        <p class="text-muted" style="font-size: 0.9rem;">${svc.shortDescription}</p>
        
        <ul class="service-features">
          ${svc.features.map((f) => `
            <li class="service-feature-item">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              <span>${f}</span>
            </li>
          `).join('')}
        </ul>

        <div class="service-footer">
          <button type="button" class="service-link" data-open-lead-modal>
            <span>Learn More & Consult</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </button>
        </div>
      </div>
    `).join('');
  }

  renderEcosystemNodes() {
    const container = document.getElementById('ecosystem-nodes-container');
    if (!container) return;

    container.innerHTML = ecosystemNodes.map((node) => `
      <div class="node-card" data-node-id="${node.id}" tabindex="0" role="button" aria-label="Activate ${node.label} Node">
        <div class="node-card-header">
          <span class="node-label">${node.label}</span>
          <span class="node-status-dot" aria-hidden="true"></span>
        </div>
        <p class="node-desc">${node.title}</p>
      </div>
    `).join('');
  }

  renderSolutions() {
    const container = document.getElementById('solutions-panels-container');
    if (!container) return;

    container.innerHTML = solutionsCategories.map((cat, idx) => `
      <div class="solutions-content-panel ${idx === 0 ? 'active' : ''}" data-category="${cat.id}" role="tabpanel">
        <div style="margin-bottom: 2rem; max-width: 680px;">
          <div class="badge-tag" style="margin-bottom: 0.5rem;">${cat.badge}</div>
          <p class="text-muted" style="font-size: 1.05rem;">${cat.description}</p>
        </div>
        <div class="solutions-grid">
          ${cat.items.map((item) => `
            <div class="solution-item-card">
              <h3 class="solution-item-title">${item.title}</h3>
              <p class="text-muted" style="font-size: 0.9rem;">${item.desc}</p>
              <div class="solution-item-tags">
                ${item.tags.map((t) => `<span class="solution-tag">${t}</span>`).join('')}
              </div>
            </div>
          `).join('')}
        </div>
      </div>
    `).join('');
  }

  renderProjects() {
    const container = document.getElementById('projects-container');
    if (!container) return;

    container.innerHTML = projectsData.map((p) => `
      <div class="glass-card project-card" data-project-id="${p.id}">
        <div class="project-media-wrap">
          <div class="project-media-content" style="background: ${p.accentGradient};">
            <span class="badge-tag" style="margin-bottom: 1rem;">${p.category}</span>
            <h4 style="font-family: var(--font-display); font-size: 1.4rem; color: #FFFFFF; margin-bottom: 0.5rem;">${p.title}</h4>
            <div style="font-size: 0.85rem; color: var(--red-bright);">${p.client}</div>
          </div>
        </div>

        <div class="project-meta-row">
          <span class="project-category">${p.category}</span>
          <span class="project-metrics">${p.metrics}</span>
        </div>

        <h3 class="heading-card" style="margin-bottom: 0.5rem;">${p.title}</h3>
        <p class="text-muted" style="font-size: 0.9rem;">${p.shortDescription}</p>

        <div class="project-tech-pills">
          ${p.technologies.map((t) => `<span class="tech-pill">${t}</span>`).join('')}
        </div>

        <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
          <button type="button" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;" data-open-lead-modal>
            View Project Architecture
          </button>
          <span style="font-size: 0.8rem; color: var(--red-bright); font-weight: 600;">Enterprise Solution →</span>
        </div>
      </div>
    `).join('');
  }

  renderProcess() {
    const container = document.getElementById('process-steps-container');
    if (!container) return;

    container.innerHTML = processSteps.map((s, idx) => `
      <div class="timeline-step ${idx === 0 ? 'active' : ''}" data-step="${s.step}">
        <div class="step-node" aria-hidden="true">${s.step}</div>
        <div class="step-content">
          <div class="step-header">
            <span class="step-phase">${s.phase}</span>
          </div>
          <h3 class="heading-card" style="margin-bottom: 0.5rem;">${s.title}</h3>
          <p class="text-muted" style="font-size: 0.9rem;">${s.description}</p>
          <div class="step-deliverable">
            <strong>Key Output:</strong> ${s.deliverable}
          </div>
        </div>
      </div>
    `).join('');
  }

  renderWhyUs() {
    const container = document.getElementById('why-us-container');
    if (!container) return;

    container.innerHTML = whyUsData.map((item) => `
      <div class="glass-card bento-card">
        <div class="bento-tag">${item.tag}</div>
        <h3 class="heading-card" style="margin-bottom: 0.75rem;">${item.title}</h3>
        <p class="text-muted" style="font-size: 0.9rem;">${item.description}</p>
      </div>
    `).join('');
  }

  renderTechStack() {
    const container = document.getElementById('tech-stack-container');
    if (!container) return;

    container.innerHTML = techStackData.map((tech) => `
      <div class="tech-card">
        <div class="tech-cat">${tech.category}</div>
        <div class="tech-name">${tech.name}</div>
        <div class="tech-level">${tech.level}</div>
      </div>
    `).join('');
  }

  init3DScenes() {
    const heroCanvas = document.getElementById('hero-canvas');
    const ecosystemCanvas = document.getElementById('ecosystem-canvas');

    if (!this.perf.hasWebGL) {
      console.warn('WebGL is unavailable on this device. Activating high-performance static fallback.');
      WebGLFallback.activate('.hero-3d-container', '.hero-fallback');
      return;
    }

    try {
      // 1. Initialize Hero 3D Scene
      if (heroCanvas) {
        this.heroSceneManager = new SceneManager(heroCanvas, { fov: 45 });
        this.heroCore = new HeroCore();
        this.heroParticles = new ParticleSystem(800, 12);

        this.heroSceneManager.add(this.heroCore);
        this.heroSceneManager.add(this.heroParticles);
      }

      // 2. Initialize Ecosystem 3D Scene
      if (ecosystemCanvas) {
        this.ecosystemSceneManager = new SceneManager(ecosystemCanvas, { fov: 40 });
        this.ecosystem3D = new TechEcosystem();
        this.ecosystemSceneManager.add(this.ecosystem3D);

        // Bind interactive DOM cards to 3D reactions
        this.interactiveNodes = new InteractiveNodes(this.ecosystem3D);
      }
    } catch (err) {
      console.error('Error during 3D engine initialization:', err);
      WebGLFallback.activate('.hero-3d-container', '.hero-fallback');
    }
  }
}

// Bootstrap on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
  window.__raktaApp = new RaktaApp();
});
