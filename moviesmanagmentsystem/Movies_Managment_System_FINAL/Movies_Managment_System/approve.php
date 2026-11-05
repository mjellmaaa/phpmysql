<?php
include_once('config.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Booking ID is missing.";
    exit;
}

$id = $_GET['id'];

$sql = "UPDATE bookings SET is_approved = 1 WHERE id = :id";
$prep = $conn->prepare($sql);
$prep->bindParam(':id', $id);

if ($prep->execute()) {
    header("Location: list_movies.php");
    exit;
} else {
    echo "Approval failed.";
}
?>