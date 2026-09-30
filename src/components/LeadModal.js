export class LeadModal {
  constructor() {
    this.dialog = document.querySelector('dialog.lead-modal');
    this.triggers = document.querySelectorAll('[data-open-lead-modal]');
    this.closeBtn = document.querySelector('.modal-close-btn');
    this.form = document.querySelector('#lead-project-form');
    this.feedback = document.querySelector('.form-feedback');

    this.init();
  }

  init() {
    if (!this.dialog) return;

    // Trigger buttons
    this.triggers.forEach((trigger) => {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        this.open();
      });
    });

    // Close button
    if (this.closeBtn) {
      this.closeBtn.addEventListener('click', () => this.close());
    }

    // Light dismiss: Close on outside backdrop click
    this.dialog.addEventListener('click', (e) => {
      const rect = this.dialog.getBoundingClientRect();
      const isInDialog = (
        rect.top <= e.clientY &&
        e.clientY <= rect.top + rect.height &&
        rect.left <= e.clientX &&
        e.clientX <= rect.left + rect.width
      );
      if (!isInDialog) {
        this.close();
      }
    });

    // Form submission
    if (this.form) {
      this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }
  }

  open() {
    if (typeof this.dialog.showModal === 'function') {
      this.dialog.showModal();
    } else {
      this.dialog.setAttribute('open', '');
    }
    document.body.style.overflow = 'hidden';
  }

  close() {
    if (typeof this.dialog.close === 'function') {
      this.dialog.close();
    } else {
      this.dialog.removeAttribute('open');
    }
    document.body.style.overflow = '';
  }

  async handleSubmit(e) {
    e.preventDefault();
    const submitBtn = this.form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;

    // Read form values
    const formData = new FormData(this.form);
    const data = Object.fromEntries(formData.entries());

    // Validation
    if (!data.name || !data.email || !data.service) {
      this.showFeedback('Please fill out all required fields (Name, Email, Service).', 'error');
      return;
    }

    // Interactive button loading state
    submitBtn.disabled = true;
    submitBtn.textContent = 'Transmitting Project Scope...';
    this.showFeedback('', '');

    try {
      // Simulated AJAX dispatch (compatible with future WordPress REST API /wp-json/rakta/v1/lead or n8n webhook)
      await new Promise((resolve) => setTimeout(resolve, 1200));

      this.showFeedback(
        `Thank you, ${data.name}! Your project brief has been received. Our Lead Solutions Architect will contact you within 24 hours.`,
        'success'
      );
      this.form.reset();

      setTimeout(() => {
        this.close();
        this.showFeedback('', '');
      }, 4000);
    } catch (err) {
      this.showFeedback('An error occurred while submitting. Please email us directly at contact@raktainfotech.com.', 'error');
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    }
  }

  showFeedback(message, type) {
    if (!this.feedback) return;
    this.feedback.textContent = message;
    this.feedback.className = `form-feedback ${type}`;
    if (!message) {
      this.feedback.style.display = 'none';
    } else {
      this.feedback.style.display = 'block';
    }
  }
}
