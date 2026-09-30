/**
 * Rakta Elementor Frontend & Editor Bridge
 * Ensures Three.js scenes, GSAP animations, and interactive tabs re-bind instantly inside Elementor
 */
(function($) {
  'use strict';

  $(window).on('elementor/frontend/init', function() {

    // 1. Hero 3D Widget Hook
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_hero_3d.default', function($scope) {
      var canvas = $scope.find('.rakta-hero-canvas')[0] || $scope.find('#hero-canvas')[0];
      if (!canvas) return;

      var attempts = 0;
      var mount = function() {
        if (window.Rakta3DEngine) {
          delete canvas.dataset.raktaInitialized;
          window.Rakta3DEngine.mountHero(canvas);
          window.Rakta3DEngine.reinitElements($scope[0]);
        } else if (attempts < 40) {
          attempts++;
          setTimeout(mount, 50);
        }
      };
      mount();
    });

    // 2. Ecosystem 3D Widget Hook
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_ecosystem_3d.default', function($scope) {
      var canvas = $scope.find('.rakta-ecosystem-canvas')[0] || $scope.find('#ecosystem-canvas')[0];
      if (!canvas) return;

      var attempts = 0;
      var mount = function() {
        if (window.Rakta3DEngine) {
          delete canvas.dataset.raktaInitialized;
          window.Rakta3DEngine.mountEcosystem(canvas);
          window.Rakta3DEngine.reinitElements($scope[0]);
        } else if (attempts < 40) {
          attempts++;
          setTimeout(mount, 50);
        }
      };
      mount();
    });

    // 3. Services Grid Hook
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_services.default', function($scope) {
      if (window.Rakta3DEngine) {
        window.Rakta3DEngine.reinitElements($scope[0]);
      }
    });

    // 4. Solutions Tabs Hook
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_solutions.default', function($scope) {
      var tabBtns = $scope.find('.solution-tab-btn');
      var panels = $scope.find('.solutions-content-panel');
      tabBtns.off('click').on('click', function() {
        var cat = $(this).data('tab');
        tabBtns.removeClass('active');
        panels.removeClass('active');
        $(this).addClass('active');
        $scope.find('.solutions-content-panel[data-category="' + cat + '"]').addClass('active');
      });
      if (window.Rakta3DEngine) {
        window.Rakta3DEngine.reinitElements($scope[0]);
      }
    });

    // 5. Portfolio Filter Hook
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_portfolio.default', function($scope) {
      var filterBtns = $scope.find('.portfolio-filter-btn');
      var cards = $scope.find('.project-card');
      filterBtns.off('click').on('click', function() {
        var filter = $(this).data('filter');
        filterBtns.removeClass('active');
        $(this).addClass('active');
        if (filter === 'all' || !filter) {
          cards.fadeIn(250);
        } else {
          cards.each(function() {
            var cat = $(this).data('category');
            if (cat === filter) {
              $(this).fadeIn(250);
            } else {
              $(this).fadeOut(150);
            }
          });
        }
      });
      if (window.Rakta3DEngine) {
        window.Rakta3DEngine.reinitElements($scope[0]);
      }
    });

    // 6. Stats Counter Hook
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_stats.default', function($scope) {
      $scope.find('.stat-value-num').each(function() {
        var $num = $(this);
        var target = parseFloat($num.attr('data-target') || '0');
        if (window.gsap) {
          window.gsap.fromTo(this, { innerText: 0 }, {
            scrollTrigger: { trigger: this, start: 'top 90%' },
            innerText: target,
            duration: 2.2,
            ease: 'power2.out',
            snap: { innerText: 1 }
          });
        }
      });
    });

    // 7. Process Timeline Hook
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_process.default', function($scope) {
      var track = $scope.find('.timeline-track')[0];
      var fill = $scope.find('.timeline-line-fill')[0];
      var steps = $scope.find('.timeline-step');
      if (track && fill && window.ScrollTrigger) {
        window.ScrollTrigger.create({
          trigger: track,
          start: 'top 70%',
          end: 'bottom 60%',
          scrub: true,
          onUpdate: function(self) {
            fill.style.height = (self.progress * 100) + '%';
            steps.each(function(idx) {
              var threshold = idx / steps.length;
              if (self.progress >= threshold) {
                $(this).addClass('active');
              } else {
                $(this).removeClass('active');
              }
            });
          }
        });
      }
    });

    // General Re-init for CTA, Why Us, Modal
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_cta.default', function($scope) {
      if (window.Rakta3DEngine) window.Rakta3DEngine.reinitElements($scope[0]);
    });
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_why_us.default', function($scope) {
      if (window.Rakta3DEngine) window.Rakta3DEngine.reinitElements($scope[0]);
    });
    elementorFrontend.hooks.addAction('frontend/element_ready/rakta_lead_modal.default', function($scope) {
      if (window.Rakta3DEngine) window.Rakta3DEngine.reinitElements($scope[0]);
    });
  });
})(jQuery);
