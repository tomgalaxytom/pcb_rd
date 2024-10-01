<?php
$host                = 'localhost';
$db                  = 'sales_db';
$user                = 'root'; // Your database username
$pass                = '';     // Your database password
$id                  = $_POST['id'];
$pm_type             = $_POST['param_select'];
$resultCount         = count($pm_type );
$repo_form           = $_POST['optradio'];
// Create placeholders for the parameter types

$from_date           = $_POST['from_date'];
$from_date_formatted = date('Y-m-d', strtotime($from_date));
$to_date             = $_POST['to_date'];
$to_date_formatted   = date('Y-m-d', strtotime($to_date));




// echo '<pre>';
// print_r($_POST);
// exit;
// echo $resultCount;
// exit;

$response = [];
try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Bind the parameter types
        if($resultCount  > 0)
            { //result Count is > 0
                foreach ($pm_type as $param) {
                   // $sql = "SELECT date, value FROM stp_parameters WHERE id = ? AND parameter_type = ? ORDER BY parameter_type ASC";
                   $sql = "SELECT date, value FROM stp_parameters WHERE id = ? AND parameter_type = ? AND date >= ? AND date <= ? ORDER BY parameter_type ASC";

                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(1, $id, PDO::PARAM_INT);
                    $stmt->bindValue(2, $param, PDO::PARAM_STR);
                    $stmt->bindValue(3, $from_date_formatted, PDO::PARAM_STR);
                    $stmt->bindValue(4, $to_date_formatted, PDO::PARAM_STR);
                    $stmt->execute();

                    // Fetch the results
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Add to response
                    $response[] = [
                        "param_type" => $param,
                        "repo_form"  =>$repo_form ,
                        "result" => $data,
                        "status" => "success"
                    ];
                }

                echo json_encode($response); // Return all results as an array
                exit;
            }//result Count is > 0
    } catch (PDOException $e)
     {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>
