<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Only POST method is allowed'
    ]);
    exit;
}

// Define the upload directory
$uploadDir = '../public/upload/cdc/';

// Create the directory if it doesn't exist
if (!is_dir($uploadDir) && !@mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to create upload directory'
    ]);
    exit;
}

// Check if file was uploaded
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $errorMessage = 'No file uploaded or upload error';
    if (isset($_FILES['file'])) {
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $errorMessage = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $errorMessage = 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form';
                break;
            case UPLOAD_ERR_PARTIAL:
                $errorMessage = 'The uploaded file was only partially uploaded';
                break;
            case UPLOAD_ERR_NO_FILE:
                $errorMessage = 'No file was uploaded';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $errorMessage = 'Missing a temporary folder';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $errorMessage = 'Failed to write file to disk';
                break;
            case UPLOAD_ERR_EXTENSION:
                $errorMessage = 'A PHP extension stopped the file upload';
                break;
        }
    }
    
    echo json_encode([
        'success' => false,
        'message' => $errorMessage
    ]);
    exit;
}

// Get file information
$file = $_FILES['file'];
$fileName = $file['name'];
$fileTmpPath = $file['tmp_name'];
$fileSize = $file['size'];
$fileType = $file['type'];

// Sanitize file name
$fileName = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $fileName);

// Generate a unique filename to avoid overwriting
$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
$baseName = pathinfo($fileName, PATHINFO_FILENAME);
$newFileName = $baseName . '_' . date('Ymd_His') . '.' . $fileExtension;
$uploadPath = $uploadDir . $newFileName;

// Check file type (optional: restrict to certain file types)
$allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
if (!in_array($fileType, $allowedTypes)) {
    echo json_encode([
        'success' => false,
        'message' => 'File type not allowed. Allowed types: PDF, DOC, DOCX'
    ]);
    exit;
}

// Check file size (optional: limit file size)
$maxFileSize = 10 * 1024 * 1024; // 10MB
if ($fileSize > $maxFileSize) {
    echo json_encode([
        'success' => false,
        'message' => 'File size exceeds the limit of 10MB'
    ]);
    exit;
}

// Move the uploaded file to the destination directory
if (move_uploaded_file($fileTmpPath, $uploadPath)) {
    echo json_encode([
        'success' => true,
        'message' => 'File uploaded successfully',
        'file' => [
            'name' => $newFileName,
            'path' => '/upload/cdc/' . $newFileName,
            'size' => $fileSize,
            'type' => $fileType
        ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to move uploaded file'
    ]);
}