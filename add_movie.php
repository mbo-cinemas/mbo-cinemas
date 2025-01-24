<?php
session_start();
require __DIR__ . '/Database.class.php';
require __DIR__ . '/Film.class.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: movies.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $movie = new Film([
            'title' => $_POST['title'],
            'genre' => $_POST['genre'],
            'rating' => $_POST['rating'],
            'duration' => $_POST['duration'],
            'description' => $_POST['description'],
            'locations' => $_POST['locations'],
            'times' => $_POST['times'],
            'imageUrl' => filter_var($_POST['imageUrl'], FILTER_SANITIZE_URL)
        ]);
        
        if ($movie->save()) {
            $_SESSION['message'] = 'Movie added successfully!';
        } else {
            $_SESSION['error'] = 'Error adding movie';
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    }
    header('Location: movies.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie - MBO Cinemas</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-form {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #1f1f1f;
            border-radius: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #fff;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            background: #333;
            border: 1px solid #444;
            border-radius: 4px;
            color: #fff;
        }

        .form-group textarea {
            height: 120px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .full-width {
            grid-column: 1 / -1;
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
                    <a href="add_movie.php" class="active">Add Movie</a>
                <?php endif; ?>
            </section>
        </nav>
    </header>

    <main class="admin-form">
        <h1>Add New Movie</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']) ?></div>
        <?php endif; ?>

        <form method="POST" action="add_movie.php" id="addMovieForm">
            <div class="form-grid">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required>
                </div>
                
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" id="genre" required>
                </div>
                
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" id="rating" step="0.1" min="0" max="10" required>
                </div>
                
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="text" name="duration" id="duration" placeholder="e.g., 2h 15m" required>
                </div>
                
                <div class="form-group full-width">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="locations">Locations (comma-separated)</label>
                    <input type="text" name="locations" id="locations" required>
                </div>
                
                <div class="form-group">
                    <label for="times">Show Times (comma-separated)</label>
                    <input type="text" name="times" id="times" required>
                </div>
                
                <div class="form-group full-width">
                    <label for="imageUrl">Image URL</label>
                    <input type="url" name="imageUrl" id="imageUrl" required>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-primary">Add Movie</button>
                <a href="movies.php" class="btn-secondary">Cancel</a>
            </div>
        </form>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const savedData = JSON.parse(localStorage.getItem('addMovieForm'));
            if (savedData) {
                Object.keys(savedData).forEach(key => {
                    const el = document.getElementById(key);
                    if (el) el.value = savedData[key];
                });
            }
        });

        document.getElementById('addMovieForm').addEventListener('submit', function() {
            const formData = {
                title: document.getElementById('title').value,
                genre: document.getElementById('genre').value,
                rating: document.getElementById('rating').value,
                duration: document.getElementById('duration').value,
                description: document.getElementById('description').value,
                locations: document.getElementById('locations').value,
                times: document.getElementById('times').value,
                imageUrl: document.getElementById('imageUrl').value
            };
            localStorage.setItem('addMovieForm', JSON.stringify(formData));
        });
    </script>
</body>
</html>