<?php include("header.php");?>
<div class="login">
        <form action="form-signin" action="loginLogic.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="username" name="username" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign In</button>

            <small>Don't have account ? <a href="signup.php">Sign up</a></small>

            <p class="mt-5 mb-3 text-muted">Digital school &copy; 2023</p>
        </form>
    </div>
    <?php include("footer.php");?>
