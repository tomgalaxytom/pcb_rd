$(document).ready(function () {
    // Initialize select2
    $("#param_select").select2({
        placeholder: "Select parameters",
        allowClear: true
    });

    // Custom validation method for select2
    $.validator.addMethod("select2Required", function(value, element, arg){
        return $("#param_select").val() != null && $("#param_select").val().length > 0; // Ensure at least one option is selected
    }, "Please select at least one parameter.");

    // Custom validation for date format (if needed)
    $.validator.addMethod("dateFormat", function(value, element) {
        return this.optional(element) || /^\d{2}-\d{2}-\d{4}$/.test(value);
    }, "Please enter a valid date (dd-mm-yyyy).");

    // Initialize jQuery validation
    $('#localbody_form').validate({
        rules: {
            param_select: {
                select2Required: true // Now this will work with the select2 plugin
            },
            from_date: {
                required: true,
                dateFormat: true // Custom date format validation
            },
            to_date: {
                required: true,
                dateFormat: true
            }
        },
        messages: {
            param_select: {
                select2Required: "Please select at least one parameter."
            },
            from_date: {
                required: "Please enter a from date.",
                dateFormat: "Please enter a valid date (dd-mm-yyyy)."
            },
            to_date: {
                required: "Please enter a to date.",
                dateFormat: "Please enter a valid date (dd-mm-yyyy)."
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function (form) {
            form.submit();
          }
    });

    $("#localbody_form").on("submit", function(){
        debugger;
        const headings = ["#ph_header", "#bod_header", "#cod_header", "#tss_header"];
        headings.forEach(function(header) {
            $(header).text(''); // Clear the heading text
        });
      var formdata = new FormData(document.getElementById("send_bar_chat_id"));
      formdata.append('id', $("#idValue").val());
        //Ajax Start
        //  Fetch Data From Parameters start
    $.ajax({
        url: 'fetch_data_from_params.php',
        data : formdata,
        method:"POST",
        dataType: 'json',
        contentType:false,
        processData:false,
        success: function(response) {//Success Start
          // Clear previous charts
          const chartContainers = ["#ph", "#bod", "#cod", "#tss"];
                chartContainers.forEach(function(container) {
                    // Clear existing chart or clear the container
                    const chartElement = document.querySelector(container);
                    if (chartElement) {
                        chartElement.innerHTML = ''; // Clear the container
                    }
                });
          response.forEach(function(item) {
                    const labels = item.result.map(data => data.date);
                    const salesData = item.result.map(data => data.value);
                    let chartContainerId = '';
                    let headerId = '';
                    // Determine chart container based on parameter type
                    if (item.param_type === "PH") {
                        chartContainerId = "#ph";
                        headerId = "#ph_header";
                    } else if (item.param_type === "BOD") {
                        chartContainerId = "#bod";
                        headerId = "#bod_header";
                    }
                    else if (item.param_type === "COD") {
                        chartContainerId = "#cod";
                        headerId = "#cod_header";
                    }
                    else{
                      chartContainerId = "#tss";
                      headerId = "#tss_header";
                    }
                    // Add more conditions as needed for other parameter types
                    $(headerId).text(item.param_type + " Levels");
                    // Chart options
                    const options = {
                        chart: {
                            type: 'bar',
                           // width: "500px"
                            width: '100%', // This should be set to '100%' to use the full width
                              height: '400px'
                        },
                        series: [{
                            name: 'Value',
                            data: salesData
                        }],
                        xaxis: {
                            categories: labels
                        }
                    };
                    // Create the chart
                    const chart = new ApexCharts(document.querySelector(chartContainerId), options);
                    chart.render();
                });
        },// Success End
        error: function(xhr, status, error) {
            console.error("Error fetching data:", error);
        }
    });
        //Ajax Start
    });
});
