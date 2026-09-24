
<?php 
try{
    $pdo = new PDO("mysql:host=localhost;dbname=cosmetics", "root", "");

    $brushes = "fluffy";
    $sponges = "soft";

    $sql = "INSERT INTO blush (bronzer, concealer) 
            VALUES ('$brushes', '$sponges')";

    $pdo->exec($sql);

    echo "new record created successfully";

}catch(PDOException $e){
    echo $e->getMessage();
}

?>

