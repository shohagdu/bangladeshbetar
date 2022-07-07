
<?php $__env->startSection('title_area'); ?>
    :: Add New Poeam ::
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
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>
                <a href="<?php echo e(url('get_vhason_list')); ?>" class="btn btn-primary btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    ভাষণ খাতা
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'vhason_create_form',
                        'class'=>'form-horizontal']); ?>

                        <div>
                            <div class="col-sm-12" style="margin-top:10px;">

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> পরিকল্পনা আইডি
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="program_plan_id" placeholder="পরিকল্পনা আইডি" class="form-control" />
                                    </div>
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-4">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> কেন্দ্র
                                    </label>
                                    <div class="col-md-4">
                                        <select id="station_id" required class="form-control" name="station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                            <?php if(!empty($station_info)): ?>
                                                <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-4 control-label"><input type="checkbox" name="sadin_bangla_betar_kendro"/> স্বাধীন বাংলা বেতার কেন্দ্র </label>
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label">ভাষণের প্রথম লাইন</label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="vhason_first_line" id="vhason_first_line" placeholder="ভাষণের প্রথম লাইন"/>
                                    </div>

                                    <label class="col-md-2 control-label"> প্রদানকারীর নাম
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="vhason_kari" id="vhason_kari" placeholder="প্রদানকারীর নাম" />
                                    </div>

                                </div>



                                <div class="form-group">
                                    <label class="col-md-2 control-label">পদবী </label>
                                    <div class="col-md-4">
                                        <select id="podobi" class="form-control" name="podobi">
                                            <option value="">চিহ্নিত করুন</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label"> ভাষণের প্রকার
                                    </label>
                                    <div class="col-md-4">
                                        <select id="vhasoner_prokar" class="form-control" name="vhasoner_prokar">
                                            <option value="">চিহ্নিত করুন</option>
                                            <?php foreach($song_category as $value) { ?>
                                                <option value="<?php echo $value->id ?>"><?php echo $value->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> কর্মক্ষেত্র
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="work_area" placeholder="কর্মক্ষেত্র" name="work_area"/>
                                    </div>

                                    <label class="col-md-2 control-label"> স্থিতি
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="stability" id="stability" placeholder="স্থিতি" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> স্থান
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="prochar_sthan" name="prochar_sthan" placeholder="স্থান" />
                                    </div>

                                    <label class="col-md-2 control-label">বিষয় </label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" name="subject" rows="6" id="subject" placeholder="বিষয়"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> প্রদানের তারিখ
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control datepickerLong" autocomplete="off" name="prdaner_tarikh" id="prdaner_tarikh" placeholder="প্রদানের তারিখ" />
                                    </div>
                                    <audio id="player">
                                        <source id="audioSource" src="" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    <label class="col-md-2 control-label"> ভাষণের অডিও ফাইল <span class="mandatory_field">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="file" name="odio_file" accept="audio/*" id="audioFile" class="form-control"  required/>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" style="display:none;" id="play_button" onclick="playsong()" class="btn btn-primary"><i   class="fa fa-play"></i></button>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> ভাষণ
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" name="vhason" required id="vhason" class="form-control"/>
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="row">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:15%">সংশ্লিষ্ট আধিকারিক</th>
                                                <th style="width:35%"></th>
                                                <th style="width:15%"></th>
                                                <th style="width:35%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="পরিকল্পনা" />
                                                </td>
                                                <td>
                                                    <select id="maker" placeholder="পরিকল্পনাকারীর নাম" searchid="20" class="select2" multiple name="plan_maker[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="সম্পাদনা" />
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="সম্পাদনা" class="select2" searchid="20" multiple name="sompadona[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>




                                            </tr>

                                            <tr>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="প্রযোজনা সহকারী" />
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="প্রযোজনা সহকারী" class="select2" searchid="20" multiple name="assistent_producer[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="প্রযোজনা" />
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="প্রযোজনা" class="select2" searchid="20" multiple name="producer[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>



                                            </tr>

                                            <tr>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="তত্ত্বাবধানে" />
                                                </td>
                                                <td>
                                                    <select id="codinator" placeholder="নাম" class="select2" searchid="20" multiple name="codinator[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="নির্দেশনা" />
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="নির্দেশনা নাম" class="select2" searchid="20" multiple name="direction[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class=" col-sm-7 text-left">
                                <span class="text-left" id="form_output"></span>
                            </div>
                            <div class=" col-sm-5">
                                <button type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                                    <span id="saveing_text">Save</span>
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close
                                </button>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                        <div class=" col-sm-offset-4 col-sm-8 ajax-loader" style="display: none;">
                            <img src="<?php echo e(url('fontView\assets\img\ajax-loader.gif')); ?>" class="img-responsive" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>