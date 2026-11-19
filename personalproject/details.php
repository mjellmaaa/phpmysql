<?php
include "config.php";

// Get the id from the URL (details.php?id=3). If it is missing, use 0.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

// Get this one destination. The ? is a placeholder that is filled in safely.
$sql = "SELECT destinations.*, categories.name AS category
        FROM destinations
        JOIN categories ON destinations.category_id = categories.id
        WHERE destinations.id = ? AND destinations.status = 'approved'";
$query = $pdo->prepare($sql);
$query->execute([$id]);
$d = $query->fetch(PDO::FETCH_ASSOC);

// If no destination was found, stop and show a message
if (!$d) {
    die("Destination not found. <a href='destinations.php'>Back to destinations</a>");
}

// Get up to 3 other destinations from the same category
$sql2 = "SELECT * FROM destinations
         WHERE category_id = ? AND id != ? AND status = 'approved'
         LIMIT 3";
$query2 = $pdo->prepare($sql2);
$query2->execute([$d['category_id'], $d['id']]);
$related = $query2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($d['name']); ?> | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
  
  <!-- Custom CSS specifically for this detail page to fix the layout -->
  <style>
    .detail-hero {
      background-size: cover;
      background-position: center;
      min-height: 60vh;
      display: flex;
      align-items: flex-end;
      padding: 4rem 2rem 2rem 2rem;
      position: relative;
    }
    .detail-title {
      max-width: 1200px;
      margin: 0 auto;
      width: 100%;
    }
    .detail-title .tag {
      background: #d4af37; /* Gold color */
      color: #101513;
      padding: 6px 16px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .detail-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(3rem, 6vw, 5rem);
      color: #fff;
      margin: 15px 0 5px 0;
      line-height: 1.1;
      text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }
    .detail-title p {
      color: #e0e0e0;
      font-size: 1.2rem;
      margin-bottom: 0;
    }
    .detail-body {
      max-width: 900px;
      margin: 4rem auto;
      padding: 0 2rem;
      color: #fff;
    }
    .detail-body h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: #d4af37;
    }
    .detail-body p {
      font-size: 1.15rem;
      line-height: 1.9;
      color: #ccc;
      margin-bottom: 3rem;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar">
    <a href="index.php" class="logo">&#9650; Explore<span>Kosovo</span></a>
    <nav>
      <a href="index.php">Home</a>
      <a href="destinations.php">Destinations</a>
      <a href="about.html">About Us</a>
      <a href="contact.html">Contact</a>
      
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" class="btn btn-gold">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php" class="btn btn-gold">Register</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- COVER PHOTO (Now with inline background properties to guarantee it works) -->
  <section class="detail-hero" style="
      background-image: linear-gradient(to bottom, rgba(16,21,19,0.2) 0%, rgba(16,21,19,0.9) 100%), url('destinationimages/<?php echo htmlspecialchars($d['image']); ?>');
  ">
    <div class="detail-title">
      <span class="tag"><?php echo htmlspecialchars($d['category']); ?></span>
      <h1><?php echo htmlspecialchars($d['name']); ?></h1>
      <p><?php echo htmlspecialchars($d['city']); ?> &nbsp;&#9733; <?php echo htmlspecialchars($d['rating']); ?></p>
    </div>
  </section>

  <!-- DESCRIPTION -->
  <section class="detail-body">
    <h2>About this place</h2>
    <p><?php echo nl2br(htmlspecialchars($d['description'])); ?></p>
    <a href="destinations.php" class="btn btn-outline">&larr; Back to all destinations</a>
  </section>

  <!-- RELATED DESTINATIONS -->
  <?php if (count($related) > 0) { ?>
  <section class="section alt">
    <h2>Related Destinations</h2>
    <p class="section-sub">More places you may like.</p>
    <div class="cards">
      <?php foreach ($related as $r) { ?>
        <article class="card">
          <img src="destinationimages/<?php echo htmlspecialchars($r['image']); ?>" alt="<?php echo htmlspecialchars($r['name']); ?>">
          <div class="card-body">
            <h3><?php echo htmlspecialchars($r['name']); ?></h3>
            <p class="place"><?php echo htmlspecialchars($r['city']); ?></p>
            <a href="details.php?id=<?php echo $r['id']; ?>" class="btn btn-outline">View Details</a>
          </div>
        </article>
      <?php } ?>
    </div>
  </section>
  <?php } ?>

  <!-- FOOTER -->
  <footer class="footer">
    <div>
      <a href="index.php" class="logo">&#9650; Explore<span>Kosovo</span></a>
      <p>Discover the beauty. Experience Kosovo.</p>
    </div>
    <div>
      <h4>Quick links</h4>
      <a href="index.php">Home</a>
      <a href="destinations.php">Destinations</a>
      <a href="login.php">Login</a>
    </div>
    <div>
      <h4>Destinations</h4>
      <a href="destinations.php">View All</a>
    </div>
    <div>
      <h4>Contact</h4>
      <p>info@explorekosovo.com</p>
      <p>Prishtina, Kosovo</p>
    </div>
    <p class="copy">&copy; 2026 ExploreKosovo. All rights reserved.</p>
  </footer>

</body>
</html>