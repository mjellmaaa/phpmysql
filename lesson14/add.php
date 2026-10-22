<?php 
    include_once('config.php');

    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];

            $sql ="INSERT INTO users(name, surname, email) VALUES ( :name, :surname, :email)";

        $insertSql = $conn->prepare($sql);

        $insertSql->bindParam(':name', $name);
        $insertSql->bindParam(':surname', $surname);
        $insertSql->bindParam(':email', $email);

        $insertSql->execute();

        echo "the user has been added succesfully"
        
        }
