@extends("master_program")
@section('title_area')
    :: কিউসিট তৈরি  ::
@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
@section('main_content_area')

    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> কিউসিট তৈরি</h2>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        {!! Form::open(['url' => '/save_master_date_program_time_table', 'id' => 'program_date_setup_form','method' => 'post','class'=>'form-horizontal']) !!}
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">কেন্দ্রের নাম </label>
                            <div class="col-md-4">
                                <select id="station_id" required class="form-control" onchange="getSubStation(this.value)" name="station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">ফ্রিকোয়েন্সি/চ্যানেল </label>
                            <div class="col-md-4">
                                <select id="sub_station_id" required onchange="loadSchedule(station_id.value,this.value,date.value);" class="form-control" name="sub_station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">তারিখ </label>
                            <div class="col-md-4">
                                <input type="text" required autocomplete="off" name="date" onchange="loadSchedule(station_id.value,sub_station_id.value,this.value);" placeholder="dd-mm-yyyy" class="form-control datepickerinfo"/>
                            </div>
                            
                        </div>

                        <div id="loadSchedule">
                            <!-- load schedule here---->
                        </div>

                        <div id="form_output">
                        </div>
                        {!! Form::close() !!}
                        

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

