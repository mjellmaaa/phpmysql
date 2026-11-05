<?php
/*
  This file deletes a user account from the database based on the id from the URL.
  We include the database connection file.
*/
include_once('config.php');

/*
  Start the session so we can check if the current user is logged in.
  Only admins should be allowed to delete users.
*/
session_start();

if (!isset($_SESSION['id']) || $_SESSION['is_admin'] !== 'true') {
    header("Location: login.php");
    exit;
}

/*
  Check if the user ID exists in the URL.
  If it is missing or invalid, stop the script.
*/
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid user ID.";
    exit;
}

$id = $_GET['id'];

/*
  Prevent deleting the current admin account if needed.
  This is optional, but it is a good safety measure.
*/
if ($id == $_SESSION['id']) {
    echo "You cannot delete your own account.";
    exit;
}

/*
  Delete the user where the id matches.
*/
$sql = "DELETE FROM users WHERE id = :id";
$prep = $conn->prepare($sql);
$prep->bindParam(':id', $id);

if ($prep->execute()) {
    /*
      If deletion works, redirect back to the dashboard.
      We exit immediately after redirecting.
    */
    header("Location: dashboard.php");
    exit;
}

echo "User delete failed.";
exit;
?>