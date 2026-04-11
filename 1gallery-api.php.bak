<?php
/**
 * Gallery API — Colonel's Sainik Vidyalaya
 * File: gallery-api.php  (place in website ROOT, same folder as index.html)
 *
 * Returns active gallery images as JSON for the public gallery page.
 * Called by main.js → loadGalleryFromDB()
 *
 * GET gallery-api.php              → all active images
 * GET gallery-api.php?cat=Sports   → filter by category
 * GET gallery-api.php?limit=100    → limit results (default 500)
 */

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

$configPath = __DIR__ . '/admin/includes/config.php';

if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode(['success'=>false,'message'=>'Config not found at admin/includes/config.php']);
    exit;
}

require_once $configPath;

try {
    $pdo   = getDB();
    $cat   = trim($_GET['cat']   ?? '');
    $limit = min((int)($_GET['limit'] ?? 500), 500);

    $where  = 'is_active = 1';
    $params = [];
    if ($cat && $cat !== 'all') { $where .= ' AND category = ?'; $params[] = $cat; }

    $stmt = $pdo->prepare("
        SELECT id, filename, original_name, caption, description,
               category, sort_order, file_size, uploaded_at
        FROM gallery_images
        WHERE {$where}
        ORDER BY sort_order ASC, id DESC
        LIMIT {$limit}
    ");
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $uploadUrl = defined('UPLOAD_URL') ? rtrim(UPLOAD_URL,'/') . '/' : '/uploads/gallery/';
    $uploadDir = defined('UPLOAD_DIR') ? UPLOAD_DIR : ($_SERVER['DOCUMENT_ROOT'].'/uploads/gallery/');

    $images = array_map(function($row) use ($uploadUrl, $uploadDir) {
        $f = $row['filename'];
        $hasThumb = file_exists($uploadDir . 'thumbs/' . $f);
        return [
            'id'          => (int)$row['id'],
            'url'         => $uploadUrl . $f,
            'thumb'       => $hasThumb ? $uploadUrl.'thumbs/'.$f : $uploadUrl.$f,
            'caption'     => $row['caption'] ?: pathinfo($row['original_name'], PATHINFO_FILENAME),
            'description' => $row['description'] ?? '',
            'category'    => $row['category'],
            'sort_order'  => (int)$row['sort_order'],
            'uploaded_at' => $row['uploaded_at'],
        ];
    }, $rows);

    $cats = $pdo->query("
        SELECT category, COUNT(*) AS cnt FROM gallery_images
        WHERE is_active=1 GROUP BY category ORDER BY cnt DESC
    ")->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success'=>true,'total'=>count($images),'images'=>$images,'categories'=>$cats], JSON_UNESCAPED_UNICODE);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success'=>false,'message'=>'DB error: '.$e->getMessage()]);
}
