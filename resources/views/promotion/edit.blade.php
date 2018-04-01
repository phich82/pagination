<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Edit Promotion</title>

        <!-- Fonts -->
        <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        {{--  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">  --}}
        <style>

        </style>
    </head>
    <body>
        <div class="container">
            <h1>Edit Promotion</h1>
            <div class="container">
                {{-- error messages --}}
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
                    <div class="col-md-10" style="padding-left:0; margin-bottom: 20px;">
                        <div class="btn-group" role="group" aria-label="Unit">
                            <button type="button" onclick="toogleUnit(1)" class="btn btn-primary btnActivity">Activity</button>
                            <button type="button" onclick="toogleUnit(2)" class="btn btn-default btnArea">Area</button>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form method="post" action="/promotions/store" id="frmPromotion">
                            {{ csrf_field() }}
                            <input type="hidden" name="mile_type" value="2" />
                            <div class="row rowActivity">
                                <div class="col-md-2 text-right">
                                    <label>Activity</label>
                                </div>
                                <div class="col-md-10" style="padding-left:0;">
                                    <input type="text" name="activity_title" value="{{ old('activity_title') }}" class="label" style="border: none; width: 100%; display: none;" readonly />
                                    <input type="hidden" name="activity_id" value="{{ old('activity_id') }}" />
                                    <input type="hidden" name="unit" value="1" />
                                    <p>
                                        <a href="#" data-toggle="modal" data-target="#activityModal" data-whatever="@mdo" id="selActivity">
                                            Select activities
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="row rowArea" style="display: none;">
                                <div class="col-md-2 text-right">
                                    <label>Area</label>
                                </div>
                                <div class="col-md-10" style="padding-left: 0;">
                                    <input type="text" name="area_pathJP" value="{{ old('area_pathJP') }}" class="label" style="border: none; width: 100%; display: none;" readonly />
                                    <input type="hidden" name="unit" value="2" />
                                    <p>
                                        <a href="#" data-toggle="modal" data-target="#areaPathModal" data-whatever="@mdo" id="selAreaPath">
                                            Select areas
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
                                        <!-- when tick on radio 'Change': show '1 Mile= [...]Yen', hide '[...] PLUS' -->
                                        <!-- when tick on radio 'Fix': hide '1 Mile= [...]Yen', show '[...] PLUS' -->
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            <span class="asMile" style="{{ old('rate_type') == 2 ? ' display: none;' : ' display: inline;' }}">1 Mile= </span>
                                            <input type="text" name="amount" value="{{ old('amount') }}" class="form-control" style="width: 70px; display: inline;"> 
                                            <span class="asMile" style="{{ old('rate_type') == 2 ? ' display: none;' : ' display: inline;' }}">Yen</span>
                                            <span class="plusMile" style="{{ old('rate_type') == 2 ? ' display: inline;' : ' display: none;' }}">PLUS</span>
                                        </div>
                                    </div>
                                    <!-- when tick on radio 'Change': show bellow, hidden when tick on radio 'Fix' -->
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
                    $('input[name="activity_title"]').attr('value', activityTitle);
                    $('input[name="activity_title"]').show();
                    modal.modal('hide');
                });
            });

            // process popup Search By Area
            $('#areaPathModal').on('show.bs.modal', function (event) {
                var modal = $(this);
                $(document).on('click', '#areaPathModal .listAreaPath .rowActive a', function (e) {
                    var areaPath = $(this).text();
                
                    $('input[name="area_pathJP"]').attr('value', areaPath);
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

            // toogle Unit button
            function toogleUnit(type) {
                if (type == 1) { // activity
                    $('.btnArea').removeClass('btn-primary');
                    $('.btnActivity').addClass('btn-primary');
                    $('.rowActivity').show();
                    $('.rowArea').hide();
                } else { // area
                    $('.btnActivity').removeClass('btn-primary');
                    $('.btnArea').addClass('btn-primary');
                    $('.rowActivity').hide();
                    $('.rowArea').show();
                }
            }
            
            // rate type
            function tickRateType(v) {
                if (v == 1) {
                    $('.plusMile').hide();
                    $('.asMile').show();
                    $('.currentSetting').show();
                } else {
                    $('.plusMile').show();
                    $('.asMile').hide();
                    $('.currentSetting').hide();
                }
            }
        </script>
    </body>
</html>
