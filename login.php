<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Connect to the database (replace with actual credentials)
        $pdo = new PDO('mysql:host=localhost;dbname=mbocinemas', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the query to fetch the user by email
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($_SESSION['role'] === 'admin') {
                header('Location: add_movie.php');
            } else {
                header('Location: movies.php');
            }
            exit();
        } else {
            // Failed login, set error message
            $error = $user ? 'Invalid password' : 'User not found';
        }
    } catch (PDOException $e) {
        // Handle connection error
        $error = 'Database connection failed: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MBO Cinemas</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .auth-container {
            min-height: 100vh;
            background-color: #141414;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .auth-form-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-form {
            background-color: #1f1f1f;
            padding: 40px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        .auth-input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            background-color: #333;
            color: white;
        }
        .auth-button {
            width: 100%;
            padding: 12px;
            margin: 20px 0;
            border: none;
            border-radius: 4px;
            background-color: #e50914;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .auth-button:hover {
            background-color: #b20710;
        }
        .auth-link {
            color: #e50914;
            text-decoration: none;
        }
        .auth-link:hover {
            text-decoration: underline;
        }
        .error-message {
            background-color: rgba(229, 9, 20, 0.1);
            color: #e50914;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="auth-container">
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
            </nav>
        </header>

        <div class="auth-form-container">
            <form class="auth-form" method="POST" action="login.php">
                <h2 style="color: white; text-align: center; margin-bottom: 30px;">Login</h2>
                
                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>

                <input type="email" name="email" class="auth-input" placeholder="Email" required>
                <input type="password" name="password" class="auth-input" placeholder="Password" required>
                <button type="submit" class="auth-button">Login</button>
                
                <p style="color: #888; text-align: center; margin-top: 20px;">
                    Don't have an account? 
                    <a href="signup.php" class="auth-link">Sign Up</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
