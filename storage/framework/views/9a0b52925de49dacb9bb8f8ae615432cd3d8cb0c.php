<?php $__env->startSection('title_area'); ?>
    :: অনুমোদিত কিউসিট    ::
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
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> অনুমোদিত কিউসিট</h2>
               

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th>তারিখ</th>
                                <th>বার</th>
                                <th>কেন্দ্রের  নাম</th>
                                <th>
                                    ফ্রিকোয়েন্সি</th>
                                <th>Approved By</th>
                                
                                <th style="width: 20%">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            ?>
                            <?php if(!empty($broadcast_info)): ?>
                                <?php $__currentLoopData = $broadcast_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php  
                                        $sub_station = get_branch($info->sub_station_id);
                                     ?>
                                    <tr>
                                        <td>  <?php echo e($i++); ?></td>
                                        <td>  <?php echo e(!empty($info->date)? date('d-m-Y',strtotime($info->date)):''); ?></td>
                                        <td>  <?php echo e($info->title_bn); ?></td>
                                        <td>  <?php echo e($info->station_name); ?></td>
                                        <td>  <?php echo e($info->fequencey_data); ?></td>

                                        <td> <?php echo e(!empty($info->approved_by)?$employee_info[$info->approved_by]:''); ?> </td>
                                        <td>
                                            <!--- update operation working on next time --->
                                            <a title="View" href="<?php  echo asset("/view_quesheet_info/"
                                                .$info->id);?>" class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-share-alt"></i> View
                                            </a>
                                            
                                            
                                            <button type="button" title="Print"  class="btn btn-info btn-xs">
                                                <i class="glyphicon glyphicon-print"></i> Print
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