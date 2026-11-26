<?php
session_start();

// Messages saved by registerlogic.php (shown once, then removed)
$error = isset($_SESSION['register_error']) ? $_SESSION['register_error'] : "";
$old_fullname = isset($_SESSION['old_fullname']) ? $_SESSION['old_fullname'] : "";
$old_email = isset($_SESSION['old_email']) ? $_SESSION['old_email'] : "";
unset($_SESSION['register_error'], $_SESSION['old_fullname'], $_SESSION['old_email']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">

  <section class="auth">
    <div class="auth-box">
      <a href="index.php" class="logo">&#9650; Explore<span>Kosovo</span></a>
      <h2>Create account</h2>
      <p>Save destinations, write reviews and share places you love.</p>

      <?php if ($error != "") { ?>
        <div class="msg msg-error"><?php echo $error; ?></div>
      <?php } ?>

      <form action="registerlogic.php" method="post" id="registerForm">
        <input type="text" name="fullname" placeholder="Full name" required
               value="<?php echo htmlspecialchars($old_fullname); ?>">
        <input type="email" name="email" placeholder="Email" required
               value="<?php echo htmlspecialchars($old_email); ?>">
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Confirm password" required>
        <input type="submit" value="Register">
      </form>

      <p class="auth-link">Already have an account? <a href="login.php">Login</a></p>
    </div>
  </section>

  <script src="script.js" defer></script>
</body>
</html>
