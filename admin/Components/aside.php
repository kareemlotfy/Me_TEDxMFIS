<?php
// Determine the current active state for sub-sections
$isWebsiteActive = isset($currentPage) && in_array($currentPage, ['settings', 'speakers']);
?>

<!-- iOS Bottom Sheet Overlay (mobile only) -->
<div class="hig-sheet-overlay" id="higSheetOverlay" role="presentation" aria-hidden="true"></div>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme hig-sidebar" aria-label="Main navigation">

    <!-- Sidebar Header / Brand -->
    <div class="hig-sidebar-header app-brand demo pb-0 pt-0">
        <a href="admin/Dashboard/dashboard.php" class="hig-brand app-brand-link" aria-label="TEDxManaratAlfaroukSchool Home">
            <img src="admin/assets/img/logos/TEDx_logo_place2_RGB_CS2_page-0001.jpg"
                 alt="TEDx Logo"
                 class="hig-brand-logo tedx-logo">
        </a>

        <!-- Desktop collapse button (the existing Sneat JS hooks this via .layout-menu-toggle) -->
        <a href="javascript:void(0);" 
           class="hig-sidebar-collapse-btn layout-menu-toggle"
           title="Collapse sidebar"
           aria-label="Toggle sidebar">
            <i class="bx bx-chevron-left" aria-hidden="true"></i>
        </a>
    </div>

    <!-- Navigation -->
    <div class="menu-inner-shadow" style="display:none"></div>

    <ul class="menu-inner py-1" role="navigation">

        <!-- ── MAIN section ─────────────────────────────── -->
        <li class="menu-header">
            <span class="hig-nav-section-label">Main</span>
        </li>

        <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'dashboard') ? 'active open' : ''; ?>">
            <a href="admin/Dashboard/dashboard.php" class="menu-link" aria-label="Dashboard">
                <i class="menu-icon tf-icons bx bx-home-smile" aria-hidden="true"></i>
                <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- ── TICKETS section ──────────────────────────── -->
        <li class="menu-header">
            <span class="hig-nav-section-label">Tickets</span>
        </li>

        <li class="menu-item <?php echo (isset($currentPage) && in_array($currentPage, ['single','vip','family'])) ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="false">
                <i class="menu-icon tf-icons bx bx-draft" aria-hidden="true"></i>
                <div class="text-truncate" data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub" role="list">
                <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'single') ? 'active' : ''; ?>">
                    <a href="admin/Tickets/single.php?userFilter=all" class="menu-link">
                        <div class="text-truncate" data-i18n="Single Tickets">Single Tickets</div>
                    </a>
                </li>
                <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'vip') ? 'active' : ''; ?>">
                    <a href="admin/Tickets/vip.php?userFilter=all" class="menu-link">
                        <div class="text-truncate" data-i18n="VIP Tickets">VIP Tickets</div>
                    </a>
                </li>
                <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'family') ? 'active' : ''; ?>">
                    <a href="admin/Tickets/family.php?userFilter=all" class="menu-link">
                        <div class="text-truncate" data-i18n="Family Tickets">Family Tickets</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ── TOOLS section ────────────────────────────── -->
        <li class="menu-header">
            <span class="hig-nav-section-label">Tools</span>
        </li>

        <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'storage') ? 'active open' : ''; ?>">
            <a href="admin/Storage/" class="menu-link" aria-label="Storage">
                <i class="menu-icon tf-icons bx bx-box" aria-hidden="true"></i>
                <div class="text-truncate" data-i18n="Storage">Storage</div>
            </a>
        </li>

        <li class="menu-item <?php echo isset($currentPage) && in_array($currentPage, ['coupons']) ? 'active' : ''; ?>">
            <a href="admin/Misc/coming-soon.php" class="menu-link" aria-label="Coupons">
                <i class="menu-icon tf-icons bx bx-purchase-tag-alt" aria-hidden="true"></i>
                <div class="text-truncate" data-i18n="Coupons">Coupons</div>
                <span class="badge bg-label-secondary ms-auto" style="font-size:0.65rem;padding:2px 6px;">Soon</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="admin/Misc/coming-soon.php" class="menu-link" aria-label="Recruit">
                <i class="menu-icon tf-icons bx bx-briefcase" aria-hidden="true"></i>
                <div class="text-truncate" data-i18n="Recruit">Recruit</div>
                <span class="badge bg-label-secondary ms-auto" style="font-size:0.65rem;padding:2px 6px;">Soon</span>
            </a>
        </li>

        <!-- ── WEBSITE section ──────────────────────────── -->
        <li class="menu-header">
            <span class="hig-nav-section-label">Website</span>
        </li>

        <li class="menu-item <?php echo $isWebsiteActive ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="<?php echo $isWebsiteActive ? 'true' : 'false'; ?>">
                <i class="menu-icon tf-icons bx bx-globe" aria-hidden="true"></i>
                <div class="text-truncate" data-i18n="Website">Website</div>
            </a>
            <ul class="menu-sub" role="list">
                <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'settings') ? 'active' : ''; ?>">
                    <a href="admin/Settings/settings.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cog" aria-hidden="true"></i>
                        <div class="text-truncate" data-i18n="Settings">Settings</div>
                    </a>
                </li>
                <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'speakers') ? 'active' : ''; ?>">
                    <a href="admin/speakers/manage.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user-voice" aria-hidden="true"></i>
                        <div class="text-truncate">Speakers</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

    <!-- Sidebar Footer — Logout -->
    <ul class="menu-inner" style="height:auto; border-top: 1px solid var(--hig-separator); padding: 8px 10px; margin-top: auto;">
        <li class="menu-item">
            <a href="admin/Login/logout.php" class="menu-link" aria-label="Log Out">
                <i class="bx bx-power-off bx-sm me-3" aria-hidden="true"></i>
                <div class="text-truncate" data-i18n="Log Out">Log Out</div>
            </a>
        </li>
    </ul>

</aside>

<!-- ── iOS Bottom Sheet JavaScript ──────────────────────────── -->
<script>
(function () {
    'use strict';

    var overlay  = document.getElementById('higSheetOverlay');
    var sidebar  = document.getElementById('layout-menu');
    var isMobile = function () { return window.innerWidth < 1200; };

    function openSheet() {
        sidebar.classList.add('hig-sheet-open');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        sidebar.setAttribute('aria-hidden', 'false');
    }

    function closeSheet() {
        sidebar.classList.remove('hig-sheet-open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
        sidebar.setAttribute('aria-hidden', isMobile() ? 'true' : 'false');
    }

    /* Close on overlay tap */
    overlay.addEventListener('click', closeSheet);

    /* Close on Escape */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && sidebar.classList.contains('hig-sheet-open')) {
            closeSheet();
        }
    });

    /* Intercept ALL .layout-menu-toggle clicks from Sneat nav / sidebar */
    document.addEventListener('click', function (e) {
        var toggle = e.target.closest('.layout-menu-toggle');
        if (!toggle) return;
        if (!isMobile()) return;          // Desktop: let Sneat JS handle collapse

        e.preventDefault();
        e.stopImmediatePropagation();

        sidebar.classList.contains('hig-sheet-open') ? closeSheet() : openSheet();
    }, true);

    /* Basic swipe-down-to-dismiss */
    var startY = 0;
    sidebar.addEventListener('touchstart', function (e) {
        startY = e.touches[0].clientY;
    }, { passive: true });

    sidebar.addEventListener('touchend', function (e) {
        var deltaY = e.changedTouches[0].clientY - startY;
        if (deltaY > 80) { closeSheet(); }
    }, { passive: true });

    /* Ensure correct aria-hidden on resize */
    window.addEventListener('resize', function () {
        if (!isMobile()) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        sidebar.setAttribute('aria-hidden', isMobile() && !sidebar.classList.contains('hig-sheet-open') ? 'true' : 'false');
    });

    /* Set initial aria-hidden */
    sidebar.setAttribute('aria-hidden', isMobile() ? 'true' : 'false');
})();
</script>