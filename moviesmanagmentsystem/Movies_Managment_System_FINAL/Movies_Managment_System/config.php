<?php
/**
 * Database Configuration & Session Setup
 * Project: Movie Management System (MMS)
 * 
 * This file connects all pages to the MySQL database and ensures
 * that user sessions are safely started across the entire system.
 */

// Start user session if one has not already been started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection parameters
$user   = "root";
$pass   = "";
$server = "localhost";
$dbname = "mms";

try {
    // Connect using PDO with utf8mb4 encoding for full unicode and emoji support
    $conn = new PDO(
        "mysql:host=$server;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    // Throw exceptions on error so queries fail loudly and cleanly
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch associative arrays by default (e.g. $row['title'] instead of $row[0])
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Disable emulated prepared statements to use real native MySQL prepared statements
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    // In production, avoid printing raw exceptions to prevent exposing database credentials
    die("Database connection failed. Please try again later. (Error: " . htmlspecialchars($e->getMessage()) . ")");
}