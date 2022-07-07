<?php echo Form::open(['url' => '/save_employee_disciplinary_action', 'method' => 'post', 'id' => 'employee_disciplinary_action_form','class'=>'form-horizontal']); ?>

<div class="modal-body">
    <div class="col-sm-12">
    <label class="col-sm-offset-1 col-sm-11">
        Disciplinary Action
    </label>
        <?php
        $disciplinary_action_info = (!empty($employee_general_info->disciplinary_action)) ? json_decode($employee_general_info->disciplinary_action, true) : NULL;
        ?>
        <div class="form-group">
            <label class="col-md-2 control-label">Nature of Offence</label>
            <div class="col-md-4">
                <select id="employee_action" class="form-control" name="employee_action">
                    <option value="">Select</option>
                    <option value="1" <?php echo e(((!empty($disciplinary_action_info['employee_action']) && $disciplinary_action_info['employee_action']==1)?"selected":'')); ?>>Active</option>
                    <option value="2" <?php echo e(((!empty($disciplinary_action_info['employee_action']) && $disciplinary_action_info['employee_action']==2)?"selected":'')); ?>>Inactive</option>
                    <option value="3" <?php echo e(((!empty($disciplinary_action_info['employee_action']) && $disciplinary_action_info['employee_action']==3)?"selected":'')); ?>>Terminate</option>
                    <option value="4" <?php echo e(((!empty($disciplinary_action_info['employee_action']) && $disciplinary_action_info['employee_action']==4)?"selected":'')); ?>>OSD</option>
                </select>

            </div>
            <label class="col-md-2 control-label">Date</label>
            <div class="col-md-4">
                <input type="text" name="punishment_date" value="<?php echo e((!empty($disciplinary_action_info['punishment_date'])?$disciplinary_action_info['punishment_date']:date('d-m-Y') )); ?>"   placeholder="Date of Birth" class="form-control datepickerinfo" id="punishment_date">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Punishment</label>
            <div class="col-md-10">
                <textarea id="punishment" class="form-control" placeholder="Punishment"  name="punishment"><?php echo e((!empty($disciplinary_action_info['punishment'])?$disciplinary_action_info['punishment']:'')); ?> </textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Remarks</label>
            <div class="col-md-10">
                <textarea id="remarks" class="form-control" placeholder="Remarks"  name="remarks"><?php echo e((!empty($disciplinary_action_info['remarks'])?$disciplinary_action_info['remarks']:'')); ?></textarea>
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
        <input type="hidden" name="employee_id" value="<?php echo e($employe_info->employee_id); ?>">
        <button type="submit" id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#basic_info"><i
                    class="glyphicon glyphicon-backward"></i> Back</a>

    </div>
</div>
<?php echo Form::close(); ?>