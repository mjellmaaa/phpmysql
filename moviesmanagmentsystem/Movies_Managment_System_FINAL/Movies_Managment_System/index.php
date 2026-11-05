<?php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
        }

        .form-floating {
            margin: 10px 0;
        }
    </style>
</head>
<body class="text-center">
    <main class="form-signin">
        <form action="register.php" method="post">
            <img class="mb-4" src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Register</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="emriInput" placeholder="Emri" name="emri" required>
                <label for="emriInput">Emri</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="usernameInput" placeholder="Username" name="username" required>
                <label for="usernameInput">Username</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" id="emailInput" placeholder="Email" name="email" required>
                <label for="emailInput">Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password" required>
                <label for="passwordInput">Password</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="confirmPasswordInput" placeholder="Confirm Password" name="confirm_password" required>
                <label for="confirmPasswordInput">Confirm Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign up</button>
            <span>Already have an account: </span><a href="login.php">Sign in</a>
        </form>
    </main>
</body>
</html>