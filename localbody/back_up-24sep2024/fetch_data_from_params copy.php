<?php
$host = 'localhost';
$db = 'sales_db';
$user = 'root'; // Your database username
$pass = '';     // Your database password

$id = $_POST['id'];
$pm_type = $_POST['js-example-basic-multiple-limit'];

// Create placeholders for the parameter types
$placeholders = implode(',', array_fill(0, count($pm_type), '?'));

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $sql = "SELECT date, value FROM stp_parameters WHERE id = ? AND parameter_type IN ($placeholders) ORDER BY parameter_type ASC";
    $stmt = $pdo->prepare($sql);

    // Bind the ID parameter
    $stmt->bindValue(1, $id, PDO::PARAM_INT); // Use 1 for the first positional parameter

    // Bind the parameter types
    foreach ($pm_type as $index => $param) {
        $stmt->bindValue($index + 2, $param); // +2 because the first parameter is the ID
    }

    // Execute the statement
    $stmt->execute();

    // Fetch data
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output data as JSON
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
