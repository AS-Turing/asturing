<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Define the directory path
$directory = '../public/upload/cdc/';

// Check if the directory exists
if (!is_dir($directory)) {
    echo json_encode([
        'success' => false,
        'message' => 'Directory does not exist',
        'files' => []
    ]);
    exit;
}

// Get all files from the directory
$files = [];
$fileList = scandir($directory);

foreach ($fileList as $file) {
    // Skip . and .. directories
    if ($file === '.' || $file === '..') {
        continue;
    }

    // Get file information
    $filePath = $directory . $file;
    $fileInfo = [
        'name' => $file,
        'path' => '/upload/cdc/' . $file, // Path relative to public directory
        'size' => filesize($filePath),
        'modified' => filemtime($filePath),
        'type' => mime_content_type($filePath)
    ];

    $files[] = $fileInfo;
}

// Sort files by modified date (newest first)
usort($files, function($a, $b) {
    return $b['modified'] - $a['modified'];
});

// Return the file list as JSON
echo json_encode([
    'success' => true,
    'message' => 'Files retrieved successfully',
    'files' => $files
]);