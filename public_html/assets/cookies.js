// Cookie Banner Logic
document.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('cookie-banner');
    const acceptBtn = document.getElementById('accept-cookies');
    const rejectBtn = document.getElementById('reject-cookies');

    // Check if previously decided
    if (!localStorage.getItem('cookies-consent')) {
        // Show banner with a slight delay for animation
        setTimeout(() => {
            banner.classList.add('visible');
        }, 1000);
    }

    if (acceptBtn) {
        acceptBtn.addEventListener('click', () => {
            localStorage.setItem('cookies-consent', 'accepted');
            banner.classList.remove('visible');
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener('click', () => {
            localStorage.setItem('cookies-consent', 'rejected');
            banner.classList.remove('visible');
            // Rejection dismisses the banner but doesn't store 'accepted'
        });
    }
});
