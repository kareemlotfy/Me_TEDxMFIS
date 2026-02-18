<?php
/**
 * Configuration Template for Speaker Management System
 * 
 * INSTRUCTIONS:
 * 1. Copy this file to: /admin/speakers/config.php
 * 2. Update all values with your actual settings
 * 3. Update process.php to include this file instead of hardcoded values
 * 4. Add config.php to .gitignore to keep secrets safe
 */

// =============================================================================
// GOOGLE GEMINI API CONFIGURATION
// =============================================================================

// Get your API key from: https://makersuite.google.com/app/apikey
define('GEMINI_API_KEY', 'AIzaSyDA5lxSLXVdbbBw0Fy-gpEhfihoermjBts');
define('GEMINI_API_ENDPOINT', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent');

// AI Processing Settings
define('GEMINI_TEMPERATURE', 0.7);      // Creativity level (0.0 - 1.0)
define('GEMINI_MAX_TOKENS', 200);       // Max response length
define('GEMINI_TOP_P', 0.8);            // Nucleus sampling
define('GEMINI_TOP_K', 40);             // Top-k sampling

// =============================================================================
// IMAGE UPLOAD CONFIGURATION
// =============================================================================

// File Upload Limits
define('MAX_FILE_SIZE', 5 * 1024 * 1024);           // 5MB in bytes
define('ALLOWED_MIME_TYPES', [
    'image/jpeg',
    'image/png',
    'image/jpg',
    'image/webp'
]);

// Image Processing Settings
define('IMAGE_MAX_WIDTH', 800);                     // Max width in pixels
define('IMAGE_MAX_HEIGHT', 800);                    // Max height in pixels
define('WEBP_QUALITY', 80);                         // Quality: 0-100

// Upload Directory Structure
define('UPLOAD_BASE_DIR', '../../images/generation/');
define('DEFAULT_GENERATION', 7);                    // Current generation

// =============================================================================
// EVENT CONFIGURATION
// =============================================================================

define('CURRENT_EVENT_YEAR', 2026);
define('CURRENT_GENERATION', 7);
define('EVENT_NAME', 'Out of the Box');
define('EVENT_THEME_COLOR', '#eb0028');

// =============================================================================
// BIO PROCESSING CONFIGURATION
// =============================================================================

// AI Prompt Template
// Use {BIO} as placeholder for the actual biography text
define('BIO_PROCESSING_PROMPT', 
    "You are an editor for TEDx events. Rewrite the following speaker biography to be professional, engaging, and under 80 words. " .
    "Use the third person. Focus on their achievements and expertise. " .
    "Do not add any preamble or postamble - return only the rewritten biography.\n\n" .
    "Input Biography:\n{BIO}"
);

// Maximum bio lengths
define('BIO_RAW_MAX_LENGTH', 2000);                 // Original bio limit
define('BIO_PROCESSED_MAX_LENGTH', 600);            // Processed bio limit (database)

// =============================================================================
// DATABASE CONFIGURATION
// =============================================================================

// Note: These should match your db_conn.php settings
// Included here for reference only

define('DB_TABLE_NAME', 'speakers');
define('DB_DEFAULT_STATUS', 'published');
define('DB_DATE_FORMAT', 'Y-m-d H:i:s');

// =============================================================================
// ADMIN INTERFACE CONFIGURATION
// =============================================================================

// Pagination
define('SPEAKERS_PER_PAGE', 50);                    // Speakers shown per page

// Default values for forms
define('DEFAULT_DISPLAY_ORDER', 0);
define('DEFAULT_STATUS', 'published');
define('DEFAULT_GENERATION_NEW_SPEAKER', 7);

// Status options
define('STATUS_OPTIONS', [
    'published' => 'Published',
    'draft' => 'Draft',
    'archived' => 'Archived'
]);

// =============================================================================
// SECURITY CONFIGURATION
// =============================================================================

// Session timeout (in seconds)
define('SESSION_TIMEOUT', 3600);                    // 1 hour

// File validation
define('VALIDATE_FILE_EXTENSIONS', true);
define('VALIDATE_MIME_TYPES', true);
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);

// SQL Injection Protection
define('USE_PREPARED_STATEMENTS', true);            // Always keep true

// =============================================================================
// FRONTEND DISPLAY CONFIGURATION
// =============================================================================

// Homepage speaker display
define('MAX_SPEAKERS_HOMEPAGE', 20);                // Max speakers to show
define('SHOW_MYSTERY_SPEAKERS', true);              // Show TBA cards
define('ENABLE_LAZY_LOADING', true);                // Lazy load images

// Social media display
define('SHOW_SOCIAL_LINKS', true);
define('SOCIAL_LINK_TARGET', '_blank');
define('SOCIAL_LINK_REL', 'noopener noreferrer');

// =============================================================================
// ERROR HANDLING & LOGGING
// =============================================================================

// Development vs Production
define('ENVIRONMENT', 'production');                // 'development' or 'production'

// Error Display (only enable in development)
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Error Logging
define('ENABLE_ERROR_LOGGING', true);
define('ERROR_LOG_FILE', '../../logs/speaker_errors.log');

// =============================================================================
// PERFORMANCE OPTIMIZATION
// =============================================================================

// Caching
define('ENABLE_QUERY_CACHING', false);              // Requires Redis/Memcached
define('CACHE_DURATION', 3600);                     // Cache for 1 hour

// Image optimization
define('ENABLE_PROGRESSIVE_JPEG', true);
define('STRIP_IMAGE_METADATA', true);               // Remove EXIF data

// =============================================================================
// BACKUP CONFIGURATION
// =============================================================================

// Automatic backups
define('ENABLE_AUTO_BACKUP', false);
define('BACKUP_DIRECTORY', '../../backups/speakers/');
define('BACKUP_RETENTION_DAYS', 30);

// =============================================================================
// NOTIFICATION CONFIGURATION
// =============================================================================

// Email notifications
define('ENABLE_EMAIL_NOTIFICATIONS', false);
define('ADMIN_EMAIL', 'admin@tedxmanaratalfaroukschool.com');
define('NOTIFY_ON_NEW_SPEAKER', false);
define('NOTIFY_ON_SPEAKER_UPDATE', false);
define('NOTIFY_ON_SPEAKER_DELETE', false);

// =============================================================================
// FEATURE FLAGS
// =============================================================================

// Enable/disable features
define('FEATURE_AI_BIO_PROCESSING', true);
define('FEATURE_IMAGE_OPTIMIZATION', true);
define('FEATURE_SOCIAL_MEDIA_LINKS', true);
define('FEATURE_DRAFT_MODE', true);
define('FEATURE_DISPLAY_ORDER', true);

// =============================================================================
// CUSTOM BRANDING
// =============================================================================

define('ADMIN_PANEL_TITLE', 'TEDxManaratAlFarouk Speaker Management');
define('ADMIN_PANEL_LOGO', '../../images/tedx-logo-white.webp');
define('ADMIN_PRIMARY_COLOR', '#eb0028');
define('ADMIN_SECONDARY_COLOR', '#c00020');

// =============================================================================
// API RATE LIMITING
// =============================================================================

// Gemini API rate limits
define('GEMINI_MAX_REQUESTS_PER_MINUTE', 60);
define('GEMINI_REQUEST_TIMEOUT', 30);               // Seconds

// =============================================================================
// MAINTENANCE MODE
// =============================================================================

define('MAINTENANCE_MODE', false);
define('MAINTENANCE_MESSAGE', 'The speaker management system is currently undergoing maintenance. Please check back soon.');
define('MAINTENANCE_BYPASS_IPS', [
    '127.0.0.1',                                    // Localhost
    // Add your IP here to bypass maintenance
]);

// =============================================================================
// END OF CONFIGURATION
// =============================================================================

/**
 * Validation function to check if configuration is complete
 * Call this in process.php to ensure all settings are configured
 */
function validateConfiguration() {
    $errors = [];
    
    // Check critical settings
    if (GEMINI_API_KEY === 'YOUR_GEMINI_API_KEY_HERE') {
        $errors[] = "Gemini API key not configured";
    }
    
    if (!is_writable(UPLOAD_BASE_DIR)) {
        $errors[] = "Upload directory is not writable: " . UPLOAD_BASE_DIR;
    }
    
    if (!extension_loaded('gd')) {
        $errors[] = "GD library not installed (required for image processing)";
    }
    
    if (!extension_loaded('curl')) {
        $errors[] = "cURL extension not installed (required for API calls)";
    }
    
    return $errors;
}

/**
 * Helper function to get upload directory for a generation
 * 
 * @param int $generation Generation number
 * @return string Full path to upload directory
 */
function getGenerationUploadDir($generation) {
    return UPLOAD_BASE_DIR . $generation . '/';
}

/**
 * Helper function to format file size
 * 
 * @param int $bytes File size in bytes
 * @return string Formatted file size
 */
function formatFileSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, 2) . ' ' . $units[$pow];
}

/**
 * Helper function to sanitize filename
 * 
 * @param string $filename Original filename
 * @return string Sanitized filename
 */
function sanitizeFilename($filename) {
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    $filename = preg_replace('/_+/', '_', $filename);
    return strtolower($filename);
}

// =============================================================================
// CONFIGURATION LOAD CONFIRMATION
// =============================================================================

if (ENVIRONMENT === 'development') {
    error_log("Speaker Management Configuration Loaded Successfully");
    
    $configErrors = validateConfiguration();
    if (!empty($configErrors)) {
        error_log("Configuration Errors Found:");
        foreach ($configErrors as $error) {
            error_log("  - " . $error);
        }
    }
}
