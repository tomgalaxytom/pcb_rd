<?php
$host = 'localhost';
$db = 'sales_db';
$user = 'root'; // Your database username
$pass = '';     // Your database password
header('Content-Type: application/json');
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT product_name, sales_amount FROM sales_data");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
