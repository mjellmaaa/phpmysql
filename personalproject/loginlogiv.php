<?php
session_start();
include "config.php";

// This file only accepts data sent by the login form
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: login.php");
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

// Find the user with this email
$query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$query->execute([$email]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// password_verify compares the typed password with the saved hash
if ($user && password_verify($password, $user['password'])) {
    // Save the user's info in the session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['fullname'] = $user['fullname'];
    $_SESSION['role'] = $user['role'];

    header("Location: destinations.php");
    exit;
}

// Wrong email or password: save the error and go back to the login page
$_SESSION['login_error'] = "Wrong email or password.";
header("Location: login.php");
exit;
?>