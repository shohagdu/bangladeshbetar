<?php $__env->startSection('title_area'); ?>
    :: Proposal ::  Presentation   ::
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
            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>উপস্থাপনা তথ্য সমুহ</h2>

                <a href="<?php  echo asset('/proposal_khata_presentation/regular');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i> প্রস্তাব  খাতা
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
                                <th> মাসের নাম</th>
                                <th>সর্বশেষ এন্ট্রি তারিখ ও সময়</th>
                                <th>পরিকল্পনাকারী</th>
                                <th style="width: 190px">আপডেট</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            $month_info=month_name_info();
                            ?>
                            <?php if(!empty($presentation_info)): ?>
                                <?php $__currentLoopData = $presentation_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style=" <?php echo e(((!empty($singleData->is_re_proposal)
                                    && $singleData->is_re_proposal==1)?("background: lightgray"):'')); ?>">
                                        <td>  <?php echo e($i++); ?></td>
                                        <td>  <?php echo e($singleData->name); ?></td>
                                        <td>  <?php echo e($singleData->fequencey_data); ?></td>
                                        <td>  <?php echo e($month_info[$singleData->months]); ?></td>
                                        <td>  <?php echo e(date('d-m-Y h:i a',strtotime($singleData->updated_time))); ?> </td>
                                        <td>  <?php echo e(!empty($singleData->presentation_created_by)?
                                       $singleData->created_by_title:''); ?></td>
                                        <td>
                                            
                                            
                                            

                                            <a href="<?php echo e(url('presentation_info_report/'.$singleData->months.'/'.$singleData->station_id.'/1')); ?>"
                                               class="btn btn-info btn-xs"><i class="glyphicon
                                               glyphicon-share-alt"></i> View
                                            </a>
                                            <a href="<?php echo e(url('presentation_info_report_date/'.$singleData->months.'/'.$singleData->station_id.'/1')); ?>"
                                               class="btn btn-info btn-xs"><i class="glyphicon
                                               glyphicon-share-alt"></i> View Date
                                            </a>
                                            <a href="<?php echo e(url('presentation_info_report_artist/'.$singleData->months.'/'
                                            .$singleData->station_id.'/1')); ?>"
                                               class="btn btn-info btn-xs"><i class="glyphicon
                                               glyphicon-share-alt"></i> Artist
                                            </a>


                                            <div class="col-sm-12"></div>
                                            <button onclick="planningAgainPresntation('<?php echo e($singleData->months); ?>',
                                                    '<?php echo e($singleData->station_id); ?>',2,1)"
                                                    class="btn btn-danger btn-xs"><i class="glyphicon
                                               glyphicon-backward"></i> Re-Planning
                                            </button>
                                            <button onclick="approvedPresentationInfo('<?php echo e($singleData->months); ?>',
                                                    '<?php echo e($singleData->station_id); ?>',3,1)"
                                                    class="btn btn-primary btn-xs"><i class="glyphicon
                                               glyphicon-ok-circle"></i> Contract
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