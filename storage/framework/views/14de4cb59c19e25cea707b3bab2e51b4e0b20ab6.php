
<?php $__env->startSection('title_area'); ?>
    :: Home Page ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article>
        <div class="jarviswidget col-sm-12 col-md-12 col-lg-12" id="wid-id-2" data-widget-colorbutton="false"
             data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
                <h2>Information</h2>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-4" style="margin-top:10px;">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="3">Quick Link</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="2">Leave Application</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            <tr>
                                <td colspan="2">Loan Application</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            <tr>
                                <td colspan="2">Manual Attendance Application</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="col-sm-4">
                        <table class="table table-striped table-hover "
                               style="border:1px solid #d0d0d0;margin-top:10px">
                            <thead>
                            <tr>
                                <th colspan="2">Self Basic Information</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <th style="width:130px;">Employee ID</th>
                                    <td>: <?php echo e((isset(session('user_info')->employee_id) && !empty(session('user_info')->employee_id))?session('user_info')->employee_id:''); ?></td>
                            </tr>
                            <tr>
                                <th style="width:130px;">Employee Name</th>
                                <td>:  <?php echo e((isset(session('user_info')->name) && !empty(session('user_info')->name))?session('user_info')->name:''); ?></td>
                            </tr>
                            <tr>
                                <th style="width:130px;">Department</th>
                                <td>: <?php echo e((isset(session('user_info')->department_title) && !empty(session('user_info')->department_title))?session('user_info')->department_title:''); ?></td>
                            </tr>
                            <tr>
                                <th style="width:130px;">Designation</th>
                                <td>: <?php echo e((isset(session('user_info')->designation_title) && !empty(session('user_info')->designation_title))?session('user_info')->designation_title:''); ?></td>
                            </tr>

                            <tr>
                                <th>Mobile</th>
                                <td>: <?php echo e((isset(session('user_info')->mobile) && !empty(session('user_info')->mobile))?session('user_info')->mobile:''); ?></td>
                            </tr>

                            </tbody>

                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table class="table table-striped table-hover "
                               style="border:1px solid #d0d0d0;margin-top:10px">
                            <tbody>
                            <tr>
                                <th colspan="2" class="text-center">
                                    <?php if( !empty($company_info->company_logo) && file_exists('images/logo/'.$company_info->company_logo) ): ?>
                                        <img src=" <?php echo e(url('images/logo/'.$company_info->company_logo)); ?>"
                                             alt="Woakfh Estate"
                                             style="height: 100px;">
                                    <?php else: ?>
                                        <img src=" <?php echo e(url('images/default/default-avatar.png')); ?>" alt="Woakfh Estate"
                                             style="height: 100px;">
                                    <?php endif; ?>
                                </th>
                            </tr>
                            <tr>
                                <th style="width:130px;">Company Name</th>
                                <td>: <?php echo e($company_info->com_name); ?></td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td>: <?php echo e($company_info->address); ?></td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>: <?php echo e($company_info->mobile); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: <?php echo e($company_info->email); ?></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>




                </div>

            </div>
        </div>
        <div class="jarviswidget col-sm-12 col-md-12 col-lg-12 "  data-widget-colorbutton="false"
             data-widget-editbutton="false" style="float: right;">
            <header>
                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                <h2>Application Information </h2>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-4">
                        <table class="table table-striped table-hover table-bordered" style="border:1px solid #d0d0d0;margin-top:10px">
                            <thead>
                            <tr>
                                <th colspan="3">Last 3 Day Attendance Record</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Date</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                            </tr>
                            <tr>
                                <td>22-04-2019</td>
                                <td>09:15 AM</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>21-04-2019</td>
                                <td>09:11 AM</td>
                                <td>05:12 PM</td>
                            </tr>
                            <tr>
                                <td>20-04-2019</td>
                                <td>09:14 AM</td>
                                <td>05:00 PM</td>
                            </tr>





                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table class="table table-bordered table-striped table-hover "
                               style="border:1px solid #d0d0d0;margin-top:10px">
                            <thead>
                                <tr>
                                    <th colspan="3">Time Table
                                    </th>
                                </tr>
                                <tr>
                                    <th>Day</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                    $time_table =  (isset(session('user_info')->time_table) && !empty(session('user_info')->time_table))? jsonEncodeToDecode(session('user_info')->time_table) :'';
                                ?>
                                <?php if(!empty($time_table)): ?>
                                    <?php $__currentLoopData = $time_table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($time['day']); ?></td>
                                            <td><?php echo e(($time['checked']==1)?date('h:i a',strtotime($time['start_time'])):''); ?></td>
                                            <td><?php echo e(($time['checked']==1)?date('h:i a',strtotime($time['end_time'])):''); ?></td>
                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-4">
                        <table class="table table-bordered table-striped table-hover "
                               style="border:1px solid #d0d0d0;margin-top:10px">
                            <thead>
                                <tr>
                                    <th colspan="4">Leave Balance</th>
                                </tr>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Total Leave</th>
                                    <th>Consume</th>
                                    <th>Remaining</th>
                                </tr>

                            </thead>
                            <tbody>
                            <?php
                            $employee_leave = (!empty($employee_leave_info) ? json_decode($employee_leave_info) : '');
                            ?>
                            <?php if(!empty($employee_leave)): ?>
                                <?php $__currentLoopData = $employee_leave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($leave->checked==1): ?>
                                    <tr>
                                        <td><?php echo e($leave->type_id_title); ?></td>
                                        <td><?php echo e($leave->limit); ?></td>
                                        <td><?php echo e($leave->consume); ?></td>
                                        <td><?php echo e($leave->remaining); ?></td>

                                    </tr>
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>



    </article>
    <article>

        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4"
             data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> Quick Link </h2>
            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header blue">
                            <a href="<?php echo url('/home'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-home icon-size" style=""></i> <span
                                        class="widget-box-text">Dashboard</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header blue">
                            <a href="<?php echo url('/employee_leave_app'); ?>">
                                <i class="glyphicon glyphicon-user icon-size" style=""></i> <span
                                        class="widget-box-text">Human Resource</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header blue">
                            <a href="<?php echo url('/employee_leave_app'); ?>">
                                <i class="glyphicon glyphicon-book icon-size" style=""></i> <span
                                        class="widget-box-text">Program</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header blue">
                            <a href="<?php echo url('/employee_manual_app'); ?>">
                                <i class="glyphicon glyphicon-book icon-size" style=""></i> <span
                                        class="widget-box-text">Store Management</span>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12" style="height:10px;"></div>
                        <div class="col-sm-2 widget-box-header blue">
                            <a href="<?php echo url('/employee_manual_app'); ?>">
                                <i class="glyphicon glyphicon-list-alt icon-size" style=""></i> <span
                                        class="widget-box-text">State Management</span>
                            </a>
                        </div>
                        <div class="col-sm-12" style="height:10px;"></div>


                    </div>


                </div>
            </div>
        </div>
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4"
             data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> Self Care </h2>
            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header orange">
                            <a href="<?php echo url('/my_profile'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-user icon-size" style=""></i> <span
                                        class="widget-box-text">My Profile</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header darkred">
                            <a href="<?php echo url('/employee_leave_app'); ?>">
                                <i class="glyphicon glyphicon-th -list icon-size" style=""></i> <span
                                        class="widget-box-text">My Leave Request</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header blue">
                            <a href="<?php echo url('/employee_leave_app'); ?>">
                                <i class="glyphicon glyphicon-th -list icon-size" style=""></i> <span
                                        class="widget-box-text">My Loan Request</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green">
                            <a href="<?php echo url('/employee_manual_app'); ?>">
                                <i class="glyphicon glyphicon-th -list icon-size" style=""></i> <span
                                        class="widget-box-text">My Attendance Record</span>
                            </a>
                        </div>


                    </div>


                </div>
            </div>
        </div>
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4"
             data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> Configuration</h2>
            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12" style="margin-top:10px;margin-bottom:10px;">
                        <div class="col-sm-2 widget-box-header blue">
                            <a href="<?php echo url('/user_customer'); ?>">
                                <i class="glyphicon glyphicon-open icon-size" style=""></i> <span
                                        class="widget-box-text">User Info.</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green">
                            <a href="<?php echo url('/company_info'); ?>">
                                <i class="glyphicon glyphicon-open icon-size" style=""></i> <span
                                        class="widget-box-text">Company Information</span>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </article>
    <div class="col-sm-12" style="height: 50px;"></div>
    <style>
        .widget-box-header {
            background: #eee;
            padding: 20px !important;
            border-radius: 5px;
            margin-left: 5px;

        }

        .widget-box-header > a {
            color: white;
        }

        .widget-box-header:hover {
            -webkit-box-shadow: 3px 3px 3px 3px #333;
            -moz-box-shadow: 3px 3px 3px 3px #333;
            box-shadow: 3px 3px 3px 3px #333;
        }

        .icon-size {
            font-size: 30px;
        }

        .widget-box-text {
            font-size: 14px;
            font-weight: bolder;
            vertical-align: top;
            padding-left: 10px !important;
        }

        .orange {
            background: orange;
        }

        .blue {
            background: #00add7;
        }

        .green {
            background: #00A65A;
        }

        .darkred {
            background: #F56954;
        }

        .red {
            background: red;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>