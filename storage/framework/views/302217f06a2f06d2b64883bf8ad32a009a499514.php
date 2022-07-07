<?php $__env->startSection('title_area'); ?>
    :: Costing ::  Program  ::
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
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> Studio ::  Program  ::</h2>

                <a  href="<?php echo e(url('studio_information_form/'.$program_plan->id)); ?>"
                    title="Studio Information"   class="btn btn-primary btn-xs"
                    style="float:right;margin-top:5px;margin-right:5px;"><i
                        class="glyphicon glyphicon-pencil"></i>
                Update
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12" style="font-size:8px;">
                        <div class="col-sm-12"></div>

                        <table style="width:100%" class="table table-bordered" id="print_table">
                            <tr>
                                <td class="text-bold">অনুষ্ঠানের আইডি</td>
                                <td>
                                    <?php echo e(!empty($program_plan->program_identity)?$program_plan->program_identity:''); ?>

                                </td>
                                <td colspan="2" style="font-size:15px !important;" class="text-bold"><?php echo e((!empty
                                ($program_plan->record_type) &&
                                ($program_plan->record_type==1))
                                    ?'সজীব':(!empty($program_plan->record_type) && ($program_plan->record_type==2))
                                    ?"রেকর্ড":""); ?></td>



                            </tr>

                            <tr>
                                <td class="text-bold width20per">অনুষ্ঠানের নাম</td>
                                <td  style="font-size:15px !important;" class="text-bold width30per">

                                    <?php echo e($program_plan->program_name); ?>

                                </td>
                                <td class="text-bold width20per">কেন্দ্র</td>
                                <td class="width30per">

                                    <?php echo e(!empty($program_plan->station_name)?$program_plan->station_name:''); ?>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">নিদিষ্ট অনুষ্ঠান সূচি</td>
                                <td >
                                    <?php
                                    $torimasik_porikolpona_info=torimasik_porikolpona_info();
                                    $fixed_onusan_suchy_info=fixed_onusan_suchy_info();
                                    if(!empty($program_plan->fixed_onusan_suchy)){
                                        echo  $fixed_onusan_suchy_info[$program_plan->fixed_onusan_suchy];
                                    }
                                    ?>
                                </td>
                                <td class="text-bold">ত্রৈমাসিক পরিকল্পনা </td>
                                <td ><?php echo e(!empty($program_plan->torimasik_porikolpona)
                                ?$torimasik_porikolpona_info[$program_plan->torimasik_porikolpona]:''); ?> <?php echo e(!empty
                                ($program_plan->bangla_son)?
                                '('.$program_plan->bangla_son.")":''); ?>  </td>

                            </tr>

                            <tr>
                                <td class="text-bold">অনুষ্ঠানের ধরন</td>
                                <td >
                                    <?php echo e(!empty($program_plan->program_type_title)?$program_plan->program_type_title:''); ?>

                                </td>
                                <td class="text-bold">অনুষ্ঠানের  স্থিতি  </td>
                                <td>
                                    <?php echo e(!empty($program_plan->dolar_name)?$program_plan->recording_stabilty:''); ?>

                                </td>
                            </tr>
                            <?php if($program_plan->sub_fixed_program_type_id>0): ?>
                                <tr>
                                    <td class="text-bold">বার্ষিকী অনুষ্ঠানের ধরন (উৎসব ও বার্ষিকী) </td>
                                    <td>
                                        <?php echo e(!empty($program_plan->fixed_program_name)?$program_plan->fixed_program_name:''); ?>

                                    </td>

                                    <td class="text-bold">বিবরন</td>
                                    <td>
                                        <?php echo e(!empty($program_plan->fixed_sub_program_title)?$program_plan->fixed_sub_program_title:''); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php if($program_plan->dologot_poribashona>0): ?>
                                <tr>
                                    <td class="text-bold">দলের নাম (উৎসব ও বার্ষিকী) </td>
                                    <td>
                                        <?php echo e(!empty($program_plan->dolar_name)?$program_plan->dolar_name:''); ?>

                                    </td>

                                    <td class="text-bold">দলের তথ্য</td>
                                    <td>
                                        <?php echo e(!empty($program_plan->dolar_info)?$program_plan->dolar_info:''); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>





                            <tr>
                                <td class="text-bold">রেকর্ডিং তারিখ</td>
                                <td>
                                    <?php
                                    if (!empty($program_plan->recorded_date)) {
                                        $recorded_dt = !empty($program_plan->recorded_date) ? json_decode
                                        ($program_plan->recorded_date, true) : '';
                                        echo implode(",", $recorded_dt);
                                    }
                                    ?>

                                </td>

                                <td class="text-bold">রেকর্ডিং সময়</td>

                                <td>
                                    <?php echo e($program_plan->recorded_time); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-bold">প্রচার তারিখ</td>

                                <td>

                                    <?php
                                    if (!empty($program_plan->live_date)) {
                                        $live_dt = !empty($program_plan->live_date) ? json_decode
                                        ($program_plan->live_date, true) : '';
                                        echo implode(",", $live_dt);
                                    }
                                    ?>
                                </td>

                                <td class="text-bold">প্রচার সময়</td>

                                <td>
                                    <?php echo e($program_plan->live_time); ?>

                                </td>
                            </tr>




                            <tr>
                                <td class="text-bold">উদ্দেশ্য</td>
                                <td colspan="3"><?php echo e($program_plan->larget_viewer); ?> </td>
                            </tr>

                            <?php if($program_plan->dologot_poribashona==1): ?>
                                <tr>
                                    <td class="text-bold">দলগত পরিবেষনা- দলের নাম</td>
                                    <td ><?php echo e($program_plan->dolar_name); ?> </td>
                                    <td>দলের তথ্য</td>
                                    <td ><?php echo e($program_plan->dolar_info); ?> </td>
                                </tr>
                            <?php endif; ?>


                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <form id="update_program_planning_form">
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2">স্টুডিও বিবরন</th>
                                </tr>
                                <tr>
                                    <td>স্টুডিও  আইডি</td>
                                    <td>
                                        <?php echo e($program_plan->studio_id); ?>

                                    </td>
                                </tr>


                                <tr>
                                    <th style="width:30%;">দ্বায়িত্ব</th>
                                    <th>দ্বায়িত্ব প্রাপ্ত ব্যাক্তির নাম</th>
                                </tr>
                                <?php
                                $studio_infos = json_decode($program_plan->studio_infos,true);
                                //                                 print_r($studio_infos);exit;
                                foreach ($studio_description as $key=> $title) {
                                ?>
                                <tr>
                                    <td>
                                      <?php echo e($title); ?>


                                    </td>

                                    <td>

                                            <?php 
                                                $all_val='';
                                             ?>
                                            <?php if(!empty($employee_info)): ?>
                                                <?php $__currentLoopData = $employee_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ekey => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                   $all_val.= is_array($studio_infos) && isset($studio_infos[$key]) &&
                                                    in_array($ekey,$studio_infos[$key]) ? $value." ," : ''
                                                ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(!empty($all_val) ?rtrim($all_val,','):''); ?>

                                            <?php endif; ?>

                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td><b> স্ট্যাটাস</b></td>
                                    <td>
                                        Archive <input type="checkbox" <?php echo e($program_plan->is_archived==1?'checked':false); ?> name="archive" value="1"/>
                                        Supply  <input type="checkbox" <?php echo e($program_plan->is_supply==1?'checked':false); ?> name="supply" value="1"/>
                                    </td>
                                </tr>

                            </table>
                            <span class="text-left" id="form_output"></span>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </article>
    <style>
        #print_table td {
            font-size: 11px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px !important;
        }

        #print_table th {
            font-size: 11px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px !important;
        }

        #table-style td {
            font-size: 11px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px !important;
        }

        #table-style th {
            font-size: 11px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px !important;
        }
        .text-bold {
            font-weight: bold;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>