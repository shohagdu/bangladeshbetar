@extends("master_program")
@section('title_area')
    :: সম্প্রচার সূচি সেটিংস  ::
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
                <h2> সম্প্রচার সূচি সেটিংস</h2>
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
                                            <option {{ $update_schedule->station_id==$key ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">সাব-কেন্দ্রের নাম </label>
                            <div class="col-md-4">
                                <select id="sub_station_id" required class="form-control" name="sub_station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    @foreach($sub_station_info as $value)
                                     <option {{ $value->id == $update_schedule->sub_station_id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title }} ( {{ $value->fequencey }} )</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">তারিখ </label>
                            <div class="col-md-4">
                                <input type="text" value="{{$update_schedule->date}}" required autocomplete="off" name="date" onchange="loadSchedule(station_id.value,this.value);" placeholder="dd-mm-yyyy" class="form-control datepickerinfo"/>
                            </div>
                            
                        </div>

                        <div id="loadSchedule">
                            
                            <input type="hidden" name="schedule_id" value="{{$update_schedule->id}}"/>

                            <textarea style="visibility:hidden;" id="schedule" name="schedule">@php echo json_encode($schedule,true) @endphp</textarea>
                            <h3>বারঃ {{$day_name}}</h3>
                            @foreach($schedule as  $parentKey => $info)

                                <table class="table-bordered table">

                                    <thead>

                                            <tr>
                                                <th colspan="6">
                                                    @php
                                                        $odivision_data =  get_odivision($parentKey);
                                                        echo $odivision_data->title.' ('.$odivision_data->schedule_time.')';
                                                    @endphp
                                                </th>
                                            </tr>

                                            <tr>
                                            <td>সময়</td>
                                            <td>অনুষ্ঠানের টাইটেল</td>
                                            <td>মন্তব্য</td>
                                            <td>রেকর্ড করা আছে</td>
                                            <td>ওভার রাইড</td>
                                            <td>#</td>
                                            </tr>
                                    </thead>
                                    
                                    <tbody>
                                            @php
                                            $i = 1;
                                            @endphp
                                            @foreach($info as $chieldKey => $value)
                                                <tr id="schedule_{{$parentKey.$chieldKey}}">
                                                    <td><input type='text' readonly  value="{{$value->time}}" placeholder='সময়' class='form-control'></td>
                                                    <td>
                                                        <input type='text' readonly style="display:{{ $value->is_overwrite==true ? 'none': 'block' }}" value="{{$value->title}}" id="title_{{$parentKey.$chieldKey}}"  placeholder='অনুষ্ঠানের টাইটেল' class='form-control'>
                                                        <input type="text" value="{{ $value->overwrite_details }}" placeholder='অনুষ্ঠানের ওভাররাইড টাইটেল' class='form-control' onkeyUp="modifySchedule( {{$parentKey}} , {{$chieldKey}}, this.value)" style="display:{{ $value->is_overwrite == true ? 'block': 'none' }}" name="overwrite_details" id="overwrite_details_{{$parentKey.$chieldKey}}"/>
                                                    </td>
                                                    <td><input type='text' readonly  value="{{$value->comment}}"  placeholder='মন্তব্য' class='form-control'></td>
                                                    <td> <span class='{{ $value->is_recorded==true? "glyphicon glyphicon-ok": "glyphicon glyphicon-remove" }}'></span></td>
                                                    <td><input type='checkbox' {{ $value->is_overwrite==true ? 'checked': '' }}  onclick="showOverwriteDetails({{$parentKey}} , {{$chieldKey}}, this );"/></td>
                                                    <td><button type='button' onclick="removeSchedule({{$parentKey}} , {{$chieldKey}})" class='btn btn-warning btn-flat btn-sm'><i class='glyphicon glyphicon-remove'></i> Drop</button></td>
                                                </tr>
                                            @php 
                                            $i++;
                                            @endphp
                                            @endforeach
                                    </tbody>

                                    <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                </td>
                                            </tr>
                                    </tfoot>

                                </table>

                            @endforeach
                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-4">
                                    <button style="margin-bottom:10px;margin-left:300px;" type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                                    </div>
                                </div>


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

