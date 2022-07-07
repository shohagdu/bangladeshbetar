<table id="print_table" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th >SL</th>
        <th > Station</th>
        <th > Area </th>
        <th > Land No </th>
        <th > Khotian</th>
        <th > Mouza</th>
        <th > Dag</th>
        <th > location</th>
        <th > Last tax date</th>

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
                <td><?php echo e($row->station_name); ?></td>
                <td><?php echo e($row->area_name); ?></td>
                <td><?php echo e($row->land_no); ?></td>
                <td><?php echo e($row->khotian_no); ?></td>
                <td><?php echo e($row->mouza_no); ?></td>
                <td><?php echo e($row->dag_no); ?></td>
                <td><?php echo e($row->location_name); ?></td>
                <td><?php echo e($row->last_date_tax); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </tbody>
</table>