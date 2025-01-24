<?php
session_start();
require __DIR__ . '/Database.class.php';
require __DIR__ . '/Film.class.php';

// Check if movie exists
if (!isset($_GET['id']) || !$movie = Film::findById($_GET['id'])) {
    header('Location: movies.php');
    exit();
}

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "Please login to book tickets";
        header("Location: login.php");
        exit();
    }

    try {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO bookings 
            (user_id, movie_id, show_time, num_tickets, booking_date)
            VALUES (?, ?, ?, ?, NOW())");
        
        $stmt->execute([
            $_SESSION['user_id'],
            $movie->getId(),
            $_POST['show_time'],
            $_POST['num_tickets']
        ]);
        
        $_SESSION['message'] = "🎉 Booking successful! Enjoy your movie!";
        header("Location: myaccount.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = "❌ Booking failed: " . $e->getMessage();
    }
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
        /* Booking Page Specific Styles */
        .booking-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .booking-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-top: 2rem;
        }

        .movie-poster-container {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    background: #1a1a1a;
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
}

.movie-poster-container {
    max-width: 500px; /* Iets grotere maximale breedte */
    aspect-ratio: 2/3; /* Optioneel: behoud verhouding */
}

@media (max-width: 768px) {
    .movie-poster-container {
        max-width: 300px;
    }
}
.movie-poster {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease;
}

        .movie-poster:hover {
            transform: scale(1.03); /* Subtiele hover animatie */
}
        .booking-form {
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid #2a2a2a;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #ffffff;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            background: #2a2a2a;
            border: 1px solid #3a3a3a;
            border-radius: 6px;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group select:focus,
        .form-group input:focus {
            outline: none;
            border-color: #e50914;
            box-shadow: 0 0 0 3px rgba(229, 9, 20, 0.2);
        }

        .btn-book {
            background: linear-gradient(135deg, #e50914 0%, #b20710 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-top: 1rem;
        }

        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(229, 9, 20, 0.3);
        }

        .movie-details {
            color: #ffffff;
        }

        .movie-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #ffffff;
        }

        .detail-item {
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            background: #1a1a1a;
            border-radius: 8px;
            border: 1px solid #2a2a2a;
        }

        .detail-item strong {
            color: #e50914;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-item p {
            margin: 0;
            line-height: 1.6;
            color: #cccccc;
        }

        @media (max-width: 768px) {
            .booking-content {
                grid-template-columns: 1fr;
            }
            
            .movie-poster-container {
                max-width: 400px;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <!-- Site Header -->
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

    <!-- Main Content -->
    <main class="booking-container">
        <div class="booking-content">
            <!-- Movie Details Section -->
            <section class="movie-details">
                <h1 class="movie-title"><?= htmlspecialchars($movie->getTitle()) ?></h1>
                
                <div class="movie-poster-container">
                    <img src="<?= htmlspecialchars($movie->getImageUrl()) ?>" 
                         alt="<?= htmlspecialchars($movie->getTitle()) ?> Poster"
                         class="movie-poster"
                         onerror="this.onerror=null;this.src='https://via.placeholder.com/400x600?text=Poster+Not+Available';">
                </div>

                <div class="detail-item">
                    <strong>Genre</strong>
                    <p><?= htmlspecialchars($movie->getGenre()) ?></p>
                </div>

                <div class="detail-item">
                    <strong>Rating</strong>
                    <p>⭐ <?= htmlspecialchars($movie->getRating()) ?>/5</p>
                </div>

                <div class="detail-item">
                    <strong>Duration</strong>
                    <p>⌛ <?= htmlspecialchars($movie->getDuration()) ?></p>
                </div>

                <div class="detail-item">
                    <strong>Description</strong>
                    <p><?= htmlspecialchars($movie->getDescription()) ?></p>
                </div>
            </section>
            <form class="booking-form" method="POST">
                <h2 style="color: #fff; margin-bottom: 1.5rem;">Book Tickets</h2>
                
                <div class="form-group">
                    <label for="show_time">Select Showtime</label>
                    <select name="show_time" id="show_time" required>
                        <?php foreach (explode(',', $movie->getTimes()) as $time): ?>
                            <option value="<?= htmlspecialchars(trim($time)) ?>">
                                🕒 <?= htmlspecialchars(trim($time)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="num_tickets">Number of Tickets</label>
                    <input type="number" name="num_tickets" id="num_tickets" 
                           min="1" max="10" value="1" required>
                </div>

                <button type="submit" class="btn-book">
                    🎟️ Complete Booking
                </button>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="error-message" style="margin-top: 1rem; color: #e50914;">
                        <?= $_SESSION['error'] ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
            </form>
        </div>
    </main>

    <!-- Site Footer -->
    <footer>
        <section class="footer-content">
            <div class="footer-grid">
                <div class="footer-section">
                    <h4>Help & Support</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Our Locations</h4>
                    <ul>
                        <li>Amsterdam</li>
                        <li>Rotterdam</li>
                        <li>Utrecht</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#">Facebook</a>
                        <a href="#">Twitter</a>
                        <a href="#">Instagram</a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                © 2024 MBO Cinema. All rights reserved.
            </div>
        </section>
    </footer>
</body>
</html>