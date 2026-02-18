<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="bx bx-menu bx-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item dropdown-language dropdown me-2 me-xl-0" style="visibility:hidden;">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class='bx bx-globe bx-sm'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="en"
                            data-text-direction="ltr">
                            <span>English</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="ar"
                            data-text-direction="rtl">
                            <span>Arabic</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="admin/Profile/images/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>"
                            alt class="w-px-40 h-auto rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="admin/Profile/images/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>"
                                            alt class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0"><?php echo htmlspecialchars($adminName); ?></h6>
                                    <small class="text-muted"><?php echo htmlspecialchars($adminCommitee); ?></small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item menu-link" href="admin\Profile\profile.php">
                            <i class="bx bx-user bx-sm me-3"></i><span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item menu-link" href="admin\Profile\edit_account.php">
                            <i class="bx bx-edit bx-sm me-3"></i><span>Edit Account</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item menu-link" href="admin/Login/logout.php">
                            <i class="bx bx-power-off bx-sm me-3"></i><span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            </ul>
    </div>


    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0"
            placeholder="Search..." aria-label="Search...">
        <i class="bx bx-x bx-md search-toggler cursor-pointer"></i>
    </div>
</nav>