@extends("master_state")
@section('title_area')
:: Dashboard  ::
@endsection
@section('main_content_area')
<article>
    <div class="jarviswidget col-sm-12 col-md-12 col-lg-6" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-book"></i> </span>
            <h2>Quick Information</h2>

        </header>
        <div>
            <div class="widget-body no-padding" >
                <div class="col-sm-6" style="margin-top:10px;" >
                    <table class="table table-striped table-hover table-bordered" >

                        <tbody>
                        <!--<tr>
                            <td>Immovable Property</td>
                            <td class="text-right"><a href="" class="badge">0</a></td>
                        </tr>-->
                        <tr>
                            <td>Land Info.</td>
                            <td class="text-right"><a href="" class="badge">0</a></td>
                        </tr>

                        <tr>
                            <td>Mutation Record</td>
                            <td class="text-right"><a href="" class="badge">0</a></td>
                        </tr>
                        <tr>
                            <td>Tax Payment</td>
                            <td class="text-right"><a href="" class="badge">0</a></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6" style="margin-top:10px;" >
                    <table class="table table-striped table-hover table-bordered" >

                        <tbody>

                        <tr>
                            <td>Case Info</td>
                            <td class="text-right"><a href="" class="badge">0</a></td>
                        </tr>
                        <tr>
                            <td>Building Record</td>
                            <td class="text-right"><a href="" class="badge">0</a></td>
                        </tr>
                        <tr>
                            <td>Maintance of Building</td>
                            <td class="text-right"><a href="" class="badge">0</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>

    {{--<div class="jarviswidget col-sm-12 col-md-12 col-lg-5 " id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" style="float: right;">--}}
        {{--<header>--}}
            {{--<span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>--}}
            {{--<h2>Company Information </h2>--}}

        {{--</header>--}}
        {{--<div>--}}
            {{--<div class="widget-body no-padding" >--}}
                {{--<div class="col-sm-12">--}}

                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}



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
                    <!--<div class="col-sm-2 widget-box-header blue"   >
                        <a href="<?php echo url('/immovable_property'); ?>" style="margin-top:50px;">
                            <i class="glyphicon glyphicon-list icon-size"style=""></i> <span class="widget-box-text">Immovable Property</span>
                        </a>
                    </div>-->
                    <div class="col-sm-2 widget-box-header blue"  >
                        <a href="<?php echo url('/land_info'); ?>">
                            <i class="glyphicon glyphicon-th -list icon-size"style=""></i> <span class="widget-box-text">Land Info</span>
                        </a>
                    </div>
                    <div class="col-sm-2 widget-box-header blue"  >
                        <a href="<?php echo url('/mutation_record'); ?>">
                            <i class="glyphicon glyphicon-th -list icon-size"style=""></i> <span class="widget-box-text">Mutation Record</span>
                        </a>
                    </div>
                    <div class="col-sm-2 widget-box-header blue"  >
                        <a href="<?php echo url('/tax_payment'); ?>">
                            <i class="glyphicon glyphicon-th -list icon-size"style=""></i> <span class="widget-box-text">Tax Payment</span>
                        </a>
                    </div>
                    <div class="col-sm-12" style="margin-top:10px;"></div>
                    <div class="col-sm-2 widget-box-header blue"  >
                        <a href="<?php echo url('/tax_payment'); ?>">
                            <i class="glyphicon glyphicon-th -list icon-size"style=""></i> <span class="widget-box-text">Building Record</span>
                        </a>
                    </div>
                    <div class="col-sm-2 widget-box-header blue"  >
                        <a href="<?php echo url('/maintance_building'); ?>">
                            <i class="glyphicon glyphicon-th -list icon-size"style=""></i> <span class="widget-box-text">Maintance of Building</span>
                        </a>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
            <h2> Report</h2>
        </header>

        <!-- widget div-->
        <div >
            <div class="widget-body  smart-form" style="margin-bottom:10px;">
                <div class="col-sm-12">
                    <div class="col-sm-2 widget-box-header green"  >
                        <a href="<?php echo url('/report_land_info'); ?>">
                            <i class="glyphicon glyphicon-book icon-size"style=""></i> <span class="widget-box-text">Land Report</span>
                        </a>
                    </div>
                    <div class="col-sm-2 widget-box-header green"  >
                        <a href="<?php echo url('/report_building'); ?>" style="margin-top:50px;">
                            <i class="glyphicon glyphicon-book icon-size"style=""></i> <span class="widget-box-text">Building Report</span>
                        </a>
                    </div>
                    <div class="col-sm-2 widget-box-header green"  >
                        <a href="<?php echo url('/report_maintance_building'); ?>">
                            <i class="glyphicon glyphicon-book icon-size"style=""></i> <span class="widget-box-text">Building Maintance </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</article>
<div class="col-sm-12" style="height: 50px;"></div>

@endsection