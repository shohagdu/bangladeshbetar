
<?php $__env->startSection('title_area'); ?>
    :: <?php echo e($page_title); ?>  ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <style>
        .text-bold {
            font-weight: bold;
        }
        #player {
            float:right;
            margin-right:0px;
            margin-top:10px;
            height:30px;
        }
    </style>

    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>
                <a href="<?php echo e(url('view_playlist/'.$playlist->id)); ?>" class="btn btn-info btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    রিপোর্ট দেখুন
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'playlist_update_form',
                    'class'=>'form-horizontal']); ?>

                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;">
                            <p style="font-size:12px;font-weight: bold;">প্লেলিস্ট আইডি : <?php echo $playlist->playlist_id; ?></p>
                            <p style="font-size:12px;font-weight: bold;">অনুষ্ঠানের নাম: <?php echo e($playlist->program_name); ?> </p>
                            <p style="font-size:12px;font-weight: bold;">কেন্দ্রের নাম: <?php echo e($playlist->station_name); ?> (<?php echo e($playlist->sub_station_name. '('.$playlist->fequencey.')'); ?>) </p>
                        </div>
                        <table  class="table table-striped table-bordered table-hover" width="100%">
                            <tbody>
                            <?php
                            $i = 1;
                            foreach($item_info as $row) {
                            $details = $row['details'];
                            ?>
                            <tr id="order_<?php echo $row['song_id'];  ?>">
                                <td><?php echo $i++; ?>

                                </td>
                                <?php
                                if($details->archive_type ==1) {
                                $songit_info = json_decode($details->songit_info);
                                ?>
                                <td class="text-bold">সংগীত</td>
                                <td style="width:40%">
                                    <p>

                                        <b>প্রথম লাইনঃ</b> <?php echo e($songit_info->first_line); ?> ;
                                        <b>গানের প্রকারঃ</b>
                                        <?php echo e(!empty($songit_info->category)?get_name_by_id('archive_category',['id'=>$songit_info->category])->name:''); ?>

                                        ;
                                        <b>শিল্পীঃ</b> <?php echo e(!empty($songit_info->artist)?get_shilpi_name_by_ids($songit_info->artist):''); ?> ;
                                        <b>গীতিকার:</b> <?php echo e(!empty($songit_info->gitikar)  ? get_shilpi_name_by_ids($songit_info->gitikar) : ''); ?> ;
                                        <b>সুরকার:</b> <?php echo e(!empty($songit_info->surokar)  ? get_shilpi_name_by_ids($songit_info->surokar) : ''); ?> ;
                                        <?php
                                        if($songit_info->song_department==2) {
                                        $film_info = $songit_info->film_info;
                                        ?>
                                        <b>ছায়াছবির নাম:</b> <?php echo e(!empty($film_info) ? $film_info->film_name : ''); ?>;
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if($songit_info->song_department==3) {
                                        ?>
                                        <b>ব্যন্ডের নাম:</b> <?php echo e(!empty($songit_info->band_id)?get_name_by_id('archive_band',['id'=>$songit_info->band_id])->name:''); ?>;
                                        <?php
                                        }
                                        ?>
                                        <b>স্থিতি:</b> <?php echo e($songit_info->stability); ?>

                                        ;
                                        <b>আইডি:</b>   <?php echo e($songit_info->id); ?> ;
                                    </p>
                                </td>
                                <?php
                                }
                                elseif($details->archive_type ==2) {
                                $item_info = json_decode($details->kobita_info);
                                ?>
                                <td class="text-bold">কবিতা</td>
                                <td style="width:40%">
                                    <p>

                                        <b>প্রথম লাইনঃ</b> <?php echo e($item_info->first_line); ?> ;
                                        <b>রচয়িতাঃ</b> <?php echo e(!empty($item_info->rochoyita)?get_shilpi_name_by_ids($item_info->rochoyita):''); ?>;
                                        <b>আবৃতিকার:</b> <?php echo e(!empty($item_info->abritikar)  ? get_shilpi_name_by_ids($item_info->abritikar) : ''); ?>;
                                        <b>রচয়িতা:</b> <?php echo e(!empty($item_info->rochoyita)  ? get_shilpi_name_by_ids($item_info->rochoyita) : ''); ?>;
                                        <b>স্থিতি:</b> <?php echo e($item_info->stability); ?>;
                                        <b>আইডি:</b>   <?php echo e($item_info->id); ?> ;

                                    </p>
                                </td>
                                <?php
                                }
                                elseif($details->archive_type ==3) {
                                $item_info = json_decode($details->natok_info);
                                ?>
                                <td class="text-bold">নাটক</td>
                                <td style="width:40%">
                                    <p>

                                        <b>নাটকের নামঃ</b> <?php echo e($item_info->name); ?>;
                                        <b>নাটকের প্রকারঃ </b><?php echo e(!empty($item_info->category)?get_name_by_id('archive_category',['id'=>$item_info->category])->name:''); ?>;
                                        <b>নাট্যশিল্পী:</b> <?php echo e(!empty($item_info->actors)  ? get_shilpi_name_by_ids($item_info->actors) : ''); ?>;
                                        <b>নাট্যকার:</b> <?php echo e(!empty($item_info->nattokar)  ? get_shilpi_name_by_ids($item_info->nattokar) : ''); ?>;
                                        <b>নাট্যরুপকার:</b> <?php echo e(!empty($item_info->rupokar)  ? get_shilpi_name_by_ids($item_info->rupokar) : ''); ?>;
                                        <b>নাট্য প্রযোজক:</b> <?php echo e(!empty($item_info->natok_producer)  ? get_shilpi_name_by_ids($item_info->natok_producer) : ''); ?>;
                                        <b>স্থিতি:</b> <?php echo e($item_info->stability); ?>;
                                        <b>আইডি:</b>   <?php echo e($item_info->id); ?> ;
                                    </p>
                                </td>
                                <?php
                                }
                                elseif($details->archive_type ==4) {
                                $item_info = json_decode($details->program_info);
                                ?>
                                <td class="text-bold">অনুষ্ঠান</td>
                                <td style="width:40%">
                                    <p>

                                        <b>অনুষ্ঠানের নামঃ</b>  <?php echo e($item_info->name); ?>;
                                        <b>অনুষ্ঠানের প্রকারঃ</b>  <?php echo e(!empty($item_info->category) ? get_name_by_id('archive_category',['id'=>$item_info->category])->name:''); ?>;
                                        <b>গবেষণা:</b><?php echo e(!empty($item_info->gobeshona)  ? get_shilpi_name_by_ids($item_info->gobeshona) : ''); ?>;
                                        <b>গ্রন্থনা:</b><?php echo e(!empty($item_info->gronthona)  ? get_shilpi_name_by_ids($item_info->gronthona) : ''); ?>;
                                        <b>উপস্থাপনা:</b><?php echo e(!empty($item_info->uposthapona)  ? get_shilpi_name_by_ids($item_info->uposthapona) : ''); ?>;
                                        <b>স্থিতি:</b> <?php echo e($item_info->stability); ?>;
                                        <b>আইডি:</b>   <?php echo e(!empty($item_info->id) ? $item_info->id : $item_info->program_id); ?> ;
                                    </p>
                                </td>
                                <?php
                                }
                                elseif($details->archive_type ==5) {
                                $item_info = json_decode($details->vhason_info);
                                ?>
                                <td class="text-bold">ভাষণ</td>
                                <td style="width:40%">
                                    <p>

                                        <b>প্রথম লাইন:</b>   <?php echo e($item_info->first_line); ?> ;
                                        <b>ভাষণের প্রকারঃ </b> <?php echo !empty($item_info->category) ? get_name_by_id('archive_category',['id'=>$item_info->category])->name:''; ?>;
                                        <b>প্রদানকারীর নাম:</b> <?php echo e($item_info->vhason_kari); ?>;
                                        <b>প্রদানের তারিখ:</b> <?php echo e($item_info->prodaner_tarikh); ?>;
                                        <b>কর্মক্ষেত্র:</b> <?php echo e($item_info->work_area); ?>;
                                        <b>স্থিতি:</b> <?php echo e($item_info->stability); ?>;
                                        <b>আইডি:</b>   <?php echo e($item_info->id); ?> ;
                                    </p>
                                </td>
                                <?php }
                                elseif($details->archive_type ==6) {
                                $item_info = json_decode($details->sakhhatkar_info);
                                ?>
                                <td class="text-bold">সাক্ষাৎকার</td>
                                <td style="width:40%">
                                    <p>

                                        <b>সাক্ষাৎ দাতাঃ</b> <?php echo $item_info->sakhhat_data; ?>;
                                        <b>প্রকারঃ </b><?php echo !empty($item_info->category) ? get_name_by_id('archive_category',['id'=>$item_info->category])->name:''; ?>;
                                        <?php if(!empty($item_info->sakhhatkar_department)) {  ?>
                                        <b>সাক্ষাতকার বিভাগ:</b><?php echo e(get_sakhhatkar_department_name( $item_info->sakhhatkar_department)); ?>;
                                        <?php } ?>
                                        <b>স্থিতি:</b><?php echo e($item_info->stability); ?>;
                                        <b>আইডি:</b>   <?php echo e($item_info->id); ?> ;
                                    </p>
                                </td>
                                <?php }
                                elseif($details->archive_type==7) {
                                $kothika_info = json_decode($details->kothika_info);
                                ?>
                                <td class="text-bold">কথিকা</td>
                                <td style="width:40%">
                                    <p>

                                        <b>কথিকার নামঃ</b><?php echo e($kothika_info->name); ?>;
                                        <b>কথিকার বিষয়ঃ</b><?php echo e($kothika_info->subject); ?>;
                                        <b>গ্রন্থনা:</b><?php echo e(!empty($kothika_info->gronthona)  ? get_shilpi_name_by_ids($kothika_info->gronthona) : 'N/A'); ?>;
                                        <b>উপস্থাপনা:</b><?php echo e(!empty($kothika_info->uposthapona)  ? get_shilpi_name_by_ids($kothika_info->uposthapona) : 'N/A'); ?>;
                                        <b>স্থিতি:</b><?php echo e($kothika_info->stability); ?>;
                                        <b>আইডি:</b>   <?php echo e($kothika_info->id); ?> ;
                                    </p>
                                </td>
                                <?php
                                }
                                elseif($details->archive_type==8) {
                                $item_info = json_decode($details->procharona_info);
                                ?>
                                <td class="text-bold">প্রচারনা</td>
                                <td style="width:40%">
                                    <p>

                                        <b>প্রথম লাইনঃ</b> <?php echo $item_info->first_line; ?>;
                                        <b>প্রচারণার বিষয়ঃ</b> <?php echo $item_info->subject; ?>;
                                        <b>আঙ্গিক:</b>  <?php echo e(!empty($item_info->angik)?get_name_by_id('archive_category',['id'=>$item_info->angik])->name:''); ?>;
                                        <b>স্থিতি:</b> <?php echo $item_info->stability; ?>;
                                        <b>আইডি:</b> <?php echo $item_info->id?>;
                                    </p>
                                </td>
                                <?php
                                }
                                else {
                                ?>
                                <td colspan="2">

                                </td>
                                <?php
                                }
                                ?>
                                <td>
                                    <audio controls  name="media">
                                        <source id="audioSource" src="<?php echo e(url( get_file_path((int)$row['song_id']) )); ?>" type="audio/mpeg">
                                    </audio>
                                </td>
                            </tr>

                            <?php  } ?>

                            </tbody>
                        </table>


                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </article>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>