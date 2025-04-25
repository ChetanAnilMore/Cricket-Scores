<?php
// Database configuration
$servername = "localhost";
$username = "root";     // Default XAMPP username
$password = "";         // Default XAMPP password (empty)
$dbname = "cricket_scores"; // Your database name

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set default fetch mode to associative array
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // echo "Connected successfully"; // Uncomment for testing connection
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// You can add helper functions here if needed
// function getMatchData($matchId) { ... }
?>