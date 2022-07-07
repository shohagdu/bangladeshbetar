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
                                <th>প্রস্তাব পাশকারী</th>

                                <th style="width: 160px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
//                            echo "<pre>";
//                            print_r($get_program_planning_info);
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
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="{{ url('program_magazine_cost_view/'.$singleData->id)
                                                 }}" title="View" class="btn btn-success btn-xs  "
                                            >
                                                <i class="glyphicon glyphicon-eye-open"></i> View
                                            </a>
                                            @if(!empty($singleData->studio_infos))
                                                <a  href="{{ url('studio_information_view/'.$singleData->id)
                                                 }}"
                                                    title="Studio Information"
                                                    class="btn btn-primary btn-xs" style="margin-top:3px;">
                                                    <i class="glyphicon glyphicon-film"></i>  Studio Info.
                                                </a>
                                            @else
                                                <a  href="{{ url('studio_information_form/'.$singleData->id)
                                                 }}"
                                                    title="Studio Information"
                                                    class="btn btn-info btn-xs" style="margin-top:3px;">
                                                    <i class="glyphicon glyphicon-film"></i> Add Studio Info.
                                                </a>
                                            @endif




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

