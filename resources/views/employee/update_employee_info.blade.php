@extends("master_hr")
@section('title_area')
    :: Update Employee Information    ::

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

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" >
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Employee Information </h2>
                <a href="<?php  echo asset('/employee_info');?>"  onclick="addEmployee()"
                        class="btn btn-primary btn-xs topbarbutton" ><i
                            class="glyphicon glyphicon-backward"></i>
                    Employee Record
                </a>
                <a href="<?php  echo asset('/details_employee_info/'.md5($employe_info->employee_id)."/".$employe_info->id.'/pdf');?>"
                        class="btn btn-warning btn-xs topbarbutton" ><i
                            class="glyphicon glyphicon-download"></i>
                   Download
                </a>
                <a href="<?php  echo asset('/details_employee_info/'.md5($employe_info->employee_id)."/".$employe_info->id.'/view');?>"
                        class="btn btn-info btn-xs topbarbutton" ><i
                            class="glyphicon glyphicon-share-alt"></i>
                   View
                </a>


            </header>
            <div>
                <div class="widget-body no-padding"  >
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" href="#basic_info">Basic Info</a></li>
                                <li><a data-toggle="tab" href="#employment">Employement</a></li>
                                <li><a data-toggle="tab" href="#education">Education</a></li>
                                <li><a data-toggle="tab" href="#bank_account">Bank Account</a></li>
                                <li><a data-toggle="tab" href="#ict_credentials">ICT Credentials</a></li>
                                <li><a data-toggle="tab" href="#training">Training</a></li>
                                <li><a data-toggle="tab" href="#promotion">Promotion Info.</a></li>
                                <li><a data-toggle="tab" href="#job_history">Job History</a></li>
                                <li><a data-toggle="tab" href="#spouse_info">Spouse</a></li>
                                <li><a data-toggle="tab" href="#award_info">Award</a></li>
                                <li><a data-toggle="tab" href="#expertise_info">Expertise</a></li>
                                <li><a data-toggle="tab" href="#travel_info">Travel Info</a></li>
                                <li><a data-toggle="tab" href="#departmental_action_info">Departmental Action</a></li>
                                <li><a data-toggle="tab" href="#emergency_contact">Emergency Contact</a></li>
                                <li><a data-toggle="tab" href="#exit_feedback">Exit And Feedback</a></li>
                                <li><a data-toggle="tab" href="#employee_action"> Action</a></li>
                            </ul>
                            <div class="tab-content" style="border: 1px solid #d0d0d0;margin-bottom:10px;">
                                <div id="basic_info" class="tab-pane fade in active">
                                    @include('employee.update_info.basic_info')
                                </div>

                                <div id="employment" class="tab-pane fade">
                                    @include('employee.update_info.employment')
                                </div>

                                <div id="education" class="tab-pane fade">
                                    @include('employee.update_info.education')
                                </div>

                                <div id="bank_account" class="tab-pane fade">
                                    @include('employee.update_info.bank_account')
                                </div>

                                <div id="ict_credentials" class="tab-pane fade">
                                    @include('employee.update_info.ict_credentials')
                                </div>

                                <div id="training" class="tab-pane fade">
                                    @include('employee.update_info.training')
                                </div>

                                <div id="spouse_info" class="tab-pane fade">
                                    @include('employee.update_info.spouse_info')
                                </div>

                                <div id="promotion" class="tab-pane fade">
                                    @include('employee.update_info.promotion')
                                </div>

                                <div id="job_history" class="tab-pane fade">
                                    @include('employee.update_info.job_history')
                                </div>

                                <div id="emergency_contact" class="tab-pane fade">
                                    @include('employee.update_info.emergency_contact')
                                </div>

                                <div id="exit_feedback" class="tab-pane fade">
                                    @include('employee.update_info.exit_feedback')
                                </div>

                                <div id="employee_action" class="tab-pane fade">
                                    @include('employee.update_info.employee_action')
                                </div>

                                <div id="award_info" class="tab-pane fade">
                                    @include('employee.update_info.award_info')
                                </div>
                                <div id="expertise_info" class="tab-pane fade">
                                    @include('employee.update_info.expertise_info')
                                </div>
                                 <div id="travel_info" class="tab-pane fade">
                                    @include('employee.update_info.travel_info')
                                </div>
                                <div id="departmental_action_info" class="tab-pane fade">
                                    @include('employee.update_info.departmental_action_info')
                                </div>






                            </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

