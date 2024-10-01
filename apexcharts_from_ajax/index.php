


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Chart Example with ApexCharts and AJAX</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="chart"></div>

<script>
$(document).ready(function() {
    // Fetch data using AJAX
    $.ajax({
        url: 'fetch_data.php',
        method: 'GET',
        success: function(response) {
            const labels = response.map(item => item.product_name);
            const salesData = response.map(item => item.sales_amount);

            // Chart options
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
        },
        error: function(xhr, status, error) {
            console.error("Error fetching data:", error);
        }
    });
});
</script>

</body>
</html>
