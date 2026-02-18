<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo pb-4 pt-4 ">
        <a href="admin/Dashboard/dashboard.php" class="app-brand-link">
            <div class="logo-container">
                <img src="admin/assets/img/logos/TEDx_logo_place2_RGB_CS2_page-0001.jpg" alt="tedx logo"
                    class="tedx-logo" id="tedx_logo">
                <img src="admin\assets\img\logos\x-art.png" class="x-logo" alt="x-logo">
            </div>

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'dashboard') ? 'active open' : ''; ?>">
            <a href="admin/Dashboard/dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-cart-alt'></i>
                <div class="text-truncate" data-i18n="eCommerce">eCommerce</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                        <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-draft'></i>
                <div class="text-truncate" data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="admin/Tickets/single.php?userFilter=all" class="menu-link">
                        <div class="text-truncate" data-i18n="Single Tickets">Single Tickets</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="admin/Tickets/vip.php?userFilter=all" class="menu-link">
                        <div class="text-truncate" data-i18n="VIP Tickets">VIP Tickets</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="admin/Tickets/family.php?userFilter=all" class="menu-link">
                        <div class="text-truncate" data-i18n="Family Tickets">Family Tickets</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item <?php echo (isset($currentPage) && $currentPage === 'storage') ? 'active open' : ''; ?>">
            <a href="admin/Storage/" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div class="text-truncate" data-i18n="Storage">Storage</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-website'></i>
                <div class="text-truncate" data-i18n="Website">Website</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item <?php echo (isset($currentPage) && $currentPage === 'settings') ? 'active open' : ''; ?>">
                    <a href="admin/Settings/settings.php" class="menu-link ">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div class="text-truncate" data-i18n="Settings">Settings</div>
                    </a>
                </li>
                <li
                    class="menu-item <?php echo (isset($currentPage) && $currentPage === 'speakers') ? 'active open' : ''; ?>">
                    <a href="admin/speakers/manage.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user-voice"></i>
                        <div class="text-truncate">Speakers</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="admin\Misc\coming-soon.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                <div class="text-truncate" data-i18n="Coupons ">Coupons</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="admin\Misc\coming-soon.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div class="text-truncate" data-i18n="Recruit">Recruit</div>
            </a>
        </li>
    </ul>
    <ul class="menu-inner" style="height:60px;">
        <li class="menu-item" style="position: absolute; bottom: 10px; margin-top:10px;">
            <a href="admin/Login/logout.php" class="menu-link">
                <i class="bx bx-power-off bx-sm me-3"></i>
                <div class="text-truncate" data-i18n="Log Out">Log Out</div>
            </a>
        </li>
    </ul>

</aside>