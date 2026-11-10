<?php 
/**
 * User Logout Script
 * Project: Movie Management System (MMS)
 * 
 * Safely unsets all session variables, invalidates the session cookie,
 * destroys the session on the server, and redirects to login.php.
 */

// Include config to ensure session is recognized
require_once('config.php');

// 1. Unset all session variables in memory
$_SESSION = [];

// 2. Clear the session cookie from the user's browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// 3. Destroy session data on the server
session_destroy();

// 4. Redirect to login page and immediately halt script execution
header("Location: login.php?message=logged_out");
exit;