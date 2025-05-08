document.addEventListener('DOMContentLoaded', function() {
  "use strict";

  /**
   * Mobile nav toggle - Simplified version
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');
  
  if (mobileNavToggleBtn) {
    function mobileNavToggle() {
      document.querySelector('body').classList.toggle('mobile-nav-active');
      mobileNavToggleBtn.classList.toggle('bi-list');
      mobileNavToggleBtn.classList.toggle('bi-x');
    }
    
    mobileNavToggleBtn.addEventListener('click', mobileNavToggle);

    // Close mobile nav when clicking nav links
    document.querySelectorAll('#navmenu a').forEach(navLink => {
      navLink.addEventListener('click', () => {
        if (document.body.classList.contains('mobile-nav-active')) {
          mobileNavToggle();
        }
      });
    });
  }

  /**
   * Scroll top button - Simplified version
   */
  const scrollTopBtn = document.querySelector('.scroll-top');
  
  if (scrollTopBtn) {
    function toggleScrollTop() {
      window.scrollY > 100 ? scrollTopBtn.classList.add('active') : scrollTopBtn.classList.remove('active');
    }
    
    scrollTopBtn.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    window.addEventListener('load', toggleScrollTop);
    document.addEventListener('scroll', toggleScrollTop);
  }

  /**
   * Smooth scrolling for anchor links
   */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#' || !document.querySelector(targetId)) return;
      
      e.preventDefault();
      
      const targetElement = document.querySelector(targetId);
      const headerHeight = document.querySelector('#header')?.offsetHeight || 70;
      const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
      
      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth'
      });
    });
  });
});