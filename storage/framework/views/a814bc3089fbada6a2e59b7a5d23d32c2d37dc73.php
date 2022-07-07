<?php $__env->startSection('title_area'); ?>
    :: নতুন ::  বিকল্প উপস্থাপনা তথ্য সমুহ  ::
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
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>বিকল্প উপস্থাপনা তথ্য সমুহ</h2>
                <a href="<?php  echo asset('/program_presentation_create');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    পরিকল্পনা (Planning) List
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'searching_bikolpo_presentation_info_form',
                        'class'=>'form-horizontal']); ?>


                        <div class="col-sm-12" style="margin-top:10px;">
                            <div class="form-group">
                                <label class="col-md-2 control-label">কেন্দ্রের / ইউনিট নাম </label>
                                <div class="col-md-3">
                                    <select id="station_id"  required class="form-control" onchange="getSubStation(this.value)"  name="station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                        <?php if(!empty($station_info)): ?>
                                            <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <label class="col-md-1 control-label"> ফ্রিকোয়েন্সি</label>
                                <div class="col-md-3">
                                    <select id="sub_station_id" onchange="get_fequencey_wise_presentation_info(this
                                    .value,$
                                    ('#station_id').val() )" required class="form-control"
                                            name="sub_station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                </div>
                             </div>
                            <div id="show_bikolpo_data"></div>
                        </div>


                        <?php echo Form::close(); ?>

                        <div class="clearfix"></div>
                        <div class="mydivAjaxImage">
                            <img src="<?php echo e(url('fontView\assets\img\ajax-loader.gif')); ?>" class="ajax-loader" />
                        </div>
                        <div class="col-sm-12" style="margin-bottom:5px;">
                            <button class="btn btn-primary btn-sm" id="add_new_bikolp_info"><i class="glyphicon
                            glyphicon-plus"></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <script>
        var scntDivAwardInfo = $('#show_bikolpo_data');
        var t =   1;
        $('#add_new_bikolp_info').on('click', function () {
            $(`<div class="form-group"><div class="col-md-3">
                <input type="text" placeholder="তারিখ" id="presentration_date_`+t+`"  required
                       class="form-control
                datepickerinfo"  name="presentration_date">

            </div>
            <div class="col-md-2">
                <button type="button" onclick="searching_presentation_info_bikolpo(`+t+`)"
                        id="search_presentation_info"  required class="btn
                btn-success btn-sm"
                        name="search_presentation_info"><i class="glyphicon
                        glyphicon-search"></i> Search
                </button>
            </div></div><div class="clearfix"></div>  <div id="loadDateData_`+t+`">
        </div>`).appendTo(scntDivAwardInfo);
            $("#presentration_date_" + t  ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
            }).val();
            t++;
            return false;
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>