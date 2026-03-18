<?php
declare(strict_types=1);

// Basic config for admin dashboard.
const ADMIN_USER = 'Director';
// Password: 12345678
const ADMIN_PASS_HASH = '$2y$10$TCcR0XmC5N/9/kBSRQYCUe8HcX27760jFbRYl.3ebaQiZAX0Dklq6';

// Project root: <project>/public/admin -> go up two levels.
const SITE_ROOT = __DIR__ . '/../..';
const PUBLIC_ROOT = SITE_ROOT . '/public';
const ADMIN_BASE_URL = '/admin';

const UPLOAD_DIR = PUBLIC_ROOT . '/assets/uploads';
const UPLOAD_URL = 'assets/uploads';

function admin_url(string $path = ''): string
{
    $base = rtrim(ADMIN_BASE_URL, '/');
    if ($path === '' || $path === '/') {
        return $base . '/';
    }

    return $base . '/' . ltrim($path, '/');
}
