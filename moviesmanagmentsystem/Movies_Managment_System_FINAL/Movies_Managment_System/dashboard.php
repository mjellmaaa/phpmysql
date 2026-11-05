<?php
/*
  This file is the dashboard page.
  We start a session so we can access user data.
  We also include the database connection.
*/
session_start();
include_once('config.php');

/*
  Check if the user is logged in.
  If not, redirect to the login page.
  We stop the script immediately after redirect.
*/
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

/*
  Prepare a query to get all users.
  This is used for the admin dashboard table.
*/
$sql = "SELECT * FROM users";
$selectUsers = $conn->prepare($sql);
$selectUsers->execute();

/*
  Fetch all users into an array.
*/
$users_data = $selectUsers->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<!--
  Top navigation bar.
  We show the logged-in username.
-->
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
        <?php echo "Welcome to dashboard " . $_SESSION['username']; ?>
    </a>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="logout.php">Sign out</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <!--
          Sidebar navigation.
          If the user is admin, show more links like Dashboard, Movies, Bookings.
          Otherwise, show only basic links.
        -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 'true') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_movies.php">Movies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bookings.php">Bookings</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bookings.php">Bookings</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <!--
              Show the users table only if the logged user is admin.
            -->
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 'true') { ?>
                <h2>Users</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($users_data as $user_data) { ?>
                                <tr>
                                    <td><?php echo $user_data['id']; ?></td>
                                    <td><?php echo $user_data['emri']; ?></td>
                                    <td><?php echo $user_data['username']; ?></td>
                                    <td><?php echo $user_data['email']; ?></td>

                                    <!-- Link to update user -->
                                    <td><a href="editUsers.php?id=<?= $user_data['id']; ?>">Update</a></td>

                                    <!-- Link to delete user -->
                                    <td><a href="deleteUsers.php?id=<?= $user_data['id']; ?>">Delete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </main>
    </div>
</div>

</body>
</html>