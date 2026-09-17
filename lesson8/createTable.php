<?php

$host = "localhost";
$db = "db1";
$user = "root";
$pass = "";

try{
    $pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);

    $sql = "CREATE TABLE users (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR (30) NOT NULL ,
    password VARCHAR (50) NOT NULL 
    )";

    $pdo -> exec($sql);

    echo "Table created successfully";
}catch (Exeption $e){
    echo "error creating table" . $e->getMessage();
}

?>