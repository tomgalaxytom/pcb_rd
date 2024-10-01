document.addEventListener("DOMContentLoaded", function() {
    var options = {
        chart: {
            type: 'line',
            width: '500px',
        },
        series: [

            {
                type: "line", //render a line chart for this data
                name: "Guests",
                data: [19, 22, 20, 26],
              },
              {
                type: "column", //use column chart here.
                name: "Subscribers",
                data: [103, 105, 98, 83],
              },


    ],
        xaxis: {
           // categories: ["Week 1", "Week 2", "Week 3", "Week 4"]
            categories: ["2019-05-01", "2019-05-02", "2019-05-03", "2019-05-04"]
        },
        title: {
            text: 'Guests vs Subscribers',
            align: 'center'
        },
        stroke: {
            curve: 'smooth'
        },
        tooltip: {
            shared: true,
            intersect: false
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart8"), options);
    chart.render();
});