// Cookie Banner Logic
document.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('cookie-banner');
    const acceptBtn = document.getElementById('accept-cookies');
    const rejectBtn = document.getElementById('reject-cookies');

    const configureBtn = document.getElementById('configure-cookies');

    // Helper to set cookie
    const setDecision = (decision) => {
        localStorage.setItem('cookies-consent', decision);
        // Also set a real cookie for 1 year
        document.cookie = `cookies-consent=${decision}; max-age=${60 * 60 * 24 * 365}; path=/; SameSite=Lax`;
        banner.classList.remove('visible');
    };

    // Check if previously decided
    if (!localStorage.getItem('cookies-consent') && !document.cookie.includes('cookies-consent=')) {
        // Show banner with a slight delay for animation
        setTimeout(() => {
            banner.classList.add('visible');
        }, 1000);
    }

    if (acceptBtn) {
        acceptBtn.addEventListener('click', () => setDecision('accepted'));
    }

    if (rejectBtn) {
        rejectBtn.addEventListener('click', () => setDecision('rejected'));
    }

    if (configureBtn) {
        configureBtn.addEventListener('click', () => {
            window.location.href = 'cookies.php';
        });
    }
});
