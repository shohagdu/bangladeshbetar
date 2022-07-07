<?php echo Form::open(['url' => '', 'method' => 'post', 'id' => 'employee_attendance_data_form','class'=>'form-horizontal']); ?>

<input type="hidden" name="searching_param" value="<?php echo e($searching_info); ?>">
<table id="print_table" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th >SL</th>
        <th class="width10per" > employee Id</th>
        <th > Name</th>
        <th > Department</th>
        <th > Designation</th>
        <th class="width5per"  > <input type="checkbox" id="checked_all" > </th>
        <th class="width10per" > In-time</th>
        <th class="width10per"> Out-time</th>

    </tr>
    </thead>
    <tbody>
    <?php if(empty($data)): ?>
        <tr><td colspan="7" style="text-align:center">No data found.</td></tr>
    <?php endif; ?>
    <?php if(!empty($data)): ?>
        <?php ($i=1); ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i++); ?></td>
                <td><?php echo e($row->employee_id); ?>

                    
                    <input type="hidden" name="attendance_id[<?php echo e($row->employee_id); ?>]" value="<?php echo e($row->attendance_id); ?>" class="form-control">
                </td>
                <td><?php echo e($row->emp_name); ?></td>
                <td><?php echo e($row->department_title); ?></td>
                <td><?php echo e($row->designation_title); ?></td>
                <td><input type="checkbox" name="employee_id[<?php echo e($row->employee_id); ?>]" value="<?php echo e($row->employee_id); ?>"  <?php echo e((!empty($row->attendance_id)?"checked":'')); ?> ></td>

                <td><input  type="text" name="in_time[<?php echo e($row->employee_id); ?>]" placeholder="In-Time" value="<?php echo e((empty($row->start_time)?'9:00 am':$row->start_time)); ?>" class="form-control timepicker"> </td>
                <td><input type="text" name="end_time[<?php echo e($row->employee_id); ?>]" placeholder="Out-Time"  value="<?php echo e((empty($row->end_time)?'05:00 pm':$row->end_time)); ?>" class="form-control timepicker"> </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr><td colspan="7" style="text-align:center"><button type="button" onclick="saved_employee_attendance_info()" class="btn btn-success btn-lg"  ><i class="glyphicon glyphicon-ok-sign"></i> Save</button></td></tr>
    <?php endif; ?>
    </tbody>
</table>
<?php echo Form::close(); ?>

<script>
    $(document).ready(function() {
        $('.timepicker').datetimepicker({
            format: 'hh:mm a'
        });
        $('#checked_all').change(function() {
            var checkboxes = $(this).closest('form').find(':checkbox');
            checkboxes.prop('checked', $(this).is(':checked'));
        });
   });
</script>