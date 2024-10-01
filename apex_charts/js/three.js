document.addEventListener("DOMContentLoaded", function(){

    var options = {

        chart: {

            type: 'line',//line,bar
            width:'500px'

        },

        series: [{

            name: 'sales',

            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]

        }],

        xaxis: {

            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']

        }

    };

    var chart = new ApexCharts(document.querySelector("#chart3"), options);

    chart.render();

 });