<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>New Promotion</title>

        <!-- Fonts -->
        <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        {{--  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">  --}}
        <style>

        </style>
    </head>
    <body>
        <div class="container">
            <h1>New Promotion</h1>
            <div class="container">
                <div class="msgErrors">
                    @if (\Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    @if (count($errors))
                        <ul>
                        @foreach ($errors->all() as $message)
                            <li class="alert alert-danger" style="list-style: none;">{{ $message }}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-2 text-right" style="height: 42px; line-height: 42px;">
                        <label>Unit</label>
                    </div>
                    <div class="col-md-10" style="padding-left:0;">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" style="border: 1px solid grey; border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none;">
                                    Activity
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="border: 1px solid grey; border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                    Area
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    {{-- activity form --}}
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form method="post" action="/promotions/store" id="frmPromotion">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-2 text-right">
                                    <label>Activity</label>
                                </div>
                                <div class="col-md-10" style="padding-left:0;">
                                    <input type="text" name="activity_title" value="{{ old('activity_title') }}" class="label" style="border: none; width: 100%; display: none;" readonly />
                                    <input type="hidden" name="activity_id" value="{{ old('activity_id') }}" />
                                    <input type="hidden" name="unit" value="1" />
                                    <input type="hidden" name="mile_type" value="2" />
                                    <p>
                                        <a href="#" data-toggle="modal" data-target="#activityModal" data-whatever="@mdo" id="selActivity">
                                            Select activity
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2 text-right" style="height: 42px; line-height: 42px;">
                                    <label>Activity Date</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">
                                            <label>Start Date</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px; margin-right: 30px;">
                                            <input type="text" name="activity_start_date" value="{{ old('activity_start_date') }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">    
                                            <label>End Date</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px;">
                                            <input type="text" name="activity_end_date" value="{{ old('activity_end_date') }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2 text-right" style="height: 42px; line-height: 42px;">
                                    <label>Purchase Date</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-xs-3" style="height: 42px; line-height: 42px;">
                                            <span>Start Date</span>
                                        </div>
                                        <div class="col-xs-3" style="margin-left: 20px; margin-right: 30px;">
                                            <input type="text" name="purchase_start_date" value="{{ old('purchase_start_date') }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-3" style="height: 42px; line-height: 42px;">    
                                            <label>End Date</label>
                                        </div>
                                        <div class="col-xs-3" style="margin-left: 20px;">
                                            <input type="text" name="purchase_end_date" value="{{ old('purchase_end_date') }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2 text-right" style="height: 42px; line-height: 42px;">
                                    <label>Rate type</label>
                                </div>
                                <div class="col-md-10" style="height: 42px; line-height: 42px;">
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            <input type="radio" name="rate_type" value="1" onclick="tickRateType(1)" {{ old('rate_type') <> 2 ? 'checked="checked"' : '' }}> <span>Change</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                        <input type="radio" name="rate_type" onclick="tickRateType(2)" value="2" {{ old('rate_type') == 2 ? 'checked="checked"' : '' }}> <span>Fix</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- show when tick on radio 'Change' -->
                                        <div class="col-xs-12 asMile" style="height: 42px; line-height: 42px; {{ old('rate_type') == 2 ? ' display: none;' : ' display: block;' }}">
                                            1 Mile= <input type="text" name="amount" value="{{ old('amount') }}" class="form-control" style="width: 70px; display: inline;"> <span>Yen</span>
                                        </div>
                                        <!-- show when tick on radio 'Fix' -->
                                        <div class="col-xs-12 plusMile" style="height: 42px; line-height: 42px; {{ old('rate_type') == 2 ? ' display: block;' : ' display: none;' }}">
                                            <input type="text" name="amount_plus" value="{{ old('amount_plus') }}" class="form-control" style="width: 70px; display: inline;"> <span>PLUS</span>
                                        </div>
                                    </div>
                                    <div class="currentSetting" style="margin-top: 20px; {{ old('rate_type') == 2 ? ' display: none;' : '' }}">
                                        <p>{1Mile=1Yen}</p>
                                        <p>* Notifying bla bla bla...</p>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div> 
                        </form>                       
                    </div>
                    {{-- area form --}}
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form method="post" action="/promotions/store" id="frmPromotion">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-1 text-right">
                                    <label>ABC</label>
                                </div>
                                <div class="col-md-11" style="padding-left: 0;">
                                    <input type="text" name="area_pathJP" value="{{ old('area_pathJP') }}" class="label" style="border: none; width: 100%; display: none;" readonly />
                                    <input type="hidden" name="unit" value="2" />
                                    <input type="hidden" name="mile_type" value="2" />
                                    <p>
                                        <a href="#" data-toggle="modal" data-target="#areaPathModal" data-whatever="@mdo" id="selAreaPath">
                                            Select area
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-1 text-right" style="height: 42px; line-height: 42px;">
                                    <label>ABC</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">
                                            <label>Activity Start Date</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px; margin-right: 30px;">
                                            <input type="text" name="activity_start_date" value="{{ old('activity_start_date') }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">    
                                            <label>Activity End Date</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px;">
                                            <input type="text" name="activity_end_date" value="{{ old('activity_end_date') }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-1 text-right" style="height: 42px; line-height: 42px;">
                                    <label>ABC</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-xs-3" style="height: 42px; line-height: 42px;">
                                            <span>Purchase Start Date</span>
                                        </div>
                                        <div class="col-xs-3" style="margin-left: 20px; margin-right: 30px;">
                                            <input type="text" name="purchase_start_date" value="{{ old('purchase_start_date') }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-3" style="height: 42px; line-height: 42px;">    
                                            <label>Purchase End Date</label>
                                        </div>
                                        <div class="col-xs-3" style="margin-left: 20px;">
                                            <input type="text" name="purchase_end_date" value="{{ old('purchase_end_date') }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-1 text-right" style="height: 42px; line-height: 42px;">
                                    <label>ABC</label>
                                </div>
                                <div class="col-md-11" style="height: 42px; line-height: 42px;">
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            <input type="radio" name="rate_type" value="1" onclick="tickRateType(1)" {{ old('rate_type') == 1 || old('rate_type') <> 2 ? 'checked="checked"' : '' }}> <span>Change</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            <input type="radio" name="rate_type" onclick="tickRateType(2)" value="2" {{ old('rate_type') == 2 ? 'checked="checked"' : '' }}> <span>Fix</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- show when tick on radio 'Change' -->
                                        <div class="col-xs-12 asMile" style="height: 42px; line-height: 42px; {{old('rate_type') == 1 || old('rate_type') <> 2 ? ' display: block;' : ' display: none;' }}">
                                                1 Mile= <input type="text" name="amount" value="{{ old('amount') }}" class="form-control" style="width: 70px; display: inline;"> <span>Yen</span>
                                            </div>
                                        <!-- show when tick on radio 'Fix' -->
                                        <div class="col-xs-12 plusMile" style="height: 42px; line-height: 42px; {{ old('rate_type') == 2 ? 'display: inline;' : ' display: none;' }}">
                                            <input type="text" name="amount" value="{{ old('amount') }}" class="form-control" style="width: 70px; {{ old('rate_type') == 2 ? 'display: inline;' : ' display: none;' }}"> <span>PLUS</span>
                                        </div>
                                    </div>
                                    <div class="currentSetting" style="margin-top: 20px;">
                                        <p>{1Mile=1Yen}</p>
                                        <p>* Notifying bla bla bla...</p>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--  popup for activity search  --}}
        <div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="activityModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="activityModalLabel">Search By Activity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <label for="aid" class="col-form-label col-md-3" style="margin-right: 10px;">ActivityID</label>
                            <input type="text" class="form-control" onkeypress="searchByActivity(1, event)" name="activityID" id="aid">
                        </div>
                        <div class="input-group" style="margin-top: 10px;">
                            <label for="a-title" class="col-form-label col-md-3" style="margin-right: 10px;">ActivityTitle</label>
                            <input type="text" class="form-control" onkeypress="searchByActivity(2, event)" name="activityTitle" id="a-title">
                        </div>
                        <div style="margin-top: 20px;">
                            <div style="margin-bottom: 5px;">
                                <span class="resultSearchActivity">0</span> results
                            </div>
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr style="background-color: grey;">
                                        <th scope="col">ID</th>
                                        <th scope="col">Activity - Area</th>
                                    </tr>
                                </thead>
                                <tbody class="listActivity">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center" style="margin-bottom: 30px;">
                        <button type="button" class="btn btn-primary btnClose" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{--  popup for area search --}}
        <div class="modal fade" id="areaPathModal" tabindex="-1" role="dialog" aria-labelledby="areaPathModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="areaPathModalLabel">Search By Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <label for="aid" class="col-form-label col-md-3" style="margin-right: 10px; padding-left: 0;">Area</label>
                            <input type="text" class="form-control" name="areaPath" onkeypress="searchByAreaPath(event)" id="aid">
                        </div>
                        <div style="margin-top: 20px;">
                            <div style="margin-bottom: 5px;">
                                <span class="resultSearchAreaPath">0</span> results
                            </div>
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr style="background-color: grey;">
                                        <th scope="col">Area</th>
                                    </tr>
                                </thead>
                                <tbody class="listAreaPath">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center" style="margin-bottom: 30px;">
                        <button type="button" class="btn btn-primary btnClose" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/font-awesome/fontawesome-all.min.js') }}"></script>
        <script src="{{ asset('js/ajax.js') }}"></script>
        <script>
            // process popup Search By Activity
            $('#activityModal').on('show.bs.modal', function (event) {
                var modal = $(this);
                $(document).on('click', '#activityModal .listActivity .rowActive a', function (e) {
                    var row = $(this).closest('.rowActive');
                    var activityID    = row.find('a.idActivity').text();
                    var activityTitle = row.find('a.titleActivity').text();
                
                    $('input[name="activity_id"]').attr('value', activityID);
                    $('input[name="activity_title"]').readOnly = false;
                    $('input[name="activity_title"]').attr('value', activityTitle);
                    $('input[name="activity_title"]').readOnly = true;
                    $('input[name="activity_title"]').show();
                    modal.modal('hide');
                });
            });

            // process popup Search By Area
            $('#areaPathModal').on('show.bs.modal', function (event) {
                var modal = $(this);
                $(document).on('click', '#areaPathModal .listAreaPath .rowActive a', function (e) {
                    var areaPath = $(this).text();
                
                    $('input[name="area_pathJP"]').readOnly = false;
                    $('input[name="area_pathJP"]').attr('value', areaPath);
                    $('input[name="area_pathJP"]').readOnly = true;
                    $('input[name="area_pathJP"]').show();
                    modal.modal('hide');
                });
            });

            // search by ActivityID or ActivityTitle
            function searchByActivity(type, e) {
                var key = e.keyCode || e.which;
                if (key == 13) { // press ENTER
                    if (type == 1) { // search by ActivityID
                        var activityID = $(e.target).val();
                        if (activityID) {
                            // get activities from api
                            $.ajax({
                                url: '/activities/' + activityID,
                                dataType: 'json'
                            }).done(function (result) {
                                console.log(result);
                                if (result && result.status === 200) {
                                    // show result
                                    var row = '';
                                    row += '<tr class="rowActive">';
                                    row += '    <th scope="row">';
                                    row += '        <a class="idActivity" href="#">'+result.data.id+'</a>';
                                    row += '    </th>';
                                    row += '    <td>';
                                    row += '        <a class="titleActivity" href="#">'+result.data.title+'</a>';
                                    row += '    </td>';
                                    row += '</tr>';
                                    $('.listActivity').html(row);
                                    $('.resultSearchActivity').text(1);
                                } else {
                                    console.log(result.message ? result.message : 'Unexpected error occurred.');
                                    $('.resultSearchActivity').text(0);
                                }
                            }).fail(function (response) {
                                console.log(response);
                            });
                        } else {
                            $('.listActivity').html('');
                            $('.resultSearchActivity').text(0);
                        }
                    } else { // search by ActivityTitle
                        var activityTitle = $(e.target).val();
                        if (activityTitle) {
                            // get activities from api
                            $.ajax({
                                url: '/activities/title/'+activityTitle,
                                dataType: 'json'
                            }).done(function (result) {
                                console.log(result);
                                if (result && result.status === 200) {
                                    // show result
                                    var out = '';
                                    if (Array.isArray(result.data)) {
                                        result.data.forEach(function (row) {
                                            out += '<tr class="rowActive">';
                                            out += '    <th scope="row">';
                                            out += '        <a class="idActivity" href="#">'+row.id+'</a>';
                                            out += '    </th>';
                                            out += '    <td>';
                                            out += '        <a class="titleActivity" href="#">'+row.title+'</a>';
                                            out += '    </td>';
                                            out += '</tr>';
                                        });
                                    }
                                    $('.listActivity').html(out);
                                    $('.resultSearchActivity').text(result.data.length);
                                } else {
                                    console.log(result.message ? result.message : 'Unexpected error occurred.');
                                    $('.resultSearchActivity').text(0);
                                }
                            }).fail(function (response) {
                                console.log(response);
                            });
                        } else {
                            $('.listActivity').html('');
                            $('.resultSearchActivity').text(0);
                        }
                    }
                }
            }

            // search by area path
            function searchByAreaPath(e) {
                var key = e.keyCode || e.which;
                if (key == 13) { // press ENTER
                    var areaPath = $(e.target).val();
                    if (areaPath) {
                        // get areaPaths from api
                        $.ajax({
                            url: '/area-paths/' + areaPath,
                            dataType: 'json'
                        }).done(function (result) {
                            console.log(result);
                            if (result && result.status === 200) {
                                // show result
                                var row = '';
                                row += '<tr class="rowActive">';
                                row += '    <td>';
                                row += '        <a href="#">'+result.data.md5+'</a>';
                                row += '    </td>';
                                row += '</tr>';
                                $('.listAreaPath').html(row);
                                $('.resultSearchAreaPath').text(1);
                            } else {
                                console.log(result.message ? result.message : 'Unexpected error occurred.');
                                $('.resultSearchAreaPath').text(0);
                            }
                        }).fail(function (response) {
                            console.log(response);
                        });
                    } else {
                        $('.listAreaPath').html('');
                        $('.resultSearchAreaPath').text(0);
                    }
                }
            }
            
            // rate type
            function tickRateType(v) {
                if (v == 1) {
                    $('.plusMile').hide();
                    $('.plusMile').find('input').hide();
                    $('.asMile').show();
                    $('.asMile').find('input').show();
                    $('.currentSetting').show();
                } else {
                    $('.plusMile').show();
                    $('.plusMile').find('input').css('display', 'inline');
                    $('.asMile').hide();
                    $('.asMile').find('input').hide();
                    $('.currentSetting').hide();
                }
            }
        </script>
    </body>
</html>
