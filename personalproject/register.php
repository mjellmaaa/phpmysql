<?php
include "config.php";

$error = "";

// Run this code only when the form was submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullname = trim($_POST['fullname']);   // trim removes spaces at the start and end
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($fullname == "" || $email == "" || $password == "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password != $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if this email is already registered
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->fetch()) {
            $error = "This email is already registered.";
        } else {
            // Never save the real password. Save a hashed (scrambled) version.
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
            $insert->execute([$fullname, $email, $hash]);

            // Send the user to the login page
            header("Location: login.php?registered=1");
            exit;
        }
    }
}
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

      <form action="register.php" method="post">
        <input type="text" name="fullname" placeholder="Full name" required
               value="<?php if (isset($fullname)) { echo htmlspecialchars($fullname); } ?>">
        <input type="email" name="email" placeholder="Email" required
               value="<?php if (isset($email)) { echo htmlspecialchars($email); } ?>">
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Confirm password" required>
        <input type="submit" value="Register">
      </form>

      <p class="auth-link">Already have an account? <a href="login.php">Login</a></p>
    </div>
  </section>

</body>
</html>
