<?php 
/**
 * Movies Home & Showcase Page
 * Project: Movie Management System (MMS)
 * 
 * Protects page with authentication, loads all active movies,
 * displays user greeting, navigation bar with Logout, and admin Edit buttons.
 */

require_once('config.php');

// 1. Authentication Gate: Redirect guests to login page
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

try {
    // 2. Fetch all movies ordered by latest ID
    $sql = "SELECT * FROM movies ORDER BY id DESC";
    $selectMovies = $conn->prepare($sql);
    $selectMovies->execute();
    $movies_data = $selectMovies->fetchAll();
} catch (PDOException $e) {
    die("Error fetching movies: " . htmlspecialchars($e->getMessage()));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Home - MMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .movie-card img {
            object-fit: cover;
            width: 100%;
            height: 340px;
            background-color: #e9ecef;
        }
        .hero-banner {
            background: linear-gradient(135deg, #1f2937, #111827);
            color: white;
            padding: 50px 0;
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="home.php">🎬 Movie Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="bookings.php">My Bookings</a></li>
                    <!-- Show Dashboard link if user is Admin -->
                    <?php if (!empty($_SESSION['is_admin']) && ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] === 'true')): ?>
                        <li class="nav-item"><a class="nav-link text-warning fw-semibold" href="dashboard.php">Admin Dashboard</a></li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <span class="text-light small">
                        Logged in as: <strong><?= htmlspecialchars($_SESSION['emri'] ?? $_SESSION['username']) ?></strong>
                    </span>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm">Sign Out</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-banner text-center">
        <div class="container">
            <h1 class="fw-bold">Now Showing at MMS Cinema</h1>
            <p class="text-secondary mb-0">Browse current movies, check ratings, and reserve your tickets online.</p>
        </div>
    </section>

    <!-- Movies Catalog Grid -->
    <main class="container mb-5">
        <?php if (empty($movies_data)): ?>
            <div class="alert alert-info text-center py-5">
                <h4>No movies available right now.</h4>
                <p class="mb-0">Please check back later or contact an administrator to add new releases.</p>
            </div>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <?php foreach ($movies_data as $movie): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm movie-card border-0">
                            <!-- Safe poster display with fallback placeholder -->
                            <?php 
                                $imagePath = !empty($movie['movie_image']) ? 'movie_images/' . $movie['movie_image'] : 'movie_images/default.jpg';
                            ?>
                            <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($movie['movie_name'] ?? 'Movie Poster') ?>" onerror="this.src='https://placehold.co/400x550/222/fff?text=No+Poster'">

                            <div class="card-body d-flex flex-col flex-column">
                                <h5 class="card-title fw-bold text-dark mb-1">
                                    <?= htmlspecialchars($movie['movie_name'] ?? '') ?>
                                </h5>
                                
                                <p class="card-text text-muted small flex-grow-1">
                                    <?= htmlspecialchars(substr($movie['movie_desc'] ?? '', 0, 110)) ?>...
                                </p>

                                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                    <div class="btn-group">
                                        <!-- View / Book Details button -->
                                        <a href="details.php?id=<?= (int)$movie['id'] ?>" class="btn btn-sm btn-primary">
                                            View & Book
                                        </a>

                                        <!-- Edit button: correctly checks if is_admin is 1 or 'true' -->
                                        <?php if (!empty($_SESSION['is_admin']) && ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] === 'true')): ?>
                                            <a href="edit.php?id=<?= (int)$movie['id'] ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="text-end">
                                        <span class="badge bg-warning text-dark">★ <?= htmlspecialchars($movie['movie_rating'] ?? 'N/A') ?></span>
                                        <span class="badge bg-secondary"><?= htmlspecialchars($movie['movie_quality'] ?? 'HD') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>