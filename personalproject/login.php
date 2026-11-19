<?php
session_start();
// If the user is already logged in, redirect them to the dashboard
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
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
  <style>
    /* Specific styling for the Auth forms */
    .auth-container {
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    .auth-box {
      background: #1a221f;
      padding: 3rem;
      border-radius: 12px;
      width: 100%;
      max-width: 450px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .auth-box h2 {
      font-family: 'Playfair Display', serif;
      color: #fff;
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
      text-align: center;
    }
    .auth-box p.sub {
      color: #ccc;
      text-align: center;
      margin-bottom: 2rem;
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-group label {
      display: block;
      color: #e0e0e0;
      margin-bottom: 0.5rem;
      font-size: 0.9rem;
    }
    .form-group input {
      width: 100%;
      padding: 12px 15px;
      border-radius: 6px;
      border: 1px solid #333;
      background: #101513;
      color: #fff;
      font-family: 'Inter', sans-serif;
    }
    .form-group input:focus {
      outline: none;
      border-color: #d4af37;
    }
    .auth-box .btn {
      width: 100%;
      padding: 14px;
      font-size: 1rem;
      margin-top: 1rem;
    }
    .auth-links {
      text-align: center;
      margin-top: 1.5rem;
      color: #888;
      font-size: 0.9rem;
    }
    .auth-links a {
      color: #d4af37;
      text-decoration: none;
    }
    .error-msg {
      background: #ff333322;
      color: #ff6666;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 1.5rem;
      text-align: center;
      border: 1px solid #ff333344;
    }
  </style>
</head>
<body>

  <header class="navbar">
    <a href="index.php" class="logo">&#9650; Explore<span>Kosovo</span></a>
    <nav>
      <a href="index.php">Home</a>
      <a href="destinations.php">Destinations</a>
      <a href="login.php" class="btn btn-gold">Login</a>
    </nav>
  </header>

  <div class="auth-container">
    <div class="auth-box">
      <h2>Welcome Back</h2>
      <p class="sub">Log in to manage your destinations and favorites.</p>

      <!-- Show error message if login fails -->
      <?php if(isset($_SESSION['error'])): ?>
        <div class="error-msg">
          <?php 
            echo htmlspecialchars($_SESSION['error']); 
            unset($_SESSION['error']); 
          ?>
        </div>
      <?php endif; ?>

      <form action="loginlogic.php" method="POST">
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" required placeholder="you@example.com">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn btn-gold">Log In</button>
      </form>

      <div class="auth-links">
        Don't have an account? <a href="register.php">Register here</a>
      </div>
    </div>
  </div>

</body>
</html>