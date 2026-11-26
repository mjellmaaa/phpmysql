<?php
session_start();
include "config.php";

// Read filter values from the URL
$q              = isset($_GET['q']) ? trim($_GET['q']) : "";
$destination_id = isset($_GET['destination_id']) ? $_GET['destination_id'] : "";
$type           = isset($_GET['type']) ? $_GET['type'] : "";

$conditions = ["1=1"];
$params = [];

if ($q != "") {
    $conditions[] = "(stays.name LIKE ? OR stays.location LIKE ?)";
    $params[] = "%" . $q . "%";
    $params[] = "%" . $q . "%";
}
if ($destination_id != "") {
    $conditions[] = "stays.destination_id = ?";
    $params[] = $destination_id;
}
if ($type != "") {
    $conditions[] = "stays.type = ?";
    $params[] = $type;
}

$sql = "SELECT stays.*, destinations.name AS destination_name, destinations.city, destinations.image
        FROM stays
        JOIN destinations ON stays.destination_id = destinations.id
        WHERE " . implode(" AND ", $conditions) . "
        ORDER BY stays.destination_id ASC, stays.price ASC";

$query = $pdo->prepare($sql);
$query->execute($params);
$stays = $query->fetchAll(PDO::FETCH_ASSOC);

// Dropdown options
$destinationsList = $pdo->query("SELECT id, name, city FROM destinations WHERE status = 'approved' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$typesList = $pdo->query("SELECT DISTINCT type FROM stays ORDER BY type")->fetchAll(PDO::FETCH_COLUMN);

$filtered = ($q != "" || $destination_id != "" || $type != "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include "header.php"; ?>

  <section class="page-head">
    <h1>Book Your Stay in Kosovo</h1>
    <p>Real villas, mountain chalets, guesthouses, and hotels near every destination.</p>
  </section>

  <!-- SEARCH AND FILTERS -->
  <form class="filters" action="booking.php" method="get">
    <input type="text" name="q" placeholder="Search villa or hotel..." value="<?php echo htmlspecialchars($q); ?>">

    <select name="destination_id">
      <option value="">All destinations</option>
      <?php foreach ($destinationsList as $dest) { ?>
        <option value="<?php echo $dest['id']; ?>" <?php if ($destination_id == $dest['id']) { echo "selected"; } ?>>
          <?php echo htmlspecialchars($dest['name']); ?> (<?php echo htmlspecialchars($dest['city']); ?>)
        </option>
      <?php } ?>
    </select>

    <select name="type">
      <option value="">All stay types</option>
      <?php foreach ($typesList as $t) { ?>
        <option value="<?php echo htmlspecialchars($t); ?>" <?php if ($type == $t) { echo "selected"; } ?>>
          <?php echo htmlspecialchars($t); ?>
        </option>
      <?php } ?>
    </select>

    <button type="submit" class="btn btn-gold">Filter</button>
  </form>

  <p class="results">
    <?php echo count($stays); ?> stay(s) found
    <?php if ($filtered) { ?> &middot; <a href="booking.php">Clear filters</a><?php } ?>
  </p>

  <!-- STAYS GRID -->
  <section class="section list">
    <div class="cards">

      <?php foreach ($stays as $s) { ?>
        <article class="card">
          <img src="destinationimages/<?php echo htmlspecialchars($s['image']); ?>" alt="<?php echo htmlspecialchars($s['name']); ?>">
          <div class="card-body">
            <span class="tag"><?php echo htmlspecialchars($s['type']); ?></span>
            <h3><?php echo htmlspecialchars($s['name']); ?></h3>
            <p class="place">
              Near <?php echo htmlspecialchars($s['destination_name']); ?> (<?php echo htmlspecialchars($s['city']); ?>)
              &middot; &euro;<?php echo $s['price']; ?>/night
            </p>
            <p><?php echo htmlspecialchars($s['location']); ?></p>
            <a href="<?php echo htmlspecialchars($s['booking_url']); ?>" target="_blank" class="btn btn-outline">Book on Booking.com</a>
            <a href="https://www.airbnb.com/s/<?php echo urlencode($s['city'] . ' Kosovo'); ?>/homes" target="_blank" class="btn btn-outline">Airbnb</a>
            <a href="details.php?id=<?php echo $s['destination_id']; ?>" class="btn btn-outline">Destination</a>
          </div>
        </article>
      <?php } ?>

      <?php if (count($stays) == 0) { ?>
        <p>No stays found. Try different filters.</p>
      <?php } ?>

    </div>
  </section>

  <footer class="footer">
    <p class="copy">&copy; 2026 ExploreKosovo. Discover the beauty. Experience Kosovo.</p>
  </footer>

</body>
</html>
