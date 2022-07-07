<script>
    window.addEventListener('load', function() {
        var month = $("#hidden_month").val(),
        station = $("#hidden_station").val(),
        unit = $("#hidden_unit").val();
        $("#load_date_data").load(base_url + "/load_date_data_update/"+month+"/"+station,function(){
            
            

        });
    });
</script>

@extends("master_program")
@section('title_area')
    :: Add ::  Presentation  ::

@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>উপস্থাপনা তথ্য সমুহ</h2>

            </header>
            <div>
                @php 
                    $months = [
                        '1' => "জানুয়ারি",
                        '2' => "ফেব্রুয়ারি",
                        '3' => "মার্চ",
                        '4' => "এপ্রিল",
                        '5' => "মে",
                        '6' => "জুন",
                        '7' => "জুলাই",
                        '8' => "আগস্ট",
                        '9' => "সেপ্টেম্বর",
                        '10' => "অক্টোবর",
                        '11' => "নভেম্বর",
                        '12' => "ডিসেম্বর",
                    ];


                @endphp
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'save_presentation_info_form','class'=>'form-horizontal']) !!}
                        

                        <div class="modal-body">
                            <div class="col-sm-12" style="margin-top:10px;">
                            
                                <div class="form-group">

                                    <input type="hidden" id="hidden_month" name="hidden_month" value="{{$month}}"/>
                                    <input type="hidden" id="hidden_station" name="hidden_station" value="{{$station}}"/>

                                    <label class="col-md-2 control-label">কেন্দ্রের / ইউনিট নাম </label>
                                    <div class="col-md-2">
                                        <select id="station_id" required class="form-control" onchange="getSubStation(this.value)" name="station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                            @if(!empty($station_info))
                                                @foreach($station_info as $key=>$value)
                                                    <option {{ $station==$key ? 'selected' : false }} value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>


                                    <label class="col-md-1 control-label">মাস</label>
                                    <div class="col-md-2">
                                        <select id="month_id"  required class="form-control" name="month_id">
                                            <option value="{{$month}}">{{$months[$month]}}</option>
                                            
                                        </select>
                                    </div>

                                </div>

                                <div id="load_date_data">
                        
                                </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class=" col-sm-7 text-left">
                                    <span class="text-left" id="form_output"></span>
                                </div>
                                <div class=" col-sm-5">
                                    <button type="button" onclick="updatePresentationInfo()" id="saveBtn" class="btn btn-success"><i
                                                class="glyphicon glyphicon-save"></i>
                                        Update
                                    </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                class="glyphicon glyphicon-remove"></i> Close
                                    </button>
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </article>
   
    </div>
    </div>



@endsection

