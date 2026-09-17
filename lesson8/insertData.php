<?php 
try{
    $pdo = new PDO ("mysql:host=localhost;dbname=db1", "root", "");
    $username = "jack";
    $password = "test";

    $sql = "INSERT INTO users (username ,password) VALUES ('$username', '$password')";
    $pdo -> exec($sql);

    echo "new record created succesfully";

}catch(Exeption $e){
    echo $e -> getMessage();
}

?>