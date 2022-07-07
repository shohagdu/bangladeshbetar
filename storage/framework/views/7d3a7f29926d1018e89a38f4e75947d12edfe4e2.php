
<?php $__env->startSection('title_area'); ?>
    :: Dashboard  ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article>
        <div class="jarviswidget col-sm-12 col-md-12 col-lg-6" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
                <h2>Quick Information</h2>

            </header>
            <div>
                <div class="widget-body no-padding" >
                    <div class="col-sm-6" style="margin-top:10px;" >
                        <table class="table table-striped table-hover table-bordered" >

                            <tbody>
                            <tr>
                                <td>Product Stock</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6" style="margin-top:10px;">

                        <table class="table table-striped table-hover table-bordered" >
                            <tbody>
                            <tr>
                                <td>Product Info</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            <tr>
                                <td>Product Category</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>

                            <tr>
                                <td>Product Sub Category</td>
                                <td class="text-right"><a href="" class="badge">0</a></td>
                            </tr>
                            <tr>
                                <td>Product Unit</td>
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
                            <a href="<?php echo url('/product_stock_info'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-list icon-size"style=""></i> <span class="widget-box-text">Product Stock</span>
                            </a>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-book txt-color-white"></i> </span>
            <h2> Report </h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header blue"   >
                            <a href="<?php echo url('/product_stock_in_report'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-list icon-size"style=""></i> <span class="widget-box-text">Stock In </span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header blue"   >
                            <a href="<?php echo url('/product_stock_out_report'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-list icon-size"style=""></i> <span class="widget-box-text">Stock Out </span>
                            </a>
                        </div>


                    </div>


                </div>
            </div>
        </div>

        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-cog txt-color-white"></i> </span>
                <h2> Configuration</h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/product_info'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Product Info</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/product_category'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Product Category</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/product_unit'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Designation</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/product_sub_category'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Product Sub Category</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-12" style="margin-top:10px;margin-bottom:10px;">
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/product_unit'); ?>">
                                <i class="glyphicon glyphicon-folder-open icon-size"style=""></i> <span class="widget-box-text">Product Unit</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="col-sm-12" style="height: 50px;"></div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_store", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>