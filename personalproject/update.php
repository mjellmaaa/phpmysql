<?php
session_start();
include "config.php";

// Only admins can update destinations
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// This file only accepts data sent by the edit form
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: admin.php");
    exit;
}

$id = $_POST['id'];
$name = trim($_POST['name']);
$city = trim($_POST['city']);
$category_id = $_POST['category_id'];
$description = trim($_POST['description']);
$image = trim($_POST['image']);
$status = $_POST['status'];

if ($name == "" || $city == "" || $image == "") {
    // Error: save the message and go back to the edit form
    $_SESSION['edit_error'] = "Name, city and image are required.";
    header("Location: edit.php?id=" . $id);
    exit;
}

// UPDATE the destination. WHERE id = ? makes sure only this one row changes.
$sql = "UPDATE destinations
        SET name = ?, city = ?, category_id = ?, description = ?, image = ?, status = ?
        WHERE id = ?";
$pdo->prepare($sql)->execute([$name, $city, $category_id, $description, $image, $status, $id]);

header("Location: admin.php");
exit;
?>