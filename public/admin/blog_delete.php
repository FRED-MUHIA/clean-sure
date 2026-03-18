<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/blog_lib.php';

require_login();

$id = $_GET['id'] ?? '';
if ($id === '') {
    header('Location: ' . admin_url('blogs.php'));
    exit;
}

$blogs = load_blogs();
$blogs = array_values(array_filter($blogs, fn($blog) => ($blog['id'] ?? '') !== $id));
save_blogs($blogs);

header('Location: ' . admin_url('blogs.php'));
exit;
