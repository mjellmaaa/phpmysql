<?php
session_start();
include "config.php";

// Only logged-in users can save favorites
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['user_id'];
    $destination_id = $_POST['destination_id'];

    // Is this destination already saved by this user?
    $check = $pdo->prepare("SELECT id FROM favorites WHERE user_id = ? AND destination_id = ?");
    $check->execute([$user_id, $destination_id]);

    if ($check->fetch()) {
        // Already saved, so remove it (DELETE)
        $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND destination_id = ?")
            ->execute([$user_id, $destination_id]);
    } else {
        // Not saved yet, so save it (INSERT)
        $pdo->prepare("INSERT INTO favorites (user_id, destination_id) VALUES (?, ?)")
            ->execute([$user_id, $destination_id]);
    }
}

// Go back to the page the user came from (or to the favorites page)
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: favorites.php");
}
exit;
?>
