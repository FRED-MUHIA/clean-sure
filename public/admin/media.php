<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/partials.php';
require_login();

if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

$error = '';
$success = '';

if (isset($_GET['delete'])) {
    $fileToDelete = basename($_GET['delete']);
    $target = UPLOAD_DIR . '/' . $fileToDelete;
    if (is_file($target)) {
        unlink($target);
        $success = 'Image deleted.';
    } else {
        $error = 'File not found.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'Upload failed.';
    } else {
        $imageInfo = getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            $error = 'Only image files are allowed.';
        } else {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME));
            $fileName = $safeName . '_' . time() . '.' . $ext;
            $targetPath = UPLOAD_DIR . '/' . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $success = 'Image uploaded.';
            } else {
                $error = 'Failed to save the file.';
            }
        }
    }
}

$files = [];
if (is_dir(UPLOAD_DIR)) {
    $files = array_values(array_filter(scandir(UPLOAD_DIR), fn($f) => !in_array($f, ['.', '..'], true)));
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Media Library</title>
    <base href="<?php echo htmlspecialchars(admin_url('/'), ENT_QUOTES); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars(admin_url('styles.css'), ENT_QUOTES); ?>" />
  </head>
  <body class="admin-body">
    <div class="admin-shell">
      <header class="admin-header">
        <div>
          <h1>Media Library</h1>
          <p>Upload and use images in your pages.</p>
        </div>
        <div class="admin-actions">
          <a class="btn" href="dashboard.php">Back</a>
        </div>
      </header>
      <?php render_admin_nav('media'); ?>

      <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
      <?php endif; ?>
      <?php if ($success): ?>
        <p class="success"><?php echo htmlspecialchars($success, ENT_QUOTES); ?></p>
      <?php endif; ?>

      <section class="card">
        <form method="post" enctype="multipart/form-data" class="upload-form">
          <label>
            Upload image
            <input type="file" name="image" accept="image/*" required />
          </label>
          <button type="submit" class="btn">Upload</button>
        </form>
      </section>

      <section class="media-grid">
        <?php foreach ($files as $file): ?>
          <?php $url = '../' . UPLOAD_URL . '/' . $file; ?>
          <div class="media-card">
            <a href="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" target="_blank">
              <img src="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($file, ENT_QUOTES); ?>" />
            </a>
            <p><?php echo htmlspecialchars($file, ENT_QUOTES); ?></p>
            <input class="media-input" type="text" readonly value="<?php echo htmlspecialchars('assets/uploads/' . $file, ENT_QUOTES); ?>" />
            <div class="media-actions">
              <a class="btn btn-small" href="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" target="_blank">Open</a>
              <button class="btn btn-small" type="button" data-copy="<?php echo htmlspecialchars('assets/uploads/' . $file, ENT_QUOTES); ?>">Copy Link</button>
              <a class="btn btn-small btn-outline" href="media.php?delete=<?php echo urlencode($file); ?>" onclick="return confirm('Delete this image?');">Delete</a>
            </div>
          </div>
        <?php endforeach; ?>
      </section>
    </div>
    <script>
      document.querySelectorAll('[data-copy]').forEach((btn) => {
        btn.addEventListener('click', async () => {
          const text = btn.getAttribute('data-copy');
          try {
            await navigator.clipboard.writeText(text);
            btn.textContent = 'Copied';
            setTimeout(() => (btn.textContent = 'Copy Link'), 1200);
          } catch (err) {
            const input = btn.closest('.media-card')?.querySelector('.media-input');
            if (input) {
              input.focus();
              input.select();
            }
          }
        });
      });
    </script>
  </body>
</html>
