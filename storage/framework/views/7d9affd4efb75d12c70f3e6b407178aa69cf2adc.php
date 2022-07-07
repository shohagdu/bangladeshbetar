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
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print">অধিবেশন কক্ষে প্রচার সংশ্লিষ্টদের তালিকা</h2>
                <button class="btn btn-primary btn-xs no-print" onclick="window.print()"  style="float:right;
                margin-top:5px;margin-right:5px;"><i
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
                $odivision_data=odivision_info_data();
                $role_info_data=role_info_data();
                ?>
                <div class="widget-body no-padding">
                    <table class="print_table-no-border "  id="table-style" style="width:100%;border: 1px solid #fff
                    !important;">
                        <tr>
                            <td  style="text-align: center;width:40%;border: 1px solid #fff !important; " >
                                <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>

                                <div style="font-size:14px;"><?php echo e($presentation_heading_info->name); ?></div>
                                <div style="font-size:14px;"><?php echo e($presentation_heading_info->address); ?></div>
                                <div style="font-size:14px;"><?php echo e($presentation_heading_info->fequencey_data); ?></div>
                                <b><u>অধিবেশন কক্ষে প্রচার সংশ্লিষ্টদের তালিকা  </u></b>
                                <div class="clearfix"></div>
                                <span><b> মাস: </b> <?php echo e((!empty($presentation_heading_info->months))?
                                $month_info[$presentation_heading_info->months]:''); ?> </span>
                                <span style="padding-left:10px;"><b>সাল:</b> <?php echo e((!empty($presentation_heading_info->presentation_year))?
                              eng2bnNumber($presentation_heading_info->presentation_year).' খ্রি.':''); ?></span>

                            </td>
                        </tr>

                        <tr>
                            <td style="width:100%;border: 1px solid #fff !important;">
                                <table class="table table-bordered print-style-table" style="width: 100%">
                                    <?php
                                    if(!empty($presentation_info)){
                                    foreach ($presentation_info as $role_key=> $info){

                                    ?>
                                    <thead>
                                    <tr >
                                        <td style="font-size:14px;font-weight: bold;width:150px;background-color:#d0d0d0;" colspan="<?php echo e((!empty($role_key) &&
                                            $role_key=='duty_officer')
                                            ?1:5); ?>" >
                                            <?php echo e(!empty($role_key)? $role_info_data[$role_key]:''); ?>

                                        </td>
                                        <?php
                                        if(!empty($role_key) && $role_key=='duty_officer'){
                                            foreach($odivision as $key =>$odivision_info){
                                                echo "<td style='background-color:#d0d0d0'>". $odivision_data[$odivision_info]."</td>";
                                            }
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($info as $all_key=>$all_info)    {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if(!empty($all_key)){
                                                $artist_info=explode("-",$all_key);
                                                echo (!empty($artist_info[0]))? $artist_info[0]:'';
                                                $artist_id= (!empty($artist_info[1]))? $artist_info[1]:'';
                                            }
                                            ?>
                                        </td>
                                        <?php
                                        foreach($odivision as $key =>$odivision_info){
                                        ?>
                                        <td>
                                            <?php
                                            $info_data=  (isset
                                            ($presentation_info[$role_key][$all_key][$odivision_info]))
                                                ?$presentation_info[$role_key][$all_key][$odivision_info]:[];
                                            $all_data='';
                                            foreach ($info_data as $artist_data){
                                                $all_data.= date('d',strtotime($artist_data['presentation_date']))
                                                    .", ";
                                            }
                                            echo rtrim(eng2bnNumber($all_data),', ');

                                            ?>
                                        </td>
                                        <?php

                                        }
                                        ?>
                                        <?php if($presentation_heading_info->is_active>=3): ?>
                                            <td style="width: 90px" class="no-print">
                                                <a href="<?php echo e(url('payment/pdf/presentation_contact_paper.php?station='
                                                    .$presentation_heading_info->station_id.'&months_id='
                                                    .$presentation_heading_info->months.'&artist_id='.$artist_id)); ?>"
                                                   target="_blank">চুক্তি পত্র </a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>

                                    <?php } }  }?>
                                    </tbody>
                                </table>
                                <table class="print_table-no-border" style="width: 100%;margin-bottom:
                                            20px;margin-top: 80px;margin-bottom: 80px;border: 1px solid #fff
                                            !important;" rules="all">
                                    <tr>
                                        <td style="width:25%;text-align: left;font-size:11px; " class="no-border"> <span
                                            >
                                                            <u>পরিকল্পনাকারী:</u>
                                    <?php echo e($employee_info[$presentation_heading_info->presentation_created_by]); ?>

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
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </article>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>