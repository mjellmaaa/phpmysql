<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="login">
        <form action="form-signin" action="loginLogic.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">please sign in</h1>

            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Password" name="password" required autofocus>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">sign in</button>
            <small>dont have account? <a href="signup.php">sign up</a></small>

            <p class="mt-5 mb-3 text-muted">digital school &copy; 2023</p>
</form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</body>
</html>