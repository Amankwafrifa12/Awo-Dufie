<?php include 'includes/header.php'; ?>
<section class="projects-section">
    <h2>Blog Posts</h2>
    <div class="projects -section">
        <?php
        include 'includes/db.php';
        $stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
        while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='post'>";
            echo "<h3><a href='single-post.php?id=" . $post['id'] . "'>" . htmlspecialchars($post['title']) . "</a></h3>";
            echo "<p>" . htmlspecialchars(substr($post['content'], 0, 100)) . "...</p>";
            echo "<p><small>By " . htmlspecialchars($post['author']) . " on " . $post['created_at'] . "</small></p>";
            echo "</div>";
        }
        ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>