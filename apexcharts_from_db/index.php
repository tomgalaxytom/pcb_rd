<?php
$host = 'localhost';
$db = 'sales_db';
$user = 'root'; // Your database username
$pass = '';     // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT product_name, sales_amount FROM sales_data");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Chart Example with ApexCharts</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>

<div id="chart"></div>

<script>
// Data from PHP
const labels = <?php echo json_encode(array_column($data, 'product_name')); ?>;
const salesData = <?php echo json_encode(array_column($data, 'sales_amount')); ?>;

// Options for the ApexChart
const options = {
    chart: {
        type: 'bar',
        width:"500px"
    },
    series: [{
        name: 'Sales Amount',
        data: salesData
    }],
    xaxis: {
        categories: labels
    }
};

// Create the chart
const chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
</script>

</body>
</html>
