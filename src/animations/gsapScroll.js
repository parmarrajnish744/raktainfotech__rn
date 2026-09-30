import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export class MotionDesigner {
  constructor() {
    this.isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (this.isReducedMotion) return;

    this.initHeroEntrance();
    this.initScrollReveals();
    this.initStatsCounters();
    this.initTimelineProgress();
    this.initSolutionsTabs();
    this.initCardTilt();
  }

  initHeroEntrance() {
    const tl = gsap.timeline({ defaults: { ease: 'power3.out', duration: 1.0 } });

    tl.from('.site-header', {
      y: -40,
      opacity: 0,
      duration: 0.8
    })
    .from('.hero-content .badge-tag', {
      opacity: 0,
      y: 20,
      duration: 0.6
    }, '-=0.4')
    .from('.heading-hero', {
      opacity: 0,
      y: 40,
      duration: 0.9
    }, '-=0.4')
    .from('.hero-subtitle', {
      opacity: 0,
      y: 25,
      duration: 0.7
    }, '-=0.5')
    .from('.hero-ctas > *', {
      opacity: 0,
      y: 20,
      stagger: 0.15,
      duration: 0.6
    }, '-=0.4');
  }

  initScrollReveals() {
    const sections = document.querySelectorAll('.section-header');
    sections.forEach((header) => {
      gsap.from(header, {
        scrollTrigger: {
          trigger: header,
          start: 'top 85%',
          toggleActions: 'play none none none'
        },
        opacity: 0,
        y: 40,
        duration: 0.9,
        ease: 'power3.out'
      });
    });

    const cards = document.querySelectorAll('.service-card, .solution-item-card, .project-card, .bento-card, .tech-card');
    cards.forEach((card) => {
      gsap.from(card, {
        scrollTrigger: {
          trigger: card,
          start: 'top 90%',
          toggleActions: 'play none none none'
        },
        opacity: 0,
        y: 35,
        duration: 0.8,
        ease: 'power3.out'
      });
    });
  }

  initStatsCounters() {
    const statValues = document.querySelectorAll('.stat-value-num');
    statValues.forEach((elem) => {
      const target = parseFloat(elem.getAttribute('data-target') || '0');

      gsap.fromTo(elem, 
        { innerText: 0 },
        {
          scrollTrigger: {
            trigger: elem,
            start: 'top 90%',
            toggleActions: 'play none none none'
          },
          innerText: target,
          duration: 2.2,
          ease: 'power2.out',
          snap: { innerText: 1 }
        }
      );
    });
  }

  initTimelineProgress() {
    const track = document.querySelector('.timeline-track');
    const fill = document.querySelector('.timeline-line-fill');
    const steps = document.querySelectorAll('.timeline-step');

    if (!track || !fill) return;

    ScrollTrigger.create({
      trigger: track,
      start: 'top 70%',
      end: 'bottom 60%',
      scrub: true,
      onUpdate: (self) => {
        fill.style.height = `${self.progress * 100}%`;

        // Activate steps as progress reaches them
        const total = steps.length;
        steps.forEach((step, idx) => {
          const threshold = idx / total;
          if (self.progress >= threshold) {
            step.classList.add('active');
          } else {
            step.classList.remove('active');
          }
        });
      }
    });
  }

  initSolutionsTabs() {
    const tabBtns = document.querySelectorAll('.solution-tab-btn');
    const panels = document.querySelectorAll('.solutions-content-panel');

    tabBtns.forEach((btn) => {
      btn.addEventListener('click', () => {
        const cat = btn.getAttribute('data-tab');

        tabBtns.forEach((b) => b.classList.remove('active'));
        panels.forEach((p) => p.classList.remove('active'));

        btn.classList.add('active');
        const activePanel = document.querySelector(`.solutions-content-panel[data-category="${cat}"]`);
        if (activePanel) {
          activePanel.classList.add('active');
          gsap.from(activePanel.querySelectorAll('.solution-item-card'), {
            opacity: 0,
            y: 20,
            stagger: 0.1,
            duration: 0.5,
            ease: 'power2.out'
          });
        }
      });
    });
  }

  initCardTilt() {
    const tiltCards = document.querySelectorAll('.service-card, .project-card');

    tiltCards.forEach((card) => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((y - centerY) / centerY) * -5;
        const rotateY = ((x - centerX) / centerX) * 5;

        gsap.to(card, {
          rotateX: rotateX,
          rotateY: rotateY,
          transformPerspective: 1000,
          duration: 0.3,
          ease: 'power1.out'
        });
      });

      card.addEventListener('mouseleave', () => {
        gsap.to(card, {
          rotateX: 0,
          rotateY: 0,
          duration: 0.5,
          ease: 'power2.out'
        });
      });
    });
  }
}
