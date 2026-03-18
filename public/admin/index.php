<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if ($requestPath === '/admin') {
    header('Location: ' . admin_url('index.php'));
    exit;
}

if (is_logged_in()) {
    header('Location: ' . admin_url('dashboard.php'));
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (try_login($username, $password)) {
        header('Location: ' . admin_url('dashboard.php'));
        exit;
    }

    $error = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <base href="<?php echo htmlspecialchars(admin_url('/'), ENT_QUOTES); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars(admin_url('styles.css'), ENT_QUOTES); ?>" />
  </head>
  <body class="admin-body">
    <div class="auth-shell">
      <div class="auth-card">
        <p class="auth-kicker">ClanyEco Admin</p>
        <h1>Welcome Back</h1>
        <p class="auth-subtitle">Sign in to manage pages, pricing, media, and blog content.</p>
        <?php if ($error): ?>
          <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
        <?php endif; ?>
        <form method="post">
          <label>
            Username
            <input type="text" name="username" placeholder="Enter your username" required />
          </label>
          <label>
            Password
            <input type="password" name="password" placeholder="Enter your password" required />
          </label>
          <button type="submit" class="btn auth-submit">Sign In</button>
        </form>
      </div>
    </div>
  </body>
</html>
