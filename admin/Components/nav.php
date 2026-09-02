<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme hig-topbar"
    id="layout-navbar"
    role="navigation"
    aria-label="Top navigation bar">

    <!-- Mobile hamburger — triggers iOS bottom sheet -->
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-2 d-xl-none">
        <a class="nav-item nav-link px-0 hig-topbar-menu-btn" href="javascript:void(0)" aria-label="Open navigation menu">
            <i class="bx bx-menu" aria-hidden="true"></i>
        </a>
    </div>

    <!-- Page Title (populated via JS per page if needed) -->
    <div class="hig-topbar-title d-none d-md-block" id="higPageTitle" aria-live="polite"></div>

    <!-- Right-side actions -->
    <div class="navbar-nav-right d-flex align-items-center ms-auto" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center gap-1">

            <!-- Dark Mode Toggle -->
            <li class="nav-item">
                <button class="hig-icon-btn" id="darkModeToggle" title="Toggle dark mode" aria-label="Toggle dark mode" type="button">
                    <i class="bx bx-moon" id="darkModeIcon" aria-hidden="true"></i>
                </button>
            </li>

            <!-- User Avatar + Dropdown -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0 hig-topbar-avatar"
                   href="javascript:void(0);"
                   data-bs-toggle="dropdown"
                   aria-expanded="false"
                   aria-haspopup="true"
                   aria-label="User menu">

                    <div class="avatar avatar-online">
                        <img src="admin/Profile/images/<?php echo !empty($adminPic) ? htmlspecialchars($adminPic) : 'default-pic.jpg'; ?>"
                             alt="Profile picture"
                             class="w-px-40 h-auto rounded-circle">
                    </div>

                    <div class="avatar-info d-none d-lg-block">
                        <span class="avatar-name"><?php echo htmlspecialchars($adminName); ?></span>
                        <span class="avatar-role"><?php echo htmlspecialchars($adminCommitee); ?></span>
                    </div>
                </a>

                <!-- Dropdown -->
                <ul class="dropdown-menu dropdown-menu-end" role="menu">

                    <!-- User info header -->
                    <li role="none">
                        <a class="dropdown-item pe-none" href="javascript:void(0);" style="cursor:default;" role="menuitem">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar avatar-online flex-shrink-0">
                                    <img src="admin/Profile/images/<?php echo !empty($adminPic) ? htmlspecialchars($adminPic) : 'default-pic.jpg'; ?>"
                                         alt=""
                                         class="w-px-40 h-auto rounded-circle">
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold" style="font-size:0.875rem;color:var(--hig-label);">
                                        <?php echo htmlspecialchars($adminName); ?>
                                    </p>
                                    <small style="color:var(--hig-label-2);">
                                        <?php echo htmlspecialchars($adminCommitee); ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li role="none"><div class="dropdown-divider my-1"></div></li>

                    <li role="none">
                        <a class="dropdown-item" href="admin/Profile/profile.php" role="menuitem">
                            <i class="bx bx-user me-2" aria-hidden="true"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li role="none">
                        <a class="dropdown-item" href="admin/Profile/edit_account.php" role="menuitem">
                            <i class="bx bx-edit me-2" aria-hidden="true"></i>
                            <span>Edit Account</span>
                        </a>
                    </li>

                    <li role="none"><div class="dropdown-divider my-1"></div></li>

                    <li role="none">
                        <a class="dropdown-item" href="admin/Login/logout.php" role="menuitem"
                           style="color:var(--hig-red)!important;">
                            <i class="bx bx-power-off me-2" aria-hidden="true" style="color:var(--hig-red)"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </li><!-- /dropdown-user -->

        </ul>
    </div><!-- /navbar-nav-right -->

</nav>

<!-- ── Dark Mode Toggle JavaScript ────────────────────────── -->
<script>
(function () {
    'use strict';

    var STORAGE_KEY = 'hig-theme';
    var toggleBtn   = document.getElementById('darkModeToggle');
    var icon        = document.getElementById('darkModeIcon');

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(STORAGE_KEY, theme);
        if (icon) {
            icon.className = theme === 'dark' ? 'bx bx-sun' : 'bx bx-moon';
        }
        if (toggleBtn) {
            toggleBtn.setAttribute('aria-label', theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
            toggleBtn.title = theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode';
        }
    }

    /* Restore saved preference or system preference */
    var saved  = localStorage.getItem(STORAGE_KEY);
    var system = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    applyTheme(saved || system);

    /* Toggle on click */
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            var current = document.documentElement.getAttribute('data-theme') || 'light';
            applyTheme(current === 'dark' ? 'light' : 'dark');
        });
    }

    /* Listen for system preference changes */
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
        if (!localStorage.getItem(STORAGE_KEY)) {
            applyTheme(e.matches ? 'dark' : 'light');
        }
    });
})();
</script>