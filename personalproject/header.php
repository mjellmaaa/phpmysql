<!-- Shared navbar. Every page includes this file, so we write it only once. -->
<!-- The page that includes this file must call session_start() at the very top. -->
<header class="navbar">
  <a href="index.php" class="logo">&#9650; Explore<span>Kosovo</span></a>
  <nav>
    <a href="index.php">Home</a>
    <a href="destinations.php">Destinations</a>

    <?php if (isset($_SESSION['user_id'])) { ?>
      <!-- Shown when the user IS logged in -->
      <a href="favorites.php">Favorites</a>
      <?php if ($_SESSION['role'] == 'admin') { ?>
        <a href="admin.php">Admin</a>
      <?php } ?>
      <a href="dashboard.php"><?php echo htmlspecialchars($_SESSION['fullname']); ?></a>
      <a href="logout.php" class="btn btn-gold">Logout</a>
    <?php } else { ?>
      <!-- Shown when the user is NOT logged in -->
      <a href="login.php">Login</a>
      <a href="register.php" class="btn btn-gold">Register</a>
    <?php } ?>
  </nav>
</header>
