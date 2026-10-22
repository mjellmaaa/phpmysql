<?php 
    include_once('config.php');

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $tempPass = $_POST['password'];
        $password = password_hash($tempPass, PASSWORD_DEFAULT);

        if(empty($name)  || empty($surname) || empty($username) || empty($password)){
            echo "you need to fill all the fields";
            header("refresh;2;url=profile.php");

            $sql ="UPDATE user Set name=:name, surname=:surname, username=:username,
            email=:email, password=:password where id=:id";

        $updateSql = $conn->prepare($sql);

        $insertSql->bindParam(':username', $username)
        }
    }