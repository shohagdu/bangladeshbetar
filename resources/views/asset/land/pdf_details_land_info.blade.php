<link rel="stylesheet" href="{{ asset('fontView') }}/assets/modules/css/custom.css">
<table class="width100per" id="employee_details">
    <tr>
        <td colspan="4" class="no-border">
            <table class="width100per">
                <tr>
                    <td class="width10per vertical-align-top no-border">
                        @if( !empty($company_info->company_logo) && file_exists('images/logo/'.$company_info->company_logo) )
                            <img  src="<?php echo asset('images/logo/'.$company_info->company_logo)?>"  alt="Bangladesh Betar"
                                  style="height: 80px;width:150px;">
                        @else
                            <img  src="<?php echo asset('images/default/default-avatar.png')?>" alt="Bangladesh Betar"
                                  style="height: 80px;width:150px;">
                        @endif

                    </td>
                    <td class="width80per vertical-align-top no-border">
                        <div class="bold font-size-18px">{{ $company_info->com_name }}</div>
                        <div class="bold">{{ $company_info->address }}</div>
                        <div class="bold">Email: {{ $company_info->email }},
                            Mobile: {{ $company_info->mobile  }}</div>
                        <div class="bold">Website: {{ $company_info->web_address }}</div>
                    </td>
                    <td class="width10per vertical-align-top no-border">
                    </td>
                </tr>

            </table>

        </td>
    </tr>
    <tr>
        <td colspan="4" class="employee-details-heading">Land Information</td>
    </tr>

    <tr>
        <th class="width20per">Land No</th>
        <td class="width30per">: {{ $land_info->land_no }} </td>
        <th class="emp-text-right width20pert">Branch Name</th>
        <td class="width30per">: {{ (!empty($land_info->station_id)?get_branch_name( $land_info->station_id):'')  }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td colspan="3">: {{ $land_info->location }}</td>

    </tr>
    <tr>
        <th>Details</th>
        <td colspan="3">: {{ $land_info->details }}</td>

    </tr>
    <tr>
        <th >Khotian No</th>
        <td >: {{ $land_info->khotian_no }}</td>
        <th class="emp-text-right" >Dag No</th>
        <td>: {{ $land_info->dag_no }}</td>
    </tr>
    <tr>
        <th >Mouza No</th>
        <td >: {{ $land_info->mouza_no }}</td>
        <th class="emp-text-right" >Zer No</th>
        <td>: {{ $land_info->zer_no }}</td>
    </tr>
    <tr>
        <th>Area </th>
        @php
            $area_info = App\All_stting::find($land_info->area);    
        @endphp
        <td >: {{ $area_info->title }}</td>
        <th class="emp-text-right" >Land Quantity</th>
        <td>: {{ $land_info->land_quantity }}</td>
    </tr>
    <tr>
        <th >Last Payment Tax DT</th>
        <td >: {{ $land_info->last_date_tax }}</td>
        <th >Has Case</th>
        <td colspan="3" >: {{ ($land_info->is_found_case==1)?"No":"Yes" }}</td>
    </tr>
    @if($land_info->is_found_case==2)
        <tr>
            <th >Case Details</th>
            <td >: {{ $land_info->case_details }}</td>
            <th class="emp-text-right" >Case Update</th>
            <td>: {{ $land_info->case_last_update }}</td>
        </tr>
        <tr>
            <th >Case Status</th>
            <td colspan="3">:  {{ ($land_info->case_status!='')?(($land_info->case_status==1)?"Pending":"Complete"):''}}</td>
        </tr>
    @endif
</table>
<style>
    * {
        font-family: Arial, Verdana, sans-serif;
        font-size: 11px;
    }
    .width100per{
        width:100% !important;
    }
    #table-style{
        margin-top:10px;
        margin-bottom:10px;

    }
    #table-style td{
        border: 1px solid #d0d0d0;
        vertical-align: top !important;
        color:#333 !important;
    }
    #table-style th{
        border: 1px solid #d0d0d0;
        vertical-align: top !important;
    }
    .pagebreak { page-break-before: always; }
    .no-border{border-width:0!important}.no-border-transparent{border-color:transparent!important}.no-border-radius{border-radius:0;-moz-border-radius:0;-webkit-border-radius:0}
</style>