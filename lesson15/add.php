<?php

include_once('config.php');

if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];

        $sql = "insert into user (name, surname, email) values (:name, :surname, :email)";

        $sqlQuery = $conn->prepare($sql);

        $sqlQuery->bindParam(':name', $name);
        $sqlQuery->bindParam(':surname', $surname);
        $sqlQuery->bindParam(':email', $email);

        $sqlQuery->execute();

        echo "data saved succesfully... <br>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>add user</title>
</head>
<body>
    <a href="index.php">dashboard</a>
    <form action="add.php" method="POST">
        <input type="text" name="name" placeholder="name"><br>
        <input type="text" name="surname" placeholder="surname"><br>
        <input type="text" name="email" placeholder="email"><br>
        <button type="submit" name="submit">ADD</button>
    </form>
</body>
</html>