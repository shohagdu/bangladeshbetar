@extends("master_program")
@section('title_area')
:: সময়সূচী সেটিংস ::
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
        <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
            <h2> অনুষ্ঠান সূচি সেটিংস</h2>

            <a href="{{ url('master_day_program_time_table') }}">
                <button type="button" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Program Schedule
                </button>
            </a>

        </header>
        <div>
            <div class="widget-body no-padding">
                {!! Form::open(['url' => '', 'id' => 'program_time_table_setup_form','method' => 'post','class'=>'form-horizontal']) !!}
                <div class="col-sm-12" style="margin-top:10px;margin-bottom:80px;">
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">কেন্দ্রের নাম </label>
                        <div class="col-md-4">
                            <select id="station_id" required class="form-control" onchange="getSubStation(this.value)" name="station_id">
                                <option value="">চিহ্নিত করুন</option>
                                @if(!empty($station_info))
                                @foreach($station_info as $key=>$value)
                                <option {{$key===$schedule_info->station_id ? "selected" : ''}} value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-md-2 control-label">ফিকোয়েন্সি </label>
                        <div class="col-md-4">
                            <select id="sub_station_id" required class="form-control" name="sub_station_id">
                                <option value="">চিহ্নিত করুন</option>
                                <?php  foreach($sub_station_info as $key => $value) { ?>
                                    <option <?php echo $value->id==$schedule_info->sub_station_id ? 'selected' : '' ?> value="<?php echo $value->id; ?>"><?php echo $value->title.'('.$value->fequencey.')'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">অনুরুপ ফিকোয়েন্সি</label>
                        <div class="col-md-4">
                            <?php $onurup_ids = !empty($schedule_info->onurup)? json_decode($schedule_info->onurup,true):[]; ?>
                            <select id="onurup_ids" placeholder="অনুরুপ" multiple required class="select2" name="onurup_ids[]">
                                <?php foreach($sub_station_info as $key => $value) { ?>
                                <option <?php echo in_array($value->id,$onurup_ids) ? 'selected' : '' ?> value="<?php echo $value->id; ?>"><?php echo $value->title.'('.$value->fequencey.')'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">

                        <label class="col-md-2 control-label">নিদিষ্ট অনুষ্ঠান সূচি</label>
                        <div class="col-md-3">
                            <select id="fixed_onusan_suchy" class="form-control" required name="fixed_onustan_suchy">
                                <option value="">চিহ্নিত করুন</option>
                                <option <?php echo $schedule_info->fixed_onustan_suchy==1?'selected':false; ?> value="1">গ্রীষ্ম কালীন</option>
                                <option <?php echo $schedule_info->fixed_onustan_suchy==2?'selected':false; ?> value="2">শীত কালিন</option>
                            </select>
                        </div>

                        <label class="col-md-2 control-label">ত্রৈমিাসিক পরিক্লপনা </label>
                        <div class="col-md-2">
                            <select id="torimasik_porikolpona" class="form-control" name="torimasik_porikolpona">
                                <option value="">চিহ্নিত করুন</option>
                                <option <?php echo $schedule_info->torimasik_porikolpona==1?'selected':false; ?> value="1">১ম: (বৈশাখ-আযাঢ়) </option>
                                <option <?php echo $schedule_info->torimasik_porikolpona==2?'selected':false; ?> value="2">২য়: (শ্যাবন-আশ্বিন)</option>
                                <option <?php echo $schedule_info->torimasik_porikolpona==3?'selected':false; ?> value="3">৩য়: (কার্তিক-পৌষ)</option>
                                <option <?php echo $schedule_info->torimasik_porikolpona==4?'selected':false; ?> value="4">৪র্থ: (মাঘ-চৈত্র)</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="bangla_son" value="১৪২৬" class="form-control" readonly="">
                        </div>


                    </div>

                    <table class="table-bordered table">

                        <thead>

                            <tr>
                                <td  style="width:5%">বার</td>
                                <td style="width:5%">সপ্তাহ</td>
                                <td style="width:8%">সময়</td>

                                <td style="width:7%">চাংক</td>
                                <td style="width:7%">অনুষ্ঠানের বিবরন</td>
                                <td style="width:7%">বিষয়বস্তু</td>
                                <td style="width:8%">স্থিতি (মিনিট)</td>
                                <td style="width:8%">মন্তব্য</td>
                                <td style="width:5%">রেকর্ড</td>

                                <td style="width:7%">প্রযোজনা</td>
                                <td style="width:7%">তত্বাবধানে</td>
                                <td style="width:5%">ক্রমিক</td>
                                <td style="width:5%">#</td>
                            </tr>
                        </thead>

                        <tbody id="dynamicJobHistorytr">
                            <?php
                            $content = json_decode($schedule_info->content,true);
                           // print_r($content);
                          //  exit;
                            foreach($content as $key => $value) {
                            ?>
                            <tr id="<?php echo $key; ?>">
                                <td>
                                    <select style='width:150px;' placeholder="Day" id='days<?php echo $key ?>' multiple  onchange='addData(<?php echo $key; ?>)' class='select2'>
                                        <option <?php echo in_array(1,$value['days']) ? 'selected' : false; ?> value="1">শনিবার</option>
                                        <option <?php echo in_array(2,$value['days']) ? 'selected' : false; ?>  value="2">রবিবার</option>
                                        <option <?php echo in_array(3,$value['days']) ? 'selected' : false; ?>  value="3">সোমবার</option>
                                        <option <?php echo in_array(4,$value['days']) ? 'selected' : false; ?>  value="4">মঙ্গলবার</option>
                                        <option <?php echo in_array(5,$value['days']) ? 'selected' : false; ?>  value="5">বুধবার</option>
                                        <option <?php echo in_array(6,$value['days']) ? 'selected' : false; ?>  value="6">বৃহস্পতিবার</option>
                                        <option <?php echo in_array(7,$value['days']) ? 'selected' : false; ?>  value="7">শুক্রবার</option>
                                        <option <?php echo in_array(8,$value['days']) ? 'selected' : false; ?>  value="8">প্রতিদিন</option>
                                    </select>

                                </td>
                                <td>

                                    <select style='width:150px;' placeholder="চিহ্নিত করুন" id='week<?php echo $key ?>' multiple  onchange='addData(<?php echo $key; ?>)' class='select2'>

                                        <option value="7" <?php echo (empty($value['week'])) ?false:( in_array(7,
                                            $value['week']) ?  'selected' : false);  ?> >প্রতি সপ্তাহ </option>
                                        <option value="1"<?php echo (empty($value['week'])) ?false:( in_array(1,
                                            $value['week']) ?  'selected' : false);  ?>>১ম</option>
                                        <option value="2" <?php echo (empty($value['week'])) ?false:( in_array(2,
                                            $value['week']) ?  'selected' : false);  ?>>২য়</option>
                                        <option value="3" <?php echo (empty($value['week'])) ?false:( in_array(3,
                                            $value['week']) ?  'selected' : false);  ?>>৩য়</option>
                                        <option value="4" <?php echo (empty($value['week'])) ?false:( in_array(4,
                                            $value['week']) ?  'selected' : false);  ?>>৪র্থ</option>
                                        <option value="5" <?php echo (empty($value['week'])) ?false:( in_array(5,
                                            $value['week']) ?  'selected' : false);  ?>>৫ম</option>
                                        <option value="6" <?php echo (empty($value['week'])) ?false:( in_array(6,
                                            $value['week']) ?  'selected' : false);  ?>>শেষ</option>

                                    </select>
                                </td>
                                <td>
                                    <input type='text' autocomplete='off' id='time<?php echo $key ?>' value='<?php echo $value['time'] ?>' onblur='addData(<?php echo $key; ?>)'  placeholder='সময়' class='form-control  timepicker'>
                                </td>

                                <td>
                                    <input type='text' autocomplete='off' id='program_chunk<?php echo $key ?>' value='<?php echo $value['chank'] ?>' onkeyup='addData(<?php echo $key; ?>)'  placeholder='চাংক' class='form-control'>
                                </td>
                                <td>
                                    <input type='text' autocomplete='off' id='title<?php echo $key ?>' value='<?php echo $value['biboron'] ?>' onkeyup='addData(<?php echo $key; ?>)'  placeholder='অনুষ্ঠানের বিবরন' class='form-control'>
                                </td>
                                <td>
                                    <textarea id='description<?php echo $key ?>' autocomplete='off'
                                              onkeyup='addData(<?php echo $key ?>)' placeholder='বিষয়বস্তু' class='form-control'><?php  echo (empty
                                        ($value['description'] ))?'': $value['description'] ?></textarea>
                                </td>
                                <td>
                                    <input type='text' autocomplete='off' id='stability<?php echo $key ?>' value='<?php echo $value['stability'] ?>' onkeyup='addData(<?php echo $key; ?>)'  placeholder='স্থিতি' class='form-control'>
                                </td>

                                <td>
                                    <input type='text' autocomplete='off' id='comment<?php echo $key ?>' value='<?php echo $value['comment'] ?>' onkeyup='addData(<?php echo $key; ?>)'  placeholder='মন্তব্য' class='form-control'>
                                </td>
                                <td>
                                    <input type='checkbox'  <?php echo $value['is_recorded']==1?'checked': false; ?>
                                    id='recoarded<?php echo $key ?>'   onclick='addData(<?php echo $key; ?>)'/></td>
                                 <td>
                                    <select class='form-control' id='projejeno<?php echo $key ?>' onchange='addData(<?php echo $key; ?>)' >
                                        <option value=''>চিহ্নিত করুন</option>
                                        @if(!empty($employee_info))
                                            @foreach($employee_info as $emp_key=> $emp_value)
                                                <option <?php echo  (!empty($value['projejeno']) &&
                                                    $value['projejeno']==$emp_key )?"selected":'';
                                                        ?> value="{{ $emp_key }}">{{ $emp_value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select class='form-control' id='tottabodane<?php echo $key ?>' onchange='addData(<?php echo $key; ?>)'>
                                        <option value=''>চিহ্নিত করুন</option>
                                        @if(!empty($employee_info))
                                            @foreach($employee_info as $totabodane_key=> $emp_value)
                                                <option <?php echo  (!empty($value['tottabodane']) &&
                                                    $value['tottabodane']==$totabodane_key )?"selected":'';
                                                ?> value="{{ $totabodane_key }}">{{ $emp_value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <input type='text' autocomplete='off' id='sorting<?php echo $key ?>' value='<?php echo $value['sorting'] ?>' onkeyup='addData(<?php echo $key; ?>)'  placeholder='ক্রমিক' class='form-control'>
                                </td>

                                <td>
                                    <button type='button' class='btn btn-warning btn-flat btn-sm' onclick='removeRow(<?php echo $key; ?>)'><i class='glyphicon glyphicon-remove'></i> Drop</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="11">
                                    <input type="hidden" name="schedule_id" value="<?php echo $schedule_info->id ?>"/>
                                    <button type="button" onclick="addRow()" class="btn btn-primary btn-sm program_time"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="11">
                                    <div id="form_output"></div>
                                    <textarea style="visibility:hidden;" name="schedule" id="schedule"><?php echo $schedule_info->content; ?></textarea>
                                    <div class="clearfix"></div>
                                    <button style="margin-left:400px;" type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</article>

@endsection