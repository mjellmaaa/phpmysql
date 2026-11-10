<?php
/**
 * User Registration Processor
 * Project: Movie Management System (MMS)
 * 
 * Handles new account creation, validates inputs, checks for duplicate
 * users/emails, securely hashes the password, and inserts into the database.
 */

// Include database connection and session setup
require_once('config.php');

if (isset($_POST['submit'])) {

    // Sanitize and trim user inputs
    $emri     = trim($_POST['emri'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    // Raw password strings
    $tempPass    = $_POST['password'] ?? '';
    $tempConfirm = $_POST['confirm_password'] ?? '';

    // 1. Validate that all required fields are filled
    if (empty($emri) || empty($username) || empty($email) || empty($tempPass) || empty($tempConfirm)) {
        echo "<script>alert('You have not filled in all the fields.'); window.history.back();</script>";
        exit;
    }

    // 2. Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.history.back();</script>";
        exit;
    }

    // 3. CRITICAL: Check that both entered passwords match before hashing
    if ($tempPass !== $tempConfirm) {
        echo "<script>alert('Passwords do not match. Please verify your password.'); window.history.back();</script>";
        exit;
    }

    // 4. Validate password length (minimum 6 characters recommended)
    if (strlen($tempPass) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.'); window.history.back();</script>";
        exit;
    }

    try {
        // 5. Check if the username or email is already taken
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1");
        $checkStmt->execute([
            ':username' => $username,
            ':email'    => $email
        ]);

        if ($checkStmt->fetch()) {
            echo "<script>alert('Username or Email is already registered. Please choose another or log in.'); window.history.back();</script>";
            exit;
        }

        // 6. Securely hash the password using PHP's strong default algorithm (Bcrypt/Argon2)
        $passwordHash = password_hash($tempPass, PASSWORD_DEFAULT);

        // 7. Insert the new user into the database
        // (We bind $passwordHash to :confirm_password as well so your current table schema does not fail)
        $sql = "INSERT INTO users (emri, username, email, password, confirm_password) 
                VALUES (:emri, :username, :email, :password, :confirm_password)";

        $insertSql = $conn->prepare($sql);
        $insertSql->bindParam(':emri', $emri);
        $insertSql->bindParam(':username', $username);
        $insertSql->bindParam(':email', $email);
        $insertSql->bindParam(':password', $passwordHash);
        $insertSql->bindParam(':confirm_password', $passwordHash);

        $insertSql->execute();

        // 8. Redirect to login page on success and stop further script execution
        header("Location: login.php?registered=success");
        exit;

    } catch (PDOException $e) {
        die("Registration error: " . htmlspecialchars($e->getMessage()));
    }
}