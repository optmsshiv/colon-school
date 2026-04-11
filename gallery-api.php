<?php
/**
 * Gallery API — Colonel's Sainik Vidyalaya
 * Public endpoint: returns active gallery images as JSON.
 * Place this file in your website root (same level as index.html).
 *
 * Usage:
 *   GET gallery-api.php           → all active images
 *   GET gallery-api.php?cat=Sports → filter by category
 *
 * This is called by main.js → loadGalleryFromDB()
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// ── Config ─────────────────────────────────────────────────────────
// Adjust path to your admin config file.
// Typical structure: /public_html/index.html  → /public_html/admin/includes/config.php
$configPath = __DIR__ . '/admin/includes/config.php';

if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Config not found at: ' . $configPath]);
    exit;
}

require_once $configPath;

try {
    $pdo = getDB();

    $cat    = trim($_GET['cat'] ?? '');
    $limit  = min((int)($_GET['limit'] ?? 500), 500); // max 500

    $where  = 'is_active = 1';
    $params = [];

    if ($cat && $cat !== 'all') {
        $where  .= ' AND category = ?';
        $params[] = $cat;
    }

    $sql = "SELECT
                id,
                filename,
                original_name,
                caption,
                description,
                category,
                sort_order,
                file_size,
                uploaded_at
            FROM gallery_images
            WHERE $where
            ORDER BY sort_order ASC, id DESC
            LIMIT $limit";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Build image URLs
    $uploadUrl = defined('UPLOAD_URL') ? UPLOAD_URL : '/uploads/gallery/';
    $uploadDir = defined('UPLOAD_DIR') ? UPLOAD_DIR : ($_SERVER['DOCUMENT_ROOT'] . '/uploads/gallery/');

    $images = array_map(function($row) use ($uploadUrl, $uploadDir) {
        $thumb = $uploadUrl . 'thumbs/' . $row['filename'];
        $full  = $uploadUrl . $row['filename'];
        // Check if thumb physically exists; fall back to full if not
        $hasThumb = file_exists($uploadDir . 'thumbs/' . $row['filename']);
        return [
            'id'           => (int)$row['id'],
            'url'          => $full,
            'thumb'        => $hasThumb ? $thumb : $full,
            'caption'      => $row['caption'] ?: $row['original_name'],
            'description'  => $row['description'] ?? '',
            'category'     => $row['category'],
            'sort_order'   => (int)$row['sort_order'],
            'uploaded_at'  => $row['uploaded_at'],
        ];
    }, $rows);

    // Category counts
    $catStmt = $pdo->query("SELECT category, COUNT(*) as cnt FROM gallery_images WHERE is_active=1 GROUP BY category ORDER BY cnt DESC");
    $categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success'    => true,
        'total'      => count($images),
        'images'     => $images,
        'categories' => $categories,
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
