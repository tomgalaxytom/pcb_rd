document.addEventListener("DOMContentLoaded", function(){

    var options = {

        chart: {
            // animations: {
            //     enabled: false, //no animations
            //   },

            type: 'line',//line,bar
            width:'700px'

        },
        //curve is smooth,stepline
        // stroke: {
        //     curve: 'stepline'
        // },

        series: [{

            name: 'sales',

            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]

        }],

        xaxis: {

           // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
           categories: ["2019-05-01", "2019-05-02", "2019-05-03", "2019-05-04","2019-05-05", "2019-05-06", "2019-05-07", "2019-05-08"]

        }

    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);

    chart.render();

 });