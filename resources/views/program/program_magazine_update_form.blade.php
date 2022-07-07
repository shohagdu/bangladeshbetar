<div class="modal-body">

                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <?php
//                                echo "<pre>";
//                                print_r($program_plan);
                            ?>
                            <label class="col-md-2 control-label"> কেন্দ্র </label>
                            <div class="col-md-4">
                                <select id="station_id" onchange="getSubStation(this.value)" class="form-control" name="station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$value)
                                            <option {{ $key == $program_plan->station_id ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                        
                            <label class="col-md-2 control-label">অনুষ্ঠানের  নাম</label>
                            <div class="col-md-4">
                                <input type="text" id="program_name" class="form-control" required name="program_name"
                                      value="{{ $program_plan->program_name }}" placeholder="অনুষ্ঠানের  নাম">
                            </div>

                            <label class="col-md-2 control-label">অনুষ্ঠানের ধরন </label>
                            <div class="col-md-4">
                                <select id="program_type" class="form-control" name="program_type">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($program_type))
                                        @foreach($program_type as $key=>$value)
                                            <option {{ $key == $program_plan->program_type? 'selected': '' }} value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                            
                        </div>

                        <div class="form-group">

                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <input type="checkbox" {{ $program_plan->fixed_program_type_id>0 ? 'checked' : false }} onclick="is_program_type_check(this)" id="is_fixed_program" name="is_fixed_program"/> উৎস ও বার্ষিকী অনুষ্ঠান
                            </div>
                            <div style="display:{{ $program_plan->fixed_program_type_id>0 ? 'block' : 'none' }};" id="fixed_program_type_div">
                                <label class="col-md-2 control-label">বার্ষিকী অনুষ্ঠানের ধরন</label>
                                <div class="col-md-2">
                                    <select id="fixed_program_type" class="form-control" name="fixed_program_type">
                                        <option value="">বার্ষিকী অনুষ্ঠানের ধরন</option>
                                        @foreach($get_fixed_program_type as $value)
                                            <option {{ $program_plan->fixed_program_type_id==$value->id? 'selected': '' }} value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
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
                                            <option {{ $key == $program_plan->program_style? 'selected': '' }} value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">রেকর্ডিং তারিখ</label>
                            <div class="col-md-2">
                                <input type="text" value="{{ $program_plan->recorded_date }}" class="form-control datepickerLong" placeholder="রেকডিং তারিখ"
                                       name="recorded_date"/>
                            </div>
                             <div class="col-md-2">
                                 <input type="checkbox" {{ (!empty($program_plan->recording_date_is_plexibity) &&
                                 $program_plan->recording_date_is_plexibity==1) ?
                                 'checked' :
                                 false }} id="recording_date_is_plexibity"
                                        name="recording_date_is_plexibity"/> প্রয়োজন মত
                             </div>
                            <label class="col-md-2 control-label">রেকর্ডিং সময়</label>
                            <div class="col-md-2">
                                <input type="text" id="recorded_time" value="{{ $program_plan->recorded_time }}" class="form-control timepicker" required
                                       name="recorded_time"
                                       placeholder="রেকডিং সময়">
                            </div>
                             <div class="col-md-2">
                                 <input type="checkbox" {{ (!empty($program_plan->recording_time_is_plexibity) &&
                                 $program_plan->recording_time_is_plexibity==1) ?
                                 'checked' :
                                  false }} id="recording_time_is_plexibity"
                                        name="recording_time_is_plexibity"/> প্রয়োজন মত
                             </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">প্রচার তারিখ</label>
                            <div class="col-md-2">
                                <input type="text"  class="form-control datepickerLong" placeholder="প্রচার তারিখ"
                                       name="live_date" value="{{ $program_plan->live_date }}" />
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" {{ (!empty($program_plan->live_date_is_plexibity) &&
                                $program_plan->live_date_is_plexibity==1) ?
                                'checked' : false
                                }} id="live_date_is_plexibity"
                                       name="live_date_is_plexibity"/> প্রয়োজন মত
                            </div>
                            <label class="col-md-2 control-label">প্রচার সময়</label>
                            <div class="col-md-2">
                                <input type="text" id="live_time" value="{{ $program_plan->live_time }}" class="form-control timepicker" required
                                       name="live_time"
                                       placeholder="প্রচার সময়">

                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" {{ (!empty($program_plan->live_time_is_plexibity) &&
                                $program_plan->live_time_is_plexibity==1) ?
                                'checked' : false
                                }} id="live_time_is_plexibity"
                                       name="live_time_is_plexibity"/> প্রয়োজন মত
                            </div>
                        </div>


                       <div class="form-group">
                            <label class="col-md-2 control-label">রেকর্ডিং স্থিতি</label>
                            <div class="col-md-4">
                                <input type="text" id="recording_stabilty" class="form-control" placeholder="রেকডিং  স্থিতি"
                                       name="recording_stabilty" value="{{ $program_plan->recording_stabilty }}" />
                            </div>
                            <label class="col-md-2 control-label">টাইপ</label>
                            <div class="col-md-4">
                                <select required name="record_type" class="form-control" id="record_type">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option {{ 1 == $program_plan->record_type? 'selected': '' }} value="1">সজীব</option>
                                    <option {{ 2 == $program_plan->record_type? 'selected': '' }} value="2">রেকর্ড</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">উদ্দেশ্য</label>
                            <div class="col-md-4">
                                <textarea class="form-control" placeholder="উদ্দেশ্য"
                                          name="larget_viewer">{{$program_plan->larget_viewer}}</textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2">অনুষ্ঠানের বিবরন</th>
                                </tr>
                                <tr>
                                    <th style="width:30%;">বিবরন</th>
                                    <th>শিল্পীর নাম</th>
                                    <th style="width:5%;">#</th>
                                </tr>

                                <tbody id="show_all_program_desciption">
                                <?php
                            //    echo "<pre>";
                                //                                    print_r($selected_artist);
                                //                                    print_r($program_description);
                              //  print_r($selected_artist);
                                //                                    exit;
                                if(!empty($selected_artist)){
                                $ik_index=0;
                                foreach ($selected_artist as $key_main=> $selected_artist_value) {
                                ?>
                                <tr>
                                    <td>
                                        <select id="program_description_id_1"
                                                name="program_description_id"
                                                class="form-control">
                                            <option value="">ভমিকা</option>
                                        
                                        </select>
                                    </td>
                                    <td>

                                        <select  name="artist_name_all[{{ $ik_index }}][]" class="select2" multiple
                                                 required style="width:100%; !important">
                                            @if(!empty($atrist_info_info))
                                                @foreach($atrist_info_info as $akey=> $value)
                                                    <option {{ in_array($akey,$selected_artist[$key_main])
                                                            ? 'selected' : '' }}   value="{{ $akey }}">{{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td><button type="button" id="delete_{{ $key }}"  class="btn
                                            btn-warning btn-sm deleteRow"><i class="glyphicon glyphicon-remove"></i> </button></td>
                                </tr>
                                <?php
                                $ik_index++;
                                }
                                ?>
                                </tbody>
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
                                    $organizer = json_decode($program_plan->program_organizer,true);
                                    
                                foreach ($manage as $key=> $value) {
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
                                                        @foreach($employee_info as $ekey => $value)
                                                            <option {{ is_array($organizer) && isset($organizer[$key]) && in_array($ekey,$organizer[$key]) ? 'selected' : '' }}  value="{{ $ekey }}">{{ $value }}</option>
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
                        <button type="button" onclick="updateProgramSavedInfoSubmit()" id="updateBtn" class="btn
                        btn-success"><i
                                    class="glyphicon glyphicon-save"></i> Update
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" value="{{$setting_id}}" name="setting_id" id="setting_id">
                    </div>
                </div>

<script>
    var scntDivSong = $('#show_all_program_desciption');
    var a = $('#show_all_program_desciption tr').size() + 1;
    var a_index=a;
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
    $( document ).ready(function() {
        var fixed_type_id='<?php echo $program_plan->fixed_program_type_id ?>';
        $.ajax({
            type: "POST",
            url: base_url + "/show_sub_fixed_program_type",
            data: {fixed_type_id: fixed_type_id},
            'dataType': 'json',
            success: function (response) {
                $('#sub_fixed_program_type').html('<option value="">সাব-বার্ষিকী অনুষ্ঠানের ধরন</option>');
                if (response.status == 'success') {
                    $.each(response.data, function (index, Obj) {
                        $('#sub_fixed_program_type').append('<option value="' + index + '">' + Obj + '</option>')
                    })
                    $('#sub_fixed_program_type').val('<?php echo $program_plan->sub_fixed_program_type_id ?>')
                }
            }
        });

    });
</script>