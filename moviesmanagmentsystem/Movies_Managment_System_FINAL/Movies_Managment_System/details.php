<?php
/*
  This file shows the details of one movie.
  It gets the movie ID from the URL and loads the movie from the database.
  It also prepares a booking form for the user.
*/

// Start the session so we can check if the user is logged in.
session_start();

// Include the database connection file.
include_once('config.php');

/*
  Check if the user is logged in.
  If the user is not logged in, redirect them to login.php.
*/
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

/*
  Check if the movie ID exists in the URL.
  If it does not exist, stop the script.
*/
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid movie ID.";
    exit;
}

$id = $_GET['id'];

/*
  Get the selected movie from the database using the movie id.
*/
$sql = "SELECT * FROM movies WHERE id = :id";
$selectMovie = $conn->prepare($sql);
$selectMovie->bindParam(":id", $id);
$selectMovie->execute();

/*
  Fetch the movie data.
  If no movie is found, stop execution.
*/
$movie_data = $selectMovie->fetch();

if (!$movie_data) {
    echo "Movie not found.";
    exit;
}

/*
  We can also store the movie ID in the session,
  but for better reliability, we should send it as a hidden input in the form.
*/
$_SESSION['movie_id'] = $id;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">

    <style>
        /*
          Add margin between form fields.
        */
        .form-floating {
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-muted">Add some information about the album below, the author, or any other background context.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Follow on Twitter</a></li>
                            <li><a href="#" class="text-white">Like on Facebook</a></li>
                            <li><a href="#" class="text-white">Email me</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>Album</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Book your ticket</h1>
                <p class="lead text-muted">You can book your ticket by clicking the button below</p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-6">
                            <div class="white-box text-center" style="width: 100%; height: 100%;">
                                <img src="movie_images/<?php echo htmlspecialchars($movie_data['movie_image']); ?>" class="img-responsive" style="width: 70%; height: 90%;">
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-6">
                            <h4 class="box-title mt-5"><?php echo htmlspecialchars($movie_data['movie_name']); ?></h4>
                            <p><?php echo htmlspecialchars($movie_data['movie_desc']); ?></p>

                            <!--
                              This form sends booking data to book.php.
                              We include hidden movie_id so book.php gets the selected movie.
                              We also add required fields for better validation.
                            -->
                            <form action="book.php" method="post">
                                <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie_data['id']); ?>">

                                <div class="form-floating">
                                    <input type="number" class="form-control" id="floatingInput" placeholder="Number of tickets" name="nr_tickets" min="1" required>
                                    <label for="floatingInput">Number of tickets</label>
                                </div>

                                <div class="form-floating">
                                    <input type="date" class="form-control" id="floatingInputDate" placeholder="Date" name="date" required>
                                    <label for="floatingInputDate">Date</label>
                                </div>

                                <div class="form-floating">
                                    <select name="time" class="form-control" required>
                                        <option value="">Select time</option>
                                        <option value="12:00">12:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="17:00">17:00</option>
                                        <option value="19:00">19:00</option>
                                    </select>
                                </div>

                                <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Book</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>