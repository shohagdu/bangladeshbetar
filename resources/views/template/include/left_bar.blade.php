<aside id="left-panel">
<?php
    $segment1 =  Request::segment(1);
    $segment2 =  Request::segment(2);
    $combine_segment=$segment1."/".$segment2
?>


<!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->
            <a href="javascript:void(0);" id="show-shortcut" >
                <i class="glyphicon glyphicon-user fa-lg"></i>
                <span style="padding-left:5px;">
                    {{ (isset(session('user_info')->name) && !empty(session('user_info')->name))?session('user_info')->name:'' }}
                </span>
            </a>
        </span>
    </div>
    <nav>
        <ul>
            <li class="active">
                <a href="<?php  echo asset('/home');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Deshboard</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent" >Self Care</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['my_profile'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/my_profile');?>">My Profile</a>
                    </li>
                    <li <?php if(in_array($segment1,['my_leave_request'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/my_leave_request');?>">My Leave Request</a>
                    </li>
                    <li <?php if(in_array($segment1,['my_loan_request'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/my_loan_request');?>">My Loan Request</a>
                    </li>
                    <li <?php if(in_array($segment1,['my_atteendance_record'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/my_atteendance_record');?>">Attendance Record</a>
                    </li>
                </ul>
            </li>




        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>

