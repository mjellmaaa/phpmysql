<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$error = "";

// Categories for the dropdown
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = trim($_POST['name']);
    $city = trim($_POST['city']);
    $category_id = $_POST['category_id'];
    $description = trim($_POST['description']);
    $image = trim($_POST['image']);   // file name from the destinationimages folder

    if ($name == "" || $city == "" || $image == "") {
        $error = "Name, city and image are required.";
    } else {
        // CREATE: insert the new destination
        $sql = "INSERT INTO destinations (name, city, category_id, description, image)
                VALUES (?, ?, ?, ?, ?)";
        $pdo->prepare($sql)->execute([$name, $city, $category_id, $description, $image]);

        header("Location: admin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add destination | ExploreKosovo</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include "header.php"; ?>

  <section class="page-head">
    <h1>Add Destination</h1>
  </section>

  <section class="admin">
    <?php if ($error != "") { ?><div class="msg msg-error"><?php echo $error; ?></div><?php } ?>

    <form action="adddestination.php" method="post" class="admin-form">
      <input type="text" name="name" placeholder="Destination name" required>
      <input type="text" name="city" placeholder="City" required>
      <select name="category_id">
        <?php foreach ($categories as $c) { ?>
          <option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
        <?php } ?>
      </select>
      <textarea name="description" placeholder="Description" rows="5"></textarea>
      <input type="text" name="image" placeholder="Image file name, e.g. rugova.jpg" required>
      <input type="submit" value="Save destination">
    </form>
  </section>
</body>
</html>
