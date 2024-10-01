document.addEventListener("DOMContentLoaded", function() {
    var options = {
        chart: {
            type: 'line',
            width: '500px',
        },
        series: [{
            name: "Guests",
            data: [19, 22, 20, 26]
        }, {
            name: "Subs",
            data: [103, 105, 98, 83]
        }],
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

    var chart = new ApexCharts(document.querySelector("#chart7"), options);
    chart.render();
});