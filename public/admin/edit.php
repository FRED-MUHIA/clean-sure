<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/pages.php';
require_once __DIR__ . '/partials.php';

require_login();

$page = $_GET['page'] ?? '';
if (!isset(EDITABLE_PAGES[$page])) {
    header('Location: ' . admin_url('dashboard.php'));
    exit;
}

$filePath = SITE_ROOT . '/' . $page;
$pageMeta = EDITABLE_PAGES[$page];
$label = (string) ($pageMeta['label'] ?? $page);
$previewUrl = (string) ($pageMeta['preview'] ?? '/');
$lastModified = is_file($filePath) ? date('Y-m-d H:i', (int) filemtime($filePath)) : '-';
$error = '';
$success = '';
$content = '';
$headerHtml = '';
$footerHtml = '';
$sections = [];
$sectionTitles = [];
$parts = [];
$sectionIndexes = [];

$html = file_get_contents($filePath);
if ($html === false) {
    $error = 'Unable to read page file.';
} else {
    if (preg_match('/<header\\b[\\s\\S]*?<\\/header>/i', $html, $headerMatch)) {
        $headerHtml = $headerMatch[0];
    }
    if (preg_match('/<footer\\b[\\s\\S]*?<\\/footer>/i', $html, $footerMatch)) {
        $footerHtml = $footerMatch[0];
    }
    if (preg_match('/<main[^>]*>([\\s\\S]*?)<\\/main>/i', $html, $matches)) {
        $content = trim($matches[1]);
        if (preg_match_all('/<section\\b[\\s\\S]*?<\\/section>/i', $content, $sectionMatches)) {
            $parts = preg_split('/(<section\\b[\\s\\S]*?<\\/section>)/i', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
            foreach ($parts as $index => $part) {
                if (preg_match('/^<section\\b[\\s\\S]*<\\/section>$/i', $part)) {
                    $sections[] = $part;
                    $sectionIndexes[] = $index;
                    if (preg_match('/<h[1-3][^>]*>(.*?)<\\/h[1-3]>/i', $part, $titleMatch)) {
                        $sectionTitles[] = trim(strip_tags($titleMatch[1]));
                    } else {
                        $sectionTitles[] = 'Section ' . count($sections);
                    }
                }
            }
        }
    } else {
        $error = 'Main content area not found.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['content'] ?? '';
    $newHeader = $_POST['header'] ?? '';
    $newFooter = $_POST['footer'] ?? '';
    $afterSaveAction = trim((string) ($_POST['after_save_action'] ?? ''));
    $newContent = trim($newContent);

    if ($html !== false && preg_match('/<main[^>]*>([\\s\\S]*?)<\\/main>/i', $html)) {
        if (!empty($newHeader)) {
            $html = preg_replace('/<header\\b[\\s\\S]*?<\\/header>/i', $newHeader, $html, 1);
        }
        if (!empty($newFooter)) {
            $html = preg_replace('/<footer\\b[\\s\\S]*?<\\/footer>/i', $newFooter, $html, 1);
        }
        $updated = preg_replace_callback(
            '/(<main[^>]*>)([\\s\\S]*?)(<\\/main>)/i',
            fn($m) => $m[1] . PHP_EOL . $newContent . PHP_EOL . $m[3],
            $html,
            1
        );

        if ($updated !== null && file_put_contents($filePath, $updated) !== false) {
            $success = 'Page updated successfully.';
            $html = $updated;
            $content = $newContent;
            if ($afterSaveAction === 'preview') {
                header('Location: ' . $previewUrl);
                exit;
            }
        } else {
            $error = 'Failed to save changes.';
        }
    } else {
        $error = 'Main content area not found.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit <?php echo htmlspecialchars($label, ENT_QUOTES); ?></title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <base href="<?php echo htmlspecialchars(admin_url('/'), ENT_QUOTES); ?>" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars(admin_url('styles.css'), ENT_QUOTES); ?>" />
  </head>
  <body class="admin-body">
    <div class="admin-shell">
      <header class="admin-header">
        <div>
          <h1>Edit <?php echo htmlspecialchars($label, ENT_QUOTES); ?></h1>
          <p><?php echo htmlspecialchars($page, ENT_QUOTES); ?></p>
        </div>
        <div class="admin-actions">
          <a class="btn btn-outline" href="<?php echo htmlspecialchars($previewUrl, ENT_QUOTES); ?>" target="_blank">View Page</a>
          <a class="btn" href="dashboard.php">Back</a>
        </div>
      </header>
      <?php render_admin_nav('pages'); ?>

      <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
      <?php endif; ?>
      <?php if ($success): ?>
        <p class="success"><?php echo htmlspecialchars($success, ENT_QUOTES); ?></p>
      <?php endif; ?>

      <div class="editor-meta-bar">
        <span class="meta-pill"><strong>File:</strong> <?php echo htmlspecialchars($page, ENT_QUOTES); ?></span>
        <span class="meta-pill"><strong>Last Updated:</strong> <?php echo htmlspecialchars($lastModified, ENT_QUOTES); ?></span>
        <a class="btn btn-outline btn-small" href="media.php" target="_blank">Open Media Library</a>
      </div>

      <div id="draft-banner" class="draft-banner" hidden>
        <p>You have an unsaved local draft for this page.</p>
        <div class="draft-actions">
          <button type="button" class="btn btn-small" id="restore-draft">Restore Draft</button>
          <button type="button" class="btn btn-outline btn-small" id="discard-draft-banner">Discard</button>
        </div>
      </div>

      <form method="post" class="editor-form" id="editor-form">
        <input type="hidden" id="after-save-action" name="after_save_action" value="" />

        <label for="editor">Page Content Editor</label>
        <div class="editor-toolbar">
          <button type="button" data-cmd="bold"><strong>B</strong></button>
          <button type="button" data-cmd="italic"><em>I</em></button>
          <button type="button" data-cmd="underline"><span style="text-decoration:underline;">U</span></button>
          <button type="button" data-cmd="removeFormat">Clear</button>
          <button type="button" data-block="h1">H1</button>
          <button type="button" data-block="h2">H2</button>
          <button type="button" data-block="h3">H3</button>
          <button type="button" data-block="p">P</button>
          <button type="button" data-cmd="insertUnorderedList">• List</button>
          <button type="button" data-cmd="insertOrderedList">1. List</button>
          <button type="button" data-action="link">Link</button>
          <button type="button" data-action="image">Upload Image</button>
          <button type="button" data-action="icon">Icon</button>
          <button type="button" data-action="undo">Undo</button>
          <button type="button" data-action="redo">Redo</button>
        </div>

        <div class="editor-toolbar editor-toolbar-secondary">
          <div class="editor-view-controls">
            <span>Preview:</span>
            <button type="button" class="mode-tab is-active view-tab" data-view="desktop">Desktop</button>
            <button type="button" class="mode-tab view-tab" data-view="tablet">Tablet</button>
            <button type="button" class="mode-tab view-tab" data-view="mobile">Mobile</button>
          </div>
          <div class="editor-status">
            <span id="save-state" class="status-pill">Saved</span>
            <span id="word-count" class="status-pill">0 words</span>
          </div>
        </div>

        <p class="editor-hint">Shortcuts: Ctrl+S save, Ctrl+Z undo, Ctrl+Shift+Z redo. Click any image to replace it.</p>

        <div class="editor-modes">
          <button type="button" class="mode-tab is-active" data-mode="main">Main Sections</button>
          <button type="button" class="mode-tab" data-mode="header">Header</button>
          <button type="button" class="mode-tab" data-mode="footer">Footer</button>
        </div>

        <div class="quick-insert">
          <span>Quick Insert:</span>
          <button type="button" class="btn btn-outline btn-small" data-snippet="button">Button</button>
          <button type="button" class="btn btn-outline btn-small" data-snippet="cta">CTA Block</button>
          <button type="button" class="btn btn-outline btn-small" data-snippet="twoCols">Two Columns</button>
        </div>

        <div class="section-nav-bar" id="section-nav-bar">
          <div class="section-nav-meta">
            <strong id="section-title-indicator">Section 1</strong>
            <span id="section-position-indicator">1 / 1</span>
          </div>
          <div class="section-nav-actions">
            <button type="button" class="btn btn-outline btn-small" id="prev-section">Previous</button>
            <button type="button" class="btn btn-outline btn-small" id="next-section">Next</button>
          </div>
        </div>

        <?php if (count($sections) > 0): ?>
          <div class="section-editor" id="section-editor">
            <div class="section-list-wrap">
              <input type="search" id="section-search" class="section-search" placeholder="Find section..." />
              <div class="section-list" id="section-list">
                <?php foreach ($sectionTitles as $idx => $title): ?>
                  <button type="button" class="section-tab" data-index="<?php echo $idx; ?>" data-title="<?php echo htmlspecialchars(strtolower($title), ENT_QUOTES); ?>">
                    <?php echo htmlspecialchars($title, ENT_QUOTES); ?>
                  </button>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="section-canvas" id="section-canvas">
              <div id="editor" class="editor-surface" contenteditable="true"></div>
            </div>
          </div>
        <?php else: ?>
          <div class="section-editor is-single" id="section-editor">
            <div class="section-list-wrap">
              <input type="search" id="section-search" class="section-search" placeholder="Find section..." />
              <div class="section-list" id="section-list"></div>
            </div>
            <div class="section-canvas" id="section-canvas">
              <div id="editor" class="editor-surface" contenteditable="true"></div>
            </div>
          </div>
        <?php endif; ?>

        <textarea id="content" name="content" class="editor-hidden"></textarea>
        <textarea id="header" name="header" class="editor-hidden"></textarea>
        <textarea id="footer" name="footer" class="editor-hidden"></textarea>
        <input id="image-upload" type="file" accept="image/*" class="editor-hidden" />
        <input id="image-replace" type="file" accept="image/*" class="editor-hidden" />

        <div class="editor-footer-actions">
          <button type="submit" class="btn">Save Changes</button>
          <button type="button" class="btn btn-outline" id="save-preview">Save and Preview</button>
          <button type="button" class="btn btn-outline" id="discard-draft">Discard Local Draft</button>
        </div>
      </form>
    </div>
    <script>
      const editor = document.getElementById('editor');
      const form = document.getElementById('editor-form');
      const textarea = document.getElementById('content');
      const headerField = document.getElementById('header');
      const footerField = document.getElementById('footer');
      const afterSaveActionField = document.getElementById('after-save-action');
      const saveState = document.getElementById('save-state');
      const wordCount = document.getElementById('word-count');
      const sectionCanvas = document.getElementById('section-canvas');
      const sectionSearch = document.getElementById('section-search');
      const draftBanner = document.getElementById('draft-banner');
      const savePreviewBtn = document.getElementById('save-preview');
      const discardDraftBtn = document.getElementById('discard-draft');
      const restoreDraftBtn = document.getElementById('restore-draft');
      const discardDraftBannerBtn = document.getElementById('discard-draft-banner');
      const sectionNavBar = document.getElementById('section-nav-bar');
      const sectionTitleIndicator = document.getElementById('section-title-indicator');
      const sectionPositionIndicator = document.getElementById('section-position-indicator');
      const prevSectionBtn = document.getElementById('prev-section');
      const nextSectionBtn = document.getElementById('next-section');

      const sections = <?php echo json_encode($sections, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
      const parts = <?php echo json_encode($parts, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
      const sectionIndexes = <?php echo json_encode($sectionIndexes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
      const initialContent = <?php echo json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
      const pageId = <?php echo json_encode($page, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
      const saveSucceeded = <?php echo $success !== '' ? 'true' : 'false'; ?>;

      let headerHtml = <?php echo json_encode($headerHtml, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
      let footerHtml = <?php echo json_encode($footerHtml, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
      let activeIndex = 0;
      let activeMode = 'main';
      let isDirty = false;
      let draftTimer = null;
      let pendingDraft = null;

      const basePath = window.location.pathname.replace(/\/admin\/.*$/, '/');
      const sectionEditor = document.getElementById('section-editor');
      const sectionTabs = Array.from(document.querySelectorAll('.section-tab'));
      const modeTabs = Array.from(document.querySelectorAll('.mode-tab[data-mode]'));
      const viewTabs = Array.from(document.querySelectorAll('.view-tab'));
      const draftKey = `page-editor-draft:${pageId}`;

      const snippets = {
        button: '<p><a href="#" class="btn btn-primary">Call to Action</a></p>',
        cta: '<section class="cta-inline"><h2>Your Heading</h2><p>Short supporting text goes here.</p><a href="#" class="btn btn-primary">Learn More</a></section>',
        twoCols: '<div class="editor-two-cols"><div><h3>Column One</h3><p>Add your content here.</p></div><div><h3>Column Two</h3><p>Add your content here.</p></div></div>',
      };

      const setStatus = (label, tone = 'ok') => {
        if (!saveState) return;
        saveState.textContent = label;
        saveState.dataset.tone = tone;
      };

      const updateWordCount = () => {
        if (!wordCount) return;
        const text = (editor.textContent || '').trim();
        const words = text === '' ? 0 : text.split(/\s+/).length;
        wordCount.textContent = `${words} words`;
      };

      const resolveSourcePath = (src) => {
        const value = (src || '').trim();
        const bladeMatch = value.match(/^\{\{\s*asset\((['"])([^'"]+)\1\)\s*\}\}$/);
        if (bladeMatch) {
          return bladeMatch[2];
        }
        return value;
      };

      const normalizeImageSources = () => {
        editor.querySelectorAll('img').forEach((img) => {
          const src = resolveSourcePath(img.getAttribute('src') || '');
          if (src.startsWith('/assets/')) {
            const clean = src.replace(/^\/+/, '');
            img.dataset.srcOriginal = clean;
            img.src = basePath + clean;
          } else if (src.startsWith('assets/')) {
            img.dataset.srcOriginal = src;
            img.src = basePath + src;
          } else if (src.startsWith('./assets/')) {
            const clean = src.replace('./', '');
            img.dataset.srcOriginal = clean;
            img.src = basePath + clean;
          } else if (src.startsWith(basePath + 'assets/')) {
            img.dataset.srcOriginal = src.replace(basePath, '');
          }
        });
      };

      const setEditorContent = (html) => {
        editor.innerHTML = html || '';
        normalizeImageSources();
        updateWordCount();
      };

      const storeActiveBuffer = () => {
        if (activeMode === 'header') {
          headerHtml = editor.innerHTML;
        } else if (activeMode === 'footer') {
          footerHtml = editor.innerHTML;
        } else if (sections.length) {
          sections[activeIndex] = editor.innerHTML;
        } else {
          sections[0] = editor.innerHTML;
        }
      };

      const setActiveSection = (index) => {
        if (!Number.isInteger(index) || index < 0 || index >= sections.length) return;
        storeActiveBuffer();
        activeIndex = index;
        sectionTabs.forEach((tab) => tab.classList.toggle('is-active', Number(tab.dataset.index) === index));
        setEditorContent(sections[index] || '');
        refreshSectionNav();
      };

      const refreshSectionNav = () => {
        if (!sectionNavBar || !sectionTitleIndicator || !sectionPositionIndicator) return;
        const isMain = activeMode === 'main';
        if (!isMain || sectionTabs.length === 0) {
          sectionNavBar.hidden = true;
          return;
        }

        const activeTab = sectionTabs.find((tab) => Number(tab.dataset.index) === activeIndex) || null;
        sectionTitleIndicator.textContent = activeTab ? activeTab.textContent.trim() : `Section ${activeIndex + 1}`;
        sectionPositionIndicator.textContent = `${activeIndex + 1} / ${sectionTabs.length}`;
        sectionNavBar.hidden = false;

        if (prevSectionBtn) {
          prevSectionBtn.disabled = activeIndex <= 0;
        }
        if (nextSectionBtn) {
          nextSectionBtn.disabled = activeIndex >= sectionTabs.length - 1;
        }
      };

      const setMode = (mode) => {
        storeActiveBuffer();
        activeMode = mode;
        editor.setAttribute('data-mode', mode);
        modeTabs.forEach((btn) => btn.classList.toggle('is-active', btn.dataset.mode === mode));

        if (mode === 'main') {
          sectionEditor.classList.remove('is-single');
          if (sectionTabs.length === 0) {
            sectionEditor.classList.add('is-single');
            setEditorContent(sections[0] || '');
            if (sectionNavBar) sectionNavBar.hidden = true;
          } else {
            setEditorContent(sections[activeIndex] || '');
            refreshSectionNav();
          }
        } else {
          sectionEditor.classList.add('is-single');
          setEditorContent(mode === 'header' ? headerHtml : footerHtml);
          if (sectionNavBar) sectionNavBar.hidden = true;
        }
      };

      const serializeForSubmit = () => {
        storeActiveBuffer();

        editor.querySelectorAll('img').forEach((img) => {
          if (img.dataset.srcOriginal) {
            img.setAttribute('src', '/' + img.dataset.srcOriginal.replace(/^\/+/, ''));
          } else if (img.src.startsWith(basePath)) {
            img.setAttribute('src', '/' + img.src.replace(basePath, '').replace(/^\/+/, ''));
          }
        });

        if (sections.length) {
          sectionIndexes.forEach((partIndex, i) => {
            parts[partIndex] = sections[i];
          });
          textarea.value = parts.join('');
        } else {
          textarea.value = editor.innerHTML;
        }

        headerField.value = headerHtml;
        footerField.value = footerHtml;
      };

      const makeDraftPayload = () => ({
        mode: activeMode,
        activeIndex,
        sections,
        headerHtml,
        footerHtml,
        updatedAt: Date.now(),
      });

      const saveDraftNow = () => {
        try {
          storeActiveBuffer();
          localStorage.setItem(draftKey, JSON.stringify(makeDraftPayload()));
          if (isDirty) {
            setStatus('Draft saved locally', 'warn');
          }
        } catch (err) {
          // Ignore storage errors in private mode / quotas.
        }
      };

      const scheduleDraftSave = () => {
        if (draftTimer) {
          clearTimeout(draftTimer);
        }
        draftTimer = setTimeout(saveDraftNow, 500);
      };

      const markDirty = () => {
        isDirty = true;
        setStatus('Unsaved changes', 'warn');
        scheduleDraftSave();
      };

      const clearDraft = () => {
        localStorage.removeItem(draftKey);
        pendingDraft = null;
        if (draftBanner) {
          draftBanner.hidden = true;
        }
      };

      const restoreDraft = (draft) => {
        if (!draft || typeof draft !== 'object') return;
        if (Array.isArray(draft.sections) && draft.sections.length > 0) {
          sections.splice(0, sections.length, ...draft.sections);
        }
        if (typeof draft.headerHtml === 'string') {
          headerHtml = draft.headerHtml;
        }
        if (typeof draft.footerHtml === 'string') {
          footerHtml = draft.footerHtml;
        }
        if (Number.isInteger(draft.activeIndex)) {
          activeIndex = Math.max(0, Math.min(draft.activeIndex, Math.max(0, sections.length - 1)));
        }
        if (draft.mode === 'header' || draft.mode === 'footer') {
          setMode(draft.mode);
        } else {
          setMode('main');
          if (sectionTabs.length > 0) {
            setActiveSection(activeIndex);
          }
        }
        markDirty();
      };

      const applyCommand = (cmd, value = null) => {
        document.execCommand(cmd, false, value);
        editor.focus();
        markDirty();
      };

      if (sections.length === 0) {
        sections[0] = initialContent || '';
      }

      setEditorContent(sections[0] || '');
      editor.setAttribute('data-mode', 'main');
      sectionTabs[0]?.classList.add('is-active');
      updateWordCount();

      sectionTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
          setActiveSection(Number(tab.dataset.index));
        });
      });

      modeTabs.forEach((btn) => {
        btn.addEventListener('click', () => setMode(btn.dataset.mode));
      });

      viewTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
          const view = tab.dataset.view || 'desktop';
          sectionCanvas.dataset.view = view;
          viewTabs.forEach((btn) => btn.classList.toggle('is-active', btn === tab));
        });
      });

      if (sectionSearch) {
        sectionSearch.addEventListener('input', () => {
          const query = sectionSearch.value.trim().toLowerCase();
          sectionTabs.forEach((tab) => {
            const title = tab.dataset.title || '';
            tab.hidden = query !== '' && !title.includes(query);
          });
        });
      }

      if (prevSectionBtn) {
        prevSectionBtn.addEventListener('click', () => {
          if (activeIndex > 0) {
            setActiveSection(activeIndex - 1);
          }
        });
      }

      if (nextSectionBtn) {
        nextSectionBtn.addEventListener('click', () => {
          if (activeIndex < sections.length - 1) {
            setActiveSection(activeIndex + 1);
          }
        });
      }

      document.querySelectorAll('.editor-toolbar [data-cmd]').forEach((btn) => {
        btn.addEventListener('click', () => applyCommand(btn.dataset.cmd));
      });

      document.querySelectorAll('.editor-toolbar [data-block]').forEach((btn) => {
        btn.addEventListener('click', () => applyCommand('formatBlock', btn.dataset.block));
      });

      document.querySelectorAll('.editor-toolbar [data-action="link"]').forEach((btn) => {
        btn.addEventListener('click', () => {
          const url = prompt('Enter link URL');
          if (url) {
            applyCommand('createLink', url);
          }
        });
      });

      document.querySelectorAll('.editor-toolbar [data-action="undo"]').forEach((btn) => {
        btn.addEventListener('click', () => applyCommand('undo'));
      });

      document.querySelectorAll('.editor-toolbar [data-action="redo"]').forEach((btn) => {
        btn.addEventListener('click', () => applyCommand('redo'));
      });

      document.querySelectorAll('.editor-toolbar [data-action="image"]').forEach((btn) => {
        btn.addEventListener('click', () => {
          document.getElementById('image-upload').click();
        });
      });

      document.querySelectorAll('[data-snippet]').forEach((btn) => {
        btn.addEventListener('click', () => {
          const key = btn.getAttribute('data-snippet') || '';
          const html = snippets[key];
          if (!html) return;
          applyCommand('insertHTML', html);
        });
      });

      document.getElementById('image-upload').addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('image', file);

        try {
          const response = await fetch('<?php echo htmlspecialchars(admin_url('upload.php'), ENT_QUOTES); ?>', {
            method: 'POST',
            body: formData,
          });
          const result = await response.json();
          if (result.success) {
            const displayPath = basePath + result.path;
            applyCommand('insertImage', displayPath);
            const imgs = editor.querySelectorAll('img');
            const inserted = imgs[imgs.length - 1];
            if (inserted) {
              inserted.dataset.srcOriginal = result.path;
              inserted.classList.add('uploaded-image');
            }
          } else {
            alert(result.error || 'Upload failed.');
          }
        } catch (err) {
          alert('Upload failed.');
        } finally {
          event.target.value = '';
        }
      });

      let activeImage = null;
      editor.addEventListener('click', (event) => {
        if (event.target && event.target.tagName === 'IMG') {
          activeImage = event.target;
          document.getElementById('image-replace').click();
        }
      });

      document.getElementById('image-replace').addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file || !activeImage) return;

        const formData = new FormData();
        formData.append('image', file);

        try {
          const response = await fetch('<?php echo htmlspecialchars(admin_url('upload.php'), ENT_QUOTES); ?>', {
            method: 'POST',
            body: formData,
          });
          const result = await response.json();
          if (result.success) {
            activeImage.setAttribute('src', basePath + result.path);
            activeImage.dataset.srcOriginal = result.path;
            markDirty();
          } else {
            alert(result.error || 'Upload failed.');
          }
        } catch (err) {
          alert('Upload failed.');
        } finally {
          event.target.value = '';
          activeImage = null;
        }
      });

      const updateIconAtSelection = (className) => {
        const selection = window.getSelection();
        if (!selection || selection.rangeCount === 0) return false;
        const range = selection.getRangeAt(0);
        let node = range.startContainer;
        if (node.nodeType === 3) node = node.parentElement;
        const iconEl = node ? node.closest('i') : null;
        if (iconEl && editor.contains(iconEl)) {
          iconEl.className = className;
          return true;
        }
        return false;
      };

      document.querySelectorAll('.editor-toolbar [data-action="icon"]').forEach((btn) => {
        btn.addEventListener('click', () => {
          const className = prompt('Enter Font Awesome classes (e.g. fa-solid fa-leaf)', 'fa-solid fa-leaf');
          if (!className) return;
          if (!updateIconAtSelection(className)) {
            applyCommand('insertHTML', `<i class="${className}"></i>`);
          } else {
            markDirty();
          }
        });
      });

      editor.addEventListener('input', () => {
        updateWordCount();
        markDirty();
      });

      editor.addEventListener('keydown', (event) => {
        if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 's') {
          event.preventDefault();
          form.requestSubmit();
          return;
        }
        if ((event.ctrlKey || event.metaKey) && event.shiftKey && event.key.toLowerCase() === 'z') {
          event.preventDefault();
          applyCommand('redo');
        }
      });

      if (savePreviewBtn) {
        savePreviewBtn.addEventListener('click', () => {
          afterSaveActionField.value = 'preview';
          form.requestSubmit();
        });
      }

      if (discardDraftBtn) {
        discardDraftBtn.addEventListener('click', () => {
          clearDraft();
          setStatus('Local draft discarded', 'ok');
        });
      }

      if (restoreDraftBtn) {
        restoreDraftBtn.addEventListener('click', () => {
          if (!pendingDraft) return;
          restoreDraft(pendingDraft);
          if (draftBanner) draftBanner.hidden = true;
          setStatus('Draft restored', 'warn');
        });
      }

      if (discardDraftBannerBtn) {
        discardDraftBannerBtn.addEventListener('click', () => {
          clearDraft();
          setStatus('Local draft discarded', 'ok');
        });
      }

      form.addEventListener('submit', () => {
        serializeForSubmit();
        setStatus('Saving...', 'saving');
        clearDraft();
      });

      const rawDraft = localStorage.getItem(draftKey);
      if (rawDraft && !saveSucceeded) {
        try {
          pendingDraft = JSON.parse(rawDraft);
        } catch (err) {
          pendingDraft = null;
        }
      }

      if (pendingDraft && draftBanner) {
        draftBanner.hidden = false;
      }

      refreshSectionNav();

      if (saveSucceeded) {
        clearDraft();
        setStatus('Saved', 'ok');
        isDirty = false;
      }

      window.addEventListener('beforeunload', (event) => {
        if (!isDirty) return;
        event.preventDefault();
        event.returnValue = '';
      });
    </script>
  </body>
</html>
