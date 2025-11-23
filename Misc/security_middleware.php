<?php
// Prevent direct access to this file
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
    die('Direct access not permitted');
}

// CORS middleware
function setCorsHeaders() {
    header('Access-Control-Allow-Origin: https://tedxmanaratalfaroukschool.com');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Max-Age: 86400'); // 24 hours
}

// Rate limiter using session
function rateLimiter() {
    session_start();
    $time = time();
    $timeout = 60; // 1 minute window
    $max_requests = 100; // Increased from 60 to 100 for better user experience

    if (!isset($_SESSION['rate_limit'])) {
        $_SESSION['rate_limit'] = [
            'requests' => 1,
            'time' => $time,
            'last_request' => $time
        ];
    } else {
        // Add minimum request interval
        $min_interval = 0.1; // 100ms between requests
        if (($time - $_SESSION['rate_limit']['last_request']) < $min_interval) {
            http_response_code(429);
            die('Too Many Requests');
        }

        if (($time - $_SESSION['rate_limit']['time']) > $timeout) {
            $_SESSION['rate_limit'] = [
                'requests' => 1,
                'time' => $time,
                'last_request' => $time
            ];
        } else {
            $_SESSION['rate_limit']['requests']++;
            if ($_SESSION['rate_limit']['requests'] > $max_requests) {
                http_response_code(429);
                die('Too Many Requests');
            }
        }
        $_SESSION['rate_limit']['last_request'] = $time;
    }
}

// Security headers (Helmet-like functionality)
function setSecurityHeaders() {
    header("Content-Security-Policy: default-src 'self' https: 'unsafe-inline' 'unsafe-eval' data:; img-src 'self' data: https:; media-src 'self' https:; font-src 'self' https: data:;");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
}

// Initialize all security middleware
function initSecurityMiddleware() {
    setCorsHeaders();
    rateLimiter();
    //setSecurityHeaders();
}
?>
