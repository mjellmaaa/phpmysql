<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Error message saved by update.php (shown once, then removed)
$error = isset($_SESSION['edit_error']) ? $_SESSION['edit_error'] : "";
unset($_SESSION['edit_error']);

$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

// READ the destination so the form is filled in
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$query = $pdo->prepare("SELECT * FROM destinations WHERE id = ?");
$query->execute([$id]);
$d = $query->fetch(PDO::FETCH_ASSOC);

if (!$d) {
    die("Destination not found. <a href='admin.php'>Back</a>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit destination | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include "header.php"; ?>

  <section class="page-head">
    <h1>Edit Destination</h1>
  </section>

  <section class="admin">
    <?php if ($error != "") { ?><div class="msg msg-error"><?php echo $error; ?></div><?php } ?>

    <form action="update.php" method="post" class="admin-form">
      <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
      <input type="text" name="name" value="<?php echo htmlspecialchars($d['name']); ?>" required>
      <input type="text" name="city" value="<?php echo htmlspecialchars($d['city']); ?>" required>
      <select name="category_id">
        <?php foreach ($categories as $c) { ?>
          <option value="<?php echo $c['id']; ?>" <?php if ($c['id'] == $d['category_id']) { echo "selected"; } ?>>
            <?php echo $c['name']; ?>
          </option>
        <?php } ?>
      </select>
      <textarea name="description" rows="5"><?php echo htmlspecialchars($d['description']); ?></textarea>
      <input type="text" name="image" value="<?php echo htmlspecialchars($d['image']); ?>" required>
      <select name="status">
        <option value="approved" <?php if ($d['status'] == 'approved') { echo "selected"; } ?>>approved</option>
        <option value="pending" <?php if ($d['status'] == 'pending') { echo "selected"; } ?>>pending</option>
      </select>
      <input type="submit" value="Update destination">
    </form>
  </section>
</body>
</html>
