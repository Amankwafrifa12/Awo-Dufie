<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'blog_db');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE admin SET password = ?, is_first_login = FALSE WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $_SESSION['admin_id']);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $error = "Failed to update password.";
        }

        $stmt->close();
        $conn->close();
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
    <title>Set New Password</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .password-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .password-container h2 {
            margin-bottom: 1.5rem;
            color: #003366;
        }

        .password-container form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .password-container input {
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .password-container button {
            padding: 0.8rem 1.5rem;
            background-color: #003366;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .password-container button:hover {
            background-color: #00509e;
        }

        .error {
            color: red;
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .password-container {
                padding: 1.5rem;
            }

            .password-container h2 {
                font-size: 1.5rem;
            }

            .password-container input {
                padding: 0.7rem;
            }

            .password-container button {
                padding: 0.7rem 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="password-container">
        <h2>Set New Password</h2>
        <form method="POST" action="">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Set Password</button>
        </form>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>