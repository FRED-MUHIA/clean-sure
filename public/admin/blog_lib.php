<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

const BLOGS_FILE = PUBLIC_ROOT . '/data/blogs.json';

function load_blogs(): array
{
    if (!file_exists(BLOGS_FILE)) {
        return [];
    }
    $json = file_get_contents(BLOGS_FILE);
    if ($json === false) {
        return [];
    }
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function save_blogs(array $blogs): bool
{
    $json = json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        return false;
    }
    return file_put_contents(BLOGS_FILE, $json) !== false;
}

function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    return $text !== '' ? $text : ('post-' . time());
}

function find_blog(array $blogs, string $id): ?array
{
    foreach ($blogs as $blog) {
        if (($blog['id'] ?? '') === $id) {
            return $blog;
        }
    }
    return null;
}
