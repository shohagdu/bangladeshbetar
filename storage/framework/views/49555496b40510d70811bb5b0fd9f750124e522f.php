
<?php $__env->startSection('title_area'); ?>
:: <?php echo e($page_title); ?>  ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
<?php if(Session::has('message')): ?>
<div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
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
            <div class="col-sm-4">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>
            </div>
            <div class="col-sm-8">

                <a href="<?php echo e(url('program_magazine_create_form_new')); ?>" class="btn btn-primary btn-xs"
                   style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-plus"></i>
                    Add New
                </a>
                <a href="<?php echo e(url('program_proposal_khata')); ?>" class="btn btn-warning btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    পরিকল্পনা খাতা
                </a>

            </div>


            <!-- <a  href="<?php echo e(url('program_magazine_create_form_new')); ?>"     class="btn btn-primary btn-xs"
                    style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New(New Requirement)
                </a> -->



        </header>
        <div>
            <div class="widget-body no-padding">
                <div class="col-sm-12">
                    <div class="col-sm-12" style="margin-top:10px;"></div>
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th style="width:2%;">SL</th>

                                <th> আইডি</th>
                                <th> নাম</th>
                                <th> টাইফ</th>
                                <th> বিষয়/উদ্দেশ্য</th>
                                <th> ধরন</th>
                                <th> শিল্পীর নাম</th>
                                <th>রেকডিং তাং</th>
                                <th>প্রচার তাং</th>
                                <th>প্রযোজক</th>
                                <th>পরিকল্পনাকারী</th>

                                <th style="width: 130px"> #</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 1;
                            ?>
                            <?php if(!empty($get_program_planning_info)): ?>
                            <?php $__currentLoopData = $get_program_planning_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $program_organizer= !empty($singleData->program_organizer) ?json_decode
                                    ($singleData->program_organizer,true):'';

                                $replanning_info= !empty($singleData->replanning_info) ?json_decode($singleData->replanning_info,true):'';
                                ?>
                            <tr style="background: <?php echo ((!empty($replanning_info['is_replanning']) &&
                            $replanning_info['is_replanning']==1)?"#fce4d6
":"") ?> ">
                                <td> <?php echo e($i++); ?></td>

                                <td> <?php echo e($singleData->program_identity); ?></td>
                                <td> <?php echo e($singleData->program_name); ?></td>
                                <td> <?php echo e(($singleData->record_type==1)?"সজীব":(($singleData->record_type==2)
                                ?"বাণীবদ্ধ":(($singleData->record_type==3)?"এককালীন":'')
                                )); ?></td>
                                <td> <?php echo e($singleData->larget_viewer); ?></td>
                                <td> <?php echo e($singleData->program_type_title); ?></td>
                                <td>
                                    <?php
                                    $artist_info= !empty($singleData->get_all_artist_info) ?json_decode
                                    ($singleData->get_all_artist_info,true):'';
                                    if(!empty($artist_info)){
                                        $artist_name= array_column($artist_info,'artist_name');
                                        echo implode(",",$artist_name);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                       $record_dt= !empty($singleData->recorded_date) ?json_decode
                                       ($singleData->recorded_date,true):'';
                                       if(!empty($record_dt)){
                                            echo implode(",",$record_dt);
                                        }
                                    ?>
                                </td>
                                 <td>
                                    <?php
                                       $live_dt= !empty($singleData->live_date) ?json_decode
                                       ($singleData->live_date,true):'';
                                       if(!empty($live_dt)){
                                            echo implode(",",$live_dt);
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $program_organizer_data=(!empty($program_organizer[1]))?$program_organizer[1]:NULL;
                                    if(!empty($program_organizer_data)){
                                        $director='';
                                        foreach ($program_organizer_data as $info){
                                            $name=!empty($employee_info[$info])? $employee_info[$info]:'';
                                             $director.=  $name .",";
                                       }
                                        echo rtrim($director,",");
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $program_planner_data=(!empty($program_organizer[6]))?$program_organizer[6]:NULL;
                                    if(!empty($program_planner_data)){
                                        $planner='';
                                        foreach ($program_planner_data as $info){
                                            $name=!empty($employee_info[$info])? $employee_info[$info]:'';
                                            $planner.=  $name .",";
                                        }
                                        echo rtrim($planner,",");
                                    }
                                    ?>
                                </td>


                                

                                <td>
                                    <a href="<?php echo e(url('program_magazine_cost_view/'.$singleData->id)); ?>" title="View" class="btn btn-success btn-xs" style="margin-top:3px;">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>

                                    <a href="<?php echo e(url('program_magazine_update_form_new/'.$singleData->id)); ?>" title="Edit" class="btn btn-info btn-xs" style="margin-top:3px;">
                                        <i class="glyphicon glyphicon-pencil"></i> Edit
                                    </a>

                                    <!-- <a  href="<?php echo e(url('program_magazine_cost_form/'.$singleData->id)); ?>"
                                               title="Add Costing"
                                               class="btn btn-info btn-xs" style="margin-top:3px;">
                                                <i class="glyphicon glyphicon-credit-card"></i>
                                            </a> -->


                                    <button title="Delete" type="button" onclick="deleteProgramInfo('<?php echo e($singleData->id); ?>','0')" class="btn btn-danger btn-xs" style="margin-top:3px;">
                                        <i class="glyphicon glyphicon-trash"></i> Delete
                                    </button>
                                    <button title="Approved" type="button" onclick="approvedProgramInfo('<?php echo e($singleData->id); ?>','2')" class="btn btn-primary btn-xs" style="margin-top:3px;">
                                        <i class="glyphicon glyphicon-ok-sign"></i> Proposal
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</article>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>