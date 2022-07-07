@extends("master_hr")
@section('title_area')
    :: Leave Application ::

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
    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px" >
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" >
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Leave Application </h2>
                <a href="<?php  echo asset('/employee_leave_app/');?>"
                   class="btn btn-primary btn-xs topbarbutton" ><i
                            class="glyphicon glyphicon-backward"></i>
                    Employee Record
                </a>
                <a href="<?php  echo asset('/view_leave_application'.'/'.$leave_info_data->id.'/pdf');?>"
                   class="btn btn-warning btn-xs topbarbutton" ><i
                            class="glyphicon glyphicon-download"></i>
                    PDF Download
                </a>

            </header>
            <div style="margin-bottom:50px;">
                <div class="widget-body no-padding" style="padding-bottom:50px;"  >
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="margin-top:10px"></div>
                        <table class="width100per table-bordered leave-table" >
                            <tr>
                                <td colspan="4" class="padding10px">
                                    <table>
                                        <tr>
                                            <td>
                                                @if( !empty(session('company_logo')) && file_exists('images/logo/'.session('company_logo')) )
                                                    <img  src=" {{ url('images/logo/'.session('company_logo'))   }}" alt="Bangladesh Betar"
                                                          style="height: 70px;width:113px;">
                                                @else
                                                    <img  src=" {{ url('images/default/default-avatar.png')   }}" alt="Bangladesh Betar"
                                                          style="height: 70px;width:113px;">
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
                                <td class="leave-reason" colspan="2" >: {{ $leave_info_data->leave_reason }} </td>
                                <td style="vertical-align: top;">
                                    <table class="width90per padding10px" id="table-style" >
                                        <tr>
                                            <th>SL</th>
                                            <th>Leave Type</th>
                                            <th>Remaining(Days)</th>
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
                                <th class="padding-top-50-pixel" > <span style="border-top:1px dotted #333" >Recommend Person Signature & Date</span></th>
                                <th colspan="2" ></th>
                                <th  class="padding-top-50-pixel"  > <span style="border-top:1px dotted #333" >Approved Person Signature & Date</span></th>
                            </tr>



                        </table>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

