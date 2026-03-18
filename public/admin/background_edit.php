<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/partials.php';

require_login();

/**
 * @return array<string, array{label:string,file:string,preview:string,type:string}>
 */
function background_targets(): array
{
    return [
        'home' => [
            'label' => 'Home Hero Image',
            'file' => 'resources/views/pages/home.blade.php',
            'preview' => '/',
            'type' => 'hero_img',
        ],
        'about' => [
            'label' => 'About Hero Background',
            'file' => 'resources/views/pages/about.blade.php',
            'preview' => '/about',
            'type' => 'hero_bg',
        ],
        'services' => [
            'label' => 'Services Hero Background',
            'file' => 'resources/views/pages/services.blade.php',
            'preview' => '/services',
            'type' => 'hero_bg',
        ],
        'pricing' => [
            'label' => 'Pricing Hero Background',
            'file' => 'resources/views/pages/pricing.blade.php',
            'preview' => '/pricing',
            'type' => 'hero_bg',
        ],
        'projects' => [
            'label' => 'Service Areas Hero Background',
            'file' => 'resources/views/pages/projects.blade.php',
            'preview' => '/projects',
            'type' => 'hero_bg',
        ],
        'contact' => [
            'label' => 'Contact Hero Background',
            'file' => 'resources/views/pages/contact.blade.php',
            'preview' => '/contact',
            'type' => 'hero_bg',
        ],
    ];
}

function extract_background_value(string $html, string $type): string
{
    if ($type === 'hero_img') {
        if (preg_match('/<img\s+class="hero-image"[^>]*\ssrc="([^"]+)"/i', $html, $m)) {
            return trim((string) ($m[1] ?? ''));
        }
        return '';
    }

    if (preg_match('/background-image:\s*url\((["\']?)([^"\')]+)\1\)/i', $html, $m)) {
        return trim((string) ($m[2] ?? ''));
    }

    return '';
}

function apply_background_value(string $html, string $type, string $value): ?string
{
    if ($type === 'hero_img') {
        $replaced = preg_replace(
            '/(<img\s+class="hero-image"[^>]*\ssrc=")[^"]+(")/i',
            '${1}' . $value . '${2}',
            $html,
            1
        );

        return is_string($replaced) ? $replaced : null;
    }

    $safe = str_replace("'", "\\'", $value);
    $replaced = preg_replace(
        '/background-image:\s*url\((["\']?)([^"\')]+)\1\)/i',
        "background-image: url('" . $safe . "')",
        $html,
        1
    );

    return is_string($replaced) ? $replaced : null;
}

$targets = background_targets();
$values = [];
$error = '';
$success = '';

foreach ($targets as $id => $target) {
    $fullPath = SITE_ROOT . '/' . $target['file'];
    if (!is_file($fullPath)) {
        $values[$id] = '';
        continue;
    }

    $html = file_get_contents($fullPath);
    $values[$id] = is_string($html) ? extract_background_value($html, $target['type']) : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedValues = $_POST['bg'] ?? [];
    $updated = 0;
    $failed = [];

    foreach ($targets as $id => $target) {
        $input = trim((string) ($postedValues[$id] ?? ''));
        $newValue = $input !== '' ? $input : (string) ($values[$id] ?? '');

        if (str_contains($newValue, '"')) {
            $failed[] = $target['label'] . ' (contains invalid double quote character)';
            continue;
        }

        $fullPath = SITE_ROOT . '/' . $target['file'];
        $existing = is_file($fullPath) ? file_get_contents($fullPath) : false;
        if (!is_string($existing)) {
            $failed[] = $target['label'];
            continue;
        }

        $currentValue = extract_background_value($existing, $target['type']);
        if ($currentValue === '') {
            $failed[] = $target['label'] . ' (target not found in template)';
            continue;
        }

        $replaced = apply_background_value($existing, $target['type'], $newValue);
        if (!is_string($replaced)) {
            $failed[] = $target['label'];
            continue;
        }

        if ($replaced !== $existing) {
            if (file_put_contents($fullPath, $replaced) === false) {
                $failed[] = $target['label'];
                continue;
            }
            $updated++;
        }

        $values[$id] = $newValue;
    }

    if ($updated > 0) {
        $success = 'Background images updated on ' . $updated . ' page(s).';
    } elseif (count($failed) === 0) {
        $success = 'No changes detected.';
    }

    if (count($failed) > 0) {
        $error = 'Could not update: ' . implode(', ', $failed);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Background Images Editor</title>
    <base href="<?php echo htmlspecialchars(admin_url('/'), ENT_QUOTES); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars(admin_url('styles.css'), ENT_QUOTES); ?>" />
  </head>
  <body class="admin-body">
    <div class="admin-shell">
      <header class="admin-header">
        <div>
          <h1>Background Images Editor</h1>
          <p>Manage top section background images for all main pages in one place.</p>
        </div>
        <div class="admin-actions">
          <a class="btn btn-outline" href="media.php" target="_blank">Media Library</a>
          <a class="btn" href="dashboard.php">Back</a>
        </div>
      </header>
      <?php render_admin_nav('backgrounds'); ?>

      <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
      <?php endif; ?>
      <?php if ($success): ?>
        <p class="success"><?php echo htmlspecialchars($success, ENT_QUOTES); ?></p>
      <?php endif; ?>

      <form method="post" class="editor-form" id="bg-form">
        <div class="bg-grid">
          <?php foreach ($targets as $id => $target): ?>
            <article class="card bg-card">
              <h2><?php echo htmlspecialchars($target['label'], ENT_QUOTES); ?></h2>
              <p class="bg-card-link">
                <a href="<?php echo htmlspecialchars($target['preview'], ENT_QUOTES); ?>" target="_blank">Preview page</a>
              </p>
              <div class="bg-preview" id="preview-<?php echo htmlspecialchars($id, ENT_QUOTES); ?>" style="background-image: url('<?php echo htmlspecialchars((string) ($values[$id] ?? ''), ENT_QUOTES); ?>');"></div>
              <label>
                Image URL
                <input
                  type="text"
                  id="bg-<?php echo htmlspecialchars($id, ENT_QUOTES); ?>"
                  name="bg[<?php echo htmlspecialchars($id, ENT_QUOTES); ?>]"
                  value="<?php echo htmlspecialchars((string) ($values[$id] ?? ''), ENT_QUOTES); ?>"
                  placeholder="/assets/uploads/your-image.jpg"
                />
              </label>
              <div class="admin-actions">
                <button type="button" class="btn btn-outline btn-small upload-btn" data-target="bg-<?php echo htmlspecialchars($id, ENT_QUOTES); ?>">
                  Upload & Use
                </button>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <input id="bg-upload" type="file" accept="image/*" class="editor-hidden" />
        <div class="editor-footer-actions">
          <button type="submit" class="btn">Save Background Images</button>
        </div>
      </form>
    </div>

    <script>
      const uploadInput = document.getElementById('bg-upload');
      let activeTargetInput = null;

      const setPreview = (input) => {
        if (!input) return;
        const id = input.id.replace('bg-', 'preview-');
        const preview = document.getElementById(id);
        if (preview) {
          preview.style.backgroundImage = `url('${input.value.trim()}')`;
        }
      };

      document.querySelectorAll('.upload-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
          const targetId = btn.getAttribute('data-target');
          const targetInput = targetId ? document.getElementById(targetId) : null;
          if (!targetInput) return;
          activeTargetInput = targetInput;
          uploadInput.click();
        });
      });

      document.querySelectorAll('input[id^="bg-"]').forEach((input) => {
        input.addEventListener('input', () => setPreview(input));
      });

      uploadInput.addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file || !activeTargetInput) return;

        const formData = new FormData();
        formData.append('image', file);

        try {
          const response = await fetch('<?php echo htmlspecialchars(admin_url('upload.php'), ENT_QUOTES); ?>', {
            method: 'POST',
            body: formData,
          });
          const result = await response.json();
          if (result.success) {
            activeTargetInput.value = '/' + result.path.replace(/^\/+/, '');
            setPreview(activeTargetInput);
          } else {
            alert(result.error || 'Upload failed.');
          }
        } catch (err) {
          alert('Upload failed.');
        } finally {
          event.target.value = '';
          activeTargetInput = null;
        }
      });
    </script>
  </body>
</html>
