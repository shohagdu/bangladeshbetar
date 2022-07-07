<title>ID Card Print</title>
<?php echo Form::open(['url' => '/save_employee_ict_credentials', 'method' => 'post', 'id' => 'employee_ict_credentials_form','class'=>'form-horizontal']); ?>

<div class="modal-body">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="col-md-4 control-label">Offical Mobile</label>
            <div class="col-md-8">
                <input type="text" id="ict_mobile" value="<?php echo e((!empty($employe_info->office_mobile)?$employe_info->office_mobile:'')); ?>" class="form-control onlyNumber" placeholder="Offical Mobile"  name="ict_mobile"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Offical Email</label>
            <div class="col-md-8">
                <input type="text"  value="<?php echo e((!empty($employe_info->office_email)?$employe_info->office_email:'')); ?>" id="ict_email" class="form-control" placeholder="Offical Email"  name="ict_email"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Extension</label>
            <div class="col-md-8">
                <input type="text"  value="<?php echo e((!empty($employe_info->office_extention)?$employe_info->office_extention:'')); ?>" id="ict_extenstion" class="form-control" placeholder="Extension"  name="ict_extenstion"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-8">

            </div>
        </div>

    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-8">
                <img  src="<?php echo e(((file_exists('images/employee_image/'.$employe_info->image) && !empty($employe_info->image) )?url('images/employee_image/'.$employe_info->image):url('images/default/default-avatar.png'))); ?> " alt="Bangladesh Betar Employee Image"
                      style="height: 150px;width:180px;">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Image</label>
            <div class="col-md-8">
                <input type="file" id="picture" class="form-control"  name="picture"/>
                <input type="hidden" id="old_image" value="<?php echo e($employe_info->image); ?>" class="form-control"  name="old_image"/>
                <i>Image Size Must be Width: 300px and Height:300px</i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-8">
                <img  src="<?php echo e(((file_exists('images/employee_signature/'.$employe_info->signature) && !empty($employe_info->signature))? url('images/employee_signature/'.$employe_info->signature): url('images/default/default-avatar.png'))); ?> " alt="Bangladesh Betar Employee signature"
                      style="height: 40px;width:180px;">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Signature</label>
            <div class="col-md-8">
                <input type="file" id="picture" class="form-control"  name="signature"/>
                <input type="hidden" id="old_signature" value="<?php echo e($employe_info->signature); ?>" class="form-control"  name="old_signature"/>
                <i>Signature Size Must be Width: 100px and Height:60px</i>
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
        <button type="submit"  id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a href="<?php  echo asset('/print_id_card/'.$employe_info->employee_id);?>" target="_blank" title="Print ID Card" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-print"></i> Print ID Card</a>
        <a data-toggle="tab" class="btn btn-danger" href="#training"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>

    </div>
</div>
<?php echo Form::close(); ?>