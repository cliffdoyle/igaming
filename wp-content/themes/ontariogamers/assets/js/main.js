/**
 * OntarioGamers — Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const body = document.body;

    if (menuToggle && mainNav) {

        const openMenu = function () {
            mainNav.classList.add('active');
            menuToggle.setAttribute('aria-expanded', 'true');
            menuToggle.setAttribute('aria-label', 'Close menu');
            menuToggle.textContent = '✕';
            body.classList.add('menu-open');
        };

        const closeMenu = function () {
            mainNav.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.setAttribute('aria-label', 'Open menu');
            menuToggle.textContent = '☰';
            body.classList.remove('menu-open');
        };

        // Toggle on button click
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            if (mainNav.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        // Close when a menu link is tapped
        mainNav.addEventListener('click', function (e) {
            if (e.target.closest('a')) {
                closeMenu();
            }
        });

        // Close when tapping outside the menu
        document.addEventListener('click', function (e) {
            if (
                mainNav.classList.contains('active') &&
                !mainNav.contains(e.target) &&
                !menuToggle.contains(e.target)
            ) {
                closeMenu();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && mainNav.classList.contains('active')) {
                closeMenu();
                menuToggle.focus();
            }
        });

        // Reset menu state when resizing up to desktop
        let resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if (window.innerWidth > 768) {
                    closeMenu();
                }
            }, 150);
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
