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
                <h2>উপস্থাপনা তথ্য সমুহ</h2>
                <a href="<?php  echo asset('/program_presentation_create');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    পরিকল্পনা (Planning) List
                </a>

            </header>
            <div>
                <?php  
                    $month = [
                        '1' => "জানুয়ারি",
                        '2' => "ফেব্রুয়ারি",
                        '3' => "মার্চ",
                        '4' => "এপ্রিল",
                        '5' => "মে",
                        '6' => "জুন",
                        '7' => "জুলাই",
                        '8' => "আগস্ট",
                        '9' => "সেপ্টেম্বর",
                        '10' => "অক্টোবর",
                        '11' => "নভেম্বর",
                        '12' => "ডিসেম্বর",
                    ];
                 ?>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'save_presentation_info_form','class'=>'form-horizontal']); ?>


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
                                <label class="col-md-2 control-label"> ফ্রিকোয়েন্সি</label>
                                <div class="col-md-3">
                                    <select id="sub_station_id" required class="form-control" name="sub_station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="month_id" onchange="loadDateData(this.value,$('#station_id').val(),$('#sub_station_id').val(),$('#year_id').val() );"
                                            required
                                            class="form-control" name="month_id">
                                        <option value="">মাস চিহ্নিত করুন</option>
                                        <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month_id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($month_id); ?>"><?php echo e($name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">শিল্পী সম্মানী চার্ট: ক্যাটাগরি </label>
                                <div class="col-md-2" style="padding-top:6px;">
                                    <?php
                                          echo $presentation_ctg[91];
                                    ?>
                                    <input type="hidden" id="ctg_id" value="91"  required class="form-control"
                                           name="ctg_id">







                                </div>
                                <label class="col-md-2 control-label">অনুষ্ঠানের বিবরণ </label>
                                <div class="col-md-3">
                                    <select id="description_id"  required class="form-control"   name="description_id">
                                        <option value="">চিহ্নিত করুন</option>
                                        <?php if(!empty($presentation_description_ctg)): ?>
                                            <?php $__currentLoopData = $presentation_description_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select id="year_id" required class="form-control" name="year_id">
                                        <option value="<?php echo e(date('Y')); ?>"><?php echo e(date('Y')); ?> </option>
                                        <option value="<?php echo e(date('Y')+1); ?>"><?php echo e(date('Y')+1); ?> </option>

                                    </select>
                                </div>
                            </div>


                            <div id="loadDateData">

                            </div>
                            

                        </div>
                        
                        
                        <?php echo Form::close(); ?>

                        <div class="clearfix"></div>
                        <div class=" col-sm-offset-4 col-sm-8 ajax-loader" style="display: none;">
                            <img src="<?php echo e(url('fontView\assets\img\ajax-loader.gif')); ?>" class="img-responsive" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>