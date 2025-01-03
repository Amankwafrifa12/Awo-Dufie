<?php include 'includes/header.php'; ?>
<section class="single-post-section">
    <?php
    include 'includes/db.php';
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($post) {
            echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
            if (!empty($post['image_url'])) {
                echo "<img src='" . htmlspecialchars($post['image_url']) . "' alt='" . htmlspecialchars($post['title']) . "' style='width:100%; max-width:500px;'>";
            }
            echo "<p>" . htmlspecialchars($post['content']) . "</p>";
            echo "<p><small>By " . htmlspecialchars($post['author']) . " on " . $post['created_at'] . "</small></p>";
        } else {
            echo "<p>Post not found.</p>";
        }
    } else {
        echo "<p>No post ID provided.</p>";
    }
    ?>
</section>
<?php include 'includes/footer.php'; ?>