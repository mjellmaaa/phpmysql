<?php 
    session_start();

    include_once('config.php');

    if(empty($_SESSION['username'])){
        header('location:login.php');
    }

    $id  = $_GET['id'];
    $sql = "SELECT * from users WHERE id=id";
    $selectuser = $conn->prepare($sql);
    $selectuser->bindParam(':id',$id);
    $selectuser->execute();

    $user_data = $selectUser-fetch();
?>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 " href="#">Welcome, <i><?php echo $_SESSION['username'];?></i></a>
    <ul class="navbar-nav px-3">
        <li class="nac-item text-nowrap">
            <a class="nav-link" href="logout.php">SIGN OUT</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <span data-feather="home"></span>
                            dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-active" href="profile.php=<?= $user_data[id];?>">
                            <span data-feather="file"></span>
                            edit profile
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <div class="id-flex justify-content-between flex-wrap flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">dashboard</h1>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-5"></div>
                    <form class="form-profile" action="update.php" method="post">
                        <span class="text-muted" for="id">id</span>
                        <input class="number" class="form-control" id="floatingInput" placeholder="id" name="id" value="<?php echo $user_data['id']?>" readonly>

                        <span class="text-muted" for="name">name</span>
                        <input class="form-control" type="text" name="name" value="<?php echo $user_data['name']?>" readonly>
                        
                        <span class="text-muted" for="surname">surname</span>
                        <input class="form-control" type="text" name="surname" value="<?php echo $user_data['surname']?>" readonly>
                        
                        <span class="text-muted">name</span>
                        <input class="form-control" type="text" name="username" value="<?php echo $user_data['username']?>" readonly>

                        <span class="text-muted">email</span>
                        <input class="form-control" type="text" name="email" value="<?php echo $user_data['email']?>" readonly>
                        
                        <span class="text-muted">password</span>
                        <input class="form-control" type="text" name="password" required><br><br>

                        <button class="btn btn-lg btn-primary" type="submit" name="update">update</button>
                    </form>
                </div>
            </div>
        </div>
        </main>
    </div>
</div>