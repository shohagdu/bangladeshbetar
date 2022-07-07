<?php $__env->startSection('title_area'); ?>
    :: Product Stock Out Information ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 id="title_info_print">Product Stock Out Report </h2>
                <div class="no-print">
                    <button type="button" onclick="print_fun()" class="btn btn-warning btn-xs topbarbutton"><i
                                class="glyphicon glyphicon-print"></i>
                         Print
                    </button>
                </div>
                <div class="show-print-date" style="display:none;">
                    Date: <?php echo e(date('d-m-Y')); ?>

                </div>


            </header>
            <div style="margin-bottom:50px;">
                <div class="widget-body no-padding" style="padding-bottom:50px;">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="margin-top:10px"></div>
                            <div class="no-print">
                            <?php echo Form::open(['url' => '', 'method' => 'post', 'id' => 'product_stock_out_form','class'=>'form-horizontal']); ?>

                            <div class="col-sm-2">
                                <select id="station_id" class="form-control"   name="station_id">
                                    <option value="">Select</option>
                                    <?php if(!empty($station_info)): ?>
                                        <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($station); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="product_ctg" class="form-control"   name="product_ctg" onchange="getSubCategoryInfo(this.value)">
                                    <option value="">Select</option>
                                    <?php if(!empty($product_ctg)): ?>
                                        <?php $__currentLoopData = $product_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ctg->id); ?>"><?php echo e($ctg->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select id="sub_ctg_id" class="form-control"  name="sub_ctg_id">
                                    <option value="">Select Sub Category</option>
                                </select>

                            </div>
                            <div class="col-sm-2">
                                <input type="text" onkeypress="searchAutoComplete(this)"  id="product_name_search" class="form-control" placeholder="Product Name Or Code"  />
                                <input type="hidden"  id="product_id_search" class="form-control"  name="product"/>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" onclick="search_stock_out_info()" id="search_btn" class="btn btn-success btn-sm"   name="search_btn"><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12" style="margin-top:10px;">
                                <div class="col-sm-4" >
                                    <div class="row">
                                        <div id="error_data"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="show_report_info"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_store", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>