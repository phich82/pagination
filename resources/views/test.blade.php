<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Pagination - Laravel</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>
    <body>
        <div class="container">
            <h1>Posts</h1>

            <div class="container">
                <form method="post" id="frmBasic">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Start Date</label>
                            <input type="text" name="startDate" onchange="updateBasic(this)" data-id="1" class="form-control start-date datepicker"/>
                        </div>
                        <div class="col-md-4">
                            <label>Amount</label>
                            <input type="text" name="amount" data-id="1" onchange="updateBasic(this)" class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4">
                                <label>Start Date</label>
                                <input type="text" name="startDate" onchange="updateBasic(this)" data-id="2" class="form-control start-date datepicker"/>
                            </div>
                            <div class="col-md-4">
                                <label>Amount</label>
                                <input type="text" name="amount" onchange="updateBasic(this)" data-id="2" class="form-control"/>
                            </div>
                        </div>
                </form>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

            <script>
                $(function() {
                    $(".datepicker2").datepicker({
                        dateFormat: "yy-mm-dd",
                        // onSelect: function (date, obj) {
                        //     console.log(obj);
                        //     alert(date);
                        // }
                    });

                    var errors = [];
                    $('.start-date').change(function () {
                        validateScheduleBasic(this);
                    });
                });

                function validateScheduleBasic(objThis) {
                    $(objThis).parent().find('label.error').remove();
                    var rowThis = $(objThis).closest('div.row');

                    var inputStartDate = rowThis.find('input[name="startDate"]'); // $(objThis).val();
                    var inputAmount    = rowThis.find('input[name="amount"]');
                    var startDate = inputStartDate.val();
                    var amount    = inputAmount.val();

                    if (isValidDateYmd(startDate, '-')) {
                        if (!is_numeric(amount)) {
                            inputAmount.parent().find('label.error').remove();
                            showError('Please enter a valid number.', inputAmount);
                        } else {
                            console.log('ok');
                        }
                    } else {
                        showError('Please enter a valid date.', inputStartDate);
                    }
                }

                function showError(message, obj) {
                    $('<label style="color:red;" class="error">' + message + '</label>').insertBefore(obj);
                }

                function updateBasic(objThis) {
                    validateScheduleBasic(objThis);
                }

                function update(e) {
                    e.preventDefault();
                    var form = $('#frmBasic');
                    var data = form.serialize();
                    $.ajax({
                        url : '/basic/update',
                        method: 'post',
                        data: data,
                        dataType: 'json',
                    }).done(function (data) {
                        console.log(data);
                    }).fail(function () {
                        console.log('Posts could not be loaded.');
                    });
                }

                function is_numeric(n) {
                    return !isNaN(parseFloat(n)) && isFinite(n);
                }

                // Validate date with format "yyyy/mm/dd"
                function isValidDateYmd(dateStr, delimiter) {
                    delimiter = delimiter ? delimiter : '/';
                
                    // for yyyy-mm-dd
                    var s = "^\\d{4}\\" + delimiter + "\\d{1,2}\\" + delimiter + "\\d{1,2}$";
                    var pattern = new RegExp(s, "gi");
                
                    // check format
                    if(!pattern.test(dateStr)) {
                        return false;
                    }

                    // get each part of date
                    var p = dateStr.split(delimiter);
                    var d = parseInt(p[2], 10);
                    var m = parseInt(p[1], 10);
                    var y = parseInt(p[0], 10);

                    // Check month and year
                    if(y < 1970 || m <= 0 || m > 12) {
                        return false;
                    }
                        
                    // number of days Of the each month in a year
                    var numDaysOfMonth = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

                    // Adjust for leap years
                    if(y % 400 == 0 || (y % 100 != 0 && y % 4 == 0)) {
                        numDaysOfMonth[1] = 29;
                    }

                    // Check the range of the day
                    return d > 0 && d <= numDaysOfMonth[m - 1];
                }
            </script>

        </div>
    </body>
</html>