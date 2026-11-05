<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['movie_id'], $_POST['nr_tickets'], $_POST['date'], $_POST['time'])) {
    echo "Missing booking data.";
    exit;
}

$user_id = $_SESSION['id'];
$movie_id = $_POST['movie_id'];
$nr_tickets = $_POST['nr_tickets'];
$date = $_POST['date'];
$time = $_POST['time'];

if (empty($movie_id) || empty($nr_tickets) || empty($date) || empty($time)) {
    echo "Please fill in all booking fields.";
    exit;
}

if (!is_numeric($nr_tickets) || $nr_tickets <= 0) {
    echo "Number of tickets must be a positive number.";
    exit;
}

$sql = "INSERT INTO bookings (user_id, movie_id, nr_tickets, date, time)
        VALUES (:user_id, :movie_id, :nr_tickets, :date, :time)";

$insertBooking = $conn->prepare($sql);

$insertBooking->bindParam(":user_id", $user_id);
$insertBooking->bindParam(":movie_id", $movie_id);
$insertBooking->bindParam(":nr_tickets", $nr_tickets);
$insertBooking->bindParam(":date", $date);
$insertBooking->bindParam(":time", $time);

if ($insertBooking->execute()) {
    header("Location: home.php");
    exit;
} else {
    echo "Booking failed.";
}
?>