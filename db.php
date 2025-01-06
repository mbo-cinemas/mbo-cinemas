<?php
$host = 'localhost';
$dbname = 'mbocinemas';
$user = 'root'; // Jouw MySQL username
$password = ''; // Jouw MySQL wachtwoord (meestal leeg voor XAMPP/WAMP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}
?>
