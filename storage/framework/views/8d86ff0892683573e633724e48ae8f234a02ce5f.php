
<?php $__env->startSection('title_area'); ?>
    :: Add New Song ::
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
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>
                <a href="<?php echo e(url('get_play_list')); ?>" class="btn btn-info btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    Play list
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'playlist_create_form',
                        'class'=>'form-horizontal']); ?>

                        <div>
                            <div class="col-sm-12" style="margin-top:10px;">


                                <div class="form-group">
                                    <label class="col-md-2 control-label"> প্লে লিস্টের নাম
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" required placeholder="প্লে লিস্টের নাম" class="form-control"
                                               name="name"  id="name"/>
                                    </div>

                                    <label class="col-md-2 control-label"> প্লে লিস্ট আইডি
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" readonly name="playlist_id"
                                               value="<?php echo rand(10000, 90000); ?>" placeholder="প্লে লিস্ট আইডি"
                                               class="form-control"/>
                                    </div>

                                </div>



                                <div class="form-group">
                                    <label class="col-md-2 control-label"> কেন্দ্র
                                    </label>
                                    <div class="col-md-4">
                                        <select id="station_id" required class="form-control"
                                                onchange="getSubStation(this.value)" name="station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                            <?php if(!empty($station_info)): ?>
                                                <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label">ফ্রিকোয়েন্সি/চ্যানেল </label>
                                    <div class="col-md-4">
                                        <select id="sub_station_id" required class="form-control" name="sub_station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> অনুষ্ঠানের নাম
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="program_name" placeholder="অনুষ্ঠানের নাম" class="form-control"/>
                                    </div>
                                    <label class="col-md-2 control-label">অনুষ্ঠানের বিষয়</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="অনুষ্ঠানের বিষয়" name="program_subject"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> সম্প্রচার তারিখ
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="boardcast_date" placeholder="সম্প্রচার তারিখ" class="form-control datepickerLong"/>
                                    </div>
                                    <label class="col-md-2 control-label">সম্প্রচার সময়</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control  timepicker" placeholder="সম্প্রচার সময়" name="boardcast_time"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> পরিকল্পনাকারী
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="planner_id" id="planner_id">
                                            <option value="">পরিকল্পনাকারী</option>
                                            <?php foreach ($employee_info as $key => $name) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $name . "(" . $key . ")"; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label">
                                        স্ট্যাটাস
                                    </label>
                                    <div class="col-md-4">
                                        <select id="status" class="form-control" name="status">
                                            <option value="1">active</option>
                                            <option value="2">inactive</option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="form_output"></span>
                    </div>
                    <div class=" col-sm-5">
                        <button type="submit" id="saveBtn" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i>Save
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                    </div>
                </div>
                <?php echo Form::close(); ?>


            </div>
        </div>
        </div>
        </div>
    </article>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>