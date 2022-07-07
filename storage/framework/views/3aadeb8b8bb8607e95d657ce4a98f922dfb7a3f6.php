
<?php $__env->startSection('title_area'); ?>
    :: Employee Information   ::
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
                <h2>Employee Information </h2>

                <button type="button" data-toggle="modal" onclick="addEmployee()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </button>
            </header>
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table id="employee_data" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th data-class="expand"> employee Id</th>
                                <th data-class="expand"> Name</th>
                                <th data-class="expand"> Station</th>
                                <th data-class="expand"> Mobile</th>
                                <th data-class="expand"> Department</th>
                                <th data-class="expand"> Designation</th>
                                <th data-class="expand"> Status</th>
                                <th data-hide="phone,tablet" style="width:120px;"> #</th>

                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span></h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <?php echo Form::open(['url' => '/save_employee_info', 'method' => 'post', 'id' => 'employee_info_id','class'=>'form-horizontal']); ?>

                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Station Name</label>
                            <div class="col-md-4">
                                <select id="station_id" class="form-control"  name="station_id">
                                    <option value="">Select Station</option>
                                    <?php if(!empty($branch_info)): ?>
                                        <?php $__currentLoopData = $branch_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">Employee Grade</label>
                            <div class="col-md-4">
                                <input id="employee_grade" placeholder="Enter Employee Grade " class="form-control"
                                       name="employee_grade">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Employee Name (English)</label>
                            <div class="col-md-4">
                                <input type="text" id="emp_name" class="form-control" placeholder="Employee Name"  name="emp_name"/>
                            </div>
                            <label class="col-md-2 control-label">Employee Short Name </label>
                            <div class="col-md-4">
                                <input type="text" id="emp_short_name" class="form-control" placeholder="Employee Short Name"  name="emp_short_name"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Employee Name (Bangla)</label>
                            <div class="col-md-4">
                                <input type="text" id="emp_name_bn" class="form-control" placeholder="Employee Name (Bangla)"
                                       name="emp_name_bn"/>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Father Name</label>
                            <div class="col-md-4">
                                <input type="text" id="father_name" class="form-control" placeholder="Father Name"  name="father_name"/>
                            </div>
                            <label class="col-md-2 control-label">Mother Name </label>
                            <div class="col-md-4">
                                <input type="text" id="mother_name" class="form-control" placeholder="Mother Name"  name="mother_name"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 text-right" >
                                <div class="form-check">
                                    <input type="checkbox" name="is_bcs_cadre" class="form-check-input"  id="checkedBcsCadre">
                                    <label class="form-check-label" for="exampleCheck1">BCS Cadre </label>
                                </div>
                            </div>
                            <div class="show_bcs_cadre">
                                <label class="col-sm-offset-3 col-md-2 control-label">Government ID</label>
                                <div class="col-md-4">
                                    <input type="text" id="govt_id" class="form-control" placeholder="Government ID (Optional)"  name="govt_id"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group show_bcs_cadre">
                            <label class="col-md-2 control-label">Cadre</label>
                            <div class="col-md-4">
                                <select id="cadre" class="form-control"  name="cadre_ctg">
                                    <option value="">Select</option>
                                    <?php if(!empty($catre_ctg)): ?>
                                        <?php $__currentLoopData = $catre_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">Batch </label>
                            <div class="col-md-4">
                                <input type="text"  value="" id="catre_batch" class="form-control" placeholder="Batch"  name="catre_batch"/>

                            </div>
                        </div>
                        <div class="form-group show_bcs_cadre">
                            <label class="col-md-2 control-label">Cadre Date</label>
                            <div class="col-md-4">
                                <input type="text" id="cadre_date" value="" class="form-control datepickerinfo" placeholder="Cadre Date"  name="cadre_date"/>
                            </div>
                            <label class="col-md-2 control-label">Confirmation Go Date</label>
                            <div class="col-md-4">
                                <input type="text" id="confirmation_go_date" value="" class="form-control datepickerinfo" placeholder="Confirmation Go Date"  name="confirmation_go_date"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mobile No</label>
                            <div class="col-md-4">
                                <input type="text" id="mobile_no" class="form-control" placeholder="Mobile No"  name="mobile_no"/>
                            </div>
                            <label class="col-md-2 control-label">Email </label>
                            <div class="col-md-4">
                                <input type="text" id="email_address" class="form-control" placeholder="Email"  name="email_address"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Gender</label>
                            <div class="col-md-4">
                                <select id="gender" class="form-control"  name="gender">
                                    <option value="">Select</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Other</option>
                                </select>

                            </div>
                            <label class="col-md-2 control-label">Date of Birth</label>
                            <div class="col-md-4">
                                <input type="text" id="date_of_birth" class="form-control datepickerinfo" placeholder="Date of Birth"  name="date_of_birth"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Religion</label>
                            <div class="col-md-4">
                                <select id="religion" class="form-control"  name="religion">
                                    <option value="">Select</option>
                                    <option value="1">Islam</option>
                                    <option value="2">	Hinduism</option>
                                    <option value="3">Buddhism</option>
                                    <option value="4">Christianity</option>
                                </select>

                            </div>
                            <label class="col-md-2 control-label">Merital Status</label>
                            <div class="col-md-4">
                                <select id="merital_status" class="form-control"  name="merital_status">
                                    <option value="">Select</option>
                                    <option value="1">Married</option>
                                    <option value="2">Single</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Blood Group</label>
                            <div class="col-md-4">
                                <select id="blood_group" class="form-control"  name="blood_group">
                                    <option value="">Select</option>
                                    <option value="1">A+(Positive)</option>
                                    <option value="2">A-(Negative)</option>
                                    <option value="3">B+(Positive)</option>
                                    <option value="4">B-(Negative)</option>
                                    <option value="5">AB+(Positive)</option>
                                    <option value="6">AB-(Negative)</option>
                                    <option value="7">O+(Positive)</option>
                                    <option value="8">O-(Negative)</option>
                                </select>

                            </div>
                            <label class="col-md-2 control-label">Physical Disability</label>
                            <div class="col-md-4">
                                <select id="physical_disability" class="form-control"  name="physical_disability">
                                    <option value="1">No</option>
                                    <option value="2">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nationality</label>
                            <div class="col-md-4">
                                <select id="nationality" class="form-control"  name="nationality">
                                    <option value="">Select</option>
                                    <?php if(!empty($nationality)): ?>
                                        <?php $__currentLoopData = $nationality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">Provides Details(IF Yes)</label>
                            <div class="col-md-4">
                                <textarea name="disability_yes_details" rows="1" placeholder="Provides Details(IF Yes)" id="disability_yes_details" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">National ID. No</label>
                            <div class="col-md-4">
                                <input type="text" id="national_id_no" class="form-control" placeholder="National ID. No"  name="national_id_no"/>
                            </div>
                            <label class="col-md-2 control-label">Birth Certificate No </label>
                            <div class="col-md-4">
                                <input type="text" id="birth_certificate" class="form-control" placeholder="Birth Certificate No"  name="birth_certificate"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Driving License</label>
                            <div class="col-md-4">
                                <input type="text" id="driving_license" class="form-control" placeholder="Driving License"  name="driving_license"/>
                            </div>
                            <label class="col-md-2 control-label">Passport No</label>
                            <div class="col-md-4">
                                <input type="text" id="passport_no" class="form-control" placeholder="Passport No"  name="passport_no"/>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Present Address</label>
                                <div class="col-md-8 text-right" >
                                    <div class="form-check">
                                        <input type="checkbox" name="save_present_parmanent_address" class="form-check-input"  id="save_present_parmanent_address">
                                        <label class="form-check-label" for="exampleCheck1">Present  & Parmanent Address Same </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">District</label>
                                <div class="col-md-8">
                                    <select id="present_district" class="select2" name="present_district">
                                        <option value="">Select District</option>
                                        <?php if(!empty($all_district)): ?>
                                            <?php $__currentLoopData = $all_district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" ><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Police Station</label>
                                <div class="col-md-8">
                                    <select id="present_police_station" class="form-control" name="present_police_station">
                                        <option value="">Select Police Station</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Post Office</label>
                                <div class="col-md-8">
                                    <input type="text" id="present_post_office" class="form-control" placeholder="Post Office"  name="present_post_office"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Vill/House/Road No</label>
                                <div class="col-md-8">
                                    <textarea id="present_village_house_road" class="form-control" placeholder="Vill/House/Road No"  name="present_village_house_road"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Parmanent Address</label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">District</label>
                                <div class="col-md-8">
                                    <select id="parmanent_district" class="select2 same_present_address" name="parmanent_district">
                                        <option value="">Select District</option>
                                        <?php if(!empty($all_district)): ?>
                                            <?php $__currentLoopData = $all_district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" ><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Police Station</label>
                                <div class="col-md-8">
                                    <select id="parmanent_police_station" class="form-control same_present_address" name="parmanent_police_station">
                                        <option value="">Select Police Station</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Post Office</label>
                                <div class="col-md-8">
                                    <input type="text" id="parmanent_post_office" class="form-control same_present_address" placeholder="Post Office"  name="parmanent_post_office"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Vill/House/Road No</label>
                                <div class="col-md-8">
                                    <textarea  id="parmanent_village_house_road" class="form-control same_present_address" placeholder="Vill/House/Road No"  name="parmanent_village_house_road"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="form_output"></span>
                    </div>
                    <div class=" col-sm-5">
                        <button type="button"  onclick="saveEmployeeInfo()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                            Save
                        </button>
                        <button type="button" id="updateBtn" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i> Update
                        </button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" name="setting_id" id="setting_id">
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>