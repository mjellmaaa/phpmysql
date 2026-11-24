<?php
session_start();
include "config.php";

// Only logged-in users can see this page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the logged-in user's information from the database
$query = $pdo->prepare("SELECT fullname, email, role, created_at FROM users WHERE id = ?");
$query->execute([$_SESSION['user_id']]);
$user = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include "header.php"; ?>

  <section class="page-head">
    <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?></h1>
    <p>This is your personal ExploreKosovo dashboard.</p>
  </section>

  <section class="dash">
    <div class="dash-box">
      <h3>Your profile</h3>
      <p><strong>Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      <p><strong>Member since:</strong> <?php echo date("d M Y", strtotime($user['created_at'])); ?></p>
    </div>

    <div class="dash-box">
      <h3>Quick links</h3>
      <a href="destinations.php" class="btn btn-outline">Browse destinations</a>
      <a href="logout.php" class="btn btn-outline">Logout</a>
    </div>
  </section>

  <footer class="footer">
    <p class="copy">&copy; 2026 ExploreKosovo. Discover the beauty. Experience Kosovo.</p>
  </footer>

</body>
</html>
