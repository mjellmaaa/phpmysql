<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=db1","root","");
    $sql = "DROP TABLE users";
    $pdo->exec($sql);

    echo "table dropped succesfully";

}catch (PDOException $e){
    echo "error cdropping table: ". $e->getMessage();
}

?>