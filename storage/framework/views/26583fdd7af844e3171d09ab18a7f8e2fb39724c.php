<?php echo Form::open(['url' => '/save_employee_emergency_contact', 'method' => 'post', 'id' => 'employee_emergency_contact_form','class'=>'form-horizontal']); ?>

<div class="modal-body">
    <div class="col-sm-12">
        <?php
        $emergency_contact_info = (!empty($employee_general_info->emergency_contact)) ? json_decode($employee_general_info->emergency_contact, true) : NULL;
        ?>
        <div class="form-group">
            <label class="col-md-2 control-label">Contact Person</label>
            <div class="col-md-4">
                <input type="text" value="<?php echo e((!empty($emergency_contact_info['emergencey_contact_person'])?$emergency_contact_info['emergencey_contact_person']:'')); ?>" id="emergencey_contact_person" class="form-control" placeholder="Contact Person"  name="emergencey_contact_person"/>

            </div>
            <label class="col-md-2 control-label">Relation With You</label>
            <div class="col-md-4">
                <input type="text" value="<?php echo e((!empty($emergency_contact_info['relation_contact_person'])?$emergency_contact_info['relation_contact_person']:'')); ?>" id="relation_contact_person" class="form-control" placeholder="Relation With You"  name="relation_contact_person"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Mobile</label>
            <div class="col-md-4">
                <input type="text" value="<?php echo e((!empty($emergency_contact_info['emergency_contact_mobile'])?$emergency_contact_info['emergency_contact_mobile']:'')); ?>" id="emergency_contact_mobile" class="form-control onlyNumber" placeholder="Mobile"  name="emergency_contact_mobile"/>
            </div>
            <label class="col-md-2 control-label">Email</label>
            <div class="col-md-4">
                <input type="text" value="<?php echo e((!empty($emergency_contact_info['emergency_contact_email'])?$emergency_contact_info['emergency_contact_email']:'')); ?>" id="emergency_contact_email" class="form-control" placeholder="Email"  name="emergency_contact_email"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Address</label>
            <div class="col-md-10">
                <textarea id="emergency_contact_address" class="form-control" placeholder="Address"  name="emergency_contact_address"><?php echo e((!empty($emergency_contact_info['emergency_contact_address'])?$emergency_contact_info['emergency_contact_address']:'')); ?></textarea>
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
        <button type="button" onclick="updateEmergencyContactInfo()" id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#exit_feedback"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>

    </div>
</div>
<?php echo Form::close(); ?>