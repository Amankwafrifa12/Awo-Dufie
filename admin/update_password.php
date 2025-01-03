<?php
// Start the session
session_start();

// Check if the session is active (e.g., if an admin is logged in)
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

// Include the database connection file
include '../includes/db.php';

// Initialize error and success messages
$error = '';
$success = '';

// Update Password Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
        $stmt->execute([$hashed_password, $_SESSION['admin_id']]);

        if ($stmt->rowCount() > 0) {
            $success = "Password updated successfully!";
        } else {
            $error = "Error updating password.";
        }
    } else {
        $error = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333333;
        }

        /* Header Styling */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #003366;
            color: #ffffff;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo h1 {
            font-size: 1.5rem;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .nav-links li a {
            color: #f0f0f0;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .nav-links li a:hover {
            color: #6699cc;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #ffffff;
        }

        /* Update Password Form */
        .update-password-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .update-password-form h2 {
            margin-bottom: 1rem;
        }

        .update-password-form input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .update-password-form button[type="submit"] {
            padding: 0.8rem 1.5rem;
            background-color: #003366;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .update-password-form button[type="submit"]:hover {
            background-color: #00509e;
        }

        /* Error Messages */
        .error {
            color: red;
            margin-top: 1rem;
        }

        /* Success Messages */
        .success {
            color: green;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.html" style="text-decoration: none; color: white;">
                <h1> Admin Dashboard</h1>
            </a>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="update_password.php">Update Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Update Password Form -->
    <form method="POST" action="" id="update-password-form" class="update-password-form">
        <h2>Update Password</h2>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Update Password</button>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>
    </form>
</body>

</html>