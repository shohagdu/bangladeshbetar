<?php $__env->startSection('title_area'); ?>
    :: Add ::  Presentation  ::

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
                <h2>উপস্থাপনা সেটিংস তথ্য সমুহ</h2>
                <a href="<?php  echo asset('/add_presentation_setting');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> কেন্দ্রের / ইউনিট নাম</th>
                                <th> ফ্রিকোয়েন্সি</th>
                                <th>এন্ট্রি সময়</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            <?php if(!empty($presentation_setting_info)): ?>

                                <?php $__currentLoopData = $presentation_setting_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>  <?php echo e($i++); ?></td>
                                        <td>  <?php echo e($singleData->station_name); ?></td>
                                        <td>  <?php echo e($singleData->fequencey_data); ?></td>
                                        <td>  <?php echo e(date('d-m-Y',strtotime($singleData->created_time))); ?> </td>
                                        <td>




                                            <a href="<?php echo e(url('presentation_setting_info_report/'.$singleData->id)); ?>"
                                               class="btn btn-success btn-xs"><i class="glyphicon
                                               glyphicon-share-alt"></i> View
                                            </a>
                                            <button onclick="deletePresentationSetting('<?php echo e($singleData->id); ?>')"
                                               class="btn btn-danger btn-xs"><i class="glyphicon
                                               glyphicon-trash"></i> Delete
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
    <!-- Modal -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>