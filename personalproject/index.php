<?php
// 1. Connect to the database
require_once 'config.php';

// 2. Fetch the 6 newest destinations and join the categories table to get the category name
$sql = "SELECT destinations.*, categories.name AS category_name 
        FROM destinations 
        LEFT JOIN categories ON destinations.category_id = categories.id 
        LIMIT 6";
$stmt = $pdo->query($sql);
$destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ExploreKosovo | Discover the beauty. Experience Kosovo.</title>
  <!-- Two Google fonts: Playfair Display (elegant headings) and Inter (clean body text) -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
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
      
      <!-- Dynamic Login/Register vs Dashboard/Logout -->
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" class="btn btn-gold">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php" class="btn btn-gold">Register</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <p class="subtitle">Discover the hidden beauty of the Balkans</p>
      <h1>Discover <span>Kosovo.</span></h1>
      <p class="hero-text">From breathtaking mountains to historic cities, discover places worth remembering.</p>
      <a href="destinations.php" class="btn btn-gold">Explore Destinations</a>
      <a href="#featured" class="btn btn-glass">Discover More</a>
    </div>
  </section>

  <!-- SEARCH -->
  <form class="search" action="destinations.php" method="get">
    <input type="text" name="q" placeholder="Where would you like to explore?">
    <select name="city">
      <option value="">All locations</option>
      <option>Peja</option><option>Prizren</option><option>Shtërpcë</option>
      <option>Malisheva</option><option>Lipjan</option><option>Prishtina</option>
    </select>
    <select name="category">
      <option value="">All categories</option>
      <!-- In a fully dynamic site, you would fetch these from the DB too -->
      <option value="1">Mountains</option>
      <option value="2">Waterfalls</option>
      <option value="3">Historical Places</option>
      <option value="4">Cities</option>
      <option value="5">Nature</option>
      <option value="6">Adventure</option>
    </select>
    <button type="submit" class="btn btn-gold">Search</button>
  </form>

  <!-- FEATURED DESTINATIONS -->
  <section class="section" id="featured">
    <h2>Explore Our Beautiful Kosovo</h2>
    <p class="section-sub">Discover places that make every journey unforgettable.</p>
    <div class="cards">

      <!-- DYNAMIC PHP LOOP -->
      <?php if(count($destinations) > 0): ?>
        <?php foreach($destinations as $dest): ?>
          <article class="card">
            <!-- Images are inside destinationimages/ folder -->
            <img src="destinationimages/<?= htmlspecialchars($dest['image']) ?>" alt="<?= htmlspecialchars($dest['name']) ?>">
            <div class="card-body">
              <!-- Displays category from the JOIN, and rating -->
              <span class="tag"><?= htmlspecialchars($dest['category_name'] ?? 'Uncategorized') ?> • <?= htmlspecialchars($dest['rating']) ?>★</span>
              <h3><?= htmlspecialchars($dest['name']) ?></h3>
              <p class="place"><?= htmlspecialchars($dest['city']) ?></p>
              <p><?= htmlspecialchars($dest['description']) ?></p>
              <!-- Dynamic link passes the ID: details.php?id=1 -->
              <a href="details.php?id=<?= $dest['id'] ?>" class="btn btn-outline">View Details</a>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No destinations found. Please add some in the database!</p>
      <?php endif; ?>

    </div>
  </section>

  <!-- CATEGORIES -->
  <section class="section alt">
    <h2>Explore by Category</h2>
    <p class="section-sub">Choose the kind of trip you want.</p>
    <div class="categories">
      <!-- Keep your custom background images here, just update links -->
      <a href="destinations.php?category=Mountains" class="cat" style="background-image:url('destinationimages/rugova.jpg')">Mountains</a>
      <a href="destinations.php?category=Waterfalls" class="cat" style="background-image:url('destinationimages/mirusha.jpg')">Waterfalls</a>
      <a href="destinations.php?category=Historical%20Places" class="cat" style="background-image:url('destinationimages/prizren.jpg')">Historical Places</a>
      <a href="destinations.php?category=Cities" class="cat" style="background-image:url('destinationimages/germia.jpg')">Cities</a>
      <a href="destinations.php?category=Nature" class="cat" style="background-image:url('destinationimages/gadime.jpg')">Nature</a>
      <a href="destinations.php?category=Adventure" class="cat" style="background-image:url('destinationimages/brezovica.jpg')">Adventure</a>
    </div>
  </section>

  <!-- WHY KOSOVO -->
  <section class="section">
    <h2>Why Explore Kosovo?</h2>
    <div class="why">
      <div><h3>Incredible landscapes</h3><p>Alpine peaks, canyons and rivers within a few hours of each other.</p></div>
      <div><h3>Rich cultural heritage</h3><p>Ottoman towns, medieval monasteries and living traditions.</p></div>
      <div><h3>Hidden destinations</h3><p>Waterfalls, caves and villages most travellers never see.</p></div>
      <div><h3>Memorable experiences</h3><p>Local food, warm hospitality and stories you will want to tell.</p></div>
    </div>
  </section>

  <!-- CALL TO ACTION -->
  <section class="cta">
    <h2>Your Next Adventure Starts Here.</h2>
    <p>Discover new places, create unforgettable memories and experience Kosovo.</p>
    <a href="destinations.php" class="btn btn-gold">Start Exploring</a>
  </section>

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
      <a href="details.php?id=1">Rugova</a>
      <a href="details.php?id=2">Prizren</a>
      <a href="details.php?id=3">Brezovica</a>
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