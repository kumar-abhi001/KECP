<?php
include "../../database/db.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];
            if ($_SESSION['is_admin'] == 1) {
                header("Location: adminDashboard.php");
            } else {
                header("Location: index.php");
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
    $conn->close();
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: #");
    exit();
}


$is_logged_in = isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <?php if ($is_logged_in): ?>
        <div class="container mt-5">
            <h2 class="text-center">Welcome to the Admin Dashboard</h2>
            <div class="text-center">
                <a href="?logout=true" class="btn btn-danger">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <div class="login-container">
            <h2>Admin Login</h2>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger text-center"><?= $error_message ?></div>
            <?php endif; ?>
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    <?php endif; ?>

</body>

</html>