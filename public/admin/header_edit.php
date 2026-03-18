<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/pages.php';
require_once __DIR__ . '/partials.php';

require_login();

const BRAND_SETTINGS_FILE = PUBLIC_ROOT . '/data/brand_menu.json';

function default_brand_settings(): array
{
    return [
        'logo_text' => 'ClanyEco',
        'logo_href' => '/',
        'logo_icon_class' => 'fa-solid fa-leaf',
        'logo_image' => '',
        'favicon' => '',
        'phone_text' => '+ 1 (180) 567-8990',
        'phone_href' => 'tel:+11805678990',
        'quote_text' => 'Free Quote',
        'quote_href' => '/contact',
        'top_links' => [
            ['label' => 'Contact us', 'url' => '/contact'],
            ['label' => 'Pricing', 'url' => '/pricing'],
            ['label' => 'Blog', 'url' => '/blog'],
        ],
        'groups' => [
            [
                'label' => 'Home',
                'items' => [
                    ['label' => 'Small Cleaning company', 'url' => '#'],
                    ['label' => 'Big Cleaning company', 'url' => '#'],
                ],
            ],
            [
                'label' => 'Services',
                'items' => [
                    ['label' => 'House cleaning', 'url' => '/services'],
                    ['label' => 'Office cleaning', 'url' => '/services'],
                    ['label' => 'Deep cleaning', 'url' => '/services'],
                    ['label' => 'Move in out cleaning', 'url' => '/services'],
                    ['label' => 'Post construction cleaning', 'url' => '/services'],
                    ['label' => 'Recurring cleaning', 'url' => '/services'],
                ],
            ],
            [
                'label' => 'Service areas',
                'items' => [
                    ['label' => 'Atlanta', 'url' => '/projects'],
                    ['label' => 'Boston', 'url' => '/projects'],
                    ['label' => 'Chicago', 'url' => '/projects'],
                    ['label' => 'New York City', 'url' => '/projects'],
                ],
            ],
            [
                'label' => 'About us',
                'items' => [
                    ['label' => 'Who we are', 'url' => '/about'],
                    ['label' => 'Cleaning process', 'url' => '/about'],
                    ['label' => 'FAQ', 'url' => '/about'],
                    ['label' => 'Customer reviews', 'url' => '/about'],
                ],
            ],
        ],
    ];
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES);
}

function normalize_text(string $value, string $fallback = ''): string
{
    $value = trim(strip_tags($value));
    return $value !== '' ? $value : $fallback;
}

function normalize_url(string $value, string $fallback = '#'): string
{
    $value = trim($value);
    if ($value === '') {
        return $fallback;
    }

    if (preg_match('#^(https?://|/|\#|mailto:|tel:)#i', $value) === 1) {
        return $value;
    }

    return '/' . ltrim($value, '/');
}

function normalize_links(array $rows): array
{
    $links = [];
    foreach ($rows as $row) {
        $label = normalize_text((string) ($row['label'] ?? ''));
        $url = normalize_url((string) ($row['url'] ?? ''), '#');
        if ($label === '') {
            continue;
        }
        $links[] = ['label' => $label, 'url' => $url];
    }
    return $links;
}

function normalize_groups(array $rows): array
{
    $groups = [];
    foreach ($rows as $row) {
        $label = normalize_text((string) ($row['label'] ?? ''));
        $items = normalize_links((array) ($row['items'] ?? []));
        if ($label === '' || count($items) === 0) {
            continue;
        }
        $groups[] = ['label' => $label, 'items' => $items];
    }
    return $groups;
}

function load_brand_settings(): array
{
    $defaults = default_brand_settings();
    if (!is_file(BRAND_SETTINGS_FILE)) {
        return $defaults;
    }

    $json = file_get_contents(BRAND_SETTINGS_FILE);
    if (!is_string($json) || trim($json) === '') {
        return $defaults;
    }

    $decoded = json_decode($json, true);
    if (!is_array($decoded)) {
        return $defaults;
    }

    return array_replace_recursive($defaults, $decoded);
}

function save_brand_settings(array $settings): bool
{
    if (!is_dir(dirname(BRAND_SETTINGS_FILE))) {
        mkdir(dirname(BRAND_SETTINGS_FILE), 0755, true);
    }
    $json = json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if (!is_string($json)) {
        return false;
    }
    return file_put_contents(BRAND_SETTINGS_FILE, $json) !== false;
}

function build_header_html(array $settings): string
{
    $logoText = h((string) $settings['logo_text']);
    $logoHref = h((string) $settings['logo_href']);
    $logoIconClass = h((string) $settings['logo_icon_class']);
    $logoImage = trim((string) $settings['logo_image']);
    $phoneText = h((string) $settings['phone_text']);
    $phoneHref = h((string) $settings['phone_href']);
    $quoteText = h((string) $settings['quote_text']);
    $quoteHref = h((string) $settings['quote_href']);

    $logoVisual = '';
    if ($logoImage !== '') {
        $logoVisual = '<img class="logo-image" src="' . h($logoImage) . '" alt="' . $logoText . ' logo" />';
    } else {
        $logoVisual = '<span class="logo-mark"><i class="' . $logoIconClass . '"></i></span>';
    }

    $desktopGroups = '';
    $mobileGroups = '';
    foreach ((array) ($settings['groups'] ?? []) as $group) {
        $groupLabel = h((string) ($group['label'] ?? 'Menu'));
        $groupItems = '';
        foreach ((array) ($group['items'] ?? []) as $item) {
            $itemLabel = h((string) ($item['label'] ?? 'Item'));
            $itemUrl = h((string) ($item['url'] ?? '#'));
            $groupItems .= '              <a href="' . $itemUrl . '">' . $itemLabel . "</a>\n";
        }

        $desktopGroups .= <<<HTML
          <div class="nav-item has-dropdown">
            <button type="button">{$groupLabel} <i class="fa-solid fa-angle-down"></i></button>
            <div class="dropdown">
{$groupItems}            </div>
          </div>

HTML;

        $mobileGroups .= <<<HTML
        <div class="mobile-section">
          <p>{$groupLabel}</p>
{$groupItems}        </div>

HTML;
    }

    $desktopLinks = '';
    $mobileLinks = '';
    foreach ((array) ($settings['top_links'] ?? []) as $link) {
        $linkLabel = h((string) ($link['label'] ?? 'Link'));
        $linkUrl = h((string) ($link['url'] ?? '#'));
        $desktopLinks .= '          <a href="' . $linkUrl . '" class="nav-link">' . $linkLabel . "</a>\n";
        $mobileLinks .= '        <a href="' . $linkUrl . '">' . $linkLabel . "</a>\n";
    }

    return <<<HTML
<header class="site-header">
      <div class="container nav-shell">
        <a class="logo" href="{$logoHref}">
          {$logoVisual}
          {$logoText}
        </a>

        <nav class="nav-links" aria-label="Primary">
{$desktopGroups}{$desktopLinks}        </nav>

        <div class="nav-actions">
          <a class="phone-pill" href="{$phoneHref}"><i class="fa-solid fa-phone"></i> {$phoneText}</a>
          <button class="icon-btn" aria-label="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
          <a href="{$quoteHref}" class="btn btn-primary">{$quoteText}</a>
        </div>

        <button
          id="menu-toggle"
          class="menu-toggle"
          aria-label="Toggle navigation"
          aria-expanded="false"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>

      <div id="mobile-menu" class="mobile-menu">
{$mobileGroups}{$mobileLinks}        <a href="{$quoteHref}" class="btn btn-primary">{$quoteText}</a>
      </div>
    </header>
HTML;
}

function update_favicon(string $html, string $faviconUrl): string
{
    $faviconUrl = trim($faviconUrl);
    $faviconTag = $faviconUrl !== ''
        ? '    <link rel="icon" type="image/png" href="' . h($faviconUrl) . "\" />\n"
        : '';

    $hasIcon = preg_match('/<link[^>]*rel=["\'](?:shortcut\s+)?icon["\'][^>]*>/i', $html) === 1;
    if ($hasIcon) {
        if ($faviconTag === '') {
            return (string) preg_replace('/\s*<link[^>]*rel=["\'](?:shortcut\s+)?icon["\'][^>]*>\s*/i', "\n", $html, 1);
        }
        return (string) preg_replace('/<link[^>]*rel=["\'](?:shortcut\s+)?icon["\'][^>]*>\s*/i', $faviconTag, $html, 1);
    }

    if ($faviconTag !== '') {
        return str_replace("</head>", $faviconTag . "</head>", $html);
    }

    return $html;
}

$settings = load_brand_settings();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings = [
        'logo_text' => normalize_text((string) ($_POST['logo_text'] ?? ''), 'ClanyEco'),
        'logo_href' => normalize_url((string) ($_POST['logo_href'] ?? ''), '/'),
        'logo_icon_class' => normalize_text((string) ($_POST['logo_icon_class'] ?? ''), 'fa-solid fa-leaf'),
        'logo_image' => trim((string) ($_POST['logo_image'] ?? '')),
        'favicon' => trim((string) ($_POST['favicon'] ?? '')),
        'phone_text' => normalize_text((string) ($_POST['phone_text'] ?? ''), '+ 1 (180) 567-8990'),
        'phone_href' => normalize_url((string) ($_POST['phone_href'] ?? ''), 'tel:+11805678990'),
        'quote_text' => normalize_text((string) ($_POST['quote_text'] ?? ''), 'Free Quote'),
        'quote_href' => normalize_url((string) ($_POST['quote_href'] ?? ''), '/contact'),
        'top_links' => normalize_links((array) ($_POST['top_links'] ?? [])),
        'groups' => normalize_groups((array) ($_POST['groups'] ?? [])),
    ];

    if (count($settings['top_links']) === 0) {
        $settings['top_links'] = default_brand_settings()['top_links'];
    }
    if (count($settings['groups']) === 0) {
        $settings['groups'] = default_brand_settings()['groups'];
    }

    $headerHtml = build_header_html($settings);
    $targets = array_values(array_unique(array_filter(
        array_keys(EDITABLE_PAGES),
        static fn (string $path): bool => str_ends_with($path, '.blade.php')
    )));

    $updated = 0;
    $failed = [];
    foreach ($targets as $relativePath) {
        $fullPath = SITE_ROOT . '/' . $relativePath;
        $existing = is_file($fullPath) ? file_get_contents($fullPath) : false;
        if (!is_string($existing)) {
            $failed[] = $relativePath;
            continue;
        }

        $replacedHeader = preg_replace('/<header\b[\s\S]*?<\/header>/i', $headerHtml, $existing, 1);
        if (!is_string($replacedHeader)) {
            $failed[] = $relativePath;
            continue;
        }

        $replaced = update_favicon($replacedHeader, (string) $settings['favicon']);
        if (file_put_contents($fullPath, $replaced) === false) {
            $failed[] = $relativePath;
            continue;
        }
        $updated++;
    }

    if (!save_brand_settings($settings)) {
        $error = 'Saved to templates, but failed to persist brand settings file.';
    } elseif ($updated > 0) {
        $success = 'Brand, menu, and favicon updated on ' . $updated . ' page(s).';
    }

    if (count($failed) > 0) {
        $error = trim($error . ' Some pages failed to update: ' . implode(', ', $failed));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu, Logo & Favicon</title>
    <base href="<?php echo h(admin_url('/')); ?>" />
    <link rel="stylesheet" href="<?php echo h(admin_url('styles.css')); ?>" />
  </head>
  <body class="admin-body">
    <div class="admin-shell">
      <header class="admin-header">
        <div>
          <h1>Menu, Logo & Favicon</h1>
          <p>User-friendly global editor for branding and navigation.</p>
        </div>
        <div class="admin-actions">
          <a class="btn btn-outline" href="media.php" target="_blank">Media Library</a>
          <a class="btn" href="dashboard.php">Back</a>
        </div>
      </header>
      <?php render_admin_nav('menu'); ?>

      <?php if ($error !== ''): ?>
        <p class="error"><?php echo h($error); ?></p>
      <?php endif; ?>
      <?php if ($success !== ''): ?>
        <p class="success"><?php echo h($success); ?></p>
      <?php endif; ?>

      <form method="post" class="editor-form" id="brand-form">
        <section class="card">
          <h2>Branding</h2>
          <div class="brand-grid">
            <label>
              Logo Text
              <input type="text" name="logo_text" value="<?php echo h((string) $settings['logo_text']); ?>" />
            </label>
            <label>
              Logo Link URL
              <input type="text" name="logo_href" value="<?php echo h((string) $settings['logo_href']); ?>" placeholder="/" />
            </label>
            <label>
              Logo Icon Class
              <input type="text" name="logo_icon_class" value="<?php echo h((string) $settings['logo_icon_class']); ?>" placeholder="fa-solid fa-leaf" />
            </label>
            <label>
              Phone Text
              <input type="text" name="phone_text" value="<?php echo h((string) $settings['phone_text']); ?>" />
            </label>
            <label>
              Phone Link
              <input type="text" name="phone_href" value="<?php echo h((string) $settings['phone_href']); ?>" placeholder="tel:+11805678990" />
            </label>
            <label>
              CTA Text
              <input type="text" name="quote_text" value="<?php echo h((string) $settings['quote_text']); ?>" />
            </label>
            <label>
              CTA Link
              <input type="text" name="quote_href" value="<?php echo h((string) $settings['quote_href']); ?>" />
            </label>
          </div>

          <div class="brand-media-grid">
            <div>
              <label>
                Logo Image URL (optional)
                <input type="text" id="logo-image-input" name="logo_image" value="<?php echo h((string) $settings['logo_image']); ?>" placeholder="/assets/uploads/logo.png" />
              </label>
              <div class="admin-actions">
                <button type="button" class="btn btn-outline btn-small upload-brand" data-target="logo-image-input">Upload Logo</button>
              </div>
              <div class="brand-preview" id="logo-preview">
                <?php if (trim((string) $settings['logo_image']) !== ''): ?>
                  <img src="<?php echo h((string) $settings['logo_image']); ?>" alt="Logo preview" />
                <?php else: ?>
                  <span>No logo image selected</span>
                <?php endif; ?>
              </div>
            </div>
            <div>
              <label>
                Favicon URL
                <input type="text" id="favicon-input" name="favicon" value="<?php echo h((string) $settings['favicon']); ?>" placeholder="/assets/uploads/favicon.png" />
              </label>
              <div class="admin-actions">
                <button type="button" class="btn btn-outline btn-small upload-brand" data-target="favicon-input">Upload Favicon</button>
              </div>
              <div class="favicon-preview-wrap">
                <div class="favicon-preview" id="favicon-preview">
                  <?php if (trim((string) $settings['favicon']) !== ''): ?>
                    <img src="<?php echo h((string) $settings['favicon']); ?>" alt="Favicon preview" />
                  <?php else: ?>
                    <span>F</span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="card">
          <h2>Top Menu Links</h2>
          <p class="editor-hint">These appear as plain links after dropdown groups.</p>
          <div id="top-links-wrap" class="link-rows">
            <?php foreach ((array) $settings['top_links'] as $idx => $link): ?>
              <div class="link-row">
                <input type="text" name="top_links[<?php echo h((string) $idx); ?>][label]" value="<?php echo h((string) ($link['label'] ?? '')); ?>" placeholder="Label" />
                <input type="text" name="top_links[<?php echo h((string) $idx); ?>][url]" value="<?php echo h((string) ($link['url'] ?? '')); ?>" placeholder="/path" />
                <button type="button" class="btn btn-outline btn-small remove-row">Remove</button>
              </div>
            <?php endforeach; ?>
          </div>
          <button type="button" class="btn btn-outline btn-small" id="add-top-link">Add Top Link</button>
        </section>

        <section class="card">
          <h2>Dropdown Menu Groups</h2>
          <p class="editor-hint">Each group appears in desktop nav and mobile menu sections.</p>
          <div id="groups-wrap" class="group-grid">
            <?php foreach ((array) $settings['groups'] as $gIdx => $group): ?>
              <article class="menu-group-card">
                <label>
                  Group Label
                  <input type="text" name="groups[<?php echo h((string) $gIdx); ?>][label]" value="<?php echo h((string) ($group['label'] ?? '')); ?>" />
                </label>
                <div class="link-rows">
                  <?php foreach ((array) ($group['items'] ?? []) as $iIdx => $item): ?>
                    <div class="link-row">
                      <input type="text" name="groups[<?php echo h((string) $gIdx); ?>][items][<?php echo h((string) $iIdx); ?>][label]" value="<?php echo h((string) ($item['label'] ?? '')); ?>" placeholder="Item label" />
                      <input type="text" name="groups[<?php echo h((string) $gIdx); ?>][items][<?php echo h((string) $iIdx); ?>][url]" value="<?php echo h((string) ($item['url'] ?? '')); ?>" placeholder="/path" />
                      <button type="button" class="btn btn-outline btn-small remove-row">Remove</button>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div class="admin-actions">
                  <button type="button" class="btn btn-outline btn-small add-group-item">Add Item</button>
                  <button type="button" class="btn btn-outline btn-small remove-group">Remove Group</button>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
          <button type="button" class="btn btn-outline btn-small" id="add-group">Add Menu Group</button>
        </section>

        <input id="brand-upload" type="file" accept="image/*" class="editor-hidden" />
        <div class="editor-footer-actions">
          <button type="submit" class="btn">Save Brand & Menu</button>
        </div>
      </form>
    </div>

    <script>
      const uploadInput = document.getElementById('brand-upload');
      let uploadTarget = null;

      const topWrap = document.getElementById('top-links-wrap');
      const groupsWrap = document.getElementById('groups-wrap');

      const nextId = () => Date.now().toString() + Math.floor(Math.random() * 1000).toString();

      const newTopRow = () => {
        const id = nextId();
        return `
          <div class="link-row">
            <input type="text" name="top_links[${id}][label]" placeholder="Label" />
            <input type="text" name="top_links[${id}][url]" placeholder="/path" />
            <button type="button" class="btn btn-outline btn-small remove-row">Remove</button>
          </div>
        `;
      };

      const newGroupItemRow = (groupId) => {
        const itemId = nextId();
        return `
          <div class="link-row">
            <input type="text" name="groups[${groupId}][items][${itemId}][label]" placeholder="Item label" />
            <input type="text" name="groups[${groupId}][items][${itemId}][url]" placeholder="/path" />
            <button type="button" class="btn btn-outline btn-small remove-row">Remove</button>
          </div>
        `;
      };

      const newGroupCard = () => {
        const groupId = nextId();
        return `
          <article class="menu-group-card">
            <label>
              Group Label
              <input type="text" name="groups[${groupId}][label]" placeholder="Group name" />
            </label>
            <div class="link-rows">
              ${newGroupItemRow(groupId)}
            </div>
            <div class="admin-actions">
              <button type="button" class="btn btn-outline btn-small add-group-item">Add Item</button>
              <button type="button" class="btn btn-outline btn-small remove-group">Remove Group</button>
            </div>
          </article>
        `;
      };

      document.getElementById('add-top-link').addEventListener('click', () => {
        topWrap.insertAdjacentHTML('beforeend', newTopRow());
      });

      document.getElementById('add-group').addEventListener('click', () => {
        groupsWrap.insertAdjacentHTML('beforeend', newGroupCard());
      });

      document.addEventListener('click', (event) => {
        const removeRow = event.target.closest('.remove-row');
        if (removeRow) {
          removeRow.closest('.link-row')?.remove();
        }

        const addItem = event.target.closest('.add-group-item');
        if (addItem) {
          const card = addItem.closest('.menu-group-card');
          const groupLabel = card?.querySelector('input[name^="groups["][name$="[label]"]');
          if (!card || !groupLabel) return;
          const name = groupLabel.getAttribute('name') || '';
          const match = name.match(/^groups\[(.+?)\]\[label\]$/);
          if (!match) return;
          const groupId = match[1];
          const rows = card.querySelector('.link-rows');
          rows?.insertAdjacentHTML('beforeend', newGroupItemRow(groupId));
        }

        const removeGroup = event.target.closest('.remove-group');
        if (removeGroup) {
          removeGroup.closest('.menu-group-card')?.remove();
        }
      });

      const updateLogoPreview = () => {
        const input = document.getElementById('logo-image-input');
        const preview = document.getElementById('logo-preview');
        if (!input || !preview) return;
        const url = input.value.trim();
        preview.innerHTML = url ? `<img src="${url}" alt="Logo preview" />` : '<span>No logo image selected</span>';
      };

      const updateFaviconPreview = () => {
        const input = document.getElementById('favicon-input');
        const preview = document.getElementById('favicon-preview');
        if (!input || !preview) return;
        const url = input.value.trim();
        preview.innerHTML = url ? `<img src="${url}" alt="Favicon preview" />` : '<span>F</span>';
      };

      document.getElementById('logo-image-input')?.addEventListener('input', updateLogoPreview);
      document.getElementById('favicon-input')?.addEventListener('input', updateFaviconPreview);

      document.querySelectorAll('.upload-brand').forEach((btn) => {
        btn.addEventListener('click', () => {
          uploadTarget = btn.getAttribute('data-target');
          uploadInput.click();
        });
      });

      uploadInput.addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file || !uploadTarget) return;

        const targetInput = document.getElementById(uploadTarget);
        if (!targetInput) return;

        const formData = new FormData();
        formData.append('image', file);

        try {
          const response = await fetch('<?php echo h(admin_url('upload.php')); ?>', {
            method: 'POST',
            body: formData,
          });
          const result = await response.json();
          if (result.success) {
            targetInput.value = '/' + result.path.replace(/^\/+/, '');
            updateLogoPreview();
            updateFaviconPreview();
          } else {
            alert(result.error || 'Upload failed.');
          }
        } catch (err) {
          alert('Upload failed.');
        } finally {
          event.target.value = '';
          uploadTarget = null;
        }
      });
    </script>
  </body>
</html>
