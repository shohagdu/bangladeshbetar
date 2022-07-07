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
                    <?php
                    $item_info = json_decode($archive_info->procharona_info);
                    //                    dd($archive_info);
                    ?>

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
                                <td class="text-bold">অনুষ্ঠানের আইডি</td>
                                <td>
                                    {{ $archive_info->program_planing_id }}
                                </td>
                                <td class="text-bold">
                                    প্রথম লাইন
                                </td>
                                <td>
                                    {{ $item_info->first_line }}
                                </td>

                                <td class="text-bold">কেন্দ্র</td>
                                <td>
                                    {{ !empty($station_info->name)?$station_info->name:'' }}
                                </td>
                                <td class="text-bold">
                                    স্বাধীন বাংলা বেতার কেন্দ্র
                                </td>
                                <td>
                                    {{ $archive_info->sadin_bangla_betar==1?'Yes':'No' }}
                                </td>
                            </tr>

                            <tr>

                                <td class="text-bold">
                                    প্রচারণার বিষয়
                                </td>
                                <td>
                                    {{$item_info->subject}}
                                </td>

                                <td class="text-bold">স্থিতি</td>
                                <td>
                                    {{$item_info->stability}}
                                </td>


                                <td class="text-bold">রেকডিং তারিখ</td>
                                <td>
                                    {{$item_info->recording_date}}
                                </td>
                                <td class="text-bold">
                                    প্রথম সম্প্রচার তারিখ
                                </td>
                                <td>
                                    {{$item_info->first_broadcast_date}}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">আঙ্গিক</td>
                                <td>
                                    {{ !empty($item_info->angik)?get_name_by_id('archive_category',['id'=>$item_info->angik])->name:'' }}
                                </td>
                                <td class="text-bold">
                                    মন্ত্রণালয়
                                </td>
                                <td>
                                    {{ ''  }}
                                </td>

                                <td class="text-bold">দপ্তর</td>
                                <td>
                                    {{ '' }}
                                </td>
                                <td class="text-bold">
                                    স্থিতি
                                </td>
                                <td>
                                    {{$item_info->stability}}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">প্রচার স্থান</td>
                                <td>
                                    {{$archive_info->boardcast_frequency}}
                                </td>
                                <td class="text-bold">
                                    হাইপারলিংক
                                </td>
                                <td>
                                    {{ $item_info->hyperlink }}
                                </td>

                                <td class="text-bold">রেকডিং তারিখ</td>
                                <td>
                                    {{$item_info->recording_date}}
                                </td>
                                <td class="text-bold">
                                    প্রথম সম্প্রচার তারিখ
                                </td>
                                <td>
                                    {{$item_info->first_broadcast_date}}
                                </td>
                            </tr>
                            <?php
                            if(!empty($item_info->bisoybostu)) {
                            ?>
                                <tr>
                                    <td colspan="8" style="font-size:20px;" class="text-bold"><b>প্রচারনার বিষয়বস্তু</b></td>
                                </tr>
                                <?php
                                $bisoybostu = (array) $item_info->bisoybostu;
                                foreach($bisoybostu as $type=>$array) {
                                ?>
                                <tr>
                                    <td>{{ get_archive_type_name($type)  }}</td>
                                    <td colspan="7">
                                        {{ get_file_name($array)  }}
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                            ?>

                            <?php if(!empty($item_info->vumika)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>অনুষ্ঠানের ভুমিকা</b></td>
                            </tr>

                            <?php
                            $vumika = (array) $item_info->vumika;
                            foreach($vumika as $type=>$array) {
                            ?>
                            <tr>
                                <td>{{ get_vumika_name($type)  }}</td>
                                <td colspan="7">
                                    {{ get_shilpi_name_by_ids($array)  }}
                                </td>
                            </tr>
                            <?php
                            }
                            }
                            ?>

                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>অংশগ্রহনকারী শিল্পীর তথ্য</b></td>
                            </tr>

                            <tr>
                                <td class="text-bold">অংশগ্রহণে</td>
                                <td colspan="8">
                                    {{ !empty($item_info->participant)  ? get_shilpi_name_by_ids($item_info->participant) : ''  }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>সংশ্লিষ্ট আধিকারিক</b></td>
                            </tr>

                            <tr>
                                <td class="text-bold">পরিকল্পনা</td>
                                <td>
                                    {{ !empty($item_info->plan_maker)  ? get_employee_name_by_ids($item_info->plan_maker) : ''  }}
                                </td>
                                <td class="text-bold">
                                    সম্পাদনা
                                </td>
                                <td>
                                    {{ !empty($item_info->sompadona)  ? get_employee_name_by_ids($item_info->sompadona) : ''  }}
                                </td>

                                <td class="text-bold">প্রযোজনা সহকারী</td>
                                <td>
                                    {{ !empty($item_info->assistent_producer)  ? get_employee_name_by_ids($item_info->assistent_producer) : ''  }}
                                </td>
                                <td class="text-bold">
                                    প্রযোজনা
                                </td>
                                <td>
                                    {{ !empty($item_info->producer)  ? get_employee_name_by_ids($item_info->producer) : ''  }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">তত্ত্বাবধানে</td>
                                <td>
                                    {{ !empty($item_info->codinator)  ? get_employee_name_by_ids($item_info->codinator) : ''  }}
                                </td>
                                <td class="text-bold">
                                    নির্দেশনা
                                </td>
                                <td colspan="5">
                                    {{ !empty($item_info->direction)  ? get_employee_name_by_ids($item_info->direction) : ''  }}
                                </td>
                            </tr>

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