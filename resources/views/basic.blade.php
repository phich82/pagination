<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Basic</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>
    <body>
        <div class="container">
            <h1>Basic</h1>

            <div class="container">
                <div class="errorsMsg"></div>
                <form method="post" action="/test/save" data-url="/test/update" id="frmBasic" data-token="{{ csrf_token() }}">
                    {{ csrf_field() }}
                    <div class="scheduledList"></div>
                    <div class="row">
                        <a href="javascript:void(0)" class="btn btn-link" onclick="addRow(this)">Add Row</a>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 10px;">
                            <button class="btn btn-primary btnSave" onclick="Mile.save(event)" disabled="disabled">Save</button>
                        </div>
                    </div>
                </form>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            {{-- <script src="{{ asset('js/test/Mile.js') }}"></script>  --}}
            <script>
                $(function() {
                    $(".datepicker").datepicker({
                        dateFormat: "yy-mm-dd",
                        // onSelect: function (date, obj) {
                        //     console.log(obj);
                        //     alert(date);
                        // }
                    });

                    // $('.start-date').change(function () {
                    //     updateBasic(this);
                    // });
                    
                    var scheduledSettings = sessionStorage.getItem('scheduledSettings');
                    if (scheduledSettings === null) {
                        scheduledSettings = <?php echo json_encode($scheduledSettings); ?>;
                        sessionStorage.setItem('scheduledSettings', JSON.stringify(scheduledSettings));
                    } else {
                        scheduledSettings = JSON.parse(scheduledSettings);
                    }
                    
                    var out = '';
                    if (Array.isArray(scheduledSettings)) {
                        scheduledSettings.forEach(function (row, i) {
                            out += `
                                <div class="row rowActive" data-id="id-`+(row.hasOwnProperty('id') ? row.id : row.tid)+`" data-type="`+(row.hasOwnProperty('id') ? 'id' : 'tid')+`" data-row="`+(i + 1)+`">
                                    <div class="col-md-4 form-group">
                                        <label>Start Date</label>
                                        <input type="text" name="planStartDate" onchange="updateBasic(this)" placeholder="yyyy-mm-dd" class="form-control start-date datepicker"/>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Amount</label>
                                        <input type="text" name="amount" onchange="updateBasic(this)" class="form-control"/>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>&nbsp;</label>
                                        <a href="javascript:void(0)" data-url="/test/destroy" onclick="deleteMile(this)" class="btn btn-danger form-control">X</a>
                                    </div>
                                </div>
                            `;
                        });
                    }
                    $('.scheduledList').html(out);
                });

                function updateBasic(objThis) {
                    var rowThis   = $(objThis).closest('.rowActive');
                    var startDate = rowThis.find('input[name="planStartDate"]').val();
                    var amount    = rowThis.find('input[name="amount"]').val();
                    console.log(startDate);
                    console.log(amount);
                }

                function deleteMile(objThis) {
                    var rowThis = $(objThis).closest('.rowActive');
                    var type = rowThis.data('type');
                    var id = rowThis.data('id');
                    var list = getScheduledSettings();
                    var len = list.length;
                    if (len) {
                        var flag = false;
                        for (var i = 0; i < len; i++) {
                            if (type == 'id' && list[i].id == id) {
                                flag = true;
                                list[i]['operation_flag'] = 3;
                                break;
                            } else if (type == 'tid' && list[i].hasOwnProperty('tid') && list[i].tid == id) {
                                console.log(i);
                                flag = true;
                                list.splice(i, 1);
                                break;
                            }
                        }
                        // no exist in cookie
                        if (!flag) {
                            rowThis.remove();
                        } else {
                            sessionStorage.setItem('scheduledSettings', JSON.stringify(list));
                            console.log(list);
                        }
                    } else {
                        rowThis.remove();
                    }
                }

                function getScheduledSettings() {
                    var scheduledSettings = sessionStorage.getItem('scheduledSettings');
                    if (scheduledSettings === null) {
                        scheduledSettings = <?php echo json_encode($scheduledSettings); ?>;
                        sessionStorage.setItem('scheduledSettings', JSON.stringify(scheduledSettings));
                    } else {
                        scheduledSettings = JSON.parse(scheduledSettings);
                    }
                    return scheduledSettings;
                }

                function isValidDateYmd(dateStr) {

                }

                function is_numeric(n) {

                }

                function addRow(objThis) {
                    var container = $(objThis).closest('div.scheduledList');
                    var list = getScheduledSettings();
                    var id = (list === null ? 0 : list.length) + 1;
                    var data = {
                        tid: id,
                        plan_start_date: '',
                        amount: '',
                        created_user: '',
                        operation_flag: 1
                    };
                    list.push(data);
                    sessionStorage.setItem('scheduledSettings', JSON.stringify(list));
                    var row = `
                        <div class="row rowActive" data-id="`+(id)+`" data-type="tid" data-row="`+(id)+`">
                            <div class="col-md-4 form-group">
                                <label>Start Date</label>
                                <input type="text" name="planStartDate" onchange="updateBasic(this)" placeholder="yyyy-mm-dd" class="form-control start-date datepicker"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Amount</label>
                                <input type="text" name="amount" onchange="updateBasic(this)" class="form-control"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>&nbsp;</label>
                                <a href="javascript:void(0)" data-url="/test/destroy" onclick="deleteMile(this)" class="btn btn-danger form-control">X</a>
                            </div>
                        </div>
                    `;
                    //$(row).insertBefore(container);
                    container.append(row);
                }
            </script>

        </div>
    </body>
</html>
