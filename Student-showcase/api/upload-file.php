<?php
// api/upload-file.php
header('Content-Type: application/json');

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error']);
    exit;
}

$targetDir = '../uploads/';
$filename = basename($_FILES['file']['name']);
$targetPath = $targetDir . time() . '_' . $filename;

if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
    echo json_encode(['success' => true, 'path' => str_replace('../', '/', $targetPath)]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
}
