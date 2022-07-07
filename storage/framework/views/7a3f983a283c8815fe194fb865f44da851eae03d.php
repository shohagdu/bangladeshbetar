
<?php $__env->startSection('main_content_area'); ?>


    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print"> কিউসিট রিপোট</h2>
                <button onclick="back()" href="<?php echo e(url('master_date_program_time_table')); ?>" class="btn btn-danger
                btn-xs no-print"  style="float:right; margin-top:5px;margin-right:5px;
"><i  class="glyphicon glyphicon-backward"></i>   Back   </button>
                <button onclick="print()" href="<?php echo e(url('master_date_program_time_table')); ?>" class="btn btn-info
                btn-xs no-print" style="float:right; margin-top:5px;margin-right:5px;
"><i  class="glyphicon glyphicon-print"></i>   Print   </button>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table class="print_table-no-border " style="width:100%;border: 1px solid #fff !important;">
                            <tr>
                                <td    style="text-align: center;width:40%;border: 1px solid #fff!important" >
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>

                                    <div style="font-size:14px;"><?php echo e((!empty($plan_info->station_name))? $plan_info->station_name:''); ?></div>
                                    <div style="font-size:14px;"><?php echo e(!empty($plan_info->address)?$plan_info->address:''); ?></div>
                                    <div style="font-size:14px;"><?php echo e((!empty($plan_info->fequencey_data))? $plan_info->fequencey_data:''); ?></div>

                                    <div class="clearfix"></div>
                                    <span style="font-weight: bold;font-size:14px;"> প্রোগ্রাম কিউসীট </span>
                                    <div class="clearfix"></div>
                                    <span style="padding-left:10px;">তারিখ:  <?php echo e((!empty($plan_info->date))? eng2bnNumber
                                    (date('d-m-Y',strtotime
                                ($plan_info->date) )):''); ?></span>

                                </td>
                            </tr>
                        </table>
                        
                        <?php 
                            $schedule = (!empty($plan_info->content))? json_decode($plan_info->content):NULL;
                            $odivision_info=odivision_info_data();
                            $role_info=role_info_data();
                         ?>
                        <table class="table table-bordered table-striped" id="table-style" style="width: 100%;">
                            <?php
                            if(!empty($presentation_info)){
                            foreach ($presentation_info as $odivision_id=>$role_wise_artist_info){
                            ?>
                            <tr style="background: #d0d0d0;">
                                <td colspan="<?php echo count($role_data_info) ?>" style="font-weight: bold;" >
                                    <?php echo e((!empty($odivision_id))
                                                ?$odivision_info[$odivision_id]:NULL); ?>

                                </td>
                            </tr>
                            <tr>
                                <?php $__currentLoopData = $role_data_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th> <?php echo e((!empty($role_title))?
                                        $role_info[$role_title]:NULL); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>

                            <tr>
                                <?php
                                if(!empty($role_wise_artist_info))   {
                                foreach ($role_wise_artist_info as $role_id=>$artist_info){
                                ?>

                                <td>
                                    <?php
                                    if(!empty($artist_info)){
                                        $name_info= array_column($artist_info,'name');
                                        echo implode(", ",$name_info);
                                    }
                                    ?>
                                </td>

                                <?php
                                }
                                }
                                ?>
                            </tr>

                            <?php
                            }
                            }
                            ?>
                        </table>



                        <table class="table-bordered table print_table" id="table-style" style="margin-top:50px;
                        border-left:1px solid #fff !important;">

                            <thead>
                            <tr>
                                <th  style="border-left: 1px solid #d0d0d0 !important;border-top:1px solid #d0d0d0 !important;width:6%">সময়</th>
                                <th class="width15per" style="border-top:1px solid #d0d0d0 !important;">অনুষ্ঠানের নাম</th>
                                <th class="width15per" style="border-top:1px solid #d0d0d0 !important;">অনুষ্ঠনের বিবরণ</th>
                                <th class="width15per" style="border-top:1px solid #d0d0d0 !important;">অনুষ্ঠনের বিষয়বস্তু</th>
                                <th class="width5per" nowrap style="border-top:1px solid #d0d0d0 !important;">প্লে লিষ্ট আইডি নং</th>
                                <th class="width5per" nowrap style="border-top:1px solid #d0d0d0 !important;">রেকর্ড/সজিব</th>
                                <th  class="width5per" style="border-top:1px solid #d0d0d0 !important;">স্থিতি</th>
                                <th class="width10per" style="border-top:1px solid #d0d0d0 !important;">মন্তব্য</th>

                                <th style="border-top:1px solid #d0d0d0 !important;">প্রযোজক</th>
                                <th style="border-top:1px solid #d0d0d0 !important;">তত্বাবধানে</th>

                            </tr>
                            <!-- <tr>
                            <th>সময়</th>
                            <th colspan="2">অনুষ্ঠানের টাইটেল</th>
                            </tr> -->
                            </thead>
                            <?php
                           // echo "<pre>";
                           // print_r($schedule);
                            ?>

                            <tbody>
                            <?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentKey => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:150px;border-left: 1px solid #d0d0d0 !important;"><?php echo e((!empty
                                    ($value->time))
                                    ?eng2bnNumber
                                    ($value->time)
                                    :''); ?></td>
                                    <td>
                                        <?php echo $value->chank; ?>
                                    </td>
                                    <td colspan="1">
                                        <?php 
                                            $program_info= get_schedule($plan_info->station_id,
                                            $plan_info->sub_station_id,
                                             $plan_info->date,$value->time);
                                         ?>
                                        <?php if($value->is_overwrite==true): ?>
                                            <?php echo e($value->overwrite_details); ?>

                                        <?php else: ?>
                                            <?php if(!empty($program_info)): ?>
                                                <a data-toggle="modal"
                                                   data-target="#exampleModal3"
                                                   onclick="programMagazineView('<?php echo e($program_info->id); ?>')"  href="#"> <?php echo e($program_info->program_name); ?></a>
                                            <?php else: ?>
                                                <?php echo e($value->biboron); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                     <td>
                                        <?php echo ($value->is_recorded==1) ? '<span class="glyphicon
                                glyphicon-ban-circle"></span>':
                                            'সজীব'; ?>
                                    </td>
                                    <td>
                                        <?php echo (!empty($value->stability ))? eng2bnNumber($value->stability)." মিনিট":''
                                        ; ?>
                                    </td>
                                     <td>
                                        <?php echo $value->comment; ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                   

                                   


                                   

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="8" style="border:1px solid #fff !important;padding-top:20px!important">
                                    <table class="print_table-no-border" style="width: 100%;border: 1px solid #fff
                                            !important;" rules="all">
                                        <tr>

                                            <td style="width:33%;text-align: left;font-size:11px;"
                                                class="no-border"><span
                                                        style="border-bottom:1px solid #333;">সহকারী
                                                            পরিচালক(উপস্থাপনা) : </span></td>
                                            <td style="width:33%;text-align: left;font-size:11px;"
                                                class="no-border"><span
                                                        style="border-bottom:1px solid #333;
">উপ-পরিচালক: </span></td>
                                            <td style="width:33%;text-align: left;font-size:11px;"
                                                class="no-border"><span
                                                        style="border-bottom:1px solid #333;">আঞ্চলিক পরিচালক/
                                                            পরিচালক: </span></td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </article>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>