<?php
// Include the configuration file
include "config.php"; // Ensure this path is correct

// SQL query to select all data from stp_data
$sql = "SELECT * FROM stp_data";

try {
    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch all results as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //print_r($data);
    // Return data as JSON
    echo json_encode($data);
} catch (PDOException $e) {
    // Handle query execution errors
    echo "Query failed: " . $e->getMessage();
}

// Close connection (optional)
$conn = null;
?>
