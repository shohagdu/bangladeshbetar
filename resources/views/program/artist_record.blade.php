@extends("master_program")
@section('title_area')
    :: শিল্পীর তথ্য সমূহ  ::

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
    <article class="col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 20px;">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> শিল্পীর তথ্য সমূহ</h2>
                <a href="{{ url('artist_record_add') }}"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12" style="margin-top: 10px;">
                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'show_artist_info_form',
                      'class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="col-md-2">
                                <label class="control-label">তালিকাভুক্ত কেন্দ্রে নাম</label>
                                <div class="clearfix"></div>
                                <select id="station_id" tabindex="3" class="form-control" name="station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">শিল্পীর দক্ষতা</label>
                                <div class="clearfix"></div>
                                <select  name="expertise" id="expertise_1" class="form-control artist_expertise">
                                    <option value=""> চিহ্নিত করুন</option>
                                    @if(!empty($artist_exp_type))
                                        @foreach ($artist_exp_type as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">দক্ষতার বিভাগ</label>
                                <div class="clearfix"></div>
                                <select id="expertise_dept_1" class="form-control" name="expertise_dept">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>
                             </div>
                             <div class="col-md-1">
                                <label class="control-label">শ্রেণী</label>
                                <div class="clearfix"></div>
                                    <select  name="expertise_grade" class="form-control"
                                          id="expertise_grade">
                                        <option value="">শ্রেণী</option>
                                         @if(!empty($artist_grade_info))
                                            @foreach ($artist_grade_info as $key =>$value)  <option   value="{{ $key }}">{{ $value }}</option>
                                         @endforeach
                                     @endif
                                 </select>
                             </div>

                            <div class="col-md-1">
                                <label class="control-label">স্ট্যাটাস</label>
                                <div class="clearfix"></div>
                                <select name="artist_status" id="artist_status" class="form-control">
                                    <option value="">স্ট্যাটাস</option>
                                    <option value="1">Active</option>
                                    <option value="2">In-Active</option>
                                </select>
                             </div>
                            <div class="col-md-3">
                                 <label class="control-label">শিল্পীর নাম/মোবাইল নং</label>
                                <div class="clearfix"></div>
                                <input type="text" name="artist_info_search_data"  onkeypress="autocompleteArtistInfo(this)" placeholder="শিল্পীর নাম/মোবাইল নং"
                                       id="artist_info_search_data"
                                       class="form-control">
                                <input type="hidden"  name="artist_info_search_data_id"
                                       id="artist_info_search_data_id"   class="form-control">

                            </div>
                            <div class="col-md-1">

                                <div style="margin-top:22px;">
                                    <button type="button"
                                             name="search_artist_btn" onclick="searching_artist_info()"
                                            id="search_artist_btn"  class="btn btn-success
                                    btn-sm"><i
                                                class="glyphicon glyphicon-search"></i> Search</button>
                                </div>
                            </div>
                         </div>
                        {!! Form::close() !!}
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <div class="clearfix"></div>
                        <div class="mydivAjaxImage">
                            <img src="{{ url('fontView\assets\img\ajax-loader.gif') }}" class="ajax-loader" />
                        </div>
                        <div class="clearfix"></div>

                        <div id="show_artist_info">
                            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                <tr>
                                    <th style="width:5%;">SL</th>
                                    <th > ছবি</th>
                                    <th style="width:15%"> শিল্পীর নাম</th>
                                    <th style="width:15%"> ঠিকানা</th>
{{--                                    <th>লিঙ্গ</th>--}}

                                    <th> মোবাইল</th>
                                   <!-- <th> সম্মানীর ক্যাটাগরি</th>-->
                                    <th> দক্ষতা</th>
                                    <th> কর্মক্ষেত্র</th>
                                    <th> status</th>
                                    <th style="width: 100px"> #</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $i = 1;
                                ?>
                                @if(!empty($program_artist_info))
                                    @foreach($program_artist_info as $singleData)
                                        <tr>
                                            <td>  {{ $i++  }}</td>
                                            <td><img src="{{ (file_exists("fontView/assets/artist_image/"
                                            .$singleData->picture))? (!empty
                                            ($singleData->picture)?url
                                            ("fontView/assets/artist_image/"
                                            .$singleData->picture):url
                                            ("images\default\default-avatar.png")):url
                                            ("images\default\default-avatar.png")  }}" style="height:60px;width:60px;">
                                            </td>
                                            <td>  {{ $singleData->name_bn  }}</td>
                                            <td>  {{ $singleData->address  }}</td>

{{--                                            <td> {{ ((!empty($singleData->gender) &&--}}
{{--                                            $singleData->gender==1)?"পুরুষ":--}}
{{--                                            ((!empty($singleData->gender) && $singleData->gender==2)?"মহিলা":"অন্যান্য"))--}}
{{--                                            }}</td>--}}
                                            <td>
                                                <?php
                                                    if(!empty($singleData->mobile)){
                                                        $mobile = json_decode($singleData->mobile,true);
                                                        echo $mobile[0];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $expertise_info = json_decode($singleData->artist_expertise_info,
                                                    true);
                                              //  echo "<pre>";
                                             //print_r($expertise_info);
                                            // print_r($artist_exp_type);
                                           //  print_r($artist_exp_type_department);
    //                                            artist_exp_type_department
                                               // $expertise_info='';
                                                if(!empty($expertise_info)){
                                                    $expertise_info_data='';
                                                    foreach ($expertise_info as $expertise){
                                                        $expertise_info=(!empty($expertise['expertise']) && !empty
                                                        ($artist_exp_type[$expertise['expertise']]))
                                                            ?$artist_exp_type[$expertise['expertise']]:'';
                                                        $artist_exp_type_department_info=(!empty
                                                        ($expertise['expertise_dept']) && !empty($artist_exp_type_department[$expertise['expertise_dept']]) )
                                                            ?"("
                                                            .$artist_exp_type_department[$expertise['expertise_dept']]:'';
                                                        $expertise_grade_info_data=  !empty($expertise['expertise_grade'])
                                                            ?"-".$artist_grade_info[$expertise['expertise_grade']].")":'';
                                                        $expertise_info_data.=
                                                            "<b>".$expertise_info."</b>"
                                                            .$artist_exp_type_department_info.$expertise_grade_info_data
                                                            ." ,";
                                                    }
                                                    if(!empty($expertise_info_data)){
                                                        echo rtrim($expertise_info_data,",");
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if(!empty($singleData->work_area_id)){
                                                        $re_from = array("[", "]",'"');
                                                        $re_to = array("", "", "");
                                                        $work_area_id_a= str_replace($re_from, $re_to,
                                                            $singleData->work_area_id);
                                                        $arr=explode(",",$work_area_id_a);
                                                        if(!empty($arr)){
                                                            $work_data_unique=[];
                                                            foreach ($arr as $work_area_ar){
                                                                if(!empty($work_area_info_data[$work_area_ar])){
                                                                    $work_data_unique[]=$work_area_info_data[$work_area_ar];
                                                                }
                                                            }
                                                            $unique_work_area=array_unique($work_data_unique);
                                                            echo implode(", ",$unique_work_area);
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td class="{{ ($singleData->is_active==1)?"Active":"Inactive"  }}">  {{ ($singleData->is_active==1)?"Active":"Inactive"  }}</td>
                                            <td>
                                                <a href="{{ url('artist_record_attachment/'.$singleData->id ) }}"
                                                   class="btn btn-info btn-xs">
                                                    <i class="glyphicon glyphicon-link"></i>
                                                    প্রমানক যুক্ত
                                                </a>
                                                <div class="col-sm-12" style="height: 5px;"></div>
                                                <a href="{{ url('artist_record_update/'.$singleData->id ) }}"
                                                   class="btn btn-info btn-xs" target="_blank">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    Edit
                                                </a>

                                                <a href="{{ url('artist_record_view/'.$singleData->id ) }}"
                                                   class="btn btn-primary btn-xs">
                                                    <i class="glyphicon glyphicon-share-alt"></i>
                                                    View
                                                </a>


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
        </div>
    </article>
@endsection

