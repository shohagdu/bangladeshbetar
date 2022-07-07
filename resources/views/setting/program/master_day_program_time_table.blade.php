@extends("master_program")
@section('title_area')
    :: সময়সূচী সেটিংস  ::
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
                <h2> অনুষ্ঠান সূচি সেটিংস</h2>
                <!-- <button type="button"data-toggle="modal" onclick="entryWindow();" data-target="#exampleModal" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Add New
                </button> -->
                <a href="master_day_program_time_table_create">
                    <button type="button" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                        Add New
                    </button>
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th>কেন্দ্রের  নাম</th>
                                <th>ফ্রিকুযেন্সী</th>
                                <th>অনুষ্ঠানের ধরন</th>
                                <th style="width: 20%">পরিবর্তন</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            ?>
                            @if(!empty($schedule_info))
                                @foreach($schedule_info as $schedule)
                                    @php 
                                        $sub_station = get_branch($schedule->sub_station_id);
                                    @endphp
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td>  {{ $schedule->name  }}</td>
                                        <td>  @php echo $sub_station->title.' ('.$sub_station->fequencey @endphp )</td>
                                        
                                        <td>  {{ $schedule->type==1?'প্রোগ্রাম':''  }}</td>
                                        <td>
                                            <!--- update operation working on next time --->
                                            <a href="master_day_program_time_table_view/<?php echo $schedule->id; ?>">
                                                <button type="button"  class="btn btn-primary btn-xs">
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </button>
                                            </a>
                                            <a href="master_day_program_time_table_update/<?php echo $schedule->id; ?>">
                                            <button type="button" class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                            </a>
                                            
                                            <button type="button" onclick="deletedaySchedule({{$schedule->id}});" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>

    <!---------------------Schedule form  Modal start --------------------------->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width: 70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span>  </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
                    $odivision_form_array = [];
                    $dynamic_odivision_array = [];
                    foreach($get_odivision_info as $value) {
                        $odivision_form_array[$value->id] = [
                           ['time'=>'','title'=>'','comment'=>'','is_recorded'=>false]
                        ];
                        $dynamic_odivision_array[$value->id] = [];
                    }
                ?>
                {!! Form::open(['url' => '', 'id' => 'program_time_table_setup_form','method' => 'post','class'=>'form-horizontal']) !!}
                
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;margin-bottom:80px;">
                        <div class="form-group">
                            <label class="col-md-2 control-label">কেন্দ্রের নাম </label>
                            <div class="col-md-4">
                                <select id="station_id" required class="form-control" onchange="getSubStation(this.value)" name="station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <label class="col-md-2 control-label">সাব-কেন্দ্রের নাম </label>
                            <div class="col-md-4">
                                <select id="sub_station_id"  required class="form-control" name="sub_station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                        <label class="col-md-2 control-label">বার </label>
                            <div class="col-md-4">
                                <select required name="day_name" id="day_name" class="form-control">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($day_name))
                                        @foreach ($day_name as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <textarea style="visibility: hidden;" name="odivision" id="odivision"><?php echo json_encode($odivision_form_array,true); ?></textarea>
                                <textarea style="visibility: hidden;" name="schedule" id="schedule"></textarea>
                                <textarea style="visibility: hidden;" name="dynamic_odivision_array" id="dynamic_odivision_array"><?php echo json_encode($dynamic_odivision_array,true); ?></textarea>
                            </div>
                        </div>



                        @foreach($get_odivision_info as $odivision)

                            <table class="table-bordered table">

                               <thead>

                                    <tr>
                                        <th colspan="6">
                                            {{ $odivision->title.' ('.$odivision->schedule_time.')' }}
                                        </th>
                                    </tr>

                                    <tr>
                                       <td>সময়</td>
                                       <td>চাংক</td>
                                       <td>অনুষ্ঠানের বিবরন</td>
                                       <td>মন্তব্য</td>
                                       <td>রেকর্ড/সজিব</td>
                                       <td>#</td>
                                    </tr>
                               </thead>

                               <tbody id="dynamicJobHistorytr_{{ $odivision->id }}">
                                    
                               </tbody>

                               <tfoot>
                                    <tr>
                                        <td colspan="6">
                                        <button type="button" onclick="addRow({{ $odivision->id }})" class="btn btn-primary btn-sm program_time"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        </td>
                                    </tr>
                               </tfoot>

                            </table>
                            

                        @endforeach

                    </div>

                    <div class="clearfix"></div>

                </div>

                <div class="modal-footer">

                    <div class="col-sm-6 text-left">
                        <div id="form_output"></div>
                    </div>

                    <div class="col-sm-6">
                        <button type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                        <button type="submit" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                        <input type="hidden" name="schedule_id" id="schedule_id">
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!---------------------Schedule form  Modal end --------------------------->





    <!----------------------Schedule view form start------------------------------>
    <div class="modal fade" id="scheduleReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width: 70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                        <h5 class="modal-title"><span>অনুষ্ঠান সূচি</span>  </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="modal-body" id="showScheduleReport">
                    <!----- schedule report loaded here ---->
                </div>

                <div class="modal-footer">

                    <div class="col-sm-6">
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!----------------------Schedule view report end--------------------------------->


@endsection

