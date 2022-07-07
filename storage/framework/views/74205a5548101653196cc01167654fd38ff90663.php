<?php $__env->startSection('title_area'); ?>
    :: Holidays Record ::

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
                <h2>Holidays Record </h2>
                <button type="button" data-toggle="modal" onclick="addHolidayInfo()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </button>
            </header>
            <div>
                <div class="widget-body no-padding"  >
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> Title</th>
                                <th> Station</th>
                                <th> From DT</th>
                                <th> To DT</th>
                                <th>Department  </th>
                                <th> Type </th>
                                <th style="width: 10%"> #</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($holiday_info)): ?>
                                <?php ($i=1); ?>
                                <?php $__currentLoopData = $holiday_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($holiday->title); ?></td>
                                        <td><?php echo e($holiday->station_name); ?></td>
                                        <td><?php echo e($holiday->from_date); ?></td>
                                        <td><?php echo e($holiday->to_date); ?></td>
                                        <td>
                                            <?php
                                                if(!empty($holiday->department_id)){
                                                    $department=json_decode($holiday->department_id,true);
                                                    $all_dept='';
                                                    foreach ($department as $value){
                                                        $all_dept.= '<div class="btn btn-primary btn-xs">'.$department_info[$value]."</div> ";
                                                    }
                                                    echo $all_dept ;
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo e(($holiday->overwrite_type==1)?"OFF Day":'On Day'); ?></td>
                                        <td><button type="button" data-toggle="modal" onclick="updateHolidayInfo('<?php echo e($holiday->id); ?>')" data-target="#exampleModal"
                                                    class="btn btn-info btn-xs" ><i
                                                        class="glyphicon glyphicon-pencil"></i>
                                               Update
                                            </button></td>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span> </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'holiday_record_form','class'=>'form-horizontal']); ?>

                <div class="modal-body">
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Holiday Title</label>
                            <div class="col-md-4">
                                <input type="text" id="holiday_title" class="form-control" placeholder="Holiday Title" required name="holiday_title"/>
                            </div>
                            <label class="col-md-2 control-label">Station Name</label>
                            <div class="col-md-4">
                                <select id="station_id" class="form-control"  name="station_id">
                                    <option value="">Select Station</option>
                                    <?php if(!empty($station_info)): ?>
                                        <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">From Date </label>
                            <div class="col-md-4">
                                <input type="text" name="holiday_form_date" placeholder="From Date" class="form-control datepickerinfo" id="holiday_form_date">

                            </div>
                            <label class="col-md-2 control-label">To Date </label>
                            <div class="col-md-4">
                                <input type="text" name="holiday_to_date" placeholder="To Date" class="form-control datepickerinfo" id="holiday_to_date">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">In-Time</label>
                            <div class="col-md-4">
                                <input type="text" value="09:00 am" name="attendance_in_time" placeholder="From Date" class="form-control timepicker" id="attendance_in_time">
                            </div>
                            <label class="col-md-2 control-label">Out-Time</label>
                            <div class="col-md-4">
                                <input type="text"  value="05:00 pm" name="attendance_out_time" placeholder="To Date" class="form-control timepicker" id="attendance_out_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Department</label>
                            <div class="col-md-4">
                                <?php if(!empty($department_info)): ?>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="all_department" id="checked_all" value="1"> All</label>
                                        </div>
                                    </div>
                                    <?php $__currentLoopData = $department_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="checkbox_val_<?php echo e($key); ?>" id="checked_dept" name="department[]" value="<?php echo e($key); ?>"> <?php echo e($value); ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <label class="col-md-2 control-label">Overwrite Type</label>
                            <div class="col-md-4">
                                <select  name="overwrite_type"  class="form-control" id="overwrite_type">
                                    <option value="">Select</option>
                                    <option value="1">Off Day</option>
                                    <option value="2">On Day</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" onclick="saveHolidayInfo()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i><span id="submitBtnTitle"></span> </button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" name="setting_id" id="setting_id">
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>