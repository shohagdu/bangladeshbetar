@extends("master_program")
@section('title_area')
    :: Add ::  Magazine  ::
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
                                <th> কেন্দ্র</th>
                                <th>দপ্তরের নাম</th>
                                <th> অনুষ্ঠানের নাম</th>
                                <th> ধরন</th>
                                <th> প্রকৃতি</th>
                                <th>রেকডিং সময়</th>
                                <th>রেকডিং তারিখ</th>
                                <th> সম্প্রচার তারিখ</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            @if(!empty($get_program_planning_info))
                                @foreach($get_program_planning_info as $singleData)
                                    @php 
                                    $office = [
                                    1 => 'অনুষ্ঠান',
                                    2 => 'প্রকৌশল',
                                    3 => 'বার্তা',
                                    4 => 'প্রশাসন',
                                    ];
                                    @endphp
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td> {{ $singleData->station_name  }}</td>
                                        <td> {{ $office[$singleData->office_id] }} </td>
                                        <td>  {{ $singleData->program_name  }}</td>
                                        <td>  {{ $singleData->program_type_title  }}</td>
                                        <td>  {{ $singleData->program_style_title  }}</td>
                                        <td>  {{ $singleData->recorded_date  }}</td>
                                        <td>  {{ $singleData->recorded_time  }}</td>
                                        <td>  {{ $singleData->brodcast_complete_date  }}</td>
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

