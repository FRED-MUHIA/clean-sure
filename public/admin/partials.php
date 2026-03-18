<?php
declare(strict_types=1);

if (!function_exists('admin_nav_items')) {
    /**
     * @return array<string, array{label:string, href:string}>
     */
    function admin_nav_items(): array
    {
        return [
            'dashboard' => ['label' => 'Dashboard', 'href' => admin_url('dashboard.php')],
            'pages' => ['label' => 'Page Editor', 'href' => admin_url('dashboard.php#page-editor')],
            'menu' => ['label' => 'Menu & Logo', 'href' => admin_url('header_edit.php')],
            'backgrounds' => ['label' => 'Backgrounds', 'href' => admin_url('background_edit.php')],
            'blogs' => ['label' => 'Blog', 'href' => admin_url('blogs.php')],
            'media' => ['label' => 'Media', 'href' => admin_url('media.php')],
        ];
    }
}

if (!function_exists('render_admin_nav')) {
    function render_admin_nav(string $activeKey = ''): void
    {
        $items = admin_nav_items();
        echo '<nav class="admin-subnav" aria-label="Admin Sections">';
        foreach ($items as $key => $item) {
            $activeClass = $key === $activeKey ? ' is-active' : '';
            $label = htmlspecialchars($item['label'], ENT_QUOTES);
            $href = htmlspecialchars($item['href'], ENT_QUOTES);
            echo '<a class="admin-subnav-link' . $activeClass . '" href="' . $href . '">' . $label . '</a>';
        }
        echo '</nav>';
    }
}
