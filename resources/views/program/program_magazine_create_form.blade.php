@extends("master_program")
@section('title_area')
    :: Add New Program ::
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
                <h2>{{ $page_title }}</h2>

                <a  href="{{ url('program_magazine_create') }}"     class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                   Program List
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'save_program_planning_form',
                'class'=>'form-horizontal']) !!}
                            <div class="modal-body">
                                <div class="col-sm-12" style="margin-top:10px;">

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> কেন্দ্র </label>
                                        <div class="col-md-4">
                                            <select id="station_id" onchange="getSubStation(this.value)" class="form-control" name="station_id">
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

                                        <label class="col-md-2 control-label">অনুষ্ঠানের  নাম</label>
                                        <div class="col-md-4">
                                            <input type="text" id="program_name" class="form-control" required name="program_name"
                                                   placeholder="অনুষ্ঠানের  নাম">
                                        </div>

                                        <label class="col-md-2 control-label">অনুষ্ঠানের ধরন </label>
                                        <div class="col-md-4">
                                            <select id="program_type" class="form-control" name="program_type">
                                                <option value="">চিহ্নিত করুন</option>
                                                @if(!empty($program_type))
                                                    @foreach($program_type as $key=>$value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-2">
                                            <input type="checkbox" onclick="is_program_type_check(this)" id="is_fixed_program"
                                                   name="is_fixed_program"/> উৎসব ও বার্ষিকী অনুষ্ঠান
                                        </div>
                                        <div style="display:none" id="fixed_program_type_div">
                                            <label class="col-md-2 control-label">বার্ষিকী অনুষ্ঠানের ধরন</label>
                                            <div class="col-md-3">
                                                <select id="fixed_program_type" class="form-control" name="fixed_program_type">
                                                    <option value="">বার্ষিকী অনুষ্ঠানের ধরন</option>
                                                    @foreach($get_fixed_program_type as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="sub_fixed_program_type" class="form-control" name="sub_fixed_program_type">
                                                    <option value="">সাব-বার্ষিকী অনুষ্ঠানের ধরন</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group">



                                        <label class="col-md-2 control-label">অনুষ্ঠানের প্রকৃতি</label>
                                        <div class="col-md-4">
                                            <select id="program_style" class="form-control" name="program_style">
                                                <option value="">চিহ্নিত করুন</option>
                                                @if(!empty($program_style))
                                                    @foreach($program_style as $key=>$value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>



                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">রেকর্ডিং তারিখ</label>
                                        <div class="col-md-2">
                                            <input type="text"  class="form-control datepickerLong" placeholder="রেকডিং তারিখ"
                                                   name="recorded_date"/>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" onclick="" id="recording_date_is_plexibity"
                                                   name="recording_date_is_plexibity"/> প্রয়োজন মত
                                        </div>

                                        <label class="col-md-2 control-label">রেকর্ডিং সময়</label>
                                        <div class="col-md-2">
                                            <input type="text" id="recorded_time" class="form-control timepicker" required
                                                   name="recorded_time"
                                                   placeholder="রেকডিং সময়">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" onclick="" id="recording_time_is_plexibity"
                                                   name="recording_time_is_plexibity"/> প্রয়োজন মত
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">প্রচার তারিখ</label>
                                        <div class="col-md-2">
                                            <input type="text"  class="form-control datepickerLong" placeholder="প্রচার তারিখ"
                                                   name="live_date"/>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" onclick="" id="live_date_is_plexibity"
                                                   name="live_date_is_plexibity"/> প্রয়োজন মত
                                        </div>
                                        <label class="col-md-2 control-label">প্রচার সময়</label>
                                        <div class="col-md-2">
                                            <input type="text" id="live_time" class="form-control timepicker" required
                                                   name="live_time"
                                                   placeholder="প্রচার সময়">

                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" onclick="" id="live_time_is_plexibity"
                                                   name="live_time_is_plexibity"/> প্রয়োজন মত
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> স্থিতি</label>
                                        <div class="col-md-4">
                                            <input type="text" id="recording_stabilty" class="form-control" placeholder="স্থিতি"
                                                   name="recording_stabilty"/>
                                        </div>
                                        <label class="col-md-2 control-label">টাইপ</label>
                                        <div class="col-md-4">
                                            <select required name="record_type" class="form-control" id="record_type">
                                                <option value="">চিহ্নিত করুন</option>
                                                <option value="1">সজীব</option>
                                                <option value="2">রেকর্ড</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">উদ্দেশ্য/বিষয়</label>
                                        <div class="col-md-10">
                    <textarea class="form-control" placeholder="উদ্দেশ্য/বিষয়"
                              name="larget_viewer"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th colspan="3">অনুষ্ঠানের বিবরন</th>
                                            </tr>
                                            <tr>
                                                <th style="width:30%;">বিবরন</th>
                                                <th>শিল্পীর নাম</th>
                                                <th style="width:5%;">#</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select value="{{ $key  }}"
                                                            id="program_description_id_1" name="program_description_id[0]"
                                                            class="form-control">
                                                        <option value="">বিবরন</option>
                                                        @if(!empty($program_description)){
                                                        @foreach ($program_description as $key=> $description){
                                                        <option value="{{ $key  }}">{{ $description  }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>

                                                </td>
                                                <td>
                                                    <select type="text" placeholder="শিল্পীর নাম"   name="artist_name_all[0][]"
                                                            class="select2" multiple required style="width:100%; !important">
                                                        @if(!empty($atrist_info_info))
                                                            @foreach($atrist_info_info as $key=> $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td><button type="button" id="delete_1"  class="btn
                        btn-warning btn-sm deleteRow"><i class="glyphicon glyphicon-remove"></i> </button></td>
                                            </tr>
                                            <tbody id="show_all_program_desciption"></tbody>
                                            <tr>
                                                <td colspan="3"><button type="button" id="add_description"  class="btn
                        btn-primary btn-sm add_description"><i class="glyphicon glyphicon-plus"></i> Add </button>  </td>
                                            </tr>
                                            <?php
                                            $manage=[
                                                1=>'প্রযোজনা',
                                                2=>'সম্পাদনা',
                                                3=>'প্রযোজনা সহকারী',
                                                4=>'তত্বাবধানে',
                                                5=>'নির্দেশনা',
                                            ];
                                            foreach ($manage as $key=> $value){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="text" placeholder="বিবরন" value="{{ $value  }}"
                                                           id="manage_title_{{ $key }}" name="manage_title[]" class="form-control">
                                                    <input type="hidden" placeholder="বিবরন" value="{{ $key  }}"
                                                           id="manage_title_id_{{ $key }}" name="manage_title_id[]"
                                                           class="form-control">

                                                </td>
                                                <td>
                                                    <select  id="magazine_manage_{{ $key }}" placeholder="শিল্পীর নাম"  class="select2"
                                                             multiple required
                                                             name="magazine_manage[{{$key}}][]" style="width:100%; !important">

                                                        @if(!empty($employee_info))
                                                            @foreach($employee_info as $key=> $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td><button type="button" id="delete_manage_{{ $key }}"
                                                            class="btn
                        btn-warning btn-sm deleteRow"><i class="glyphicon glyphicon-remove"></i> </button></td>
                                            </tr>
                                            <?php

                                            }
                                            ?>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class=" col-sm-7 text-left">
                                    <span class="text-left" id="form_output"></span>
                                </div>
                                <div class=" col-sm-5">
                                    <button type="button" onclick="saveProgramSavedInfo()" id="saveBtn" class="btn btn-success"><i
                                                class="glyphicon glyphicon-save"></i>Save
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
    <!-- Modal -->


    <script>
        var scntDivSong = $('#show_all_program_desciption');
        var a = $('#show_all_program_desciption tr').size() + 1;
        var a_index=1;
        $('#add_description').on('click', function () {
            $('<tr><td><select\n' +
                '                                id="program_description_id_'+ a +'" ' +
                'name="program_description_id['+ a_index +']"\n' +
                '                                class="form-control">\n' +
                '                            <option value="">বিবরন</option>\n' +
                '                            @if(!empty($program_description)){\n' +
                '                                @foreach ($program_description as $key=> $description){\n' +
                '                                        <option value="{{ $key  }}">{{ $description  }}</option>\n' +
                '                                @endforeach\n' +
                '                            @endif\n' +
                '                        </select></td><td> <select id="artist_name_all_'+ a +'"   ' +
                'name="artist_name_all['+ a_index +'][]"\n' +
                '                                class="select2" multiple required style="width:100%; !important">\n' +
                '                            @if(!empty($atrist_info_info))\n' +
                '                                @foreach($atrist_info_info as $key=> $value)\n' +
                '                                    <option value="{{ $key }}">{{ $value }}</option>\n' +
                '                                @endforeach\n' +
                '                            @endif\n' +
                '                        </select></td><td><a href="javascript:void(0);"  id="deleteRow_' + a + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> </a></td></tr>').appendTo(scntDivSong);
            $("#artist_name_all_"+a).select2();
            a++;
            a_index++;
            return false;
        });
    </script>



@endsection




