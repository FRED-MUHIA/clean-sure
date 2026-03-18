<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/pages.php';
require_once __DIR__ . '/partials.php';

require_login();

if (isset($_GET['logout'])) {
    logout();
    header('Location: ' . admin_url('index.php'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <base href="<?php echo htmlspecialchars(admin_url('/'), ENT_QUOTES); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars(admin_url('styles.css'), ENT_QUOTES); ?>" />
  </head>
  <body class="admin-body">
    <div class="admin-shell">
      <header class="admin-header">
        <div>
          <h1>Admin Dashboard</h1>
          <p>Manage page content and media.</p>
        </div>
        <div class="admin-actions">
          <a class="btn" href="media.php">Media Library</a>
          <a class="btn btn-outline" href="dashboard.php?logout=1">Log out</a>
        </div>
      </header>
      <?php render_admin_nav('dashboard'); ?>

      <section class="card-grid" id="page-editor">
        <article class="card">
          <h2>Menu & Logo</h2>
          <p>Edit logo, favicon, and menu links with a structured global editor.</p>
          <a class="btn" href="header_edit.php">Open Editor</a>
        </article>
        <article class="card">
          <h2>Background Images</h2>
          <p>Update hero/background images across all pages from one place.</p>
          <a class="btn" href="background_edit.php">Open Editor</a>
        </article>
        <article class="card">
          <h2>Blog Manager</h2>
          <p>Manage blog posts.</p>
          <a class="btn" href="blogs.php">Open</a>
        </article>
        <?php foreach (EDITABLE_PAGES as $file => $pageMeta): ?>
          <article class="card">
            <h2><?php echo htmlspecialchars((string) ($pageMeta['label'] ?? $file), ENT_QUOTES); ?></h2>
            <p><?php echo htmlspecialchars($file, ENT_QUOTES); ?></p>
            <a class="btn" href="edit.php?page=<?php echo urlencode($file); ?>">Edit</a>
          </article>
        <?php endforeach; ?>
      </section>
    </div>
  </body>
</html>
