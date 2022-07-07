<?php $__env->startSection('title_area'); ?>
    :: নতুন ::  পারফরমেন্স যোগ করুন  ::
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
                <h2>পারফরমেন্স  তথ্য সমুহ</h2>
                <a href="<?php  echo asset('/performance_info');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    পারফরমেন্স তথ্য সমুহ
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'save_performance_info_form',
                        'class'=>'form-horizontal']); ?>


                        <div class="col-sm-12" style="margin-top:10px;">
                            <div class="form-group">
                                <label class="col-md-2 control-label">কেন্দ্রের / ইউনিট নাম </label>
                                <div class="col-md-2">
                                    <select id="station_id"  required class="form-control" onchange="getSubStation(this.value)"  name="station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                        <?php if(!empty($station_info)): ?>
                                            <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <label class="col-md-1 control-label"> ফ্রিকোয়েন্সি</label>
                                <div class="col-md-3">
                                    <select id="sub_station_id" onchange="get_fequencey_wise_presentation_info(this
                                    .value,$
                                    ('#station_id').val() )" required class="form-control"
                                            name="sub_station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>


                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="performance_data" placeholder="Enter Date"  required
                                           class="form-control datepicker" name="performance_data">

                                </div>
                                <div class="col-md-2">
                                    <button type="button" onclick="searching_performance_info()"
                                            id="search_performance_info"  required class="btn
                                    btn-success btn-sm"
                                            name="search_presentation_info"><i class="glyphicon
                                            glyphicon-search"></i> Search
                                    </button>
                                </div>
                            </div>



                            <div id="loadDateData">

                            </div>
                            <div id="form_output"></div>

                        </div>


                        <?php echo Form::close(); ?>

                        <div class="clearfix"></div>
                        <div class="mydivAjaxImage">
                            <img src="<?php echo e(url('fontView\assets\img\ajax-loader.gif')); ?>" class="ajax-loader" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>