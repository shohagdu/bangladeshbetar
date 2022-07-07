

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
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->

        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header class="no-print">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Gate pass</h2>
                <button onclick="print_fun()"
                        class="btn btn-warning btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>
            </header>
            <div>
                 <div >
                    <div >
                        <table class="table table-bordered" id="table-style">
                            <tr>
                                <td colspan="7" style="border-top: 1px solid #fff;border-left: 1px solid #fff;
                                border-right: 1px solid #fff;">
                                    <table class="gate_passed_heading" id="table-style"  style="width: 100%;" >
                                        <tr>
                                            <td style="font-size:14px!important;text-align:center;"
                                            >গণপ্রজাতন্ত্রী
                                                বাংলাদেশ
                                                সরকার</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="font-size:18px!important; ;font-weight:
                                                bold;text-align:center;">
                                                <?php echo e(!empty
                                                ($get_program_planning_info_artist[0]['station_name'])
                                                ?$get_program_planning_info_artist[0]['station_name']:''); ?>



                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"  style="text-align:center;"><?php echo e(!empty
                                                ($get_program_planning_info_artist[0]['branch_address'])
                                                ?$get_program_planning_info_artist[0]['branch_address']:''); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="text-align:center;" >www.betar.gov.bd </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th style="width:2%;">#</th>
                                <th style="width:10%;">নাম</th>
                                <th style="width:15%;">ঠিকানা</th>
                                <th style="width:10%;">মোবাইল</th>
                                <th style="width:10%;">সাক্ষাতের উদ্দেশ্য</th>
                                <th style="width:15%;">সাক্ষাত প্রদানকারী</th>
                                <th style="width:15%;">গাডীর সহ গাডীর নং</th>
                            </tr>
                            <?php
                            $i = 1;
                            if(!empty($get_program_planning_info_artist)) {
                            foreach ($get_program_planning_info_artist as $key=> $description) {
                            ?>
                                 <tr>
                                    <td><?php echo e($i++); ?> </td>
                                    <td><?php echo e($description['artist_name']); ?> </td>
                                    <td><?php echo e($description['address']); ?> </td>
                                    <td>
                                        <?php 
                                            $artist_mobile= !empty($description['artist_mobile'])
                                            ?json_decode
                                             ($description['artist_mobile'],true):'';
                                            echo implode($artist_mobile);
                                         ?>
                                    </td>
                                    <td> <?php echo e($description['program_name']); ?> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>

                            <?php
                            }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </article>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>