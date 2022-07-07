<table id="print_table" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th >SL</th>
        <th > employee Id</th>
        <th > Name</th>
        <th > Station</th>
        <th > Mobile</th>
        <th > Department</th>
        <th > Designation</th>
        <th > Status</th>

    </tr>
    </thead>
    <tbody>
    <?php if(empty($data)): ?>
        <tr><td colspan="11" style="text-align:center">No data found.</td></tr>
    <?php endif; ?>
    <?php if(!empty($data)): ?>
        <?php ($i=1); ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i++); ?></td>
                <td><?php echo e($row->employee_id); ?></td>
                <td><?php echo e($row->emp_name); ?></td>
                <td><?php echo e($row->station_name); ?></td>
                <td><?php echo e($row->mobile); ?></td>
                <td><?php echo e($row->department_title); ?></td>
                <td><?php echo e($row->designation_title); ?></td>
                <td><?php echo e($row->is_active); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </tbody>
</table>