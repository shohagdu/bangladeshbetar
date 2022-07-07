<?php echo Form::open(['url' => '/save_employee_job_hisotry', 'method' => 'post', 'id' => 'employee_job_hisotry_form','class'=>'form-horizontal']); ?>

<div class="modal-body">
    <div class="col-sm-12">
        <table class="table table-bordered width100per">
            <thead>
            <tr>
                <th class="width20per">Organigation</th>
                <th  class="width15per">Post</th>
                <th  class="width15per">Office Address</th>
                <th  class="width15per">Department</th>
                <th  class="width10per">From Date</th>
                <th  class="width10per">To Date</th>
                <th  class="width10per">Payscale</th>
                <th class="width10per">Action</th>
            </tr>
            </thead>
            <?php
            $job_history = (!empty($employee_general_info->job_history)) ? json_decode($employee_general_info->job_history, true) : NULL;
            if(!empty($job_history)){
                $i=101;
                ?>
            <?php $__currentLoopData = $job_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <input type="text" value="<?php echo e((!empty($job['organigation']))?$job['organigation']:''); ?>" name="organigation[]" placeholder="Organigation" class="form-control" id="organigation_<?php echo e($i); ?>">
                </td>
                <td><input type="text" value="<?php echo e((!empty($job['post']))?$job['post']:''); ?>"  name="post[]" placeholder="Post" class="form-control" id="post_<?php echo e($i); ?>"></td>
                <td><input type="text" value="<?php echo e((!empty($job['office_address']))?$job['office_address']:''); ?>"  name="office_address[]" placeholder="Office Address" class="form-control" id="office_address_<?php echo e($i); ?>"></td>
                <td><input type="text" value="<?php echo e((!empty($job['department']))?$job['department']:''); ?>"  name="department[]" placeholder="Department" class="form-control" id="department_<?php echo e($i); ?>"></td>
                <td><input type="text"  value="<?php echo e((!empty($job['job_from_date']))?$job['job_from_date']:''); ?>"  name="job_from_date[]" placeholder="From Date" class="form-control datepickerinfo" id="job_from_date_<?php echo e($i); ?>"></td>
                <td><input type="text" value="<?php echo e((!empty($job['job_to_date']))?$job['job_to_date']:''); ?>"  name="job_to_date[]" placeholder="To Date" class="form-control datepickerinfo" id="job_to_date_<?php echo e($i); ?>"></td>
                <td><input type="text" value="<?php echo e((!empty($job['job_payscale']))?$job['job_payscale']:''); ?>"  name="job_payscale[]" placeholder="Pay Scale" class="form-control" id="job_payscale_<?php echo e($i); ?>"></td>
                <td><a href="javascript:void(0);"  id="deleteRow_<?php echo e($i); ?>"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> Drop</a></td>

            </tr>
                <?php ($i++); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php } ?>
            <tbody id="dynamicJobHistorytr">
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6"><button type="button" class="btn btn-primary btn-sm" id="add_job_history" ><i class="glyphicon glyphicon-plus"></i> Add New</button> </td>
            </tr>
            </tfoot>

        </table>

    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output_job_history"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="<?php echo e($employe_info->employee_id); ?>">
        <button type="button" onclick="updateJobHistoryInfo()" id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#emergency_contact"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>

    </div>
</div>
<?php echo Form::close(); ?>


<script>
    var scntDivJobHistory = $('#dynamicJobHistorytr');
    var k = $('#dynamicJobHistorytr tr').size() + 2;
    $('#add_job_history').on('click', function () {
        $('<tr><td><input type="text" name="organigation[]" placeholder="Organigation" class="form-control" id="organigation_'+ k +'"></td><td><input type="text" name="post[]" placeholder="Post" class="form-control" id="post_'+ k +'"> </td><td><input type="text" name="office_address[]" placeholder="Office Address" class="form-control" id="office_address_'+ k +'"></td><td><input type="text" name="department[]" placeholder="Department" class="form-control" id="department_'+ k +'"></td><td> <input type="text" name="job_from_date[]" placeholder="From Date" class="form-control datepickerinfo" id="job_from_date_'+ k +'"></td><td><input type="text" name="job_to_date[]" placeholder="To Date" class="form-control datepickerinfo" id="job_to_date_'+ k +'"></td><td><input type="text" name="job_payscale[]" placeholder="Pay Scale" class="form-control" id="job_payscale_'+ k +'"></td><td><a href="javascript:void(0);"  id="deleteRow_' + k + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntDivJobHistory);
        $("#job_from_date_" + k ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        }).val();
        $("#job_to_date_" +k  ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        }).val();
        k++;
        return false;
    });
</script>