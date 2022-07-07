
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">

        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon no-print"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print"> উৎসবাদী ও বার্ষিকীর তালিকা</h2>
                <button type="button" class="btn btn-primary btn-xs no-print" style="float:right;margin-top:5px;
                margin-right:5px;"><i class="glyphicon glyphicon-print"></i>
                    Print
                </button>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="print_table-no-border "  id="table-style" style="width:100%;border: 1px solid #fff
                    !important;">
                            <tr>
                                <td  style="text-align: center;width:40%;border: 1px solid #fff !important;
                                padding-bottom:20px !important;" >
                                    <img src = "<?php echo e(url('images/logo/logo.jpg')); ?>" style="height:50px; margin:0px;
                                    padding:0px;"/>
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>
                                    <div style="font-size:15px;font-weight: bold;"> বাংলাদেশ বেতার  </div>
                                    <b><u>উৎসবাদী ও বার্ষিকীর তালিকা  </u></b>
                                </td>
                            </tr>
                        </table>

                        <table  id="table-style"  style="border-top: 1px solid #fff !important;" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:2%;border-top:1px solid #d0d0d0 !important;;"> নং</th>
                                    <th style="border-top:1px solid #d0d0d0 !important;" class="width40per">বিবরণ</th>
                                    <th style="border-top:1px solid #d0d0d0 !important;;" nowrap="" class="width38per">
                                        বাংলা/ইংরেজী/আরবি প্রচার তারিখ </th>
                                    <th style="border-top:1px solid #d0d0d0 !important;;" class="width20per"> মন্তব্য </th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i=1;
//                                                            echo "<pre/>";
//                            print_r($event_report);
//                            exit;
                            ?>
                            <?php if(!empty($event_report)): ?>
                                <?php $__currentLoopData = $event_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th colspan="4" style="text-align: center;font-size:18px;"><?php echo e($event->name); ?></th>
                                    </tr>
                                    <?php if(count($event->all_data)>0): ?>
                                        <?php $__currentLoopData = $event->all_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_all_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($i++); ?></td>
                                                <td  ><?php echo e($event_all_data->name); ?></td>
                                                <td ><?php echo e((!empty($event_all_data->description))?
                                                $event_all_data->description.' - ':""); ?>  <?php echo e((!empty($event_all_data->event_date ) && $event_all_data->event_date!='0000-00-00')?eng2bnNumber(date('d F',
                                               strtotime
                                               ($event_all_data->event_date ))) :''); ?> </td>
                                                <td ><?php echo e($event_all_data->comments); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4"  style="text-align: center">কোন তথ্য পাওয়া যায় নাই</td>
                                        </tr>
                                    <?php endif; ?>


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="border: 1px solid #fff !important;text-align: right">
                                         Page
                                    </td>
                                </tr>

                            </tfoot>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>