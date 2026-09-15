<?php

    $host= "localhost";
    $user= "root";
    $pass= "";
    try{
        $conn = new PDO("mysql:host=$host", $user, $pass);
        $sql = "create database testdb";
        $conn->exec($sql);
        echo "database is created";

    } catch(exception $e) {
        echo "database not created, something went wrong!";
    }

    ?>