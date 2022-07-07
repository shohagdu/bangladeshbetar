<?php $__env->startSection('title_area'); ?>
    :: <?php echo e($page_title); ?>  ::
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
                <h2> <?php echo e($page_title); ?></h2>

                <button type="button"data-toggle="modal" onclick="ArchiveAddSetupInfo()" data-target="#exampleModal" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-plus"></i>
                    Add New
                </button>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> নাম</th>
                                <th> স্ট্যটাস</th>
                                <th> তৈরির সময়</th>
                                <th> সর্বশেষ আপডেট</th>
                                <th style="width: 20%"> #</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>  <?php echo e($i++); ?></td>
                                    <td>  <?php echo e($singleData->name); ?></td>
                                    <td class="<?php echo e(($singleData->is_active==1)?"Active":"Inactive"); ?>">  <?php echo e(($singleData->is_active==1)?"Active":"Inactive"); ?></td>
                                    <td>  <?php echo e(!empty($singleData->created_time)?date("Y-m-d H:i:A",strtotime($singleData->created_time)):''); ?></td>
                                    <td>  <?php echo e(!empty($singleData->updated_time)?date("Y-m-d H:i:A",strtotime($singleData->updated_time)):''); ?></td>
                                    <td>
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick="UpdateSetupInfo('<?php echo e($singleData->id); ?>','<?php echo e($singleData->name); ?>','<?php echo e($singleData->is_active); ?>')" class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        <button type="button" onclick=" ArchiveTypeDelete('<?php echo e($singleData->id); ?>')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </button>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e($page_title); ?></h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <?php echo Form::open(['url' => '/save_archive_type', 'id' => 'type_setup_form','method' => 'post','class'=>'form-horizontal']); ?>

                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e($page_title); ?></label>
                            <div class="col-md-9">
                                <input type="text"  id="title" class="form-control" placeholder="<?php echo e($page_title); ?>"  value="" name="name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">স্ট্যটাস</label>
                            <div class="col-md-9">
                                <select  id="is_active" class="form-control" required  name="is_active">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6 text-left">
                        <div id="form_output"></div>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" onclick="ArchivesaveSetupInfo('save_archive_type')" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                        <button type="button" onclick="ArchivesaveSetupInfo('save_archive_type')" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                        <input type="hidden" name="setting_id" id="setting_id">

                        <input type="hidden" value="2" name="type" id="type">
                        <input type="hidden" value="program_type_setup" name="redirect_page" id="redirect_page">

                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>