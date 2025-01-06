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
    <main>
    <section id="flexbox1">
            <section id="profile">
                <article id="profile-picture">
                    <img src="../MBO-Cinemas/images/blank profile picture.png" id="profile-picture-image">
                </article>
            </section>
            <form action="/submit_registration" method="POST" id="form1">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required><br><br>

                <button type="submit">Register</button>
            </form>
        </section>
    </main>
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