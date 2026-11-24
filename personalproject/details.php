<?php
session_start();
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
</head>
<body>

  <?php include "header.php"; ?>

  <!-- COVER PHOTO with the destination name on top -->
  <section class="detail-hero" style="background-image:
      linear-gradient(rgba(16,21,19,0.3), rgba(16,21,19,0.95)),
      url('destinationimages/<?php echo htmlspecialchars($d['image']); ?>');">
    <div class="detail-title">
      <span class="tag"><?php echo htmlspecialchars($d['category']); ?></span>
      <h1><?php echo htmlspecialchars($d['name']); ?></h1>
      <p><?php echo htmlspecialchars($d['city']); ?> &nbsp;&#9733; <?php echo $d['rating']; ?></p>
    </div>
  </section>

  <!-- DESCRIPTION -->
  <section class="detail-body">
    <h2>About this place</h2>
    <p><?php echo htmlspecialchars($d['description']); ?></p>
    <a href="destinations.php" class="btn btn-outline">&larr; Back to destinations</a>
    <form action="favorite.php" method="post" class="inline">
      <input type="hidden" name="destination_id" value="<?php echo $d['id']; ?>">
      <button type="submit" class="btn btn-outline">&#9825; Save</button>
    </form>
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

  <footer class="footer">
    <p class="copy">&copy; 2026 ExploreKosovo. Discover the beauty. Experience Kosovo.</p>
  </footer>

</body>
</html>
