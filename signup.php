<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: movies.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'db.php';

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password match
    if ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Email already registered';
        } else {
            // Create new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, 'user')");
            
            if ($stmt->execute([$email, $hashed_password])) {
                // Auto-login after signup
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['email'] = $email;
                $_SESSION['role'] = 'user';
                header('Location: movies.php');
                exit();
            } else {
                $error = 'Registration failed';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MBO Cinemas</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .auth-container {
            min-height: 100vh;
            background-color: #141414;
            display: flex;
            flex-direction: column;
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
        <!-- Header with only logo -->
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
            <form class="auth-form" method="POST" action="signup.php">
                <h2 style="color: white; text-align: center; margin-bottom: 30px;">Sign Up</h2>
                
                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>

                <input type="email" name="email" class="auth-input" placeholder="Email" required>
                <input type="password" name="password" class="auth-input" placeholder="Password" required minlength="8">
                <input type="password" name="confirm_password" class="auth-input" placeholder="Confirm Password" required minlength="8">
                <button type="submit" class="auth-button">Sign Up</button>
                
                <p style="color: #888; text-align: center; margin-top: 20px;">
                    Already have an account? 
                    <a href="login.php" class="auth-link">Login</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>