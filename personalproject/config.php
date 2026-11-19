<?php

session_start();
// Database connection details (XAMPP uses the user "root" with no password)
$host = "localhost";
$dbname = "explorekosovo";
$username = "root";
$password = "";

try {
    // Create the connection using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Show real errors instead of failing silently
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Stop the page and show the error message
    die("Connection failed: " . $e->getMessage());
}
?>