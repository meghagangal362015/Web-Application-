<?php
/**
 * Login Page - Administrator Authentication
 * Artisan Jewelry by Megha - Secure Admin Section
 *
 * This script handles user authentication using PHP sessions.
 * - Valid username: admin
 * - Password is stored as bcrypt hash (no plain text)
 * - Uses POST method for form submission
 * - Implements session fixation prevention (regenerate session ID on login)
 * - Validates and sanitizes user inputs
 */

// Start session (must be called before any output)
session_start();

// If user is already logged in, redirect to secure page
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: secure.php');
    exit;
}

// Store the bcrypt hash for the admin password in code (as required)
// Run "php generate_password_hash.php" to create config with Admin123!
// Fallback (no config): password = "password" - change via generate script for production
$configFile = __DIR__ . '/config/auth_config.php';
$storedPasswordHash = file_exists($configFile)
    ? include $configFile
    : '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // "password"

// Valid admin username (case-sensitive)
$validUsername = 'admin';

// Initialize error message
$errorMessage = '';

// Process form submission (POST method only)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate that userid and password were submitted
    $userid = isset($_POST['userid']) ? trim($_POST['userid']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Sanitize userid to prevent XSS (alphanumeric and common chars only)
    $userid = htmlspecialchars($userid, ENT_QUOTES, 'UTF-8');

    // Validate inputs are not empty
    if (empty($userid) || empty($password)) {
        $errorMessage = 'Please enter both User ID and Password.';
    } else {
        // Verify username matches
        if ($userid === $validUsername) {
            // Verify password using password_verify (secure comparison)
            if (password_verify($password, $storedPasswordHash)) {
                // Regenerate session ID to prevent session fixation attacks
                session_regenerate_id(true);

                // Set session variables to indicate successful login
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $userid;
                $_SESSION['login_time'] = time();

                // Redirect to secure page
                header('Location: secure.php');
                exit;
            }
        }

        // Generic error message for failed login (don't reveal which field was wrong)
        $errorMessage = 'Invalid User ID or Password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Artisan Jewelry by Megha</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Login form specific styles */
        .login-container {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border: 1px solid #e8ddd2;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(92, 46, 66, 0.15);
        }
        .login-container h2 {
            color: #5c2e42;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .login-form label {
            display: block;
            margin-bottom: 0.5rem;
            color: #5c2e42;
            font-weight: 500;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #e8ddd2;
            border-radius: 6px;
            font-size: 1rem;
        }
        .login-form input:focus {
            outline: none;
            border-color: #7d3c5c;
            box-shadow: 0 0 0 2px rgba(125, 60, 92, 0.2);
        }
        .login-form button {
            width: 100%;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #5c2e42 0%, #7d3c5c 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .login-form button:hover {
            background: linear-gradient(135deg, #7d3c5c 0%, #a8557a 100%);
        }
        .login-error {
            color: #c0392b;
            background: #fdeaea;
            padding: 0.75rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">Artisan Jewelry <span>by Megha</span></div>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="products.html">Products & Services</a></li>
                    <li><a href="news.html">News</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="page-title">
        <div class="container">
            <h1>Administrator Login</h1>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="login-container">
                <h2>Sign In</h2>

                <?php if (!empty($errorMessage)): ?>
                    <div class="login-error"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endif; ?>

                <form class="login-form" method="POST" action="login.php">
                    <label for="userid">User ID</label>
                    <input type="text" id="userid" name="userid" required
                           value="<?php echo isset($_POST['userid']) ? htmlspecialchars($_POST['userid'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                           autocomplete="username">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">

                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
