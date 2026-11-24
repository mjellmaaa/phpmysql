<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// DELETE: only runs when the form from admin.php is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $pdo->prepare("DELETE FROM destinations WHERE id = ?")->execute([$_POST['id']]);
}

header("Location: admin.php");
exit;
?>
