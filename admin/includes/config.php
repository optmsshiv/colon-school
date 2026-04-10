<?php
/**
 * Database Configuration — Colonel's Sainik Vidyalaya
 * File: admin/includes/config.php
 * ⚠️  Change these values to match your cPanel hosting credentials
 */

// ── Database ──────────────────────────────────────────────
define('DB_HOST',   'localhost');          // Usually 'localhost' on cPanel
define('DB_USER',   'edrppymy_csv_admin');       // cPanel DB username  e.g. csv_admin
define('DB_PASS',   '13579@Admin');   // cPanel DB password
define('DB_NAME',   'edrppymy_csv_db');         // Database name (created from SQL above)
define('DB_CHARSET','utf8mb4');

// ── Upload Settings ────────────────────────────────────────
define('UPLOAD_DIR',   dirname(__DIR__) . '/uploads/gallery/');  // Absolute path
define('UPLOAD_URL',   '/admin/uploads/gallery/');               // Public URL path
define('MAX_FILE_SIZE', 5 * 1024 * 1024);  // 5 MB max per image
define('ALLOWED_TYPES', ['image/jpeg','image/png','image/webp','image/gif']);
define('ALLOWED_EXTS',  ['jpg','jpeg','png','webp','gif']);

// ── Session & Security ─────────────────────────────────────
define('SESSION_NAME',    'csv_admin_sess');
define('ADMIN_TITLE',     "Colonel's Sainik Vidyalaya — Gallery Admin");
define('SITE_URL',        'https://www.colonelssainikvidyalaya.in'); // Change to your domain

// ── Pagination ─────────────────────────────────────────────
define('IMAGES_PER_PAGE', 20);

// ── Thumbnail ─────────────────────────────────────────────
define('THUMB_WIDTH',  400);
define('THUMB_HEIGHT', 300);
define('MAKE_THUMBS',  true);  // Set false if GD not available on host

// ══════════════════════════════════════════════════════════
//  DO NOT EDIT BELOW THIS LINE
// ══════════════════════════════════════════════════════════

/** Get PDO database connection (singleton) */
function getDB(): PDO {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        http_response_code(500);
        die('<div style="font-family:sans-serif;padding:40px;color:#b91c1c;background:#fef2f2;border-radius:8px;margin:40px auto;max-width:600px;">
            <h2>⚠️ Database Connection Failed</h2>
            <p>Could not connect to the database. Please check <code>admin/includes/config.php</code> settings.</p>
            <small style="color:#6b7280;">Error: ' . htmlspecialchars($e->getMessage()) . '</small>
        </div>');
    }
    return $pdo;
}

/** Start session safely */
function startAdminSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_name(SESSION_NAME);
        session_start();
    }
}

/** Check if admin is logged in */
function isLoggedIn(): bool {
    startAdminSession();
    return !empty($_SESSION['admin_id']) && !empty($_SESSION['admin_user']);
}

/** Redirect if not logged in */
function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

/** Flash message helper */
function setFlash(string $type, string $msg): void {
    startAdminSession();
    $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
}

function getFlash(): ?array {
    startAdminSession();
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $f;
    }
    return null;
}

/** Sanitize output */
function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/** Create upload directory if missing */
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}
if (MAKE_THUMBS && !is_dir(UPLOAD_DIR . 'thumbs/')) {
    mkdir(UPLOAD_DIR . 'thumbs/', 0755, true);
}
