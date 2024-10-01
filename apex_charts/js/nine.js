document.addEventListener("DOMContentLoaded", function() {
    var options = {
        chart: {
            type: 'radialBar',
            width: '500px',
        },
        series: [70],
        labels:["Progress"]

    };

    var chart = new ApexCharts(document.querySelector("#chart9"), options);
    chart.render();
});




