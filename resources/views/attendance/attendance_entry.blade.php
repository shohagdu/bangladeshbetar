@extends("master_hr")
@section('title_area')
    :: Attendance Entry ::

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
    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px" >

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" >
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Attendance Entry </h2>
            <a href="<?php  echo asset('/attendance_record');?>"
            class="btn btn-primary btn-xs topbarbutton" ><i
            class="glyphicon glyphicon-backward"></i>
            Attendance Record
            </a>
            </header>
            <div>
                <div class="widget-body no-padding"  >
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'employee_attendance_form','class'=>'form-horizontal']) !!}
                        <div class="col-sm-3" >
                            <label>Station</label>
                            <select id="station_id" class="form-control"  name="station_id">
                                <option value="">Select Station</option>
                                @if(!empty($station_info))
                                    @foreach($station_info as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-3" >
                            <label>Department</label>
                            <select id="department_id" class="form-control"  name="department_id">
                                <option value="">Select Department</option>
                                @if(!empty($department_info))
                                    @foreach($department_info as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                         <div class="col-sm-2" >
                            <label>Attendance Date</label>
                            <input type="text" name="attendance_date" value="{{ date('d-m-Y') }}" id="attendance_date" class="form-control datepickerinfo">
                        </div>

                        <div class="col-sm-2 margin-top-20px">
                            <button type="button" onclick="employee_attendance_info_search()" id="search_btn" class="btn btn-success btn-sm"   name="search_btn"><i class="glyphicon glyphicon-search"></i> Search</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12 margin-top-10px" >
                        <div class="col-sm-4" >
                            <div class="row">
                                <div id="error_data"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="show_report_info"></div>
                        <div id="show_attendance_info"></div>
                    </div>

                </div>
            </div>
        </div>
    </article>
@endsection

