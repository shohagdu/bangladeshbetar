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
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>
                <a href="<?php echo e(url('recording_performance_khata')); ?>" class="btn btn-info btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    রেকর্ডিং/পারফরমেন্স  খাতা
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
                                <th>অনু: আইডি</th>
                                <th> শিল্পীর নাম </th>

                                <th> মোবাইল</th>
                                <th> ঠিকানা</th>
                                <th>অনুষ্ঠানের নাম</th>
                                <th> ধরন</th>
                                <th>রেকডিং তারিখ</th>
                                <th>রেকডিং সম্পন্ন হওয়া তারিখ</th>

                                <th style="width: 130px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                                 $i = 1;
                             //    echo "<pre>";
                             //    print_r($get_program_planning_info);
                               //  exit;
                            ?>
                            <?php if(!empty($get_program_planning_info)): ?>
                                <?php $__currentLoopData = $get_program_planning_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($i++); ?>

                                        </td>

                                        <td> <?php echo e($singleData['program_identity']); ?></td>
                                        <td> <?php echo e($singleData['artist_name']); ?></td>
                                        <td>
                                            <?php
                                                if(!empty($singleData['artist_mobile'])){
                                                   $artist_mobile= json_decode($singleData['artist_mobile'],true);
                                                    echo $artist_mobile[0];
                                                }
                                            ?>
                                        </td>
                                        <td> <?php echo e($singleData['address']); ?></td>
                                        <td> <?php echo e($singleData['program_name']); ?></td>
                                        <td> <?php echo e($singleData['program_type_title']); ?></td>
                                        <td> <?php echo e($singleData['record_date']); ?></td>



                                         <td>
                                             <?php echo e((!empty($singleData['attend_date']))
                                             ?$singleData['attend_date']:''); ?>

                                         </td>

                                        <td>
                                            <a href="<?php echo e(url('program_magazine_cost_view/'.$singleData['id'])); ?>" title="View" class="btn btn-success btn-xs" style="margin-top:3px;">
                                                <i class="glyphicon glyphicon-eye-open"></i> View
                                            </a>
                                            <button title="Move to Account" type="button"
                                                    onclick="RecordingListToWaitingAccount('<?php echo e($singleData['id']); ?>','5')"
                                                    class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-ok-sign"></i> Account
                                            </button>


                                            <div class="col-sm-12" style="height: 3px;"></div>
                                            <button title="Edit" type="button" data-toggle="modal"
                                                    data-target="#exampleModal4"
                                                    class="btn btn-info btn-xs"
                                                    onclick="checkBroadcastInfo('<?php echo e($singleData['id']); ?>',
                                                            '<?php echo e($singleData['attend_date']); ?>',
                                                            '<?php echo e($singleData['record_date']); ?>');"
                                                    class="btn btn-info btn-xs">
                                                <i class="glyphicon glyphicon-record"></i> Recording Now
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
    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:40%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel4">  রেকডিং তথ্য
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>

                <div class="modal-body">
                    <form action="" method="post" id="broadcast_form">

                        <div class="checkbox">
                            <label><input type="checkbox" id="is_recorded" name="is_recorded" onclick="is_recorded_check(this);"> রেকর্ড সম্পন্ন হয়েছে ?</label>
                           <div class="col-sm-12" style="height: 20px;"></div>
                            <input type="text" class="form-control datepickerLong" placeholder="রেকর্ড তারিখ" name="record_complete_date" id="record_complete_date"/>
                        </div>
                        <br/>

                        <div class="modal-footer">
                            <div class=" col-sm-7 text-left">
                                <span class="text-left" id="form_output"></span>
                            </div>
                            <div class=" col-sm-5">

                                <button type="button" id="broadcastbtn" class="btn
                                btn-success" onclick="saveBroadcastInfo();"><i
                                            class="glyphicon glyphicon-save"></i> Save
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="glyphicon glyphicon-remove"></i> Close
                                </button>
                                <input type="hidden" value="" name="programid" id="programid">
                                <input type="hidden" value="" name="record_date" id="record_date">
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>