<table id="dt_basic" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
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
        <th > #</th>

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
                <td>
                    <button type="button"data-toggle="modal" data-target="#exampleModal" onclick="updateDataUserInfo
                            ('<?php echo e($row->user_primary_id); ?>','<?php echo e($row->emp_name); ?>','<?php echo e($row->mobile); ?>','<?php echo e($row->email); ?>','<?php echo e(''); ?>','<?php echo e($row->employee_id); ?>')" class="btn btn-primary btn-xs">
                        <i class="glyphicon glyphicon-pencil"></i> Update
                    </button>
                    <!--<button type="button" title="Impersonate"   class="btn btn-danger btn-xs"><i class="glyphicon
                    glyphicon-share-alt"></i> Impersonate </button>-->
                    <a href="<?php echo e(url('create_access_control/'.$row->user_primary_id)); ?>" title="Impersonate"   class="btn btn-warning
                    btn-xs"><i class="glyphicon
                    glyphicon-share-alt"></i> Access  </a>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dt_basic').DataTable();
    });
</script>
