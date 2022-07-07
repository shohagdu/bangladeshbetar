<?php echo Form::open(['url' => '/save_employee_info', 'method' => 'post', 'id' => 'employee_info_update_form','class'=>'form-horizontal']); ?>

<div class="modal-body">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="col-md-2 control-label">Station Name</label>
            <div class="col-md-4">
                <select id="station_id" class="form-control"  name="station_id">
                    <option value="">Select Station</option>
                    <?php if(!empty($branch_info)): ?>
                        <?php $__currentLoopData = $branch_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e(($key==$employe_info->station_id)?"selected":''); ?>><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
            <label class="col-md-2 control-label">Employee Grade</label>
            <div class="col-md-4">
                <input id="employee_grade" value="<?php echo e($employe_info->emp_grade); ?>" placeholder="Enter Employee Grade "
                       class="form-control"
                       name="employee_grade">
            </div>


        </div>
       
        <div class="form-group">
            <label class="col-md-2 control-label">Employee Name</label>
            <div class="col-md-4">
                <input type="text" id="emp_name" value=" <?php echo e($employe_info->emp_name); ?>" class="form-control" placeholder="Employee Name"  name="emp_name"/>
            </div>
            <label class="col-md-2 control-label">Employee Short Name </label>
            <div class="col-md-4">
                <input type="text" id="emp_short_name" value="<?php echo e($employe_info->emp_short_name); ?>" class="form-control" placeholder="Employee Short Name"  name="emp_short_name"/>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Employee Name (Bangla)</label>
            <div class="col-md-4">
                <input type="text" id="emp_name_bn" value="<?php echo e($employe_info->emp_name_bn); ?>" class="form-control"
                       placeholder="Employee Name (Bangla)"
                       name="emp_name_bn"/>
            </div>

        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Father Name</label>
            <div class="col-md-4">
                <input type="text" id="father_name" value="<?php echo e($employe_info->father_name); ?>" class="form-control" placeholder="Father Name"  name="father_name"/>
            </div>
            <label class="col-md-2 control-label">Mother Name </label>
            <div class="col-md-4">
                <input type="text" id="mother_name" value="<?php echo e($employe_info->mother_name); ?>"  class="form-control" placeholder="Mother Name"  name="mother_name"/>

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-3 text-right" >
                <div class="form-check">
                    <input type="checkbox" name="is_bcs_cadre"  <?php echo e((($employe_info->is_bcs_cadre==1)?'Checked':'')); ?> class="form-check-input"  id="checkedBcsCadre">
                    <label class="form-check-label" for="exampleCheck1">BCS Cadre </label>
                </div>
            </div>
            <div class="show_bcs_cadre">
                <label class="col-sm-offset-3 col-md-2 control-label">Government ID</label>
                <div class="col-md-4">
                    <input type="text" id="govt_id" value="<?php echo e($employe_info->govt_id); ?>" class="form-control" placeholder="Government ID (Optional)"  name="govt_id"/>
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
                            <option value="<?php echo e($key); ?>" <?php echo e((isset($employe_info->cadre_ctg) && $employe_info->cadre_ctg==$key)?'selected':''); ?>><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
            <label class="col-md-2 control-label">Batch </label>
            <div class="col-md-4">
                <input type="text"  value="<?php echo e($employe_info->cadre_batch); ?>" id="catre_batch" class="form-control" placeholder="Batch"  name="catre_batch"/>

            </div>
        </div>
        <div class="form-group show_bcs_cadre">
            <label class="col-md-2 control-label">Cadre Date</label>
            <div class="col-md-4">
                <input type="text" id="cadre_date" value="<?php echo e((!empty($employe_info->cadre_date))?date('d-m-Y',strtotime($employe_info->cadre_date)):''); ?>" class="form-control datepickerinfo" placeholder="Cadre Date"  name="cadre_date"/>
            </div>
            <label class="col-md-2 control-label">Confirmation Go Date</label>
            <div class="col-md-4">
                <input type="text" id="confirmation_go_date" value="<?php echo e((!empty($employe_info->cadre_go_date))?date('d-m-Y',strtotime($employe_info->cadre_go_date)):''); ?>" class="form-control datepickerinfo" placeholder="Confirmation Go Date"  name="confirmation_go_date"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Mobile No</label>
            <div class="col-md-4">
                <input type="text"  value="<?php echo e($employe_info->mobile); ?>" id="mobile_no" class="form-control" placeholder="Mobile No"  name="mobile_no"/>
            </div>
            <label class="col-md-2 control-label">Email </label>
            <div class="col-md-4">
                <input type="text"  value="<?php echo e($employe_info->email); ?>" id="email_address" class="form-control" placeholder="Email"  name="email_address"/>

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Gender</label>
            <div class="col-md-4">
                <select id="gender" class="form-control"  name="gender">
                    <option value="">Select</option>
                    <option value="1" <?php echo e(($employe_info->gender==1)?"selected":''); ?>>Male</option>
                    <option value="2" <?php echo e(($employe_info->gender==2)?"selected":''); ?>>Female</option>
                    <option value="3" <?php echo e(($employe_info->gender==3)?"selected":''); ?>>Other</option>
                </select>

            </div>
            <label class="col-md-2 control-label">Date of Birth</label>
            <div class="col-md-4">
                <input type="text" id="date_of_birth" value="<?php echo e(date('d-m-Y',strtotime($employe_info->birth_date))); ?>" class="form-control datepickerinfo" placeholder="Date of Birth"  name="date_of_birth"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Religion</label>
            <div class="col-md-4">
                <select id="religion" class="form-control"  name="religion">
                    <option value="">Select</option>
                    <option value="1" <?php echo e(($employe_info->religion==1)?"selected":''); ?>>Islam</option>
                    <option value="2" <?php echo e(($employe_info->religion==2)?"selected":''); ?>>Hinduism</option>
                    <option value="3" <?php echo e(($employe_info->religion==3)?"selected":''); ?>>Buddhism</option>
                    <option value="4" <?php echo e(($employe_info->religion==4)?"selected":''); ?>>Christianity</option>
                </select>

            </div>
            <label class="col-md-2 control-label">Merital Status</label>
            <div class="col-md-4">
                <select id="merital_status" class="form-control"  name="merital_status">
                    <option value="">Select</option>
                    <option value="1" <?php echo e(($employe_info->marital_status==1)?"selected":''); ?>>Married</option>
                    <option value="2" <?php echo e(($employe_info->marital_status==2)?"selected":''); ?>>Single</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Blood Group</label>
            <div class="col-md-4">
                <select id="blood_group" class="form-control"  name="blood_group">
                    <option value="">Select</option>
                    <option value="1" <?php echo e(($employe_info->blood_group==1)?"selected":''); ?>>A+(Positive)</option>
                    <option value="2" <?php echo e(($employe_info->blood_group==2)?"selected":''); ?>>A-(Negative)</option>
                    <option value="3" <?php echo e(($employe_info->blood_group==3)?"selected":''); ?>>B+(Positive)</option>
                    <option value="4" <?php echo e(($employe_info->blood_group==4)?"selected":''); ?>>B-(Negative)</option>
                    <option value="5" <?php echo e(($employe_info->blood_group==5)?"selected":''); ?>>AB+(Positive)</option>
                    <option value="6" <?php echo e(($employe_info->blood_group==6)?"selected":''); ?>>AB-(Negative)</option>
                    <option value="7" <?php echo e(($employe_info->blood_group==7)?"selected":''); ?>>O+(Positive)</option>
                    <option value="8" <?php echo e(($employe_info->blood_group==6)?"selected":''); ?>>O-(Negative)</option>
                </select>

            </div>
            <label class="col-md-2 control-label">Physical Disability</label>
            <div class="col-md-4">
                <select id="physical_disability" class="form-control"  name="physical_disability">
                    <option value="1" <?php echo e(($employe_info->physical_disability==1)?"selected":''); ?>>No</option>
                    <option value="2" <?php echo e(($employe_info->physical_disability==2)?"selected":''); ?>>Yes</option>
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
                            <option value="<?php echo e($key); ?>" <?php echo e(($key==$employe_info->nationality)?"selected":''); ?>><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>

            </div>
            <label class="col-md-2 control-label">Provides Details(IF Yes)</label>
            <div class="col-md-4">
                <textarea rows="1" name="disability_yes_details" placeholder="Provides Details(IF Yes)" id="disability_yes_details" class="form-control"><?php echo e($employe_info->disability_details); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">National ID. No</label>
            <div class="col-md-4">
                <input type="text" value="<?php echo e($employe_info->national_id); ?>" id="national_id_no" class="form-control" placeholder="National ID. No"  name="national_id_no"/>
            </div>
            <label class="col-md-2 control-label">Birth Certificate No </label>
            <div class="col-md-4">
                <input type="text" value="<?php echo e($employe_info->birth_certificate_no); ?>" id="birth_certificate" class="form-control" placeholder="Birth Certificate No"  name="birth_certificate"/>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Driving License</label>
            <div class="col-md-4">
                <input type="text" value="<?php echo e($employe_info->driving_license_no); ?>" id="driving_license" class="form-control" placeholder="Driving License"  name="driving_license"/>
            </div>
            <label class="col-md-2 control-label">Passport No</label>
            <div class="col-md-4">
                <input type="text" value="<?php echo e($employe_info->passport_no); ?>" id="passport_no" class="form-control" placeholder="Passport No"  name="passport_no"/>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-4 control-label">Present Address</label>
                <div class="col-md-8 text-right" >
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input save_address" <?php echo e((($employe_info->is_same_present_parmaent_add==1)?'Checked':'')); ?> name="save_present_parmanent_address"   id="save_present_parmanent_address">
                        <label class="form-check-label" for="exampleCheck1">Present  & Parmanent Address Same </label>
                    </div>
                </div>
            </div>
           <?php
            $present_address = !empty($employe_info->present_address)? json_decode($employe_info->present_address, true):NULL;
            $parmanent_address= !empty($employe_info->present_address)?json_decode($employe_info->parmanent_address, true):NULL;
            ?>
            <div class="form-group">
                <label class="col-md-4 control-label">District</label>
                <div class="col-md-8">
                    <select id="present_district" class="select2" name="present_district">
                        <option value="">Select District</option>
                        <?php if(!empty($all_district)): ?>
                            <?php $__currentLoopData = $all_district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e((isset($present_address['district']) && $present_address['district']==$key)?"selected":''); ?> ><?php echo e($value); ?></option>
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
                        <?php if(!empty($present_upazilas)): ?>
                            <?php $__currentLoopData = $present_upazilas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e((isset($present_address['upazila']) && $present_address['upazila']==$key)?"selected":''); ?> ><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Post Office</label>
                <div class="col-md-8">
                    <input type="text" id="present_post_office"  value="<?php echo e((!empty($present_address['post_office']))? $present_address['post_office']:''); ?>" class="form-control" placeholder="Post Office"  name="present_post_office"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Vill/House/Road No</label>
                <div class="col-md-8">
                    <textarea id="present_village_house_road" class="form-control" placeholder="Vill/House/Road No"  name="present_village_house_road"><?php echo e((!empty($present_address['vill_road']))? $present_address['vill_road']:''); ?></textarea>
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
                                <option value="<?php echo e($key); ?>" <?php echo e((isset($parmanent_address['district']) && $parmanent_address['district']==$key)?"selected":''); ?> ><?php echo e($value); ?></option>
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
                        <?php if(!empty($parmanent_upazilas)): ?>
                            <?php $__currentLoopData = $parmanent_upazilas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e((isset($present_address['upazila']) && $parmanent_address['upazila']==$key)?"selected":''); ?> ><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Post Office</label>
                <div class="col-md-8">
                    <input type="text" id="parmanent_post_office" value="<?php echo e((!empty($parmanent_address['post_office']))? $parmanent_address['post_office']:''); ?>" class="form-control same_present_address" placeholder="Post Office"  name="parmanent_post_office"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Vill/House/Road No</label>
                <div class="col-md-8">
                    <textarea id="parmanent_village_house_road" class="form-control same_present_address" placeholder="Vill/House/Road No"  name="parmanent_village_house_road"><?php echo e((!empty($parmanent_address['vill_road']))? $parmanent_address['vill_road']:''); ?></textarea>
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
        <input type="hidden" value="<?php echo e($employe_info->id); ?>" name="employee_primary_id">
        <button type="button" onclick="updateEmployeeInfo()"  id="updateBtn" class="btn btn-success"><i
                class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#employment"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>
        <input type="hidden" name="employee_id" id="employee_id">
    </div>
</div>
<?php echo Form::close(); ?>







