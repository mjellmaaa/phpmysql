<?php
/* 
  Start the session so we can access session data.
  Include the database connection file.
*/
session_start();
include_once('config.php');

/*
  Check if the user is logged in before using $_SESSION['id'].
  If not logged in, redirect to the login page.
*/
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];

/*
  Check whether the logged-in user is an admin.
  If admin, fetch all bookings.
  Otherwise, fetch only the bookings for that specific user.
*/
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 'true') {
    $sql = "SELECT movies.movie_name, users.email, bookings.id, bookings.nr_tickets, bookings.date, bookings.is_approved, bookings.time
            FROM movies
            INNER JOIN bookings ON movies.id = bookings.movie_id
            INNER JOIN users ON users.id = bookings.user_id";

    $selectBookings = $conn->prepare($sql);
    $selectBookings->execute();
    $bookings_data = $selectBookings->fetchAll();
} else {
    $sql = "SELECT movies.movie_name, users.email, bookings.nr_tickets, bookings.date, bookings.is_approved, bookings.time
            FROM movies
            INNER JOIN bookings ON movies.id = bookings.movie_id
            INNER JOIN users ON users.id = bookings.user_id
            WHERE bookings.user_id = :user_id";

    $selectBookings = $conn->prepare($sql);
    $selectBookings->bindParam(':user_id', $user_id);
    $selectBookings->execute();
    $bookings_data = $selectBookings->fetchAll();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>

                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 'true') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_movies.php">Movies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bookings.php">Bookings</a>
                        </li>
                    <?php } else { ?>
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

            <h2>Movie Bookings</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Movie Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">Number of tickets</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Approved</th>
                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 'true') { ?>
                                <th scope="col">Approve</th>
                                <th scope="col">Decline</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings_data as $booking_data) { ?>
                            <tr>
                                <td><?php echo $booking_data['movie_name']; ?></td>
                                <td><?php echo $booking_data['email']; ?></td>
                                <td><?php echo $booking_data['nr_tickets']; ?></td>
                                <td><?php echo $booking_data['date']; ?></td>
                                <td><?php echo $booking_data['time']; ?></td>
                                <td><?php echo $booking_data['is_approved']; ?></td>

                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 'true') { ?>
                                    <td><a href="approve.php?id=<?= $booking_data['id']; ?>">Approve</a></td>
                                    <td><a href="decline.php?id=<?= $booking_data['id']; ?>">Decline</a></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

</body>
</html>