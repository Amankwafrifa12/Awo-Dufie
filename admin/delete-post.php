<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: dashboard.php');
    exit;
}
