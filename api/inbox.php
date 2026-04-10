<?php
// ============================================================
// Colonel's Sainik Vidyalaya — Enquiries & Applications API
// File: api/inbox.php
// ============================================================
require_once __DIR__ . '/config.php';
setApiHeaders();

$method  = $_SERVER['REQUEST_METHOD'];
$section = $_GET['section'] ?? '';   // 'enquiry' or 'application'
$id      = (int)($_GET['id'] ?? 0);
$action  = $_GET['action'] ?? '';
$body    = json_decode(file_get_contents('php://input'), true) ?? [];
$db      = getDB();

// ============================================================
// PUBLIC: Submit Enquiry (from contact form on public site)
// POST /api/inbox.php?section=enquiry&action=submit
// ============================================================
if ($method === 'POST' && $section === 'enquiry' && $action === 'submit') {
    $name  = trim($body['parent_name'] ?? '');
    $phone = trim($body['phone'] ?? '');
    $email = trim($body['email'] ?? '');
    $cls   = trim($body['class_interested'] ?? '');
    $admt  = trim($body['admission_type'] ?? '');
    $msg   = trim($body['message'] ?? '');

    if (!$name || !$phone) jsonError('Name and phone number are required');
    if (!preg_match('/^[0-9+\-\s]{7,15}$/', $phone)) jsonError('Invalid phone number');

    $enquiryId = 'ENQ-' . substr(time(), -6);

    $db->prepare(
        'INSERT INTO enquiries
         (enquiry_id,parent_name,phone,email,class_interested,admission_type,message,ip_address)
         VALUES (?,?,?,?,?,?,?,?)'
    )->execute([
        $enquiryId, $name, $phone, $email ?: null,
        $cls ?: null, $admt ?: null, $msg ?: null,
        $_SERVER['REMOTE_ADDR'] ?? null
    ]);

    jsonSuccess(['enquiry_id' => $enquiryId], 'Enquiry submitted successfully');
}

// ============================================================
// PUBLIC: Submit Application (from apply form)
// POST /api/inbox.php?section=application&action=submit
// ============================================================
if ($method === 'POST' && $section === 'application' && $action === 'submit') {
    // Required fields
    $sname   = trim($body['student_name'] ?? '');
    $cls     = trim($body['class_applying'] ?? '');
    $type    = trim($body['admission_type'] ?? '');
    $fname   = trim($body['father_name'] ?? '');
    $phone   = trim($body['phone'] ?? '');
    $address = trim($body['address'] ?? '');

    if (!$sname || !$cls || !$type || !$fname || !$phone || !$address) {
        jsonError('Please fill all required fields');
    }

    // Generate unique token
    do {
        $token = 'CSV-' . date('Y') . '-' . rand(1000, 9999);
        $exists = $db->prepare('SELECT id FROM applications WHERE token=?');
        $exists->execute([$token]);
    } while ($exists->fetch());

    // Default timeline JSON
    $timeline = json_encode([
        ['label'=>'Application Submitted',  'desc'=>'Your application has been received.',          'done'=>true,  'date'=>date('d M Y')],
        ['label'=>'Under Review',           'desc'=>'Admissions team is reviewing your application.','done'=>false, 'date'=>''],
        ['label'=>'Interaction Scheduled',  'desc'=>'You will be called for campus interaction.',    'done'=>false, 'date'=>''],
        ['label'=>'Decision',               'desc'=>'Final admission decision communicated.',         'done'=>false, 'date'=>''],
        ['label'=>'Enrollment',             'desc'=>'Complete fee payment and enrollment.',           'done'=>false, 'date'=>''],
    ]);

    $dob = $body['date_of_birth'] ?? null;
    if ($dob && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) $dob = null;

    $db->prepare(
        'INSERT INTO applications
         (token,student_name,date_of_birth,gender,class_applying,admission_type,
          prev_school,last_class,father_name,mother_name,phone,email,
          occupation,annual_income,address,heard_from,special_message,timeline,ip_address)
         VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
    )->execute([
        $token,
        $sname,
        $dob,
        $body['gender'] ?? null,
        $cls, $type,
        $body['prev_school'] ?? null,
        $body['last_class'] ?? null,
        $fname,
        $body['mother_name'] ?? null,
        $phone,
        $body['email'] ?? null,
        $body['occupation'] ?? null,
        $body['annual_income'] ?? null,
        $address,
        $body['heard_from'] ?? null,
        $body['special_message'] ?? null,
        $timeline,
        $_SERVER['REMOTE_ADDR'] ?? null
    ]);

    jsonSuccess(['token' => $token], 'Application submitted successfully');
}

// ============================================================
// PUBLIC: Track Application by Token
// GET /api/inbox.php?section=application&action=track&token=CSV-2026-XXXX
// ============================================================
if ($method === 'GET' && $section === 'application' && $action === 'track') {
    $token = strtoupper(trim($_GET['token'] ?? ''));
    if (!$token) jsonError('Token required');

    $stmt = $db->prepare(
        'SELECT token,student_name,class_applying,admission_type,
                father_name,mother_name,phone,submitted_at,status,timeline
         FROM applications WHERE token=?'
    );
    $stmt->execute([$token]);
    $app = $stmt->fetch();

    if (!$app) jsonError('No application found with this token', 404);

    $app['timeline'] = json_decode($app['timeline'] ?? '[]', true);
    jsonSuccess($app);
}

// ============================================================
// ADMIN: Get all enquiries
// GET /api/inbox.php?section=enquiry  (auth required)
// ============================================================
if ($method === 'GET' && $section === 'enquiry') {
    requireAuth();
    $status = $_GET['status'] ?? '';
    $sql    = 'SELECT * FROM enquiries';
    $params = [];
    if ($status) { $sql .= ' WHERE status=?'; $params[] = $status; }
    $sql .= ' ORDER BY submitted_at DESC';
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    jsonSuccess($stmt->fetchAll());
}

// ============================================================
// ADMIN: Get all applications
// GET /api/inbox.php?section=application  (auth required)
// ============================================================
if ($method === 'GET' && $section === 'application') {
    requireAuth();
    $status = $_GET['status'] ?? '';
    $sql    = 'SELECT * FROM applications';
    $params = [];
    if ($status && $status !== 'all') { $sql .= ' WHERE status=?'; $params[] = $status; }
    $sql .= ' ORDER BY submitted_at DESC';
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    foreach ($rows as &$row) {
        $row['timeline'] = json_decode($row['timeline'] ?? '[]', true);
    }
    jsonSuccess($rows);
}

// ============================================================
// ADMIN: Update enquiry status / mark read
// PUT /api/inbox.php?section=enquiry&id=X
// ============================================================
if ($method === 'PUT' && $section === 'enquiry' && $id) {
    requireAuth();
    $status  = $body['status']  ?? null;
    $is_read = isset($body['is_read']) ? (int)$body['is_read'] : null;
    $updates = []; $params = [];
    if ($status)           { $updates[] = 'status=?';  $params[] = $status; }
    if ($is_read !== null) { $updates[] = 'is_read=?'; $params[] = $is_read; }
    if (!$updates) jsonError('Nothing to update');
    $params[] = $id;
    $db->prepare('UPDATE enquiries SET ' . implode(',',$updates) . ' WHERE id=?')->execute($params);
    jsonSuccess([], 'Updated');
}

// ============================================================
// ADMIN: Update application status
// PUT /api/inbox.php?section=application&id=X
// ============================================================
if ($method === 'PUT' && $section === 'application' && $id) {
    $adminId = requireAuth();
    $status  = $body['status'] ?? null;
    $is_read = isset($body['is_read']) ? (int)$body['is_read'] : null;
    $updates = []; $params = [];
    if ($status) {
        $updates[] = 'status=?'; $params[] = $status;
        // Update timeline automatically
        $stmt = $db->prepare('SELECT timeline FROM applications WHERE id=?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        $tl  = json_decode($row['timeline'] ?? '[]', true);
        $map = ['Under Review'=>1, 'Shortlisted'=>2, 'Enrolled'=>4];
        if (isset($map[$status]) && isset($tl[$map[$status]])) {
            $tl[$map[$status]]['done'] = true;
            $tl[$map[$status]]['date'] = date('d M Y');
        }
        $updates[] = 'timeline=?'; $params[] = json_encode($tl);
        logAction($adminId, 'update_application_status', "id=$id status=$status");
    }
    if ($is_read !== null) { $updates[] = 'is_read=?'; $params[] = $is_read; }
    if (!$updates) jsonError('Nothing to update');
    $params[] = $id;
    $db->prepare('UPDATE applications SET ' . implode(',',$updates) . ' WHERE id=?')->execute($params);
    jsonSuccess([], 'Updated');
}

// ============================================================
// ADMIN: Delete enquiry or application
// DELETE /api/inbox.php?section=enquiry&id=X
// DELETE /api/inbox.php?section=application&id=X
// ============================================================
if ($method === 'DELETE' && $id) {
    $adminId = requireAuth();
    if ($section === 'enquiry') {
        $db->prepare('DELETE FROM enquiries WHERE id=?')->execute([$id]);
        logAction($adminId, 'delete_enquiry', "id=$id");
        jsonSuccess([], 'Deleted');
    }
    if ($section === 'application') {
        $db->prepare('DELETE FROM applications WHERE id=?')->execute([$id]);
        logAction($adminId, 'delete_application', "id=$id");
        jsonSuccess([], 'Deleted');
    }
}

// ============================================================
// ADMIN: Dashboard counts
// GET /api/inbox.php?action=dashboard_counts
// ============================================================
if ($method === 'GET' && $action === 'dashboard_counts') {
    requireAuth();
    $counts = [];
    $counts['enquiries']     = (int)$db->query('SELECT COUNT(*) FROM enquiries')->fetchColumn();
    $counts['new_enquiries'] = (int)$db->query('SELECT COUNT(*) FROM enquiries WHERE is_read=0')->fetchColumn();
    $counts['applications']  = (int)$db->query('SELECT COUNT(*) FROM applications')->fetchColumn();
    $counts['new_apps']      = (int)$db->query('SELECT COUNT(*) FROM applications WHERE is_read=0')->fetchColumn();
    $counts['gallery']       = (int)$db->query('SELECT COUNT(*) FROM gallery_images WHERE is_active=1')->fetchColumn();
    $counts['notices']       = (int)$db->query('SELECT COUNT(*) FROM notices WHERE is_active=1')->fetchColumn();
    $counts['news']          = (int)$db->query('SELECT COUNT(*) FROM news_events WHERE is_active=1')->fetchColumn();
    $counts['facilities']    = (int)$db->query('SELECT COUNT(*) FROM facilities WHERE is_active=1')->fetchColumn();
    jsonSuccess($counts);
}

jsonError("Unknown request: section=$section action=$action method=$method", 400);
