@extends("master")
@section('title_area')
    :: Product Stock Details Information ::

@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
@section('main_content_area')

    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Product Details Information </h2>
                <a href="<?php  echo asset('/product_stock_info/');?>"
                   class="btn btn-primary btn-xs topbarbutton"><i
                            class="glyphicon glyphicon-backward"></i> Product Stock

                </a>
                <?php
                    $stock_info=json_decode($stock_info,true);
                    $stock_info=$stock_info['data'];
                ?>
                <a href="<?php  echo asset('/details_stocks_info/' . $stock_info['id'] . '/pdf');?>"
                   class="btn btn-warning btn-xs topbarbutton"><i
                            class="glyphicon glyphicon-download"></i>
                    PDF Download
                </a>

            </header>
            <div style="margin-bottom:50px;">
                <div class="widget-body no-padding" style="padding-bottom:50px;">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px"></div>
                        <table class="width100per" id="employee_details">
                            <tr>
                                <td colspan="4" class="no-border">
                                    <table class="width100per">
                                        <tr>
                                            <td class="width10per vertical-align-top no-border">
                                                @if( !empty(session('company_logo')) && file_exists('images/logo/'.session('company_logo')) )
                                                    <img src=" {{ url('images/logo/'.session('company_logo'))   }}"
                                                         alt="Bangladesh Betar"
                                                         style="height: 80px;width:113px;">
                                                @else
                                                    <img src=" {{ url('images/default/default-avatar.png')   }}"
                                                         alt="Bangladesh Betar"
                                                         style="height: 80px;width:113px;">
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

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

