<?php
header('Content-Type: application/json');
require 'db.php'; // Gebruik de databaseverbinding uit db.php

try {
    $stmt = $pdo->query("SELECT * FROM movies");
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($movies); // Stuur films terug als JSON
} catch (PDOException $e) {
    echo json_encode(['error' => 'Fout bij het ophalen van films: ' . $e->getMessage()]);
}
?>
