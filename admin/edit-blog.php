<section class="admin-dashboard">
    <h2>Admin Dashboard</h2>
    <a href="add-post.php">Add New Post</a>
    <h3>Existing Posts</h3>
    <ul>
        <?php
        include '../includes/db.php';
        $stmt = $conn->query("SELECT * FROM posts");
        while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>" . htmlspecialchars($post['title']) .
                " - <a href='edit-post.php?id=" . $post['id'] . "'>Edit</a>" .
                " | <a href='delete-post.php?id=" . $post['id'] . "' onclick='return confirm(\"Are you sure you want to delete this post?\");'>Delete</a></li>";
        }
        ?>
    </ul>
</section>