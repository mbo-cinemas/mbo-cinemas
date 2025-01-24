<?php
session_start();
require __DIR__ . '/Database.class.php';
require __DIR__ . '/Film.class.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: movies.php');
    exit();
}

// Get movie data
if (!isset($_GET['id']) || !$movie = Film::findById($_GET['id'])) {
    header('Location: movies.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $updatedMovie = new Film([
            'id' => $_GET['id'],
            'title' => $_POST['title'],
            'genre' => $_POST['genre'],
            'rating' => $_POST['rating'],
            'duration' => $_POST['duration'],
            'description' => $_POST['description'],
            'locations' => $_POST['locations'],
            'times' => $_POST['times'],
            'imageUrl' => $_POST['imageUrl']
        ]);
        
        if ($updatedMovie->save()) {
            $_SESSION['message'] = "Movie updated successfully!";
            header("Location: movies.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error updating movie: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?= htmlspecialchars($movie->getTitle()) ?> - Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <!-- Same header as other pages -->
    </header>

    <main class="admin-container">
        <h1>Edit Movie: <?= htmlspecialchars($movie->getTitle()) ?></h1>
        
        <form method="POST" class="movie-form">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" 
                       value="<?= htmlspecialchars($movie->getTitle()) ?>" required>
            </div>

            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" 
                       value="<?= htmlspecialchars($movie->getGenre()) ?>" required>
            </div>

            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" id="rating" name="rating" step="0.1" 
                       value="<?= htmlspecialchars($movie->getRating()) ?>" required>
            </div>

            <div class="form-group">
                <label for="duration">Duration:</label>
                <input type="text" id="duration" name="duration" 
                       value="<?= htmlspecialchars($movie->getDuration()) ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description"><?= 
                    htmlspecialchars($movie->getDescription()) 
                ?></textarea>
            </div>

            <div class="form-group">
                <label for="locations">Locations (comma-separated):</label>
                <input type="text" id="locations" name="locations" 
                       value="<?= htmlspecialchars($movie->getLocations()) ?>" required>
            </div>

            <div class="form-group">
                <label for="times">Show Times (comma-separated):</label>
                <input type="text" id="times" name="times" 
                       value="<?= htmlspecialchars($movie->getTimes()) ?>" required>
            </div>

            <div class="form-group">
                <label for="imageUrl">Image URL:</label>
                <input type="url" id="imageUrl" name="imageUrl" 
                       value="<?= htmlspecialchars($movie->getImageUrl()) ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Save Changes</button>
                <a href="movies.php" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </main>

    <footer>
        <!-- Same footer as other pages -->
    </footer>
</body>
</html>