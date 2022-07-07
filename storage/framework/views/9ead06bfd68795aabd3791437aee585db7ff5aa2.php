<?php $__env->startSection('title_area'); ?>
    :: Add New Song ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<style>
    .text-bold {
        font-weight:bold;
    }
</style>
<?php $__env->startSection('main_content_area'); ?>
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
                    $songit_info = json_decode($archive_info->songit_info);
                    ?>

                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="height: 10px;"></div>
                        <table class="print_table-no-border " style="width:100%;border: 1px solid #fff !important;">

                            <tr>
                                <td    style="text-align: center;width:40%;border: 1px solid #fff!important" >
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>
                                    <div style="font-size:14px;">  <?php echo e(!empty($station_info->name)?$station_info->name:''); ?></div>
                                    <div style="font-size:14px;"><?php echo e(!empty($station_info->address)?$station_info->address:''); ?></div>
                                    <div class="clearfix"></div>
                                    <span style="font-weight: bold;font-size:14px;"> সংগীতের বিবরণ </span>
                                    <div class="clearfix"></div>

                                </td>
                            </tr>
                        </table>

                        <table style="width:100%;border:1px solid #d0d0d0" rules="all"  class="table table-bordered"
                               id="print_table">
                            <tr>
                                <td class="text-bold">অনুষ্ঠানের আইডি</td>
                                <td>
                                    <?php echo e(!empty($archive_info->program_planing_id) ? $archive_info->program_planing_id :''); ?>

                                </td>
                                <td class="text-bold">
                                    সংগীতের ধরন
                                </td>
                                <td>
                                    <?php echo $songit_info->song_department==1?'সংগীত':($songit_info->song_department==2?'ছায়াছবির গান':'ব্যন্ডের গান') ?>
                                </td>

                                <td class="text-bold">কেন্দ্র</td>
                                <td>
                                    <?php echo e(!empty($station_info->name)?$station_info->name:''); ?>

                                </td>
                                <td class="text-bold">
                                    স্বাধীন বাংলা বেতার কেন্দ্র
                                </td>
                                <td>
                                    <?php echo e($archive_info->sadin_bangla_betar==1?'Yes':'No'); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">গানের প্রথম লাইন</td>
                                <td>
                                    <?php echo e(!empty($songit_info->first_line) ? $songit_info->first_line :''); ?>

                                </td>
                                <td class="text-bold">
                                    গানের নাম
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->name) ? $songit_info->name :''); ?>

                                </td>

                                <td class="text-bold">গানের প্রকার</td>
                                <td>
                                    <?php echo e(!empty($songit_info->category)?get_name_by_id('archive_category',['id'=>$songit_info->category])->name:''); ?>

                                </td>
                                <td class="text-bold">
                                    গানের উপ প্রকার
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->sub_category)?get_name_by_id('archive_category',['id'=>$songit_info->sub_category])->name:''); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">গানের ধরন</td>
                                <td>
                                    <?php echo e(!empty($songit_info->type_id)?get_name_by_ids('archive_archiveing_type',$songit_info->type_id):''); ?>

                                </td>
                                <td class="text-bold">
                                    অংশগ্রহন
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->participant) ? get_participant($songit_info->participant) : ''); ?>

                                </td>

                                <td class="text-bold">রেটিং</td>
                                <td>
                                    <?php echo e(!empty($songit_info->rating) ? $songit_info->rating :''); ?>

                                </td>
                                <td class="text-bold">
                                    স্থিতি
                                </td>
                                <td>
                                    <?php echo e($songit_info->stability); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">প্রচার স্থান</td>
                                <td>
                                    <?php echo e(!empty($archive_info->boardcast_frequency) ? $archive_info->boardcast_frequency :''); ?>

                                </td>
                                <td class="text-bold">
                                    সোর্স
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->source_id)?get_name_by_id('archive_song_source',['id'=>$songit_info->source_id])->name:''); ?>

                                </td>

                                <td class="text-bold">রেকডিং তারিখ</td>
                                <td>
                                    <?php echo e(!empty($songit_info->recording_date) ? $songit_info->recording_date : ''); ?>

                                </td>
                                <td class="text-bold">
                                    প্রথম সম্প্রচার তারিখ
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->first_broadcast_date) ? $songit_info->first_broadcast_date :''); ?>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">হাইপারলিংক</td>
                                <td colspan="5">
                                    <?php echo e(!empty($songit_info->hyperlink) ? $songit_info->hyperlink : ''); ?>

                                </td>
                                <td class="text-bold">গানের এ্যালবাম</td>
                                <td>
                                    <?php echo e(!empty($songit_info->album_id)?get_name_by_ids('archive_albam',$songit_info->album_id):''); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">লিরিক্স</td>
                                <td colspan="7">
                                    <?php echo e(!empty($songit_info->lyrics) ? $songit_info->lyrics :''); ?>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>অংশগ্রহনকারী শিল্পীর তথ্য</b></td>
                            </tr>

                            <tr>
                                <td class="text-bold">কণ্ঠ শিল্পী</td>

                                <td>
                                    <?php echo e(!empty($songit_info->artist)  ? get_shilpi_name_by_ids($songit_info->artist) : ''); ?>

                                </td>
                                <td class="text-bold">
                                    মূল কণ্ঠ শিল্পী
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->main_artist)  ? get_shilpi_name_by_ids($songit_info->main_artist) : ''); ?>

                                </td>

                                <td class="text-bold">গীতিকার</td>
                                <td>
                                    <?php echo e(!empty($songit_info->gitikar)  ? get_shilpi_name_by_ids($songit_info->gitikar) : ''); ?>

                                </td>
                                <td class="text-bold">
                                    সুরকার
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->surokar)  ? get_shilpi_name_by_ids($songit_info->surokar) : ''); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">রেকরডিস্ট</td>
                                <td>
                                    <?php echo e(!empty($songit_info->recordist)  ? get_shilpi_name_by_ids($songit_info->recordist) : ''); ?>

                                </td>
                                <td class="text-bold">
                                    শব্দ সম্পাদক
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->sound_editors)  ? get_shilpi_name_by_ids($songit_info->sound_editors) : ''); ?>

                                </td>

                                <td class="text-bold">সংগীত পরিচালক</td>
                                <td>
                                    <?php echo e(!empty($songit_info->song_director)  ? get_shilpi_name_by_ids($songit_info->song_director) : ''); ?>

                                </td>
                                <td class="text-bold">
                                    সংগীত প্রযোজক
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->song_producer)  ? get_shilpi_name_by_ids($songit_info->song_producer) : ''); ?>

                                </td>
                            </tr>

                            <?php
                                if($songit_info->song_department==2) {
                                $film_info = $songit_info->film_info;
                             ?>
                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>ছায়াছবির তথ্য</b></td>
                            </tr>

                            <tr>
                                <td class="text-bold">ছায়াছবির নাম</td>
                                <td>
                                    <?php echo e(!empty($film_info) ? $film_info->film_name : ''); ?>

                                </td>
                                <td class="text-bold">
                                    ছায়াছবির ধরন
                                </td>
                                <td>
                                    <?php echo e(!empty($film_info->film_type)?get_name_by_ids('archive_film_type',(array) $film_info->film_type):''); ?>

                                </td>

                                <td class="text-bold">মুক্তির সাল</td>
                                <td>
                                    <?php echo e(!empty($film_info) ? $film_info->film_publish_year : ''); ?>

                                </td>
                                <td class="text-bold">
                                    অবলম্বনে
                                </td>
                                <td>
                                    <?php echo e(!empty($film_info) ? $film_info->oblombone : ''); ?>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">পুরুস্কার টীকা</td>
                                <td colspan="3">
                                    <?php echo e(!empty($film_info) ? $film_info->film_tika : ''); ?>

                                </td>
                                <td class="text-bold">
                                    কাহিনী সংক্ষেপ
                                </td>
                                <td colspan="3">
                                    <?php echo e(!empty($film_info) ? $film_info->film_story : ''); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">অভিনয় শিল্পী</td>
                                <td>
                                    <?php echo e(!empty($film_info->film_actors)  ? get_shilpi_name_by_ids($film_info->film_actors) : ''); ?>

                                </td>
                                <td class="text-bold">
                                    চলচিত্র পরিচালক
                                </td>
                                <td colspan="5">
                                    <?php echo e(!empty($film_info->film_director)  ? get_shilpi_name_by_ids($film_info->film_director) : ''); ?>

                                </td>
                            </tr>

                            <?php } ?>

                            <?php
                            if($songit_info->song_department==3) {
                            ?>
                            <tr>
                                <td class="text-bold">
                                    ব্যন্ডের নাম
                                </td>
                                <td colspan="7">
                                    <?php echo e(!empty($songit_info->band_id)?get_name_by_id('archive_band',['id'=>$songit_info->band_id])->name:''); ?>

                                </td>
                            </tr>
                            <?php
                            }
                            ?>

                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>যন্ত্র শিল্পী তথ্য</b></td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <table style="width:100%">
                                        <tr>
                                            <td>শিল্পীর নাম</td>
                                            <td>ব্যবহিত বাদ্য যন্ত্র</td>
                                        </tr>

                                        <?php
                                        if(!empty($songit_info->instument_artist)) {
                                        foreach($songit_info->instument_artist as $artist_row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo e(!empty($artist_row->artist_id) ? get_shilpi_name_by_ids([$artist_row->artist_id]):''); ?>

                                            </td>
                                            <td>
                                                <?php echo e(!empty($artist_row->instument_id) ? get_name_by_id('archive_instument',['id'=>$artist_row->instument_id])->name:''); ?>

                                            </td>
                                        </tr>
                                        <?php } } ?>

                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="8" style="font-size:20px;" class="text-bold"><b>সংশ্লিষ্ট আধিকারিক</b></td>
                            </tr>

                            <tr>
                                <td class="text-bold">পরিকল্পনা</td>
                                <td>
                                    <?php echo e(!empty($songit_info->plan_maker)  ? get_employee_name_by_ids($songit_info->plan_maker) : ''); ?>

                                </td>
                                <td class="text-bold">
                                    সম্পাদনা
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->sompadona)  ? get_employee_name_by_ids($songit_info->sompadona) : ''); ?>

                                </td>

                                <td class="text-bold">প্রযোজনা সহকারী</td>
                                <td>
                                    <?php echo e(!empty($songit_info->assistent_producer)  ? get_employee_name_by_ids($songit_info->assistent_producer) : ''); ?>

                                </td>
                                <td class="text-bold">
                                    প্রযোজনা
                                </td>
                                <td>
                                    <?php echo e(!empty($songit_info->producer)  ? get_employee_name_by_ids($songit_info->producer) : ''); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">তত্ত্বাবধানে</td>
                                <td>
                                    <?php echo e(!empty($songit_info->codinator)  ? get_employee_name_by_ids($songit_info->codinator) : ''); ?>

                                </td>
                                <td class="text-bold">
                                    নির্দেশনা
                                </td>
                                <td colspan="5">
                                    <?php echo e(!empty($songit_info->direction)  ? get_employee_name_by_ids($songit_info->direction) : ''); ?>

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
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>