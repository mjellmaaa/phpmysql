<?php 

$host = "localhost";
$db = "cosmetics"; 
$user = "root"; 
$pass = "";

  try { $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

   $sql = "CREATE TABLE IF NOT EXISTS blush ( id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
   concealer VARCHAR(30) NOT NULL, bronzer VARCHAR(50) NOT NULL )"; 

   $pdo->exec($sql); 

   echo "Table created successfully"; 

   } catch (Exception $e) 
   
   { echo "Error creating table: " . $e->getMessage(); }