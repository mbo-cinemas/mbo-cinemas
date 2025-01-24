<?php
session_start();
require __DIR__ . '/Database.class.php';  // Gebruik absolute pad
require __DIR__ . '/Film.class.php';      // Gebruik absolute pad

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: movies.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $film = new Film([
            'title' => $_POST['title'],
            'genre' => $_POST['genre'],
            'rating' => $_POST['rating'],
            'duration' => $_POST['duration'],
            'description' => $_POST['description'],
            'locations' => $_POST['locations'],
            'times' => $_POST['times'],
            'imageUrl' => filter_var($_POST['imageUrl'], FILTER_SANITIZE_URL)
        ]);
        
        if ($film->save()) {
            $_SESSION['message'] = 'Film succesvol toegevoegd!';
        } else {
            $_SESSION['error'] = 'Fout bij het toevoegen';
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Databasefout: ' . $e->getMessage();
    }
    header('Location: movies.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Toevoegen - MBO Cinemas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="add-movie-section">
        <section class="add-movie-container">
            <h2>Voeg een Film Toe</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="add_movie.php" id="addMovieForm">
                <input type="text" name="title" id="title" placeholder="Titel" required>
                <input type="text" name="genre" id="genre" placeholder="Genre" required>
                <input type="number" name="rating" id="rating" step="0.1" placeholder="Rating" required>
                <input type="text" name="duration" id="duration" placeholder="Duur (bv: 2h 15m)" required>
                <textarea name="description" id="description" placeholder="Beschrijving"></textarea>
                <input type="text" name="locations" id="locations" placeholder="Locaties (gescheiden door komma's)" required>
                <input type="text" name="times" id="times" placeholder="Tijden (gescheiden door komma's)" required>
                <input type="text" name="imageUrl" id="imageUrl" placeholder="Afbeelding URL" required>
                <button type="submit">Film Toevoegen</button>
            </form>
        </section>
    </section>
    <script src="js/form-validation.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const savedData = JSON.parse(localStorage.getItem('addMovieForm'));
            if (savedData) {
                Object.keys(savedData).forEach(key => {
                    const el = document.getElementById(key);
                    if (el) el.value = savedData[key];
                });
            }
        });

        document.getElementById('addMovieForm').addEventListener('submit', function() {
            const formData = {
                title: document.getElementById('title').value,
                genre: document.getElementById('genre').value,
                rating: document.getElementById('rating').value,
                duration: document.getElementById('duration').value,
                description: document.getElementById('description').value,
                locations: document.getElementById('locations').value,
                times: document.getElementById('times').value,
                imageUrl: document.getElementById('imageUrl').value
            };
            localStorage.setItem('addMovieForm', JSON.stringify(formData));
        });
    </script>
</body>
</html>