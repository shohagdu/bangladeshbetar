<div class="col-sm-3">
    <div class="form-group">
        <button type="submit"  class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Paid Now </button>

    </div>
</div>
<table id="print_table" rules="all" border="1px" class="table table-bordered"  style="width:100%;float: left;">
    <thead>
    <tr>
        <th>#</th>
        <th><input type="checkbox" name="all_checked" id="checkAll" > All</th>
        <th> Employee ID</th>
        <th> Name</th>
        <th>Station</th>
        <th>Department</th>
        <th>Designation</th>
        <th>Payable Amount</th>
        <th>Deduction Amount</th>
        <th>Net Paid</th>
        <th>Action</th>
    </tr>


    </thead>
    <tbody>
    <?php
    if(!empty($employee_payslip_info) && $employee_payslip_info['status'] == 'success'){
    $i = 1;
    $total_net_paid='0.00';
    foreach($employee_payslip_info['data'] as $key=> $payrole_info){
    ?>
    <tr>
        <td>  <?php echo e($i++); ?></td>
        <td><input type="checkbox" name="employee_id[<?php echo e($key); ?>]" id="employee_id" value=" <?php echo e($payrole_info->employee_id); ?>"></td>
        <td> <?php echo e($payrole_info->employee_id); ?></td>
        <td> <?php echo e($payrole_info->emp_name); ?></td>
        <td> <?php echo e($payrole_info->station_name); ?></td>
        <td> <?php echo e($payrole_info->department_title); ?></td>
        <td> <?php echo e($payrole_info->designation_title); ?></td>
        <td>
            <?php
                $earning_info=json_decode($payrole_info->earning_info,true);
                echo $payable=(!empty($earning_info)?number_format(array_sum(array_column($earning_info,'earning_ctg_amount')),2,'.',''):'0.00');
            ?>
        </td>
        <td>
            <?php
            $deduction_info=json_decode($payrole_info->deduction_info,true);
            echo $deduction=(!empty($deduction_info)?number_format(array_sum(array_column($deduction_info,'deduction_ctg_amount')),2,'.',''):'0.00');
            ?>
        </td>
        <td><?php echo e(number_format($payable-$deduction,2,'.','')); ?></td>
        <td>
            <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#paySlipViewModal"  title="View Payslip" onclick="payslipView('<?php echo e($payrole_info->payslip_id); ?>')"><i class="glyphicon glyphicon-share-alt"></i> View</button>
        </td>

    </tr>
    <?php } ?>

    <?php }else{ ?>

    <tr>
        <td colspan="10" style="text-align:center;"><?php echo $employee_payslip_info['message'] ?></td>
    </tr>
    <?php } ?>
    </tbody>

</table>

<div class="modal fade" id="paySlipViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-6">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title-salary-assign"></span></h5>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-body">

                <div class="col-sm-8">

                    <table class="width100per table table-bordered">
                        <tr>
                            <th rowspan="3" class="width20per">Image</th>
                            <th class="width10per">Emp. ID</th>
                            <td><span id="employee_id_show"></span></td>
                            <th class="width15per">Station Name</th>
                            <td><span id="station_name"></span></td>

                        </tr>
                        <tr>
                            <th> Name</th>
                            <td><span id="employee_name"></span></td>
                            <th>Mobile</th>
                            <td><span id="mobile"></span></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td><span id="department"></span></td>
                            <th>Designation</th>
                            <td><span id="designaion"></span></td>
                        </tr>


                    </table>
                </div>
                <div class="col-sm-offset-1 col-sm-3">
                    <table class="width100per table table-bordered">
                        <tr>
                            <th  class="width50per">Total Payable</th>
                            <th class="width50per"><span id="total_earning"></span></th>
                        </tr>
                        <tr>
                            <th>Total Deduction</th>
                            <th><span id="total_deduction"></span></th>
                        </tr>
                        <tr>
                            <th >Net Paid</th>
                            <th ><span id="net_paid"></span></th>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="show_earning_ctg"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="show_deduction_ctg"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class=" col-sm-7 text-left">
                </div>
                <div class=" col-sm-5">
                    <span id="pdf_url"></span>
                    <button type="button"  class="btn btn-danger" data-dismiss="modal"><i
                                class="glyphicon glyphicon-remove"></i> Close
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>