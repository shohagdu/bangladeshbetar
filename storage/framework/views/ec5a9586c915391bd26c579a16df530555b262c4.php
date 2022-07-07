<?php $__env->startSection('title_area'); ?>
    :: Details Land Information ::

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

    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Details Land Information </h2>
                <a href="<?php  echo asset('/land_info/');?>"
                   class="btn btn-primary btn-xs topbarbutton"><i
                            class="glyphicon glyphicon-backward"></i>
                    Land Record
                </a>

                <a href="<?php  echo asset('/details_land_info/' . $land_info->id . '/pdf');?>"
                   class="btn btn-warning btn-xs topbarbutton"><i
                            class="glyphicon glyphicon-download"></i>
                    PDF Download
                </a>

            </header>
            <div style="margin-bottom:50px;">
                <div class="widget-body no-padding" style="padding-bottom:50px;">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px"></div>
                        <table class="width100per" id="employee_details">
                            <tr>
                                <td colspan="4" class="no-border">
                                    <table class="width100per">
                                        <tr>
                                            <td class="width10per vertical-align-top no-border">
                                                <?php if( !empty(session('company_logo')) && file_exists('images/logo/'.session('company_logo')) ): ?>
                                                    <img src=" <?php echo e(url('images/logo/'.session('company_logo'))); ?>"
                                                         alt="Bangladesh Betar"
                                                         style="height: 80px;width:113px;">
                                                <?php else: ?>
                                                    <img src=" <?php echo e(url('images/default/default-avatar.png')); ?>"
                                                         alt="Bangladesh Betar"
                                                         style="height: 80px;width:113px;">
                                                <?php endif; ?>

                                            </td>
                                            <td class="width80per vertical-align-top no-border">
                                                <div class="bold font-size-18px"><?php echo e($company_info->com_name); ?></div>
                                                <div class="bold"><?php echo e($company_info->address); ?></div>
                                                <div class="bold">Email: <?php echo e($company_info->email); ?>,
                                                    Mobile: <?php echo e($company_info->mobile); ?></div>
                                                <div class="bold">Website: <?php echo e($company_info->web_address); ?></div>
                                            </td>
                                            <td class="width10per vertical-align-top no-border">
                                            </td>
                                        </tr>

                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="employee-details-heading">Land Information</td>
                            </tr>

                            <tr>
                                <th class="width20per">Land No</th>
                                <td class="width30per">: <?php echo e($land_info->land_no); ?> </td>
                                <th class="emp-text-right width20pert">Branch Name</th>
                                <td class="width30per">: <?php echo e((!empty($land_info->station_id)?get_branch_name( $land_info->station_id):'')); ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td colspan="3">: <?php echo e($land_info->location); ?></td>

                            </tr>
                            <tr>
                                <th>Details</th>
                                <td colspan="3">: <?php echo e($land_info->details); ?></td>

                            </tr>
                            <tr>
                                <th >Khotian No</th>
                                <td >: <?php echo e($land_info->khotian_no); ?></td>
                                <th class="emp-text-right" >Dag No</th>
                                <td>: <?php echo e($land_info->dag_no); ?></td>
                            </tr>
                            <tr>
                                <th >Mouza No</th>
                                <td >: <?php echo e($land_info->mouza_no); ?></td>
                                <th class="emp-text-right" >Zer No</th>
                                <td>: <?php echo e($land_info->zer_no); ?></td>
                            </tr>
                            <tr>
                                <th>Area </th>
                                <?php 
                                    $area_info = App\All_stting::find($land_info->area);    
                                 ?>
                                <td >: <?php echo e($area_info->title); ?></td>
                                <th class="emp-text-right" >Land Quantity</th>
                                <td>: <?php echo e($land_info->land_quantity); ?></td>
                            </tr>
                            <tr>
                                <th >Last Payment Tax DT</th>
                                <td >: <?php echo e($land_info->last_date_tax); ?></td>
                                <th >Has Case</th>
                                <td colspan="3" >: <?php echo e(($land_info->is_found_case==1)?"No":"Yes"); ?></td>
                            </tr>
                            <?php if($land_info->is_found_case==2): ?>
                                <tr>
                                    <th >Case Details</th>
                                    <td >: <?php echo e($land_info->case_details); ?></td>
                                    <th class="emp-text-right" >Case Update</th>
                                    <td>: <?php echo e($land_info->case_last_update); ?></td>
                                </tr>
                                <tr>
                                    <th >Case Status</th>
                                    <td colspan="3">: <?php echo e(($land_info->case_status!='')?(($land_info->case_status==1)?"Pending":"Complete"):''); ?></td>
                                </tr>
                            <?php endif; ?>










                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_state", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>