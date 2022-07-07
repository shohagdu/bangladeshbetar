@extends("master_hr")
@section('title_area')
    :: Home Page ::
@endsection
@section('main_content_area')
    <article>
        <div class="jarviswidget col-sm-12 col-md-12 col-lg-6" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
                <h2>Qucick Information</h2>

            </header>
            <div>
                <div class="widget-body no-padding" >
                    <div class="col-sm-6" style="margin-top:10px;" >
                        <table class="table table-striped table-hover table-bordered" >

                            <tbody>
                            <tr>
                                <td>Total Employee</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            <tr>
                                <td>Total Leave App.</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>

                            <tr>
                                <td>Total Loan App.</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            <tr>
                                <td>Total Manual Attendance</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6" style="margin-top:10px;">

                        <table class="table table-striped table-hover table-bordered" >
                            <tbody>
                            <tr>
                                <td>Today Employee Add</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            <tr>
                                <td>Today Leave App</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>

                            <tr>
                                <td>Today Loan App.</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            <tr>
                                <td>Today Manual App.</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </article>
    <article>
        <!-- new widget -->
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> Quick Link </h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header blue"   >
                            <a href="<?php echo url('/employee_info'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-list icon-size"style=""></i> <span class="widget-box-text">Employee Record</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header blue"  >
                            <a href="<?php echo url('/employee_salary_assign'); ?>">
                                <i class="glyphicon glyphicon-th -list icon-size"style=""></i> <span class="widget-box-text">Employee Payroll Assign</span>
                            </a>
                        </div>
                         <div class="col-sm-2 widget-box-header blue"  >
                            <a href="<?php echo url('/payroll_generate'); ?>">
                                <i class="glyphicon glyphicon-th -list icon-size"style=""></i> <span class="widget-box-text">Payroll Generate</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header blue"  >
                            <a href="<?php echo url('/payroll_record'); ?>">
                                <i class="glyphicon glyphicon-th -list icon-size"style=""></i> <span class="widget-box-text">Payroll Record</span>
                            </a>
                        </div>


                    </div>


                </div>
            </div>
        </div>
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> Configuration</h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/branch_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Station Setup</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/bank_info_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Bank Setup</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/product_unit'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Designation</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/leave_type_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Leave Category</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-12" style="margin-top:10px;">
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/department_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Department</span>
                            </a>
                        </div>

                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/designation_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Designation</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/nationality_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Nationality</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/edu_degree_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Education Degree</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12" style="margin-top:10px;margin-bottom:10px;">
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/earning_ctg_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Earning Degree</span>
                            </a>
                        </div>

                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/deduction_ctg_setup'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Deduction Degree</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/get_montly_open'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Monthly Setup</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>






    </article>
    <div class="col-sm-12" style="height: 50px;"></div>
    <style>
        .widget-box-header{
            background: #eee;padding:20px !important;border-radius:5px;margin-left:5px;

        }
        .widget-box-header>a{
            color:white;
        }
        .widget-box-header:hover{
            -webkit-box-shadow: 3px 3px 3px 3px #333;
            -moz-box-shadow:    3px 3px 3px 3px #333;
            box-shadow:         3px 3px 3px 3px #333;
        }

        .icon-size{
            font-size: 30px;
        }
        .widget-box-text{
            font-size:14px;font-weight: bolder;vertical-align:top;padding-left:10px !important;
        }
        .orange{
            background: orange;
        }
        .blue{
            background: #00add7;
        }.green{
             background: #00A65A;
         }.darkred{
              background: #F56954;
          }.red{
               background: red;
           }
    </style>
@endsection