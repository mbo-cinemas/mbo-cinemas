<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mbocinemas</title>
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
                <a href="Movies.php" class="active">Movies</a>
                <a href="locations.php">Locations</a>
                <a href="myaccount.php">My Account</a>
            </section>
        </nav>
    </header>

    <main class="movies-container">
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
                    <option value="fantasy">Fantasy</option>
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
            <section class="filter-group">
                <label>Date:</label>
                <input type="date" class="filter-select" id="dateFilter">
            </section>
        </section>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
        <form action="add_movie.php" method="POST" class="form-section">
            <section class="form-article">
                <article class="form-group">
                    <input type="text" name="title" class="form-input" placeholder="Titel" required>
                </article>
                <article class="form-group">
                    <input type="text" name="genre" class="form-input" placeholder="Genre" required>
                </article>
                <article class="form-group">
                    <input type="number" name="rating" step="0.1" class="form-input" placeholder="Rating" required>
                </article>
                <article class="form-group">
                    <input type="text" name="duration" class="form-input" placeholder="Duur (bv: 2h 15m)" required>
                </article>
            </section>
            
            <section class="form-article">
                <article class="form-group">
                    <textarea name="description" class="form-input form-textarea" placeholder="Beschrijving"></textarea>
                </article>
                <article class="form-group">
                    <input type="text" name="locations" class="form-input" placeholder="Locaties (gescheiden door komma's)" required>
                </article>
                <article class="form-group">
                    <input type="text" name="times" class="form-input" placeholder="Tijden (gescheiden door komma's)" required>
                </article>
                <article class="form-group">
                    <input type="text" name="imageUrl" class="form-input" placeholder="Afbeelding URL" required>
                </article>
            </section>

            <section class="form-article">
                <article class="form-group">
                    <button type="submit" class="form-button">Film Toevoegen</button>
                </article>
            </section>
        </form>
        <?php endif; ?>

        <section class="movie-grid" id="movieGrid">
            <!-- Movies will be loaded here by JavaScript -->
        </section>
    </main>

    <script src="js/script.js"></script>

    <footer>
        <section style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                <article>
                    <h4 style="color: #fff; margin-bottom: 1rem;">Help & Info</h4>
                    <ul style="list-style: none;">
                        <li><a href="#" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">FAQ</a></li>
                        <li><a href="#" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Support</a></li>
                        <li><a href="#" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Terms of Service</a></li>
                        <li><a href="#" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Privacy Policy</a></li>
                    </ul>
                </article>
                <article>
                    <h4 style="color: #fff; margin-bottom: 1rem;">Contact Us</h4>
                    <ul style="list-style: none;">
                        <li style="color: #a0a0a0; line-height: 1.8;">Phone: +31 20 123 4567</li>
                        <li style="color: #a0a0a0; line-height: 1.8;">Email: info@mbocinemas.com</li>
                        <li style="color: #a0a0a0; line-height: 1.8;">Address: Amsterdam, Netherlands</li>
                    </ul>
                </article>
                <article>
                    <h4 style="color: #fff; margin-bottom: 1rem;">Follow Us</h4>
                    <section style="display: flex; gap: 1rem;">
                        <a href="https://facebook.com/mbocinemas" style="color: #a0a0a0; text-decoration: none;">Facebook</a>
                        <a href="https://twitter.com/mbocinemas" style="color: #a0a0a0; text-decoration: none;">Twitter</a>
                        <a href="https://instagram.com/mbocinemas" style="color: #a0a0a0; text-decoration: none;">Instagram</a>
                    </section>
                </article>
                <article>
                    <h4 style="color: #fff; margin-bottom: 1rem;">Download Our App</h4>
                    <section style="display: flex; gap: 1rem;">
                        <a href="https://apps.apple.com/mbocinemas" style="color: #a0a0a0; text-decoration: none;">iOS App</a>
                        <a href="https://play.google.com/store/mbocinemas" style="color: #a0a0a0; text-decoration: none;">Android App</a>
                    </section>
                </article>
            </section>
            <section style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #333; color: #a0a0a0;">
                © 2024 MBO Cinema. All rights reserved.
            </section>
        </section>
    </footer>
</body>
</html>