<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=cosmetics","root","");
    $sql = "DROP TABLE blush";
    $pdo->exec($sql);

    echo "table dropped succesfully";

}catch (PDOException $e){
    echo "error cdropping table: ". $e->getMessage();
}

?>