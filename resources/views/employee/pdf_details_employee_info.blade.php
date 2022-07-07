<link rel="stylesheet" href="{{ asset('fontView') }}/assets/modules/css/custom.css">
{{--<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/bootstrap.min.css">--}}
{{--<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/font-awesome.min.css">--}}

{{--<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/smartadmin-skins.min.css">--}}
<?php
$spouse_info = (!empty($employee_general_info->spouse_info) ? json_decode($employee_general_info->spouse_info, true) : '');
$childeren_info = (!empty($employee_general_info->children_info) ? json_decode($employee_general_info->children_info, true) : '');
$training_info = (!empty($employee_general_info->training_info) ? json_decode($employee_general_info->training_info, true) : '');
$education_info = (!empty($employee_general_info->education_info) ? json_decode($employee_general_info->education_info, true) : '');
$promotion_info = (!empty($employee_general_info->promotion_info) ? json_decode($employee_general_info->promotion_info, true) : '');
$job_history = (!empty($employee_general_info->job_history) ? json_decode($employee_general_info->job_history, true) : '');
$emergency_contact = (!empty($employee_general_info->emergency_contact) ? json_decode($employee_general_info->emergency_contact) : '');
$exit_feedback = (!empty($employee_general_info->exit_feedback) ? json_decode($employee_general_info->exit_feedback) : '');
$disciplinary_action = (!empty($employee_general_info->disciplinary_action) ? json_decode($employee_general_info->disciplinary_action) : '');
$present_address = (!empty($employee_info->present_address) ? json_decode($employee_info->present_address) : '');
$parmanent_address = (!empty($employee_info->parmanent_address) ? json_decode($employee_info->parmanent_address) : '');
$employee_leave = (!empty($employee_leave_info) ? json_decode($employee_leave_info) : '');
?>
    <table class="width100per" id="employee_details_pdf"  >
        <tr>
            <td colspan="4" class="no-border" >
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
                        <td class="vertical-align-top no-border" style="padding-right:10px; "  >
                            <div class="bold font-size-18px">{{ $company_info->com_name }}</div>
                            <div class="bold">{{ $company_info->address }}</div>
                            <div class="bold">Email: {{ $company_info->email }}, Mobile: {{ $company_info->mobile  }}</div>
                            <div class="bold">Website: {{ $company_info->web_address }}</div>
                        </td>
                        <td class="width10per vertical-align-top no-border">
                            <img  src="<?php echo ((file_exists('images/employee_image/'.$employee_info->image) && !empty($employee_info->image) )?asset('images/employee_image/'.$employee_info->image):asset('images/default/default-avatar.png'))?>" alt="Bangladesh Betar"   style="height: 120px;width:153px; border: 1px solid #d0d0d0;">
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Basic Information</td>
        </tr>
        <tr>
            <th class="width20per">Employee ID</th>
            <td class="width30per">: {{ $employee_info->employee_id }} </td>
            <th class="emp-text-right width20pert">Branch Name</th>
            <td class="width30per">: {{ (!empty($employee_info->station_id)?get_branch_name( $employee_info->station_id):'')  }}</td>
        </tr>
        <tr>
            <th>Employee Name</th>
            <td colspan="3">: {{ $employee_info->emp_name }} ({{ $employee_info->emp_short_name }})</td>

        </tr>

        <tr>
            <th >Father's Name</th>
            <td >: {{ $employee_info->father_name }}</td>
            <th class="emp-text-right" >Mother's Name</th>
            <td>: {{ $employee_info->mother_name }}</td>
        </tr>

        <tr>
            <th class="vertical-align-top">Present Address</th>
            @php
                $present_district_info  = App\District::find($present_address->district);
                $present_upazila_info   = App\Upazila::find($present_address->upazila);
            @endphp
            <td>: <b>Vill/House/Road</b>: {{ $present_address->vill_road }}, <b>Post Office</b>: {{ $present_address->post_office }}, <b>Police Station</b>:{{ $present_upazila_info->name }}, <b>District</b>: {{ $present_district_info->name }}
            </td>
            <th class="emp-text-right vertical-align-top">Parmanent Address</th>
            @php
                $parmanent_district_info  = App\District::find($parmanent_address->district);
                $parmanent_upazila_info   = App\Upazila::find($parmanent_address->upazila);
            @endphp
            <td>:
                @if(!empty($parmanent_address))
                    <b>Vill/House/Road</b>:{{ $parmanent_address->vill_road }}, <b>Post Office</b>: {{ $parmanent_address->post_office }}, <b>Police  Station</b>: {{ $parmanent_district_info->name }}, <b>District</b>:{{ $parmanent_upazila_info->name }}
                @endif
            </td>
        </tr>
        @if($employee_info->is_bcs_cadre==1)
            <tr>
                <th>Govt.ID</th>
                <td>: {{ $employee_info->govt_id }}</td>
            </tr>
            <tr>
                <th>Cadre</th>
                <td>: {{ $employee_info->cadre_ctg }}</td>
                <th class="emp-text-right">Batch</th>
                <td>: {{ $employee_info->cadre_batch }}</td>
            </tr>

            <tr>
                <th>Cadre Date</th>
                <td>: {{ $employee_info->cadre_date }}</td>
                <th class="emp-text-right">Confirmation G.O Date</th>
                <td>: {{ $employee_info->cadre_go_date }}</td>
            </tr>
        @endif

        <tr>
            <th>Mobile</th>
            <td>: {{ $employee_info->mobile }}</td>
            <th class="emp-text-right">Email</th>
            <td>: {{ $employee_info->email }}</td>
        </tr>

        <tr>
            <th>Gender</th>
            <td>: {{ (($employee_info->gender==1)?"Male":(($employee_info->gender==2)?"Female":"Other")) }}</td>
            <th class="emp-text-right">Date of Birth</th>
            <td>:  {{ ((empty($employee_info->birth_date) || $employee_info->birth_date =='0000-00-00' || $employee_info->birth_date =='1970-01-01' )?'':date('d-m-Y',strtotime($employee_info->birth_date))) }}</td>
        </tr>
        <tr>
            <th>Religion</th>
            <td>: {{ religion_info($employee_info->religion) }}</td>
            <th class="emp-text-right">Merital Status</th>
            <td>: {{ marital_status($employee_info->marital_status) }}</td>
        </tr>
        <tr>
            <th>Blood Group</th>
            <td>: {{ blood_group_show($employee_info->blood_group) }}</td>
            <th class="emp-text-right">Physical Disability</th>
            <td>: {{ ($employee_info->disability_details==1)?'Yes':'No' }}</td>
        </tr>
        <tr>
            <th>Nationality</th>
            <td>: {{ (!empty($employee_info->nationality)?get_title_info($employee_info->nationality):'') }}</td>
            <th class="emp-text-right">Provides Details(IF Yes)</th>
            <td>: {{ $employee_info->disability_details }}</td>
        </tr>
        <tr>
            <th>National ID. No</th>
            <td>: {{ $employee_info->national_id }}</td>
            <th class="emp-text-right">Birth Certificate No</th>
            <td>: {{ $employee_info->birth_certificate_no }}</td>
        </tr>
        <tr>
            <th>Driving License</th>
            <td>: {{ $employee_info->driving_license_no }}</td>
            <th class="emp-text-right">Passport No</th>
            <td>: {{ $employee_info->passport_no }}</td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Employment Information</td>
        </tr>
        <tr>
            <th>Department</th>
            <td>: {{ (!empty($employee_info->department_id)?get_title_info($employee_info->department_id):'') }}</td>
            <th class="emp-text-right">Designation</th>
            <td>: {{ (!empty($employee_info->designation_id)?get_title_info($employee_info->designation_id):'') }}</td>
        </tr>
        <tr>
            <th>Joining Date</th>
            <td>: {{ date('d-m-Y',strtotime($employee_info->join_date)) }}</td>
            <th class="emp-text-right">PRL Date</th>
            <td>: {{ date('d-m-Y',strtotime($employee_info->prl_date)) }}</td>
        </tr>
        <tr>
            <th>Reporting Person</th>
            <td>:</td>
            <th class="emp-text-right">LPR Date</th>
            <td>: {{ date('d-m-Y',strtotime($employee_info->lpr_date)) }}</td>
        </tr>
        <tr>
            <td colspan="2" class="vertical-align-top">
                <table rules="all" border="1px"  class=" table-bordered width100per leave_info_pdf">
                    <tr>
                        <td colspan="3">Time Table</td>
                    </tr>
                    <tr>
                        <td>Day</td>
                        <td>Start Time</td>
                        <td>End Time</td>
                    </tr>

                    @if(!empty($employee_info->time_table))
                        @foreach(json_decode( $employee_info->time_table,true) as $time)
                            <tr>
                                <td>{{ $time['day'] }}</td>
                                <td>{{ date('h:i a',strtotime($time['start_time'])) }}</td>
                                <td>{{ date('h:i a',strtotime($time['end_time'])) }}</td>
                            </tr>

                        @endforeach
                    @endif
                </table>


            </td>
            <td  colspan="2" class="vertical-align-top">
                <table rules="all" border="1px"  class=" table-bordered width100per leave_info_pdf">
                    <tr>
                        <td colspan="4">Leave Balance</td>
                    </tr>
                     <tr>
                        <td>Leave Type</td>
                        <td>Total Limit</td>
                        <td>Consume</td>
                        <td>Remaining</td>
                    </tr>

                    @if(!empty($employee_leave))
                        @foreach($employee_leave as $leave)
                            <tr>
                                <td>{{ $leave->type_id_title }}</td>
                                <td>{{ $leave->limit }}</td>
                                <td>{{ $leave->consume }}</td>
                                <td>{{ $leave->remaining }}</td>

                            </tr>

                        @endforeach
                    @endif
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Bank Account Information</td>
        </tr>
        <tr>
            <th>Basic Salary</th>
            <td>:
                {{ $employee_salary_data->basic_salary }}
            </td>
            <th class="emp-text-right">Pay Scale</th>
            <td>:   {{ $employee_salary_data->pay_scal }}</td>
        </tr>
        <tr>
            <th>Bank Name</th>
            <td>:  {{ (!empty($employee_salary_data->bank_Id)?get_title_info($employee_salary_data->bank_Id):'') }}</td>
            <th class="emp-text-right">Account No</th>
            <td>:  {{ $employee_salary_data->account_no }}</td>
        </tr>
        {{--<tr>--}}
        {{--<th>PF Inital Balance</th>--}}
        {{--<td>:  {{ $employee_salary_data->pay_scal }}</td>--}}
        {{--<th class="emp-text-right">PF Deduction(%)</th>--}}
        {{--<td>:  {{ $employee_salary_data->pay_scal }}</td>--}}
        {{--</tr>--}}

        <tr>
            <td colspan="4" class="employee-details-heading">Spouse Information</td>
        </tr>
        @if(!empty($spouse_info))
            <tr>
                <th>Spouse Name</th>
                <td>: {{ $spouse_info['spouse_name'] }}</td>
                <th class="emp-text-right">Occupation</th>
                <td>: {{ $spouse_info['spouse_occupation'] }}</td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>: {{ $spouse_info['spouse_mobile'] }}</td>
                <th class="emp-text-right">Designation</th>
                <td>: {{ $spouse_info['spouse_designation'] }}</td>
            </tr>
            <tr>
                <th>Home District</th>
                @php
                   $spouse_district_info  = App\District::find($spouse_info['spouse_home_district']);
                @endphp
                <td>: {{ $spouse_district_info->name }}</td>
                <th class="emp-text-right">Organization</th>
                <td>: {{ $spouse_info['spouse_organization'] }}</td>
            </tr>


            <tr>
                <th>Address</th>
                <td colspan="3">: {{ $spouse_info['spouse_address'] }}</td>
            </tr>
        @endif
        <tr>
            <td colspan="4" class="employee-details-heading">Children Information</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Children Name</th>
                        <th>Sex</th>
                        <th>Date of Birth</th>
                    </tr>

                    @if(!empty($childeren_info))
                        @foreach($childeren_info as $child)
                            <tr>
                                <td>{{ $child['childName'] }}</td>
                                <td>{{ show_gender($child['childSex']) }}</td>
                                <td>{{ $child['child_birth_date'] }}</td>
                            </tr>
                        @endforeach
                    @endif

                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">
                Education Information
            </td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Degree Name</th>
                        <th>Group/Major Subject</th>
                        <th>Board/Institute</th>
                        <th>Passing Year</th>
                        <th>Result</th>
                        <th>GPA</th>
                    </tr>
                    @if(!empty($education_info))
                        @foreach($education_info as $education)
                            <tr>
                                <td>{{ $education['degree_name'] }}</td>
                                <td>{{ $education['major_subject'] }}</td>
                                <td>{{ $education['institution'] }}</td>
                                <td>{{ $education['passing_year'] }}</td>
                                <td>{{ $education['result'] }}</td>
                                <td>{{ $education['cgpa'] }}</td>
                            </tr>
                        @endforeach
                    @endif

                </table>
            </td>
        </tr>


        <tr>
            <td colspan="4" class="employee-details-heading">Training Information</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Training Type</th>
                        <th>Training Title</th>
                        <th>Institute Name</th>
                        <th>From Date</th>
                        <th>To Date</th>
                    </tr>
                    @if(!empty($training_info))
                        @foreach($training_info as $training)
                            <tr>
                                <td>{{ training_info($training['training_type']) }}</td>
                                <td>{{ $training['training_title'] }}</td>
                                <td>{{ $training['institute_name'] }}</td>
                                <td>{{ $training['from_date'] }}</td>
                                <td>{{ $training['to_date'] }}</td>
                            </tr>
                        @endforeach
                    @endif

                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Promotion Information</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Designation</th>
                        <th>Increment Date</th>
                        <th>G.O Date</th>
                        <th>Nature of Increment</th>
                        <th>Pay Scale</th>
                    </tr>
                    @if(!empty($promotion_info))
                        @foreach($promotion_info as $promotion)
                            <tr>
                                <td>{{ $promotion['promotion_designation'] }}</td>
                                <td>{{ $promotion['increment_date'] }}</td>
                                <td>{{ $promotion['go_date'] }}</td>
                                <td>{{ $promotion['nature_increment'] }}</td>
                                <td>{{ $promotion['pay_scale'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="employee-details-heading">Posting Record/Experience</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Organigation</th>
                        <th>Post</th>
                        <th>Office Address</th>
                        <th>Department</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Payscale</th>
                    </tr>

                    @if(!empty($job_history))
                        @foreach($job_history as $job_info)
                            <tr>
                                <td>{{ $job_info['organigation'] }}</td>
                                <td>{{ $job_info['post'] }}</td>
                                <td>{{ $job_info['office_address'] }}</td>
                                <td>{{ $job_info['department'] }}</td>
                                <td>{{ $job_info['job_from_date'] }}</td>
                                <td>{{ $job_info['job_to_date'] }}</td>
                                <td>{{ $job_info['job_payscale'] }}</td>

                            </tr>
                        @endforeach
                    @endif

                </table>
            </td>
        </tr>


        <tr>
            <td colspan="4" class="employee-details-heading">Emergencey Contact Person Information
            </td>
        </tr>
        @if(!empty($emergency_contact))
            <tr>
                <th>Contact Person</th>
                <td>: {{ $emergency_contact->emergencey_contact_person }}</td>
                <th class="emp-text-right">Relation With You</th>
                <td>: {{ $emergency_contact->relation_contact_person }}</td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>: {{ $emergency_contact->emergency_contact_mobile }}</td>
                <th class="emp-text-right">Email</th>
                <td>: {{ $emergency_contact->emergency_contact_email }}</td>
            </tr>

            <tr>
                <th>Address</th>
                <td colspan="3">: {{ $emergency_contact->emergency_contact_address }}</td>
            </tr>
        @endif

        <tr>
            <td colspan="4" class="employee-details-heading">Disciplinary Action</td>
        </tr>
        <tr>
            <td colspan="4" class="no-border">
                <table class=" table-bordered width100per">
                    <tr>
                        <th>Nature of Offence</th>
                        <th>Date</th>
                        <th>Punishment</th>
                        <th>Remarks</th>
                    </tr>

                    @if(!empty($employee_action))
                        @foreach($employee_action as $emp_action)
                            <tr>
                                <td>{{ $emp_action['employee_action'] }}</td>
                                <td>{{ $emp_action['punishment_date'] }}</td>
                                <td>{{ $emp_action['punishment'] }}</td>
                                <td>{{ $emp_action['remarks'] }}</td>

                            </tr>
                        @endforeach
                    @endif
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="4" class="employee-details-heading">Exit And Feedback Information
            </td>
        </tr>
        @if(!empty($exit_feedback))
            <tr>
                <th>Reason of Resignation</th>
                <td>: {{ $exit_feedback->reason_of_resignation }}</td>
                <th class="emp-text-right">Date of Resignation</th>
                <td>: {{ $exit_feedback->resignation_date }}</td>
            </tr>
            <tr>
                <th>New Work Place</th>
                <td colspan="3">: {{ $exit_feedback->new_work_place_address }}</td>
            </tr>
            <tr>
                <th>Employee Comments</th>
                <td>: {{ $exit_feedback->comments_employee }}</td>
                <th class="emp-text-right">Authority Comments</th>
                <td>: {{ $exit_feedback->comments_authority }}</td>
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