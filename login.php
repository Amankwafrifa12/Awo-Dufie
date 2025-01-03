<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'blog_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, password, is_first_login FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $is_first_login);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if ($is_first_login && $password === 'geniedevgh') {
            $_SESSION['admin_id'] = $id;
            header("Location: set_password.php");
            exit();
        } elseif (password_verify($password, $hashed_password)) {
            $_SESSION['admin_id'] = $id;
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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

        .login-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 1.5rem;
            color: #003366;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .login-container input {
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .login-container button {
            padding: 0.8rem 1.5rem;
            background-color: #003366;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: #00509e;
        }

        .error {
            color: red;
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 1.5rem;
            }

            .login-container h2 {
                font-size: 1.5rem;
            }

            .login-container input {
                padding: 0.7rem;
            }

            .login-container button {
                padding: 0.7rem 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>