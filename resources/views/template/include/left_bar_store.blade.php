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
                <a href="<?php  echo asset('/store');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Deshboard</span></a>
            </li>

            <li >
                <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Stock</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['product_stock_info'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/product_stock_info');?>">Product Stock</a>
                    </li>
                </ul>
            </li>







            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent" <?php if(in_array($segment1,['product_stock_in_report','product_stock_out_report','user_list'])){ echo 'class="active"';} ?>>Report</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['product_stock_in_report'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/product_stock_in_report');?>">Product Stock In</a>
                    </li>
                    <li <?php if(in_array($segment1,['product_stock_out_report'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/product_stock_out_report');?>">Product Stock Out</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" <?php if(in_array($segment1,['product_info','product_category','user_list'])){ echo 'class="active"';} ?>>Configuration</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['product_info'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/product_info');?>">Product Info. </a>
                    </li>
                    <li <?php if(in_array($segment1,['product_category'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/product_category');?>">Product Category</a>
                    </li>
                    <li <?php if(in_array($segment1,['product_sub_category'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/product_sub_category');?>">Product Sub Category</a>
                    </li>
                    <li <?php if(in_array($segment1,['product_unit'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/product_unit');?>">Product Unit</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>

