<?php
include 'config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the record from the database
$sql = "SELECT * FROM `stp_data` WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    echo "Record not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Localbody Sewage Treatment Plan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link href="css/select2.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/select2.min.js"></script>
    <script src="js/apexcharts.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <link href="css/datatables.min.css" rel="stylesheet" />

    <script>
    $(document).ready(function() {
        // Redirect button functionality
        document.getElementById("redirectButton").onclick = function() {
            window.location.href = "index.php"; // Redirect to the new file/page
        };

        // Initialize select2 for multi-select
        $("#param_select").select2({
            placeholder: "Select parameters",
            allowClear: true
        });

        // Form submission logic
        $('#save-namination').on('click', function(e) {
            e.preventDefault(); // Prevent form submission
            var selectedOptions = $('#param_select').val();

            // Validate selected options
            if (!selectedOptions || selectedOptions.length === 0) {
                $('#select-error').show();
                clearCharts(); // Clear charts if no selection is made
                return false;
            } else {
                $('#select-error').hide();
            }

            // Validate date fields
            var fromDate = validateDate('#from_date', '#from_date_error');
            var toDate = validateDate('#to_date', '#to_date_error');

            if (!fromDate || !toDate) return false;

            clearCharts(); // Clear previous charts

            var formdata = new FormData(document.getElementById("localbody_form"));
            formdata.append('id', $("#idValue").val());

            $('#loader').show(); // Show loader

            // Fetch data using AJAX
            $.ajax({
                url: 'fetch_data_from_params.php',
                data: formdata,
                method: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    setTimeout(function() {
                        $('#loader').hide();
                        $('#success-message').text('Form submitted successfully!').show();
                    }, 500);

                    if (response.length > 0 && response[0].repo_form === "tblFormat") {
                        processTableFormat(response);
                    } else {
                        processGraphFormat(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                    $('#loader').hide();
                }
            });
        });

        // Initialize datepickers
        initDatePicker("#from_date");
        initDatePicker("#to_date");

    }); // document ready end

    // Date validation function
    function validateDate(selector, errorSelector) {
        var date = $(selector).val();
        var datePattern = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;

        if (!date) {
            $(errorSelector).text('Please enter a valid date.').show();
            return false;
        } else if (!datePattern.test(date)) {
            $(errorSelector).text('Please enter a date in DD/MM/YYYY format.').show();
            return false;
        } else {
            $(errorSelector).hide();
            return date;
        }
    }

    // Clear existing charts
    function clearCharts() {
        const chartContainers = ["#ph", "#bod", "#cod", "#tss"];
        chartContainers.forEach(function(container) {
            const chartElement = document.querySelector(container);
            if (chartElement) {
                chartElement.innerHTML = ''; // Clear the container
            }
        });
    }

    // Initialize datepicker
    function initDatePicker(selector) {
        $(selector).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '2020:+0',
            dateFormat: 'dd-mm-yy'
        });
    }

    // Process Table Format
    function processTableFormat(response) {
        response.forEach(function(item) {
            var tableBody = '';
            var tableId = 'stpTableCategory_' + item.param_type;

            // Determine table container and header
            var chartContainerId = "#" + item.param_type.toLowerCase();
            var headerId = "#" + item.param_type.toLowerCase() + "_header";

            // Set the header text for the parameter
            $(headerId).text(item.param_type + " Levels");

            // Generate the HTML for the table
            $(chartContainerId).html(`
                <table id="${tableId}" class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Action</th>
                            <th>Parameter Type</th>
                            <th>Data</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            `);

            // Append rows to the table body
            $.each(item.result, function(index, rowItem) {
                tableBody += `<tr>
                    <td>${index + 1}</td>
                    <td><span class="action-icon" onclick="window.location.href='details.php?id=${rowItem.id}'"><i class="fas fa-desktop icon"></i></span></td>
                    <td>${item.param_type}</td>
                    <td>${rowItem.date}</td>
                    <td>${rowItem.value}</td>
                </tr>`;
            });
            $(`#${tableId} tbody`).append(tableBody);

            // Initialize DataTable for each parameter type
            $(`#${tableId}`).DataTable({
                dom: 'Bfrtip',
                buttons: ['excelHtml5', 'pdfHtml5'],
                pageLength: 5
            });
        });
    }

    // Process Graph Format
    function processGraphFormat(response) {
        response.forEach(function(item) {
            const labels = item.result.map(data => data.date);
            const values = item.result.map(data => data.value);

            // Determine chart container and header based on parameter type
            var chartContainerId = "#" + item.param_type.toLowerCase();
            var headerId = "#" + item.param_type.toLowerCase() + "_header";

            $(headerId).text(item.param_type + " Levels");

            // Chart options
            const options = {
                chart: {
                    type: 'bar',
                    width: '100%',
                    height: '400px'
                },
                series: [{
                    name: 'Value',
                    data: values
                }],
                xaxis: {
                    categories: labels
                }
            };

            // Render the chart
            const chart = new ApexCharts(document.querySelector(chartContainerId), options);
            chart.render();
        });
    }

    </script>
</head>
<body>
    <div class="container mt-5">
        <input type="button" class="btn btn-primary" value="Back" id="redirectButton">
        <h1 class="mb-4 text-center"><?php echo htmlspecialchars($record['unitname']); ?></h1>
        <div class="container mt-3">
            <form name="localbody_form" method="post" id="localbody_form">
                <!-- Monitoring Type Start -->
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label class="form-label">Monitoring Type:</label>
                    </div>
                    <div class="col-sm-8">
                        <label class="form-label">Effluent</label>
                    </div>
                </div>
                <!-- Monitoring Station Start -->
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label class="form-label">Monitoring Station:</label>
                    </div>
                    <div class="col-sm-8">
                        <label class="form-label">STP</label>
                    </div>
                </div>
                <!-- Parameter Selection -->
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label class="form-label">Parameter</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-select" id="param_select" name="param_select[]" multiple required>
                            <option value="PH">PH</option>
                            <option value="BOD">BOD</option>
                            <option value="COD">COD</option>
                            <option value="TSS">TSS</option>
                        </select>
                        <div id="select-error" class="text-danger" style="display: none;">Please select at least one parameter.</div>
                    </div>
                </div>
                <!-- Report Format Tabular Start -->
          <div class="row mb-3">
            <div class="col-sm-4">
              <label for="password" class="form-label">Report Format Tabular</label>
            </div>
            <div class="col-sm-8">
              <div class="row mb-3">
                <div class="col-sm-4">
                <div class="form-check">
                <input type="radio" class="form-check-input" id="radio1" name="optradio" value="tblFormat" checked>Table Format <label class="form-check-label" for="radio1"></label>
              </div>
                </div>
                <div class="col-sm-4">
                <div class="form-check">
                <input type="radio" class="form-check-input" id="radio2" name="optradio" value="graph">Graph<label class="form-check-label" for="radio2"></label>
              </div>
                </div>
              </div>
            </div>
          </div>
           <!-- Report Format Tabular End -->
                <!-- Date Inputs -->
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label class="form-label">From Date:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="from_date" name="from_date" required>
                        <div id="from_date_error" class="text-danger" style="display: none;"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label class="form-label">To Date:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="to_date" name="to_date" required>
                        <div id="to_date_error" class="text-danger" style="display: none;"></div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="row mb-3">
                    <div class="col-sm-12 text-center">
                        <button type="submit" id="save-namination" class="btn btn-success">Submit</button>
                        <div id="loader" class="spinner-border text-success" role="status" style="display: none;"></div>
                        <div id="success-message" class="text-success" style="display: none;"></div>
                    </div>
                </div>
                <input type="hidden" id="idValue" value="<?php echo $id; ?>" />
            </form>
        </div>

        <!-- Chart and Table Containers -->
        <div class="row mt-5">
            <div class="col-sm-6">
                <h4 id="ph_header"></h4>
                <div id="ph"></div>
            </div>
            <div class="col-sm-6">
                <h4 id="bod_header"></h4>
                <div id="bod"></div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-6">
                <h4 id="cod_header"></h4>
                <div id="cod"></div>
            </div>
            <div class="col-sm-6">
                <h4 id="tss_header"></h4>
                <div id="tss"></div>
            </div>
        </div>
    </div>
</body>
</html>
