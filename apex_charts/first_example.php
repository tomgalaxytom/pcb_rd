<!DOCTYPE html>

<html>

<head>

   <title>ApexCharts Line Chart Example</title>
   <style>
        .chart-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .chart {
            width: 48%; /* Adjust width as needed */
        }
        #toggleOrientation {
            padding: 5px 10px; /* Adjust the padding to reduce size */
            font-size: 14px;    /* Change font size as needed */
            margin: 10px;       /* Optional: add some margin around the button */
            cursor: pointer;     /* Change cursor to pointer */
        }
    </style>

</head>

<body>

   <!-- <div id="chart"></div>
   <div id="chart2"></div>
   <div id="chart3"></div> -->
   <div class="chart-container">
        <div id="chart1" class="chart"></div>
        <div id="chart2" class="chart"></div>
    </div>
    <div class="chart-container">
        <div id="chart3" class="chart"></div>
        <div id="chart4" class="chart"></div>
    </div>
    <div class="chart-container">
        <div id="chart5" class="chart"></div>
        <div id="chart6" class="chart"></div>
    </div>
    <div class="chart-container">
        <div id="chart7" class="chart"></div>
       <div id="chart8" class="chart"></div>
    </div>
    <div class="chart-container">
        <div id="chart9" class="chart"></div>
        <div id="chart10" class="chart"></div>
    </div>

    <div class="chart-container">
        <div id="chart11" class="chart"></div>
        <div id="chart12" class="chart"></div>
    </div>
    <div class="chart-containerx">
    <button id="toggleOrientation">Toggle Orientation</button>
        <div id="toggle_chart" class="chart"></div>
        <!-- <div id="chart12" class="chart"></div> -->
    </div>


   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

   <script src="js/first_chart.js"></script>
    <script src="js/farenheet.js"></script>
    <script src="js/three.js"></script>
    <script src="js/four.js"></script>
    <script src="js/five.js"></script>
    <script src="js/six.js"></script>
    <script src="js/seven.js"></script>
    <script src="js/eight.js"></script>
    <script src="js/nine.js"></script>
    <script src="js/ten.js"></script>
    <script src="js/leven.js"></script>
    <script src="js/toggle_chart.js"></script>

</body>

</html>