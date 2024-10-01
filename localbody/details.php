<?php
include 'config.php';
     $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    // Fetch the record from the database
    $sql = "SELECT * FROM `stp_data` WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r( $record);
    if (!$record) {
        echo "Record not found.";
        exit;
    }
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Localbody Sevage Treatment Plan</title>
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lato-font/3.0.0/css/lato-font.min.css">
  <script>
    $(document).ready(function() { //dom ready start
      $('#param_select').on('change', function() {
    const selectedOptions = $(this).val();
    if (selectedOptions.length === 0) {
        // If no options are selected, hide all tables
        $('#ph, #bod, #cod, #tss').hide();
        $('#ph_header, #bod_header, #cod_header, #tss_header').hide();
    } else {
         // Toggle visibility of tables and headers based on the selected parameters
         $('#ph').toggle(selectedOptions.includes('PH'));
        $('#ph_header').toggle(selectedOptions.includes('PH'));
        $('#bod').toggle(selectedOptions.includes('BOD'));
        $('#bod_header').toggle(selectedOptions.includes('BOD'));
        $('#cod').toggle(selectedOptions.includes('COD'));
        $('#cod_header').toggle(selectedOptions.includes('COD'));
        $('#tss').toggle(selectedOptions.includes('TSS'));
        $('#tss_header').toggle(selectedOptions.includes('TSS'));
    }
});
      document.getElementById("redirectButton").onclick = function() {
    window.location.href = "index.php"; // Redirects to the new file/page
  };
  //Select2 Multiselect Start
//in multiselect select all/un select all
 // Custom adapter for select all and deselect all
 $.fn.select2.amd.define('select2/selectAllAdapter', [
            'select2/utils',
            'select2/dropdown',
            'select2/dropdown/attachBody'
        ], function (Utils, Dropdown, AttachBody) {
            function SelectAll() {}
            SelectAll.prototype.render = function (decorated) {
                var self = this,
                    $rendered = decorated.call(this),
                    $btnContainer = $('<div class="select-all-container"></div>'),
                    $selectAll = $('<div class="select-all">Select All</div>'),
                    $deselectAll = $('<div class="select-all">Deselect All</div>');
                // Append buttons to the container
                $btnContainer.append($selectAll).append($deselectAll);
                $rendered.find('.select2-results').prepend($btnContainer);
                // Handle select all click
                $selectAll.on('click', function () {
                    $('#param_select option').prop('selected', true).trigger('change');
                    self.trigger('close');
                });
                // Handle deselect all click
                $deselectAll.on('click', function () {
                    $('#param_select option').prop('selected', false).trigger('change');
                    self.trigger('close');
                });
                return $rendered;
            };
            return Utils.Decorate(
                Utils.Decorate(
                    Dropdown,
                    AttachBody
                ),
                SelectAll
            );
        });
        $(document).ready(function () {
            // Initialize Select2 with custom select all/deselect all
            $("#param_select").select2({
                placeholder: "Select parameters",
                templateResult: function (data) {
                    if (!data.id) {
                        return data.text; // Return the placeholder
                    }
                    var checkbox = '<span class="custom-checkbox"></span>' + data.text;
                    return $('<div>' + checkbox + '</div>');
                },
                templateSelection: function (data) {
                    return data.text; // Display selected option text
                },
                dropdownAdapter: $.fn.select2.amd.require('select2/selectAllAdapter'),
                allowClear: true,
                closeOnSelect: false
            });
            // Update checkbox state on change
            $('#param_select').on('change', function () {
                var $options = $(this).find('option');
                $options.each(function () {
                    var $option = $(this);
                    var isChecked = $option.prop('selected');
                    var $checkbox = $('.custom-checkbox').eq($option.index());
                    if (isChecked) {
                        $checkbox.addClass('checked');
                    } else {
                        $checkbox.removeClass('checked');
                    }
                });
            });
            // Trigger change event on initialization to set checkbox state
            $('#param_select').trigger('change');
        });
//in multiselect select all/un select all
      $('#save-namination').on('click', function(e) { // Button Submit Start
        e.preventDefault(); // Prevent form submission
        var selectedOptions = $('#param_select').val();
        // Check if no options are selected
      if (!selectedOptions || selectedOptions.length === 0) {
        $('#select-error').show(); // Show error message
        // Clear previous charts
        const chartContainers = ["#ph", "#bod", "#cod", "#tss"];
                chartContainers.forEach(function(container) {
                    // Clear existing chart or clear the container
                    const chartElement = document.querySelector(container);
                    if (chartElement) {
                        chartElement.innerHTML = ''; // Clear the container
                    }
                });
                return false;
      } else {
        $('#select-error').hide(); // Hide error message if valid
        // Proceed with form submission or other logic
        console.log('Selected options:', selectedOptions);
      }
      var fromDate = $('#from_date').val();
      var toDate = $('#to_date').val();
      var fromDateObj = new Date(fromDate.split('-').reverse().join('-'));
      var toDateObj = new Date(toDate.split('-').reverse().join('-'));
      if (fromDateObj > toDateObj) {
            // Show error message
            $('#from_date_error').text('From Date cannot be later than To Date.').show();
            return false;
        } else {
            // Hide error message
            $('#from_date_error').hide();
        }
      // Basic validation to check if the input is empty
      if (!fromDate) {
        $('#from_date_error').text('Please Enter a From Date.').show(); // Show error if date is empty
        return false;
      } else {
        // Validate if the date is in the correct format (DD/MM/YYYY)
        var datePattern = /^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$/;
        if (!datePattern.test(fromDate)) {
          $('#from_date_error').text('Please enter a From date in DD-MM-YYYY format.').show(); // Show format error
        } else {
          $('#from_date_error').hide(); // Hide error if valid
          // Proceed with form submission or other logic
          console.log('Date is valid:', fromDate);
        }
      }
      // Basic validation to check if the input is empty
      if (!toDate) {
        $('#to_date_error').text('Please Enter a To Date.').show(); // Show error if date is empty
        return false;
      }
      else {
        // Validate if the date is in the correct format (DD/MM/YYYY)
        var datePattern = /^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$/;
        if (!datePattern.test(toDate)) {
          $('#to_date_error').text('Please enter a To date in DD-MM-YYYY format.').show(); // Show format error
        } else {
          $('#to_date_error').hide(); // Hide error if valid
          // Proceed with form submission or other logic
          console.log('Date is valid:', toDate);
        }
      }
        const headings = ["#ph_header", "#bod_header", "#cod_header", "#tss_header"];
        headings.forEach(function(header) {
            $(header).text(''); // Clear the heading text
        });
      var formdata = new FormData(document.getElementById("localbody_form"));
      formdata.append('id', $("#idValue").val());
       // Show the GIF loader before the AJAX call
  $('#loader').show();
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
         // $('#loader').hide();
           // Simulate delay to show loader (remove in production if unnecessary)
      setTimeout(function() {
        // Hide the loader after a small delay
        $('#loader').hide();
        // Show success message
        $('#success-message').text('Form submitted successfully!').show();
      }, 500); // Adjust the delay as needed
//debugger;
      if (response[0].repo_form == "tblFormat") {  // For Table Format start
        response.forEach(function(item) {
                const labels = item.result.map(data => data.date);
                const salesData = item.result.map(data => data.value);
                let chartContainerId = '';
                let headerId = '';
                // Determine chart container based on parameter type
                if (item.param_type === "PH" ) {
                    chartContainerId = "#ph";
                    headerId = "#ph_header";
                } else if (item.param_type === "BOD") {
                    chartContainerId = "#bod";
                    headerId = "#bod_header";
                } else if (item.param_type === "COD") {
                    chartContainerId = "#cod";
                    headerId = "#cod_header";
                } else {
                    chartContainerId = "#tss";
                    headerId = "#tss_header";
                }
                // Set header text
                $(headerId).text(item.param_type + " Levels");
                // Properly formatted HTML for the table
                $(chartContainerId).html(`
                    <table id="stpTableCategory_${item.param_type}" class="table table-striped table-bordered">
                        <thead class="table-light2">
                            <tr>
                                <th>S.No</th>
                                <th>Action</th>
                                <th>Parameter Type</th>
                                <th>Date</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                `);
                // Generate table rows
                var tableBody = '';
                $.each(item.result, function(index, rowItem) {
                  let parts = rowItem.date.split('-');  // Split by '-'
                  let formattedDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                    tableBody += '<tr>';
                    tableBody += '<td>' + (index + 1) + '</td>';
                    tableBody += `<td><span class="action-icon" onclick="window.location.href='details.php?id=${rowItem.id}'"><i class="fas fa-desktop icon"></i></span></td>`;
                    tableBody += '<td>' + item.param_type + '</td>';
                    tableBody += '<td>' + formattedDate + '</td>';
                    tableBody += '<td>' + rowItem.value + '</td>';
                    tableBody += '</tr>';
                });
                $(`#stpTableCategory_${item.param_type} tbody`).append(tableBody); // Append the rows to the table body
                $(`#stpTableCategory_${item.param_type}`).DataTable({
                  "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                dom: '<"d-flex justify-content-between"lfB>rtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ],
                pageLength: 5,
                "columnDefs": [

                    {
                    "targets": [0],  // Target the first column (0 = first column)
                     "width": "50px" ,
                     "className": 'dt-center' // Set the width to 100px
                },
                {
                    "targets": [1],  // Target the third column
                    "width": "50px" ,
                    "className": 'dt-center' // Set the width to 150px
                },

                        ]// Set initial page length
            });
            });
      }// For Table Format end
      else{// For Graph Format start
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
                            type: 'line',
                           // width: "500px",
                            width: '100%', // This should be set to '100%' to use the full width
                              height: '400px'
                        },
                        stroke: {
                curve: 'smooth'
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
      }//For Graph Format start
        },// Success End
        error: function(xhr, status, error) {
            console.error("Error fetching data:", error);
            $('#loader').hide();
        }
    });
      });// Button Submit Start
    });//dom ready end
    $.datepicker.setDefaults({
	showOn: "button",
	buttonImage: "images/datepicker.png",
	buttonText: "Date Picker",
	buttonImageOnly: true,
	dateFormat: 'dd-mm-yy'
});
  $( function() {
    $( "#from_date" ).datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: '2020:+0'
 });
  } );
  $( function() {
    $( "#to_date" ).datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: '2020:+0'
 });
  } );
  </script>
  </head>
  <body class="body_class">
    <div class="container mt-5">
    <input type="button" class="btn back_btn" name="save-nomination" value="Back" id="redirectButton">
      <div class="unit_name_div"><h1 class="mb-4 text-center"> <?php echo strtoupper(htmlspecialchars($record['unitname'])); ?> </h1></div>

      <div class="container mt-3">
         <!-- Monitoring Station Start -->
      <div class="row mb-3">
            <div class="col-sm-6">
              <!-- <label for="password" class="form-label">Category:</label> -->
                <div class="row mb-3">
                  <div class="col-sm-2">
                  <label for="password" class="form-label"><b>Category:</b></label>
                  </div>
                  <div class="col-sm-6">
                  <label for="email" class="form-label"> <?php echo htmlspecialchars($record['category']); ?> </label>
                  </div>
                </div>
            </div>
            <div class="col-sm-6">
            <div class="row mb-3">
                  <div class="col-sm-2">
                  <label for="password" class="form-label"><b>City:</b></label>
                  </div>
                  <div class="col-sm-6">
                  <label for="email" class="form-label"> <?php echo htmlspecialchars($record['city']); ?> </label>
                  </div>
                </div>

            </div>
            <!-- <div class="col-sm-8">

            </div> -->
          </div>
           <!-- Monitoring Station End -->
        <form   name="localbody_form" method="post" id="localbody_form" >
          <!-- Monitoring Type Start -->
          <div class="row mb-3">
            <div class="col-sm-4">
              <label for="email" class="form-label"><b>Monitoring Type:</b></label>
            </div>
            <div class="col-sm-8">
              <label for="email" class="form-label">Effluent</label>
            </div>
          </div>
          <!-- Monitoring Type End -->
          <!-- Monitoring Station Start -->
          <div class="row mb-3">
            <div class="col-sm-4">
              <label for="password" class="form-label"><b>Monitoring Station:</b></label>
            </div>
            <div class="col-sm-8">
              <label for="email" class="form-label">STP</label>
            </div>
          </div>
           <!-- Monitoring Station End -->
            <!-- Loader with GIF -->
          <div id="loader" style="display:none;">
            <img src="images/settings.gif" alt="Loading..." />
          </div>
           <!-- Parameter Start -->
          <div class="row mb-3">
            <div class="col-sm-4">
              <label for="password" class="form-label"><b>Parameter:</b></label>
            </div>
            <div class="col-sm-3">
              <select class="form-select" id="param_select" name="param_select[]"  multiple required>
                <option>PH</option>
                <option>BOD</option>
                <option>COD</option>
                <option>TSS</option>
              </select>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4">
              </div>
              <div class="col-sm-3">
              <div id="select-error" style="color: red; display: none;">Please Select at least one parameter.</div>
              </div>
            </div>
          </div>
            <!-- Parameter End -->
            <!-- Report Format Tabular Start -->
          <div class="row mb-3">
            <div class="col-sm-4">
              <label for="password" class="form-label"><b>Report Format Tabular:</b></label>
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
            <!-- Criteria Start -->
          <div class="row mb-3">
            <div class="col-sm-4">
              <label for="email" class="form-label"><b>Criteria:</b></label>
            </div>
            <div class="col-sm-8">
              <label for="email" class="form-label">15 Minutes</label>
            </div>
          </div>
           <!-- Criteria End -->
          <!-- Date Picker Start -->
          <div class="row mb-3">
            <div class="col-sm-4">
              <label for="password" class="form-label"><b>Date Range:</b></label>
            </div>
            <div class="col-sm-8">
              <div class="row mb-3">
                <div class="col-sm-4">
                <div class="input-group flex-nowrap">
  <input type="text" class="form-control" id="from_date" name ="from_date" placeholder="From Date" aria-label="fromDate" aria-describedby="addon-wrapping">
</div>
<div id="from_date_error" style="color: red; display: none;">Please Enter a valid From date (YYYY-MM-DD).</div>
                </div>
                <div class="col-sm-4">
                <div class="form-check">
                <div class="input-group flex-nowrap">
  <input type="text" class="form-control" id="to_date" placeholder="To Date" name ="to_date" aria-label="toDate" aria-describedby="addon-wrapping" >
</div>
<div id="to_date_error" style="color: red; display: none;">Please Enter a valid To date (YYYY-MM-DD).</div>
              </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Date Picker end -->
           <!-- Button start-->
           <div class="row mb-3">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-4">
              <!-- <button type="button" class="btn btn-primary" id="submitBtn">Submit </button> -->
              <!-- <input type="submit" class="btn btn-primary" id="submitBtn"> -->
              <input type="button" class="btn btn-primary" name="save-nomination" value="Fetch" id="save-namination">
              <input type="hidden"  id="idValue" name="idValue" value ="<?php echo htmlspecialchars($record['id']); ?>"> </input>
            </div>
          </div>
           <!-- Button start-->
        </form>
      </div>
    </div>
    <!-- APex Chart Container -->
 <!-- PH Chart Start-->
    <div class="container mt-12">
      <h1 class="text-center" id="ph_header"></h1>
      <div class="row">
        <div class="col-sm-12 p-12  text-white">
          <div id="ph" class="chart"></div>
        </div>
      </div>
    </div>
 <!-- PH Chart End-->
  <!-- BOD Chart Start-->
  <div class="container mt-12">
      <h1 class="text-center" id="bod_header"></h1>
      <div class="row">
        <div class="col-sm-12 p-12  text-white">
          <div id="bod" class="chart"></div>
        </div>
      </div>
    </div>
 <!-- BOD Chart End-->
  <!-- COD Chart Start-->
  <div class="container mt-12">
      <h1 class="text-center" id="cod_header"></h1>
      <div class="row">
        <div class="col-sm-12 p-12  text-white">
          <div id="cod" class="chart"></div>
        </div>
      </div>
    </div>
 <!-- COD Chart End-->
   <!-- TSS Chart Start-->
   <div class="container mt-12">
      <h1 class="text-center" id="tss_header"></h1>
      <div class="row">
        <div class="col-sm-12 p-12  text-white">
          <div id="tss" class="chart"></div>
        </div>
      </div>
    </div>
 <!-- TSS Chart End-->
    <!-- APex Chart Container -->
  </body>
</html>