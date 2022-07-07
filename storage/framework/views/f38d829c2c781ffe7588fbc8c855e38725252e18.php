<?php echo Form::open(['url' => '/save_employee_employement_info', 'method' => 'post', 'id' => 'employee_employement_form','class'=>'form-horizontal']); ?>

<div class="modal-body">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="col-md-2 control-label">Department</label>
            <div class="col-md-4">
                <select id="department" class="form-control" name="department">
                    <option value="">Select</option>
                    <?php if(!empty($department_info)): ?>
                        <?php $__currentLoopData = $department_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e((!empty($employe_info->department_id) && $employe_info->department_id==$key)?"selected":''); ?> ><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
            <label class="col-md-2 control-label">Designation</label>
            <div class="col-md-4">
                <select id="designation" class="form-control" name="designation">
                    <option value="">Select</option>
                    <?php if(!empty($designation_info)): ?>
                        <?php $__currentLoopData = $designation_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e((!empty($employe_info->designation_id) && $employe_info->designation_id==$key)?"selected":''); ?> ><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Joining Date</label>
            <div class="col-md-4">
                <input type="text" id="join_date"
                       value="<?php echo e((empty($employe_info->join_date) || ($employe_info->join_date=='0000-00-00') )?"":date('d-m-Y',strtotime($employe_info->join_date))); ?>"
                       class="form-control datepickerinfo" placeholder="Joining Date" name="join_date"/>
            </div>

            <label class="col-md-2 control-label">LPR Date</label>
            <div class="col-md-4">
                <input type="text" id="lpr_date"
                       value="<?php echo e((empty($employe_info->lpr_date) || ($employe_info->lpr_date=='0000-00-00') )?"":date('d-m-Y',strtotime($employe_info->lpr_date))); ?>"
                       class="form-control datepickerinfo" placeholder="LPR Date" name="lpr_date"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Reporting Person</label>
            <div class="col-md-4">
                <select id="reporting_person" class="select2" name="reporting_person">
                    <option value="">Select</option>
                    <?php if(!empty($reporting_person)): ?>
                        <?php $__currentLoopData = $reporting_person; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e((!empty($employe_info->reporting_person) && $employe_info->reporting_person==$key)?"selected":''); ?>><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
            <label class="col-md-2 control-label">PRL Date</label>
            <div class="col-md-4">
                <input type="text" id="prl_date"
                       value="<?php echo e((empty($employe_info->prl_date) || ($employe_info->prl_date=='0000-00-00') )?"":date('d-m-Y',strtotime($employe_info->prl_date))); ?>"
                       class="form-control datepickerinfo" placeholder="PRL Date" name="prl_date"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label"> </label>
            <div class="col-md-4">
                <div class="form-check">
                    <input type="checkbox" name="is_roster_duty"
                           <?php echo e((!empty($employe_info->is_roster_duty) &&  $employe_info->is_roster_duty==1 )?"checked":''); ?>  class="form-check-input"
                           id="is_roster_duty">
                    <label class="form-check-label" for="exampleCheck1">Roster Duty</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-md-5">
                <table class="width100per table table-bordered">
                    <tr>
                        <th colspan="4">Time Table</th>
                    </tr>
                    <tr>
                        <th>Checked</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    <?php
                    $time_table = (!empty($employe_info->time_table) ? json_decode($employe_info->time_table, true) : NULL);
                    $dowMap = show_day_info();
                    if(!empty($dowMap)){
                    foreach ($dowMap as $key=> $day_name){
                    ?>
                    <tr>
                        <td><input type="checkbox"
                                   <?php echo e((isset($time_table[$key]['checked']) && $time_table[$key]['checked']==1)?'Checked':''); ?> name="day_checked[<?php echo e($key); ?>]"
                                   id="day_checked_<?php echo $key; ?>">

                        </td>
                        <td><?php echo e($day_name); ?><input type="hidden" name="day[]" value="<?php echo e($day_name); ?>"></td>
                        <td><input type="text" class="form-control timepicker" id="start_time_<?php echo $key; ?>"
                                   name="start_time[]"
                                   value="<?php echo e((!empty($time_table[$key]['start_time']))? date('h:i a',strtotime($time_table[$key]['start_time'])):'9.00 am'); ?>">
                        </td>
                        <td><input type="text" class="form-control timepicker" id="end_time_<?php echo $key; ?>"
                                   name="end_time[]"
                                   value="<?php echo e((!empty($time_table[$key]['end_time']))? date('h:i a',strtotime($time_table[$key]['end_time'])):'5:00 pm'); ?>">
                        </td>
                    </tr>
                    <?php
                    }
                    }
                    ?>

                </table>
            </div>
            <div class="col-sm-offset-1 col-md-5">
                <table class="width100per table table-bordered">
                    <tr>
                        <th colspan="3">Leave Balance in year</th>
                    </tr>
                    <tr>
                        <th class="width10per"> Checked</th>
                        <th>Leave Type</th>
                        <th class="width10per">Balance(Days)</th>
                        <th class="width10per">Consume</th>
                        <th class="width10per">Remaining</th>
                    </tr>

                    <?php
                    $leave_assign_info = (!empty($leave_assign_info) ? json_decode($leave_assign_info, true) : NULL);

                    $leave_assing_data=[];
                    if(!empty($leave_assign_info)){
                        foreach ($leave_assign_info as $key=> $assign){
                            $leave_assing_data[$assign['type_id']]=[
                                 'checked'=>$assign['checked'],
                                 'limit'=>$assign['limit'],
                                 'consume'=>$assign['consume'],
                                 'remaining'=>$assign['remaining'],
                            ];
                        }
                    }
                    $leave_balance = (!empty($leave_ctg) ? json_decode($leave_ctg, true) : NULL);
                    if(!empty($leave_balance)){
                        foreach ($leave_balance as $k=> $leave){
                            $key=$leave['id']
                        ?>
                        <tr>
                            <td><input type="checkbox" <?php echo e((isset($leave_assing_data[$key]['checked']) && $leave_assing_data[$key]['checked']==1)?'Checked':''); ?>  name="leave_type_checked[<?php echo e($key); ?>]"
                                       id="leave_type_checked_<?php echo $key; ?>"></td>
                            <td><?php echo e($leave['title']); ?><input type="hidden" name="leave_type[]" value="<?php echo e($key); ?>"></td>
                            <td>
                                <input type="text" class="form-control"  id="leave_balance_<?php echo $key; ?>"
                                       name="leave_limit[]" <?php echo e((empty($leave['has_leave_limit']))?'readonly':''); ?> value="<?php echo e((!empty($leave_assing_data[$key]['limit']))?$leave_assing_data[$key]['limit']:(($leave['leave_balance']>0)?$leave['leave_balance']:'No Limit')); ?>">
                            </td>
                            <td>
                                <input type="text" readonly class="form-control" id="consume_<?php echo $key; ?>"
                                       name="consume[]" value="<?php echo e((!empty( $leave_assing_data[$key]['consume'])?$leave_assing_data[$key]['consume']:0)); ?>">
                            </td>
                            <td>
                                <input type="text"  readonly class="form-control" id="remaining_<?php echo $key; ?>"
                                       name="remaining[]" value="<?php echo e((!empty( $leave_assing_data[$key]['remaining'])?$leave_assing_data[$key]['remaining']:0)); ?>">
                            </td>
                        </tr>
                        <?php
                        }
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output_employeement"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="<?php echo e($employe_info->employee_id); ?>">
        <button type="button" onclick="updateEmployementInfo()" id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#education"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>


    </div>

</div>
<?php echo Form::close(); ?>


