<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "react_php_crud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set headers to allow requests from React (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Get all tasks
        $sql = "SELECT * FROM tasks";
        $result = $conn->query($sql);
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        echo json_encode($tasks);
        break;

    case 'POST':
        // Add a new task
        $data = json_decode(file_get_contents("php://input"));
        $name = $data->name;

        $sql = "INSERT INTO tasks (name) VALUES ('$name')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["id" => $conn->insert_id, "name" => $name]);
        } else {
            echo json_encode(["error" => "Error adding task"]);
        }
        break;

    case 'PUT':
        // Edit a task
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        $name = $data->name;

        $sql = "UPDATE tasks SET name='$name' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Task updated"]);
        } else {
            echo json_encode(["error" => "Error updating task"]);
        }
        break;

    case 'DELETE':
        // Delete a task
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;

        $sql = "DELETE FROM tasks WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Task deleted"]);
        } else {
            echo json_encode(["error" => "Error deleting task"]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid Request"]);
        break;
}

$conn->close();
