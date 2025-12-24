document.addEventListener('DOMContentLoaded', () => {
    const themeButtons = document.querySelectorAll('[data-set-theme]');
    const body = document.body;

    const applyTheme = (theme) => {
        body.setAttribute('data-theme', theme);
        themeButtons.forEach(btn => {
            if (btn.getAttribute('data-set-theme') === theme) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    };

    // 1. Check for manual preference
    const savedTheme = localStorage.getItem('preferred-titan-theme');

    // 2. Determine initial theme
    if (savedTheme) {
        applyTheme(savedTheme);
    } else {
        // Automatic detection based on system preference
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)');
        applyTheme(systemPrefersDark.matches ? 'titan-dark' : 'titan-light');

        // Listen for system changes if no manual preference is set
        systemPrefersDark.addEventListener('change', e => {
            if (!localStorage.getItem('preferred-titan-theme')) {
                applyTheme(e.matches ? 'titan-dark' : 'titan-light');
            }
        });
    }

    // 3. Handle manual switching
    themeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const theme = btn.getAttribute('data-set-theme');
            applyTheme(theme);
            localStorage.setItem('preferred-titan-theme', theme);
        });
    });
});
