<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
<style>
    body {
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .login {
        width: 100%;
        max-width: 400px;
        padding: 25px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .login h1 {
        text-align: center;
        font-size: 26px;
        margin-bottom: 25px !important;
    }

    .login .form-control {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 6px;
    }

    .login button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
    }

    .login small {
        display: block;
        text-align: center;
    }

    .login p {
        text-align: center;
        margin-top: 25px !important;
        margin-bottom: 0 !important;
    }
</style>

</head>
<body>
    <div class="login">
        <form action="form-signin" action="loginLogic.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign In</button>

            <small>Don't have account ? <a href="signup.php">Sign up</a></small>

            <p class="mt-5 mb-3 text-muted">Digital school &copy; 2023</p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
