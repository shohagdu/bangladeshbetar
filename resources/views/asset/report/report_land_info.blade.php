@extends("master_state")
@section('title_area')
    :: State Management :: Land Report ::

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
            <h2 id="title_info_print">Land Report </h2>
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
                        {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'land_info_report_form','class'=>'form-horizontal']) !!}
                        <div class="col-sm-3">
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
                        <div class="col-sm-3">
                            <label>Area</label>
                            <select id="area" class="form-control"   name="area">
                                <option value="">All</option>
                                @if(!empty($area_info))
                                    @foreach($area_info as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label> Land No</label>
                            <input name="land_no" id="land_no" class="form-control" type="text" placeholder="Land No">
                        </div>
                        <div class="col-sm-2">
                            <label> Dag No</label>
                            <input name="dag_no" id="dag_no" class="form-control" type="text" placeholder="Dag No">
                        </div>
                        <div class="col-sm-2">
                            <label>Khotian No</label>
                            <input name="khotian_no" id="khotian_no" class="form-control" type="text" placeholder="Khotian No">
                        </div>
                    </div>
                    <div class="col-sm-2" style="margin-top: 12px;">
                        <label> Mouza No</label>
                        <input name="mouza_no" id="mouza_no" class="form-control" type="text" placeholder="Mouza No">
                    </div>
                    <div class="col-sm-2" style="margin-top: 12px;">
                        <label> Zer No</label>
                        <input name="zer_no" id="zer_no" class="form-control" type="text" placeholder="Zer No">
                    </div>
                    <div class="col-sm-2" style="margin-top: 12px;">
                        <label>Last Tax Date </label>
                        <input name="last_date_tax" id="last_date_tax" class="form-control datepickerinfo" type="text" placeholder="Last Tax Date">
                    </div>   

                    <div class="col-sm-2 margin-top-20px" >
                        <button  style="margin-top: 15px;" type="button" onclick="land_information_search()" id="search_btn" class="btn btn-success btn-sm"   name="search_btn"><i class="glyphicon glyphicon-search"></i> Search</button>
                    </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div><br>
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

