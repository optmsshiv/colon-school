<?php
/**
 * Admin Login — Colonel's Sainik Vidyalaya
 * File: admin/login.php
 */
require_once __DIR__ . '/includes/config.php';
startAdminSession();

// Already logged in → go to dashboard
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $pdo  = getDB();
        $stmt = $pdo->prepare('SELECT id, username, password_hash, full_name FROM admin_users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id']   = $user['id'];
            $_SESSION['admin_user'] = $user['username'];
            $_SESSION['admin_name'] = $user['full_name'];

            // Update last login
            $pdo->prepare('UPDATE admin_users SET last_login = NOW() WHERE id = ?')
                ->execute([$user['id']]);

            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Colonel's Sainik Vidyalaya</title>
<style>
  :root {
    --navy:#0f2057; --navy-mid:#1a3a96; --gold:#b8860b; --gold-light:#fdf6e0;
    --white:#fff; --red:#dc2626;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body{
    min-height:100vh;display:flex;align-items:center;justify-content:center;
    background:linear-gradient(135deg,var(--navy) 0%,var(--navy-mid) 60%,#1e4fd8 100%);
    font-family:'Segoe UI',Arial,sans-serif;
  }
  .login-card{
    background:#fff;border-radius:18px;padding:48px 44px;width:100%;max-width:420px;
    box-shadow:0 24px 80px rgba(0,0,0,0.35);
  }
  .logo-row{text-align:center;margin-bottom:32px;}
  .logo-row .emblem{
    width:72px;height:72px;background:linear-gradient(135deg,var(--navy),var(--navy-mid));
    border-radius:50%;display:inline-flex;align-items:center;justify-content:center;
    font-size:32px;margin-bottom:14px;box-shadow:0 6px 20px rgba(15,32,87,.35);
  }
  .logo-row h1{font-size:18px;color:var(--navy);font-weight:700;line-height:1.3;}
  .logo-row p{font-size:12px;color:#6b7280;margin-top:4px;}
  .badge{
    display:inline-block;background:var(--gold-light);color:var(--gold);
    border-radius:20px;padding:4px 14px;font-size:11.5px;font-weight:700;
    letter-spacing:.6px;margin-bottom:28px;border:1px solid #e8d08a;
  }
  .fg{margin-bottom:18px;}
  .fg label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;}
  .fg input{
    width:100%;padding:12px 14px;border:1.5px solid #d1d5db;border-radius:9px;
    font-size:14px;outline:none;transition:.2s;
  }
  .fg input:focus{border-color:var(--navy);box-shadow:0 0 0 3px rgba(15,32,87,.12);}
  .btn-login{
    width:100%;padding:14px;background:linear-gradient(135deg,var(--navy),var(--navy-mid));
    color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:700;
    cursor:pointer;letter-spacing:.5px;transition:.2s;margin-top:8px;
  }
  .btn-login:hover{opacity:.9;transform:translateY(-1px);}
  .error-box{
    background:#fef2f2;border:1px solid #fecaca;border-radius:9px;
    padding:11px 14px;font-size:13px;color:var(--red);margin-bottom:18px;
    display:flex;align-items:center;gap:8px;
  }
  .hint{font-size:11.5px;color:#9ca3af;text-align:center;margin-top:22px;}
  .hint strong{color:#6b7280;}
</style>
</head>
<body>
<div class="login-card">
  <div class="logo-row">
    <div class="emblem">🎖️</div>
    <h1>Colonel's Sainik Vidyalaya</h1>
    <p>Madhepura, Bihar · CBSE School</p>
  </div>
  <div style="text-align:center"><span class="badge">🔐 Gallery Admin Panel</span></div>

  <?php if ($error): ?>
  <div class="error-box">❌ <?= e($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="fg">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="admin"
             value="<?= e($_POST['username'] ?? '') ?>" required autofocus>
    </div>
    <div class="fg">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="••••••••" required>
    </div>
    <button type="submit" class="btn-login">Login to Admin Panel →</button>
  </form>

  <p class="hint">Default credentials: <strong>admin</strong> / <strong>Admin@CSV2026</strong><br>
  Change password immediately after first login.</p>
</div>
</body>
</html>
