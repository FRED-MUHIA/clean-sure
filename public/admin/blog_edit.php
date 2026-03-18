<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/blog_lib.php';
require_once __DIR__ . '/partials.php';

require_login();

$blogs = load_blogs();
$id = $_GET['id'] ?? '';
$editing = $id !== '';
$blog = $editing ? (find_blog($blogs, $id) ?? []) : [];

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $image = trim($_POST['image'] ?? '');
    $tagsInput = trim($_POST['tags'] ?? '');
    $date = trim($_POST['date'] ?? date('Y-m-d'));

    if ($title === '' || $content === '') {
        $error = 'Title and content are required.';
    } else {
        $slug = $editing ? ($blog['id'] ?? slugify($title)) : slugify($title);
        $tags = array_values(array_filter(array_map('trim', preg_split('/,/', $tagsInput))));
        $entry = [
            'id' => $slug,
            'title' => $title,
            'category' => $category !== '' ? $category : 'General',
            'excerpt' => $excerpt !== '' ? $excerpt : strip_tags($content),
            'content' => $content,
            'image' => $image,
            'tags' => $tags,
            'date' => $date,
        ];

        if ($editing) {
            foreach ($blogs as $idx => $item) {
                if (($item['id'] ?? '') === $id) {
                    $blogs[$idx] = $entry;
                    break;
                }
            }
        } else {
            $blogs[] = $entry;
        }

        if (save_blogs($blogs)) {
            $success = 'Blog saved.';
            $id = $slug;
            $editing = true;
            $blog = $entry;
        } else {
            $error = 'Failed to save blog.';
        }
    }
}

$blogTitle = $blog['title'] ?? '';
$blogCategory = $blog['category'] ?? '';
$blogExcerpt = $blog['excerpt'] ?? '';
$blogContent = $blog['content'] ?? '';
$blogImage = $blog['image'] ?? '';
$blogTags = isset($blog['tags']) && is_array($blog['tags']) ? implode(', ', $blog['tags']) : '';
$blogDate = $blog['date'] ?? date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $editing ? 'Edit Blog' : 'Add Blog'; ?></title>
    <base href="<?php echo htmlspecialchars(admin_url('/'), ENT_QUOTES); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars(admin_url('styles.css'), ENT_QUOTES); ?>" />
  </head>
  <body class="admin-body">
    <div class="admin-shell">
      <header class="admin-header">
        <div>
          <h1><?php echo $editing ? 'Edit Blog' : 'Add Blog'; ?></h1>
          <p>Manage your blog content.</p>
        </div>
        <div class="admin-actions">
          <a class="btn btn-outline" href="blogs.php">Back</a>
        </div>
      </header>
      <?php render_admin_nav('blogs'); ?>

      <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
      <?php endif; ?>
      <?php if ($success): ?>
        <p class="success"><?php echo htmlspecialchars($success, ENT_QUOTES); ?></p>
      <?php endif; ?>

      <form method="post" class="editor-form" id="blog-form">
        <section class="card">
          <div class="editor-two-cols">
            <label>
              Title
              <input type="text" name="title" value="<?php echo htmlspecialchars($blogTitle, ENT_QUOTES); ?>" required />
            </label>
            <label>
              Category
              <input type="text" name="category" value="<?php echo htmlspecialchars($blogCategory, ENT_QUOTES); ?>" placeholder="e.g. Cleaning" />
            </label>
            <label>
              Date
              <input type="date" name="date" value="<?php echo htmlspecialchars($blogDate, ENT_QUOTES); ?>" />
            </label>
            <label>
              Featured Image (URL)
              <input type="text" name="image" id="featured-image" value="<?php echo htmlspecialchars($blogImage, ENT_QUOTES); ?>" placeholder="assets/uploads/your-image.jpg" />
            </label>
          </div>
          <label>
            Excerpt
            <textarea name="excerpt" rows="3"><?php echo htmlspecialchars($blogExcerpt, ENT_QUOTES); ?></textarea>
          </label>
        </section>

        <section class="card">
          <h2>Content</h2>
          <div class="editor-toolbar">
            <button type="button" data-cmd="bold"><strong>B</strong></button>
            <button type="button" data-cmd="italic"><em>I</em></button>
            <button type="button" data-cmd="underline"><span style="text-decoration:underline;">U</span></button>
            <button type="button" data-block="h2">H2</button>
            <button type="button" data-block="p">P</button>
            <button type="button" data-cmd="insertUnorderedList">• List</button>
            <button type="button" data-action="link">Link</button>
            <button type="button" data-action="image">Upload Image</button>
          </div>
          <div id="blog-editor" class="editor-surface" contenteditable="true"></div>
          <textarea id="content" name="content" class="editor-hidden"></textarea>
          <input id="image-upload" type="file" accept="image/*" class="editor-hidden" />
        </section>

        <section class="card">
          <label>
            Tags (comma-separated)
            <input type="text" name="tags" value="<?php echo htmlspecialchars($blogTags, ENT_QUOTES); ?>" placeholder="Cleaning Tips, Organizing" />
          </label>
          <div class="editor-footer-actions">
            <button type="submit" class="btn">Save Blog</button>
          </div>
        </section>
      </form>
    </div>
    <script>
      const editor = document.getElementById('blog-editor');
      const contentField = document.getElementById('content');
      const featuredField = document.getElementById('featured-image');
      const initialContent = <?php echo json_encode($blogContent, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
      editor.innerHTML = initialContent || '';

      const applyCommand = (cmd, value = null) => {
        document.execCommand(cmd, false, value);
        editor.focus();
      };

      document.querySelectorAll('.editor-toolbar [data-cmd]').forEach((btn) => {
        btn.addEventListener('click', () => applyCommand(btn.dataset.cmd));
      });

      document.querySelectorAll('.editor-toolbar [data-block]').forEach((btn) => {
        btn.addEventListener('click', () => applyCommand('formatBlock', btn.dataset.block));
      });

      document.querySelectorAll('.editor-toolbar [data-action=\"link\"]').forEach((btn) => {
        btn.addEventListener('click', () => {
          const url = prompt('Enter link URL');
          if (url) applyCommand('createLink', url);
        });
      });

      document.querySelectorAll('.editor-toolbar [data-action=\"image\"]').forEach((btn) => {
        btn.addEventListener('click', () => document.getElementById('image-upload').click());
      });

      document.getElementById('image-upload').addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file) return;
        const formData = new FormData();
        formData.append('image', file);
        try {
          const response = await fetch('<?php echo htmlspecialchars(admin_url('upload.php'), ENT_QUOTES); ?>', { method: 'POST', body: formData });
          const result = await response.json();
          if (result.success) {
            applyCommand('insertImage', result.path);
            if (!featuredField.value) {
              featuredField.value = result.path;
            }
          } else {
            alert(result.error || 'Upload failed.');
          }
        } catch {
          alert('Upload failed.');
        } finally {
          event.target.value = '';
        }
      });

      document.getElementById('blog-form').addEventListener('submit', () => {
        contentField.value = editor.innerHTML;
      });
    </script>
  </body>
</html>
