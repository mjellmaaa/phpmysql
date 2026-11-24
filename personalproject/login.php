<?php
// Sessions must be started before using $_SESSION
session_start();
include "config.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Find the user with this email
    $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // password_verify compares the typed password with the saved hash
    if ($user && password_verify($password, $user['password'])) {
        // Save the user's info in the session (it stays while they browse)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];

        header("Location: destinations.php");
        exit;
    } else {
        $error = "Wrong email or password.";
    }
}
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

      <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
      </form>

      <p class="auth-link">New here? <a href="register.php">Create an account</a></p>
    </div>
  </section>

</body>
</html>
