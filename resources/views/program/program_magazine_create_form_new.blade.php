


{{--// <td>${getWorkAreaNameArray(row.work_area)}</td>--}}
@extends("master_program")
@section('title_area')
    :: Add New Program ::
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
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>{{ $page_title }}</h2>

                <a href="{{ url('program_magazine_create') }}" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Program List
                </a>

            </header>
            <div>

                <!-- <select multiple class="select2  leaderMultiSelctdropdown" name="work_area[]" id="work_area" placeholder="ওয়ার্ক এরিয়া"> -->



                <!-- Modal -->



                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'save_program_planning_form',
                        'class'=>'form-horizontal']) !!}
                        <div >
                            <div class="col-sm-12" style="margin-top:10px;">
                                <!-- <input type="hidden" id="biboron_data" name="biboron_data" value="" /> -->
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> কেন্দ্র <span class="mandatory_field">*</span>
                                    </label>
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
                                    <label class="col-md-2 control-label">ফ্রিকোয়েন্সি/চ্যানেল </label>
                                    <div class="col-md-4">
                                        <select id="sub_station_id" required  class="form-control" name="sub_station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label">নিদিষ্ট অনুষ্ঠান সূচি <span class="mandatory_field">*</span></label>
                                    <div class="col-md-4">
                                        <select id="fixed_onusan_suchy" class="form-control" required name="fixed_onusan_suchy">
                                            <option value="">চিহ্নিত করুন</option>
                                            <option value="1">গ্রীষ্মকালীন</option>
                                            <option value="2">শীতকালীন</option>
                                        </select>
                                    </div>

                                    <label class="col-md-2 control-label">ত্রৈমিাসিক পরিকল্পনা <span
                                                class="mandatory_field">*</span> </label>
                                    <div class="col-md-2">
                                        <select id="torimasik_porikolpona" class="form-control" name="torimasik_porikolpona">
                                            <option value="">চিহ্নিত করুন</option>
                                            <option value="1">১ম: (বৈশাখ-আযাঢ়) </option>
                                            <option value="2">২য়: (শ্রাবন-আশ্বিন)</option>
                                            <option value="3">৩য়: (কার্তিক-পৌষ)</option>
                                            <option value="4">৪র্থ: (মাঘ-চৈত্র)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="bangla_son" value="১৪২৮" class="form-control" readonly="">
                                    </div>


                                </div>
                                <div class="form-group">

                                    <label class="col-md-2 control-label">অনুষ্ঠানের নাম <span class="mandatory_field">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="program_name" class="form-control" required name="program_name" placeholder="অনুষ্ঠানের  নাম">
                                    </div>

                                    <label class="col-md-2 control-label">অনুষ্ঠানের ধরন <span class="mandatory_field">*</span> </label>
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
                                    <label class="col-md-2 control-label">টাইপ</label>
                                    <div class="col-md-4">
                                        <select required name="record_type" class="form-control" id="record_type">
                                            <option value="">চিহ্নিত করুন</option>
                                            <option value="1">সজীব</option>
                                            <option value="2">বাণীবদ্ধ</option>
                                            <option value="3">এককালীন</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-2">
                                        <input type="checkbox" onclick="is_program_type_check(this)" id="is_fixed_program" name="is_fixed_program" /> উৎসব ও বার্ষিকী অনুষ্ঠান
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
                                    <label class="col-md-2 control-label">প্রচার তারিখ <span class="mandatory_field">*</span></label>
                                    <div class="col-md-4">
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <input type="text" class="form-control datepickerLong
                                                get_board_cast_dt "
                                                       placeholder="প্রচার তারিখ" name="boardcasting_date[]" />
                                            </div>
                                        </div>
                                        <div id="show_mobile_log_1"></div>
                                        <div class="col-sm-12" style="margin-top:10px;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="row">
                                                        <button type="button" class="btn btn-primary btn-sm" id="add_mobile_no_1"><i class="glyphicon
                                                    glyphicon-plus"></i> Add</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="checkbox" onclick="" id="live_date_is_plexibity"
                                                           name="live_date_is_plexibity" /> <span style="font-size:12px">
                                                    প্রয়োজন মত (অনুমোদন সাপেক্ষে)</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="col-md-12">

                                        </div>
                                    </div>
                                    <label class="col-md-2 control-label">প্রচার সময় <span class="mandatory_field">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="live_time" class="form-control timepicker" required name="live_time" placeholder="প্রচার সময়">
                                    </div>
                                </div>




                                <input type="hidden" id="chank_info" name="chank_info" id="chank_info"
                                       class="form-control">
                                <input type="hidden" onclick="" id="live_time_is_plexibity" name="live_time_is_plexibity" />
                                <input type="hidden" onclick="" id="recording_time_is_plexibity"
                                       name="recording_time_is_plexibity" />
                                {{-- প্রয়োজন মত--}}


                                <div class="form-group">
                                    <label class="col-md-2 control-label"> স্থিতি (মিনিট) <span
                                                class="mandatory_field">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="recording_stabilty" class="form-control"
                                               placeholder="স্থিতি (মিনিট)" name="recording_stabilty" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">উদ্দেশ্য/বিষয় <span class="mandatory_field">*</span></label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" placeholder="উদ্দেশ্য/বিষয়" name="larget_viewer"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">দলগত পরিবেষনা <span class="mandatory_field">*</span></label>
                                    <div class="col-md-1">
                                        <input type="checkbox" onclick="is_dologot_songit(this)" name="dologot_poribashona" id="dologot_poribashona">
                                    </div>
                                    <div class="col-md-9" id="dologot_information_view" style="display:none;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="দলের নাম" id="dolar_name" name="dolar_name" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="দলের তথ্য" id="dolar_info" name="dolar_info" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <thead>

                                        <tr>
                                            <th colspan="14">

                                                <a style="float:right;margin-left:10px !important;" href="{{ url
                                                ('artist_record_add')
                                                 }}"
                                                   class="btn btn-primary btn-sm" target="_blank"
                                                ><i class="glyphicon glyphicon-plus"></i> নতুন শিল্পী যোগ
                                                    করুন</a> &nbsp;
                                                <button style="float:right;" type="button" onClick="openModal()"
                                                        class="btn btn-info btn-sm" ><i class="glyphicon glyphicon-plus"></i> বিবরন যোগ করুন</button>
                                                <div id="show_error" style="float: right;color:red;font-weight:
                                                bold;font-size:16px;padding-right:20px;"></div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="14">অনুষ্ঠানে অংশগ্রহনকারীর বিবরন(শিল্পী সম্মানীর চার্ট
                                                অনুযাযী)</th>
                                        </tr>
                                        <tr>
                                            <td>শিল্পী সম্মানীর ক্যাটাগরি</td>
                                            <td>শিল্পীর নাম</td>
                                            <td>বিবরন</td>
                                            <td>শ্রেণী</td>
                                            <td>স্থিতি</td>
                                            <td>সম্মানী</td>
                                            <td>ভূমিকা</td>
                                            <td>দিনের সংখ্যা</td>
                                            <td>মহড়া তারিখ</td>
                                            <td>মহড়া ফি</td>
                                            <td>টি এ</td>
                                            <td>ডি এ</td>
                                            <td>মোট টাকা</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody id="biboron_list">

                                        </tbody>

                                    </table>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">অনুষ্ঠানের বিষয়বস্তু <span class="mandatory_field">*</span></label>
                                        <div class="col-md-4">
                                            <textarea class="form-control" placeholder="অনুষ্ঠানের বিষয়বস্তু" name="onusthan_bisoy_bostu"></textarea>
                                        </div>
                                        <label class="col-md-2 control-label"> আর্কাইভ প্লে লিস্ট নং<span
                                                    class="mandatory_field">*</span></label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="আর্কাইভ প্লে লিস্ট নং"
                                               name="archieve_playlist_id"></textarea>
                                        </div>

                                    </div>
                                    <table class="table table-bordered">
                                        <?php
                                        $manage=prgram_manage();
                                        foreach ($manage as $key => $value) {
                                        ?>
                                        <tr>
                                            <td style="width:200px;">
                                                <input readonly disabled type="text" placeholder="বিবরন" value="{{ $value
                                                }}" id="manage_title_{{ $key }}" name="manage_title[]" class="form-control">
                                                <input type="hidden" placeholder="বিবরন" value="{{ $key  }}" id="manage_title_id_{{ $key }}" name="manage_title_id[]" class="form-control">

                                            </td>
                                            <td >
                                                <select id="magazine_manage_{{ $key }}" placeholder="<?php echo $value; ?>" class="select2" multiple required name="magazine_manage[{{$key}}][]" style="width:100%; !important">

                                                    @if(!empty($employee_info))
                                                        @foreach($employee_info as $key=> $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width:100px;"><button type="button" id="delete_manage_{{ $key
                                            }}"
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

                                <textarea style="visibility:hidden" name="biboron_data" id="biboron_list_input"></textarea>
                                <button type="button" onclick="saveProgramSavedInfoNew()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>Save
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <textarea style="visibility:hidden" id="rateChart"><?php echo json_encode($get_rate_chart); ?></textarea>
                        <textarea style="visibility:hidden" id="workArea"><?php echo json_encode($work_area); ?></textarea>
                        <textarea style="visibility:hidden" id="program_description_sub"><?php echo json_encode($program_description_sub); ?></textarea>
                        <textarea style="visibility:hidden" id="program_vumika"><?php echo json_encode($program_description); ?></textarea>
                        <textarea style="visibility:hidden" id="artist_info"><?php echo json_encode($atrist_info_info); ?></textarea>
                        <textarea style="visibility:hidden" id="program_style"><?php echo json_encode($program_style); ?></textarea>
                        <textarea style="visibility:hidden" id="artist_grade_info"><?php echo json_encode($artist_grade_info); ?></textarea>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->


    <div id="myModal" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:60%;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">অনুষ্ঠানের বিবরন</h4>
                </div>
                <div>
                    <form class="form-horizontal" id="myForm">
                        <br/>
                        <div class="form-group">
                            <label class="control-label col-sm-2" ></label>
                            <div class=" col-sm-10" >
                                <input type="checkbox" onclick="artist_exp_show_fun(this)" name="artist_exp_show"
                                       id="artist_exp_show" >
                                <span>
                                                                           দক্ষতা
                                                                           বিবেচনায় শিল্পী
                                                                           (শিল্পী
                                                                           তথ্য
                                                                           ফরম হতে) </span>
                            </div>
                        </div>
                        <div class="form-group" id="experience_info_show" style="display:none;">
                            <label class="control-label col-sm-2" for="pwd"> দক্ষতার তথ্য </label>
                            <div class="col-sm-3">
                                <select  name="expertise" onchange="get_artist_expertise_info_filter()"
                                         id="expertise_1" class="form-control
                                 artist_expertise"><option value="">দক্ষতা চিহ্নিত করুন</option> @if(!empty($expertise_dept))
                                        @foreach ($expertise_dept as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select id="expertise_dept_1" onchange="get_artist_expertise_info_filter()" class="form-control"
                                        name="expertise_dept">
                                    <option value="">দক্ষতার বিভাগ চিহ্নিত করুন</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select  name="artist_grade" onchange="get_artist_expertise_info_filter()" class="form-control"
                                         id="artist_grade">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($artist_grade_info))
                                        @foreach ($artist_grade_info as $key =>$value)
                                            <option   value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">শিল্পী:</label>
                            <div class="col-sm-8">
                                <select class="form-control" onchange="get_single_artist_info(this.value)"
                                        name="artist"
                                        id="artist">
                                    <option value="">চিহ্নিত করুন</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">শিল্পী সম্মানী ক্যাটাগরি:</label>
                            <div class="col-sm-8">
                                <!--- getShilpiInfo(1,this) *---->
                                <select required id="artis_ctg_id" onchange="getBiboron()" placeholder="শিল্পী সম্মানীর ক্যাটাগরি" required id="program_style" class="form-control" name="program_style">
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
                            <!--- getGradeMagazine() --->
                            <label class="control-label col-sm-2" for="pwd">বিবরন:</label>
                            <div class="col-sm-8">
                                <select class="form-control" onchange="change_description_info()"  name="biboron"
                                        id="biboron">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">শ্রেণী:</label>
                            <div class="col-sm-8">
                                <select class="form-control" onchange="change_grade_info()" name="grade" id="grade">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>

                                {{--                                <input type="text" readonly class="form-control" name="grade" id="grade_text"--}}
                                {{--                                       placeholder="শ্রেণী">--}}
                                {{--                                <input type="hidden" id="grade" value="" />--}}
                                {{--                                <input type="hidden" id="khetab_prapto" value="0"/>--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">স্থিতি:</label>
                            <div class="col-sm-8">
                                <select class="form-control" onChange="getSommaniMagazine(this.value)" name="stability"
                                        id="stability">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>
                            </div>
                        </div>

                        <script>

                        </script>


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">কর্মক্ষেত্র:</label>
                            <div class="col-sm-8">

                                <select name="work_area[]"  multiple id="work_area" class="select2" style="width:100%;"
                                        placeholder="চিহ্নিত করুন">
                                    @if(!empty($work_area))
                                        @foreach ($work_area as $key => $value)
                                            <option  value="{{ $key }}" >{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">ভূমিকা:</label>
                            <div class="col-sm-8">

                                <select name="aritist_vumika[]"   id="aritist_vumika" class="form-control" >
                                    @if(!empty($program_description))
                                        @foreach ($program_description as $key => $value)
                                            <option  value="{{ $key }}" >{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="recording_info_show">
                            <label class="control-label col-sm-2">রেকডিং এর তথ্য</label>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <input type="text" class="form-control datepickerLong" id="first_racording_date" placeholder="রেকডিং তারিখ" name="racording_date[]" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" id="recorded_time'" class="form-control timepicker"
                                                   required name="recorded_time[]" placeholder="রেকডিং সময়">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="show_mobile_log"></div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-12" style="margin-top:10px;">

                                        <button type="button" class="btn btn-primary btn-sm" id="add_mobile_no"><i class="glyphicon glyphicon-plus"></i> Add</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="show_mohoda_info" style="display: none;">
                            <label class="control-label col-md-2" for="pwd">মহড়া তারিখ:</label>
                            <div class="col-md-9">
                                <div id="show_mobile_log_1_1"></div>
                                <div class="col-sm-8" style="margin-top:10px;" >
                                    <div class="row">
                                        <input type="text" class="form-control datepickerLong" name="root_mohoda_date" id="mohoda_date" placeholder="মহড়া তারিখ">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="col-sm-12" style="margin-top:10px;" >
                                    <div class="row">
                                        <button type="button" class="btn btn-primary btn-sm" id="add_mobile_no_1_1"><span class="glyphicon glyphicon-plus"></span> Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">সম্মানী:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="0.00" id="ounarisom"
                                       placeholder="সম্মানী" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">বুকিং সংখ্যা</label>
                            <div class="col-sm-8">
                                <input type="text" min="1" readonly onchange="totalCost()" pattern="[0-9]+"
                                       class="form-control" id="number_of_days" name="number_of_days" placeholder="দিনের সংখ্যা" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">মহড়া ফি:</label>
                            <div class="col-sm-8">
                                <input type="text" min="1" value="0.00" readonly class="form-control"
                                       name="mohoda_fee"
                                       id="mohoda_fee" placeholder="মহড়া ফি" />
                                <input type="hidden" id="has_mohoda_fee" value="0" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">রাষ্ট্রীয় খেতাব:</label>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" value="0.00" readonly
                                       name="national_awarded_amount"
                                       id="national_awarded_amount" >

                            </div>
                            <div class="col-sm-2">
                                <select  class="form-control" readonly="" name="national_awarded" id="national_awarded" >
                                    <option value=""> চিহ্নিত করুন</option>
                                    <option value="1"> হ্যাঁ</option>
                                    <option value="2"> না</option>
                                </select>
                            </div>


                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">টি এ:</label>
                            <div class="col-sm-8">
                                <input type="number" min="1" value="0.00" pattern="[0-9]+" onChange="totalCost()"
                                       class="form-control" id="ta_amount" name="ta_amount" placeholder="টি এ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">ডি এ:</label>
                            <div class="col-sm-8">
                                <input type="number" min="1" value="0.00" pattern="[0-9]+" onChange="totalCost()"
                                       class="form-control" id="da_amount" placeholder="ডি এ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">মোট টাকা:</label>
                            <div class="col-sm-8">
                                <input type="text" min="1" value="0.00" readonly class="form-control" id="total_amount"
                                       placeholder="মোট টাকা" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" onClick="addBiboron()" class="btn btn-primary">যোগ করুন</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল করুন</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" onClick="addBiboron()" class="btn btn-primary">যোগ করুন</button> -->
                    <button type="button" id="closeBtn" class="btn btn-default" data-dismiss="modal">বাতিল করুন</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        window.biboronId = 1;
        window.biboronList = [];
        all_stability_info_global = "Volvo";

        function getBiboronName(id) {
            var programBiboron = JSON.parse($("#program_description_sub").val());
            for (var prop in programBiboron) {
                if (id == prop) {
                    return programBiboron[prop];
                }
            }
        }

        function getGradeName(id) {
            var gradeInfo = JSON.parse($("#artist_grade_info").val());
            for (var prop in gradeInfo) {
                if (id == prop) {
                    return gradeInfo[prop];
                }
            }
        }

        function getWorkareaName(id) {
            var workarea = JSON.parse($("#workArea").val());
            for (var prop in workarea) {
                if (id == prop) {
                    return workarea[prop];
                }
            }

            return '';
        }

        function getVumikaName(id) {

            var vumika = JSON.parse($("#program_vumika").val());
            for (var prop in vumika) {
                if (id == prop) {
                    return vumika[prop];
                }
            }

            return '';
        }

        function getVumikaInfo(biboron_id) {

            $.ajax({
                type: "POST",
                url: base_url + "/get_vumika_info",
                data: {
                    id: biboron_id,
                },
                async: false,
                'dataType': 'json',
                success: function(response) {
                    return response;
                }
            });

        }



        function getWorkAreaNameArray(array) {
            var names = '';
            if(Array.isArray(array)) {
                for(var i=0;i<array.length;i++) {
                    names += getWorkareaName(array[i]) +'-';
                }
            }

            return names;
        }

        function getCategoryName(id) {
            var program_style = JSON.parse($("#program_style").val());
            for (var prop in program_style) {
                if (id == prop) {
                    return program_style[prop];
                }
            }

            return '';
        }

        function getArtistName(id){
            var artist_info = JSON.parse($("#artist_info").val());
            for (var prop in artist_info) {
                if (id == prop) {
                    return artist_info[prop];
                }
            }

            return '';
        }



        function getBiboron() {

            // biboron
            $.ajax({
                type: "POST",
                url: base_url + "/planning_form_data",
                data: {
                    hounoriam_ctg_id: $("#artis_ctg_id").val(),
                    artist_id: $("#artist").val(),
                    biboron_id: $("#biboron").val(),
                    grade_id: $("#grade").val(),
                    stability: $("#stability").val(),
                },
                'dataType': 'json',
                success: function(response) {

                    var options = "<option value=''>চিহ্নিত করুন</option>";
                    if (response.biboron_info) {
                        for (var i = 0; i < response.biboron_info.length; i++) {
                            options += "<option value='" + response.biboron_info[i].id + "'>" + getBiboronName(response.biboron_info[i].id) + "</option>";
                        }
                    }
                    $("#biboron").html(options);

                    $("#grade").html("<option value=''>চিহ্নিত করুন</option>");
                    $("#stability").html("<option value=''>চিহ্নিত করুন</option>");

                }
            });
        }
        function change_description_info() {
            var biboron_id= $("#biboron").val();
            $("#work_area").select2("val", '');
            $.ajax({
                type: "POST",
                url: base_url + "/change_description_info",
                data: {
                    hounoriam_ctg_id: $("#artis_ctg_id").val(),
                    biboron_id: biboron_id,
                },
                'dataType': 'json',
                success: function(response) {
                    $("#grade").html("<option value=''>চিহ্নিত করুন</option>");
                    $("#stability").html("<option value=''>চিহ্নিত করুন</option>");
                    if(response.status=='success'){
                        var grade_info=response.data.grade_info;
                        var vumika_workarea=response.data.get_vumika_workarea;

                        if(vumika_workarea.rate_chart_work_area !='') {
                            var work_area_info = JSON.parse(vumika_workarea.rate_chart_work_area);
                        }else{
                            var work_area_info ='';
                        }
                        $("#aritist_vumika").val(vumika_workarea.rate_vumika);
                        $("#aritist_vumika").attr('readonly',true);
                        $("#work_area").select2("val", work_area_info);
                        var options_grade = "<option value=''>চিহ্নিত করুন</option>";
                        $.each(grade_info,function(k,value){
                            options_grade += "<option value='" + k + "'>" + value + "</option>";
                        });
                        $("#grade").html(options_grade);
                    }
                }
            });
        }
        function change_grade_info() {
            var grade= $("#grade").val();
            var biboron_id= $("#biboron").val();
            $.ajax({
                type: "POST",
                url: base_url + "/change_description_info",
                data: {
                    hounoriam_ctg_id: $("#artis_ctg_id").val(),
                    biboron_id: biboron_id,
                    grade: grade,
                },
                'dataType': 'json',
                success: function(response) {
                    $("#stability").html("<option value=''>চিহ্নিত করুন</option>");
                    if(response.status=='success'){
                        var stability_info=response.data.stability_info;
                        all_stability_info_global=stability_info;
                        var options = "<option value=''>চিহ্নিত করুন</option>";
                        if (stability_info) {
                            for (var i = 0; i < stability_info.length; i++) {
                                options += "<option value='" + stability_info[i].id + "'>" + stability_info[i].stability + "</option>";
                            }
                        }
                        $("#stability").html(options);
                    }
                }
            });
        }



        function getStabilityMagazine() {

            $.ajax({
                type: "POST",
                url: base_url + "/planning_form_data",
                data: {
                    station_id: $("#station_id").val(),
                    hounoriam_ctg_id: $("#artis_ctg_id").val(),
                    artist_id: $("#artist").val(),
                    biboron_id: $("#biboron").val(),
                    grade_id: $("#grade").val(),
                    stability: $("#stability").val(),
                },
                'dataType': 'json',
                success: function(response) {
                    console.log(response);
                    var options = "<option value=''>চিহ্নিত করুন</option>";
                    if (response.stability_info) {
                        for (var i = 0; i < response.stability_info.length; i++) {
                            options += "<option value='" + response.stability_info[i].stability + "'>" + response.stability_info[i].stability + "</option>";
                        }
                    }

                    $("#stability").html(options);
                }
            });

        }

        function getGradeMagazine() {
            carName = "tyoto";
            $.ajax({
                type: "POST",
                url: base_url + "/planning_form_data",
                data: {
                    station_id: $("#station_id").val(),
                    hounoriam_ctg_id: $("#artis_ctg_id").val(),
                    artist_id: $("#artist").val(),
                    biboron_id: $("#biboron").val(),
                    grade_id: $("#grade").val(),
                    stability: $("#stability").val(),
                },
                'dataType': 'json',
                success: function(response) {
                    if (response.grade_info) {
                        var gradename = getGradeName(response.grade_info[0].artist_grade);
                        $("#grade").val(response.grade_info[0].artist_grade);
                        $("#grade_text").val(gradename);
                        getStabilityMagazine();

                        var artist_id = $("#artist").val();
                        for (var i = 0; i < response.shilpi_info.length; i++) {
                            if (response.shilpi_info[i].national_awarded > 0 && response.shilpi_info[i].id == artist_id) {
                                $("#khetab_prapto").val(1);
                            }
                        }


                    }
                }
            });
        }


        function getSommaniMagazine(id) {
            for (var i = 0; i < all_stability_info_global.length; i++) {
                if (all_stability_info_global[i].id > 0 && all_stability_info_global[i].id == id) {
                    //$("#khetab_prapto").val(1);
                    $("#ounarisom").val(all_stability_info_global[i].amount);
                    if(all_stability_info_global[i].mohoda_fee==2){
                        $("#show_mohoda_info").hide();
                        $("#mohoda_fee").val('0.00');
                        $("#has_mohoda_fee").val(0);
                    }else{
                        $("#show_mohoda_info").show();
                        $("#has_mohoda_fee").val(1);
                    }
                    totalCost();
                }
            }
        }

        function saveProgramSavedInfoNew() {
            swal({
                title: "Are you sure?",
                text: "Once Save, You will saved this record",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: base_url + "/save_program_planning_info_create_new",
                            data: $('#save_program_planning_form').serialize(),
                            'dataType': 'json',
                            success: function(data) {
                                if (data.error.length > 0) {
                                    var error_html = '';
                                    for (var count = 0; count < data.error.length; count++) {
                                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                                    }
                                    $('#form_output').html(error_html);
                                } else {
                                    $('#save_program_planning_form')[0].reset();
                                    $('#form_output').html('');

                                    swal({
                                        text: data.success,
                                        icon: "success",
                                    }).then(function() {
                                        window.location = base_url + '/' + data.redirect_page;
                                    });
                                }
                            }
                        });
                    } else {
                        swal("Cancelled Now!");
                    }
                });
        }

        function dropRow(index) {
            window.biboronList.splice(index, 1);
            $("#row_" + index).remove();
            if(window.biboronList.length ==0) {
                $("#biboron_list_input").val('');
            }
            else {
                $("#biboron_list_input").val(JSON.stringify(window.biboronList));
            }
        }

        function addBiboron() {

            var artist_ctg_id = $("#artis_ctg_id").val();
            var artist = $("#artist").val();
            var biboron = $("#biboron").val();
            var grade_id = $("#grade").val();
            var khetabPrapto = $("#national_awarded").val();
            var stability = $("#stability").val();
            var ounarisom = $("#ounarisom").val();
            var work_area = $("#work_area").val();


            console.log(work_area);
            // $("#work_area").select2("val", [341,345]);
            //console.log('hello');
            var vumika = '';
            var number_of_days = $("#number_of_days").val();
            var mohoda_date_add = $("input[name='mohoda_date_add[]']").map(function() {
                return $(this).val();
            }).get();

            var has_mohoda_fee = $("#has_mohoda_fee").val();
            var ta_amount = $("#ta_amount").val();
            var da_amount = $("#da_amount").val();
            var total_amount = $("#total_amount").val();
            var mohoda_fee = $("#mohoda_fee").val();

            var racording_date_add = $("input[name='racording_date[]']").map(function() {
                return $(this).val();
            }).get();
            var recorded_time_add = $("input[name='recorded_time[]']").map(function() {
                return $(this).val();
            }).get();



            if (artist_ctg_id == '') {
                alert('শিল্পী সম্মানীর ক্যাটাগরি নির্বাচন করুন');
                return;
            } else if (biboron == '') {
                alert('বিবরন নির্বাচন করুন');
                return;
            } else if (artist == '') {
                alert('শিল্পী নির্বাচন করুন');
                return;
            } else if (grade_id == '') {
                alert('শ্রেণী নির্বাচন করুন');
                return;
            } else if (stability == '') {
                alert('স্থিতি নির্বাচন করুন');
                return;
            }
            $.ajax({
                type: "POST",
                url: base_url + "/get_vumika_info",
                data: {
                    id: biboron,
                },
                'dataType': 'json',
                success: function(response) {
                    console.log(response);
                    if(response.id!=null){
                        var vumika_id=response.id;
                    }else{
                        var vumika_id='';
                    }
                    var row = {
                        artis_ctg_id: artist_ctg_id,
                        biboron: biboron,
                        artist_id: artist,
                        grade_id: grade_id,
                        khetabPrapto: khetabPrapto,
                        stability: stability,
                        ounarisom: ounarisom,
                        work_area: work_area,
                        vumika:vumika_id,
                        racording_date_add: racording_date_add,
                        recorded_time_add: recorded_time_add,
                        number_of_days: number_of_days,
                        mohoda_date_add: mohoda_date_add,
                        has_mohoda_fee: has_mohoda_fee,
                        ta_amount: ta_amount,
                        da_amount: da_amount,
                        mohoda_fee: mohoda_fee,
                        total_amount: total_amount
                    };

                    window.biboronList.push(row);
                    tableRow(row);

                }
            });



        }


        function tableRow(row) {
            var index = window.biboronList.length - 1;

            $.ajax({
                type: "POST",
                url: base_url + "/get_vumika_info",
                data: {
                    id: row.biboron,
                },
                'dataType': 'json',
                success: function(response) {
                    var tr = `
                    <tr id="row_${index}">
                        <td style="font-size:10px;">${getCategoryName(row.artis_ctg_id)}</td>
                        <td style="font-size:10px;">${getArtistName(row.artist_id)}</td>
                        <td style="font-size:10px;">${getBiboronName(row.biboron)}</td>
                        <td style="font-size:10px;">${getGradeName(row.grade_id)}</td>
                        <td style="font-size:10px;">${row.stability}</td>
                        <td style="font-size:10px;">${row.ounarisom}</td>
                        <td style="font-size:10px;">${response.title}</td>
                        <td style="font-size:10px;">${row.number_of_days}</td>
                        <td style="font-size:10px;">${row.mohoda_date_add}</td>
                        <td style="font-size:10px;">${row.mohoda_fee}</td>
                        <td style="font-size:10px;">${row.ta_amount}</td>
                        <td style="font-size:10px;">${row.da_amount}</td>
                        <td style="font-size:10px;">${row.total_amount}</td>
                        <td>
                            <button onClick="dropRow(${index})" class="btn btn-danger btn-sm"><i class="glyphicon
                            glyphicon-trash"></i>
                            Drop</button>
                        </td>
                    </tr>
                `;
                    console.log(window.biboronList);

                    // return tr;
                    // var row = tableRow(row); <td style="font-size:10px;">${row.ounarisom}</td>
                    $("#biboron_list").append(tr);
                    $("#biboron_list_input").val(JSON.stringify(window.biboronList));
                    modalClose();
                }
            });

        }

        function openModal() {
            document.getElementById("myForm").reset();
            $("#show_mobile_log_1_1").empty();
            $("#show_mobile_log").empty();
            var record_type = $("#record_type").val();
            var station_id = $("#station_id").val();
            var get_board_cast_dt = $(".get_board_cast_dt").val();
            var days = document.getElementsByName("boardcasting_date[]");
            if(station_id==''){
                $("#show_error").html(' কেন্দ্র চিহ্নিত করুন');
                return false;
            }
            if(record_type==''){
                $("#show_error").html(' টাইপ চিহ্নিত করুন');
                return false;
            }
            if(record_type==1 && get_board_cast_dt=='' &&  days.length ==1){
                $("#show_error").html(' প্রচার তারিখ চিহ্নিত করুন');
                return false;
            }

            if(record_type==1) {
                var days = document.getElementsByName("boardcasting_date[]");
                $("#number_of_days").val(days.length);
                $("#recording_info_show").hide();
            }else{
                $("#number_of_days").val(1);
                $("#recording_info_show").show();
            }
            $("#work_area").select2("val", '');
            $("#show_error").html('');
            get_artist_info_description();
            $("#myModal").modal();
        }

        function modalClose() {
            var el = document.getElementById('closeBtn');
            if (el.onclick) {
                el.onclick();
            } else if (el.click) {
                el.click();
            }
        }

        function get_artist_info_description(){
            $.ajax({
                type: "POST",
                url: base_url + "/get_artist_info_program_description",
                data: {
                    station_id:$("#station_id").val(),

                },
                'dataType': 'json',
                success: function(response) {
                    var options = "<option value=''>চিহ্নিত করুন</option>";
                    var res_data=response.data;
                    if (response.status=='success') {
                        for (var i = 0; i < res_data.length; i++) {
                            options += "<option value='" + res_data[i].id + "'>" + res_data[i].name_bn + "</option>";
                        }
                    }
                    $("#artist").html(options);
                }
            });
        }

        function get_artist_expertise_info_filter(){
            $.ajax({
                type: "POST",
                url: base_url + "/get_artist_info_program_description",
                data: {
                    station_id:$("#station_id").val(),
                    expertise_id:$("#expertise_1").val(),
                    expertise_dept:$("#expertise_dept_1").val(),
                    exp_grade_id:$("#artist_grade").val(),

                },
                'dataType': 'json',
                success: function(response) {
                    var options = "<option value=''>চিহ্নিত করুন</option>";
                    var res_data=response.data;
                    if (response.status=='success') {
                        for (var i = 0; i < res_data.length; i++) {
                            options += "<option value='" + res_data[i].id + "'>" + res_data[i].name_bn + "</option>";
                        }
                    }
                    $("#artist").html(options);
                }
            });
        }



        function get_single_artist_info(artist_id){
            $.ajax({
                type: "POST",
                url: base_url + "/get_single_artist_info",
                data: {
                    artist_id:artist_id,
                },
                'dataType': 'json',
                success: function(response) {
                    var response_data=response.data;
                    if (response.status=='success') {
                        console.log(response_data.national_awarded);
                        if(response_data.national_awarded>0){
                            $("#national_awarded").val(1);
                        }else{
                            $("#national_awarded").val(2);
                        }
                    }

                }
            });
        }


    </script>

    <script>
        var k = 1;
        $("#add_mobile_no").click(function() {
            var markup = '<div id="mobile_no_log_info_' + k + '"><div class="col-sm-12"> <div class="col-sm-6" ' +
                'style="margin-top:10px" ><div' +
                ' ' +
                'class="row"> ' +
                '<input ' +
                'type="text" ' +
                'id="mobile_no' + k + '" ' +
                'class="form-control  datepickerLong" \n' +
                '                                                   placeholder="রেকর্ডিং তারিখ" ' +
                'name="racording_date[]"/></div></div><div class="col-sm-4" style="margin-top:10px;"> <input ' +
                'type="text" ' +
                'id="recorded_time' +
                k + '" class="form-control timepicker" required name="recorded_time[]" placeholder="রেকডিং ' +
                'সময়"></div><div class="col-sm-2" ' +
                'style="margin-top:10px" ' +
                '>\n' +
                '        <a href="javascript:void(0);"  id="deleteRow_' + k + '"  class="delete-row btn btn-warning ' +
                'btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a> </div></div></div>';
            $("#show_mobile_log").append(markup);
            k++;
            $(".datepickerLong").datepicker({ dateFormat: 'dd-mm-yy' });
            addTimepicker();
            calculation_num_days();

        });
        function calculation_num_days(){
            var racording_dateCountInfo = document.getElementsByName("racording_date[]");
            var dateCountRecording =racording_dateCountInfo.length;
            $("#number_of_days").val(dateCountRecording);
        }

        $(document).on("click", ".delete-row", function(e) {
            var element_id = elementId($(this).attr('id'));
            $("#mobile_no_log_info_" + element_id).remove();
        });


        var l = 1;
        $("#add_mobile_no_1").click(function() {
            var markup = '<div id="mobile_no_log_info_1' + l + '"> <div class="col-sm-8" style="margin-top:10px" ><div ' +
                'class="row"> ' +
                '<input ' +
                'type="text" ' +
                'id="mobile_no_1' + l + '" ' +
                'class="form-control  datepickerLong" \n' +
                '                                                   placeholder="প্রচার তারিখ" ' +
                'name="boardcasting_date[]"/></div></div><div class="col-sm-4" style="margin-top:10px" >\n' +
                '        <a href="javascript:void(0);"  id="deleteRow_1' + l + '"  class="delete-row-1 btn btn-warning ' +
                'btn-flat btn-sm" onclick="removeProcarDate('+l+')"><i class="glyphicon glyphicon-remove"></i>  Drop</a> </div></div>';
            $("#show_mobile_log_1").append(markup);
            l++;
            $(".datepickerLong").datepicker({ dateFormat: 'dd-mm-yy' });
        });

        function removeProcarDate(id) {
            $("#mobile_no_log_info_1" + id).remove();
        }

        var m = 1;
        $("#add_mobile_no_1_1").click(function() {

            var mohoda_date = $("#mohoda_date").val();
            if (mohoda_date == '') {
                alert('মহডা তারিখ দিন');
                return false;
            }

            $("#mohoda_date").val('');

            var markup = '<div id="mobile_no_log_info_1_1' + m + '"> <div class="col-sm-8" style="margin-top:10px" ><div ' +
                'class="row"> ' +
                '<input  readonly ' +
                'type="text" ' +
                'id="mohoda_date' + m + '" ' +
                'value="' + mohoda_date + '" ' +
                'class="form-control" \n' +
                '                                                   placeholder="মহড়া তারিখ" ' +
                'name="mohoda_date_add[]"/></div></div><div class="col-sm-4" style="margin-top:10px" >\n' +
                '        <a href="javascript:void(0);" onClick="removeMohodaDate(' + m + ')"  id="deleteRow_1' + m + '"  class="delete-row-1-1 btn btn-warning ' +
                'btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a> </div></div>';
            $("#show_mobile_log_1_1").append(markup);
            m++;
            $(".datepickerLong").datepicker({ dateFormat: 'dd-mm-yy' });
            totalCost();
        });

        function removeMohodaDate(id) {
            $("#mobile_no_log_info_1_1" + id).remove();
            totalCost();
        }



        var scntDivSong = $('#show_all_program_desciption');
        var a = $('#show_all_program_desciption tr').size() + 1;
        var a_index = 1;
        $('#add_description').on('click', function() {
            $('<tr><td><select\n' +
                '                                id="program_description_id_' + a + '" ' +
                'name="program_description_id[' + a_index + ']"\n' +
                '                                class="form-control">\n' +
                '                            <option value="">বিবরন</option>\n' +
                '                            @if(!empty($program_description)){\n' +
                '                                @foreach ($program_description as $key=> $description){\n' +
                '                                        <option value="{{ $key  }}">{{ $description  }}</option>\n' +
                '                                @endforeach\n' +
                '                            @endif\n' +
                '                        </select></td><td> <select id="artist_name_all_' + a + '"   ' +
                'name="artist_name_all[' + a_index + '][]"\n' +
                '                                class="select2" multiple required style="width:100%; !important">\n' +
                '                            @if(!empty($atrist_info_info))\n' +
                '                                @foreach($atrist_info_info as $key=> $value)\n' +
                '                                    <option value="{{ $key }}">{{ $value }}</option>\n' +
                '                                @endforeach\n' +
                '                            @endif\n' +
                '                        </select></td><td><a href="javascript:void(0);"  id="deleteRow_' + a + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> </a></td></tr>').appendTo(scntDivSong);
            $("#artist_name_all_" + a).select2();
            a++;
            a_index++;
            return false;
        });

        // total amount calculation
        function getKhetabAmount() {
            var khetabAmount = 0;
            var sommani = $("#ounarisom").val() == 0 || $("#ounarisom").val() == '' ? 0 : $("#ounarisom").val();
            var khetab = $("#national_awarded").val() == 2 || $("#khetab_prapto").val() == '' ? 0 : $
            ("#national_awarded").val();
            if (khetab == 1) {
                khetabAmount = parseInt((sommani * 25) / 100);
            }
            $("#national_awarded_amount").val(khetabAmount.toFixed(2))
            return khetabAmount;
        }

        function getmohodaFee() {
            var sommani = $("#ounarisom").val() == 0 || $("#ounarisom").val() == '' ? 0 : $("#ounarisom").val();
            var has_mohoda_fee = $("#has_mohoda_fee").val() == 0 || $("#has_mohoda_fee").val() == '' ? 0 : $("#has_mohoda_fee").val();
            if (has_mohoda_fee ==1) {
                var dateCountInfo = document.getElementsByName("mohoda_date_add[]");
                var dateCount =dateCountInfo.length;
                if (dateCount > 0 && dateCount < 4) {
                    percentage = parseFloat( 25);
                } else if (dateCount > 3) {
                    percentage = parseFloat( 50);
                }else{
                    percentage = parseFloat( 25);
                }
                var mohoda_fee = parseFloat( parseFloat(sommani) * parseFloat( percentage) / 100);
                $("#mohoda_fee").val(mohoda_fee);
                return mohoda_fee;
            } else {
                $("#mohoda_fee").val('0.00');
                return 0;
            }
        }

        function totalCost() {
            var mohoda_fee = getmohodaFee();
            var khetabAmount = getKhetabAmount();
            var record_type = $("#record_type").val();
            var days = $("#number_of_days").val();
            var ta_amount = $("#ta_amount").val() == '' ? 0 : $("#ta_amount").val();
            var da_amount = $("#da_amount").val() == '' ? 0 : $("#da_amount").val();
            var sommani = $("#ounarisom").val() == '' ? 0 : $("#ounarisom").val();
            var totalTaka = parseInt(khetabAmount) + parseInt(mohoda_fee) + parseInt(ta_amount) + parseInt(da_amount) + parseInt(sommani * days);
            $("#total_amount").val(totalTaka.toFixed(2));
        }
    </script>



@endsection