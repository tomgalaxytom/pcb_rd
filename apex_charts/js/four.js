document.addEventListener("DOMContentLoaded", function(){

    var options = {
        plotOptions: {
            bar: {
              horizontal: true, //horizontal bar chart
            },
          },


        chart: {

            type: 'bar',//line,bar
            width:'500px'

        },

        series: [{

            name: 'Height in Feet',

            data: [2722, 2080, 2063, 1972, 1516]

        }],


        xaxis: {

            categories: ["Burj Khalifa",
      "Tokyo Sky Tree",
      "KVLY-TV mast",
      "Abraj Al-Bait Towers",
      "Bren Tower",]

        }

    };

    var chart = new ApexCharts(document.querySelector("#chart4"), options);

    chart.render();

 });