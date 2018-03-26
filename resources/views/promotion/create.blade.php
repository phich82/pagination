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
                <div class="row">
                    <div class="col-md-1 text-right" style="height: 42px; line-height: 42px;">
                        <label>ABC</label>
                    </div>
                    <div class="col-md-11" style="padding-left:0;">
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
                        <form method="post" action="#" id="frmPromotion">
                            <div class="row">
                                <div class="col-md-1 text-right">
                                    <label>ABC</label>
                                </div>
                                <div class="col-md-11" style="padding-left:0;">
                                    <a href="#" data-toggle="modal" data-target="#activityModal" data-whatever="@mdo" id="selActivity">Select activity</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-1 text-right" style="height: 42px; line-height: 42px;">
                                    <label>ABC</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">
                                            <label>A</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px; margin-right: 30px;">
                                            <input type="text" name="purchase_start_date" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">    
                                            <label>B</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px;">
                                            <input type="text" name="purchase_end_date" class="form-control" placeholder="yyyy-mm-dd">
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
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">
                                            <span>A</span>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px; margin-right: 30px;">
                                            <input type="text" name="activity_start_date" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">    
                                            <label>B</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px;">
                                            <input type="text" name="activity_end_date" class="form-control" placeholder="yyyy-mm-dd">
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
                                            <input type="radio" name="rate_type" value="1" checked="checked"> <span>A</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            <input type="radio" name="rate_type" value="1"> <span>B</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            1 Mile= <input type="text" name="amount" value="" class="form-control" style="width: 70px; display: inline;"> <span>Yen</span>
                                        </div>
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px; display:none;">
                                            <input type="text" name="amount" value="" class="form-control" style="width: 70px; display: inline;"> <span>PLUS</span>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px;">
                                        adasdasdadasdadsa
                                    </div>
                                    <div class="row">
                                        adasdasdadasdadsa
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div> 
                        </form>                       
                    </div>
                    {{-- area form --}}
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form method="post" action="#" id="frmPromotion">
                            <div class="row">
                                <div class="col-md-1 text-right">
                                    <label>ABC</label>
                                </div>
                                <div class="col-md-11" style="padding-left:0;">
                                    <select name="area_pathJP" class="form-control" style="width: 600px;">
                                        <option>Area 1</option>
                                        <option>Area 2</option>
                                        <option>Area 3</option>
                                        <option>Area 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-1 text-right" style="height: 42px; line-height: 42px;">
                                    <label>ABC</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">
                                            <label>A</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px; margin-right: 30px;">
                                            <input type="text" name="purchase_start_date" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">    
                                            <label>B</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px;">
                                            <input type="text" name="purchase_end_date" class="form-control" placeholder="yyyy-mm-dd">
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
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">
                                            <span>A</span>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px; margin-right: 30px;">
                                            <input type="text" name="activity_start_date" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">    
                                            <label>B</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px;">
                                            <input type="text" name="activity_end_date" class="form-control" placeholder="yyyy-mm-dd">
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
                                            <input type="radio" name="rate_type" value="1" checked="checked"> <span>A</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            <input type="radio" name="rate_type" value="1"> <span>B</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            1 Mile= <input type="text" name="amount" value="" class="form-control" style="width: 70px; display: inline;"> <span>Yen</span>
                                        </div>
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px; display:none;">
                                            <input type="text" name="amount" value="" class="form-control" style="width: 70px; display: inline;"> <span>PLUS</span>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px;">
                                        adasdasdadasdadsa
                                    </div>
                                    <div class="row">
                                        adasdasdadasdadsa
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--  dialog for activity  --}}
        <div>
            <div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="activityModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="activityModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="input-group">
                                    <label for="aid" class="col-form-label col-md-3" style="margin-right: 10px;">ActivityID</label>
                                    <input type="text" class="form-control" name="activity_id" id="aid">
                                </div>
                                <div class="input-group" style="margin-top: 10px;">
                                    <label for="a-title" class="col-form-label col-md-3" style="margin-right: 10px;">ActivityTitle</label>
                                    <input type="text" class="form-control" name="activity_title" id="a-title">
                                </div>
                                <div style="margin-top: 20px;">
                                    <div style="margin-bottom: 5px;">
                                        [2] results
                                    </div>
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr style="background-color: grey;">
                                                <th scope="col">ID</th>
                                                <th scope="col">Activity - Area</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">1</a>
                                                </th>
                                                <td>
                                                    <a href="#">Mark</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">2</a>
                                                </th>
                                                <td>
                                                    <a href="#">Jacob</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">3</a>
                                                </th>
                                                <td>
                                                    <a href="#">Larry</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="text-center" style="margin-bottom: 30px;">
                            <button type="button" class="btn btn-primary btnClose" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
        {{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  --}}
        {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>  --}}
        <script src="{{ asset('js/font-awesome/fontawesome-all.min.js') }}"></script>
        <script>
            // process dialog
            $('#activityModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var recipient = button.data('whatever'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                //modal.find('.modal-title').text('New message to ' + recipient);
                //modal.find('.modal-body input').val(recipient);
                modal.find('a').on('click', function (e) {
                    //alert('You selected.');
                    $('#selActivity').html($(this).text());
                    modal.modal('hide');
                });
                
                // reset activity
                $('.btnClose').on('click', function (e) {
                    $('#selActivity').html('Select activity');
                });
            });
        </script>
    </body>
</html>
