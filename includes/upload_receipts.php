<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID card value
    $userIdCard = isset($_POST['nic']) ? $_POST['nic'] : null;
    $name_of_file = isset($_POST['fileName']) ? $_POST['fileName'] : null;

    if (!$userIdCard) {
        echo json_encode(['success' => false, 'message' => 'ID Card number is required.']);
        exit;
    }

    if (!isset($_FILES['uploaded_file']) || $_FILES['uploaded_file']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'File upload error.']);
        exit;
    }

    // Save the file
    $baseUploadDir  = '../documents/';
    $userDir = $baseUploadDir . $userIdCard . '/Receipts'.'/';
    if (!is_dir($userDir)) {
        if (!mkdir($userDir, 0755, true)) {
            echo json_encode(['success' => false, 'message' => 'Failed to create user directory.']);
            exit;
        }
    }
    $fileExtension = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_EXTENSION); // Original file name
    $fileName = $name_of_file . '.' . $fileExtension;

    $filePath = $userDir . $fileName;
    if (strpos($filePath, '../') === 0) {
        $cleanPath = substr($filePath, 3);
    }
    if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $filePath)) {
        echo json_encode([
            'success' => true,
            'filePath' => $cleanPath,
            'fileUrl' => '/' . $filePath, // Adjust if necessary for your server setup
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save the file.']);
    }
}
