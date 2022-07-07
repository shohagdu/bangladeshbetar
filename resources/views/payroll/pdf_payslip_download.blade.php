<link rel="stylesheet" href="{{ asset('fontView') }}/assets/modules/css/custom.css">
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" media="screen"
      href="{{ asset('fontView') }}/assets/css/smartadmin-skins.min.css">
<table class="width100per" id="payslip_pdf">
    <tr>
        <td colspan="4" class="no-border">
            <table class="width100per">
                <tr>
                    <td class="width10per vertical-align-top no-border">
                        @if( !empty($company_info->company_logo) && file_exists('images/logo/'.$company_info->company_logo) )
                            <img src="<?php echo asset('images/logo/' . $company_info->company_logo)?>"
                                 alt="Bangladesh Betar"
                                 style="height: 80px;width:150px;">
                        @else
                            <img src="<?php echo asset('images/default/default-avatar.png')?>" alt="Bangladesh Betar"
                                 style="height: 80px;width:150px;">
                        @endif

                    </td>
                    <td class="vertical-align-top no-border" style="padding-right:10px; ">
                        <div class="bold font-size-18px">{{ $company_info->com_name }}</div>
                        <div class="bold">{{ $company_info->address }}</div>
                        <div class="bold">Email: {{ $company_info->email }}, Mobile: {{ $company_info->mobile  }}</div>
                        <div class="bold">Website: {{ $company_info->web_address }}</div>
                    </td>
                    <td class="width10per vertical-align-top no-border">
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
<div style="height: 800px;">
    <div class="col-sm-12 text-center" style="font-weight: bold;">
        <h3>Salary Payslip of {{ $payslip_info->month_title }}</h3>
    </div>

    <table style="width:100%;" class="table">
        <tr>
            <td style="width:40%">
                <table class="width100per  payslip_pdf">
                    <tr>
                        <td class="width20per">Employee ID: {{ $payslip_info->employee_id }}</td>
                    </tr>
                    <tr>
                        <td class="width20per">Name: {{ $payslip_info->emp_name }}</td>
                    </tr>
                    <tr>
                        <td>Department: {{ $payslip_info->department_title }}</td>
                    </tr>
                    <tr>
                        <td>Designation : {{ $payslip_info->designation_title }}</td>
                    </tr>
                </table>
            </td>
            <td style="width:20%"></td>
            <td style="width:40%;vertical-align: top;">

            </td>
        </tr>
    </table>
    <table style="width:100%;" class="table ">
        <tr>
            <td style="width:42%;margin-right:6%;">
                <table class="width100per  payslip_pdf">
                    <tr>
                        <td class="width70per text-center"> Payables</td>
                        <td class="text-center"> Taka</td>
                    </tr>
                    <?php
                    if(!empty($payslip_info->earning_info)){
                    $total_earning = '0.00';
                    $earning = json_decode($payslip_info->earning_info, true);
                    foreach ($earning as $row){
                    ?>
                    <tr>
                        <td>{{ $row['earning_ctg_title'] }}</td>
                        <td class="text-right">{{ $row['earning_ctg_amount'] }}</td>
                        @php($total_earning+= $row['earning_ctg_amount'])
                    </tr>
                    <?php
                    }
                    }


                    ?>
                    <tr>
                        <td class="text-right">Total Payables</td>
                        <td id="total_earning" class="text-right">{{ number_format($total_earning,2,'.','') }}</td>
                    </tr>
                </table>
            </td>

            <td style="width:42%;">
                <table class="width100per  payslip_pdf">
                    <tr>
                        <td class="width70per text-center"> Deductions</td>
                        <td class="text-center"> Taka</td>
                    </tr>
                    <?php
                    if(!empty($payslip_info->deduction_info)){
                    $total_deduction = '0.00';
                    $earning = json_decode($payslip_info->deduction_info, true);
                    foreach ($earning as $row){
                    ?>
                    <tr>
                        <td>{{ $row['deduction_ctg_title'] }}</td>
                        <td class="text-right">{{ $row['deduction_ctg_amount'] }}</td>
                        @php($total_deduction+= $row['deduction_ctg_amount'])
                    </tr>
                    <?php
                    }
                    }
                    ?>
                    <tr>
                        <td class="text-right">Total Deduction</td>
                        <td class="text-right"><span
                                    id="total_deduction">{{ number_format($total_deduction,2,'.','') }}</span></td>
                    </tr>
                </table>

            </td>

        </tr>

        <tr>
            <td>
                <table class="width70per  payslip_pdf text-center ">
                    <tr>
                        <th class="width50per ">Total Payable:</th>
                        <th class="text-right">{{ number_format($total_earning,2,'.','') }}</th>
                    </tr>
                    <tr>
                        <th>Deduction:</th>
                        <th class="text-right">{{ number_format($total_deduction,2,'.','') }}</th>
                    </tr>
                    <tr>
                        <th>Net Paid:</th>
                        <th class="text-right">{{ number_format($total_earning-$total_deduction,2,'.','') }}</th>
                    </tr>
                </table>
            </td>
            <td class="float:right">
                <table class="width100per  leave_info_pdf">
                    <tr>
                        <td colspan="4"> Leave Information</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>Total</td>
                        <td>Consume</td>
                        <td>Remaining</td>
                    </tr>
                    @if(!empty($payslip_info->lave_info))
                        @foreach(json_decode($payslip_info->lave_info,true) as $leave)
                            <tr>
                                <td>{{ $leave['type_id_title'] }}</td>
                                <td>{{ $leave['limit'] }}</td>
                                <td>{{ $leave['consume'] }}</td>
                                <td>{{ $leave['remaining'] }}</td>

                            </tr>

                        @endforeach
                    @endif
                </table>
            </td>
        </tr>
    </table>

    <div class="col-sm-12 ">
        <b>Net Paid In Word:</b>{{ $payslip_info->in_word }}
    </div>

</div>


<div class="col-sm-12">
    This payslip generated by computer software automatically,it does not require a signature. Generated
    date: {{ $payslip_info->generated_date }}
</div>

<style>
    * {
        font-family: Arial, Verdana, sans-serif;
        font-size: 13px;
    }

    .payslip_pdf td {
        padding: 2px 5px;
        border: 1px solid gray !important;
        color: #333 !important;
        font-size: 13px !important;

    }

    .payslip_pdf th {
        padding: 2px 5px;

        border: 1px solid gray !important;
        font-size: 13px !important;
    }



    #table-style td {
        border: 1px solid #d0d0d0;
        vertical-align: top !important;
        color: #333 !important;
    }

    #table-style th {
        border: 1px solid #d0d0d0;
        vertical-align: top !important;
    }

    .pagebreak {
        page-break-before: always;
    }

    .no-border {
        border-width: 0 !important
    }

    .no-border-transparent {
        border-color: transparent !important
    }

    .no-border-radius {
        border-radius: 0;
        -moz-border-radius: 0;
        -webkit-border-radius: 0
    }

    .margin-left-30per {
        margin-left: 30% !important;;
    }
</style>