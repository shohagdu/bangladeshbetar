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

                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'update_program_planning_cost',
               'class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:0px;">

                        <div class="form-group">
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
                            
                        </div>

                        <div class="form-group">

                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <input type="checkbox" {{ $program_plan->fixed_program_type_id>0 ? 'checked' : false }} onclick="is_program_type_check(this)" id="is_fixed_program" name="is_fixed_program"/> উৎস ও বার্ষিকী অনুষ্ঠান ?
                            </div>
                            <div style="display:{{ $program_plan->fixed_program_type_id>0 ? 'block' : 'none' }};" id="fixed_program_type_div">
                                <label class="col-md-2 control-label">বার্ষিকী অনুষ্ঠানের ধরন</label>
                                <div class="col-md-4">
                                    <select id="fixed_program_type" class="form-control" name="fixed_program_type">
                                        <option value="">বার্ষিকী অনুষ্ঠানের ধরন</option>
                                        @foreach($get_fixed_program_type as $value)
                                            <option {{ $program_plan->fixed_program_type_id==$value->id? 'selected': '' }} value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group">

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
                            <div class="col-md-4">
                                <input type="text" value="{{ $program_plan->recorded_date }}" class="form-control datepickerLong" placeholder="রেকডিং তারিখ"
                                       name="recorded_date"/>
                            </div>
                            <label class="col-md-2 control-label">রেকর্ডিং সময়</label>
                            <div class="col-md-4">
                                <input type="text" id="recorded_time" value="{{ $program_plan->recorded_time }}" class="form-control timepicker" required
                                       name="recorded_time"
                                       placeholder="রেকডিং সময়">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">প্রচার তারিখ</label>
                            <div class="col-md-4">
                                <input type="text"  class="form-control datepickerLong" placeholder="প্রচার তারিখ"
                                       name="live_date" value="{{ $program_plan->live_date }}" />
                            </div>
                            <label class="col-md-2 control-label">প্রচার সময়</label>
                            <div class="col-md-4">
                                <input type="text" id="live_time" value="{{ $program_plan->live_time }}" class="form-control timepicker" required
                                       name="live_time"
                                       placeholder="প্রচার সময়">

                            </div>
                        </div>


                       <div class="form-group">
                            <label class="col-md-2 control-label"> স্থিতি</label>
                            <div class="col-md-4">
                                <input type="text" id="recording_stabilty" class="form-control" placeholder="  স্থিতি"
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
                            <label class="col-md-2 control-label">উদ্দেশ্য/বিষয়</label>
                            <div class="col-md-4">
                                <textarea class="form-control" placeholder="উদ্দেশ্য/বিষয়"
                                          name="larget_viewer">{{$program_plan->larget_viewer}}</textarea>
                            </div>
                        </div>
                        <textarea style="visibility:hidden;" id="rate_chart">{{ json_encode($get_rate_chart) }}</textarea>

                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="6">অনুষ্ঠানের বিবরন
                                    </th>
                                </tr>
                                <?php
                                    $i =1;
                                    $totalCost = 0;
                                    if(!empty($program_description)) {
                                    foreach ($program_description as $key=> $description) {
                                        $artist = [];
                                        if(!empty($atrist_info_info)) {
                                            foreach($atrist_info_info as $akey=> $value) {
                                                if( isset($selected_artist[$key]['artist_id']) && in_array($akey,$selected_artist[$key]['artist_id']) ) {
                                                    $artist[]=[$akey=>$value];
                                                }
                                            }
                                        }
                                ?>
                                        
                                        <tr>
                                            <td colspan="6">
                                                <input type="text" readonly placeholder="বিবরন" value="{{ $description  }}" id="program_description_{{ $key }}" name="program_description[{{$key}}]" class="form-control">
                                               
                                            </td>
                                            
                                        </tr>
                                        
                                <?php 
                                $j = 0;
                                foreach($artist as   $artist_array) { 
                                   
                                    foreach($artist_array as $arkey => $ar_name) {
                                ?>
                                    <tr>
                                        <td>
                                        
                                            <select type="text" placeholder="শিল্পীর নাম" id="artist_id{{$i}}"  name="program_description[{{$key}}][artist_id][]"
                                                class="form-control" required style="width:100%; !important">
                                                <option value="{{ $arkey }}">{{ $ar_name }}</option>      
                                            </select>
                                        </td>
                                        <td style="width:200px;">
                                            <select name="program_description[{{$key}}][program_style_id][]" onchange="getDescription({{$i}})"  class="form-control" id="program_style_id{{$i}}">
                                                <option value="">অনুষ্ঠানের প্রকৃতি</option>
                                                <?php 
                                                if(!empty($program_style)) {
                                                    foreach($program_style as $pkey=>$value) {
                                                    ?>
                                                    <option 
                                                    <?php
                                                    if( $pkey == $selected_artist[$key]['program_style_id'][$j]  ) {
                                                        echo "selected";
                                                    }
                                                    ?> value="{{ $pkey }}"> {{ $value }} </option>
                                                    <?php
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </td>
                                        <td style="width:200px;">
                                                @php 
                                                    $biboron = [];
                                                    foreach($get_rate_chart as $id => $value){
                                                        if($selected_artist[$key]['program_style_id'][$j] == $value->ctg_id){
                                                            if(!isset($biboron[$value->description])){
                                                                $biboron[$value->description] = $value;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                
                                            
                                            <select name="program_description[{{$key}}][program_description_id][]" onchange="getGrade({{$i}})"  class="form-control" id="program_description_id{{$i}}">
                                                <option value="">বিবরন</option>
                                               
                                                @foreach($biboron as $id => $value)
                                                    
                                                    <option 
                                                    {{ $value->description == $selected_artist[$key]['description_id'][$j] ? 'selected': '' }} 
                                                    value="{{$value->description}}">{{$value->description}}
                                                    </option>
                                                    
                                                @endforeach

                                            </select>
                                        </td>
                                        <td>
                                            @php 
                                                $grades = [];
                                                foreach($get_rate_chart as $id => $value){
                                                    if($selected_artist[$key]['program_style_id'][$j] == $value->ctg_id 
                                                    && $value->description == $selected_artist[$key]['description_id'][$j]){
                                                        if(!isset($grades[$value->grade_id])){
                                                            $grades[$value->grade_id] = $value;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            
                                            <select name="program_description[{{$key}}][grade_id][]" onchange="getStability({{$i}});" class="form-control" id="grade_id{{$i}}">
                                                <option value="">গ্রেড</option>
                                                @foreach($grades as $id => $value)
                                                    <option 
                                                        {{ $value->grade_id == $selected_artist[$key]['grade_id'][$j] ? 'selected': '' }} 
                                                        value="{{$value->grade_id}}">
                                                        {{$value->grade_title}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            @php 
                                                $stability = [];
                                                foreach($get_rate_chart as $id => $value) {
                                                    if ($value->description == $selected_artist[$key]['description_id'][$j] && 
                                                            $selected_artist[$key]['grade_id'][$j] == $value->grade_id) 
                                                    {
                                                        if(!isset($stability[$value->stability])) {
                                                            $stability[$value->stability] = $value;
                                                        }
                                                    }
                                                }
                                            @endphp

                                            
                                            <select name="program_description[{{$key}}][recording_stability][]" onchange="getAmount({{$i}});" class="form-control" id="recording_stabilty{{$i}}">
                                                <option value="">স্থিতি</option>
                                                @foreach($stability as $id => $value)

                                                   
                                                        <option
                                                            {{ $value->stability == $selected_artist[$key]['stability'][$j] ? 'selected': '' }}
                                                            value="{{$value->stability}}">
                                                            {{$value->stability}}
                                                        </option>
                                                    

                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            @php
                                            $totalCost+= (int) $selected_artist[$key]['amount'][$j];
                                            @endphp
                                            <input type="text" onChange="getTotalAmount()" name="program_description[{{$key}}][amount][]" value="{{ $selected_artist[$key]['amount'][$j] }}" id="amount{{$i}}" placeholder="টাকার পরিমান" class="form-control"/>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                    }
                                    $j++;
                                    }
                                }

                                }
                                ?>

                                <tr>
                                    <td colspan="4"></td>
                                    <td><b>Total Cost</b></td>
                                    <td><input type="text" readonly class="form-control" id="totalCost" value="<?php echo $totalCost; ?>"/></td>
                                </tr>

                            </table>
                            <input type="hidden" id="totalartist" value="<?php echo $i-1; ?>"/>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="form_output"></span>
                    </div>
                    <div class=" col-sm-5">
                        
                        <button type="button" onclick="updateProgramCostSavedInfoSubmit()" id="updateBtn" class="btn
                        btn-success"><i
                                    class="glyphicon glyphicon-save"></i> Update
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" value="{{$setting_id}}" name="setting_id" id="setting_id">
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