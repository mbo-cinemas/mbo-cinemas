<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations | MBO Cinema</title>
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
                <a href="Movies.php">Movies</a>
                <a href="locations.php" class="active">Locations</a>
                <a href="myaccount.php">My Account</a>
            </section>
        </nav>
    </header>

    <main class="container">
        <section class="locations-grid" id="locationsGrid">
            <article class="location-card">
                <section class="location-image" style="background-image: url('../MBO-Cinemas/images/cinema\ amsterdam.jpg')"></section>
                <section class="location-info">
                    <h3 class="location-name">MBO Cinema Amsterdam</h3>
                    <p class="location-address">
                        Bijlmerplein 100<br>
                        1102 DB Amsterdam<br>
                        Netherlands
                    </p>
                    <section class="location-features">
                        <span class="feature-tag">IMAX</span>
                        <span class="feature-tag">4DX</span>
                        <span class="feature-tag">Dolby Atmos</span>
                        <span class="feature-tag">VIP Seats</span>
                    </section>
                    <section class="location-buttons">
                        <a href="#" class="btn btn-primary">View Showtimes</a>
                        <a href="#" onclick="showDirections('amsterdam')" class="btn btn-secondary">Get Directions</a>
                    </section>
                </section>
            </article>
        
            <!-- Rotterdam Location -->
            <article class="location-card">
                <section class="location-image" style="background-image: url('../MBO-Cinemas/images/cinema\ rotterdam.jpg')"></section>
                <section class="location-info">
                    <h3 class="location-name">MBO Cinema Rotterdam</h3>
                    <p class="location-address">
                        Lijnbaan 100<br>
                        3012 AR Rotterdam<br>
                        Netherlands
                    </p>
                    <section class="location-features">
                        <span class="feature-tag">IMAX</span>
                        <span class="feature-tag">4DX</span>
                        <span class="feature-tag">Dolby Atmos</span>
                        <span class="feature-tag">VIP Seats</span>
                    </section>
                    <section class="location-buttons">
                        <a href="#" class="btn btn-primary">View Showtimes</a>
                        <a href="#" onclick="showDirections('rotterdam')" class="btn btn-secondary">Get Directions</a>
                    </section>
                </section>
            </article>
        
            <!-- Den Haag Location -->
            <article class="location-card">
                <section class="location-image" style="background-image: url('../MBO-Cinemas/images/cinema\ den\ haag.jpg')"></section>
                <section class="location-info">
                    <h3 class="location-name">MBO Cinema Den Haag</h3>
                    <p class="location-address">
                        Spui 100<br>
                        2511 BT Den Haag<br>
                        Netherlands
                    </p>
                    <section class="location-features">
                        <span class="feature-tag">IMAX</span>
                        <span class="feature-tag">4DX</span>
                        <span class="feature-tag">Dolby Atmos</span>
                        <span class="feature-tag">VIP Seats</span>
                    </section>
                    <section class="location-buttons">
                        <a href="#" class="btn btn-primary">View Showtimes</a>
                        <a href="#" onclick="showDirections('denhaag')" class="btn btn-secondary">Get Directions</a>
                    </section>
                </section>
            </article>
        
            <!-- Utrecht Location -->
            <article class="location-card">
                <section class="location-image" style="background-image: url('../MBO-Cinemas/images/cinema\ utrecht.jpg')"></section>
                <section class="location-info">
                    <h3 class="location-name">MBO Cinema Utrecht</h3>
                    <p class="location-address">
                        Vredenburg 100<br>
                        3511 BD Utrecht<br>
                        Netherlands
                    </p>
                    <section class="location-features">
                        <span class="feature-tag">IMAX</span>
                        <span class="feature-tag">4DX</span>
                        <span class="feature-tag">Dolby Atmos</span>
                        <span class="feature-tag">VIP Seats</span>
                    </section>
                    <section class="location-buttons">
                        <a href="#" class="btn btn-primary">View Showtimes</a>
                        <a href="#" onclick="showDirections('utrecht')" class="btn btn-secondary">Get Directions</a>
                    </section>
                </section>
            </article>
        </section>

        <section class="maps-container" id="mapsContainer" style="display: none;">
            <iframe id="locationMap" class="map" frameborder="0" style="border:0" allowfullscreen></iframe>
        </section>
    </main>

    <footer style="background: #1f1f1f; padding: 3rem 0; margin-top: 4rem;">
        <section style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                <article>
                    <h4 style="color: #fff; margin-bottom: 1rem;">Help & Info</h4>
                    <ul style="list-style: none;">
                        <li><a href="https://mbocinemas.com/faq" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">FAQ</a></li>
                        <li><a href="https://mbocinemas.com/support" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Support</a></li>
                        <li><a href="https://mbocinemas.com/terms" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Terms of Service</a></li>
                        <li><a href="https://mbocinemas.com/privacy" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Privacy Policy</a></li>
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