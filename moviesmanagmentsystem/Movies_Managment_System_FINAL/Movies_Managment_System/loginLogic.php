<?php 
/**
 * User Login Authentication Logic
 * Project: Movie Management System (MMS)
 * 
 * Verifies username and password, regenerates session ID to prevent session fixation,
 * stores user credentials in the session, and routes users based on their role.
 */

// Include database configuration (session is already safely started inside config.php)
require_once('config.php');

if (isset($_POST['submit'])) {

    // Retrieve and trim inputs
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // 1. Check if either field is empty
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty_fields");
        exit;
    }

    try {
        // 2. Query user by username using a prepared statement to prevent SQL injection
        $sql = "SELECT id, emri, username, email, password, is_admin FROM users WHERE username = :username LIMIT 1";
        $selectUser = $conn->prepare($sql);
        $selectUser->bindParam(":username", $username);
        $selectUser->execute();

        $data = $selectUser->fetch();

        // 3. Verify user exists and check if the password hash matches
        if ($data && password_verify($password, $data['password'])) {
            
            // Regenerate session ID to prevent Session Fixation attacks
            session_regenerate_id(true);

            // Store user details in session
            $_SESSION['id']       = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['email']    = $data['email'];
            $_SESSION['emri']     = $data['emri'];
            $_SESSION['is_admin'] = (int)$data['is_admin'];

            // 4. Role-Based Routing: Admins go to dashboard.php, regular users go to home.php
            if ((int)$data['is_admin'] === 1) {
                header('Location: dashboard.php');
            } else {
                header('Location: home.php');
            }
            exit;

        } else {
            // Invalid username or password (generic message prevents account enumeration)
            header("Location: login.php?error=invalid_credentials");
            exit;
        }

    } catch (PDOException $e) {
        die("Authentication error: " . htmlspecialchars($e->getMessage()));
    }

} else {
    // If accessed directly without submitting the form, redirect to login page
    header("Location: login.php");
    exit;
}