<?php
     include_once('config.php');

     if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $surname =$_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $tempPass = $_POST['password'];
        $password = password_hash($tempPass, PASSWORD_DEFAULT);

        if(empty($name)|| empty($surname) || empty($username) || empty($email) || empty($password)){
            echo "you need to fill all the fields";
        }else{

            $sql = "SELECT username FROM users WHERE username=:username";

            $tempSQL= $conn->prepare($sql);
            $tempSQL->bindParam(':username', $username);
            $tempSQL->execute();-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2023 at 04:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `email`, `password`) VALUES
(1, 'John', 'Doe', 'johndoe', 'johndoe@mail.com', '$2y$10$4kAii3oJMFLZnyy5Jdfj5OAsMPaRcj4Or8F/4XXdccuC329YkuLaG'),
(2, 'Jane', 'Doe', 'janedoe', 'janedoe@mail.com', '$2y$10$JzYz38MXRWUcrpOOgh61VefY0Mx/4gPUOiSndmYS5mD5VNZ4wOacm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


            if ($tempSQL->rowCount()>0){
                echo "username exist";
                header("refresh:2;url=signup.php");
            }else{
                $sql = "insert into users(name,surname,username,email,password) values (:name,:surname,:username,:email,:password)";

                $insertSql = $conn->prepare($sql);

                $insertSql->bindParam(':name', $name);
                $insertSql->bindParam(':surname', $surname);
                $insertSql->bindParam(':username', $username);
                $insertSql->bindParam(':email', $email);
                $insertSql->bindParam(':password', $password);

                $insertSql->execute();

                echo "data saved succesfully";
                header("refresh:2;url=login.php");
            }
        }
    }
?>