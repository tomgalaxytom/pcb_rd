<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STP DataTable</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        .action-icon {
            cursor: pointer;
            color: blue;
        }
        .table-light {

            --bs-table-bg: #3fc2a3 !important;
            color: #fff;
        }
        .icon {
            font-size: 24px;
            color: #333;
        }
        .dt-button{
            background: #212542 !important;
            color:white !important;
        }
        .sewage_div{
    background-color: #3fc2a3 !important;
    color:#FFF;
}
    </style>
</head>
<body>

    <?php include "config.php";?>

<div class="container mt-5">

    <div class="sewage_div"><h2 class="text-center"><?php echo strtoupper("Local Body Sewage Treatment Plants");?></h2></div>

    <table id="stpTable" class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>S.No</th>
                <th>Action</th>
                <th>Unit Name</th>
                <th>Category(KLD/MLD)</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>



<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Fetch data using AJAX
    $.ajax({
        url: 'fetch_data.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            var tableBody = '';
            var i = 1;
            $.each(data, function(index, item) {
                tableBody += '<tr>';
                tableBody += '<td>' + i++ + '</td>';
                tableBody += '<td><span class="action-icon" onclick="window.location.href=\'details.php?id=' + item.id + '\'"><i class="fas fa-desktop icon"></i></span></td>';
                tableBody += '<td>' + item.unitname + '</td>';
                tableBody += '<td>' + item.category + '</td>';
                tableBody += '<td>' + item.city + '</td>';
                tableBody += '</tr>';
            });
            $('#stpTable tbody').html(tableBody);

            // Initialize DataTable after populating data
            $('#stpTable').DataTable({
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
                     "width": "100px" ,
                     "className": 'dt-center' // Set the width to 100px
                },
                {
                    "targets": [1],  // Target the third column
                    "width": "150px" ,
                    "className": 'dt-center' // Set the width to 150px
                },
                {
                    "targets": [3],  // Target the third column
                    "width": "50px" ,
                    "className": 'dt-center' // Set the width to 150px
                }
                        ]// Set initial page length
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data: ' + textStatus, errorThrown);
        }
    });
});

</script>

</body>
</html>
