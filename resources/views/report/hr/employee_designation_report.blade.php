@extends("master_hr")
@section('title_area')
    :: Employee Designation Report  ::

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
                <h2 id="title_info_print">Employee Designation Report </h2>
                <div class="no-print">
                    <button type="button" onclick="print_fun()" class="btn btn-warning btn-xs topbarbutton"><i
                                class="glyphicon glyphicon-print"></i>
                        Print
                    </button>
                </div>
                <div class="show-print-date" style="display:none;">
                    Date: {{ date('d-m-Y') }}
                </div>
            </header>
            <div>
                <div class="widget-body no-padding"  >
                    <div class="col-sm-12" >
                        <div class="col-sm-12 margin-top-10px" style="margin-top:10px"></div>
                        <div class="no-print">
                            {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'employee_report_form','class'=>'form-horizontal']) !!}
                            <div class="col-sm-2">
                                <label>Station</label>
                                <select id="station_id" class="form-control"   name="station_id">
                                    <option value="">Select</option>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$station)
                                            <option value="{{ $key }}">{{ $station }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label>Designation</label>
                                <select id="employee_designation" class="form-control"   name="employee_designation">
                                    <option value="">All</option>
                                    @if(!empty($designation_info))
                                        @foreach($designation_info as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label>Employee Name</label>
                                <input type="text" onkeypress="autocompleteEmployeeInfo(this)"  id="employee_name_search" class="form-control" placeholder="Search Name Or ID"  />
                                <input type="hidden"  id="employee_id_search" class="form-control"  name="employee_id_search"/>
                            </div>
                            <div class="col-sm-2 margin-top-20px">
                                <button type="button" onclick="employee_designation_search()" id="search_btn" class="btn btn-success btn-sm"   name="search_btn"><i class="glyphicon glyphicon-search"></i> Search</button>
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

