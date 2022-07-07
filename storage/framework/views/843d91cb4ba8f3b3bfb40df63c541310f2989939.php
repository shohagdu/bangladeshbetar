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

                </td>
                <td><?php echo e($row->emp_name); ?></td>
                <td><?php echo e($row->department_title); ?></td>
                <td><?php echo e($row->designation_title); ?></td>
                <td><?php echo e(date('h:i a',strtotime($row->start_time))); ?> </td>
                <td><?php echo e(date('h:i a',strtotime($row->end_time))); ?> </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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