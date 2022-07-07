@extends("master_archive")
@section('title_area')
    :: Add New Song ::
@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
<style>
    .text-bold {
        font-weight:bold;
    }
</style>
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->

        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">

            <header>
                <button onclick="print_fun()"
                        class="btn btn-warning btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>
            </header>

            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="height: 10px;"></div>
                        <table class="print_table-no-border " style="width:100%;border: 1px solid #fff !important;">

                            <tr>
                                <td    style="text-align: center;width:40%;border: 1px solid #fff!important" >
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>
                                    <div style="font-size:14px;">  {{ !empty($station_info->name)?$station_info->name:'' }}</div>
                                    <div style="font-size:14px;">{{ !empty($station_info->address)?$station_info->address:''
                                    }}</div>
                                    <div class="clearfix"></div>
                                    <span style="font-weight: bold;font-size:14px;"> {{$page_title}} </span>
                                    <div class="clearfix"></div>

                                </td>
                            </tr>
                        </table>

                        <table style="width:100%;border:1px solid #d0d0d0" rules="all"  class="table table-bordered"
                               id="print_table">
                            <tr>
                                <th>কেন্দ্র</th>
                                <th>প্রথম লাইন</th>
                                <th>নাম</th>
                                <th>প্রকার</th>
                                <th>উপ প্রকার</th>
                                <th>শিল্পী</th>
                                <th>গীতিকার</th>
                                <th>সুরকার</th>
                                <th>রেটিং</th>
                                <th>টাইপ</th>
                                <th>স্থিতি</th>
                                <th>সোর্স</th>
                                <th>রেকডিং তারিখ</th>
                                <th>প্রথম সম্প্রচার তারিখ</th>
                                <th>অংশগ্রহন</th>
                            </tr>
                            <?php
                            if(!empty($archive_info)){
                            foreach($archive_info as $key => $value) {
                            $songit_info = json_decode($value->songit_info);
                            ?>
                            <tr>
                                <td>{{!empty($station_info->name)?$station_info->name:''}}</td>
                                <td>{{$songit_info->first_line}}</td>
                                <td>{{$songit_info->name}}</td>
                                <td>
                                    {{
                                        !empty($songit_info->category)?get_name_by_id('archive_category',['id'=>$songit_info->category])->name:''
                                    }}
                                </td>
                                <td>
                                    {{ !empty($songit_info->sub_category)?get_name_by_id('archive_category',['id'=>$songit_info->sub_category])->name:'' }}
                                </td>
                                <td>{{ !empty($songit_info->artist)  ? get_shilpi_name_by_ids($songit_info->artist) : ''  }}</td>
                                <td>{{ !empty($songit_info->gitikar)  ? get_shilpi_name_by_ids($songit_info->gitikar) : ''  }}</td>
                                <td>{{ !empty($songit_info->surokar)  ? get_shilpi_name_by_ids($songit_info->surokar) : ''  }}</td>
                                <td>{{$songit_info->rating}}</td>
                                <td>{{ !empty($songit_info->type_id)?get_name_by_ids('archive_archiveing_type',$songit_info->type_id):'' }}</td>
                                <td>{{$songit_info->stability}}</td>
                                <td>{{ get_source_name($songit_info->source_id) }}</td>
                                <td>{{$songit_info->recording_date}}</td>
                                <td>{{$songit_info->first_broadcast_date}}</td>
                                <td>{{ get_participant($songit_info->participant) }}</td>
                            </tr>

                            <?php } } ?>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    </article>
    <style>
        #print_table{
            width:100%;
        }
        #print_table td{
            /*font-family: Arial, Verdana, sans-serif;*/
            border:1px solid #d0d0d0;
            font-size:11px !important;
            padding-left:5px !important;
            padding-top:2px !important;
            padding-bottom:2px !important;

        }
        #print_table th{
            /*font-family: Arial, Verdana, sans-serif;*/
            border:1px solid #d0d0d0;
            font-size:11px !important;
            padding-left:2px !important;
            padding-top:2px !important;
            padding-bottom:2px !important;
            font-weight: bold;
        }
    </style>
@endsection