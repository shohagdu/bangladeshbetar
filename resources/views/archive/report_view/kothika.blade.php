@extends("master_archive")

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
                                    <img src = "{{ url('images/logo/logo.jpg') }}" style="height:50px; margin:0px;
                                    padding:0px;"/>
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>
                                    <div style="font-size:14px;">  {{ !empty($station_info->name)?$station_info->name:'সকল কেন্দ্র' }}</div>
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
                                <th style="width:5%;">ক্রমিক নং</th>
                                <th>কথিকার নাম</th>
                                <th>কথিকার প্রকার</th>
                                <th>বিষয়</th>
                                <th>গ্রন্থনা</th>
                                <th>উপস্থাপনা</th>
                                <th>স্থিতি</th>
                                <th>আইডি</th>
                                <?php
                                if (!empty($_GET['column'])) {
                                    foreach ($_GET['column'] as $value) {
                                        echo "<th>" . get_kothika_column_title($value) . "</th>";
                                    }
                                }
                                ?>
                            </tr>
                            <?php
                            if(!empty($archive_info)){
                            foreach($archive_info as $key => $row) {
                                $i=1;
                            $item_info = json_decode($row->kothika_info);
                            ?>
                            <tr>
                                <td>
                                    <?php echo $i++ ?>
                                </td>
                                <td>{{ $item_info->name }}</td>
                                <td>{{ !empty($item_info->category)?get_name_by_id('archive_category',['id'=>$item_info->category])->name:'' }}</td>
                                <td>{{$item_info->subject}}</td>
                                <td>{{ !empty($item_info->gronthona)  ? get_shilpi_name_by_ids($item_info->gronthona) : 'N/A'  }}</td>
                                <td>{{ !empty($item_info->uposthapona)  ? get_shilpi_name_by_ids($item_info->uposthapona) : 'N/A'  }}</td>
                                <td>{{$item_info->stability}}</td>
                                <td>{{$item_info->id}}</td>
                                <?php
                                if (!empty($_GET['column'])) {
                                    foreach ($_GET['column'] as $value) {
                                        echo "<td>";
                                        if ($value == 'rating') {
                                            echo !empty($item_info->rating) ? $item_info->rating : '';
                                        }
                                        elseif ($value == 'station_id') {
                                            echo !empty($row->station_id) ? get_name_by_id("branch_infos",['id'=>$row->station_id])->name : '';
                                        }

                                        elseif ($value == 'created_by') {
                                            echo !empty($row->created_by) ? get_name_by_id("employees",['id'=>$row->created_by])->emp_name : '';
                                        }

                                        elseif ($value == 'created_at') {
                                            echo !empty($row->created_at) ? date("Y-m-d h:i:a",strtotime($row->created_at)) : '';
                                        }

                                        echo "</td>";
                                    }
                                }
                                ?>
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