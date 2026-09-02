<?php
// Set secure session cookie parameters before starting the session
ini_set('session.cookie_secure', '1'); // Ensure cookies are sent over HTTPS
ini_set('session.cookie_httponly', '1'); // Prevent JavaScript access to session cookies
ini_set('session.cookie_samesite', 'Strict'); // Mitigate CSRF attacks

session_start();

require('../Misc/db_conn.php');
require('../Misc/functions.php');
require_once __DIR__ . '/../../config.php';

// Redirect logged-in admin to the dashboard
if (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] === true) {
    header("Location: ../Dashboard/dashboard.php");
    exit();
}

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle form submission
if (isset($_POST["submit"])) {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        alert("error", "","Login Failed", "CSRF token validation failed", "close");
        exit();
    }

    $frm_data = filteration($_POST);

    // Prepare and execute query to fetch admin credentials
    $query = "SELECT * FROM `admin_cred` WHERE `admin_username` = ?";
    $values = [$frm_data["admin_username"]];
    $res = select($query, $values, "s");

    if ($res->num_rows === 1) {
        $row = mysqli_fetch_assoc($res);

        // Verify password
        if (password_verify($frm_data["admin_pass"], $row["admin_pass"])) {
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION["adminLogin"] = true;
            $_SESSION["adminId"] = $row["id"];
            header("Location: ../Dashboard/dashboard.php");
            exit();
        } else {
            alert("error", "", "Login Failed", "Invalid username or password. Please try again.", "close");
        }
    } else {
        alert("error", "", "Login Failed", "Invalid username or password. Please try again.", "close");
    }

    // Log failed login attempt
    error_log('Failed login attempt for username: ' . $frm_data["admin_username"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login — TEDxManaratAlfaroukSchool</title>
    <base href="<?php echo BASE_URL; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <!-- Icons -->
    <link rel="stylesheet" href="admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS (kept for JS compatibility) -->
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" />

    <!-- Apple HIG Design System -->
    <link rel="stylesheet" href="admin/assets/css/apple-hig.css" />

    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>
    <script src="admin/assets/js/config.js"></script>

    <style>
        /* ── Login page layout ──────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body.hig-login-body {
            min-height: 100vh;
            display: flex;
            font-family: var(--hig-font);
            background: var(--hig-bg);
            transition: background var(--hig-duration) var(--hig-ease);
        }

        /* Left decorative panel */
        .hig-login-panel {
            display: none;
            flex: 0 0 42%;
            background: linear-gradient(145deg, #C0202F 0%, #EB3349 45%, #FF5C70 100%);
            position: relative;
            overflow: hidden;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px;
        }
        @media (min-width: 900px) {
            .hig-login-panel { display: flex; }
        }
        .hig-login-panel::before,
        .hig-login-panel::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }
        .hig-login-panel::before { width: 400px; height: 400px; top: -120px; right: -100px; }
        .hig-login-panel::after  { width: 300px; height: 300px; bottom: -80px; left: -80px; }

        .hig-panel-logo {
            width: auto; height: 90px; object-fit: contain;
            filter: brightness(0) invert(1);
            margin-bottom: 32px; position: relative; z-index: 1;
        }
        .hig-panel-title {
            font-size: 2rem; font-weight: 800; color: #fff;
            text-align: center; line-height: 1.15;
            letter-spacing: -0.03em; position: relative; z-index: 1;
        }
        .hig-panel-subtitle {
            font-size: 0.95rem; color: rgba(255,255,255,0.75);
            text-align: center; margin-top: 12px;
            max-width: 280px; line-height: 1.55; position: relative; z-index: 1;
        }
        .hig-panel-circles {
            position: absolute; bottom: 40px; left: 50%;
            transform: translateX(-50%);
            display: flex; gap: 8px; z-index: 1;
        }
        .hig-panel-circles span {
            display: block; width: 8px; height: 8px;
            border-radius: 50%; background: rgba(255,255,255,0.40);
        }
        .hig-panel-circles span:first-child { background: rgba(255,255,255,0.90); }

        /* Right form panel */
        .hig-login-form-panel {
            flex: 1; display: flex;
            align-items: center; justify-content: center;
            padding: 40px 24px;
            background: var(--hig-bg);
            transition: background var(--hig-duration) var(--hig-ease);
        }
        .hig-login-card {
            width: 100%; max-width: 400px;
            background: var(--hig-surface);
            border: 1px solid var(--hig-separator);
            border-radius: var(--hig-radius-2xl);
            box-shadow: var(--hig-shadow-xl);
            padding: 40px 36px;
            animation: higPop 450ms var(--hig-ease-spring) both;
            transition: background var(--hig-duration) var(--hig-ease),
                        border-color var(--hig-duration) var(--hig-ease);
        }
        .hig-login-logo {
            display: block; height: 56px; width: auto;
            margin: 0 auto 24px; object-fit: contain;
        }
        .hig-login-headline {
            font-size: 1.5rem; font-weight: 700;
            color: var(--hig-label); text-align: center;
            letter-spacing: -0.025em; margin-bottom: 6px;
        }
        .hig-login-subline {
            font-size: 0.875rem; color: var(--hig-label-2);
            text-align: center; margin-bottom: 32px;
        }

        /* Fields */
        .hig-field { margin-bottom: 16px; }
        .hig-field label {
            display: block; font-size: 0.8125rem;
            font-weight: 500; color: var(--hig-label-2); margin-bottom: 6px;
        }
        .hig-field input {
            width: 100%; padding: 11px 14px;
            background: var(--hig-bg);
            border: 1.5px solid var(--hig-separator-opaque);
            border-radius: var(--hig-radius-md);
            font-size: 0.9375rem; color: var(--hig-label);
            font-family: var(--hig-font); outline: none;
            transition: border-color 160ms ease, box-shadow 160ms ease, background var(--hig-duration) ease;
        }
        .hig-field input:focus {
            border-color: var(--hig-accent);
            box-shadow: 0 0 0 3px var(--hig-accent-light);
            background: var(--hig-surface);
        }
        .hig-field input::placeholder { color: var(--hig-label-3); }

        .hig-pw-wrapper { position: relative; }
        .hig-pw-toggle {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: var(--hig-label-3);
            cursor: pointer; font-size: 1.1rem; padding: 0; line-height: 1;
            transition: color 140ms ease;
        }
        .hig-pw-toggle:hover { color: var(--hig-label-2); }

        /* Submit */
        .hig-login-btn {
            display: block; width: 100%; padding: 13px;
            background: var(--hig-accent); color: #fff;
            border: none; border-radius: var(--hig-radius-md);
            font-size: 0.9375rem; font-weight: 600;
            font-family: var(--hig-font); cursor: pointer;
            margin-top: 24px; letter-spacing: -0.01em;
            box-shadow: 0 2px 8px rgba(235,51,73,0.30);
            transition: background 160ms ease, box-shadow 160ms ease, transform 120ms ease;
        }
        .hig-login-btn:hover {
            background: var(--hig-accent-hover);
            box-shadow: 0 4px 16px rgba(235,51,73,0.38);
        }
        .hig-login-btn:active { transform: scale(0.98); }

        /* Dark mode toggle */
        .hig-login-theme-btn {
            position: fixed; top: 18px; right: 20px;
            width: 38px; height: 38px; border-radius: 50%;
            border: 1.5px solid var(--hig-separator-opaque);
            background: var(--hig-surface); color: var(--hig-label-2);
            font-size: 1.05rem; display: flex;
            align-items: center; justify-content: center;
            cursor: pointer; z-index: 100;
            box-shadow: var(--hig-shadow-sm);
            transition: background var(--hig-duration) ease, color 150ms ease,
                        border-color var(--hig-duration) ease;
        }
        .hig-login-theme-btn:hover { color: var(--hig-label); }

        /* Dark mode overrides */
        [data-theme="dark"] .hig-login-card {
            background: var(--hig-surface);
            border-color: var(--hig-separator);
        }
        [data-theme="dark"] .hig-field input {
            background: var(--hig-bg-2);
            border-color: var(--hig-separator);
            color: var(--hig-label);
        }
        [data-theme="dark"] .hig-field input:focus {
            background: var(--hig-surface);
        }
        [data-theme="dark"] .hig-login-theme-btn {
            background: var(--hig-surface);
            border-color: var(--hig-separator);
        }
    </style>
</head>

<body class="hig-login-body">

    <!-- Dark mode toggle -->
    <button class="hig-login-theme-btn" id="loginDarkToggle"
            title="Toggle dark mode" aria-label="Toggle dark mode" type="button">
        <i class="bx bx-moon" id="loginDarkIcon" aria-hidden="true"></i>
    </button>

    <!-- Left decorative panel -->
    <div class="hig-login-panel" aria-hidden="true">
        <img src="admin/assets/img/logos/tedx-logo-white.webp"
             alt="" class="hig-panel-logo">
        <!-- <h1 class="hig-panel-title">TEDxManaratAlfaroukSchool</h1> -->
        <p class="hig-panel-subtitle">Admin dashboard for managing ticket registrations, speakers, and event operations.</p>
        <div class="hig-panel-circles">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- Right form panel -->
    <main class="hig-login-form-panel" role="main">
        <div class="hig-login-card">

            <!-- Logo (mobile only — panel hidden on small screens) -->
            <img src="admin/assets/img/logos/tedx-logo-black.webp"
                 alt="TEDx Logo"
                 class="hig-login-logo"
                 id="loginLogo"
                 style="display:block;">

            <h2 class="hig-login-headline">Welcome back 👋</h2>
            <p class="hig-login-subline">Sign in to the admin panel</p>

            <form id="formAuthentication" action="" method="POST" novalidate>
                <input type="hidden" name="csrf_token"
                       value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                <div class="hig-field">
                    <label for="username">Username</label>
                    <input type="text"
                           name="admin_username"
                           id="username"
                           autocomplete="username"
                           placeholder="Enter your username"
                           required>
                </div>

                <div class="hig-field">
                    <label for="password">Password</label>
                    <div class="hig-pw-wrapper">
                        <input type="password"
                               id="password"
                               name="admin_pass"
                               autocomplete="current-password"
                               placeholder="••••••••••••"
                               required>
                        <button type="button" class="hig-pw-toggle"
                                aria-label="Show/hide password" id="pwToggleBtn">
                            <i class="bx bx-hide" id="pwToggleIcon" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" name="submit" class="hig-login-btn">Sign In</button>
            </form>

        </div>
    </main>

    <!-- Core JS -->
    <script src="admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="admin/assets/vendor/js/bootstrap.js"></script>
    <script src="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="admin/assets/vendor/js/menu.js"></script>
    <script src="admin/assets/js/main.js"></script>

    <script>
    /* Password toggle */
    (function () {
        var btn  = document.getElementById('pwToggleBtn');
        var inp  = document.getElementById('password');
        var icon = document.getElementById('pwToggleIcon');
        if (!btn) return;
        btn.addEventListener('click', function () {
            var shown = inp.type === 'text';
            inp.type = shown ? 'password' : 'text';
            icon.className = shown ? 'bx bx-hide' : 'bx bx-show';
        });
    })();

    /* Dark mode toggle with logo switching */
    (function () {
        var STORAGE_KEY = 'hig-theme';
        var btn  = document.getElementById('loginDarkToggle');
        var icon = document.getElementById('loginDarkIcon');
        var logo = document.getElementById('loginLogo');

        function apply(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem(STORAGE_KEY, theme);
            
            // Update toggle icon
            if (icon) icon.className = theme === 'dark' ? 'bx bx-sun' : 'bx bx-moon';
            if (btn)  btn.setAttribute('aria-label', theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
            
            // Update logo based on theme
            if (logo) {
                logo.src = theme === 'dark' 
                    ? 'admin/assets/img/logos/tedx-logo-white.webp' 
                    : 'admin/assets/img/logos/tedx-logo-black.webp';
            }
        }

        var saved  = localStorage.getItem(STORAGE_KEY);
        var system = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        apply(saved || system);

        if (btn) {
            btn.addEventListener('click', function () {
                var cur = document.documentElement.getAttribute('data-theme') || 'light';
                apply(cur === 'dark' ? 'light' : 'dark');
            });
        }
    })();

    /* Popup close helper (used by alert() calls from PHP) */
    function closePopup() {
        var popup    = document.getElementById('popup');
        var password = document.getElementById('password');
        if (popup)    popup.classList.add('close_popup');
        document.body.classList.remove('alertCalled');
        if (password) password.value = '';
    }
    </script>

</body>
</html>