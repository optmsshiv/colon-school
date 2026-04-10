<?php
/**
 * Gallery Admin Dashboard — Colonel's Sainik Vidyalaya
 * File: admin/index.php
 */
require_once __DIR__ . '/includes/config.php';
requireLogin();

$pdo   = getDB();
$flash = getFlash();

// ── Stats ───────────────────────────────────────────────
$total   = (int)$pdo->query('SELECT COUNT(*) FROM gallery_images')->fetchColumn();
$active  = (int)$pdo->query('SELECT COUNT(*) FROM gallery_images WHERE is_active=1')->fetchColumn();
$hidden  = $total - $active;
$cats    = $pdo->query("SELECT category, COUNT(*) as cnt FROM gallery_images WHERE is_active=1 GROUP BY category ORDER BY cnt DESC")->fetchAll();

// ── Pagination ───────────────────────────────────────────
$page     = max(1, (int)($_GET['page'] ?? 1));
$catFilter= trim($_GET['cat'] ?? '');
$search   = trim($_GET['q'] ?? '');
$offset   = ($page - 1) * IMAGES_PER_PAGE;

$where  = '1=1';
$params = [];
if ($catFilter) { $where .= ' AND category = ?'; $params[] = $catFilter; }
if ($search)    { $where .= ' AND (caption LIKE ? OR original_name LIKE ?)'; $params[] = "%$search%"; $params[] = "%$search%"; }

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM gallery_images WHERE $where");
$countStmt->execute($params);
$filteredTotal = (int)$countStmt->fetchColumn();
$totalPages    = max(1, ceil($filteredTotal / IMAGES_PER_PAGE));

$listStmt = $pdo->prepare("SELECT * FROM gallery_images WHERE $where ORDER BY sort_order ASC, id DESC LIMIT " . IMAGES_PER_PAGE . " OFFSET $offset");
$listStmt->execute($params);
$images = $listStmt->fetchAll();

// ── All categories for filter dropdown ──────────────────
$allCats = $pdo->query("SELECT DISTINCT category FROM gallery_images ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);

// ── Category icons ─────────────────────────────────────
$catIcons = ['Campus'=>'🏫','Classrooms'=>'📚','Sports'=>'🏃','Events'=>'🎉','Parade'=>'🎖️','Hostel'=>'🏠','Lab'=>'🔬','Arts'=>'🎨','Achievements'=>'🏆','Others'=>'📷'];
$catIcon  = fn($c) => $catIcons[$c] ?? '🖼️';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= ADMIN_TITLE ?></title>
<style>
:root{
  --navy:#0f2057;--navy-mid:#1a3a96;--gold:#b8860b;--gold-light:#fdf6e0;
  --green:#16a34a;--red:#dc2626;--orange:#d97706;
  --bg:#f3f4f8;--white:#fff;--border:#e2e8f0;--text:#1e293b;--muted:#64748b;
  --radius:12px;--shadow:0 2px 12px rgba(0,0,0,.09);
}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Segoe UI',Arial,sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}

/* ── Top Bar ── */
.topbar{
  background:linear-gradient(135deg,var(--navy),var(--navy-mid));
  color:#fff;padding:0 28px;height:62px;display:flex;align-items:center;
  justify-content:space-between;position:sticky;top:0;z-index:100;
  box-shadow:0 3px 16px rgba(0,0,0,.22);
}
.topbar-brand{display:flex;align-items:center;gap:14px;}
.topbar-brand .emblem{
  width:40px;height:40px;background:rgba(255,255,255,.15);border-radius:50%;
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.topbar-brand h1{font-size:17px;font-weight:700;letter-spacing:.3px;}
.topbar-brand p{font-size:11px;opacity:.75;margin-top:1px;}
.topbar-right{display:flex;align-items:center;gap:16px;}
.topbar-user{font-size:13px;opacity:.9;}
.btn-logout{
  background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.3);
  padding:7px 16px;border-radius:7px;cursor:pointer;font-size:13px;text-decoration:none;
  transition:.2s;
}
.btn-logout:hover{background:rgba(255,255,255,.25);}
.back-site{
  background:rgba(212,160,23,.25);color:#fde68a;border:1px solid rgba(212,160,23,.4);
  padding:7px 14px;border-radius:7px;font-size:12px;text-decoration:none;transition:.2s;
}
.back-site:hover{background:rgba(212,160,23,.4);}

/* ── Layout ── */
.main-wrap{max-width:1400px;margin:0 auto;padding:28px 24px;}

/* ── Stats Cards ── */
.stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:28px;}
.stat-card{
  background:var(--white);border-radius:var(--radius);padding:22px 20px;
  box-shadow:var(--shadow);border-left:4px solid transparent;
}
.stat-card.navy{border-color:var(--navy);}
.stat-card.green{border-color:var(--green);}
.stat-card.orange{border-color:var(--orange);}
.stat-card.gold{border-color:var(--gold);}
.stat-num{font-size:32px;font-weight:800;color:var(--navy);line-height:1;}
.stat-label{font-size:12.5px;color:var(--muted);margin-top:5px;}

/* ── Upload Section ── */
.upload-card{
  background:var(--white);border-radius:var(--radius);padding:28px 28px;
  box-shadow:var(--shadow);margin-bottom:28px;
}
.section-title{
  font-size:18px;font-weight:700;color:var(--navy);margin-bottom:20px;
  display:flex;align-items:center;gap:10px;padding-bottom:14px;
  border-bottom:2px solid var(--border);
}

/* Drop Zone */
.dropzone{
  border:2px dashed #c7d2e7;border-radius:12px;padding:40px 28px;
  text-align:center;cursor:pointer;transition:.25s;background:#f8faff;
  margin-bottom:20px;
}
.dropzone:hover,.dropzone.drag-over{
  border-color:var(--navy-mid);background:#eef2ff;
}
.dropzone .dz-icon{font-size:42px;margin-bottom:10px;}
.dropzone h3{font-size:16px;color:var(--navy);font-weight:700;}
.dropzone p{font-size:12.5px;color:var(--muted);margin-top:5px;}
#file-input{display:none;}

/* Preview grid */
#preview-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:12px;margin-bottom:18px;}
.preview-item{
  position:relative;border-radius:9px;overflow:hidden;
  box-shadow:0 2px 8px rgba(0,0,0,.12);background:#f1f5f9;
}
.preview-item img{width:100%;height:100px;object-fit:cover;display:block;}
.preview-remove{
  position:absolute;top:4px;right:4px;background:rgba(220,38,38,.85);
  color:#fff;border:none;border-radius:50%;width:22px;height:22px;
  font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center;
  line-height:1;
}

/* Form row */
.form-row{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;margin-bottom:16px;}
.form-row-2{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;}
@media(max-width:700px){.form-row,.form-row-2{grid-template-columns:1fr;}}
.fg label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:5px;}
.fg input,.fg select,.fg textarea{
  width:100%;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;
  font-size:13.5px;outline:none;transition:.18s;font-family:inherit;
}
.fg input:focus,.fg select:focus{border-color:var(--navy-mid);box-shadow:0 0 0 3px rgba(26,58,150,.1);}
.fg small{font-size:11.5px;color:var(--muted);margin-top:4px;display:block;}

/* Buttons */
.btn{padding:10px 22px;border-radius:8px;border:none;font-size:13.5px;font-weight:700;cursor:pointer;transition:.2s;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
.btn-navy{background:var(--navy);color:#fff;}
.btn-navy:hover{background:var(--navy-mid);}
.btn-red{background:#fee2e2;color:var(--red);}
.btn-red:hover{background:#fecaca;}
.btn-green{background:#dcfce7;color:var(--green);}
.btn-green:hover{background:#bbf7d0;}
.btn-gold{background:var(--gold-light);color:var(--gold);border:1px solid #e8d08a;}
.btn-ghost{background:#f1f5f9;color:var(--text);}

/* Progress bar */
#upload-progress{display:none;margin-bottom:16px;}
.progress-bar{height:8px;background:#e2e8f0;border-radius:10px;overflow:hidden;margin-top:6px;}
.progress-fill{height:100%;background:linear-gradient(90deg,var(--navy),var(--navy-mid));border-radius:10px;transition:width .3s;width:0%;}

/* Flash */
.flash{padding:13px 18px;border-radius:9px;margin-bottom:20px;font-size:13.5px;font-weight:600;display:flex;align-items:center;gap:10px;}
.flash.success{background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0;}
.flash.error{background:#fef2f2;color:var(--red);border:1px solid #fecaca;}
.flash.info{background:#eff6ff;color:var(--navy);border:1px solid #bfdbfe;}

/* ── Gallery Grid ── */
.filter-bar{
  background:var(--white);border-radius:var(--radius);padding:18px 22px;
  box-shadow:var(--shadow);margin-bottom:20px;
  display:flex;align-items:center;gap:14px;flex-wrap:wrap;
}
.filter-bar label{font-size:13px;font-weight:600;color:var(--muted);white-space:nowrap;}
.filter-bar input,.filter-bar select{
  padding:8px 12px;border:1.5px solid var(--border);border-radius:8px;
  font-size:13px;outline:none;transition:.18s;
}
.filter-bar input:focus,.filter-bar select:focus{border-color:var(--navy-mid);}

.gallery-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
  gap:18px;margin-bottom:28px;
}
.gal-card{
  background:var(--white);border-radius:var(--radius);overflow:hidden;
  box-shadow:var(--shadow);transition:.2s;position:relative;
}
.gal-card:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(0,0,0,.14);}
.gal-card img{width:100%;height:160px;object-fit:cover;display:block;background:#f1f5f9;}
.gal-card-body{padding:12px 14px;}
.gal-caption{font-size:13.5px;font-weight:600;color:var(--text);margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.gal-meta{font-size:11.5px;color:var(--muted);display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.cat-pill{
  display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;
  font-weight:700;background:#eff6ff;color:var(--navy-mid);
}
.status-pill{
  display:inline-block;padding:2px 9px;border-radius:20px;font-size:11px;font-weight:700;
}
.status-pill.active{background:#dcfce7;color:var(--green);}
.status-pill.hidden{background:#fef3c7;color:var(--orange);}
.gal-actions{
  display:flex;gap:7px;padding:10px 14px;border-top:1px solid var(--border);
  background:#fafafe;
}
.gal-actions button,.gal-actions a{
  flex:1;padding:6px;border:none;border-radius:7px;font-size:12px;font-weight:600;
  cursor:pointer;text-align:center;text-decoration:none;transition:.18s;
  display:inline-flex;align-items:center;justify-content:center;gap:4px;
}
.gal-card .sort-badge{
  position:absolute;top:8px;left:8px;background:rgba(15,32,87,.8);
  color:#fff;font-size:11px;padding:3px 9px;border-radius:20px;font-weight:700;
}

/* ── Edit Modal ── */
.modal-bg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:500;align-items:center;justify-content:center;}
.modal-bg.open{display:flex;}
.modal{background:var(--white);border-radius:16px;padding:32px;width:100%;max-width:500px;max-height:90vh;overflow-y:auto;}
.modal h2{font-size:20px;color:var(--navy);margin-bottom:20px;}
.modal-close{float:right;background:none;border:none;font-size:20px;cursor:pointer;color:var(--muted);}

/* ── Pagination ── */
.pagination{display:flex;gap:8px;justify-content:center;margin-top:20px;flex-wrap:wrap;}
.pagination a,.pagination span{
  padding:8px 14px;border-radius:8px;font-size:13px;font-weight:600;
  text-decoration:none;transition:.18s;
}
.pagination a{background:var(--white);color:var(--navy);box-shadow:var(--shadow);}
.pagination a:hover{background:var(--navy);color:#fff;}
.pagination span.cur{background:var(--navy);color:#fff;}
.pagination span.dots{color:var(--muted);}

/* ── Empty state ── */
.empty{
  text-align:center;padding:70px 30px;color:var(--muted);
  background:var(--white);border-radius:var(--radius);box-shadow:var(--shadow);
}
.empty .empty-ico{font-size:52px;margin-bottom:16px;}
.empty h3{font-size:18px;color:var(--text);margin-bottom:8px;}
</style>
</head>
<body>

<!-- Top Bar -->
<div class="topbar">
  <div class="topbar-brand">
    <div class="emblem">🎖️</div>
    <div>
      <h1>Gallery Admin Panel</h1>
      <p>Colonel's Sainik Vidyalaya · Madhepura</p>
    </div>
  </div>
  <div class="topbar-right">
    <a href="<?= SITE_URL ?>/index.html" target="_blank" class="back-site">🌐 View Site</a>
    <span class="topbar-user">👤 <?= e($_SESSION['admin_name'] ?: $_SESSION['admin_user']) ?></span>
    <a href="logout.php" class="btn-logout">Logout</a>
  </div>
</div>

<div class="main-wrap">

<?php if ($flash): ?>
<div class="flash <?= e($flash['type']) ?>">
  <?= $flash['type'] === 'success' ? '✅' : ($flash['type'] === 'error' ? '❌' : 'ℹ️') ?>
  <?= e($flash['msg']) ?>
</div>
<?php endif; ?>

<!-- Stats -->
<div class="stats-row">
  <div class="stat-card navy">
    <div class="stat-num"><?= $total ?></div>
    <div class="stat-label">📷 Total Images</div>
  </div>
  <div class="stat-card green">
    <div class="stat-num"><?= $active ?></div>
    <div class="stat-label">✅ Visible</div>
  </div>
  <div class="stat-card orange">
    <div class="stat-num"><?= $hidden ?></div>
    <div class="stat-label">🙈 Hidden</div>
  </div>
  <div class="stat-card gold">
    <div class="stat-num"><?= count($cats) ?></div>
    <div class="stat-label">🏷️ Categories</div>
  </div>
  <?php foreach(array_slice($cats,0,3) as $c): ?>
  <div class="stat-card">
    <div class="stat-num"><?= $c['cnt'] ?></div>
    <div class="stat-label"><?= $catIcon($c['category']) ?> <?= e($c['category']) ?></div>
  </div>
  <?php endforeach; ?>
</div>

<!-- ═══ UPLOAD CARD ═══ -->
<div class="upload-card">
  <div class="section-title">📤 Upload New Gallery Images</div>

  <div id="upload-progress">
    <div style="font-size:13px;color:var(--navy);font-weight:600;" id="progress-label">Uploading...</div>
    <div class="progress-bar"><div class="progress-fill" id="progress-fill"></div></div>
  </div>
  <div id="upload-result"></div>

  <!-- Drop Zone -->
  <div class="dropzone" id="dropzone" onclick="document.getElementById('file-input').click()">
    <div class="dz-icon">🖼️</div>
    <h3>Click to browse or drag & drop images here</h3>
    <p>Supports JPG, PNG, WebP, GIF · Max 5 MB per image · Multiple files allowed</p>
  </div>
  <input type="file" id="file-input" multiple accept="image/jpeg,image/png,image/webp,image/gif">

  <div id="preview-grid"></div>

  <form id="upload-form">
    <div class="form-row">
      <div class="fg">
        <label>Caption / Title</label>
        <input type="text" id="up-caption" placeholder="e.g. Morning Assembly 2026" maxlength="200">
        <small>Leave blank to use filename as caption</small>
      </div>
      <div class="fg">
        <label>Category</label>
        <select id="up-category">
          <?php
          $cats_list = ['Campus','Classrooms','Sports','Events','Parade','Hostel','Lab','Arts','Achievements','Others'];
          foreach($cats_list as $c) echo "<option value=\"".e($c)."\">".e($catIcon($c).' '.$c)."</option>";
          ?>
        </select>
      </div>
      <div class="fg">
        <label>Sort Order</label>
        <input type="number" id="up-sort" value="0" min="0" max="9999">
        <small>Lower = appears first in gallery</small>
      </div>
    </div>
    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
      <button type="button" class="btn btn-navy" onclick="startUpload()">📤 Upload Images</button>
      <button type="button" class="btn btn-ghost" onclick="clearPreview()">🗑️ Clear</button>
      <span id="selected-count" style="font-size:13px;color:var(--muted);"></span>
    </div>
  </form>
</div>

<!-- ═══ GALLERY LIST ═══ -->
<div class="upload-card">
  <div class="section-title">🖼️ Gallery Images
    <span style="font-size:13px;font-weight:400;color:var(--muted);margin-left:auto;">
      <?= $filteredTotal ?> image<?= $filteredTotal !== 1 ? 's' : '' ?>
    </span>
  </div>

  <!-- Filter bar -->
  <form method="GET" action="" class="filter-bar">
    <label>🔍 Search:</label>
    <input type="text" name="q" value="<?= e($search) ?>" placeholder="Caption or filename…" style="flex:1;min-width:180px;">
    <label>Category:</label>
    <select name="cat">
      <option value="">All Categories</option>
      <?php foreach($allCats as $c): ?>
      <option value="<?= e($c) ?>" <?= $catFilter===$c?'selected':'' ?>><?= e($catIcon($c).' '.$c) ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-navy" style="padding:8px 18px;">Filter</button>
    <?php if($search||$catFilter): ?>
    <a href="index.php" class="btn btn-ghost" style="padding:8px 14px;">✕ Clear</a>
    <?php endif; ?>
  </form>

  <?php if(empty($images)): ?>
  <div class="empty">
    <div class="empty-ico">📭</div>
    <h3>No images found</h3>
    <p>Upload some images above or adjust your filter.</p>
  </div>
  <?php else: ?>

  <!-- Bulk actions -->
  <div style="display:flex;gap:10px;margin-bottom:16px;flex-wrap:wrap;align-items:center;">
    <label style="font-size:13px;color:var(--muted);display:flex;align-items:center;gap:6px;">
      <input type="checkbox" id="select-all" onchange="toggleSelectAll(this)"> Select All
    </label>
    <button class="btn btn-red" style="padding:7px 14px;font-size:12px;" onclick="bulkAction('delete')">🗑️ Delete Selected</button>
    <button class="btn btn-green" style="padding:7px 14px;font-size:12px;" onclick="bulkAction('show')">👁️ Show Selected</button>
    <button class="btn btn-gold" style="padding:7px 14px;font-size:12px;" onclick="bulkAction('hide')">🙈 Hide Selected</button>
  </div>

  <div class="gallery-grid" id="gallery-grid">
    <?php foreach($images as $img): ?>
    <div class="gal-card" data-id="<?= $img['id'] ?>">
      <div class="sort-badge">#<?= $img['sort_order'] ?></div>
      <input type="checkbox" class="bulk-cb" value="<?= $img['id'] ?>"
        style="position:absolute;top:8px;right:8px;width:16px;height:16px;z-index:10;">
      <?php
        $imgUrl = UPLOAD_URL . $img['filename'];
        $thumbUrl = UPLOAD_URL . 'thumbs/' . $img['filename'];
        // Use thumb if exists, else original
        $displayUrl = file_exists(UPLOAD_DIR . 'thumbs/' . $img['filename']) ? $thumbUrl : $imgUrl;
      ?>
      <img src="<?= e($displayUrl) ?>"
           alt="<?= e($img['caption']) ?>"
           onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'220\' height=\'160\'%3E%3Crect width=\'220\' height=\'160\' fill=\'%23f1f5f9\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.35em\' font-size=\'36\' fill=\'%23cbd5e1\'%3E🖼️%3C/text%3E%3C/svg%3E'">
      <div class="gal-card-body">
        <div class="gal-caption" title="<?= e($img['caption']) ?>"><?= e($img['caption'] ?: $img['original_name']) ?></div>
        <div class="gal-meta">
          <span class="cat-pill"><?= e($catIcon($img['category']).' '.$img['category']) ?></span>
          <span class="status-pill <?= $img['is_active'] ? 'active' : 'hidden' ?>">
            <?= $img['is_active'] ? 'Visible' : 'Hidden' ?>
          </span>
        </div>
        <div style="font-size:11px;color:var(--muted);margin-top:5px;">
          <?= round($img['file_size']/1024) ?> KB ·
          <?= date('d M Y', strtotime($img['uploaded_at'])) ?>
        </div>
      </div>
      <div class="gal-actions">
        <button onclick="openEdit(<?= $img['id'] ?>,<?= htmlspecialchars(json_encode($img),ENT_QUOTES) ?>)"
          style="background:#eff6ff;color:var(--navy-mid);">✏️ Edit</button>
        <a href="<?= e($imgUrl) ?>" target="_blank"
          style="background:#f0fdf4;color:var(--green);">🔗 View</a>
        <button onclick="toggleStatus(<?= $img['id'] ?>, <?= $img['is_active'] ?>)"
          style="background:<?= $img['is_active'] ? '#fef3c7' : '#dcfce7' ?>;color:<?= $img['is_active'] ? 'var(--orange)' : 'var(--green)' ?>;">
          <?= $img['is_active'] ? '🙈' : '👁️' ?>
        </button>
        <button onclick="deleteImage(<?= $img['id'] ?>)" style="background:#fee2e2;color:var(--red);">🗑️</button>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <?php if($totalPages > 1): ?>
  <div class="pagination">
    <?php if($page>1): ?>
    <a href="?page=<?= $page-1 ?>&cat=<?= urlencode($catFilter) ?>&q=<?= urlencode($search) ?>">← Prev</a>
    <?php endif; ?>
    <?php for($p=1;$p<=$totalPages;$p++): ?>
      <?php if($p===$page): ?>
      <span class="cur"><?= $p ?></span>
      <?php elseif($p===1||$p===$totalPages||abs($p-$page)<=2): ?>
      <a href="?page=<?= $p ?>&cat=<?= urlencode($catFilter) ?>&q=<?= urlencode($search) ?>"><?= $p ?></a>
      <?php elseif(abs($p-$page)==3): ?>
      <span class="dots">…</span>
      <?php endif; ?>
    <?php endfor; ?>
    <?php if($page<$totalPages): ?>
    <a href="?page=<?= $page+1 ?>&cat=<?= urlencode($catFilter) ?>&q=<?= urlencode($search) ?>">Next →</a>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <?php endif; ?>
</div><!-- /.upload-card -->

</div><!-- /.main-wrap -->

<!-- ═══ EDIT MODAL ═══ -->
<div class="modal-bg" id="edit-modal">
  <div class="modal">
    <button class="modal-close" onclick="closeEdit()">✕</button>
    <h2>✏️ Edit Image</h2>
    <div id="edit-preview" style="margin-bottom:18px;text-align:center;"></div>
    <form id="edit-form">
      <input type="hidden" id="edit-id">
      <div class="fg" style="margin-bottom:14px;">
        <label>Caption / Title</label>
        <input type="text" id="edit-caption" maxlength="200">
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
        <div class="fg">
          <label>Category</label>
          <select id="edit-category">
            <?php
            foreach($cats_list as $c) echo "<option value=\"".e($c)."\">".e($catIcon($c).' '.$c)."</option>";
            ?>
          </select>
        </div>
        <div class="fg">
          <label>Sort Order</label>
          <input type="number" id="edit-sort" min="0" max="9999">
        </div>
      </div>
      <div class="fg" style="margin-bottom:18px;">
        <label>Visibility</label>
        <select id="edit-status">
          <option value="1">👁️ Visible</option>
          <option value="0">🙈 Hidden</option>
        </select>
      </div>
      <div style="display:flex;gap:10px;">
        <button type="button" class="btn btn-navy" onclick="saveEdit()">💾 Save Changes</button>
        <button type="button" class="btn btn-ghost" onclick="closeEdit()">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
// ── File Preview ──────────────────────────────────────────
let selectedFiles = [];

const dropzone  = document.getElementById('dropzone');
const fileInput = document.getElementById('file-input');
const previewGrid = document.getElementById('preview-grid');

dropzone.addEventListener('dragover',  e => { e.preventDefault(); dropzone.classList.add('drag-over'); });
dropzone.addEventListener('dragleave', ()=> dropzone.classList.remove('drag-over'));
dropzone.addEventListener('drop', e => {
  e.preventDefault(); dropzone.classList.remove('drag-over');
  addFiles(e.dataTransfer.files);
});
fileInput.addEventListener('change', () => addFiles(fileInput.files));

function addFiles(files) {
  for(const f of files) {
    if(!['image/jpeg','image/png','image/webp','image/gif'].includes(f.type)) continue;
    if(f.size > 5*1024*1024) { alert(f.name + ' exceeds 5 MB limit'); continue; }
    selectedFiles.push(f);
    const idx = selectedFiles.length - 1;
    const div = document.createElement('div');
    div.className = 'preview-item';
    div.id = 'prev-' + idx;
    const img = document.createElement('img');
    img.src = URL.createObjectURL(f);
    const btn = document.createElement('button');
    btn.className = 'preview-remove';
    btn.innerHTML = '✕';
    btn.onclick = () => removeFile(idx);
    const name = document.createElement('div');
    name.style = 'font-size:10px;padding:4px 6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#64748b;';
    name.textContent = f.name;
    div.append(img, btn, name);
    previewGrid.appendChild(div);
  }
  updateCount();
}

function removeFile(idx) {
  selectedFiles[idx] = null;
  const el = document.getElementById('prev-' + idx);
  if(el) el.remove();
  updateCount();
}

function clearPreview() {
  selectedFiles = [];
  previewGrid.innerHTML = '';
  fileInput.value = '';
  updateCount();
}

function updateCount() {
  const n = selectedFiles.filter(Boolean).length;
  document.getElementById('selected-count').textContent = n ? n + ' file(s) ready to upload' : '';
}

// ── Upload ────────────────────────────────────────────────
async function startUpload() {
  const files = selectedFiles.filter(Boolean);
  if(!files.length) { showResult('error','Please select at least one image.'); return; }

  const caption  = document.getElementById('up-caption').value.trim();
  const category = document.getElementById('up-category').value;
  const sort     = document.getElementById('up-sort').value;

  const progressWrap = document.getElementById('upload-progress');
  const progressFill = document.getElementById('progress-fill');
  const progressLabel= document.getElementById('progress-label');
  progressWrap.style.display = 'block';

  let done = 0;
  let errors = [];

  for(const file of files) {
    const fd = new FormData();
    fd.append('image', file);
    fd.append('caption', caption);
    fd.append('category', category);
    fd.append('sort_order', sort);
    fd.append('action', 'upload');

    try {
      const res = await fetch('actions.php', { method:'POST', body: fd });
      const data = await res.json();
      if(!data.success) errors.push(file.name + ': ' + data.message);
    } catch(e) {
      errors.push(file.name + ': Network error');
    }

    done++;
    progressFill.style.width = Math.round((done/files.length)*100) + '%';
    progressLabel.textContent = `Uploading ${done}/${files.length}…`;
  }

  progressWrap.style.display = 'none';
  progressFill.style.width = '0%';

  if(errors.length) {
    showResult('error', errors.join('<br>'));
  } else {
    showResult('success', `✅ ${done} image(s) uploaded successfully!`);
    clearPreview();
    setTimeout(() => location.reload(), 1200);
  }
}

function showResult(type, msg) {
  const el = document.getElementById('upload-result');
  el.innerHTML = `<div class="flash ${type}" style="margin-bottom:14px;">${msg}</div>`;
  setTimeout(() => el.innerHTML = '', 5000);
}

// ── Toggle status ─────────────────────────────────────────
async function toggleStatus(id, current) {
  const newStatus = current ? 0 : 1;
  const fd = new FormData();
  fd.append('action', 'toggle_status');
  fd.append('id', id);
  fd.append('status', newStatus);
  const res = await fetch('actions.php', {method:'POST',body:fd});
  const data = await res.json();
  if(data.success) location.reload();
  else alert('Error: ' + data.message);
}

// ── Delete ────────────────────────────────────────────────
async function deleteImage(id) {
  if(!confirm('Delete this image? This cannot be undone.')) return;
  const fd = new FormData();
  fd.append('action','delete');
  fd.append('id', id);
  const res = await fetch('actions.php',{method:'POST',body:fd});
  const data = await res.json();
  if(data.success) {
    document.querySelector(`.gal-card[data-id="${id}"]`)?.remove();
  } else alert('Error: '+data.message);
}

// ── Bulk actions ─────────────────────────────────────────
function toggleSelectAll(cb) {
  document.querySelectorAll('.bulk-cb').forEach(c => c.checked = cb.checked);
}

async function bulkAction(action) {
  const ids = [...document.querySelectorAll('.bulk-cb:checked')].map(c => c.value);
  if(!ids.length) { alert('Please select at least one image.'); return; }
  if(action === 'delete' && !confirm(`Delete ${ids.length} image(s)? This cannot be undone.`)) return;

  const fd = new FormData();
  fd.append('action','bulk');
  fd.append('bulk_action',action);
  ids.forEach(id => fd.append('ids[]', id));
  const res = await fetch('actions.php',{method:'POST',body:fd});
  const data = await res.json();
  if(data.success) location.reload();
  else alert('Error: '+data.message);
}

// ── Edit modal ────────────────────────────────────────────
function openEdit(id, img) {
  document.getElementById('edit-id').value       = id;
  document.getElementById('edit-caption').value  = img.caption || '';
  document.getElementById('edit-sort').value     = img.sort_order || 0;
  document.getElementById('edit-status').value   = img.is_active;
  document.getElementById('edit-category').value = img.category || 'Campus';
  const thumbUrl = '<?= UPLOAD_URL ?>thumbs/' + img.filename;
  const fullUrl  = '<?= UPLOAD_URL ?>' + img.filename;
  document.getElementById('edit-preview').innerHTML =
    `<img src="${thumbUrl}" onerror="this.src='${fullUrl}'" style="max-height:140px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,.12);">`;
  document.getElementById('edit-modal').classList.add('open');
}

function closeEdit() {
  document.getElementById('edit-modal').classList.remove('open');
}

async function saveEdit() {
  const fd = new FormData();
  fd.append('action','edit');
  fd.append('id',      document.getElementById('edit-id').value);
  fd.append('caption', document.getElementById('edit-caption').value);
  fd.append('category',document.getElementById('edit-category').value);
  fd.append('sort_order',document.getElementById('edit-sort').value);
  fd.append('is_active', document.getElementById('edit-status').value);
  const res = await fetch('actions.php',{method:'POST',body:fd});
  const data = await res.json();
  if(data.success) { closeEdit(); location.reload(); }
  else alert('Error: '+data.message);
}

// Close modal on backdrop click
document.getElementById('edit-modal').addEventListener('click', function(e){
  if(e.target === this) closeEdit();
});
</script>

</body>
</html>
