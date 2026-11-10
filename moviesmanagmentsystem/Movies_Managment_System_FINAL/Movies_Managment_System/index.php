<?php
/**
 * Sign Up & Landing Page
 * Project: Movie Management System (MMS)
 */
require_once('config.php');

// If user is already logged in, redirect them directly to home.php or dashboard.php
if (isset($_SESSION['id'])) {
    if (!empty($_SESSION['is_admin']) && ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] === 'true')) {
        header("Location: dashboard.php");
    } else {
        header("Location: home.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Movie Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f8f9fa;
        }
        .form-signin {
            width: 100%;
            max-width: 380px;
            padding: 24px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        .form-floating {
            margin: 8px 0;
        }
    </style>
</head>
<body class="text-center">
    <main class="form-signin">
        <form action="register.php" method="post">
            <h1 class="h3 mb-3 fw-bold text-primary">🎬 MMS Sign Up</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="emriInput" placeholder="Full Name" name="emri" required>
                <label for="emriInput">Full Name</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="usernameInput" placeholder="Username" name="username" required>
                <label for="usernameInput">Username</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" id="emailInput" placeholder="name@example.com" name="email" required>
                <label for="emailInput">Email address</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password" minlength="6" required>
                <label for="passwordInput">Password</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="confirmPasswordInput" placeholder="Confirm Password" name="confirm_password" minlength="6" required>
                <label for="confirmPasswordInput">Confirm Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" name="submit">Create Account</button>
            <p class="mt-3 mb-0 text-muted small">
                Already have an account? <a href="login.php" class="text-decoration-none fw-bold">Sign in</a>
            </p>
        </form>
    </main>
</body>
</html>