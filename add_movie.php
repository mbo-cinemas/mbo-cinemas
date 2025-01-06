<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: movies.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $genre = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);
        $rating = filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $duration = filter_var($_POST['duration'], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $locations = filter_var($_POST['locations'], FILTER_SANITIZE_STRING);
        $times = filter_var($_POST['times'], FILTER_SANITIZE_STRING);
        $imageUrl = filter_var($_POST['imageUrl'], FILTER_SANITIZE_URL);

        require 'db.php';
        
        $query = "INSERT INTO movies (title, genre, rating, duration, description, locations, times, imageUrl) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $genre, $rating, $duration, $description, $locations, $times, $imageUrl]);

        $_SESSION['message'] = 'Film succesvol toegevoegd!';
        header('Location: movies.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = 'Er is een fout opgetreden bij het toevoegen van de film.';
        header('Location: movies.php');
        exit();
    }
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
                <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="add_movie.php">
                <input type="text" name="title" placeholder="Titel" required>
                <input type="text" name="genre" placeholder="Genre" required>
                <input type="number" name="rating" step="0.1" placeholder="Rating" required>
                <input type="text" name="duration" placeholder="Duur (bv: 2h 15m)" required>
                <textarea name="description" placeholder="Beschrijving"></textarea>
                <input type="text" name="locations" placeholder="Locaties (gescheiden door komma's)" required>
                <input type="text" name="times" placeholder="Tijden (gescheiden door komma's)" required>
                <input type="text" name="imageUrl" placeholder="Afbeelding URL" required>
                <button type="submit">Film Toevoegen</button>
            </form>
        </section>
    </section>
</body>
</html>