<?php
session_start();

// Message saved by loginlogic.php (shown once, then removed)
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : "";
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">

  <section class="auth">
    <div class="auth-box">
      <a href="index.php" class="logo">&#9650; Explore<span>Kosovo</span></a>
      <h2>Welcome back</h2>
      <p>Log in to save your favorite destinations.</p>

      <?php if (isset($_GET['registered'])) { ?>
        <div class="msg msg-ok">Account created! You can log in now.</div>
      <?php } ?>

      <?php if ($error != "") { ?>
        <div class="msg msg-error"><?php echo $error; ?></div>
      <?php } ?>

      <form action="loginlogic.php" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
      </form>

      <p class="auth-link">New here? <a href="register.php">Create an account</a></p>
    </div>
  </section>

</body>
</html>
