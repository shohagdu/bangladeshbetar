@extends("master_program")
@section('title_area')
    :: নতুন ::  এডহক উপস্থাপনা তথ্য সমুহ  ::
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
                <h2>এডহক উপস্থাপনা তথ্য সমুহ</h2>
                <a href="<?php  echo asset('/program_presentation_create');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    পরিকল্পনা (Planning) List
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'save_adhok_presentation_info_form',
                        'class'=>'form-horizontal']) !!}

                        <div class="col-sm-12" style="margin-top:10px;">
                            <div class="form-group">
                                <label class="col-md-2 control-label">কেন্দ্রের / ইউনিট নাম </label>
                                <div class="col-md-2">
                                    <select id="station_id"  required class="form-control" onchange="getSubStation(this.value)"  name="station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                        @if(!empty($station_info))
                                            @foreach($station_info as $key=>$value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <label class="col-md-1 control-label"> ফ্রিকোয়েন্সি</label>
                                <div class="col-md-3">
                                    <select id="sub_station_id" required class="form-control"
                                            name="sub_station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="presentation_date"  required class="form-control
                                    datepickerinfo" placeholder="তারিখ"
                                            name="presentation_date">

                                </div>
                                <div class="col-md-2">
                                    <button type="button" onclick="searching_presentation_info()"
                                            id="search_presentation_info"  required class="btn
                                    btn-success btn-sm"
                                            name="search_presentation_info"><i class="glyphicon
                                            glyphicon-search"></i> Search
                                    </button>
                                </div>


                            </div>



                            <div id="loadDateData">

                            </div>


                        </div>


                        {!! Form::close() !!}
                        <div class="clearfix"></div>
                        <div class="mydivAjaxImage">
                            <img src="{{ url('fontView\assets\img\ajax-loader.gif') }}" class="ajax-loader" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

