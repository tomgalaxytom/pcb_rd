let isHorizontal = true;
let chart; // Store the chart instance

const renderChart = () => {
    const options = {
        chart: {
            type: 'bar',
            width: '500px',
        },
        plotOptions: {
            bar: {
                horizontal: isHorizontal,
                animations: {
                    enabled: true,
                    speed: 1900, // Set the transition speed
                },
            },
        },
        series: [{
            name: 'Height in Feet',
            data: [2722, 2080, 2063, 1972, 1516],
        }],
        xaxis: {
            categories: ["Burj Khalifa", "Tokyo Sky Tree", "KVLY-TV mast", "Abraj Al-Bait Towers", "Bren Tower"],
        },
    };

    if (!chart) {
        // Create the chart instance only once
        chart = new ApexCharts(document.querySelector("#toggle_chart"), options);
        chart.render();
    } else {
        // Update the options for the existing chart
        chart.updateOptions({
            plotOptions: {
                bar: {
                    horizontal: isHorizontal,
                    animations: {
                        enabled: true,
                        speed: 100, // Set the transition speed again when updating
                    },
                },
            },
        });
    }
};

document.getElementById("toggleOrientation").addEventListener("click", () => {
    isHorizontal = !isHorizontal; // Toggle orientation
    renderChart(); // Re-render the chart with the new orientation
});

// Initial render
renderChart();
