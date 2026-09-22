<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=db1","root","");
    $sql = "ALTER TABLE users DROP column email";
    $pdo->exec($sql);

    echo "column dropped succesfully!";

}catch (PDOException $e){
    echo "error dropped column: ". $e->getMessage();
}

?>
