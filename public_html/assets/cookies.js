/**
 * Central.Enterprises Cookie Management (GDPR/ePrivacy)
 * Handles consent state, banner UI, and conditional GTM loading.
 */

document.addEventListener('DOMContentLoaded', () => {
    const BANNER_ID = 'cookie-banner';
    const PREF_KEY = 'cookies-consent';
    const GTM_ID = 'G-434X450QQM'; // From footer.php

    // UI Elements
    const elements = {
        banner: document.getElementById(BANNER_ID),
        acceptBtn: document.getElementById('accept-cookies'),
        rejectBtn: document.getElementById('reject-cookies'),
        configureBtn: document.getElementById('configure-cookies'),
    };

    // Configuration Modal HTML
    const modalHTML = `
        <div id="cookie-settings-modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:10000; align-items:center; justify-content:center;">
            <div style="background:var(--bg-primary); padding:2rem; border:1px solid var(--accent); max-width:500px; width:90%; position:relative;">
                <h3 style="margin-bottom:1.5rem; color:var(--text-header);">Cookie Preferences</h3>
                
                <div style="margin-bottom:1rem; padding-bottom:1rem; border-bottom:1px solid var(--structural-line);">
                    <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                        <strong>Essential (Required)</strong>
                        <input type="checkbox" checked disabled>
                    </div>
                    <p style="font-size:0.8rem; opacity:0.7;">Necessary for the website to function (e.g. security, load balancing).</p>
                </div>

                <div style="margin-bottom:2rem;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                        <strong>Analytics & Performance</strong>
                        <input type="checkbox" id="consent-analytics">
                    </div>
                    <p style="font-size:0.8rem; opacity:0.7;">Helps us understand how you use the site to improve our services (Google Analytics).</p>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem;">
                    <button id="close-settings" style="background:transparent; border:1px solid var(--structural-line); color:var(--text-body); padding:0.5rem 1rem; cursor:pointer;">Cancel</button>
                    <button id="save-settings" class="btn-institutional primary">Save Preferences</button>
                </div>
            </div>
        </div>
    `;

    // Inject Modal
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    const modal = document.getElementById('cookie-settings-modal');
    const analyticsCheckbox = document.getElementById('consent-analytics');

    /**
     * Logic
     */

    const getConsent = () => {
        return localStorage.getItem(PREF_KEY); // 'granted' | 'denied' | 'custom'
    };

    const setConsent = (status, analyticsEnabled = false) => {
        localStorage.setItem(PREF_KEY, status);

        // Update GTM Consent Mode
        const consentUpdate = {
            'ad_storage': 'denied',
            'analytics_storage': analyticsEnabled ? 'granted' : 'denied'
        };

        // Push to DataLayer
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('consent', 'update', consentUpdate);

        // Hide Banner
        elements.banner.classList.remove('visible');

        // Determine Cookie Max-Age (1 year if accepted, session if rejected)
        const maxAge = 60 * 60 * 24 * 365;
        document.cookie = `cookie_consent_status=${status}; max-age=${maxAge}; path=/; SameSite=Lax`;
    };

    const showBanner = () => {
        // Small delay for animation
        setTimeout(() => {
            elements.banner.classList.add('visible');
        }, 1000);
    };

    const init = () => {
        const currentConsent = getConsent();

        if (!currentConsent) {
            showBanner();

            // Set default GTM state to denied
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('consent', 'default', {
                'ad_storage': 'denied',
                'analytics_storage': 'denied'
            });
        } else {
            // Re-apply stored consent logic (e.g. if we reload page)
            if (currentConsent === 'granted') setConsent('granted', true);
            else if (currentConsent === 'denied') setConsent('denied', false);
        }
    };

    /**
     * Event Listeners
     */

    // Accept All
    if (elements.acceptBtn) {
        elements.acceptBtn.addEventListener('click', () => {
            setConsent('granted', true);
        });
    }

    // Reject All
    if (elements.rejectBtn) {
        elements.rejectBtn.addEventListener('click', () => {
            setConsent('denied', false);
        });
    }

    // Configure (Open Modal)
    if (elements.configureBtn) {
        elements.configureBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });
    }

    // Close Modal
    document.getElementById('close-settings').addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Save Settings
    document.getElementById('save-settings').addEventListener('click', () => {
        const isAnalytics = analyticsCheckbox.checked;
        setConsent(isAnalytics ? 'granted' : 'denied', isAnalytics);
        modal.style.display = 'none';
    });

    init();
});
