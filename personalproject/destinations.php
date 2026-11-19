<?php
// Connect to the database
include "config.php";

// 1. Base query
$sql = "SELECT destinations.*, categories.name AS category
        FROM destinations
        JOIN categories ON destinations.category_id = categories.id
        WHERE destinations.status = 'approved'";

// 2. Array to hold our dynamic search parameters
$params = [];

// 3. Check if the user typed something in the Search Bar
if (!empty($_GET['q'])) {
    $sql .= " AND destinations.name LIKE :search";
    $params[':search'] = "%" . $_GET['q'] . "%";
}

// 4. Check if the user selected a City
if (!empty($_GET['city'])) {
    $sql .= " AND destinations.city = :city";
    $params[':city'] = $_GET['city'];
}

// 5. Check if the user selected a Category
// Note: Because your DB has category names in the `categories` table, we filter by the category NAME here.
if (!empty($_GET['category'])) {
    $sql .= " AND categories.name = :category";
    $params[':category'] = $_GET['category'];
}

// 6. Handle Sorting
$sort = $_GET['sort'] ?? 'name'; // Default to sorting by name
if ($sort === 'rating') {
    $sql .= " ORDER BY destinations.rating DESC";
} else {
    $sql .= " ORDER BY destinations.name ASC";
}

// 7. Execute the query securely using prepared statements
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinations | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- NAVBAR (Links updated to .php) -->
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

  <section class="page-head">
    <h1>Discover Destinations</h1>
    <p>Browse mountains, waterfalls, old towns and hidden gems across Kosovo.</p>
  </section>

  <!-- Filters (Now fully functional!) -->
  <form class="filters" action="destinations.php" method="get">
    <!-- Retain the search text if the user typed something -->
    <input type="text" name="q" placeholder="Search by name..." value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
    
    <select name="city">
      <option value="">All cities</option>
      <!-- Keep the selected city active after filtering -->
      <option <?php if(($_GET['city'] ?? '') == 'Peja') echo 'selected'; ?>>Peja</option>
      <option <?php if(($_GET['city'] ?? '') == 'Prizren') echo 'selected'; ?>>Prizren</option>
      <option <?php if(($_GET['city'] ?? '') == 'Shtërpcë') echo 'selected'; ?>>Shtërpcë</option>
      <option <?php if(($_GET['city'] ?? '') == 'Malisheva') echo 'selected'; ?>>Malisheva</option>
      <option <?php if(($_GET['city'] ?? '') == 'Lipjan') echo 'selected'; ?>>Lipjan</option>
      <option <?php if(($_GET['city'] ?? '') == 'Prishtina') echo 'selected'; ?>>Prishtina</option>
    </select>
    
    <select name="category">
      <option value="">All categories</option>
      <option <?php if(($_GET['category'] ?? '') == 'Mountains') echo 'selected'; ?>>Mountains</option>
      <option <?php if(($_GET['category'] ?? '') == 'Waterfalls') echo 'selected'; ?>>Waterfalls</option>
      <option <?php if(($_GET['category'] ?? '') == 'Historical Places') echo 'selected'; ?>>Historical Places</option>
      <option <?php if(($_GET['category'] ?? '') == 'Cities') echo 'selected'; ?>>Cities</option>
      <option <?php if(($_GET['category'] ?? '') == 'Nature') echo 'selected'; ?>>Nature</option>
      <option <?php if(($_GET['category'] ?? '') == 'Adventure') echo 'selected'; ?>>Adventure</option>
    </select>
    
    <select name="sort">
      <option value="name" <?php if(($_GET['sort'] ?? '') == 'name') echo 'selected'; ?>>Sort by name</option>
      <option value="rating" <?php if(($_GET['sort'] ?? '') == 'rating') echo 'selected'; ?>>Highest rated</option>
    </select>
    
    <button type="submit" class="btn btn-gold">Filter</button>
    <!-- Add a clear button if filters are active -->
    <?php if(!empty($_GET)): ?>
      <a href="destinations.php" class="btn btn-outline" style="margin-left: 10px;">Clear Filters</a>
    <?php endif; ?>
  </form>

  <section class="section list">
    <div class="cards">

      <?php foreach ($destinations as $d) { ?>
        <article class="card">
          <img src="destinationimages/<?php echo htmlspecialchars($d['image']); ?>" alt="<?php echo htmlspecialchars($d['name']); ?>">
          <div class="card-body">
            <span class="tag"><?php echo htmlspecialchars($d['category']); ?></span>
            <h3><?php echo htmlspecialchars($d['name']); ?></h3>
            <p class="place"><?php echo htmlspecialchars($d['city']); ?> &nbsp;&#9733; <?php echo htmlspecialchars($d['rating']); ?></p>
            <p><?php echo htmlspecialchars($d['description']); ?></p>
            <a href="details.php?id=<?php echo $d['id']; ?>" class="btn btn-outline">View Details</a>
          </div>
        </article>
      <?php } ?>

      <?php if (count($destinations) == 0) { ?>
        <p style="width: 100%; text-align: center; padding: 2rem;">No destinations found matching your search. Try adjusting your filters.</p>
      <?php } ?>

    </div>
  </section>

  <!-- Footer (updated links) -->
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