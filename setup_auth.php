<?php
/**
 * Web-based Auth Setup - Creates config/auth_config.php
 * Visit this page once in your browser (e.g., http://localhost/setup_auth.php)
 * to generate the password hash for Admin123!
 *
 * After setup, you can delete this file for security.
 */

$password = 'Admin123!';
$hash = password_hash($password, PASSWORD_DEFAULT);

$configDir = __DIR__ . '/config';
if (!is_dir($configDir)) {
    mkdir($configDir, 0755);
}

$configFile = $configDir . '/auth_config.php';
$content = "<?php\n/**\n * Admin password hash - Password: Admin123!\n */\nreturn " . var_export($hash, true) . ";\n";
file_put_contents($configFile, $content);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auth Setup Complete</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="padding: 2rem; text-align: center;">
        <h1>Authentication Setup Complete</h1>
        <p>Config created at <code>config/auth_config.php</code></p>
        <p><strong>Login credentials:</strong> admin / Admin123!</p>
        <p><a href="login.php">Go to Login</a></p>
        <p style="color: #c0392b; font-size: 0.9rem;">For security, you may delete this setup file (setup_auth.php) after use.</p>
    </div>
</body>
</html>
