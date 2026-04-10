<?php
// ============================================================
// Colonel's Sainik Vidyalaya — Database Configuration
// File: api/config.php
// ============================================================
// FILL IN YOUR BLUEHOST DETAILS BELOW
// (cPanel → MySQL Databases to find these)
// ============================================================

define('DB_HOST',     'localhost');           // Usually 'localhost' on Bluehost
define('DB_NAME',     'youruser_csv_db');     // Replace 'youruser_' with your cPanel username
define('DB_USER',     'youruser_csvadmin');   // Your MySQL username
define('DB_PASS',     'YOUR_DB_PASSWORD');    // Your MySQL password
define('DB_CHARSET',  'utf8mb4');

// ============================================================
// SECURITY SETTINGS
// ============================================================
define('SESSION_DURATION',  7200);           // Session timeout: 2 hours (seconds)
define('MAX_LOGIN_ATTEMPTS', 5);             // Lock after 5 failed logins
define('LOCKOUT_TIME',       900);           // Lockout duration: 15 minutes

// ============================================================
// SITE SETTINGS
// ============================================================
define('SITE_URL',    'https://www.colonelssainikvidyalaya.in');
define('ADMIN_URL',   SITE_URL . '/admin');

// ============================================================
// PDO DATABASE CONNECTION
// ============================================================
function getDB(): PDO {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        DB_HOST, DB_NAME, DB_CHARSET
    );
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        http_response_code(500);
        die(json_encode(['success' => false, 'error' => 'Database connection failed']));
    }
    return $pdo;
}

// ============================================================
// CORS + JSON HEADERS (for API endpoints)
// ============================================================
function setApiHeaders(): void {
    header('Content-Type: application/json; charset=utf-8');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    // Allow requests from same domain only
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    if ($origin === SITE_URL || $origin === 'http://localhost') {
        header("Access-Control-Allow-Origin: $origin");
    }
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token');
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200); exit;
    }
}

// ============================================================
// JSON RESPONSE HELPERS
// ============================================================
function jsonSuccess(array $data = [], string $message = 'OK'): void {
    echo json_encode(['success' => true, 'message' => $message, 'data' => $data]);
    exit;
}

function jsonError(string $message, int $code = 400): void {
    http_response_code($code);
    echo json_encode(['success' => false, 'error' => $message]);
    exit;
}

// ============================================================
// SESSION AUTH CHECK (call at top of admin API endpoints)
// ============================================================
function requireAuth(): int {
    $token = $_SERVER['HTTP_X_AUTH_TOKEN'] ?? $_COOKIE['csv_admin_token'] ?? '';
    if (!$token) jsonError('Unauthorised', 401);

    $db = getDB();
    $stmt = $db->prepare(
        'SELECT s.user_id FROM admin_sessions s
         WHERE s.token = ? AND s.expires_at > NOW()
         LIMIT 1'
    );
    $stmt->execute([$token]);
    $row = $stmt->fetch();
    if (!$row) jsonError('Session expired. Please log in again.', 401);

    // Extend session on activity
    $db->prepare('UPDATE admin_sessions SET expires_at = DATE_ADD(NOW(), INTERVAL ? SECOND) WHERE token = ?')
       ->execute([SESSION_DURATION, $token]);

    return (int) $row['user_id'];
}

// ============================================================
// LOG ADMIN ACTION
// ============================================================
function logAction(int $adminId, string $action, string $desc = ''): void {
    try {
        getDB()->prepare(
            'INSERT INTO activity_log (admin_id, action, description, ip_address) VALUES (?,?,?,?)'
        )->execute([$adminId, $action, $desc, $_SERVER['REMOTE_ADDR'] ?? '']);
    } catch (Exception $e) { /* non-critical */ }
}
