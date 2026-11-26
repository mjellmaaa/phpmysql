<?php
session_start();
include "config.php";

// This file only accepts data sent by the register form
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: register.php");
    exit;
}

$fullname = trim($_POST['fullname']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm = $_POST['confirm'];

$error = "";

if ($fullname == "" || $email == "" || $password == "") {
    $error = "Please fill in all fields.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
} elseif (strlen($password) < 6) {
    $error = "Password must be at least 6 characters.";
} elseif ($password != $confirm) {
    $error = "Passwords do not match.";
} else {
    // Check if this email is already registered
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->fetch()) {
        $error = "This email is already registered.";
    } else {
        // Never save the real password. Save a hashed (scrambled) version.
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Make mjellmacitaku1@gmail.com admin
        $role = "user";
        if ($email == "mjellmacitaku1@gmail.com") {
            $role = "admin";
        }

        $insert = $pdo->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)");
        $insert->execute([$fullname, $email, $hash, $role]);

        // Success: go to the login page
        header("Location: login.php?registered=1");
        exit;
    }
}

// If we reach this point there was an error.
// Save it in the session so register.php can show it, then go back.
$_SESSION['register_error'] = $error;
$_SESSION['old_fullname'] = $fullname;
$_SESSION['old_email'] = $email;
header("Location: register.php");
exit;
?>
