<?php echo Form::open(['url' => '/save_employee_training_info', 'method' => 'post', 'id' => 'employee_training_form','class'=>'form-horizontal']); ?>

<div class="modal-body">
    <div class="col-sm-12">
        <table class="table table-bordered width100per">
            <thead>
            <tr>
                <th class="width20per">Training Type</th>
                <th class="width20per">Training Title</th>
                <th class="width20per">Institute Name</th>
                <th class="width15per">From Date</th>
                <th class="width15per">To Date</th>
                <th class="width10per">Action</th>
            </tr>
            </thead>
            <?php
            $training_info = (!empty($employee_general_info->training_info)) ? json_decode($employee_general_info->training_info, true) : NULL;
            if(!empty($training_info)){
                $i=1;
               ?>
            <input type="hidden" value="<?php echo e(count($training_info)); ?> " id="count_training_row">
            <?php $__currentLoopData = $training_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <select name="training_type[]" id="training_type_<?php echo e($i); ?>" class="form-control">
                            <option value="">Select</option>
                            <option value="1"  <?php echo e((!empty($training['training_type']) && $training['training_type']==1)?"selected":''); ?> >Local</option>
                            <option value="2" <?php echo e((!empty($training['training_type']) && $training['training_type']==2)?"selected":''); ?>>Foreign</option>
                        </select>
                    </td>
                    <td><input type="text" name="training_title[]" value="<?php echo e((!empty($training['training_title']))?$training['training_title']:''); ?>" placeholder="Training Title" class="form-control"
                               id="training_title_<?php echo e($i); ?>"></td>
                    <td><input type="text" name="institute_name[]" value="<?php echo e((!empty($training['institute_name']))?$training['institute_name']:''); ?>" placeholder="Institute Name" class="form-control"
                               id="institute_name_<?php echo e($i); ?>"></td>
                    <td><input type="text" name="from_date[]" value="<?php echo e((!empty($training['from_date']))?$training['from_date']:''); ?>"  placeholder="From Date"
                               class="form-control datepickerinfo" id="from_date_<?php echo e($i); ?>"></td>
                    <td><input type="text" name="to_date[]" value="<?php echo e((!empty($training['to_date']))?$training['to_date']:''); ?>" placeholder="To Date" class="form-control datepickerinfo"
                               id="to_date_<?php echo e($i); ?>"></td>
                    <td><a href="javascript:void(0);" id="deleteRow_<?php echo e($i); ?>"
                           class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>
                            Drop</a></td>

                </tr>
                <?php ($i++); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php
            }
            ?>
            <tbody id="dynamicTrainingtr">
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    <button type="button" class="btn btn-primary btn-sm" id="add_training"><i
                                class="glyphicon glyphicon-plus"></i> Add New
                    </button>
                </td>
            </tr>
            </tfoot>

        </table>

    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="<?php echo e($employe_info->employee_id); ?>">
        <button type="button" id="updateBtn" onclick="updateTrainingInfo()" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#spouse_info"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>
    </div>
</div>
<?php echo Form::close(); ?>


<script>
    var scntDivTraining = $('#dynamicTrainingtr');
    var t = parseFloat($('#count_training_row').val()) + 1;
    $('#add_training').on('click', function () {
        $('<tr><td><select name="training_type[]" id="training_type_' + t + '" class="form-control">\n' +
            '                        <option value="">Select</option>\n' +
            '                        <option value="1">Local</option>\n' +
            '                        <option value="2">Foreign</option>\n' +
            '                    </select></td><td><input type="text" name="training_title[]" placeholder="Training Title" class="form-control" id="training_title_' + t + '"> </td><td><input type="text" name="institute_name[]" placeholder="Institute Name" class="form-control" id="institute_name_' + t + '"></td><td> <input type="text" name="from_date[]" placeholder="From Date" class="form-control datepickerinfo" id="from_date_' + t + '"></td><td><input type="text" name="to_date[]" placeholder="To Date" class="form-control datepickerinfo" id="to_date_' + t + '"></td><td><a href="javascript:void(0);"  id="deleteRow_' + t + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntDivTraining);
        $("#from_date_" + t  ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        }).val();
        $("#to_date_" + t  ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        }).val();
        t++;
        return false;
    });
</script>