<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';

header('Content-Type: application/json');

if (!is_logged_in()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

if (!isset($_FILES['image'])) {
    echo json_encode(['success' => false, 'error' => 'No file uploaded']);
    exit;
}

$file = $_FILES['image'];
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'error' => 'Upload failed']);
    exit;
}

$imageInfo = getimagesize($file['tmp_name']);
if ($imageInfo === false) {
    echo json_encode(['success' => false, 'error' => 'Only image files are allowed']);
    exit;
}

$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
if (!in_array($ext, $allowed, true)) {
    echo json_encode(['success' => false, 'error' => 'Unsupported file type']);
    exit;
}

$safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME));
$fileName = $safeName . '_' . time() . '.' . $ext;
$targetPath = UPLOAD_DIR . '/' . $fileName;

if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    echo json_encode(['success' => false, 'error' => 'Failed to save file']);
    exit;
}

echo json_encode([
    'success' => true,
    'path' => UPLOAD_URL . '/' . $fileName,
]);
