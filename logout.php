<?php
/**
 * Logout Handler - Session Destruction
 * Artisan Jewelry by Megha - Secure Admin Section
 *
 * This script destroys the user session and redirects to the login page.
 * - Clears all session variables
 * - Destroys the session
 * - Redirects to login.php
 */

// Start session (required to destroy it)
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session cookie if it exists
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: login.php');
exit;
