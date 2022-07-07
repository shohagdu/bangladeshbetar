@extends("master_program")
@section('title_area')
    :: কিউসিট রিপোট ::
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
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> কিউসিট রিপোট</h2>
                <button onclick="back()"  class="btn btn-danger
                btn-xs no-print" style="float:right; margin-top:5px;margin-right:5px;
"><i class="glyphicon glyphicon-backward"></i> Back
                </button>
                <a href=" <?php  echo asset('/odivision_program_queue_sheet_view_data/'.$plan_info->id);?>" class="btn
                btn-info
                btn-xs no-print" style="float:right; margin-top:5px;margin-right:5px;
"><i class="glyphicon glyphicon-share-alt"></i> View
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post','id' =>
                        'update_odivision_presentation_info_form',
                        'class'=>'form-horizontal']) !!}
                        <table class="table table-bordered print_table" style="width: 100%;">
                            <tr>
                                <th class="width20per">তারিখ</th>
                                <td class="width30per"> {{ (!empty($plan_info->date))? date('d-m-Y',strtotime
                                ($plan_info->date)
                                ):''
                                  }}
                                </td>
                                <th class="width20per">বার</th>
                                <td class="width30per"> {{ (!empty($plan_info->title_bn))? $plan_info->title_bn:''  }}</td>
                            </tr>

                            <tr>
                                <th>কেন্দ্র</th>
                                <td> {{ (!empty($plan_info->station_name))? $plan_info->station_name:''  }}</td>


                                <th>ফ্রিকোয়েন্সি</th>
                                <td> {{ (!empty($plan_info->fequencey_data))? $plan_info->fequencey_data:''  }}</td>

                            </tr>
                        </table>
                        @php
                            $schedule = (!empty($plan_info->content))? json_decode($plan_info->content):NULL;
                            $odivision_info=odivision_info_data();
                            $role_info=role_info_data();
                        @endphp
                        <table class="table table-bordered table-striped" style="width: 100%;">
                            <?php
                            if(!empty($presentation_info)){
                            foreach ($presentation_info as $role=>$odivision_wise_artist){
                            ?>
                            <tr style="background: #d0d0d0;">
                                <td colspan="2" style="font-weight: bold;" >{{ (!empty($role))?
                                    $role_info[$role]:NULL
                                    }}</td>
                            </tr>


                            <?php
                            if(!empty($odivision_wise_artist))   {
                            foreach ($odivision_wise_artist as $odivision_id=>$artist_info){
                            ?>
                            <tr>
                                <td style="width: 10%;">{{ (!empty($odivision_id))
                                                    ?$odivision_info[$odivision_id]:NULL  }}</td>
                                <td>

                                    <table    class="table table-bordered">
                                        <?php
                                        if(!empty($artist_info)){
                                            foreach ($artist_info as $key=>$artist){
                                        ?>
                                            <tr>
                                                <td class="width20per">
                                                    <?php
                                                         echo $artist['name'];
                                                    ?>
                                                    <input type="hidden" name="artist_id[]" value="{{ !empty
                                                    ($artist['artist_id'])?$artist['artist_id']:NULL  }}">
                                                    <input type="hidden" name="artist_role[{{ !empty
                                                    ($artist['artist_id'])?$artist['artist_id']:NULL  }}]" value="{{ !empty
                                                    ($role)?$role:NULL  }}">
                                                    <input type="hidden" name="odivison_id[{{ !empty
                                                    ($artist['artist_id'])?$artist['artist_id']:NULL  }}]" value="{{ !empty
                                                    ($odivision_id)?$odivision_id:NULL  }}">



                                                </td>
                                                <td class="width5per">
                                                    <input type="checkbox" {{ ((!empty
                                                ($artist['is_present'])  && $artist['is_present']==1)?"checked":NULL)
                                                 }}  name="presentation_artist_present[{{ $artist['artist_id']
                                                 }}]"  id="presentation_artist_present_{{ $artist['artist_id'] }}">
                                                    {{ ((!empty($artist['is_present'])  && $artist['is_present']==1)?"উপস্থিত":NULL)
                                                 }}
                                                </td>
                                                <td class="width10per">
                                                    <select name="log_type[{{ $artist['artist_id'] }}]" id="log_type" class="form-control">
                                                        <option value="">চিহ্নিত করুন</option>
                                                        <option value="1" {{ (!empty($artist['log_type']) && $artist['log_type']==1)
                                                     ?"selected":''  }}>জোড়</option>
                                                        <option value="2" {{ (!empty($artist['log_type']) &&
                                                        $artist['log_type']==2)
                                                     ?"selected":''  }}>বিজোড়</option>
                                                    </select>
                                                </td>
                                                <td class="width10per">
                                                    <input type="text" value="{{ ((!empty ($artist['log_book_no']) )
                                                    ?$artist['log_book_no']:NULL) }}"  placeholder="লগ বহি নং" name="log_book_no[{{ $artist['artist_id'] }}]"
                                                           id="log_book_no" class="form-control">

                                                </td>

                                                <td class="width20per">
                                                    <textarea rows="1" placeholder="মন্তব্য"  class="form-control"
                                                                name="presentation_artist_comments[{{ $artist['artist_id'] }}]"
                                                              id="presentation_artist_comments_{{ $artist['artist_id'] }}">{{ ((!empty
                                                ($artist['presentation_comments']) )
                                                ?$artist['presentation_comments']:NULL)
                                                 }}</textarea>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                    </table>

                                </td>
                            </tr>
                            <?php
                            }
                            }
                            ?>

                            <?php
                            }
                            }
                            ?>
                                <tfoot>
                                <tr>
                                    <td colspan="2" style="text-align: right">
                                        <button type="button" onclick="update_odivision_info_presentaion_form()"
                                                class="btn btn-success
                                        btn-lg
                                        "><span
                                                    class="glyphicon glyphicon-off"></span> Update Now Presentation
                                        </button>
                                        <input type="hidden" name="presentation_date" id="presentation_date" value="{{
                                        $plan_info->date
                                        }}">
                                    </td>
                                </tr>
                                </tfoot>
                        </table>
                        {!! Form::close() !!}



                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'update_odivision_info_form',
                        'class'=>'form-horizontal']) !!}
                        <table class="table-bordered table print_table">

                            <thead>
                            <tr>
                                <th class="width8per">সময়</th>
                                <th class="width15per">চাংক</th>
                                <th>অনুষ্ঠানের নাম/ বিবরন</th>
                                <th class="width10per">স্থিতি</th>

                                <th style="width:90px;">রেকর্ড</th>
                                <th style="width:80px;">বিচ্যুতি</th>
                                <th style="width:100px;">ত্রুটি</th>
                                <th class="width15per">মন্তব্য</th>
                            </tr>
                            <!-- <tr>
                            <th>সময়</th>
                            <th colspan="2">অনুষ্ঠানের টাইটেল</th>
                            </tr> -->
                            </thead>

                            <tbody>
                            @foreach($schedule as  $parentKey => $value)
                                <tr>
                                    <td style="width:150px;">
                                        {{(!empty($value->time))?eng2bnNumber($value->time):''}}
                                        <input type="hidden" name="time[]" value="{{(!empty($value->time))?
                                        $value->time:''}}" >
                                    </td>
                                    <td>
                                        <?php echo $value->chank; ?>
                                    </td>
                                    <td colspan="1">
                                        @php
                                            $program_info= get_schedule($plan_info->station_id,
                                            $plan_info->sub_station_id,
                                             $plan_info->date,$value->time);
                                        @endphp
                                        @if($value->is_overwrite==true)
                                            {{ $value->overwrite_details}}
                                        @else
                                            @if(!empty($program_info))
                                                <a data-toggle="modal"
                                                   data-target="#exampleModal3"
                                                   onclick="programMagazineView('{{ $program_info->id }}')" href="#"> {{
                                           $program_info->program_name
                                           }}</a>
                                            @else
                                                {{ $value->biboron }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <?php echo (!empty($value->stability)) ? eng2bnNumber($value->stability) . " মিনিট" : ''; ?>
                                    </td>


                                    <td>
                                        <select name="odivision_record_type[]" class="form-control">
                                            <option value="1" {{ (!empty($value->odivision_record_type) &&
                                            $value->odivision_record_type==1)
                                                     ?"selected":''  }}>হ্যাঁ</option>
                                            <option value="2" {{ (!empty($value->odivision_record_type) && $value->odivision_record_type==2)
                                                     ?"selected":''  }}>না</option>
                                        </select>
                                    </td>
                                    <td>

                                        <input type="checkbox" {{ ((!empty($value->bicuti_reason))?"checked":'')
                                            }}
                                        onclick="odivision_bicuti_info('{{
                                            $value->time
                                            }}','{{ $plan_info->id  }}','{{ $plan_info->station_name  }}','{{
                                            $plan_info->fequencey_data  }}','{{ (!empty($plan_info->date))? date
                                            ('d-m-Y',strtotime
                                            ($plan_info->date)):''  }}')"
                                               name="odivision_bicuti_add"
                                               id="odivision_bicuti_add">
                                        @if(!empty($value->bicuti_reason))
                                            <button type="button" class="btn btn-primary btn-xs"
                                                    onclick="odivision_bicuti_info
                                                            ('{{
                                            $value->time
                                            }}','{{ $plan_info->id  }}','{{ $plan_info->station_name  }}','{{
                                            $plan_info->fequencey_data  }}','{{ (!empty($plan_info->date))? date
                                            ('d-m-Y',strtotime
                                            ($plan_info->date)):''  }}','{{ json_encode($value->bicuti_reason) }}')
                                                            ">Show
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <select name="truti_info[]" class="form-control">
                                            <option value="1" {{ (!empty($value->truti_info) && $value->truti_info==1)
                                                     ?"selected":''  }} >সঠিক</option>
                                            <option value="2"  {{ (!empty($value->truti_info) && $value->truti_info==2)
                                                     ?"selected":''  }}>ত্রুটি</option>
                                        </select>
                                    </td>
                                    <td>
                                           <textarea name="comments[]" placeholder="মন্তব্য লিখুন" rows="1"
                                                     class="form-control">{{ (!empty($value->comments))
                                                     ?$value->comments:''  }}</textarea>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="4">
                                        <button type="button" onclick="update_odivision_info_form()" class="btn btn-success
                                        btn-lg
                                        btn-block"><span
                                                    class="glyphicon glyphicon-off"></span> Update Program
                                        </button>
                                        <input type="hidden" name="schedule_id" id="schedule_id" value="{{  $plan_info->id
                                        }}">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="container">

        <!-- Modal -->
        <div class="modal fade" id="odivision_info_add" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:10px 20px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-lock"></span> বিচ্যুতি তথ্য</h4>
                    </div>
                    {!! Form::open(['url' => '', 'method' => 'post','id' => 'save_protram_bicuti_info_form',
                        'class'=>'form-horizontal']) !!}
                    <div style="padding:20px 50px;">
                        <div class="form-group">
                            <label> কেন্দ্রের নাম</label>
                            <input type="text" class="form-control" readonly id="bicuti_station" name="bicuti_station"
                                   placeholder=" কেন্দ্রের নাম">
                        </div>
                        <div class="form-group">
                            <label> ফ্রিকোয়েন্সি</label>
                            <input type="text" class="form-control" readonly id="bicuti_fequencey"
                                   name="bicuti_fequencey"
                                   placeholder="ফ্রিকোয়েন্সি">
                        </div>
                        <div class="form-group">
                            <label> তারিখ</label>
                            <input type="text" class="form-control" readonly id="bicuti_date" name="bicuti_date"
                                   placeholder="তারিখ">
                        </div>
                        <div class="form-group">
                            <label> বিচ্যুতি কারন</label>
                            <textarea class="form-control" id="bicuti_reason" name="bicuti_reason"
                                      placeholder="বিচ্যুতি কারন"></textarea>
                        </div>
                        <div class="form-group">
                            <label> সময়</label>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control timepicker" id="bicuti_time_start"
                                           name="bicuti_time_start"
                                           placeholder="থেকে">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control timepicker" name="bicuti_time_end"
                                           id="bicuti_time_end"
                                           placeholder="পর্যন্ত">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label> স্থিতি</label>
                            <input type="text" class="form-control" name="bicuti_stability" id="bicuti_stability"
                                   placeholder="স্থিতি">
                        </div>
                        <div class="form-group">
                            <label> মন্তব্য</label>
                            <textarea class="form-control" name="bicuti_comments" id="bicuti_comments"
                                      placeholder="মন্তব্য"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button type="button" onclick="save_bicuti_info()" class="btn btn-success pull-left
"><span class="glyphicon glyphicon-off"></span> <span id="show_btn_title"></span></button>


                            <button type="button" class="btn btn-danger btn-default
                            pull-left"
                                    style="margin-left:20px;"
                                    data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel
                            </button>
                            <input type="hidden" id="bicuti_id" name="bicuti_id">
                            <input type="hidden" id="bicuti_time" name="bicuti_time">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection

