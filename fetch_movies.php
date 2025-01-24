<?php
header('Content-Type: application/json');
require __DIR__ . '/Database.class.php';
require __DIR__ . '/Film.class.php';

try {
    $movies = Film::getAll();
    echo json_encode([
        'success' => true,
        'data' => $movies,
        'count' => count($movies)
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'trace' => $e->getTrace() // Alleen voor development!
    ]);
}
?>