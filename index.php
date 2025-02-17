<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBO Cinema - Welcome to Movie Magic</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
            <a href="Movies.php">Movies</a>
            <a href="locations.php">Locations</a>
            <a href="myaccount.php">My Account</a>
        </section>
    </nav>

    <section class="hero">
        <article class="hero-content">
            <h1>Experience Movie Magic</h1>
            <p>Immerse yourself in the latest blockbusters and timeless classics in state-of-the-art theaters.</p>
            <article>
                <a href="Movies.php" class="btn btn-primary">Book Now</a>
            </article>
        </article>
    </section>

    <section class="features">
        <section class="features-grid">
            <article class="feature-card">
                <article class="feature-icon">🎬</article>
                <h3>Premium Experience</h3>
                <p>State-of-the-art projection and sound systems for the ultimate movie experience.</p>
            </article>
            <article class="feature-card">
                <article class="feature-icon">🍿</article>
                <h3>Fresh Snacks</h3>
                <p>Enjoy freshly popped popcorn and a wide selection of refreshments.</p>
            </article>
            <article class="feature-card">
                <article class="feature-icon">💺</article>
                <h3>Comfortable Seating</h3>
                <p>Luxurious reclining seats for maximum comfort during your movie.</p>
            </article>
            <article class="feature-card">
                <article class="feature-icon">🎫</article>
                <h3>Easy Booking</h3>
                <p>Book your tickets online with just a few clicks.</p>
            </article>
        </section>
    </section>

    <section class="now-showing">
        <article class="section-header">
            <h2>Now Showing</h2>
            <a href="Movies.php" class="btn btn-primary">View All</a>
        </article>
        <section class="movie-grid">
            <article class="movie-card">
                <article class="movie-poster">
                    <img src="../MBO-Cinemas/images/inside out 2 image.jpg" alt="Inside Out 2">
                </article>
                <article class="movie-info">
                    <h3 class="movie-title">Inside Out 2</h3>
                    <article class="movie-meta">
                        <span class="rating">⭐ 8.9</span>
                        <span>2h 15m</span>
                    </article>
                    <button class="book-btn">Book Now</button>
                </article>
            </article>
            <article class="movie-card">
                <article class="movie-poster">
                    <img src="../MBO-Cinemas/images/furiosa image.jpg" alt="Furiosa">
                </article>
                <article class="movie-info">
                    <h3 class="movie-title">Furiosa: A Mad Max Saga</h3>
                    <article class="movie-meta">
                        <span class="rating">⭐ 8.5</span>
                        <span>2h 30m</span>
                    </article>
                    <button class="book-btn">Book Now</button>
                </article>
            </article>

            <article class="movie-card">
                <article class="movie-poster">
                    <img src="../MBO-Cinemas/images/kingdom of apes image.jpg" alt="Kingdom of the Planet of the Apes">
                </article>
                <article class="movie-info">
                    <h3 class="movie-title">Kingdom of the Planet of the Apes</h3>
                    <article class="movie-meta">
                        <span class="rating">⭐ 8.7</span>
                        <span>2h 45m</span>
                    </article>
                    <button class="book-btn">Book Now</button>
                </article>
            </article>

            <article class="movie-card">
                <article class="movie-poster">
                    <img src="../MBO-Cinemas/images/alien romulus.png" alt="Alien: Romulus">
                </article>
                <article class="movie-info">
                    <h3 class="movie-title">Alien: Romulus</h3>
                    <article class="movie-meta">
                        <span class="rating">⭐ 8.4</span>
                        <span>2h 20m</span>
                    </article>
                    <button class="book-btn">Book Now</button>
                </article>
            </article>
        </section>
    </section>

    <section class="app-banner">
        <article class="app-content">
            <article class="app-info">
                <h2>Download Our App</h2>
                <p>Get the best movie experience with our mobile app. Book tickets, check showtimes, and get exclusive offers right at your fingertips.</p>
                <article class="app-buttons">
                    <a href="https://apps.apple.com/mbocinemas" class="app-btn">
                        <span>📱</span>
                        <span>App Store</span>
                    </a>
                    <a href="https://play.google.com/store/mbocinemas" class="app-btn">
                        <span>🤖</span>
                        <span>Google Play</span>
                    </a>
                </article>
            </article>
            <article class="app-screens">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80" alt="App Screenshot 1" class="app-screen">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80" alt="App Screenshot 2" class="app-screen">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80" alt="App Screenshot 3" class="app-screen">
            </article>
        </article>
    </section>

    <footer>
        <article class="footer-content">
            <section class="footer-grid">
                <article>
                    <h4>Help & Info</h4>
                    <ul>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">Support</a></li>
                        <li><a href="">Terms of Service</a></li>
                        <li><a href="">Privacy Policy</a></li>
                    </ul>
                </article>
                <article>
                    <h4>Contact Us</h4>
                    <ul>
                        <li>Phone: +31 20 123 4567</li>
                        <li>Email: info@mbocinemas.com</li>
                        <li>Address: Amsterdam, Netherlands</li>
                    </ul>
                </article>
                <article>
                    <h4>Follow Us</h4>
                    <section class="social-links">
                        <a href="https://facebook.com/mbocinemas">Facebook</a>
                        <a href="https://twitter.com/mbocinemas">Twitter</a>
                        <a href="https://instagram.com/mbocinemas">Instagram</a>
                    </section>
                </article>
                <article>
                    <h4>Download Our App</h4>
                    <section class="app-links">
                        <a href="https://apps.apple.com/mbocinemas">iOS App</a>
                        <a href="https://play.google.com/store/mbocinemas">Android App</a>
                    </section>
                </article>
            </section>
            <article class="copyright">
                © 2024 MBO Cinema. All rights reserved.
            </article>
        </article>
    </footer>

</body>
</html>