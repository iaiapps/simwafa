import './bootstrap';

// Shell: toggle sidebar mobile (offcanvas) + toggle password di form login.
(function () {
    const toggle = document.querySelector('[data-sidebar-toggle]');
    const backdrop = document.querySelector('[data-sidebar-backdrop]');

    const setSidebar = (open) => {
        document.body.classList.toggle('sidebar-open', open);
        if (toggle) toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (backdrop) backdrop.hidden = !open;
    };

    if (toggle) {
        toggle.addEventListener('click', () => {
            setSidebar(!document.body.classList.contains('sidebar-open'));
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', () => setSidebar(false));
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') setSidebar(false);
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) setSidebar(false);
    });

    document.querySelectorAll('[data-pw-toggle]').forEach((btn) => {
        const input = document.getElementById(btn.getAttribute('data-pw-toggle'));
        if (!input) return;
        btn.addEventListener('click', () => {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.classList.toggle('bi-eye', !show);
            btn.classList.toggle('bi-eye-slash', show);
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    });
})();
