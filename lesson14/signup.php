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
        padding: 20px;
    }

    .signup {
        width: 100%;
        max-width: 420px;
        padding: 25px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .signup h1 {
        text-align: center;
        font-size: 26px;
        margin-bottom: 20px !important;
    }

    .signup .form-control {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 15px;
    }

    .signup .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    }

    .signup button {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 6px;
        margin-top: 5px;
        margin-bottom: 15px;
    }

    .signup small {
        display: block;
        text-align: center;
        font-size: 14px;
    }

    .signup p {
        text-align: center;
        margin-top: 25px !important;
        margin-bottom: 0 !important;
        font-size: 14px;
    }

    @media (max-width: 480px) {
        .signup {
            padding: 20px;
        }

        .signup h1 {
            font-size: 23px;
        }
    }
</style>

</head>
<body>

    <div class="signup">
        <form class="form-signin" action="register.php" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>

            <label for="inputName" class="sr-only">Name</label>
            <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" required autofocus>

            <label for="inputSurame" class="sr-only">Surname</label>
            <input type="text" id="inputSurame" class="form-control" placeholder="Surname" name="surname" required autofocus>

            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>

            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required autofocus>

            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign up</button>

            <small>Already have account? <a href="login.php">Log in</a></small>

            <p class="mt-5 mb-3 text-muted">Digital school &copy; 2023</p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>