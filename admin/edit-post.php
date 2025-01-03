<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?");
    $stmt->execute([$title, $content, $author, $id]);
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <form method="POST" action="">
        <h2>Edit Post</h2>
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        <input type="text" name="author" value="<?php echo htmlspecialchars($post['author']); ?>" required>
        <button type="submit">Update Post</button>
    </form>
</body>

</html>