/**
 * OntarioGamers — Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function () {
            mainNav.classList.toggle('active');
            const isOpen = mainNav.classList.contains('active');
            menuToggle.setAttribute('aria-expanded', isOpen);
            menuToggle.textContent = isOpen ? '✕' : '☰';
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                window.scrollTo({ top: targetPosition, behavior: 'smooth' });
            }
        });
    });

    // Affiliate link click tracking (basic — logs to console in dev)
    document.querySelectorAll('a[rel*="nofollow"]').forEach(function (link) {
        link.addEventListener('click', function () {
            if (typeof gtag === 'function') {
                gtag('event', 'affiliate_click', {
                    'event_category': 'affiliate',
                    'event_label': this.href,
                    'transport_type': 'beacon'
                });
            }
        });
    });

});
