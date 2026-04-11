<?php
/**
 * Gallery Actions Handler (AJAX) — Colonel's Sainik Vidyalaya
 * File: admin/actions.php
 * All actions return JSON
 */
require_once __DIR__ . '/includes/config.php';
requireLogin();

header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$action = trim($_POST['action'] ?? '');
$pdo    = getDB();

// ─────────────────────────────────────────────────────────
// ACTION: upload
// ─────────────────────────────────────────────────────────
if ($action === 'upload') {

    if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errCode = $_FILES['image']['error'] ?? 'none';
        echo json_encode(['success' => false, 'message' => "Upload error (code $errCode). Check PHP upload settings."]);
        exit;
    }

    $file     = $_FILES['image'];
    $origName = basename($file['name']);
    $tmpPath  = $file['tmp_name'];
    $size     = $file['size'];

    // Size check
    if ($size > MAX_FILE_SIZE) {
        echo json_encode(['success' => false, 'message' => 'File too large. Maximum size is 5 MB.']);
        exit;
    }

    // MIME check (real type, not just extension)
    $finfo    = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($tmpPath);
    if (!in_array($mimeType, ALLOWED_TYPES, true)) {
        echo json_encode(['success' => false, 'message' => "Invalid file type: $mimeType"]);
        exit;
    }

    // Extension check
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    if (!in_array($ext, ALLOWED_EXTS, true)) {
        echo json_encode(['success' => false, 'message' => "Invalid file extension: $ext"]);
        exit;
    }

    // Generate unique filename
    $newName = date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $destPath = UPLOAD_DIR . $newName;

    if (!move_uploaded_file($tmpPath, $destPath)) {
        echo json_encode(['success' => false, 'message' => 'Failed to save file. Check upload directory permissions.']);
        exit;
    }

    // Generate thumbnail (if GD available)
    if (MAKE_THUMBS && extension_loaded('gd')) {
        createThumbnail($destPath, UPLOAD_DIR . 'thumbs/' . $newName, THUMB_WIDTH, THUMB_HEIGHT, $mimeType);
    }

    // Sanitise meta fields
    $caption     = trim(substr($_POST['caption']     ?? '', 0, 255));
    $description = trim(substr($_POST['description'] ?? '', 0, 500));
    $category    = trim($_POST['category']  ?? 'Campus');
    $sortOrder   = max(0, min(9999, (int)($_POST['sort_order'] ?? 0)));

    // Fallback caption → original filename without extension
    if ($caption === '') {
        $caption = pathinfo($origName, PATHINFO_FILENAME);
        $caption = preg_replace('/[_\-]+/', ' ', $caption);
        $caption = ucwords($caption);
    }

    // Validate category
    $validCats = ['Campus','Classrooms','Sports','Events','Parade','Hostel','Lab','Arts','Achievements','Others'];
    if (!in_array($category, $validCats, true)) $category = 'Campus';

    $stmt = $pdo->prepare('
        INSERT INTO gallery_images (filename, original_name, caption, description, category, sort_order, file_size, mime_type)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ');
    $stmt->execute([$newName, $origName, $caption, $description, $category, $sortOrder, $size, $mimeType]);

    echo json_encode(['success' => true, 'message' => 'Image uploaded successfully.', 'filename' => $newName]);
    exit;
}

// ─────────────────────────────────────────────────────────
// ACTION: edit
// ─────────────────────────────────────────────────────────
if ($action === 'edit') {
    $id          = (int)($_POST['id'] ?? 0);
    $caption     = trim(substr($_POST['caption']     ?? '', 0, 255));
    $description = trim(substr($_POST['description'] ?? '', 0, 500));
    $category    = trim($_POST['category']  ?? 'Campus');
    $sortOrder   = max(0, min(9999, (int)($_POST['sort_order'] ?? 0)));
    $isActive    = (int)($_POST['is_active'] ?? 1) ? 1 : 0;

    $validCats = ['Campus','Classrooms','Sports','Events','Parade','Hostel','Lab','Arts','Achievements','Others'];
    if (!in_array($category, $validCats, true)) $category = 'Campus';

    $stmt = $pdo->prepare('
        UPDATE gallery_images
        SET caption=?, description=?, category=?, sort_order=?, is_active=?
        WHERE id=?
    ');
    $stmt->execute([$caption, $description, $category, $sortOrder, $isActive, $id]);

    echo json_encode(['success' => true, 'message' => 'Updated successfully.']);
    exit;
}

// ─────────────────────────────────────────────────────────
// ACTION: toggle_status
// ─────────────────────────────────────────────────────────
if ($action === 'toggle_status') {
    $id     = (int)($_POST['id']     ?? 0);
    $status = (int)($_POST['status'] ?? 0) ? 1 : 0;

    $pdo->prepare('UPDATE gallery_images SET is_active=? WHERE id=?')->execute([$status, $id]);
    echo json_encode(['success' => true]);
    exit;
}

// ─────────────────────────────────────────────────────────
// ACTION: delete
// ─────────────────────────────────────────────────────────
if ($action === 'delete') {
    $id = (int)($_POST['id'] ?? 0);

    $row = $pdo->prepare('SELECT filename FROM gallery_images WHERE id=?');
    $row->execute([$id]);
    $img = $row->fetch();

    if ($img) {
        // Delete physical files
        $filepath = UPLOAD_DIR . $img['filename'];
        $thumbpath = UPLOAD_DIR . 'thumbs/' . $img['filename'];
        if (file_exists($filepath))  @unlink($filepath);
        if (file_exists($thumbpath)) @unlink($thumbpath);

        $pdo->prepare('DELETE FROM gallery_images WHERE id=?')->execute([$id]);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Image not found.']);
    }
    exit;
}

// ─────────────────────────────────────────────────────────
// ACTION: bulk
// ─────────────────────────────────────────────────────────
if ($action === 'bulk') {
    $bulkAction = trim($_POST['bulk_action'] ?? '');
    $ids        = array_map('intval', (array)($_POST['ids'] ?? []));
    $ids        = array_filter($ids, fn($id) => $id > 0);

    if (empty($ids)) {
        echo json_encode(['success' => false, 'message' => 'No valid IDs provided.']);
        exit;
    }

    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    if ($bulkAction === 'delete') {
        // Fetch filenames first
        $rows = $pdo->prepare("SELECT filename FROM gallery_images WHERE id IN ($placeholders)");
        $rows->execute($ids);
        foreach ($rows->fetchAll() as $row) {
            @unlink(UPLOAD_DIR . $row['filename']);
            @unlink(UPLOAD_DIR . 'thumbs/' . $row['filename']);
        }
        $pdo->prepare("DELETE FROM gallery_images WHERE id IN ($placeholders)")->execute($ids);
        echo json_encode(['success' => true]);

    } elseif ($bulkAction === 'show') {
        $pdo->prepare("UPDATE gallery_images SET is_active=1 WHERE id IN ($placeholders)")->execute($ids);
        echo json_encode(['success' => true]);

    } elseif ($bulkAction === 'hide') {
        $pdo->prepare("UPDATE gallery_images SET is_active=0 WHERE id IN ($placeholders)")->execute($ids);
        echo json_encode(['success' => true]);

    } else {
        echo json_encode(['success' => false, 'message' => 'Unknown bulk action.']);
    }
    exit;
}

// ─────────────────────────────────────────────────────────
// Unknown action
// ─────────────────────────────────────────────────────────
echo json_encode(['success' => false, 'message' => 'Unknown action.']);


// ═══════════════════════════════════════════════════════════
//  HELPER: Create thumbnail with GD
// ═══════════════════════════════════════════════════════════
function createThumbnail(string $src, string $dest, int $maxW, int $maxH, string $mimeType): bool {
    try {
        [$origW, $origH] = getimagesize($src);
        if (!$origW || !$origH) return false;

        // Calculate dimensions (cover crop to exact size)
        $ratio  = $origW / $origH;
        $tRatio = $maxW / $maxH;
        if ($ratio > $tRatio) {
            $newH = $maxH;
            $newW = (int)round($maxH * $ratio);
        } else {
            $newW = $maxW;
            $newH = (int)round($maxW / $ratio);
        }
        $cropX = (int)round(($newW - $maxW) / 2);
        $cropY = (int)round(($newH - $maxH) / 2);

        // Load source
        $srcImg = match($mimeType) {
            'image/jpeg' => imagecreatefromjpeg($src),
            'image/png'  => imagecreatefrompng($src),
            'image/webp' => imagecreatefromwebp($src),
            'image/gif'  => imagecreatefromgif($src),
            default      => false,
        };
        if (!$srcImg) return false;

        // Resize
        $resized = imagecreatetruecolor($newW, $newH);
        imagecopyresampled($resized, $srcImg, 0, 0, 0, 0, $newW, $newH, $origW, $origH);

        // Crop
        $thumb = imagecreatetruecolor($maxW, $maxH);
        imagecopy($thumb, $resized, 0, 0, $cropX, $cropY, $maxW, $maxH);

        // Save as JPEG for all types (smaller size)
        imagejpeg($thumb, $dest, 85);

        imagedestroy($srcImg);
        imagedestroy($resized);
        imagedestroy($thumb);
        return true;

    } catch (Throwable $e) {
        return false;
    }
}
