<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

session_start();

function is_logged_in(): bool
{
    return isset($_SESSION['admin_user']) && $_SESSION['admin_user'] === ADMIN_USER;
}

function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: ' . admin_url('index.php'));
        exit;
    }
}

function try_login(string $username, string $password): bool
{
    if ($username !== ADMIN_USER) {
        return false;
    }

    if (!password_verify($password, ADMIN_PASS_HASH)) {
        return false;
    }

    $_SESSION['admin_user'] = ADMIN_USER;
    return true;
}

function logout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}
