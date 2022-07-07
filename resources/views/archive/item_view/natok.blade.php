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
                    $item_info = json_decode($archive_info->natok_info);
//                                        dd($item_info);
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
                                    নাটকের প্রকার
                                </td>
                                <td>
                                    {{ !empty($item_info->category)?get_name_by_id('archive_category',['id'=>$item_info->category])->name:'' }}
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
                                    নাটকের নাম
                                </td>
                                <td>
                                    {{$item_info->name}}
                                </td>

                                <td class="text-bold">নাটকের প্রকার</td>
                                <td>
                                    {{ !empty($item_info->category)?get_name_by_id('archive_category',['id'=>$item_info->category])->name:'' }}
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
                                <td class="text-bold">নাটকের ধরন</td>
                                <td>
                                </td>
                                <td class="text-bold">
                                    অংশগ্রহন
                                </td>
                                <td>
                                    {{ get_participant($item_info->participant) }}
                                </td>

                                <td class="text-bold">রেটিং</td>
                                <td>
                                    {{$item_info->rating}}
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
                                    সোর্স
                                </td>
                                <td>
                                    {{ !empty($item_info->source_id)?get_name_by_id('archive_song_source',['id'=>$item_info->source_id])->name:'' }}
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
                                <td class="text-bold">হাইপারলিংক</td>
                                <td colspan="5">
                                    {{$item_info->hyperlink}}
                                </td>
                                <td class="text-bold">কাহিনী সংক্ষেপ</td>
                                <td>
                                    {{ $item_info->story_summary }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">মূল গ্লপ</td>
                                <td>{{ $item_info->main_story  }}</td>
                                <td class="text-bold">ছায়া গ্লপ</td>
                                <td colspan="5">
                                    {{$item_info->chaya_story}}
                                </td>
                            </tr>

                            <?php if(!empty($item_info->bisoybostu)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>নাটকের বিষয়বস্তু</b></td>
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

                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>অংশগ্রহনকারী শিল্পীর তথ্য</b></td>
                            </tr>

                            <tr>
                                <td class="text-bold">নাট্যশিল্পী</td>
                                <td>
                                    {{ !empty($item_info->actors)  ? get_shilpi_name_by_ids($item_info->actors) : ''  }}
                                </td>
                                <td class="text-bold">
                                    নাট্যকার
                                </td>
                                <td colspan="3">
                                    {{ !empty($item_info->nattokar)  ? get_shilpi_name_by_ids($item_info->nattokar) : ''  }}
                                </td>
                                <td class="text-bold">নাট্যরুপকার</td>
                                <td>
                                    {{ !empty($item_info->rupokar)  ? get_shilpi_name_by_ids($item_info->rupokar) : ''  }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">মূল গ্লপ রচয়িতা</td>
                                <td>
                                    {{ !empty($item_info->rochoyita)  ? get_shilpi_name_by_ids($item_info->rochoyita) : ''  }}
                                </td>
                                <td class="text-bold">
                                    নাট্য প্রযোজক
                                </td>
                                <td colspan="3">
                                    {{ !empty($item_info->natok_producer)  ? get_shilpi_name_by_ids($item_info->natok_producer) : ''  }}
                                </td>
                                <td class="text-bold">শব্দ সম্পাদক</td>
                                <td>
                                    {{ !empty($item_info->sound_editors)  ? get_shilpi_name_by_ids($item_info->sound_editors) : ''  }}
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

