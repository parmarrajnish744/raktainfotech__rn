export class Header {
  constructor() {
    this.header = document.querySelector('.site-header');
    this.mobileBtn = document.querySelector('.mobile-menu-btn');
    this.mobileDrawer = document.querySelector('.mobile-nav-drawer');
    this.navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
    this.isOpen = false;

    this.init();
  }

  init() {
    this.initScrollListener();
    this.initMobileMenu();
    this.initSmoothScroll();
  }

  initScrollListener() {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 40) {
        this.header.classList.add('scrolled');
      } else {
        this.header.classList.remove('scrolled');
      }
    }, { passive: true });
  }

  initMobileMenu() {
    if (!this.mobileBtn || !this.mobileDrawer) return;

    this.mobileBtn.addEventListener('click', () => {
      this.toggleMobileMenu();
    });

    // Close on escape
    window.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isOpen) {
        this.toggleMobileMenu(false);
      }
    });
  }

  toggleMobileMenu(forceState) {
    this.isOpen = forceState !== undefined ? forceState : !this.isOpen;
    this.mobileDrawer.classList.toggle('open', this.isOpen);
    this.mobileBtn.setAttribute('aria-expanded', this.isOpen ? 'true' : 'false');
    document.body.style.overflow = this.isOpen ? 'hidden' : '';
  }

  initSmoothScroll() {
    this.navLinks.forEach((link) => {
      link.addEventListener('click', (e) => {
        const targetId = link.getAttribute('href');
        if (targetId && targetId.startsWith('#')) {
          e.preventDefault();
          const targetElem = document.querySelector(targetId);
          if (targetElem) {
            if (this.isOpen) {
              this.toggleMobileMenu(false);
            }
            targetElem.scrollIntoView({ behavior: 'smooth' });
          }
        }
      });
    });
  }
}
