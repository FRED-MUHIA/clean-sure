<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/blog_lib.php';
require_once __DIR__ . '/partials.php';

require_login();

$blogs = load_blogs();
usort($blogs, fn($a, $b) => strtotime($b['date'] ?? '') <=> strtotime($a['date'] ?? ''));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog Manager</title>
    <base href="<?php echo htmlspecialchars(admin_url('/'), ENT_QUOTES); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars(admin_url('styles.css'), ENT_QUOTES); ?>" />
  </head>
  <body class="admin-body">
    <div class="admin-shell">
      <header class="admin-header">
        <div>
          <h1>Blog Manager</h1>
          <p>Create, edit, and publish blog posts.</p>
        </div>
        <div class="admin-actions">
          <a class="btn" href="blog_edit.php">Add New</a>
          <a class="btn btn-outline" href="dashboard.php">Back</a>
        </div>
      </header>
      <?php render_admin_nav('blogs'); ?>

      <section class="card">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($blogs) === 0): ?>
              <tr><td colspan="4">No blog posts yet.</td></tr>
            <?php endif; ?>
            <?php foreach ($blogs as $blog): ?>
              <tr>
                <td><?php echo htmlspecialchars($blog['title'] ?? '', ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($blog['category'] ?? '', ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($blog['date'] ?? '', ENT_QUOTES); ?></td>
                <td class="actions">
                  <a class="btn btn-small" href="blog_edit.php?id=<?php echo urlencode($blog['id']); ?>">Edit</a>
                  <a class="btn btn-small btn-outline" href="blog_delete.php?id=<?php echo urlencode($blog['id']); ?>" onclick="return confirm('Delete this post?');">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
    </div>
  </body>
</html>
