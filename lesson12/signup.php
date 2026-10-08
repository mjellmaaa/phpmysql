<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="signup">
        <form action="form-signin" action="register.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">please sign up</h1>

            <label for="inputName" class="sr-only">Name</label>
            <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" required autofocus>

            <label for="inputSurname" class="sr-only">Surname</label>
            <input type="text" id="inputSurname" class="form-control" placeholder="Surname" name="surname" required autofocus>

            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>

            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Password" name="password" required autofocus>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">sign up</button>
            <small>already have account? <a href="login.php">sign in</a></small>

            <p class="mt-5 mb-3 text-muted">digital school &copy; 2023</p>
</form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</body>
</html>