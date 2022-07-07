<link rel="stylesheet" href="{{ asset('fontView') }}/assets/modules/css/custom.css">

<table class="width100per table-bordered leave-table" >
    <tr>
        <td colspan="4" class="padding10px">
            <table>
                <tr>
                    <td>
                        @if( !empty($company_info->company_logo) && file_exists('images/logo/'.$company_info->company_logo) )
                            <img  src="<?php echo asset('images/logo/'.$company_info->company_logo)?>"  alt="Bangladesh Betar"
                                  style="height: 100px;width:150px;">
                        @else
                            <img  src="<?php echo asset('images/default/default-avatar.png')?>" alt="Bangladesh Betar"
                                  style="height: 100px;width:150px;">
                        @endif

                    </td>
                    <td style="vertical-align: top;">
                        <div class="bold font-size-18px">{{ $company_info->com_name }}</div>
                        <div class="bold">{{ $company_info->address }}</div>
                        <div class="bold">Email: {{ $company_info->email }}, Mobile: {{ $company_info->mobile  }}</div>
                        <div class="bold">Website: {{ $company_info->web_address }}</div>
                    </td>
                </tr>
            </table>

        </td>
    </tr>

    <tr>
        <th class="width20per">Employee Name</th>
        <td class="width30per">: {{ $leave_info_data->emp_name }}</td>
        <th class="emp-text-right width20pert">Employee ID</th>
        <td class="width30per">: {{ $leave_info_data->employee_id }}</td>
    </tr>
    <tr>
        <th>Department</th>
        <td>: {{ $leave_info_data->department_title }}</td>
        <th class="emp-text-right">Designation</th>
        <td>: {{ $leave_info_data->designation_title }}</td>
    </tr>
    <tr>
        <th>Leave Type</th>
        <td>: {{ $leave_info_data->leave_type }}</td>
        <th class="emp-text-right">Leave Status</th>
        <td>: {{ $leave_info_data->status }}</td>
    </tr>
    <tr>
        <th>Leave Date</th>
        <td colspan="3">: {{ date('d-m-Y',strtotime($leave_info_data->from_date)) }} To {{ date('d-m-Y',strtotime($leave_info_data->to_date)) }} </td>
    </tr>
    <tr>
        <th class="leave-reason">Leave Reason</th>
        <td class="leave-reason"  >: {{ $leave_info_data->leave_reason }} </td>
        <td style="vertical-align: top;" colspan="2">
            <table class="width100per" rules="all" id="table-style" >
                <tr>
                    <th style="width:10px;">SL</th>
                    <th>Leave Type</th>
                    <th style="width:50px;">Remaining(Days)</th>
                </tr>
                @if(!empty($leave_type))
                    @php($i=1)
                    @foreach($leave_type as $key=>$type)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $type }}</td>
                            <td>{{ 2 }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </td>
    </tr>
    <tr>
        <th class="padding-top-50-pixel" colspan="3" ></th>
        <th class="padding-top-50-pixel"  > <span style="border-top:1px dotted #333" >Applicant's Signature & Date</span></th>
    </tr>
    <tr>
        <th class="padding-top-50-pixel" colspan="2" > <span style="border-top:1px dotted #333" >Recommend  Signature & Date</span></th>
        <th  ></th>
        <th  class="padding-top-50-pixel"  > <span style="border-top:1px dotted #333" >Approved Signature & Date</span></th>
    </tr>



</table>