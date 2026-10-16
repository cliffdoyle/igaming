/**
 * Homepage: highlight the active section in the sticky "On this page" nav.
 */
(function () {
    var nav = document.querySelector('.hp-jump');
    if (!nav || !('IntersectionObserver' in window)) {
        return;
    }

    var links = Array.prototype.slice.call(nav.querySelectorAll('a[href^="#"]'));
    var sections = links
        .map(function (a) { return document.getElementById(a.getAttribute('href').slice(1)); })
        .filter(Boolean);

    function setActive(id) {
        links.forEach(function (a) {
            var on = a.getAttribute('href') === '#' + id;
            a.classList.toggle('is-active', on);
            if (on) {
                a.setAttribute('aria-current', 'location');
                // Keep the active chip visible on narrow screens without moving the page.
                var list = a.parentNode.parentNode;
                var left = a.offsetLeft - (list.clientWidth - a.offsetWidth) / 2;
                list.scrollTo({ left: left, behavior: 'smooth' });
            } else {
                a.removeAttribute('aria-current');
            }
        });
    }

    var visible = {};
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { visible[e.target.id] = e.isIntersecting; });
        for (var i = 0; i < sections.length; i++) {
            if (visible[sections[i].id]) {
                setActive(sections[i].id);
                return;
            }
        }
    }, { rootMargin: '-140px 0px -55% 0px', threshold: 0 });

    sections.forEach(function (s) { observer.observe(s); });
})();
