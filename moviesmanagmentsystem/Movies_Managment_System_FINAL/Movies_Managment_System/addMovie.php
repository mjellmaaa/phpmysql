<?php
session_start();
include_once('config.php');

if (empty($_SESSION['username']) || ($_SESSION['is_admin'] ?? 0) != 1) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $movie_name    = trim($_POST['movie_name'] ?? '');
    $movie_desc    = trim($_POST['movie_desc'] ?? '');
    $movie_quality = trim($_POST['movie_quality'] ?? '');
    $movie_rating  = trim($_POST['movie_rating'] ?? '');

    if ($movie_name === '' || $movie_desc === '' || $movie_quality === '' || $movie_rating === ''
        || !isset($_FILES['movie_image']) || $_FILES['movie_image']['error'] !== UPLOAD_ERR_OK) {
        header("Location: dashboard.php?error=empty");
        exit;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $ext = strtolower(pathinfo($_FILES['movie_image']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed) || getimagesize($_FILES['movie_image']['tmp_name']) === false) {
        header("Location: dashboard.php?error=image");
        exit;
    }

    $movie_image = uniqid('movie_', true) . '.' . $ext;
    $target = __DIR__ . '/movie_images/' . $movie_image;

    if (!move_uploaded_file($_FILES['movie_image']['tmp_name'], $target)) {
        header("Location: dashboard.php?error=upload");
        exit;
    }

    try {
        $sql = "INSERT INTO movies (movie_name, movie_desc, movie_quality, movie_rating, movie_image)
                VALUES (:movie_name, :movie_desc, :movie_quality, :movie_rating, :movie_image)";

        $insertMovie = $conn->prepare($sql);

        $insertMovie->bindParam(':movie_name', $movie_name);
        $insertMovie->bindParam(':movie_desc', $movie_desc);
        $insertMovie->bindParam(':movie_quality', $movie_quality);
        $insertMovie->bindParam(':movie_rating', $movie_rating);
        $insertMovie->bindParam(':movie_image', $movie_image);

        $insertMovie->execute();
    } catch (PDOException $e) {
        if (file_exists($target)) {
            unlink($target);
        }
        header("Location: dashboard.php?error=db");
        exit;
    }

    header("Location: movies.php");
    exit;
}
?>