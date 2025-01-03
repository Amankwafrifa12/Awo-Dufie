<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo json_encode(['location' => $target_file]);
        } else {
            echo json_encode(['error' => 'Failed to upload file.']);
        }
    } else {
        echo json_encode(['error' => 'File is not an image.']);
    }
} else {
    echo json_encode(['error' => 'No file uploaded.']);
}
