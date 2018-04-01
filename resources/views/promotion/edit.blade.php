<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Edit Promotion</title>

        <!-- bootstrap -->
        <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
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
                @if (!empty($promotion))
                <div class="row">
                    <div class="col-md-2" style="padding-left: 20px; margin-top: 30px; margin-bottom: 30px;">
                        <a href="javascript:void(0)" onclick="deletePromotion({{ $promotion->id }})" data-toggle="modal" data-target="#confirmDeleteModal" style="color: red; text-decoration: underline;">
                            <i class="far fa-trash-alt" style="margin-right: 2px;"></i>Delete {{ $promotion->promotionName }}
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                        <label>Unit</label>
                    </div>
                    <div class="col-md-10" style="padding-left:0; margin-bottom: 20px;">
                        <label>{{ $promotion->unit == 1 ? 'Activity' : 'Area' }}</label>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form method="post" action="/promotions/{{ $promotion->id }}/edit" id="frmPromotion">
                            {{ csrf_field() }}
                            <input type="hidden" name="mile_type" value="{{ $promotion->mile_type }}" />
                            <input type="hidden" name="unit" value="{{ $promotion->unit }}" />

                            <div class="row rowActivity" style="">
                                <div class="col-md-2 text-right">
                                    <label>{{ $promotion->unit == 1 ? 'Activity' : 'Area' }}</label>
                                </div>
                                <div class="col-md-10" style="padding-left:0; {{ $promotion->unit == 2 ? ' display: none;' : '' }}">
                                    <input type="text" name="activity_title" value="{{ $promotion->activity_title }}" class="label" style="border: none; width: 100%;" readonly />
                                    <input type="hidden" name="activity_id" value="{{ $promotion->activity_id }}" />
                                </div>
                                <div class="col-md-10" style="padding-left: 0; {{ $promotion->unit == 1 ? ' display: none;' : '' }}">
                                    <input type="text" name="area_pathJP" value="{{ $promotion->area_pathJP }}" class="label" style="border: none; width: 100%;" readonly />
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
                                            <input type="text" name="activity_start_date" value="{{ old('activity_start_date', $promotion->activity_start_date) }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-2" style="height: 42px; line-height: 42px;">    
                                            <label>End Date</label>
                                        </div>
                                        <div class="col-xs-4" style="margin-left: 20px;">
                                            <input type="text" name="activity_end_date" value="{{ old('activity_end_date', $promotion->activity_end_date) }}" class="form-control" placeholder="yyyy-mm-dd">
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
                                            <input type="text" name="purchase_start_date" value="{{ old('purchase_start_date', $promotion->purchase_start_date) }}" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-xs-3" style="height: 42px; line-height: 42px;">    
                                            <label>End Date</label>
                                        </div>
                                        <div class="col-xs-3" style="margin-left: 20px;">
                                            <input type="text" name="purchase_end_date" value="{{ old('purchase_end_date', $promotion->purchase_end_date) }}" class="form-control" placeholder="yyyy-mm-dd">
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
                                            <input type="radio" name="rate_type" value="1" onclick="tickRateType(1)" {{ old('rate_type', $promotion->rate_type) <> 2 ? 'checked="checked"' : '' }}> <span>Change</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                        <input type="radio" name="rate_type" onclick="tickRateType(2)" value="2" {{ old('rate_type', $promotion->rate_type) == 2 ? 'checked="checked"' : '' }}> <span>Fix</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- when tick on radio 'Change': show '1 Mile= [...]Yen', hide '[...] PLUS' -->
                                        <!-- when tick on radio 'Fix': hide '1 Mile= [...]Yen', show '[...] PLUS' -->
                                        <div class="col-xs-12" style="height: 42px; line-height: 42px;">
                                            <span class="asMile" style="{{ old('rate_type', $promotion->rate_type) == 2 ? ' display: none;' : ' display: inline;' }}">1 Mile= </span>
                                            <input type="text" name="amount" value="{{ old('amount', $promotion->amount) }}" class="form-control" style="width: 70px; display: inline;"> 
                                            <span class="asMile" style="{{ old('rate_type', $promotion->rate_type) == 2 ? ' display: none;' : ' display: inline;' }}">Yen</span>
                                            <span class="plusMile" style="{{ old('rate_type', $promotion->rate_type) == 2 ? ' display: inline;' : ' display: none;' }}">PLUS</span>
                                        </div>
                                    </div>
                                    <!-- when tick on radio 'Change': show bellow, hidden when tick on radio 'Fix' -->
                                    <div class="currentSetting" style="margin-top: 20px; {{ old('rate_type', $promotion->rate_type) == 2 ? ' display: none;' : '' }}">
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
                @endif
            </div>
        </div>

        {{--  popup for area search --}}
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-right" style="margin-top: 20px; font-size: 30px;">
                            <i class="far fa-question-circle"></i>
                        </div>
                        <div class="text-right" style="margin-top: 20px;">
                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                        </div>
                    </div>
                    <div class="text-center" style="margin-bottom: 30px;">
                        <button type="button" class="btn btn-primary btnYes" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btnClose" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/font-awesome/fontawesome-all.min.js') }}"></script>
        <script src="{{ asset('js/ajax.js') }}"></script>
        <script>

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

            function deletePromotion(id) {
                if (!isNaN(id)) {
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
