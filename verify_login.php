<?php
// verify_login.php

// Database configuration
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = "1234"; // Change this to your database password
$dbname = "metro"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $input_username = $conn->real_escape_string($input_username);
    $input_password = $conn->real_escape_string($input_password);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        echo "<script>alert('Login successful! Redirecting...'); window.location.href = 'dashboard.php';</script>";
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password. Please try again.'); window.history.back();</script>";
    }
}

$conn->close();
?>
