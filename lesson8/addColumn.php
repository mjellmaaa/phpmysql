<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=db1","root","");
    $sql = "ALTER TABLE users ADD email VARCHAR(255)";
    $pdo->exec($sql);

    echo "column created succesfully!";

}catch (PDOException $e){
    echo "error creating column: ". $e->getMessage();
}

?>