<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/db.php';

// Add the code here to retrieve the username from the database
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    // Use PDO's prepare and execute methods
    $stmt = $conn->prepare("SELECT username FROM admin WHERE id = :admin_id");
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the result
    $username = $stmt->fetchColumn();

    // Store the username in the session
    $_SESSION['username'] = htmlspecialchars($username, ENT_QUOTES);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $image = $_FILES['image'];

    // Handle image upload
    $target_dir = "../uploads/";
    $img_url = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
    }

    $target_file = $target_dir . basename($image["name"]);
    $target_url = $img_url . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Debug: Print paths
    echo "Target Directory: " . $target_dir . "<br>";
    echo "Target File: " . $target_file . "<br>";

    // Check if the file is an image
    $check = getimagesize($image["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $image_url = $target_url;
        } else {
            die("Failed to upload image.");
        }
    } else {
        die("File is not an image.");
    }

    // Insert post into database
    $stmt = $conn->prepare("INSERT INTO posts (title, content, author, image_url) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $content, $author, $image_url]);
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Post</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form container styling */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        /* Form heading styling */
        form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        /* Input and textarea styling */
        form input[type="text"],
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        form textarea {
            height: 150px;
            resize: vertical;
        }

        /* File input styling */
        form input[type="file"] {
            padding: 5px;
        }

        /* Button styling */
        form button {
            width: 100%;
            padding: 10px;
            background-color: #00509e;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #00509e;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            form {
                padding: 15px;
            }

            form h2 {
                font-size: 20px;
            }

            form input[type="text"],
            form textarea,
            form input[type="file"] {
                font-size: 14px;
            }

            form button {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <h2>Add New Post</h2><input type="text" name="title" placeholder="Post Title" required><textarea name="content"
            placeholder="Post Content" required></textarea><input type="file" name="image" required><input type="text"
            name="author"
            value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin'; ?> "><button
            type="submit">Add Post</button>
    </form>
</body>

</html>