document.addEventListener("DOMContentLoaded", function(){
    var options = {
        chart: {
            type: 'pie',//line,bar
            width:'380px'
        },
        labels: ["Comedy", "Action", "Romance", "Drama", "SciFi"],
        series: [4, 5, 6, 1, 5],
    };
    var chart = new ApexCharts(document.querySelector("#chart5"), options);
    chart.render();
 });