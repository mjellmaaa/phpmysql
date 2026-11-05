<?php
/*
  This file updates a booking to show that it was declined.
  We include the database connection file.
*/
include_once('config.php');

/*
  Start the session to check whether the user is logged in.
  We also make sure only an admin can decline bookings.
*/
session_start();

if (!isset($_SESSION['id']) || $_SESSION['is_admin'] !== 'true') {
    header("Location: login.php");
    exit;
}

/*
  Check whether the booking ID exists in the URL.
  If it does not exist, stop the script.
*/
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid booking ID.";
    exit;
}

$id = $_GET['id'];

/*
  Update the booking status.
  Many projects store approved values as 'true'/'false' strings,
  but it is cleaner to use 1/0 or true/false depending on your database design.
*/
$sql = "UPDATE bookings SET is_approved = 'false' WHERE id = :id";
$prep = $conn->prepare($sql);
$prep->bindParam(':id', $id);

if ($prep->execute()) {
    /*
      If the update succeeds, redirect back to the movie list.
      We exit immediately after the redirect.
    */
    header("Location: list_movies.php");
    exit;
}

echo "Decline failed.";
exit;
?>