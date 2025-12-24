// Theme Toggle Logic
document.addEventListener('DOMContentLoaded', () => {
    const themeBtn = document.getElementById('theme-toggle');
    const root = document.documentElement;

    const sunIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
        </svg>
    `;

    const moonIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
    `;

    // Initialize Theme
    const savedTheme = localStorage.getItem('titan-theme') || 'titan-dark';
    root.setAttribute('data-theme', savedTheme);
    updateToggleUI(savedTheme);

    if (themeBtn) {
        themeBtn.addEventListener('click', () => {
            const currentTheme = root.getAttribute('data-theme');
            const newTheme = currentTheme === 'titan-dark' ? 'titan-light' : 'titan-dark';

            root.setAttribute('data-theme', newTheme);
            localStorage.setItem('titan-theme', newTheme);
            updateToggleUI(newTheme);
        });
    }

    function updateToggleUI(theme) {
        if (!themeBtn) return;
        // Invert: Show Moon if in Light Mode (to switch to Dark), Sun if in Dark Mode (to switch to Light)
        // Wait, requested sun/moon icon. Usually, the icon represented CURRENT state or target.
        // User said "sun and moon". Let's show Moon for Light mode (click to go dark) and Sun for Dark (click to go light)
        // Actually, many users prefer the icon to be the CURRENT state. Let's show Moon in Dark, Sun in Light.
        themeBtn.innerHTML = theme === 'titan-dark' ? moonIcon : sunIcon;
        themeBtn.title = theme === 'titan-dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode';
    }
});
