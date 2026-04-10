<?php
// ============================================================
// Colonel's Sainik Vidyalaya — Content Management API
// File: api/content.php
// Handles: school_info, ticker, gallery, academics,
//          facilities, admissions, notices, news, contact
// ============================================================
require_once __DIR__ . '/config.php';
setApiHeaders();

$method   = $_SERVER['REQUEST_METHOD'];
$section  = $_GET['section'] ?? '';
$id       = (int)($_GET['id'] ?? 0);
$body     = json_decode(file_get_contents('php://input'), true) ?? [];
$db       = getDB();

// ============================================================
// PUBLIC READ endpoints (no auth needed)
// ============================================================
$publicSections = ['school_info','ticker','gallery','academics','facilities',
                   'admissions','notices','news','contact'];

if ($method === 'GET' && in_array($section, $publicSections)) {
    switch ($section) {

        case 'school_info':
            $rows = $db->query('SELECT setting_key, setting_value FROM school_info')->fetchAll();
            $data = array_column($rows, 'setting_value', 'setting_key');
            jsonSuccess($data);

        case 'ticker':
            $rows = $db->query(
                'SELECT id, message FROM ticker_messages WHERE is_active=1 ORDER BY sort_order'
            )->fetchAll();
            jsonSuccess($rows);

        case 'gallery':
            $cat  = $_GET['category'] ?? '';
            $sql  = 'SELECT id,image_url,caption,category FROM gallery_images WHERE is_active=1';
            $params = [];
            if ($cat) { $sql .= ' AND category=?'; $params[] = $cat; }
            $sql .= ' ORDER BY sort_order,id DESC';
            $stmt = $db->prepare($sql); $stmt->execute($params);
            jsonSuccess($stmt->fetchAll());

        case 'academics':
            $levels = $db->query(
                'SELECT id,level_name,class_range,subjects FROM academic_levels WHERE is_active=1 ORDER BY sort_order'
            )->fetchAll();
            $cocu = $db->query(
                'SELECT id,icon,activity_name FROM cocurricular_activities WHERE is_active=1 ORDER BY sort_order'
            )->fetchAll();
            jsonSuccess(['levels' => $levels, 'cocu' => $cocu]);

        case 'facilities':
            $rows = $db->query(
                'SELECT id,icon,facility_name,description,tags FROM facilities WHERE is_active=1 ORDER BY sort_order'
            )->fetchAll();
            jsonSuccess($rows);

        case 'admissions':
            $cats  = $db->query('SELECT * FROM admission_categories ORDER BY sort_order')->fetchAll();
            $dates = $db->query('SELECT * FROM admission_dates ORDER BY sort_order')->fetchAll();
            $docs  = $db->query('SELECT * FROM admission_documents ORDER BY sort_order')->fetchAll();
            $info  = $db->query(
                'SELECT setting_key,setting_value FROM school_info WHERE setting_key IN ("adm_session","adm_last_date")'
            )->fetchAll();
            $infoMap = array_column($info, 'setting_value', 'setting_key');
            jsonSuccess(['categories'=>$cats,'dates'=>$dates,'documents'=>$docs,'info'=>$infoMap]);

        case 'notices':
            $rows = $db->query(
                'SELECT id,icon,notice_type,title,description,notice_date FROM notices WHERE is_active=1 ORDER BY notice_date DESC'
            )->fetchAll();
            jsonSuccess($rows);

        case 'news':
            $rows = $db->query(
                'SELECT id,title,category,description,news_date,cat_color FROM news_events WHERE is_active=1 ORDER BY news_date DESC LIMIT 10'
            )->fetchAll();
            jsonSuccess($rows);

        case 'contact':
            $rows = $db->query('SELECT info_key, info_value FROM contact_info')->fetchAll();
            jsonSuccess(array_column($rows, 'info_value', 'info_key'));
    }
}

// ============================================================
// ADMIN WRITE endpoints (auth required)
// ============================================================
$adminId = requireAuth();

// ---- school_info ----
if ($section === 'school_info' && $method === 'POST') {
    $allowed = ['school_name','tagline','description','established','total_seats',
                'founder_name','affiliation','hero_image_url','campus_title',
                'adm_session','adm_last_date'];
    $stmt = $db->prepare(
        'INSERT INTO school_info (setting_key, setting_value) VALUES (?,?)
         ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)'
    );
    foreach ($body as $key => $val) {
        if (in_array($key, $allowed)) $stmt->execute([$key, trim($val)]);
    }
    logAction($adminId, 'update_school_info');
    jsonSuccess([], 'School info saved');
}

// ---- ticker CRUD ----
if ($section === 'ticker') {
    if ($method === 'POST') {
        $msg = trim($body['message'] ?? '');
        if (!$msg) jsonError('Message required');
        $order = (int)$db->query('SELECT COALESCE(MAX(sort_order),0)+1 FROM ticker_messages')->fetchColumn();
        $db->prepare('INSERT INTO ticker_messages (message,sort_order) VALUES (?,?)')->execute([$msg,$order]);
        logAction($adminId, 'add_ticker', $msg);
        jsonSuccess(['id'=>$db->lastInsertId()], 'Ticker added');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('DELETE FROM ticker_messages WHERE id=?')->execute([$id]);
        logAction($adminId, 'delete_ticker', "id=$id");
        jsonSuccess([], 'Deleted');
    }
}

// ---- gallery CRUD ----
if ($section === 'gallery') {
    if ($method === 'POST') {
        $url = trim($body['image_url'] ?? '');
        $cap = trim($body['caption'] ?? '');
        $cat = $body['category'] ?? 'Campus';
        if (!$url) jsonError('Image URL required');
        $order = (int)$db->query('SELECT COALESCE(MAX(sort_order),0)+1 FROM gallery_images')->fetchColumn();
        $db->prepare('INSERT INTO gallery_images (image_url,caption,category,sort_order) VALUES (?,?,?,?)')
           ->execute([$url,$cap,$cat,$order]);
        logAction($adminId, 'add_gallery_image', $cap);
        jsonSuccess(['id'=>$db->lastInsertId()], 'Image added');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('DELETE FROM gallery_images WHERE id=?')->execute([$id]);
        jsonSuccess([], 'Deleted');
    }
}

// ---- academic_levels CRUD ----
if ($section === 'academic_levels') {
    if ($method === 'POST') {
        $name = trim($body['level_name'] ?? '');
        $range = trim($body['class_range'] ?? '');
        $subj  = trim($body['subjects'] ?? '');
        if (!$name) jsonError('Level name required');
        if ($id) {
            $db->prepare('UPDATE academic_levels SET level_name=?,class_range=?,subjects=? WHERE id=?')
               ->execute([$name,$range,$subj,$id]);
        } else {
            $order = (int)$db->query('SELECT COALESCE(MAX(sort_order),0)+1 FROM academic_levels')->fetchColumn();
            $db->prepare('INSERT INTO academic_levels (level_name,class_range,subjects,sort_order) VALUES (?,?,?,?)')
               ->execute([$name,$range,$subj,$order]);
        }
        logAction($adminId, 'save_academic_level', $name);
        jsonSuccess([], 'Saved');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('DELETE FROM academic_levels WHERE id=?')->execute([$id]);
        jsonSuccess([], 'Deleted');
    }
}

// ---- cocurricular CRUD ----
if ($section === 'cocu') {
    if ($method === 'POST') {
        $icon = trim($body['icon'] ?? '🎯');
        $name = trim($body['activity_name'] ?? '');
        if (!$name) jsonError('Activity name required');
        if ($id) {
            $db->prepare('UPDATE cocurricular_activities SET icon=?,activity_name=? WHERE id=?')->execute([$icon,$name,$id]);
        } else {
            $order = (int)$db->query('SELECT COALESCE(MAX(sort_order),0)+1 FROM cocurricular_activities')->fetchColumn();
            $db->prepare('INSERT INTO cocurricular_activities (icon,activity_name,sort_order) VALUES (?,?,?)')->execute([$icon,$name,$order]);
        }
        jsonSuccess([], 'Saved');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('DELETE FROM cocurricular_activities WHERE id=?')->execute([$id]);
        jsonSuccess([], 'Deleted');
    }
}

// ---- facilities CRUD ----
if ($section === 'facilities') {
    if ($method === 'POST') {
        $icon = trim($body['icon'] ?? '🏛️');
        $name = trim($body['facility_name'] ?? '');
        $desc = trim($body['description'] ?? '');
        $tags = trim($body['tags'] ?? '');
        if (!$name) jsonError('Facility name required');
        if ($id) {
            $db->prepare('UPDATE facilities SET icon=?,facility_name=?,description=?,tags=? WHERE id=?')
               ->execute([$icon,$name,$desc,$tags,$id]);
        } else {
            $order = (int)$db->query('SELECT COALESCE(MAX(sort_order),0)+1 FROM facilities')->fetchColumn();
            $db->prepare('INSERT INTO facilities (icon,facility_name,description,tags,sort_order) VALUES (?,?,?,?,?)')
               ->execute([$icon,$name,$desc,$tags,$order]);
        }
        jsonSuccess([], 'Saved');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('DELETE FROM facilities WHERE id=?')->execute([$id]);
        jsonSuccess([], 'Deleted');
    }
}

// ---- admission_categories CRUD ----
if ($section === 'adm_categories') {
    if ($method === 'POST' && $id) {
        $db->prepare('UPDATE admission_categories SET icon=?,category_name=?,description=?,class_range=? WHERE id=?')
           ->execute([
               trim($body['icon']??'🎓'), trim($body['category_name']??''),
               trim($body['description']??''), trim($body['class_range']??''), $id
           ]);
        jsonSuccess([], 'Saved');
    }
}

// ---- admission_dates CRUD ----
if ($section === 'adm_dates') {
    if ($method === 'POST') {
        $label = trim($body['label'] ?? '');
        $val   = trim($body['date_value'] ?? '');
        if (!$label) jsonError('Label required');
        if ($id) {
            $db->prepare('UPDATE admission_dates SET label=?,date_value=? WHERE id=?')->execute([$label,$val,$id]);
        } else {
            $order = (int)$db->query('SELECT COALESCE(MAX(sort_order),0)+1 FROM admission_dates')->fetchColumn();
            $db->prepare('INSERT INTO admission_dates (label,date_value,sort_order) VALUES (?,?,?)')->execute([$label,$val,$order]);
        }
        jsonSuccess([], 'Saved');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('DELETE FROM admission_dates WHERE id=?')->execute([$id]);
        jsonSuccess([], 'Deleted');
    }
}

// ---- admission_documents CRUD ----
if ($section === 'adm_docs') {
    if ($method === 'POST') {
        $doc = trim($body['document_name'] ?? '');
        $req = $body['requirement'] ?? 'Mandatory';
        if (!$doc) jsonError('Document name required');
        if ($id) {
            $db->prepare('UPDATE admission_documents SET document_name=?,requirement=? WHERE id=?')->execute([$doc,$req,$id]);
        } else {
            $order = (int)$db->query('SELECT COALESCE(MAX(sort_order),0)+1 FROM admission_documents')->fetchColumn();
            $db->prepare('INSERT INTO admission_documents (document_name,requirement,sort_order) VALUES (?,?,?)')->execute([$doc,$req,$order]);
        }
        jsonSuccess([], 'Saved');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('DELETE FROM admission_documents WHERE id=?')->execute([$id]);
        jsonSuccess([], 'Deleted');
    }
}

// ---- notices CRUD ----
if ($section === 'notices') {
    if ($method === 'POST') {
        $icon  = trim($body['icon'] ?? '📢');
        $type  = $body['notice_type'] ?? 'info';
        $title = trim($body['title'] ?? '');
        $desc  = trim($body['description'] ?? '');
        $date  = trim($body['notice_date'] ?? date('Y-m-d'));
        if (!$title) jsonError('Title required');
        if ($id) {
            $db->prepare('UPDATE notices SET icon=?,notice_type=?,title=?,description=?,notice_date=? WHERE id=?')
               ->execute([$icon,$type,$title,$desc,$date,$id]);
        } else {
            $db->prepare('INSERT INTO notices (icon,notice_type,title,description,notice_date) VALUES (?,?,?,?,?)')
               ->execute([$icon,$type,$title,$desc,$date]);
        }
        logAction($adminId, 'save_notice', $title);
        jsonSuccess(['id'=>$id?:$db->lastInsertId()], 'Saved');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('UPDATE notices SET is_active=0 WHERE id=?')->execute([$id]);
        jsonSuccess([], 'Deleted');
    }
}

// ---- news CRUD ----
if ($section === 'news') {
    if ($method === 'POST') {
        $title = trim($body['title'] ?? '');
        $cat   = trim($body['category'] ?? 'News');
        $desc  = trim($body['description'] ?? '');
        $date  = trim($body['news_date'] ?? date('Y-m-d'));
        $color = trim($body['cat_color'] ?? 'var(--navy)');
        if (!$title) jsonError('Title required');
        if ($id) {
            $db->prepare('UPDATE news_events SET title=?,category=?,description=?,news_date=?,cat_color=? WHERE id=?')
               ->execute([$title,$cat,$desc,$date,$color,$id]);
        } else {
            $db->prepare('INSERT INTO news_events (title,category,description,news_date,cat_color) VALUES (?,?,?,?,?)')
               ->execute([$title,$cat,$desc,$date,$color]);
        }
        jsonSuccess(['id'=>$id?:$db->lastInsertId()], 'Saved');
    }
    if ($method === 'DELETE' && $id) {
        $db->prepare('UPDATE news_events SET is_active=0 WHERE id=?')->execute([$id]);
        jsonSuccess([], 'Deleted');
    }
}

// ---- contact info ----
if ($section === 'contact' && $method === 'POST') {
    $allowed = ['address','phone','whatsapp','email','website','hours','map_embed'];
    $stmt = $db->prepare(
        'INSERT INTO contact_info (info_key,info_value) VALUES (?,?)
         ON DUPLICATE KEY UPDATE info_value=VALUES(info_value)'
    );
    foreach ($body as $key => $val) {
        if (in_array($key, $allowed)) $stmt->execute([$key, trim($val)]);
    }
    logAction($adminId, 'update_contact_info');
    jsonSuccess([], 'Contact info saved');
}

jsonError("Unknown section or method: $section / $method", 404);
