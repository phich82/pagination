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
                <div class="errorsMsg"></div>
                <form method="post" action="/test/save" data-url="/test/update" id="frmBasic" data-token="{{ csrf_token() }}">
                    {{ csrf_field() }}
                    <div class="row rowActive" data-id="id-1" data-row="1">
                        <div class="col-md-4 form-group">
                            <label>Start Date</label>
                            <input type="text" name="startDate[]" onchange="Mile.updateBasic(this)" id="sd_1" placeholder="yyyy-mm-dd" class="form-control start-date datepicker"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Amount</label>
                            <input type="text" name="amount[]" id="am_1" onchange="Mile.updateBasic(this)" class="form-control"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>&nbsp;</label>
                            <a href="javascript:void(0)" data-url="/test/destroy" onclick="Mile.destroyMile(this)" class="btn btn-danger form-control">X</a>
                        </div>
                    </div>
                    <div class="row rowActive" data-id="id-2" data-row="2">
                        <div class="col-md-4 form-group">
                            <label>Start Date</label>
                            <input type="text" name="startDate[]" onchange="Mile.updateBasic(this)" id="sd_2" placeholder="yyyy-mm-dd" class="form-control start-date datepicker"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Amount</label>
                            <input type="text" name="amount[]" onchange="Mile.updateBasic(this)" id="am_2" class="form-control"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>&nbsp;</label>
                            <a href="javascript:void(0)" data-url="/test/destroy" onclick="Mile.destroyMile(this)" class="btn btn-danger form-control">X</a>
                        </div>
                    </div>
                    <div class="row rowActive" data-id="tid-2" data-row="3">
                            <div class="col-md-4 form-group">
                                <label>Start Date</label>
                                <input type="text" name="startDate[]" onchange="Mile.updateBasic(this)" id="tsd_2" placeholder="yyyy-mm-dd" class="form-control start-date datepicker"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Amount</label>
                                <input type="text" name="amount[]" onchange="Mile.updateBasic(this)" id="tam_2" class="form-control"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>&nbsp;</label>
                                <a href="javascript:void(0)" data-url="/test/destroy" onclick="Mile.destroyMile(this)" class="btn btn-danger form-control">X</a>
                            </div>
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
            <script src="{{ asset('js/test/Mile.js') }}"></script>
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
                });
            </script>

        </div>
    </body>
</html>
