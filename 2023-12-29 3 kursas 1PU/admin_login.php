<?php
// admin_login.php
session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password']; // Encrypt the entered password with MD5

        $adminUsername = 'admin';
        $storedPasswordHash = file_get_contents('slapt'); // Read the hashed password from the file

        if ($username === $adminUsername && $password === $storedPasswordHash) {
            $_SESSION['logged_in'] = true;
            header('Location: admin_dashboard.php'); // Redirect to admin dashboard
            exit;
        } else {
            echo "<p>Invalid credentials. Please try again.</p>";
        }
    }
?>