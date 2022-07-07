
<?php $__env->startSection('title_area'); ?>
    :: User Access Control ::
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
    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px" >
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" >
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 id="title_info_print">User Access Control </h2>
                <div class="no-print">
                    <button type="button" onclick="back()" class="btn btn-danger btn-xs topbarbutton"><i
                                class="glyphicon glyphicon-backward"></i>
                        Back
                    </button>
                </div>
            </header>
            <div>
                <div class="widget-body no-padding"  >
                    <div class="col-sm-12" >
                        <div class="col-sm-12 margin-top-10px" style="margin-top:10px"></div>
                        <div class="no-print">
                            <?php echo Form::open(['url' => '', 'method' => 'post', 'id' => 'user_access_info_form',
                            'class'=>'form-horizontal']); ?>

                            <?php
                              //  echo "<pre>";
                              // print_r($role_info);
                            //   print_r($role_info['main_menu']);
                              //  print_r($role_info['sub_menu']);
                            ?>
                            <table class="table table-bordered " style="width:100%">
                                <tr>
                                    <td colspan="2" style="float:right;font-weight: bold;"><input type="checkbox"
                                                                                              id="checkAll"> All
                                        Checked</td>
                                </tr>
                                <?php
                                    foreach ($role_info['modules'] as  $modules){

                                ?>
                                    <tr>
                                        <th ><?php echo $modules->title ?></th>
                                    </tr>
                                    <?php

                                    foreach ($role_info['main_menu'] as  $main_menu){
                                    if($main_menu->parent_id==$modules->id){

                                    ?>
                                    <tr>
                                        <td>

                                            <table class="table-bordered" style="width:100%" id="table-style">
                                                <tr>
                                                    <td colspan="2">
                                                        <?php  echo $main_menu->title ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                foreach ($role_info['sub_menu'] as  $sub_menu){


                                                    if($sub_menu->parent_id==$main_menu->id){
                                                ?>
                                                    <tr>
                                                        <td style="width:30%"><?php echo $sub_menu->title ?></td>
                                                        <td>
                                                            <?php echo $sub_menu->id; ?>
                                                            <div class="checkbox">
                                                            <label><input value="<?php echo e($sub_menu->id); ?>" name="access[<?php echo e($modules->link); ?>][<?php echo e($main_menu->link); ?>][<?php echo e($sub_menu->link); ?>][add]"
                                                                          type="checkbox"
                                                                          value="">Add</label>
                                                            <label><input  value="<?php echo e($sub_menu->id); ?>" name="access[<?php echo e($modules->link); ?>][<?php echo e($main_menu->link); ?>][<?php echo e($sub_menu->link); ?>][edit]"
                                                                          type="checkbox" value="">Edit</label>
                                                            <label><input  value="<?php echo e($sub_menu->id); ?>" name="access[<?php echo e($modules->link); ?>][<?php echo e($main_menu->link); ?>][<?php echo e($sub_menu->link); ?>][delete]"
                                                                          type="checkbox" value="">Delete</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } } ?>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php } ?>


                                <?php } } ?>

                            </table>
                            <div id="form_output"></div>
                            <div class="modal-footer">
                                <button type="button" onclick="createUserAccess()" id="updateBtn" class="btn
                                btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                                <input type="hidden" value="<?php echo e($segment2 =  Request::segment(2)); ?>"  name="user_id"
                                       id="user_id">

                            </div>

                            <?php echo Form::close(); ?>

                        </div>
                        <div class="clearfix"></div>


                    </div>
                </div>
            </div>
        </div>
    </article>
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>