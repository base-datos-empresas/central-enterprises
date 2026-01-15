<div class="announcement-bar"
    style="background: var(--bg-secondary); border-bottom: 1px solid var(--structural-line); padding: 0.6rem 0; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase;">
    <div class="grid-container">
        <div class="span-12" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="opacity: 0.6;">Foundation in Formation | The Open Company Data Standard</div>
            <div style="display: flex; gap: 2rem;">
                <a href="<?= $basePath ?>/donations/" style="color: var(--accent); font-weight: 800;">Foundation
                    Transition</a>
                <a href="<?= $basePath ?>/pro/" style="color: var(--text-header); font-weight: 800;">Pro Access</a>
            </div>
        </div>
    </div>
</div>
<nav>
    <div class="grid-container">
        <div class="nav-content">
            <div class="logo">
                <a href="<?= $basePath ?>/" <div
                    style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <a href="/" style="display: flex; align-items: center; text-decoration: none; gap: 0.8rem;">
                        <img src="/assets/logo.png" alt="Central.Enterprises Logo" height="28" style="opacity: 0.9;">
                        <span
                            style="font-weight: 700; font-size: 1.1rem; letter-spacing: -0.02em; color: var(--text-header);">Central<span
                                style="opacity: 0.5;">.Enterprises</span></span>
                    </a>

                    <!-- Mobile Hamburger -->
                    <button class="nav-toggle-btn"
                        style="display: none; background: none; border: none; color: var(--text-header);"
                        onclick="document.querySelector('.header-links').classList.toggle('active')">
                        ☰
                    </button>
            </div>

            <nav class="header-links" style="display: flex; gap: 1.5rem;">
                <a href="<?= $basePath ?>/data/" class="toc-item" style="font-size: 0.7rem;">DATASETS</a>
                <a href="<?= $basePath ?>/pro/" class="toc-item"
                    style="font-size: 0.7rem; color: var(--accent); font-weight: 800;">PRO</a>
                <a href="<?= $basePath ?>/standard/" class="toc-item" style="font-size: 0.7rem;">STANDARD</a>
                <a href="<?= $basePath ?>/foundation/" class="toc-item" style="font-size: 0.7rem;">FOUNDATION</a>
            </nav>
            <button id="theme-toggle" class="theme-btn" title="Toggle Theme" style="margin-right:0"></button>
        </div>
    </div>
    </div>
</nav>