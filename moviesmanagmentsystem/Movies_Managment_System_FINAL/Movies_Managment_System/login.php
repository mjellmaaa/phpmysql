<?php
// Start or resume session
require_once('config.php');

// If already logged in, redirect away from login page
if (isset($_SESSION['id'])) {
    if (!empty($_SESSION['is_admin']) && (int)$_SESSION['is_admin'] === 1) {
        header('Location: dashboard.php');
    } else {
        header('Location: home.php');
    }
    exit;
}

// Check for status/error messages passed via GET
$errorMessage = '';
$successMessage = '';

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'empty_fields') {
        $errorMessage = 'Please fill in all fields.';
    } elseif ($_GET['error'] === 'invalid_credentials') {
        $errorMessage = 'Invalid username or password.';
    }
}

if (isset($_GET['registered']) && $_GET['registered'] === 'success') {
    $successMessage = 'Registration successful! Please sign in.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Movie Management System</title>
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
            max-width: 360px;
            padding: 20px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 12px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body class="text-center">

<main class="form-signin">
    <form action="loginLogic.php" method="post">
        <h1 class="h3 mb-3 fw-bold text-primary">🎬 MMS Sign In</h1>

        <!-- Display dynamic error or success alerts -->
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger py-2 small" role="alert">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success py-2 small" role="alert">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" required>
            <label for="floatingInput">Username</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" name="submit">Sign in</button>
        
        <p class="mt-3 mb-1 text-muted small">
            Don't have an account? <a href="index.php" class="text-decoration-none fw-bold">Sign up</a>
        </p>
    </form>
</main>

</body>
</html>