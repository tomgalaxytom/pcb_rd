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
    // Bind the parameter types
    foreach ($pm_type as $index => $param) {
        if( $param == "PH"){
            $sql = "SELECT date, value FROM stp_parameters WHERE id = ? AND parameter_type = ? ORDER BY parameter_type ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->bindValue(2, 'PH', PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = array(
                "param_type"=>"PH",
                "result" =>$data
                "status"=>"success"
        );
        }
        else if($param == "BOD"){
            $sql = "SELECT date, value FROM stp_parameters WHERE id = ? AND parameter_type = ? ORDER BY parameter_type ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->bindValue(2, 'BOD', PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = array(
                "param_type"=>"BOD",
                "result" =>$data
                "status"=>"success"
        );
        }
        else if($param == "COD"){
            $sql = "SELECT date, value FROM stp_parameters WHERE id = ? AND parameter_type = ? ORDER BY parameter_type ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->bindValue(2, 'COD', PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = array(
                "param_type"=>"COD",
                "result" =>$data
                "status"=>"success"
        );
        }
        else{
            $sql = "SELECT date, value FROM stp_parameters WHERE id = ? AND parameter_type = ? ORDER BY parameter_type ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->bindValue(2, 'TSS', PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = array(
                "param_type"=>"TSS",
                "result" =>$data
                "status"=>"success"
        );
        }
    }
echo json_encode($response);
exit;
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>';
    print_r( $data );
    exit;
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
