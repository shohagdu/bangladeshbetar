<aside id="left-panel">
<?php
$segment1 =  Request::segment(1);
$segment2 =  Request::segment(2);
$combine_segment=$segment1."/".$segment2;
//$roles = get_user_access_role();
?>


<!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->
            <a href="javascript:void(0);" id="show-shortcut" >
                <i class="glyphicon glyphicon-user fa-lg"></i>
                <span style="padding-left:5px;">
                    <?php echo e((isset(session('user_info')->name) && !empty(session('user_info')->name))?session('user_info')->name:''); ?>

                </span>
            </a>
        </span>
    </div>
    <nav>
        <ul>
            <li class="active">
                <a href="<?php  echo asset('/human_resource');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Deshboard</span></a>
            </li>

            <li >
                <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Human Resource</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['employee_info'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/employee_info');?>">Employee Record</a>
                    </li>
                    <li <?php if(in_array($segment1,['employee_salary_assign'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/employee_salary_assign');?>">Employee Salary Assign</a>
                    </li>


                </ul>
            </li>
            <li >
                <a href="#"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Payroll</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['payroll_generate'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/payroll_generate');?>">Payroll Generate</a>
                    </li>
                    <li <?php if(in_array($segment1,['payroll_record'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/payroll_record');?>">Payroll Record</a>
                    </li>
                </ul>
            </li>




            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent" >Leave</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['employee_leave_app'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/employee_leave_app');?>">Leave</a>
                    </li>



                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent" >Loan</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['employee_loan_app'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/employee_loan_app');?>">Loan</a>
                    </li>


                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent" >Attendance</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['employee_manual_app'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/employee_manual_app');?>">Manual Attendance</a>
                    </li>
                    <li <?php if(in_array($segment1,['attendance_entry'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/attendance_entry');?>">Attendance Entry</a>
                    </li>
                    <li <?php if(in_array($segment1,['attendance_record'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/attendance_record');?>">Attendance Record</a>
                    </li>

                    <li <?php if(in_array($segment1,['holidays_record'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/holidays_record');?>">Holiday Info.</a>
                    </li>


                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent" >Report</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['employee_designation_report'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/employee_designation_report');?>">Designation Wise</a>
                    </li>
                    <li <?php if(in_array($segment1,['employee_department_report'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/employee_department_report');?>">Department Wise</a>
                    </li>
                     <li <?php if(in_array($segment1,['employee_education_report'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/employee_education_report');?>">Education Degree Wise</a>
                    </li>



                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >Configuration</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['branch_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/branch_setup');?>">Station Setup</a>
                    </li>
                    <li <?php if(in_array($segment1,['bank_info_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/bank_info_setup');?>">Bank Setup</a>
                    </li>
                    <li <?php if(in_array($segment1,['leave_type_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/leave_type_setup');?>">Leave Category</a>
                    </li>
                    <li <?php if(in_array($segment1,['department_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/department_setup');?>">Department</a>
                    </li>
                    <li <?php if(in_array($segment1,['designation_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/designation_setup');?>">Designation</a>
                    </li>
                    <li <?php if(in_array($segment1,['nationality_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/nationality_setup');?>">Nationality</a>
                    </li>
                    <li <?php if(in_array($segment1,['edu_degree_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/edu_degree_setup');?>">Education Degree</a>
                    </li>

                    <li <?php if(in_array($segment1,['earning_ctg_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/earning_ctg_setup');?>">Earning Category</a>
                    </li>
                    <li <?php if(in_array($segment1,['deduction_ctg_setup'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/deduction_ctg_setup');?>">Deduction Category</a>
                    </li>
                    <li <?php if(in_array($segment1,['get_montly_open'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_montly_open');?>">Months Setup</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Management</span></a>
                <ul>

                    <li <?php if(in_array($segment1,['user_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/user_list');?>">User Info</a>
                    </li>
                    <li <?php if(in_array($segment1,['user_access_control'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/user_access_control');?>">User Access</a>
                    </li>

                    <li <?php if(in_array($segment1,['company_info'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/company_info');?>">Organization Info.</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>

