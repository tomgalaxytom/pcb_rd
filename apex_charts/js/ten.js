// Create Loader Bar
document.addEventListener("DOMContentLoaded", function() {
    var options = {
        chart: {
            type: 'radialBar',
            width: '500px',
        },
        series: [0],  // Start at 0 for the loader
        labels: ["Progress"],
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '20px',
                        color: '#888',
                        offsetY: 10,
                    },
                    value: {
                        fontSize: '30px',
                        color: '#111',
                        offsetY: -25,
                    },
                },
            },
        },
        fill: {
            colors: ['#008FFB'],
        },
        stroke: {
            lineCap: 'round'
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart10"), options);
    chart.render();

    // Simulate loading
    let progress = 0;
    const interval = setInterval(() => {
        if (progress >= 100) {
            clearInterval(interval);
        } else {
            progress += 5;  // Increment progress
            chart.updateOptions({ series: [progress] });
        }
    }, 100);  // Update every 100 milliseconds
});
//Create Loader Bar