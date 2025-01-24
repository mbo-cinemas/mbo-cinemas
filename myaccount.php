<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | MBO Cinema</title>
</head>
<body>
    
</body>
</html>
<style>
:root {
    --primary: #e50914;
    --secondary: #141414;
    --background: #141414;
    --text: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: var(--background);
    color: var(--text);
}

.header {
    background: rgba(20,20,20,0.95);
    padding: 0.5rem 0;
    position: sticky;
    top: 0;
    z-index: 100;
}

.nav {
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.logo svg {
    height: 50px;
    width: 200px;
}

.nav-links {
    display: flex;
    gap: 1.5rem;
}

.nav-links a {
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 1px;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    color: #e5e5e5;
    text-decoration: none;
    transition:  0.3s, color 0.3s;
}

.nav-links a:hover {
    background: rgba(229,9,20,0.1);
    color: var(--primary);
}

.nav-links a.active {
    background: rgba(229,9,20,0.1);
    color: var(--primary);
}

.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 2rem;
}

.account-grid {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 2rem;
    margin-top: 2rem;
}

.sidebar {
    background: #1f1f1f;
    border-radius: 10px;
    padding: 1.5rem;
    height: fit-content;
}

.profile-section {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #333;
}

.profile-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 1rem;
    border: 3px solid var(--primary);
}

.profile-name {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.profile-email {
    color: #a0a0a0;
    font-size: 0.9rem;
}

.menu-items {
    list-style: none;
}

.menu-item {
    margin-bottom: 0.5rem;
}

.menu-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    color: #e5e5e5;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s;
}

.menu-link:hover, .menu-link.active {
    background: rgba(229,9,20,0.1);
    color: var(--primary);
}

.content {
    background: #1f1f1f;
    border-radius: 10px;
    padding: 2rem;
}

.section-title {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #333;
}

.booking-card {
    background: #272727;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1rem;
}

.booking-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.movie-info h3 {
    margin-bottom: 0.5rem;
}

.booking-details {
    color: #a0a0a0;
    font-size: 0.9rem;
}

.booking-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-confirmed {
    background: rgba(46, 213, 115, 0.1);
    color: #2ed573;
}

.qr-code {
    width: 100px;
    height: 100px;
    background: #fff;
    padding: 0.5rem;
    border-radius: 4px;
}

.ticket-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #333;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.detail-label {
    color: #a0a0a0;
    font-size: 0.9rem;
}

.detail-value {
    font-weight: 500;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s;
    display: inline-block;
    font-weight: 500;
    text-align: center;
}

.btn-danger {
    background: var(--primary);
    color: white;
}

.btn-danger:hover {
    background: #b20710;
}

@media (max-width: 768px) {
    .account-grid {
        grid-template-columns: 1fr;
    }
    
    .nav {
        flex-direction: column;
        gap: 1rem;
    }
    
    .ticket-details {
        grid-template-columns: 1fr;
    }
}
</style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <a href="index.php">
                    <svg width="200" height="50" viewBox="0 0 200 50">
                        <defs>
                            <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" style="stop-color:#e50914"/>
                                <stop offset="100%" style="stop-color:#b20710"/>
                            </linearGradient>
                        </defs>
                        <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" fill="url(#logoGrad)" style="font-size:28px; font-weight:800; font-family:&apos;Poppins&apos;,sans-serif;">
                            MBO CINEMA
                        </text>
                    </svg>
                </a>
            </div>
            <div class="nav-links">
                <a href="movies.php">Movies</a>
                <a href="locations.php">Locations</a>
                <a href="myaccount.php" class="active">My Account</a>
            </div>
        </nav>
    </header>

    <main class="container">
        <div class="account-grid">
            <class="sidebar">
                <div class="profile-section">
                    <img src="images/pfp.png" alt="Profile" class="profile-image">
                    <h2 class="profile-name">John Doe</h2>
                    <p class="profile-email">john.doe@example.com</p>
                </div>
                <ul class="menu-items">
                    <li class="menu-item">
                        <a href="../mbo-cinemas/bookings.php" class="menu-link active">
                            <i class="fas fa-ticket-alt"></i>
                            My Bookings
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link" onclick="handleLogout(event)">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            
    </main>

<script></script>

<footer style="background: #1f1f1f; padding: 3rem 0; margin-top: 4rem;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
            <div>
                <h4 style="color: #fff; margin-bottom: 1rem;">Help &amp; Info</h4>
                <ul style="list-style: none;">
                    <li><a href="" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">FAQ</a></li>
                    <li><a href="" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Support</a></li>
                    <li><a href="s" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Terms of Service</a></li>
                    <li><a href="" style="color: #a0a0a0; text-decoration: none; line-height: 1.8;">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color: #fff; margin-bottom: 1rem;">Contact Us</h4>
                <ul style="list-style: none;">
                    <li style="color: #a0a0a0; line-height: 1.8;">Phone: +31 20 123 4567</li>
                    <li style="color: #a0a0a0; line-height: 1.8;">Email: info@mbocinemas.com</li>
                    <li style="color: #a0a0a0; line-height: 1.8;">Address: Amsterdam, Netherlands</li>
                </ul>
            </div>
            <div>
                <h4 style="color: #fff; margin-bottom: 1rem;">Follow Us</h4>
                <div style="display: flex; gap: 1rem;">
                    <a href="https://facebook.com/mbocinemas" style="color: #a0a0a0; text-decoration: none;">Facebook</a>
                    <a href="https://twitter.com/mbocinemas" style="color: #a0a0a0; text-decoration: none;">Twitter</a>
                    <a href="https://instagram.com/mbocinemas" style="color: #a0a0a0; text-decoration: none;">Instagram</a>
                </div>
            </div>
            <div>
                <h4 style="color: #fff; margin-bottom: 1rem;">Download Our App</h4>
                <div style="display: flex; gap: 1rem;">
                    <a href="https://apps.apple.com/mbocinemas" style="color: #a0a0a0; text-decoration: none;">iOS App</a>
                    <a href="https://play.google.com/store/mbocinemas" style="color: #a0a0a0; text-decoration: none;">Android App</a>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #333; color: #a0a0a0;">
            &#xa9; 2024 MBO Cinema. All rights reserved.
        </div>
    </div>
</footer>

</body></html>