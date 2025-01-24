<?php
session_start();
require __DIR__ . '/Database.class.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

try {
    $pdo = Database::getInstance();
    $stmt = $pdo->prepare("
        SELECT movies.title, bookings.* 
        FROM bookings
        JOIN movies ON bookings.movie_id = movies.id
        WHERE user_id = ?
        ORDER BY booking_date DESC
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $bookings = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - MBO Cinemas</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .bookings-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .bookings-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem;
            background: #1f1f1f;
            border-radius: 10px;
        }

        .booking-table {
            width: 100%;
            border-collapse: collapse;
            background: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
        }

        .booking-table thead {
            background: #e50914;
        }

        .booking-table th {
            padding: 1.5rem;
            text-align: left;
            color: white;
        }

        .booking-table td {
            padding: 1.2rem;
            border-bottom: 1px solid #2d2d2d;
            color: #ffffff;
        }

        .booking-table tr:last-child td {
            border-bottom: none;
        }

        .booking-table tr:hover {
            background: #2d2d2d;
        }

        .booking-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.9rem;
        }

        .status-confirmed {
            background: rgba(46, 213, 115, 0.1);
            color: #2ed573;
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
                <?php if($_SESSION['role'] === 'admin'): ?>
                    <a href="add_movie.php">Add Movie</a>
                <?php endif; ?>
            </section>
        </nav>
    </header>

    <main class="bookings-container">
        <section class="bookings-header">
            <h1 style="color: #e50914; font-size: 2.5rem; margin-bottom: 1rem;">My Bookings</h1>
            <p style="color: #a0a0a0;">Overview of all your reservations</p>
        </section>

        <table class="booking-table">
            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Time</th>
                    <th>Tickets</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['title']) ?></td>
                        <td><?= $booking['show_time'] ?></td>
                        <td><?= $booking['num_tickets'] ?></td>
                        <td><?= date('d-m-Y', strtotime($booking['booking_date'])) ?></td>
                        <td>
                            <span class="booking-status status-confirmed">Confirmed</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <section class="footer-content">
            <div class="footer-grid">
                <div class="footer-section">
                    <h4>Help & Info</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact</h4>
                    <ul>
                        <li>Phone: +31 20 123 4567</li>
                        <li>Email: info@mbocinemas.com</li>
                        <li>Address: Amsterdam, NL</li>
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
                <div class="footer-section">
                    <h4>Apps</h4>
                    <div class="app-links">
                        <a href="#">iOS</a>
                        <a href="#">Android</a>
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