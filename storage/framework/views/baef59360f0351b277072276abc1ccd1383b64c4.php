<?php $__env->startSection('title_area'); ?>
    :: Attendance Record ::

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
    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px" >

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" >
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Attendance Record </h2>
                 <a href="<?php  echo asset('/attendance_entry');?>"  onclick="addEmployee()"
                class="btn btn-primary btn-xs topbarbutton" ><i
                class="glyphicon glyphicon-plus"></i>
                     Add Attendance
                </a>
            </header>
            <div>
                <div class="widget-body no-padding"  >
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <div class="col-sm-12" >
                            <div class="col-sm-12" style="margin-top:10px;"></div>
                            <?php echo Form::open(['url' => '', 'method' => 'post', 'id' => 'employee_attendance_form','class'=>'form-horizontal']); ?>

                            <div class="col-sm-3" >
                                <label>Station</label>
                                <select id="station_id" class="form-control"  name="station_id">
                                    <option value="">Select Station</option>
                                    <?php if(!empty($station_info)): ?>
                                        <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-sm-3" >
                                <label>Department</label>
                                <select id="department_id" class="form-control"  name="department_id">
                                    <option value="">Select Department</option>
                                    <?php if(!empty($department_info)): ?>
                                        <?php $__currentLoopData = $department_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-sm-2" >
                                <label>Attendance Date</label>
                                <input type="text" name="attendance_date" value="<?php echo e(date('d-m-Y')); ?>" id="attendance_date" class="form-control datepickerinfo">
                            </div>

                            <div class="col-sm-2 margin-top-20px">
                                <button type="button" onclick="employee_attendance_record_search()" id="search_btn" class="btn btn-success btn-sm"   name="search_btn"><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12 margin-top-10px" >
                        <div class="col-sm-4" >
                            <div class="row">
                                <div id="error_data"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="show_report_info"></div>
                        <div id="show_attendance_info"></div>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>