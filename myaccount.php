<?php
session_start();
require __DIR__ . '/Database.class.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

try {
    $pdo = Database::getInstance();
    $userStmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $userStmt->execute([$_SESSION['user_id']]);
    $user = $userStmt->fetch();
    
    $bookingStmt = $pdo->prepare("
        SELECT movies.title, bookings.* 
        FROM bookings
        JOIN movies ON bookings.movie_id = movies.id
        WHERE user_id = ?
        ORDER BY booking_date DESC
        LIMIT 5
    ");
    $bookingStmt->execute([$_SESSION['user_id']]);
    $bookings = $bookingStmt->fetchAll();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - MBO Cinemas</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .account-container { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }
        .account-header { text-align: center; margin-bottom: 2rem; padding: 2rem; background: #1f1f1f; border-radius: 10px; border: 1px solid #2d2d2d; }
        .account-header h1 { color: #e50914; font-size: 2.5rem; margin-bottom: 1rem; }
        .user-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem; }
        .info-card { background: #1a1a1a; padding: 2rem; border-radius: 10px; border-left: 4px solid #e50914; }
        .info-card h3 { color: #e50914; margin-bottom: 1rem; font-size: 1.2rem; }
        .bookings-list { background: #1a1a1a; padding: 2rem; border-radius: 10px; margin-bottom: 2rem; position: relative; }
        .booking-item { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; margin: 1rem 0; background: #2d2d2d; border-radius: 8px; transition: transform 0.3s; }
        .booking-item:hover { transform: translateX(10px); }
        .booking-details h4 { color: #fff; margin-bottom: 0.5rem; }
        .booking-meta { color: #a0a0a0; font-size: 0.9rem; }
        .logout-btn { display: block; width: 200px; margin: 2rem auto; text-align: center; padding: 1rem 2rem; background: #e50914; color: white; border-radius: 5px; text-decoration: none; transition: 0.3s; }
        .logout-btn:hover { background: #b20710; }
        
        /* Nieuwe button styling */
        .btn-view-all {
            display: inline-block;
            padding: 12px 30px;
            background: #e50914;
            color: white !important;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #e50914;
            margin-top: 1rem;
        }

        .btn-view-all:hover {
            background: #b20710;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(229, 9, 20, 0.3);
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
                <a href="myaccount.php" class="active">My Account</a>
                <?php if($_SESSION['role'] === 'admin'): ?>
                    <a href="add_movie.php">Add Movie</a>
                <?php endif; ?>
            </section>
        </nav>
    </header>

    <main class="account-container">
        <section class="account-header">
            <h1>Welcome, <?= htmlspecialchars($user['email']) ?></h1>
            <div class="user-info">
                <article class="info-card">
                    <h3>Account Details</h3>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                    <p> <?= htmlspecialchars($user['role']) ?></p>
                </article>
                
                <article class="info-card">
                    <h3>Statistics</h3>
                    <p><strong>Bookings:</strong> <?= count($bookings) ?></p>
                </article>
            </div>
        </section>

        <section class="bookings-list">
            <h2 style="color: #e50914; margin-bottom: 2rem;">My Recent Bookings</h2>
            <?php if(count($bookings) > 0): ?>
                <?php foreach($bookings as $booking): ?>
                    <article class="booking-item">
                        <div class="booking-details">
                            <h4><?= htmlspecialchars($booking['title']) ?></h4>
                            <div class="booking-meta">
                                <span><?= date('H:i', strtotime($booking['show_time'])) ?></span> • 
                                <span><?= $booking['num_tickets'] ?> tickets</span>
                            </div>
                        </div>
                        <div class="booking-date">
                            <?= date('d-m-Y', strtotime($booking['booking_date'])) ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-bookings" style="text-align: center; padding: 2rem;">
                    <p style="color: #a0a0a0; margin-bottom: 1rem;">No bookings found</p>
                    <a href="movies.php" class="btn-primary" style="background: #e50914; color: white; padding: 0.5rem 1.5rem; border-radius: 5px; text-decoration: none;">Book Now!</a>
                </div>
            <?php endif; ?>

            <!-- Nieuwe View All Bookings knop -->
            <div style="text-align: center; margin-top: 2rem;">
                <a href="bookings.php" class="btn-view-all">
                    🎟️ View All Bookings
                </a>
            </div>
        </section>

        <a href="logout.php" class="logout-btn">Logout</a>
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