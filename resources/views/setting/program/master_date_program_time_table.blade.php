@extends("master_program")
@section('title_area')
    ::নতুন  কিউসিট ::
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
                <h2>নতুন  কিউসিট </h2>
                <a href="<?php  echo asset('/master_date_program_time_table_create');?>">
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
                                <th>তারিখ</th>
                                <th>বার</th>
                                <th>কেন্দ্রের  নাম</th>
                                <th>
                                    ফ্রিকোয়েন্সি</th>
                                
{{--                                <th>অনুরুপ ফ্রিকোয়েন্সি--}}
{{--                                </th>--}}
                                <th style="width: 130px">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            ?>
                            @if(!empty($broadcast_info))
                                @foreach($broadcast_info as $info)
                                    @php 
                                        $sub_station = get_branch($info->sub_station_id);
                                    @endphp
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td>  {{ $info->date  }}</td>
                                        <td>  {{ $info->title_bn  }}</td>
                                        <td>  {{ $info->station_name  }}</td>
                                        <td>  {{ $info->fequencey_data  }}</td>
                                        <td>
                                            <!--- update operation working on next time --->
                                            <a href="<?php  echo asset("/master_date_program_time_table_update/"
                                                .$info->id);?>" class="btn btn-primary btn-xs">
                                                    <i class="glyphicon glyphicon-pencil"></i> Edit
                                            </a>


                                            <a title="View" href="<?php  echo asset("/view_quesheet_info/"
                                                .$info->id);?>" class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-share-alt"></i> View
                                            </a>

                                            <div class="col-sm-12"  style="margin-top:2px;" ></div>
                                            <button type="button" onclick="programScheduleApproved({{ $info->id }});"
                                                    title="Approved"  class="btn btn-success btn-xs">
                                                <i class="glyphicon glyphicon-ok"></i> Approved
                                            </button>
                                            <button type="button" onclick="deletedateSchedule({{ $info->id }});" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-trash"></i> Delete
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
@endsection

