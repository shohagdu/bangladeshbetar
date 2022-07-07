<link rel="stylesheet" href="<?php echo e(asset('fontView')); ?>/assets/modules/css/custom.css">




<?php
$spouse_info = (!empty($employee_general_info->spouse_info) ? json_decode($employee_general_info->spouse_info, true) : '');
$childeren_info = (!empty($employee_general_info->children_info) ? json_decode($employee_general_info->children_info, true) : '');
$training_info = (!empty($employee_general_info->training_info) ? json_decode($employee_general_info->training_info, true) : '');
$education_info = (!empty($employee_general_info->education_info) ? json_decode($employee_general_info->education_info, true) : '');
$promotion_info = (!empty($employee_general_info->promotion_info) ? json_decode($employee_general_info->promotion_info, true) : '');
$job_history = (!empty($employee_general_info->job_history) ? json_decode($employee_general_info->job_history, true) : '');
$emergency_contact = (!empty($employee_general_info->emergency_contact) ? json_decode($employee_general_info->emergency_contact) : '');
$exit_feedback = (!empty($employee_general_info->exit_feedback) ? json_decode($employee_general_info->exit_feedback) : '');
$disciplinary_action = (!empty($employee_general_info->disciplinary_action) ? json_decode($employee_general_info->disciplinary_action) : '');
$present_address = (!empty($employee_info->present_address) ? json_decode($employee_info->present_address) : '');
$parmanent_address = (!empty($employee_info->parmanent_address) ? json_decode($employee_info->parmanent_address) : '');
$employee_leave = (!empty($employee_leave_info) ? json_decode($employee_leave_info) : '');
?>
    <table class="width100per" id="employee_details_pdf"  >
        <tr>
            <td colspan="4" class="no-border" >
                <table class="width100per">
                    <tr>
                        <td class="width10per vertical-align-top no-border">
                            <?php if( !empty($company_info->company_logo) && file_exists('images/logo/'.$company_info->company_logo) ): ?>
                                    <img  src="<?php echo asset('images/logo/'.$company_info->company_logo)?>"  alt="Bangladesh Betar"
                                          style="height: 80px;width:150px;">
                                <?php else: ?>
                                    <img  src="<?php echo asset('images/default/default-avatar.png')?>" alt="Bangladesh Betar"
                                          style="height: 80px;width:150px;">
                                <?php endif; ?>

                        </td>
                        <td class="vertical-align-top no-border" style="padding-right:10px; "  >
                            <div class="bold font-size-18px"><?php echo e($company_info->com_name); ?></div>
                            <div class="bold"><?php echo e($company_info->address); ?></div>
                            <div class="bold">Email: <?php echo e($company_info->email); ?>, Mobile: <?php echo e($company_info->mobile); ?></div>
                            <div class="bold">Website: <?php echo e($company_info->web_address); ?></div>
                        </td>
                        <td class="width10per vertical-align-top no-border">
                            <img  src="<?php echo ((file_exists('images/employee_image/'.$employee_info->image) && !empty($employee_info->image) )?asset('images/employee_image/'.$employee_info->image):asset('images/default/default-avatar.png'))?>" alt="Bangladesh Betar"   style="height: 120px;width:153px; border: 1px solid #d0d0d0;">
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Basic Information</td>
        </tr>
        <tr>
            <th class="width20per">Employee ID</th>
            <td class="width30per">: <?php echo e($employee_info->employee_id); ?> </td>
            <th class="emp-text-right width20pert">Branch Name</th>
            <td class="width30per">: <?php echo e((!empty($employee_info->station_id)?get_branch_name( $employee_info->station_id):'')); ?></td>
        </tr>
        <tr>
            <th>Employee Name</th>
            <td colspan="3">: <?php echo e($employee_info->emp_name); ?> (<?php echo e($employee_info->emp_short_name); ?>)</td>

        </tr>

        <tr>
            <th >Father's Name</th>
            <td >: <?php echo e($employee_info->father_name); ?></td>
            <th class="emp-text-right" >Mother's Name</th>
            <td>: <?php echo e($employee_info->mother_name); ?></td>
        </tr>

        <tr>
            <th class="vertical-align-top">Present Address</th>
            <?php 
                $present_district_info  = App\District::find($present_address->district);
                $present_upazila_info   = App\Upazila::find($present_address->upazila);
             ?>
            <td>: <b>Vill/House/Road</b>: <?php echo e($present_address->vill_road); ?>, <b>Post Office</b>: <?php echo e($present_address->post_office); ?>, <b>Police Station</b>:<?php echo e($present_upazila_info->name); ?>, <b>District</b>: <?php echo e($present_district_info->name); ?>

            </td>
            <th class="emp-text-right vertical-align-top">Parmanent Address</th>
            <?php 
                $parmanent_district_info  = App\District::find($parmanent_address->district);
                $parmanent_upazila_info   = App\Upazila::find($parmanent_address->upazila);
             ?>
            <td>:
                <?php if(!empty($parmanent_address)): ?>
                    <b>Vill/House/Road</b>:<?php echo e($parmanent_address->vill_road); ?>, <b>Post Office</b>: <?php echo e($parmanent_address->post_office); ?>, <b>Police  Station</b>: <?php echo e($parmanent_district_info->name); ?>, <b>District</b>:<?php echo e($parmanent_upazila_info->name); ?>

                <?php endif; ?>
            </td>
        </tr>
        <?php if($employee_info->is_bcs_cadre==1): ?>
            <tr>
                <th>Govt.ID</th>
                <td>: <?php echo e($employee_info->govt_id); ?></td>
            </tr>
            <tr>
                <th>Cadre</th>
                <td>: <?php echo e($employee_info->cadre_ctg); ?></td>
                <th class="emp-text-right">Batch</th>
                <td>: <?php echo e($employee_info->cadre_batch); ?></td>
            </tr>

            <tr>
                <th>Cadre Date</th>
                <td>: <?php echo e($employee_info->cadre_date); ?></td>
                <th class="emp-text-right">Confirmation G.O Date</th>
                <td>: <?php echo e($employee_info->cadre_go_date); ?></td>
            </tr>
        <?php endif; ?>

        <tr>
            <th>Mobile</th>
            <td>: <?php echo e($employee_info->mobile); ?></td>
            <th class="emp-text-right">Email</th>
            <td>: <?php echo e($employee_info->email); ?></td>
        </tr>

        <tr>
            <th>Gender</th>
            <td>: <?php echo e((($employee_info->gender==1)?"Male":(($employee_info->gender==2)?"Female":"Other"))); ?></td>
            <th class="emp-text-right">Date of Birth</th>
            <td>:  <?php echo e(((empty($employee_info->birth_date) || $employee_info->birth_date =='0000-00-00' || $employee_info->birth_date =='1970-01-01' )?'':date('d-m-Y',strtotime($employee_info->birth_date)))); ?></td>
        </tr>
        <tr>
            <th>Religion</th>
            <td>: <?php echo e(religion_info($employee_info->religion)); ?></td>
            <th class="emp-text-right">Merital Status</th>
            <td>: <?php echo e(marital_status($employee_info->marital_status)); ?></td>
        </tr>
        <tr>
            <th>Blood Group</th>
            <td>: <?php echo e(blood_group_show($employee_info->blood_group)); ?></td>
            <th class="emp-text-right">Physical Disability</th>
            <td>: <?php echo e(($employee_info->disability_details==1)?'Yes':'No'); ?></td>
        </tr>
        <tr>
            <th>Nationality</th>
            <td>: <?php echo e((!empty($employee_info->nationality)?get_title_info($employee_info->nationality):'')); ?></td>
            <th class="emp-text-right">Provides Details(IF Yes)</th>
            <td>: <?php echo e($employee_info->disability_details); ?></td>
        </tr>
        <tr>
            <th>National ID. No</th>
            <td>: <?php echo e($employee_info->national_id); ?></td>
            <th class="emp-text-right">Birth Certificate No</th>
            <td>: <?php echo e($employee_info->birth_certificate_no); ?></td>
        </tr>
        <tr>
            <th>Driving License</th>
            <td>: <?php echo e($employee_info->driving_license_no); ?></td>
            <th class="emp-text-right">Passport No</th>
            <td>: <?php echo e($employee_info->passport_no); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Employment Information</td>
        </tr>
        <tr>
            <th>Department</th>
            <td>: <?php echo e((!empty($employee_info->department_id)?get_title_info($employee_info->department_id):'')); ?></td>
            <th class="emp-text-right">Designation</th>
            <td>: <?php echo e((!empty($employee_info->designation_id)?get_title_info($employee_info->designation_id):'')); ?></td>
        </tr>
        <tr>
            <th>Joining Date</th>
            <td>: <?php echo e(date('d-m-Y',strtotime($employee_info->join_date))); ?></td>
            <th class="emp-text-right">PRL Date</th>
            <td>: <?php echo e(date('d-m-Y',strtotime($employee_info->prl_date))); ?></td>
        </tr>
        <tr>
            <th>Reporting Person</th>
            <td>:</td>
            <th class="emp-text-right">LPR Date</th>
            <td>: <?php echo e(date('d-m-Y',strtotime($employee_info->lpr_date))); ?></td>
        </tr>
        <tr>
            <td colspan="2" class="vertical-align-top">
                <table rules="all" border="1px"  class=" table-bordered width100per leave_info_pdf">
                    <tr>
                        <td colspan="3">Time Table</td>
                    </tr>
                    <tr>
                        <td>Day</td>
                        <td>Start Time</td>
                        <td>End Time</td>
                    </tr>

                    <?php if(!empty($employee_info->time_table)): ?>
                        <?php $__currentLoopData = json_decode( $employee_info->time_table,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($time['day']); ?></td>
                                <td><?php echo e(date('h:i a',strtotime($time['start_time']))); ?></td>
                                <td><?php echo e(date('h:i a',strtotime($time['end_time']))); ?></td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </table>


            </td>
            <td  colspan="2" class="vertical-align-top">
                <table rules="all" border="1px"  class=" table-bordered width100per leave_info_pdf">
                    <tr>
                        <td colspan="4">Leave Balance</td>
                    </tr>
                     <tr>
                        <td>Leave Type</td>
                        <td>Total Limit</td>
                        <td>Consume</td>
                        <td>Remaining</td>
                    </tr>

                    <?php if(!empty($employee_leave)): ?>
                        <?php $__currentLoopData = $employee_leave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($leave->type_id_title); ?></td>
                                <td><?php echo e($leave->limit); ?></td>
                                <td><?php echo e($leave->consume); ?></td>
                                <td><?php echo e($leave->remaining); ?></td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Bank Account Information</td>
        </tr>
        <tr>
            <th>Basic Salary</th>
            <td>:
                <?php echo e($employee_salary_data->basic_salary); ?>

            </td>
            <th class="emp-text-right">Pay Scale</th>
            <td>:   <?php echo e($employee_salary_data->pay_scal); ?></td>
        </tr>
        <tr>
            <th>Bank Name</th>
            <td>:  <?php echo e((!empty($employee_salary_data->bank_Id)?get_title_info($employee_salary_data->bank_Id):'')); ?></td>
            <th class="emp-text-right">Account No</th>
            <td>:  <?php echo e($employee_salary_data->account_no); ?></td>
        </tr>
        
        
        
        
        
        

        <tr>
            <td colspan="4" class="employee-details-heading">Spouse Information</td>
        </tr>
        <?php if(!empty($spouse_info)): ?>
            <tr>
                <th>Spouse Name</th>
                <td>: <?php echo e($spouse_info['spouse_name']); ?></td>
                <th class="emp-text-right">Occupation</th>
                <td>: <?php echo e($spouse_info['spouse_occupation']); ?></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>: <?php echo e($spouse_info['spouse_mobile']); ?></td>
                <th class="emp-text-right">Designation</th>
                <td>: <?php echo e($spouse_info['spouse_designation']); ?></td>
            </tr>
            <tr>
                <th>Home District</th>
                <?php 
                   $spouse_district_info  = App\District::find($spouse_info['spouse_home_district']);
                 ?>
                <td>: <?php echo e($spouse_district_info->name); ?></td>
                <th class="emp-text-right">Organization</th>
                <td>: <?php echo e($spouse_info['spouse_organization']); ?></td>
            </tr>


            <tr>
                <th>Address</th>
                <td colspan="3">: <?php echo e($spouse_info['spouse_address']); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="4" class="employee-details-heading">Children Information</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Children Name</th>
                        <th>Sex</th>
                        <th>Date of Birth</th>
                    </tr>

                    <?php if(!empty($childeren_info)): ?>
                        <?php $__currentLoopData = $childeren_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($child['childName']); ?></td>
                                <td><?php echo e(show_gender($child['childSex'])); ?></td>
                                <td><?php echo e($child['child_birth_date']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">
                Education Information
            </td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Degree Name</th>
                        <th>Group/Major Subject</th>
                        <th>Board/Institute</th>
                        <th>Passing Year</th>
                        <th>Result</th>
                        <th>GPA</th>
                    </tr>
                    <?php if(!empty($education_info)): ?>
                        <?php $__currentLoopData = $education_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($education['degree_name']); ?></td>
                                <td><?php echo e($education['major_subject']); ?></td>
                                <td><?php echo e($education['institution']); ?></td>
                                <td><?php echo e($education['passing_year']); ?></td>
                                <td><?php echo e($education['result']); ?></td>
                                <td><?php echo e($education['cgpa']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </table>
            </td>
        </tr>


        <tr>
            <td colspan="4" class="employee-details-heading">Training Information</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Training Type</th>
                        <th>Training Title</th>
                        <th>Institute Name</th>
                        <th>From Date</th>
                        <th>To Date</th>
                    </tr>
                    <?php if(!empty($training_info)): ?>
                        <?php $__currentLoopData = $training_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(training_info($training['training_type'])); ?></td>
                                <td><?php echo e($training['training_title']); ?></td>
                                <td><?php echo e($training['institute_name']); ?></td>
                                <td><?php echo e($training['from_date']); ?></td>
                                <td><?php echo e($training['to_date']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Promotion Information</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Designation</th>
                        <th>Increment Date</th>
                        <th>G.O Date</th>
                        <th>Nature of Increment</th>
                        <th>Pay Scale</th>
                    </tr>
                    <?php if(!empty($promotion_info)): ?>
                        <?php $__currentLoopData = $promotion_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($promotion['promotion_designation']); ?></td>
                                <td><?php echo e($promotion['increment_date']); ?></td>
                                <td><?php echo e($promotion['go_date']); ?></td>
                                <td><?php echo e($promotion['nature_increment']); ?></td>
                                <td><?php echo e($promotion['pay_scale']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Posting Record/Experience</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Organigation</th>
                        <th>Post</th>
                        <th>Office Address</th>
                        <th>Department</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Payscale</th>
                    </tr>

                    <?php if(!empty($job_history)): ?>
                        <?php $__currentLoopData = $job_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($job_info['organigation']); ?></td>
                                <td><?php echo e($job_info['post']); ?></td>
                                <td><?php echo e($job_info['office_address']); ?></td>
                                <td><?php echo e($job_info['department']); ?></td>
                                <td><?php echo e($job_info['job_from_date']); ?></td>
                                <td><?php echo e($job_info['job_to_date']); ?></td>
                                <td><?php echo e($job_info['job_payscale']); ?></td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </table>
            </td>
        </tr>


        <tr>
            <td colspan="4" class="employee-details-heading">Emergencey Contact Person Information
            </td>
        </tr>
        <?php if(!empty($emergency_contact)): ?>
            <tr>
                <th>Contact Person</th>
                <td>: <?php echo e($emergency_contact->emergencey_contact_person); ?></td>
                <th class="emp-text-right">Relation With You</th>
                <td>: <?php echo e($emergency_contact->relation_contact_person); ?></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>: <?php echo e($emergency_contact->emergency_contact_mobile); ?></td>
                <th class="emp-text-right">Email</th>
                <td>: <?php echo e($emergency_contact->emergency_contact_email); ?></td>
            </tr>

            <tr>
                <th>Address</th>
                <td colspan="3">: <?php echo e($emergency_contact->emergency_contact_address); ?></td>
            </tr>
        <?php endif; ?>

        <tr>
            <td colspan="4" class="employee-details-heading">Disciplinary Action</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Nature of Offence</th>
                        <th>Date</th>
                        <th>Punishment</th>
                        <th>Remarks</th>
                    </tr>

                    <?php if(!empty($employee_action)): ?>
                        <?php $__currentLoopData = $employee_action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp_action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($emp_action['employee_action']); ?></td>
                                <td><?php echo e($emp_action['punishment_date']); ?></td>
                                <td><?php echo e($emp_action['punishment']); ?></td>
                                <td><?php echo e($emp_action['remarks']); ?></td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="4" class="employee-details-heading">Exit And Feedback Information
            </td>
        </tr>
        <?php if(!empty($exit_feedback)): ?>
            <tr>
                <th>Reason of Resignation</th>
                <td>: <?php echo e($exit_feedback->reason_of_resignation); ?></td>
                <th class="emp-text-right">Date of Resignation</th>
                <td>: <?php echo e($exit_feedback->resignation_date); ?></td>
            </tr>
            <tr>
                <th>New Work Place</th>
                <td colspan="3">: <?php echo e($exit_feedback->new_work_place_address); ?></td>
            </tr>
            <tr>
                <th>Employee Comments</th>
                <td>: <?php echo e($exit_feedback->comments_employee); ?></td>
                <th class="emp-text-right">Authority Comments</th>
                <td>: <?php echo e($exit_feedback->comments_authority); ?></td>
            </tr>


        <?php endif; ?>


    </table>
<style>
    * {
        font-family: Arial, Verdana, sans-serif;
        font-size: 11px;
    }
    .width100per{
        width:100% !important;
    }
    #table-style{
        margin-top:10px;
        margin-bottom:10px;

    }
    #table-style td{
        border: 1px solid #d0d0d0;
        vertical-align: top !important;
        color:#333 !important;
    }
    #table-style th{
        border: 1px solid #d0d0d0;
        vertical-align: top !important;
    }
    .pagebreak { page-break-before: always; }
    .no-border{border-width:0!important}.no-border-transparent{border-color:transparent!important}.no-border-radius{border-radius:0;-moz-border-radius:0;-webkit-border-radius:0}
</style>