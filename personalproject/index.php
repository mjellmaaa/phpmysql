<?php session_start(); ?>
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
  <?php include "header.php"; ?>

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
      <option>Mountains</option><option>Waterfalls</option><option>Historical Places</option>
      <option>Cities</option><option>Nature</option><option>Adventure</option>
    </select>
    <button type="submit" class="btn btn-gold">Search</button>
  </form>

  <!-- FEATURED DESTINATIONS -->
  <section class="section" id="featured">
    <h2>Explore Our Beautiful Kosovo</h2>
    <p class="section-sub">Discover places that make every journey unforgettable.</p>
    <div class="cards">

      <article class="card">
        <img src="destinationimages/rugova.jpg" alt="Rugova Mountains">
        <div class="card-body">
          <span class="tag">Mountains</span>
          <h3>Rugova</h3>
          <p class="place">Peja</p>
          <p>Deep canyons, alpine peaks and some of the best hiking in the Balkans.</p>
          <a href="destinations.php" class="btn btn-outline">View Details</a>
        </div>
      </article>

      <article class="card">
        <img src="destinationimages/prizren.jpg" alt="Prizren Old Town">
        <div class="card-body">
          <span class="tag">Historical Places</span>
          <h3>Prizren</h3>
          <p class="place">Prizren</p>
          <p>Ottoman bridges, the fortress above the town and the Lumbardhi river.</p>
          <a href="destinations.php" class="btn btn-outline">View Details</a>
        </div>
      </article>

      <article class="card">
        <img src="destinationimages/brezovica.jpg" alt="Brezovica">
        <div class="card-body">
          <span class="tag">Adventure</span>
          <h3>Brezovica</h3>
          <p class="place">Shtërpcë</p>
          <p>Skiing in winter, mountain trails and fresh air in the Sharr Mountains.</p>
          <a href="destinations.php" class="btn btn-outline">View Details</a>
        </div>
      </article>

      <article class="card">
        <img src="destinationimages/mirusha.jpg" alt="Mirusha Waterfalls">
        <div class="card-body">
          <span class="tag">Waterfalls</span>
          <h3>Mirusha Waterfalls</h3>
          <p class="place">Malisheva</p>
          <p>A chain of waterfalls and turquoise pools carved into the canyon.</p>
          <a href="destinations.php" class="btn btn-outline">View Details</a>
        </div>
      </article>

      <article class="card">
        <img src="destinationimages/gadime.jpg" alt="Gadime Cave">
        <div class="card-body">
          <span class="tag">Nature</span>
          <h3>Gadime Cave</h3>
          <p class="place">Lipjan</p>
          <p>An underground world of stalactites and stalagmites near Prishtina.</p>
          <a href="destinations.php" class="btn btn-outline">View Details</a>
        </div>
      </article>

      <article class="card">
        <img src="destinationimages/germia.jpg" alt="Germia Park">
        <div class="card-body">
          <span class="tag">Nature</span>
          <h3>Germia Park</h3>
          <p class="place">Prishtina</p>
          <p>Forest walks, picnic areas and a pool, only minutes from the capital.</p>
          <a href="destinations.php" class="btn btn-outline">View Details</a>
        </div>
      </article>

    </div>
  </section>

  <!-- CATEGORIES: each card uses an image as its background -->
  <section class="section alt">
    <h2>Explore by Category</h2>
    <p class="section-sub">Choose the kind of trip you want.</p>
    <div class="categories">
      <a href="destinations.php?category=Mountains" class="cat" style="background-image:url('destinationimages/rugova.jpg')">Mountains</a>
      <a href="destinations.php?category=Waterfalls" class="cat" style="background-image:url('destinationimages/mirusha.jpg')">Waterfalls</a>
      <a href="destinations.php?category=Historical Places" class="cat" style="background-image:url('destinationimages/prizren.jpg')">Historical Places</a>
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
      <a href="destinations.php">Rugova</a>
      <a href="destinations.php">Prizren</a>
      <a href="destinations.php">Brezovica</a>
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
