<link rel="stylesheet" href="{{ asset('fontView') }}/assets/modules/css/custom.css">
<table class="width100per" id="employee_details">
    <?php
    $stock_info=json_decode($stock_info,true);
    $stock_info=$stock_info['data'];
    ?>
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
        <td colspan="4" class="employee-details-heading">Product Stock Details Information</td>
    </tr>

    <tr>
        <th class="width20per">Stock Code</th>
        <td class="width30per">: {{ $stock_info['stock_code'] }} </td>
        <th class=" width20pert">Station Name</th>
        <td class="width30per">: {{ (!empty($stock_info['station_id'])?get_branch_name( $stock_info['station_id']):'')  }}</td>
    </tr>
    <tr>
        <th>Product Name</th>
        <td>: {{ $stock_info['product_info'] }}</td>
        <th>Product Reference</th>
        <td>: {{ $stock_info['product_reference'] }}</td>
    </tr>
    <tr>
        <th>Room No</th>
        <td>: {{ $stock_info['room_no'] }}</td>
        <th>Purchase Date</th>
        <td>: {{ $stock_info['purchase_date'] }}</td>
    </tr>
    <tr>
        <th>Warranty</th>
        <td>: {{ (!empty($stock_info['warranty_count']))?$stock_info['warranty_count']."-".$stock_info['warranty_Info']:$stock_info['warranty_Info'] }}</td>
        <th>Product Life Time</th>
        <td>: {{ (!empty($stock_info['lifetime_count']))?$stock_info['lifetime_count']."-".$stock_info['product_life_time_info']:$stock_info['product_life_time_info'] }}</td>
    </tr>
    <tr>
        <th>Maintenance</th>
        <td>: {{ ($stock_info['is_maintance']==2)?"Yes":'No' }}</td>
        <th>Maintenance Details</th>
        <td>: {{ $stock_info['maintance_details'] }}</td>
    </tr>
    <tr>
        <th>Product User</th>
        <td>: {{ $stock_info['product_user_info'] }}</td>
        <th>Product Status</th>
        <td>: {{ $stock_info['is_active'] }}</td>
    </tr>
</table>
<style>
    * {
        font-family: Arial, Verdana, sans-serif;
        font-size: 11px;
    }
</style>