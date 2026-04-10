<?php
// ============================================================
// Colonel's Sainik Vidyalaya — First-Time Setup Script
// File: api/setup.php
// RUN ONCE after uploading, then DELETE this file!
// Visit: https://yourdomain.in/api/setup.php
// ============================================================

require_once __DIR__ . '/config.php';

// CHANGE THESE before running:
$ADMIN_USERNAME = 'admin';
$ADMIN_PASSWORD = 'ChangeMe@2026';   // ← Set your real password here

// ---- Generate password hash ----
$hash = password_hash($ADMIN_PASSWORD, PASSWORD_BCRYPT, ['cost' => 12]);

echo "<pre style='font-family:monospace;background:#1a1a2e;color:#d4a017;padding:32px;font-size:14px;'>";
echo "Colonel's Sainik Vidyalaya — Setup\n";
echo "====================================\n\n";

// ---- Test DB connection ----
try {
    $db = getDB();
    echo "✅ Database connected successfully\n\n";
} catch (Exception $e) {
    echo "❌ Database connection FAILED:\n   " . $e->getMessage() . "\n";
    echo "\nCheck DB_HOST, DB_NAME, DB_USER, DB_PASS in api/config.php\n";
    exit;
}

// ---- Create/update admin user ----
try {
    $stmt = $db->prepare('SELECT id FROM admin_users WHERE username = ?');
    $stmt->execute([$ADMIN_USERNAME]);
    $existing = $stmt->fetch();

    if ($existing) {
        $db->prepare('UPDATE admin_users SET password_hash=? WHERE username=?')
           ->execute([$hash, $ADMIN_USERNAME]);
        echo "✅ Admin password updated for: $ADMIN_USERNAME\n";
    } else {
        $db->prepare('INSERT INTO admin_users (username, password_hash, display_name) VALUES (?,?,?)')
           ->execute([$ADMIN_USERNAME, $hash, 'School Administrator']);
        echo "✅ Admin user created: $ADMIN_USERNAME\n";
    }
    echo "   Password hash: $hash\n\n";
} catch (Exception $e) {
    echo "❌ Could not create admin user: " . $e->getMessage() . "\n";
    echo "   Make sure you ran database.sql first!\n\n";
}

// ---- Count tables ----
try {
    $tables = ['admin_users','school_info','ticker_messages','gallery_images',
               'academic_levels','cocurricular_activities','facilities',
               'admission_categories','admission_dates','admission_documents',
               'notices','news_events','contact_info','enquiries','applications','activity_log'];
    echo "📊 Database tables:\n";
    foreach ($tables as $t) {
        $count = $db->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
        echo "   $t: $count rows\n";
    }
} catch (Exception $e) {
    echo "❌ Table check failed: " . $e->getMessage() . "\n";
    echo "   Make sure you imported database.sql first!\n";
}

echo "\n====================================\n";
echo "✅ Setup complete!\n\n";
echo "Next steps:\n";
echo "1. Note your credentials: $ADMIN_USERNAME / $ADMIN_PASSWORD\n";
echo "2. Open admin panel: https://" . ($_SERVER['HTTP_HOST'] ?? 'yourdomain.in') . "/admin/\n";
echo "3. DELETE this file (setup.php) immediately after setup!\n";
echo "4. Change your password in Admin → Change Password\n";
echo "</pre>";
