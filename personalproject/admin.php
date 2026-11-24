<?php
session_start();
include "config.php";

// Only admins can see this page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// READ: get all destinations (also pending ones) with their category
$sql = "SELECT destinations.*, categories.name AS category
        FROM destinations
        JOIN categories ON destinations.category_id = categories.id
        ORDER BY destinations.id DESC";
$destinations = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include "header.php"; ?>

  <section class="page-head">
    <h1>Admin Dashboard</h1>
    <p>Manage destinations.</p>
  </section>

  <section class="admin">
    <a href="adddestination.php" class="btn btn-gold">+ Add destination</a>

    <table>
      <tr><th>ID</th><th>Name</th><th>City</th><th>Category</th><th>Status</th><th>Actions</th></tr>

      <?php foreach ($destinations as $d) { ?>
      <tr>
        <td><?php echo $d['id']; ?></td>
        <td><?php echo htmlspecialchars($d['name']); ?></td>
        <td><?php echo htmlspecialchars($d['city']); ?></td>
        <td><?php echo htmlspecialchars($d['category']); ?></td>
        <td><?php echo $d['status']; ?></td>
        <td>
          <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn btn-outline">Edit</a>
          <!-- DELETE uses a small form; onsubmit asks for confirmation first -->
          <form action="delete.php" method="post" class="inline"
                onsubmit="return confirm('Delete this destination?');">
            <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
            <button type="submit" class="btn btn-outline">Delete</button>
          </form>
        </td>
      </tr>
      <?php } ?>
    </table>
  </section>
</body>
</html>
