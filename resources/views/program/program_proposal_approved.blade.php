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
                <a href="{{ url('contract_khata') }}" class="btn btn-info btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    চুক্তিপত্র  খাতা
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

                                <th style="width: 150px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            @if(!empty($get_program_planning_info))
                                @foreach($get_program_planning_info as $singleData)
                                    <tr>
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
                                            <a href="{{ url('program_magazine_cost_view/'.$singleData->id)
                                             }}" title="View" class="btn btn-success btn-xs" style="margin-top:3px;">
                                                <i class="glyphicon glyphicon-eye-open"></i> View
                                            </a>
                                            <a href="" title="View" class="btn btn-info btn-xs" style="margin-top:3px;">
                                                <i class="glyphicon glyphicon-print"></i> Contract
                                            </a>



                                            {{--                                            <a href="{{ url('program_magazine_update_form_new/'.$singleData->id)--}}
                                            {{--                                             }}" title="Edit" class="btn btn-info btn-xs" style="margin-top:3px;">--}}
                                            {{--                                                <i class="glyphicon glyphicon-pencil"></i> Edit--}}
                                            {{--                                            </a>--}}




{{--                                            <button title="Edit" type="button" data-toggle="modal"--}}
{{--                                                    data-target="#exampleModal4"--}}
{{--                                                    class="btn btn-info btn-xs"--}}
{{--                                                    onclick="checkBroadcastInfo('{{$singleData->id}}','{{$singleData->is_recorded}}','{{$singleData->record_complete_date}}','{{$singleData->is_broadcast}}','{{$singleData->brodcast_complete_date}}');"--}}
{{--                                                    class="btn btn-info btn-xs">--}}
{{--                                                <i class="glyphicon glyphicon-record"></i>--}}
{{--                                            </button>--}}
                                            <button title="Move to Proposal" type="button" onclick="planningAgain('{{
                                    $singleData->id }}','2')" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-backward"></i> Proposal
                                            </button>


                                            <button title="Studio Booking / Gate Pass / Recording" type="button"
                                                    onclick="approvedProposalInfo('{{ $singleData->id }}','4')"
                                                    class="btn btn-primary btn-xs " style="margin-top:3px">
                                                Approved <i class="glyphicon glyphicon-forward"></i>
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
    <!-- Modal -->

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel1">আপডেট অনুষ্ঠানের তথ্য
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '', 'method' => 'post','id' => 'update_program_planning_form',
                'class'=>'form-horizontal']) !!}
                <div id="magazine_update">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
    </div>


    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel2"> অনুষ্ঠানের খরচ প্রদান
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '', 'method' => 'post','id' => 'update_program_planning_cost',
                'class'=>'form-horizontal']) !!}
                <div id="magazine_cost">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel3"> অনুষ্ঠানের খরচ প্রদান
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <div class="modal-body">
                    <div id="magazine_view">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:40%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel4"> সম্প্রচার ও রেকডিং তথ্য
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>

                <div class="modal-body">
                    <form action="" method="post" id="broadcast_form">

                        <div class="checkbox">
                            <label><input type="checkbox" id="is_recorded" name="is_recorded" onclick="is_recorded_check(this);"> রেকর্ড সম্পন্ন হয়েছে ?</label>
                            <input type="text" class="form-control datepickerLong" placeholder="রেকর্ড তারিখ" name="record_complete_date" id="record_complete_date"/>
                        </div>
                        <br/>
                        <div class="checkbox">
                            <label><input type="checkbox" id="is_broadcast" name="is_broadcast" onclick="is_broadcast_check(this);"> সম্প্রচার সম্পন্ন হয়েছে ?</label>
                            <input type="text" class="form-control datepickerLong" placeholder="সম্প্রচার তারিখ" name="broadcast_complete_date" id="broadcast_complete_date"/>
                        </div>
                        <br/>

                        <div class="modal-footer">
                            <div class=" col-sm-7 text-left">
                                <span class="text-left" id="form_output"></span>
                            </div>
                            <div class=" col-sm-5">

                                <button type="button" id="broadcastbtn" class="btn
                                btn-success" onclick="saveBroadcastInfo();"><i
                                            class="glyphicon glyphicon-save"></i> Save
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="glyphicon glyphicon-remove"></i> Close
                                </button>
                                <input type="hidden" value="" name="programid" id="programid">
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>



@endsection

