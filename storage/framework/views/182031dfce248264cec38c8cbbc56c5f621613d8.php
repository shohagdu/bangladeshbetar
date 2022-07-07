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
        <th > Education</th>
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
                <td>
                    <?php
                    $education_info = (!empty($row->education_info))? JSON_DECODE($row->education_info,TRUE):'';
                    if(!empty($education_info)){
                    ?>
                    <table rules="all" border="1px"  class="table-bordered table  sub-table width100per">
                        <tr>
                            <td>Degree</td>
                            <td nowrap>M.Subject</td>
                            <td>Institute</td>
                            <td nowrap>Passing</td>
                            <td>Result</td>
                            <td>CGPA</td>
                        </tr>
                            <?php
                                foreach ($education_info as $edu_info ){
                                    ?>
                                    <tr>
                                        <td><?php echo e($degree[$edu_info['degree_name']]); ?></td>
                                        <td><?php echo e($edu_info['major_subject']); ?></td>
                                        <td><?php echo e($edu_info['institution']); ?></td>
                                        <td><?php echo e($edu_info['passing_year']); ?></td>
                                        <td><?php echo e($edu_info['result']); ?></td>
                                        <td><?php echo e($edu_info['cgpa']); ?></td>
                                    </tr>
                            <?php
                                }
                           ?>
                    </table>
                    <?php } ?>
                </td>
                <td><?php echo e($row->is_active); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </tbody>
</table>