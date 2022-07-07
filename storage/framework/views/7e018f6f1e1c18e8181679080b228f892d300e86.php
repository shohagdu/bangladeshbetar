<?php $__env->startSection('title_area'); ?>
    :: Payroll generate ::

<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px" >

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" >
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 id="title_info_print">Employee Payroll generate </h2>
                <div class="no-print">
                    <button type="button" onclick="print_fun()" class="btn btn-warning btn-xs topbarbutton"><i
                                class="glyphicon glyphicon-print"></i>
                        Print
                    </button>
                </div>
                <div class="show-print-date" style="display:none;">
                    Date: <?php echo e(date('d-m-Y')); ?>

                </div>
            </header>
            <div>
                <div class="widget-body no-padding"  >
                    <?php echo Form::open(['url' => '/save_employee_payrole_genrate', 'method' => 'post', 'id' => 'employee_payrole_generate_form','class'=>'form-horizontal']); ?>

                    <div class="no-print">
                        <div class="col-sm-12" >
                            <div class="col-sm-12" style="margin-top:10px;"></div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select type="text"  id="payrole_months_generate" class="form-control" name="payrole_months">
                                        <option value="">Select Payslip Months</option>
                                        <?php if(!empty($payslip_months)): ?>
                                            <?php $__currentLoopData = $payslip_months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="show_eligible_employee_payrole"></div>
                    </div>

                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>