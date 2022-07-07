
<?php $__env->startSection('title_area'); ?>
    :: Planning ::  Presentation   ::
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
                <h2>পারফরমেন্স তথ্য সমুহ</h2>

                <a href="<?php  echo asset('/performance_info_add');?>"
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
                                <th> কেন্দ্র / ইউনিট নাম</th>
                                <th> ফ্রিকোয়েন্সি</th>
                                <th>পারফরমেন্স  তারিখ</th>
                                <th> মাসের নাম</th>
                                <th> এন্ট্রি তারিখ ও সময়</th>
                                <th>পরিকল্পনাকারী</th>
                                <th style="width: 120px">আপডেট</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            $month_info=month_name_info();
                            ?>
                            <?php if(!empty($performance_info)): ?>
                                <?php $__currentLoopData = $performance_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style=" <?php echo e(((!empty($singleData->is_re_planning)
                                    && $singleData->is_re_planning==1)?("background: lightgray"):'')); ?>">
                                        <td>  <?php echo e($i++); ?></td>
                                        <td>  <?php echo e($singleData->name); ?></td>
                                        <td>  <?php echo e(!empty($singleData->fequencey_data)?
                                        $singleData->fequencey_data:''); ?></td>
                                        <td>  <?php echo e(!empty($singleData->performance_date)?
                                        date('d-m-Y',strtotime($singleData->performance_date)):''); ?></td>
                                        <td>  <?php echo e($month_info[$singleData->month_id]); ?></td>
                                        <td>  <?php echo e(date('d-m-Y h:i a',strtotime($singleData->created_time))); ?> </td>
                                        <td>  <?php echo e(!empty($singleData->performance_created_by)?
                                        $singleData->performance_created_by:''); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('view_performance_info/'.$singleData->performance_date.'/'
                                            .$singleData->station_id.'/'.$singleData->fequencey_id)); ?>"
                                               class="btn btn-info btn-xs"><i class="glyphicon
                                               glyphicon-share-alt"></i> View
                                            </a>
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