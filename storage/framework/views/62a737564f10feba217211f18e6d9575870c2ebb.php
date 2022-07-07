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
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="height: 10px;"></div>
                        <table class="print_table-no-border " style="width:100%;border: 1px solid #fff !important;">

                            <tr>
                                <td    style="text-align: center;width:40%;border: 1px solid #fff!important" >
                                    <img src = "<?php echo e(url('images/logo/logo.jpg')); ?>" style="height:50px; margin:0px;
                                    padding:0px;"/>
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>
                                    <div style="font-size:14px;">  <?php echo e(!empty($station_info->name)?$station_info->name:'সকল কেন্দ্র'); ?></div>
                                    <div style="font-size:14px;"><?php echo e(!empty($station_info->address)?$station_info->address:''); ?></div>
                                    <div class="clearfix"></div>
                                    <span style="font-weight: bold;font-size:14px;"> <?php echo e($page_title); ?> </span>
                                    <div class="clearfix"></div>

                                </td>
                            </tr>
                        </table>

                        <table style="width:100%;border:1px solid #d0d0d0" rules="all"  class="table table-bordered"
                               id="print_table">
                            <tr>
                                <th style="width:5%;">ক্রমিক নং</th>
                                <th>প্রথম লাইন</th>
                                <th>প্রকার</th>
                                <th>শিল্পী</th>
                                <th>গীতিকার</th>
                                <th>সুরকার</th>
                                <th>স্থিতি</th>
                                <th>আইডি</th>
                                <?php
                                if (!empty($_GET['column'])) {
                                    foreach ($_GET['column'] as $value) {
                                        echo "<th>" . get_songit_column_title($value) . "</th>";
                                    }
                                }
                                ?>
                            </tr>
                            <?php
                            if(!empty($archive_info)){
                                $i=1;
                                foreach($archive_info as $key => $row) {
                                $song_info = json_decode($row->songit_info);
                                $film_info = $song_info->film_info;
                                ?>
                            <tr>
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo !empty($song_info->first_line) ? $song_info->first_line : ''  ?>
                                </td>

                                <td>
                                    <?php
                                    if(!empty($song_info->category)) {
                                        $category_info = get_name_by_id('archive_category', ['id' => $song_info->category]);
                                        echo $category_info->name;
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php echo e(!empty($song_info->artist)  ? get_shilpi_name_by_ids($song_info->artist) : ''); ?>

                                </td>
                                <td>
                                    <?php echo e(!empty($song_info->gitikar)  ? get_shilpi_name_by_ids($song_info->gitikar) : ''); ?>

                                </td>

                                <td>
                                    <?php echo e(!empty($song_info->surokar)  ? get_shilpi_name_by_ids($song_info->surokar) : ''); ?>

                                </td>









                                <td>
                                    <?php echo e(!empty($song_info->stability)  ? $song_info->stability : ''); ?>

                                </td>
                                <td>
                                    <?php echo $song_info->id ?>
                                </td>

                                <?php
                                if (!empty($_GET['column'])) {
                                    foreach ($_GET['column'] as $value) {
                                        echo "<td>";
                                        if ($value == 'sub_category') {
                                            echo !empty($song_info->sub_category) ? get_name_by_id('archive_category', ['id' => $song_info->sub_category])->name : '';
                                        } elseif ($value == 'film_director') {
                                            echo !empty($film_info->film_director) ? get_shilpi_name_by_ids($film_info->film_director) : '';
                                        } elseif ($value == 'film_actors') {
                                            echo !empty($film_info->film_actors) ? get_shilpi_name_by_ids($film_info->film_actors) : '';
                                        } elseif ($value == 'rating') {
                                            echo !empty($song_info->rating) ? $song_info->rating : '';
                                        }
                                        elseif ($value == 'film_name') {
                                            echo !empty($film_info->film_name)  ? $film_info->film_name : '';
                                        }
                                        elseif ($value == 'band_id') {
                                            echo !empty($song_info->band_id) ? get_name_by_id('archive_band', ['id' => $song_info->band_id])->name : '';
                                        }
                                        elseif ($value == 'album_id') {
                                            echo !empty($song_info->album_id) ? get_name_by_ids('archive_albam', $song_info->album_id) : '';
                                        }
                                        elseif ($value == 'name') {
                                            echo !empty($song_info->name) ? $song_info->name : '';
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>