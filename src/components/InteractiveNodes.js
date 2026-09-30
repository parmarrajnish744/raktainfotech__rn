import { ecosystemNodes } from '../data/technologies.js';

export class InteractiveNodes {
  constructor(ecosystem3DInstance) {
    this.ecosystem3D = ecosystem3DInstance;
    this.nodeCards = document.querySelectorAll('.node-card');
    this.detailTitle = document.querySelector('.node-detail-panel .detail-title');
    this.detailDesc = document.querySelector('.node-detail-panel .detail-desc');
    this.detailStats = document.querySelector('.node-detail-panel .detail-stats');

    this.init();
  }

  init() {
    this.nodeCards.forEach((card) => {
      const id = card.getAttribute('data-node-id');

      card.addEventListener('mouseenter', () => this.activateNode(id));
      card.addEventListener('click', () => this.activateNode(id));
      card.addEventListener('focus', () => this.activateNode(id));
    });

    // Default activate first node (AI)
    if (ecosystemNodes.length > 0) {
      this.activateNode(ecosystemNodes[0].id);
    }
  }

  activateNode(id) {
    const nodeData = ecosystemNodes.find((n) => n.id === id);
    if (!nodeData) return;

    // Update active class on cards
    this.nodeCards.forEach((c) => {
      if (c.getAttribute('data-node-id') === id) {
        c.classList.add('active');
      } else {
        c.classList.remove('active');
      }
    });

    // Update 3D scene
    if (this.ecosystem3D && typeof this.ecosystem3D.setActiveNode === 'function') {
      this.ecosystem3D.setActiveNode(id);
    }

    // Update Detail Panel DOM
    if (this.detailTitle) this.detailTitle.textContent = nodeData.title;
    if (this.detailDesc) this.detailDesc.textContent = nodeData.description;
    if (this.detailStats) this.detailStats.textContent = nodeData.stats;
  }
}
