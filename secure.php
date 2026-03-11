<?php
/**
 * Secure Admin Page - Protected Document Listing
 * Artisan Jewelry by Megha - Administrator Section
 *
 * This page is only accessible after successful login.
 * - Checks for valid session before displaying content
 * - Redirects to login.php if not authenticated
 * - Displays a listing of current website users (hardcoded)
 */

// Start session (must be called before any output)
session_start();

// Check if user is logged in - prevent direct access without authentication
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page
    header('Location: login.php');
    exit;
}

// Hardcoded list of current website users
$websiteUsers = [
    'Mary Smith',
    'John Wang',
    'Alex Bington',
    'Sarah Johnson',
    'David Lee',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Admin | Artisan Jewelry by Megha</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Secure page specific styles */
        .user-list {
            background: #fff;
            border: 1px solid #e8ddd2;
            border-radius: 12px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 4px 15px rgba(92, 46, 66, 0.08);
        }
        .user-list h2 {
            color: #5c2e42;
            margin-bottom: 1rem;
        }
        .user-list ul {
            list-style: none;
        }
        .user-list li {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f0ebe5;
            color: #3d3535;
        }
        .user-list li:last-child {
            border-bottom: none;
        }
        .user-list li:hover {
            background: #fdf8f3;
        }
        .admin-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .logout-link {
            color: #7d3c5c;
            font-weight: 600;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        .logout-link:hover {
            background: rgba(125, 60, 92, 0.1);
            color: #5c2e42;
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
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="page-title">
        <div class="container">
            <h1>Administrator Section</h1>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="admin-bar">
                <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_id'] ?? 'Admin', ENT_QUOTES, 'UTF-8'); ?></strong></p>
                <a href="logout.php" class="logout-link">Logout</a>
            </div>

            <div class="user-list">
                <h2>Current Website Users</h2>
                <p style="margin-bottom: 1rem; color: #6b5b52;">The following users are registered on the website:</p>
                <ul>
                    <?php foreach ($websiteUsers as $user): ?>
                        <li><?php echo htmlspecialchars($user, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </main>

</body>
</html>
