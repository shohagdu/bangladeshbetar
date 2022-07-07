<aside id="left-panel">
<?php
$segment1           =   Request::segment(1);
$segment2           =   Request::segment(2);
$combine_segment    =   $segment1."/".$segment2
?>
<div class="login-info">
    <span>
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
            <a href="<?php  echo asset('/state');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Deshboard</span></a>
        </li>
        <li >
            <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent"> Immovable Property</span></a>
            <ul>
                <li <?php if(in_array($segment1,['immovable_property'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/immovable_property');?>">Immovable Record</a>
                </li>
            </ul>
        </li>
        <li >
            <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent"> Land Info.</span></a>
            <ul>
                <li <?php if(in_array($segment1,['land_info'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/land_info');?>">Land </a>
                </li>
                <li <?php if(in_array($segment1,['mutation_record'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/mutation_record');?>"> Mutation Record</a>
                </li>
                <li <?php if(in_array($segment1,['tax_payment'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/tax_payment');?>"> Tax Payment</a>
                </li>
                <li <?php if(in_array($segment1,['case_info'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/case_info');?>"> Case Info.</a>
                </li>

            </ul>
        </li>
        <li >
            <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent"> Building Info.</span></a>
            <ul>
                <li <?php if(in_array($segment1,['building_record'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/building_record');?>">Building Record </a>
                </li>
                <li <?php if(in_array($segment1,['maintance_building'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/maintance_building');?>"> Maintance Of Building</a>
                </li>
            </ul>
        </li>
        <li >
            <a href="#"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent"> Report</span></a>
            <ul>

                <li <?php if(in_array($segment1,['report_land_info'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/report_land_info');?>">Land </a>
                </li>
                <li <?php if(in_array($segment1,['report_building'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/report_building');?>">Building Record </a>
                </li>
                <li <?php if(in_array($segment1,['report_maintance_building'])){ echo 'class="active"';} ?> >
                    <a href="<?php  echo asset('/report_maintance_building');?>"> Maintance Of Building</a>
                </li>
            </ul>
        </li>
    </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>
</aside>

