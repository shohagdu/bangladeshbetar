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
                    $item_info = json_decode($archive_info->sakhhatkar_info);
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
                                    সাক্ষাৎকারের প্রকার
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
                                    অনুষ্ঠানের নাম
                                </td>
                                <td>
                                    {{$item_info->program_name}}
                                </td>

                                <td class="text-bold">স্থিতি</td>
                                <td>
                                    {{$item_info->stability}}
                                </td>


                                <td class="text-bold">সাক্ষাৎগ্রহণের তারিখ</td>
                                <td>
                                    {{$item_info->grohoner_date}}
                                </td>
                                <td class="text-bold">
                                    মন্তব্য
                                </td>
                                <td>
                                    {{$item_info->comment}}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">সাক্ষাৎদাতার নাম</td>
                                <td>
                                    {{ $item_info->sakhhat_data }}
                                </td>
                                <td class="text-bold">
                                    কর্মক্ষেত্র
                                </td>
                                <td>
                                    {{ $item_info->work_area  }}
                                </td>

                                <td class="text-bold">স্থান</td>
                                <td colspan="3">
                                    {{ !empty($item_info->place)?$item_info->place:'N/A' }}
                                </td>

                            </tr>

                            <tr>
                                <td class="text-bold">বিষয়</td>
                                <td colspan="7">
                                    {{ $item_info->subject }}
                                </td>
                            </tr>

                            <?php if(!empty($item_info->bisoybostu)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>অনুষ্ঠানের বিষয়বস্তু</b></td>
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
                            <?php if(!empty($item_info->sakhhatkar_department)) { ?>
                            <tr>
                                <td>সাক্ষাতকার বিভাগ</td>
                                <td colspan="7">
                                    {{ get_sakhhatkar_department_name($item_info->sakhhatkar_department) }}
                                </td>
                            </tr>
                            <?php } ?>

                            <?php
                            if(!empty($item_info->sakhhatkar_vhittik)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>সাক্ষাতকারভিত্তিক</b></td>
                            </tr>

                            <tr>
                                <td>সাক্ষাৎকার দাতা</td>
                                <td colspan="3">
                                    {{ !empty($item_info->sakhhatkar_vhittik->sakhhatkardata) ? get_shilpi_name_by_ids($item_info->sakhhatkar_vhittik->sakhhatkardata) : ''  }}
                                </td>
                                <td>সাক্ষাৎকার গ্রহীতা</td>
                                <td colspan="3">
                                    {{ !empty($item_info->sakhhatkar_vhittik->sakhhatkar_grohita) ? get_shilpi_name_by_ids($item_info->sakhhatkar_vhittik->sakhhatkar_grohita) : ''  }}
                                </td>
                            </tr>

                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($item_info->alochona_onusthan)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>আলোচনা অনুষ্ঠান</b></td>
                            </tr>

                            <tr>
                                <td>আলোচনার সঞ্চালক</td>
                                <td colspan="3">
                                    {{ !empty($item_info->alochona_onusthan->sonchalok) ? get_shilpi_name_by_ids($item_info->alochona_onusthan->sonchalok) : ''  }}
                                </td>
                                <td>আলোচনা অংশগ্রহণকারী</td>
                                <td colspan="3">
                                    {{ !empty($item_info->alochona_onusthan->ongshogrohonkari) ? get_shilpi_name_by_ids($item_info->alochona_onusthan->ongshogrohonkari) : ''  }}
                                </td>
                            </tr>

                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($item_info->sms)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>চিঠিপত্র/ এসএমএস/ইমেইল</b></td>
                            </tr>

                            <tr>
                                <td>গ্রন্থনা</td>
                                <td colspan="3">
                                    {{ !empty($item_info->sms->gronthona) ? get_shilpi_name_by_ids($item_info->sms->gronthona) : ''  }}
                                </td>
                                <td>উপস্থাপনা</td>
                                <td colspan="3">
                                    {{ !empty($item_info->sms->uposthapona) ? get_shilpi_name_by_ids($item_info->sms->uposthapona) : ''  }}
                                </td>
                            </tr>

                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($item_info->phone_in_program)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>ফোন-ইন প্রোগ্রাম</b></td>
                            </tr>

                            <tr>
                                <td>বিশেষজ্ঞ</td>
                                <td colspan="3">
                                    {{ !empty($item_info->phone_in_program->bishesoggo) ? get_shilpi_name_by_ids($item_info->phone_in_program->bishesoggo) : ''  }}
                                </td>
                                <td>পরিচালনা</td>
                                <td colspan="3">
                                    {{ !empty($item_info->phone_in_program->porichalona) ? get_shilpi_name_by_ids($item_info->phone_in_program->porichalona) : ''  }}
                                </td>
                            </tr>

                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($item_info->phone_in_program)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>সরেজমিন প্রতিবেদন</b></td>
                            </tr>

                            <tr>
                                <td>বিশেষজ্ঞ</td>
                                <td colspan="3">
                                    {{ !empty($item_info->phone_in_program->bishesoggo) ? get_shilpi_name_by_ids($item_info->phone_in_program->bishesoggo) : ''  }}
                                </td>
                                <td>পরিচালনা</td>
                                <td colspan="3">
                                    {{ !empty($item_info->phone_in_program->porichalona) ? get_shilpi_name_by_ids($item_info->phone_in_program->porichalona) : ''  }}
                                </td>
                            </tr>

                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($item_info->protibedon)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>সরেজমিন প্রতিবেদন</b></td>
                            </tr>

                            <tr>
                                <td>প্রতিবেদক</td>
                                <td colspan="7">
                                    {{ !empty($item_info->protibedon->protibedok) ? get_shilpi_name_by_ids($item_info->protibedon->protibedok) : ''  }}
                                </td>
                            </tr>

                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($item_info->bitorko_porjay)) { ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>বিতরক</b></td>
                            </tr>

                            <tr>
                                <td>বিতরক পর্যায়</td>
                                <td>
                                    {{ !empty($item_info->bitorko->bitorko_porjay) ? get_bitorko_projay_name($item_info->bitorko->bitorko_porjay) : ''  }}
                                </td>
                                <td>বিতরক বিচারক</td>
                                <td>
                                    {{ !empty($item_info->bitorko->bitorko_bicharok) ? get_shilpi_name_by_ids($item_info->bitorko->bitorko_bicharok) : ''  }}
                                </td>
                                <td>বিতর্ক পরিচালনা</td>
                                <td>
                                    {{ !empty($item_info->bitorko->bitorko_porichalona) ? get_shilpi_name_by_ids($item_info->bitorko->bitorko_porichalona) : ''  }}
                                </td>
                                <td>বিতর্ক সহযোগিতা</td>
                                <td>
                                    {{ !empty($item_info->bitorko->bitorko_shohojogita) ? get_shilpi_name_by_ids($item_info->bitorko->bitorko_shohojogita) : ''  }}
                                </td>
                            </tr>

                            <?php
                            if(!empty($item_info->bitorko->protisthan_info)) {
                                foreach($item_info->bitorko->protisthan_info as $array) {
                                ?>
                                <tr>
                                    <td><?php echo $array['protisthan_name']; ?></td>
                                    <td><?php echo $array['protisthaner_thikana']; ?></td>
                                    <td><?php echo ''; ?></td>
                                </tr>

                            <?php
                            }
                            }
                            ?>

                            <?php
                            }
                            ?>

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