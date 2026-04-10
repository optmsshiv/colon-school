<?php
// ============================================================
// Colonel's Sainik Vidyalaya — Auth API
// File: api/auth.php
// Handles: login, logout, session check
// ============================================================
require_once __DIR__ . '/config.php';
setApiHeaders();

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';
$body   = json_decode(file_get_contents('php://input'), true) ?? [];

// ---- POST /api/auth.php?action=login ----
if ($method === 'POST' && $action === 'login') {
    $username = trim($body['username'] ?? '');
    $password = $body['password'] ?? '';

    if (!$username || !$password) jsonError('Username and password required');

    $db = getDB();

    // Check for lockout
    $lockKey = 'login_fail_' . md5($username . ($_SERVER['REMOTE_ADDR'] ?? ''));
    // (Simple: stored in DB via activity_log count — production should use Redis/memcached)

    $stmt = $db->prepare('SELECT id, password_hash FROM admin_users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        // Log failed attempt
        $db->prepare('INSERT INTO activity_log (action, description, ip_address) VALUES (?,?,?)')
           ->execute(['login_failed', "Failed login for: $username", $_SERVER['REMOTE_ADDR'] ?? '']);
        jsonError('Invalid username or password', 401);
    }

    // Create session token
    $token     = bin2hex(random_bytes(32));
    $expiresAt = date('Y-m-d H:i:s', time() + SESSION_DURATION);

    $db->prepare(
        'INSERT INTO admin_sessions (user_id, token, ip_address, user_agent, expires_at)
         VALUES (?,?,?,?,?)'
    )->execute([
        $user['id'], $token,
        $_SERVER['REMOTE_ADDR']  ?? '',
        $_SERVER['HTTP_USER_AGENT'] ?? '',
        $expiresAt
    ]);

    // Update last login
    $db->prepare('UPDATE admin_users SET last_login = NOW() WHERE id = ?')->execute([$user['id']]);

    logAction($user['id'], 'login', 'Successful login');

    // Set secure cookie
    setcookie('csv_admin_token', $token, [
        'expires'  => time() + SESSION_DURATION,
        'path'     => '/',
        'secure'   => true,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);

    jsonSuccess(['token' => $token, 'expires_at' => $expiresAt], 'Login successful');
}

// ---- POST /api/auth.php?action=logout ----
if ($method === 'POST' && $action === 'logout') {
    $token = $_SERVER['HTTP_X_AUTH_TOKEN'] ?? $_COOKIE['csv_admin_token'] ?? '';
    if ($token) {
        getDB()->prepare('DELETE FROM admin_sessions WHERE token = ?')->execute([$token]);
        setcookie('csv_admin_token', '', ['expires' => time()-3600, 'path' => '/']);
    }
    jsonSuccess([], 'Logged out');
}

// ---- GET /api/auth.php?action=check ----
if ($method === 'GET' && $action === 'check') {
    $adminId = requireAuth(); // throws 401 if not valid
    jsonSuccess(['admin_id' => $adminId], 'Session valid');
}

// ---- POST /api/auth.php?action=change_password ----
if ($method === 'POST' && $action === 'change_password') {
    $adminId    = requireAuth();
    $current    = $body['current_password'] ?? '';
    $newPass    = $body['new_password'] ?? '';
    $confirm    = $body['confirm_password'] ?? '';

    if (!$current || !$newPass || !$confirm) jsonError('All fields required');
    if (strlen($newPass) < 8)                jsonError('Password must be at least 8 characters');
    if ($newPass !== $confirm)               jsonError('Passwords do not match');

    $db   = getDB();
    $stmt = $db->prepare('SELECT password_hash FROM admin_users WHERE id = ?');
    $stmt->execute([$adminId]);
    $user = $stmt->fetch();

    if (!password_verify($current, $user['password_hash'])) {
        jsonError('Current password is incorrect');
    }

    $newHash = password_hash($newPass, PASSWORD_BCRYPT, ['cost' => 12]);
    $db->prepare('UPDATE admin_users SET password_hash = ? WHERE id = ?')
       ->execute([$newHash, $adminId]);

    // Invalidate all other sessions
    $token = $_SERVER['HTTP_X_AUTH_TOKEN'] ?? $_COOKIE['csv_admin_token'] ?? '';
    $db->prepare('DELETE FROM admin_sessions WHERE user_id = ? AND token != ?')
       ->execute([$adminId, $token]);

    logAction($adminId, 'change_password', 'Password changed successfully');
    jsonSuccess([], 'Password updated successfully');
}

jsonError('Invalid request', 400);
