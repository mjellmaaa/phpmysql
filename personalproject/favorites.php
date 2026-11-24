<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the destinations saved by this user
$sql = "SELECT destinations.*, categories.name AS category
        FROM favorites
        JOIN destinations ON favorites.destination_id = destinations.id
        JOIN categories ON destinations.category_id = categories.id
        WHERE favorites.user_id = ?
        ORDER BY favorites.id DESC";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['user_id']]);
$favorites = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Favorites | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include "header.php"; ?>

  <section class="page-head">
    <h1>Your Favorites</h1>
    <p>Places you saved for your next trip.</p>
  </section>

  <section class="section list">
    <div class="cards">

      <?php foreach ($favorites as $d) { ?>
        <article class="card">
          <img src="destinationimages/<?php echo htmlspecialchars($d['image']); ?>" alt="<?php echo htmlspecialchars($d['name']); ?>">
          <div class="card-body">
            <span class="tag"><?php echo htmlspecialchars($d['category']); ?></span>
            <h3><?php echo htmlspecialchars($d['name']); ?></h3>
            <p class="place"><?php echo htmlspecialchars($d['city']); ?></p>
            <a href="details.php?id=<?php echo $d['id']; ?>" class="btn btn-outline">View Details</a>
            <form action="favorite.php" method="post" class="inline">
              <input type="hidden" name="destination_id" value="<?php echo $d['id']; ?>">
              <button type="submit" class="btn btn-outline">Remove</button>
            </form>
          </div>
        </article>
      <?php } ?>

      <?php if (count($favorites) == 0) { ?>
        <p>You have no favorites yet. <a href="destinations.php">Browse destinations</a></p>
      <?php } ?>

    </div>
  </section>

  <footer class="footer">
    <p class="copy">&copy; 2026 ExploreKosovo. Discover the beauty. Experience Kosovo.</p>
  </footer>
</body>
</html>
