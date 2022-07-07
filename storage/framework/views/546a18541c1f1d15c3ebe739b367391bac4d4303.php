<?php $__env->startSection('title_area'); ?>
    :: Organization Information   ::
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
                <h2>Organization Information </h2>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <?php echo Form::open(['url' => '/company_info_update', 'method' => 'post','class'=>'form-horizontal','files' => true,'enctype' => 'multipart/form-data']); ?>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Company Name</label>
                            <div class="col-md-4">
                                <input type="text" id="name" value="<?php echo e($company_data->com_name); ?>" class="form-control" placeholder="Company Name"  name="name">
                            </div>
                            <label class="col-md-2 control-label">Application Name </label>
                            <div class="col-md-4">
                                <input type="text" id="name" class="form-control" value="<?php echo e($company_data->apps_name); ?>" placeholder="Application Name"  name="apps_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-4">
                                <input type="text" id="email" value="<?php echo e($company_data->email); ?>" class="form-control" placeholder="Email"  name="email">
                            </div>
                            <label class="col-md-2 control-label">Mobile </label>
                            <div class="col-md-4">
                                <input type="text" id="mobile" value="<?php echo e($company_data->mobile); ?>" class="form-control" placeholder="Mobile"  name="mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Address</label>
                            <div class="col-md-4">
                                <textarea type="text" id="address" class="form-control" placeholder="address"  name="address"><?php echo e($company_data->address); ?></textarea>
                            </div>

                            <label class="col-md-2 control-label">Apps. Share Link </label>
                            <div class="col-md-4">
                                <textarea type="text" id="apps_link"  class="form-control" placeholder="Apps. Share Link"  name="apps_link"><?php echo e($company_data->apps_link); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Helpline</label>
                            <div class="col-md-4">
                                <input type="text" id="email" value="<?php echo e($company_data->helpline); ?>" class="form-control" placeholder="Helpline"  name="helpline">
                            </div>
                            <label class="col-md-2 control-label">Web Address </label>
                            <div class="col-md-4">
                                <input type="text" id="name" value="<?php echo e($company_data->web_address); ?>" class="form-control" placeholder="Web Address"  name="web_address">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Default Email</label>
                            <div class="col-md-4">
                                <input type="text" id="default_email_send" value="<?php echo e($company_data->default_email_send); ?>" class="form-control" placeholder="Default Email"  name="default_email_send">
                            </div>
                            <label class="col-md-2 control-label">Logo</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control"  value="" name="image"/>
                                <input type="hidden" id="old_image" value="<?php echo e($company_data->company_logo); ?>" name="old_image">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-offset-8 col-md-4">
                                <?php if( !empty($company_data->company_logo) && file_exists('images/logo/'.$company_data->company_logo) ): ?>
                                    <img class="img-thumbnail" src=" <?php echo e(url('images/logo/'.$company_data->company_logo)); ?>" style="height: 50px;width:100px;">
                                <?php else: ?>
                                    <img class="img-thumbnail" src=" <?php echo e(url('images/default/default-avatar.png')); ?>" style="height: 50px;width:100px;">
                                <?php endif; ?>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                            <input type="hidden" value="<?php echo e($company_data->id); ?>" name="setting_id" id="setting_id">
                        </div>
                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>