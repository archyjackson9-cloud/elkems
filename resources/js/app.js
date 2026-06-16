/* ELD Solutions — Frontend JS */

document.addEventListener('DOMContentLoaded', () => {

    /* ---- Navbar scroll shadow ---- */
    const nav = document.getElementById('mainNav');
    if (nav) {
        const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 30);
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ---- Active nav link via Intersection Observer ---- */
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('#mainNav .nav-link[href*="#"]');

    if (sections.length && navLinks.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    const active = document.querySelector(`#mainNav .nav-link[href="#${entry.target.id}"]`);
                    if (active) active.classList.add('active');
                }
            });
        }, { threshold: 0.3 });
        sections.forEach(s => observer.observe(s));
    }

    /* ---- Smooth scroll for anchor links ---- */
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', e => {
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const offset = (nav ? nav.offsetHeight : 0) + 8;
                window.scrollTo({ top: target.offsetTop - offset, behavior: 'smooth' });
                const collapse = document.querySelector('.navbar-collapse.show');
                if (collapse) collapse.classList.remove('show');
            }
        });
    });

    /* ---- Scroll-to-top button ---- */
    const scrollBtn = document.getElementById('scrollTop');
    if (scrollBtn) {
        window.addEventListener('scroll', () => {
            scrollBtn.style.display = window.scrollY > 400 ? 'flex' : 'none';
        }, { passive: true });
        scrollBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    }

    /* ---- Flash messages auto-dismiss ---- */
    setTimeout(() => {
        document.querySelectorAll('.auto-dismiss').forEach(el => {
            el.style.transition = 'opacity .5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 5000);

    /* ---- Admin sidebar toggle (mobile) ---- */
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar       = document.querySelector('.admin-sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
        document.addEventListener('click', e => {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    }

    /* ---- Image file preview ---- */
    document.querySelectorAll('input[type="file"][data-preview]').forEach(input => {
        input.addEventListener('change', () => {
            const preview = document.getElementById(input.dataset.preview);
            if (preview && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
                reader.readAsDataURL(input.files[0]);
            }
        });
    });

    /* ---- Delete confirmation ---- */
    document.querySelectorAll('[data-confirm]').forEach(btn => {
        btn.addEventListener('click', e => {
            if (!confirm(btn.dataset.confirm || 'Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });

});
