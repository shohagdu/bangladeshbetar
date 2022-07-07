    <div class="col-sm-3 no-print">
        <div class="form-group">
            <button type="button" onclick="savePayslipGenerate()"  class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Payrole Process Now </button>

        </div>
    </div>
    <table id="print_table" rules="all" border="1px" class="table table-bordered"  style="width:100%;float: left;">
        <thead>
        <tr>
            <th>SL</th>
            <th width="50px"><input type="checkbox" name="all_checked" id="checkAll" > All</th>
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
        if(!empty($eligible_employee_info) && $eligible_employee_info['status'] == 'success'){
        $i = 1;
        $total_net_paid='0.00';
        foreach($eligible_employee_info['data'] as $key=> $payrole_info){
        ?>
        <tr>
            <td>  {{ $i++  }}</td>
            <td>
                @if($payrole_info['payrole_generated_status']=='NotGenerated')
                    <input type="checkbox" name="employee_id[{{$key  }}]" id="employee_id_{{  $key }}" value=" {{ $payrole_info['employee_id'] }}">
                 @endif
                 @if($payrole_info['payrole_generated_status']=='AlreadyGenerated')
                     <div> {{ 'Already Generate' }}</div>
                 @endif
            </td>
            <td> {{ $payrole_info['employee_id'] }}</td>
            <td> {{ $payrole_info['emp_name'] }}</td>
            <td> {{ $payrole_info['station_name'] }}</td>
            <td> {{ $payrole_info['department_title'] }}</td>
            <td> {{ $payrole_info['designation_title'] }}</td>
            <td>
                <input type="hidden" name="payrole_earning_info[]" id="earning_info_{{  $key }}" class="form-control" value="{{ $payrole_info['payrole_earning_info'] }}">
                <input type="hidden" name="payrole_deduction_info[]" id="earning_info_{{  $key }}" class="form-control" value="{{ $payrole_info['payrole_deduction_info'] }}">
                <table id="print_table" rules="all" border="1px" class="table table-bordered" >
                <?php
                    $total_payable='0.00';
                    $earning_info=json_decode($payrole_info['payrole_earning_info'],true) ;
                    if(!empty($earning_info)){
                        foreach ($earning_info as $key => $earning){
                    ?>
                    <tr>
                        <td>{{ $earning_ctg[$earning['earning_ctg']]  }}  </td>
                        <td>{{ $earning['earning_ctg_per']  }}  </td>
                        <td><?php echo $earning['earning_ctg_amount']; $total_payable+=$earning['earning_ctg_amount']?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    <tr>
                        <th colspan="2">Total Payable</th>
                        <th>{{  number_format($total_payable,2,'.','') }} </th>
                    </tr>
                </table>

                </td>
            <td>
                <table class="table table-bordered" id="print_table" rules="all" border="1px">
                    <?php
                    $total_deduction='0.00';
                    $deduction_info= json_decode($payrole_info['payrole_deduction_info'],true) ;
                    if(!empty($deduction_info)){
                    foreach ($deduction_info as $key => $deduction){
                    ?>
                    <tr>
                        <td>{{ $deduction_ctg[$deduction['deduction_ctg']] }}</td>
                        <td>{{ $deduction['deduction_ctg_per'] }} </td>
                        <td><?php echo $deduction['deduction_ctg_amount']; $total_deduction+=$deduction['deduction_ctg_amount']?></td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                    <tr>
                        <th colspan="2">Total Payable</th>
                        <th>{{ number_format($total_deduction,2,'.','') }} </th>
                    </tr>
                </table>
            </td>
            <td class="text-right">
                {{ $net_paid=number_format($total_payable-$total_deduction,2,'.','')  }}
                @php($total_net_paid+=$net_paid)
            </td>

            <td></td>

        </tr>
       <?php } ?>
        <tr>
            <th class="text-right" colspan="9">Total Net Paid Amount</th>
            <th class="text-right" >{{ number_format($total_net_paid,2,'.','') }}</th>
            <td></td>

        </tr>
        <?php }else{ ?>

            <tr>
                <td colspan="10" style="text-align:center;"><?php echo $eligible_employee_info['message'] ?></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
    <script>
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>

