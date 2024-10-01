<?php
// Database connection parameters
$servername = "localhost"; // Adjust if your database server is different
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "sales_db";       // Your database name

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>
