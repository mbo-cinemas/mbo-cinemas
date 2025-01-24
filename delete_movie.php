<?php
session_start();
require __DIR__ . '/Database.class.php';
require __DIR__ . '/Film.class.php';

// Authorization check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin' || !isset($_POST['id'])) {
    header('Location: movies.php');
    exit();
}

try {
    $movie = Film::findById($_POST['id']);
    if ($movie->delete()) {
        $_SESSION['message'] = "Movie deleted successfully!";
    }
} catch (Exception $e) {
    $_SESSION['error'] = "Error deleting movie: " . $e->getMessage();
}

header('Location: movies.php');
exit();
?>