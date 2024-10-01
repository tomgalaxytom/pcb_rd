// Create series and options for 'guests' data
        const guestSeries = [{
            name: "Guests",
            data: [19, 22, 20, 26],
        }];

        const guestOptions = {
            chart: {
                id: "guest",
                group: "social",
                toolbar: { show: false },
            },
            xaxis: {
                categories: ["2019-05-01", "2019-05-02", "2019-05-03", "2019-05-04"],
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
            stroke: {
                curve: 'smooth'
            },
        };

        // Create series and options for 'subscribers' data
        const subSeries = [{
            name: "Subs",
            data: [103, 105, 98, 83],
        }];

        const subOptions = {
            chart: {
                id: "subs",
                group: "social",
                toolbar: { show: false },
            },
            xaxis: {
                categories: ["2019-05-01", "2019-05-02", "2019-05-03", "2019-05-04"],
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
            stroke: {
                curve: 'smooth'
            },
        };

        // Render the charts
        const guestChart = new ApexCharts(document.querySelector("#chart11"), { series: guestSeries, ...guestOptions });
        guestChart.render();

        const subChart = new ApexCharts(document.querySelector("#chart12"), { series: subSeries, ...subOptions });
        subChart.render();