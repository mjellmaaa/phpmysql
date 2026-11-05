<?php
/*
  This file deletes a movie from the database based on its ID.
  We include the database connection file.
*/
include_once('config.php');

/*
  Start the session to check if the current user is logged in.
  Only admins should be allowed to delete movies.
*/
session_start();

if (!isset($_SESSION['id']) || $_SESSION['is_admin'] !== 'true') {
    header("Location: login.php");
    exit;
}

/*
  Check whether the movie ID exists in the URL.
  If it does not exist, stop the script.
*/
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid movie ID.";
    exit;
}

$id = $_GET['id'];

/*
  Delete the movie where the id matches.
*/
$sql = "DELETE FROM movies WHERE id = :id";
$prep = $conn->prepare($sql);
$prep->bindParam(':id', $id);

if ($prep->execute()) {
    /*
      If the delete works, redirect back to the movie list.
      We exit immediately after the redirect.
    */
    header("Location: list_movies.php");
    exit;
}

echo "Delete failed.";
exit;
?>