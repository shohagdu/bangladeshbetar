<table id="print_table" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th data-class="expand"> SL</th>
        <th data-class="expand"> Stock Code</th>
        <th data-class="expand"> Station</th>
        <th data-class="expand"> Product Ctg/Sub-Ctg.</th>
        <th data-class="expand"> Product Info.</th>
        <th data-class="expand"> Reference</th>
        <th data-class="expand"> Room No</th>
        <th data-class="expand"> Purchase Date</th>
        <th data-class="expand"> Warranty</th>
        <th data-class="expand"> Life Time</th>
        <th data-class="expand">Maintenance</th>



    </tr>
    </thead>
    <tbody>
        <?php if(empty($stock_report)): ?>
            <tr><td colspan="11" style="text-align:center">No data found.</td></tr>
        <?php endif; ?>
        <?php if(!empty($stock_report)): ?>
            <?php ($i=1); ?>
            <?php $__currentLoopData = $stock_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($stock->stock_code); ?></td>
                    <td><?php echo e($stock->station_name); ?></td>
                    <td><?php echo e($stock->product_ctg_title." / ".$stock->product_sub_ctg_title); ?></td>
                    <td><?php echo e($stock->product_name); ?></td>
                    <td><?php echo e($stock->product_reference); ?></td>
                    <td><?php echo e($stock->room_no); ?></td>
                    <td><?php echo e($stock->purchase_date_show); ?></td>
                    <td><?php echo e($stock->warranty_info_show); ?></td>
                    <td><?php echo e($stock->life_time_info_show); ?></td>
                    <td><?php echo e(($stock->maintainance_info_show=='Yes')?$stock->maintainance_info_show."(".$stock->maintance_details.")":$stock->maintainance_info_show); ?></td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
</table>