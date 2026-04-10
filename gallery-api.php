<?php
/**
 * Public Gallery API — Colonel's Sainik Vidyalaya
 * File: gallery-api.php  (place in site root, same level as index.html)
 *
 * Returns active gallery images as JSON for the public website.
 * The frontend's main.js calls this to load real gallery data from DB.
 *
 * Usage: fetch('/gallery-api.php')  or  fetch('/gallery-api.php?cat=Sports')
 */

require_once __DIR__ . '/admin/includes/config.php';

header('Content-Type: application/json');
header('Cache-Control: public, max-age=300'); // 5 min cache

$pdo    = getDB();
$cat    = trim($_GET['cat'] ?? '');
$limit  = min(200, max(1, (int)($_GET['limit'] ?? 200)));

$where  = 'is_active = 1';
$params = [];
if ($cat) {
    $where .= ' AND category = ?';
    $params[] = $cat;
}

$stmt = $pdo->prepare("
    SELECT id, filename, original_name, caption, category, sort_order, uploaded_at
    FROM gallery_images
    WHERE $where
    ORDER BY sort_order ASC, id DESC
    LIMIT $limit
");
$stmt->execute($params);
$rows = $stmt->fetchAll();

$baseUrl = '/admin/uploads/gallery/';

$images = array_map(function($row) use ($baseUrl) {
    $thumbFile = 'thumbs/' . $row['filename'];
    $thumbExists = file_exists(UPLOAD_DIR . $thumbFile);
    return [
        'id'        => (int)$row['id'],
        'url'       => $baseUrl . $row['filename'],
        'thumb'     => $thumbExists ? $baseUrl . $thumbFile : $baseUrl . $row['filename'],
        'caption'   => $row['caption'] ?: $row['original_name'],
        'cat'       => $row['category'],
        'date'      => $row['uploaded_at'],
    ];
}, $rows);

echo json_encode([
    'success' => true,
    'count'   => count($images),
    'images'  => $images,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
