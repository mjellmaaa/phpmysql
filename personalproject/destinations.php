<?php
session_start();
include "config.php";

// 1. Read the filter values from the URL (empty if the visitor did not choose anything)
$q        = isset($_GET['q']) ? trim($_GET['q']) : "";
$city     = isset($_GET['city']) ? $_GET['city'] : "";
$category = isset($_GET['category']) ? $_GET['category'] : "";
$rating   = isset($_GET['rating']) ? $_GET['rating'] : "";
$sort     = isset($_GET['sort']) ? $_GET['sort'] : "name";

// 2. Build the WHERE part step by step.
//    $conditions holds the SQL pieces, $params holds the values for the ? placeholders.
$conditions = ["destinations.status = 'approved'"];
$params = [];

if ($q != "") {
    $conditions[] = "destinations.name LIKE ?";   // LIKE finds names that contain the text
    $params[] = "%" . $q . "%";                   // % means "anything before or after"
}
if ($city != "") {
    $conditions[] = "destinations.city = ?";
    $params[] = $city;
}
if ($category != "") {
    $conditions[] = "categories.name = ?";
    $params[] = $category;
}
if ($rating != "") {
    $conditions[] = "destinations.rating >= ?";
    $params[] = $rating;
}

// 3. Choose the ORDER BY part. We only allow these 3 choices (never put $_GET directly in SQL).
if ($sort == "rating") {
    $orderBy = "destinations.rating DESC";
} elseif ($sort == "newest") {
    $orderBy = "destinations.created_at DESC";
} else {
    $sort = "name";
    $orderBy = "destinations.name ASC";
}

// 4. Put everything together. implode joins the conditions with AND.
$sql = "SELECT destinations.*, categories.name AS category
        FROM destinations
        JOIN categories ON destinations.category_id = categories.id
        WHERE " . implode(" AND ", $conditions) . "
        ORDER BY " . $orderBy;

$query = $pdo->prepare($sql);
$query->execute($params);
$destinations = $query->fetchAll(PDO::FETCH_ASSOC);

// Lists for the dropdowns (they update automatically when the admin adds destinations)
$cities = $pdo->query("SELECT DISTINCT city FROM destinations WHERE status = 'approved' ORDER BY city")->fetchAll(PDO::FETCH_COLUMN);
$categories = $pdo->query("SELECT name FROM categories ORDER BY name")->fetchAll(PDO::FETCH_COLUMN);

// True when at least one filter is used (to show the "Clear filters" link)
$filtered = ($q != "" || $city != "" || $category != "" || $rating != "");
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

  <?php include "header.php"; ?>

  <section class="page-head">
    <h1>Discover Destinations</h1>
    <p>Browse mountains, waterfalls, old towns and hidden gems across Kosovo.</p>
  </section>

  <!-- SEARCH AND FILTERS: the form sends the values in the URL (method="get") -->
  <form class="filters" action="destinations.php" method="get">
    <input type="text" name="q" placeholder="Search by name..." value="<?php echo htmlspecialchars($q); ?>">

    <select name="city">
      <option value="">All cities</option>
      <?php foreach ($cities as $c) { ?>
        <option value="<?php echo htmlspecialchars($c); ?>" <?php if ($city == $c) { echo "selected"; } ?>>
          <?php echo htmlspecialchars($c); ?>
        </option>
      <?php } ?>
    </select>

    <select name="category">
      <option value="">All categories</option>
      <?php foreach ($categories as $c) { ?>
        <option value="<?php echo htmlspecialchars($c); ?>" <?php if ($category == $c) { echo "selected"; } ?>>
          <?php echo htmlspecialchars($c); ?>
        </option>
      <?php } ?>
    </select>

    <select name="rating">
      <option value="">Any rating</option>
      <option value="4" <?php if ($rating == "4") { echo "selected"; } ?>>4 stars and up</option>
      <option value="3" <?php if ($rating == "3") { echo "selected"; } ?>>3 stars and up</option>
    </select>

    <select name="sort">
      <option value="name" <?php if ($sort == "name") { echo "selected"; } ?>>Sort by name</option>
      <option value="rating" <?php if ($sort == "rating") { echo "selected"; } ?>>Highest rated</option>
      <option value="newest" <?php if ($sort == "newest") { echo "selected"; } ?>>Newest</option>
    </select>

    <button type="submit" class="btn btn-gold">Filter</button>
  </form>

  <p class="results">
    <?php echo count($destinations); ?> destination(s) found
    <?php if ($filtered) { ?> &middot; <a href="destinations.php">Clear filters</a><?php } ?>
  </p>

  <section class="section list">
    <div class="cards">

      <?php foreach ($destinations as $d) { ?>
        <article class="card">
          <img src="destinationimages/<?php echo htmlspecialchars($d['image']); ?>" alt="<?php echo htmlspecialchars($d['name']); ?>">
          <div class="card-body">
            <span class="tag"><?php echo htmlspecialchars($d['category']); ?></span>
            <h3><?php echo htmlspecialchars($d['name']); ?></h3>
            <p class="place"><?php echo htmlspecialchars($d['city']); ?> &nbsp;&#9733; <?php echo $d['rating']; ?></p>
            <p><?php echo htmlspecialchars($d['description']); ?></p>
            <a href="details.php?id=<?php echo $d['id']; ?>" class="btn btn-outline">View Details</a>
            <form action="favorite.php" method="post" class="inline">
              <input type="hidden" name="destination_id" value="<?php echo $d['id']; ?>">
              <button type="submit" class="btn btn-outline">&#9825; Save</button>
            </form>
          </div>
        </article>
      <?php } ?>

      <?php if (count($destinations) == 0) { ?>
        <p>No destinations found. Try different filters.</p>
      <?php } ?>

    </div>
  </section>

  <footer class="footer">
    <p class="copy">&copy; 2026 ExploreKosovo. Discover the beauty. Experience Kosovo.</p>
  </footer>

</body>
</html>
