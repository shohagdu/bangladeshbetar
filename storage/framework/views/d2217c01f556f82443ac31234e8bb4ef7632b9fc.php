

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
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print">অধিবেশন কক্ষে প্রচার সংশ্লিষ্টদের তালিকা</h2>
                <button onclick="window.print()"
                   class="btn btn-success btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>
                <button onclick="back()"
                   class="btn btn-danger btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-backward"></i>  Back
                </button>

            </header>
            <div>
                <?php
                    $month_info= month_name_info();
                    $day_name = show_day_info_bn();
                     $odivision_data=odivision_info_data();
                ?>
                <div class="widget-body no-padding" >
                    <table class="print_table-no-border "  style="width:100%;border: 1px solid #fff !important;">
                        <tr>
                            <td    style="text-align: center;width:40%;border: 1px solid #fff!important" >
                                <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>

                                <div style="font-size:14px;"><?php echo e($presentation_info[0]->name); ?></div>
                                <div style="font-size:14px;"><?php echo e($presentation_info[0]->address); ?></div>
                                <div style="font-size:14px;"><?php echo e($presentation_info[0]->fequencey_data); ?></div>
                                <b><u> অধিবেশন কক্ষে প্রচার সংশ্লিষ্টদের তালিকা </u></b>
                                <div class="clearfix"></div>
                                <span><b> মাস: </b> <?php echo e((!empty($presentation_info[0]->months))?
                                $month_info[$presentation_info[0]->months]:''); ?> </span>
                                <span style="padding-left:10px;"><b>সাল:</b> <?php echo e((!empty($presentation_info[0]->presentation_year))?
                              eng2bnNumber($presentation_info[0]->presentation_year).' খ্রি.':''); ?></span>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <table class="table table-bordered print-style-table"  rules="all" >
                                    <?php
//                                        echo "<pre>";
//                                        print_r($presentation_info);
//                                        exit;
                                        if(!empty($presentation_info)){
                                        foreach ($presentation_info as $info){
                                    ?>

                                    <tr>
                                        <td><?php echo e((!empty($info->presentation_date))?eng2bnNumber
                                        (date('d-m-Y',strtotime($info->presentation_date))):''); ?></td>
                                        <td style="text-align: center"><?php echo e($day_name[date('D',strtotime
                                        ($info->presentation_date))]); ?></td>

                                        <td>
                                            <table class="table table-bordered print-style-table presentation_table"
                                                  rules="all" id="table-style" style="border: 1px solid #fff" >
                                                <thead>
                                                    <tr>
                                                        <td style="width: 120px;font-size:10px!important;"></td>
                                                        <td style="width: 120px;font-size:10px!important;">ডিউটি অফিসার</td>
                                                        <td style="width: 120px;font-size:10px!important;">ঘোষক/ উপস্থাপক</td>
                                                        <td style="width: 120px;font-size:10px!important;">লগ রাইটার</td>
                                                        <td style="width: 120px;font-size:10px!important;">অফিস সহায়ক</td>
                                                        <td style="width: 120px;font-size:10px!important;">
                                                            অফিসার-ইন-চার্জ
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $artist_info=!empty($info->artist_log_info)?json_decode
                                                ($info->artist_log_info,true):'';
                                                foreach ($artist_info as $odivision_id=> $artist_data){
                                                ?>
                                                    <tr>
                                                    <td style="width:100px !important;">
                                                        <?php echo e((!empty($odivision_id))?$odivision_data[$odivision_id]:''); ?>

                                                    </td>

                                                    <td style="width: 140px;">
                                                        <?php
                                                            $duty_officer_info=!empty($artist_data['duty_officer'])
                                                                  ?$artist_data['duty_officer']:'';
                                                              if(!empty($duty_officer_info)){
                                                                  $duty_officer_data='';
                                                                  foreach ($duty_officer_info as  $duty_officer){
                                                                      $duty_officer_data.=
                                                                      $atrist_info_info[$duty_officer].", ";
                                                                  }
                                                                  echo trim($duty_officer_data,', ');
                                                              }

                                                         ?>
                                                    </td>

                                                    <td style="width: 140px;">
                                                        <?php
                                                        $duty_officer_info=!empty($artist_data['announcer'])
                                                            ?$artist_data['announcer']:'';
                                                        if(!empty($duty_officer_info)){
                                                            $announcer_data='';
                                                            foreach ($duty_officer_info as  $duty_officer){
                                                                $announcer_data.=$atrist_info_info[$duty_officer].", ";
                                                            }
                                                            echo trim($announcer_data,', ');
                                                        }

                                                        ?>

                                                    </td>
                                                    <td style="width: 140px;">
                                                        <?php
                                                        $duty_officer_info=!empty($artist_data['log_writer'])
                                                            ?$artist_data['log_writer']:'';
                                                        if(!empty($duty_officer_info)){
                                                            $log_writer_data='';
                                                            foreach ($duty_officer_info as  $duty_officer){
                                                                if(!empty($atrist_info_info[$duty_officer])){
                                                                $log_writer_data.= $atrist_info_info[$duty_officer]
                                                                    .", ";
                                                                }
                                                            }
                                                            echo trim($log_writer_data,', ');
                                                        }

                                                        ?>

                                                    </td>
                                                    <td style="width: 140px;">
                                                        <?php

                                                        $duty_officer_info=!empty($artist_data['officer_assistent'])
                                                            ?$artist_data['officer_assistent']:'';
                                                        if(!empty($duty_officer_info)){
                                                            $officer_assistent_data='';
                                                            foreach ($duty_officer_info as  $duty_officer){
                                                                if(!empty($atrist_info_info[$duty_officer])){
                                                                    $officer_assistent_data.=
                                                                    $atrist_info_info[$duty_officer].", ";
                                                                }
                                                            }
                                                            echo trim($officer_assistent_data,', ');
                                                        }

                                                        ?>

                                                    </td>
                                                    <td style="width: 140px;">
                                                        <?php

                                                        $duty_officer_info=!empty($artist_data['officer_incharge'])
                                                            ?$artist_data['officer_incharge']:'';
                                                        if(!empty($duty_officer_info)){
                                                            $officer_incharge_data='';
                                                            foreach ($duty_officer_info as  $duty_officer){
                                                                if(!empty( $atrist_info_info[$duty_officer])){
                                                                    $officer_incharge_data.=
                                                                    $atrist_info_info[$duty_officer].", ";
                                                                }
                                                            }
                                                            echo trim($officer_incharge_data,', ');
                                                        }


                                                        ?>

                                                    </td>


                                                </tr>
                                                    <?php } ?>
                                            </table>

                                        </td>
                                    </tr>
                                    <?php } } ?>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table class="print_table-no-border" style="width: 100%;margin-bottom:
                                            20px;margin-top: 80px;margin-bottom: 80px;border: 1px solid #fff
                                            !important;" rules="all">
                        <tr>
                            <td style="width:25%;text-align: left;font-size:11px; " class="no-border"> <span
                                >
                                                            <u>পরিকল্পনাকারী:</u>
                                    <?php echo e(!empty($presentation_info[0]->presentation_created_by)?
                                                 $employee_info[$presentation_info[0]->presentation_created_by]:''); ?>

                                                        </span>
                            </td>
                            <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                        style="border-bottom:1px solid #333;">সহকারী
                                                            পরিচালক : </span></td>
                            <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                        style="border-bottom:1px solid #333;
">উপ-পরিচালক: </span></td>
                            <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                        style="border-bottom:1px solid #333;">আঞ্চলিক পরিচালক/
                                                            পরিচালক: </span></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->
    <style>
        .presentation_table td {
            font-size:10px !important;
        }
        .presentation_table th {
            font-size:10px !important;;
        }
        .emptyColorInfo{
            color:darkred;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>