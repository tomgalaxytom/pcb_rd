document.addEventListener("DOMContentLoaded", function(){

    var options = {

        chart: {

            type: 'bar',//line,bar
            width: '500px'

        },

        series: [{

            name: 'Temperature in Fahrenheit',

            data: [43, 53, 50, 57]

        }],

        xaxis: {

            categories: [1,2,3,4]

        }

    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);

    chart.render();

 });