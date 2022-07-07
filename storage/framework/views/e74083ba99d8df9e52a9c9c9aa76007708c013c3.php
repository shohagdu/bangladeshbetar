
<?php $__env->startSection('title_area'); ?>
    :: কিউসিট রিপোট ::
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
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> কিউসিট রিপোট</h2>
                <button onclick="back()"  class="btn btn-danger
                btn-xs no-print" style="float:right; margin-top:5px;margin-right:5px;
"><i class="glyphicon glyphicon-backward"></i> Back
                </button>
                <a href=" <?php  echo asset('/odivision_program_queue_sheet');?>" class="btn
                btn-primary
                btn-xs no-print" style="float:right; margin-top:5px;margin-right:5px;
"><i class="glyphicon glyphicon-backward"></i> List
                </a>
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
                        <table class="table table-bordered table-striped" style="width: 100%;">
                            <?php
                            if(!empty($presentation_info)){
                            foreach ($presentation_info as $odivision_id=>$odivision_wise_artist){
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
                                <?php $__currentLoopData = $role_data_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td>
                                        <table id="table-style" style="width:100%;">
                                            <tr>
                                                <th>নাম</th>
                                                <th>হাজিরা</th>
                                                <th>লগ</th>
                                                <th nowrap>লগ বহি </th>
                                                <th>মন্তব্য</th>
                                            </tr>
                                        <?php
                                            foreach ($odivision_wise_artist as $role_id=>$artist_info){
                                               if($role_id==$role_title){
                                                   ?>
                                                        <?php
                                                            foreach ($artist_info as $art_key=>$artist_info){
                                                        ?>
                                                        <tr>
                                                            <td nowrap=""><?php echo e(!empty($artist_info['name'])?
                                                            $artist_info['name']:''); ?></td>
                                                            <td><?php echo e(!empty($artist_info['is_present'] &&
                                                            $artist_info['is_present']==1 )?
                                                            'উপস্থিত':'অনুপস্থিত'); ?></td>
                                                            <td>
                                                                <?php echo e((!empty($artist_info['log_type']) &&
                                                            $artist_info['log_type']==1)?
                                                            'জোড়':''); ?>

                                                                <?php echo e((!empty($artist_info['log_type']) &&
                                                            $artist_info['log_type']==2)?
                                                            'বিজোড়':''); ?>


                                                            </td>
                                                            <td><?php echo e(!empty($artist_info['log_book_no'])?
                                                            $artist_info['log_book_no']:''); ?></td>
                                                            <td><?php echo e(!empty($artist_info['presentation_comments'])?
                                                            $artist_info['presentation_comments']:''); ?></td>

                                                        </tr>
                                                        <?php } ?>

                                        <?php
                                                }
                                            }
                                        ?>
                                        </table>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tr>
                           <?php
                            }
                            }
                            ?>
                        </table>




                        <table class="table-bordered table print_table" id="table-style">

                            <thead>
                            <tr>
                                <th class="width8per">সময়</th>
                                <th class="width15per">চাংক</th>
                                <th>অনুষ্ঠানের নাম/ বিবরন</th>
                                <th class="width10per">স্থিতি</th>

                                <th style="width:90px;">রেকর্ড</th>
                                <th style="width:80px;">বিচ্যুতি</th>
                                <th style="width:100px;">ত্রুটি</th>
                                <th class="width15per">মন্তব্য</th>
                            </tr>
                            <!-- <tr>
                            <th>সময়</th>
                            <th colspan="2">অনুষ্ঠানের টাইটেল</th>
                            </tr> -->
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentKey => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:150px;">
                                        <?php echo e((!empty($value->time))?eng2bnNumber($value->time):''); ?>

                                        <input type="hidden" name="time[]" value="<?php echo e((!empty($value->time))?
                                        $value->time:''); ?>" >
                                    </td>
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
                                                   onclick="programMagazineView('<?php echo e($program_info->id); ?>')" href="#"> <?php echo e($program_info->program_name); ?></a>
                                            <?php else: ?>
                                                <?php echo e($value->biboron); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo (!empty($value->stability)) ? eng2bnNumber($value->stability) . " মিনিট" : ''; ?>
                                    </td>


                                    <td>
                                        <?php echo e((!empty($value->odivision_record_type) &&
                                            $value->odivision_record_type==1)
                                                     ?"হ্যাঁ":''); ?>

                                        <?php echo e((!empty($value->odivision_record_type) && $value->odivision_record_type==2)
                                                     ?"না":''); ?>


                                    </td>
                                    <td>
                                        <?php if(!empty($value->bicuti_reason)): ?>
                                            <table class=" table-bordered presentation-details">
                                                <?php
                                                $bicuti_reason_info=(!empty($value->bicuti_reason))
                                                    ?$value->bicuti_reason:NULL;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e((!empty($bicuti_reason_info->bicuti_reason))?
                                                        $bicuti_reason_info->bicuti_reason:''); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e((!empty($bicuti_reason_info->bicuti_time_start))?
                                                        $bicuti_reason_info->bicuti_time_start:''); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e((!empty($bicuti_reason_info->bicuti_time_end))?
                                                        $bicuti_reason_info->bicuti_time_end:''); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e((!empty($bicuti_reason_info->bicuti_stability))?
                                                        $bicuti_reason_info->bicuti_stability:''); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e((!empty($bicuti_reason_info->bicuti_comments))?
                                                        $bicuti_reason_info->bicuti_comments:''); ?>

                                                    </td>




                                                </tr>

                                            </table>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e((!empty($value->truti_info) && $value->truti_info==1)
                                                     ?"সঠিক":''); ?>

                                           <?php echo e((!empty($value->truti_info) && $value->truti_info==2)
                                                     ?"ত্রুটি":''); ?>

                                        </select>
                                    </td>
                                    <td>
                                         <?php echo e((!empty($value->comments))
                                                     ?$value->comments:''); ?>

                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <style>
        .presentation-details td{
            padding:5px;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>