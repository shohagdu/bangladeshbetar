@extends("master_program")
@section('title_area')
    :: {{ $page_title }}  ::
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
                <a href="{{ url('proposal_khata') }}" class="btn btn-info btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    প্রস্তাব  খাতা
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
                                <th> কেন্দ্র </th>
                                <th> আইডি</th>
                                <th> নাম</th>
                                <th> ধরন</th>
                                <th>রেকডিং সময়</th>
                                <th>রেকডিং তারিখ</th>
                                <th>প্রযোজক</th>
                                <th style="width: 100px">প্রস্তাব পাশকারী</th>

                                <th style="width: 140px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            @if(!empty($get_program_planning_info))
                                @foreach($get_program_planning_info as $singleData)
                                    <?php
                                        $program_organizer= !empty($singleData->program_organizer) ?json_decode
                                        ($singleData->program_organizer,true):'';
                                    $replanning_info= !empty($singleData->reproposal_info) ?json_decode($singleData->reproposal_info,true):'';
                                    ?>
                                    <tr style="background: <?php echo ((!empty($replanning_info['is_replanning']) &&
                                        $replanning_info['is_replanning']==1)?"#fce4d6":"") ?> ">
                                        <td> {{ $i++  }}</td>
                                        <td> {{ $singleData->station_name  }}</td>
                                        <td> {{ $singleData->program_identity  }}</td>
                                        <td> {{ $singleData->program_name  }}</td>
                                        <td> {{ $singleData->program_type_title  }}</td>
                                        <td>
                                            {{ $singleData->recorded_time  }}


                                        </td>
                                        <td>
                                            <?php
                                            $record_dt= !empty($singleData->recorded_date) ?json_decode
                                            ($singleData->recorded_date,true):'';
                                            if(!empty($record_dt)){
                                                echo implode(",",$record_dt);
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                             $program_organizer_data=(!empty($program_organizer[1]))
                                                ?$program_organizer[1]:NULL;
                                            if(!empty($program_organizer_data)){
                                                $director='';
                                                foreach ($program_organizer_data as $info){
                                                    $name=!empty($employee_info[$info])? $employee_info[$info]:'';
                                                    $director.=  $name .",";
                                                }
                                                echo rtrim($director,",");
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            {{ (!empty($singleData->plan_approved_by))?
                                            $employee_info[$singleData->plan_approved_by] :'' }}
                                            <br/>
                                            {{ (!empty($singleData->plan_approved_dt))?date
                                            ('d-m-Y',strtotime($singleData->plan_approved_dt)):''  }}
                                        </td>
                                        <td>
                                            <a href="{{ url('program_magazine_cost_view/'.$singleData->id)
                                             }}" title="View" class="btn btn-success btn-xs "
                                               >
                                                <i class="glyphicon glyphicon-eye-open"></i> View
                                            </a>
                                            <button title="Move to Planning" type="button" onclick="planningAgain('{{
                                    $singleData->id }}','1')" class="btn btn-danger btn-xs" style="margin-top:3px;">
                                                <i class="glyphicon glyphicon-backward"></i> Planning
                                            </button>
                                            <button title="Approved" type="button"
                                                    onclick="approvedProposalInfo('{{ $singleData->id }}','3')"
                                                    class="btn btn-primary btn-xs" style="margin-top:3px;">
                                                 Contract <i class="glyphicon glyphicon-forward"></i>
                                            </button>

{{--                                            <a href="{{ url('program_magazine_update_form_new/'.$singleData->id)--}}
{{--                                             }}" title="Edit" class="btn btn-info btn-xs" style="margin-top:3px;">--}}
{{--                                                <i class="glyphicon glyphicon-pencil"></i> Edit--}}
{{--                                            </a>--}}




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
   




@endsection

