<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select2 with Select All/Deselect All</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            min-height: 38px;
            padding: 6px;
        }

        /* Custom styles for buttons */
        .select2-dropdown .select-all-container {
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Space between buttons */
            padding: 8px; /* Padding around the buttons */
        }

        .select2-dropdown .select-all {
            padding: 8px;
            cursor: pointer;
            color: #007BFF;
            text-align: center;
            border: 1px solid #007BFF;
            border-radius: 4px; /* Rounded corners */
            margin-right: 5px; /* Space between buttons */
        }

        .select2-dropdown .select-all:hover {
            background-color: #f1f1f1;
        }

        /* Custom checkbox style */
        .custom-checkbox {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #007BFF;
            border-radius: 4px;
            background-color: white;
            margin-right: 8px;
            cursor: pointer;
        }

        .custom-checkbox.checked {
            background-color: #007BFF;
            border-color: #007BFF;
        }

        .custom-checkbox::after {
            content: "";
            position: absolute;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            left: 7px;
            top: 2px;
            opacity: 0;
        }

        .custom-checkbox.checked::after {
            opacity: 1;
        }
    </style>
</head>
<body>

    <select id="param_select" multiple="multiple" style="width: 300px;">
        <option value="PH">pH</option>
        <option value="BOD">BOD</option>
        <option value="COD">COD</option>
        <option value="TSS">TSS</option>
    </select>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
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
    </script>
</body>
</html>
