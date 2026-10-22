<?php 
    include_once('config.php');

    if(empty($_SESSION['username'])){
        header('location: login.php');
    }

    $sql = "SELECT * from users";
    $selectusers = $conn->prepare($sql);
    $selectusers->execute();

    $users_data = $selectUsers-fetchAll();
?>

<?php include("header.php");?>

<style>
    table{
        border:1px solid black;
    }

    tr,td,th{
        border:1px solid black;
    }

    table, tr, td{
        border-collapse:collapse;
    }

    td{
        padding:10px;
    }
</style>

<nav class="navbar navbar-dark fixed-top bg-dark dlex-md-nowrap p-0 shadow">
    <a  class= "navbar-brand col-sm-3 col-md-2 mr-0" href="#">welcome, <i><?php echo $_SESSION['username'];?></i></a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nac-link" href="logout.php">sign out</a>
        </li>
    </ul>
</nav>

<div class= "container-fluid">
    <div class="row">
        <nav class= "col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href = "dashboard.php">
                            <span data-feather="home"></span>
                            dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php foreach($users_data as $user_data) {?>
                        <a class="nav-link" href="profile.php?id=<?=$user_data['id'];?>">
                            <?php}?>
                            <span data-feather="file"></span>
                            edit profile 
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex juatify-content-between flex-wrap dlex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">dashboard</h1>
            </div>

            <div>
                <?php 
                    include_once('config.php');

                    $getusers = $conn->prepare("SELECT * from users");
                    
                    $getusers->execute();

                    $users = $getUsers-fetchAll();
                ?>

                <table>
                    <thead>
                        <tr>
                           <th>ID</th>
                           <th>username</th>
                           <th>name</th>
                           <th>surname</th>
                           <th>email</th>
                           <th>update</th>
                       </tr>
                    </thead>
                    <?php 
                        foreach($users as $user){
                    ?>
                    <tbody>
                        <tr>
                            <td><?=$user['id']?></td>
                            <td><?=$user['username']?></td>
                            <td><?=['name']?></td>
                            <td><?=['suername']?></td>
                            <td><?=['email']?></td>
                            <td><?= "<a href=delete.php?id=$user[id]'> delete <?a> | <a href='profile.php?id=$user[id]'>update </a>"?> </td>
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include("footer.php");?>