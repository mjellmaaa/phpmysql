
<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=cosmetics","root","");

    $sql = "ALTER TABLE blush DROP COLUMN bronzer";
    $pdo->exec($sql);

    $sql = "ALTER TABLE blush ADD bronzer VARCHAR(50)";
    $pdo->exec($sql);

    echo "column created succesfully!";

}catch (PDOException $e){
    echo "error creating column: " . $e->getMessage();
}

?>

