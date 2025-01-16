<?php
// Include the Auth class and configuration
require 'Auth.php';

// Start the session at the beginning of your script
session_start();

// Check if the request method is POST for registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Get the Auth instance
    $auth = Auth::getInstance();

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Attempt to register the user
    $result = $auth->register($username, $email, $hashedPassword);

    if ($result === true) {
        echo "Signup successful!";
    } else {
        // If there are errors, display them
        foreach ($result as $error) {
            echo $error . "<br>";
        }
    }
}
?>