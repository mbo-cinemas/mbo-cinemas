<?php
session_start();
require __DIR__ . '/Database.class.php';
require __DIR__ . '/Film.class.php';

if (!isset($_GET['id']) || !$movie = Film::findById($_GET['id'])) {
    header('Location: movies.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book <?= htmlspecialchars($movie->getTitle()) ?> - MBO Cinemas</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Additional booking page styles */
        .booking-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .booking-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 8px;
        }

        .movie-poster {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .booking-form {
            background: #242424;
            padding: 2rem;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #ffffff;
            font-weight: 500;
        }

        select, input {
            width: 100%;
            padding: 0.8rem;
            background: #333;
            border: 1px solid #444;
            border-radius: 4px;
            color: white;
            font-size: 1rem;
        }

        .btn-book {
            background: #e50914;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .btn-book:hover {
            background: #b20710;
        }

        .movie-details {
            color: #ffffff;
        }

        .movie-details h2 {
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .detail-item {
            margin-bottom: 1rem;
            padding: 1rem;
            background: #242424;
            border-radius: 4px;
        }

        .detail-item strong {
            color: #e50914;
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <section class="logo">
                <a href="index.php">
                    <svg width="200" height="50" viewBox="0 0 200 50">
                        <defs>
                            <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" style="stop-color:#e50914"/>
                                <stop offset="100%" style="stop-color:#b20710"/>
                            </linearGradient>
                        </defs>
                        <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" 
                            fill="url(#logoGrad)" 
                            style="font-size:28px; font-weight:800; font-family:'Poppins',sans-serif;">
                            MBO CINEMA
                        </text>
                    </svg>
                </a>
            </section>
            <section class="nav-links">
                <a href="movies.php">Movies</a>
                <a href="locations.php">Locations</a>
                <a href="myaccount.php">My Account</a>
            </section>
        </nav>
    </header>

    <main class="booking-container">
        <div class="booking-content">
            <!-- Movie Details Section -->
            <section class="movie-details">
                <h2><?= htmlspecialchars($movie->getTitle()) ?></h2>
                <img src="<?= htmlspecialchars($movie->getImageUrl()) ?>" 
                     alt="<?= htmlspecialchars($movie->getTitle()) ?>" 
                     class="movie-poster">
                
                <div class="detail-item">
                    <strong>Genre:</strong> <?= htmlspecialchars($movie->getGenre()) ?>
                </div>
                
                <div class="detail-item">
                    <strong>Rating:</strong> ⭐ <?= htmlspecialchars($movie->getRating()) ?>
                </div>
                
                <div class="detail-item">
                    <strong>Duration:</strong> ⌛ <?= htmlspecialchars($movie->getDuration()) ?>
                </div>
                
                <div class="detail-item">
                    <strong>Description:</strong><br>
                    <?= htmlspecialchars($movie->getDescription()) ?>
                </div>
            </section>

            <!-- Booking Form Section -->
            <form class="booking-form" method="POST">
                <div class="form-group">
                    <label for="show_time">Select Showtime:</label>
                    <select name="show_time" id="show_time" required>
                        <?php foreach (explode(',', $movie->getTimes()) as $time): ?>
                            <option value="<?= htmlspecialchars(trim($time)) ?>">
                                <?= htmlspecialchars(trim($time)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="num_tickets">Number of Tickets:</label>
                    <input type="number" name="num_tickets" id="num_tickets" 
                           min="1" max="10" value="1" required>
                </div>

                <button type="submit" class="btn-book">Complete Booking</button>
            </form>
        </div>
    </main>


    <footer>
        <section class="footer-content">
            <div class="footer-grid">
            </div>
            <div class="copyright">
                © 2024 MBO Cinema. All rights reserved.
            </div>
        </section>
    </footer>
</body>
</html>