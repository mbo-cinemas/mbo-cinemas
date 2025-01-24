<?php
session_start();
require __DIR__ . '/Database.class.php';
require __DIR__ . '/Film.class.php';

$movies = Film::getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - MBO Cinemas</title>
    <link rel="stylesheet" href="css/style.css">
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
                <a href="movies.php" class="active">Movies</a>
                <a href="locations.php">Locations</a>
                <a href="myaccount.php">My Account</a>
            </section>
        </nav>
    </header>

    <main class="movies-container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="success-message"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <section class="filter-section">
            <section class="filter-group">
                <label>Search:</label>
                <input type="text" id="searchInput" class="filter-select" placeholder="Search movies...">
            </section>
            
            <section class="filter-group">
                <label>Genre:</label>
                <select class="filter-select" id="genreFilter">
                    <option value="all">All Genres</option>
                    <option value="action">Action</option>
                    <option value="comedy">Comedy</option>
                    <option value="drama">Drama</option>
                    <option value="animation">Animation</option>
                    <option value="horror">Horror</option>
                    <option value="sci-fi">Sci-Fi</option>
                </select>
            </section>
            
            <section class="filter-group">
                <label>Location:</label>
                <select class="filter-select" id="locationFilter">
                    <option value="all">All Locations</option>
                    <option value="amsterdam">Amsterdam</option>
                    <option value="rotterdam">Rotterdam</option>
                    <option value="den-haag">Den Haag</option>
                    <option value="utrecht">Utrecht</option>
                </select>
            </section>
        </section>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
            <div class="admin-actions-header">
                <a href="add_movie.php" class="btn-add-movie">+ Add New Movie</a>
            </div>
        <?php endif; ?>

        <section class="movie-grid" id="movieGrid">
            <?php foreach ($movies as $movie): ?>
                <article class="movie-card">
                    <div class="movie-poster">
                        <img src="<?= htmlspecialchars($movie->getImageUrl()) ?>" 
                             alt="<?= htmlspecialchars($movie->getTitle()) ?> Poster"
                             onerror="this.onerror=null;this.src='https://via.placeholder.com/300x450?text=No+Image';">
                    </div>
                    
                    <div class="movie-info">
                        <h3 class="movie-title"><?= htmlspecialchars($movie->getTitle()) ?></h3>
                        
                        <div class="movie-meta">
                            <span class="genre"><?= htmlspecialchars($movie->getGenre()) ?></span>
                            <span class="rating">⭐ <?= htmlspecialchars($movie->getRating()) ?></span>
                            <span class="duration">⌛ <?= htmlspecialchars($movie->getDuration()) ?></span>
                        </div>
                        
                        <p class="movie-description"><?= htmlspecialchars($movie->getDescription()) ?></p>
                        
                        <div class="show-info">
                            <div class="locations">
                                <strong>Locations:</strong>
                                <?= str_replace(',', ', ', htmlspecialchars($movie->getLocations())) ?>
                            </div>
                            
                            <div class="times">
                                <strong>Show Times:</strong>
                                <?php foreach (explode(',', $movie->getTimes()) as $time): ?>
                                    <span class="time-slot"><?= htmlspecialchars(trim($time)) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <a href="booking.php?id=<?= $movie->getId() ?>" class="btn-book">Book Now</a>
                            
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <div class="admin-actions">
                                    <a href="edit_movie.php?id=<?= $movie->getId() ?>" class="btn-edit">Edit</a>
                                    <form action="delete_movie.php" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this movie?');">
                                        <input type="hidden" name="id" value="<?= $movie->getId() ?>">
                                        <button type="submit" class="btn-delete">Delete</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
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

    <script src="js/script.js"></script>
</body>
</html>