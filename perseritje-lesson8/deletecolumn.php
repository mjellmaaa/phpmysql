<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=cosmetics","root","");
    $sql = "ALTER TABLE blush DROP column bronzer";
    $pdo->exec($sql);

    echo "column dropped succesfully!";

}catch (PDOException $e){
    echo "error dropped column: ". $e->getMessage();
}

?>
