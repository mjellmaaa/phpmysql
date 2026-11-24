<?php
// Start the session so we can end it
session_start();

// Remove all session data (the user is now logged out)
session_destroy();

// Go back to the login page
header("Location: login.php");
exit;
?>
