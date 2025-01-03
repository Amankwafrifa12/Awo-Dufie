<?php
// Start the session
session_start();

// Check if the session is active (e.g., if an admin is logged in)
if (isset($_SESSION['admin_id'])) {
    // Unset the session variables
    unset($_SESSION['admin_id']);

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: ../login.php");
    exit();
} else {
    // Redirect to the login page if the session is not active
    header("Location: ../login.php");
    exit();
}
