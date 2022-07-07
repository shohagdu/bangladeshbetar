
<?php $__env->startSection('title_area'); ?>
    :: উৎসবাদী ও বার্ষিকীর তালিকা  ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> উৎসবাদী ও বার্ষিকীর তালিকা</h2>

                <button type="button"data-toggle="modal" onclick="addEventYearlyProgram()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">নং</th>
                                <th>  ক্যাটাগরি</th>
                                <th>  স্ট্যাটাস</th>
                                <th style="width: 10%"> #</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            // echo "<pre>";
                            //print_r($get_rate_chart);
                            ?>
                            <?php if(!empty($get_fixed_program_type)): ?>
                                <?php $__currentLoopData = $get_fixed_program_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>  <?php echo e($i++); ?></td>
                                        <td>  <?php echo e($singleData->name); ?></td>
                                        <td class="<?php echo e(($singleData->is_active==1)?"Active":"Inactive"); ?>"><?php echo e(($singleData->is_active==1)?"Active":"Inactive"); ?>  </td>

                                        <td>

                                            <button type="button"data-toggle="modal" data-target="#exampleModal"
                                                    onclick="updateEventYearlyProgram('<?php echo e(json_encode($singleData)); ?>')"
                                                    class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i></button>

                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:85%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span>  </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <?php echo Form::open(['url' => '', 'id' => 'event_yearly_program_setup_form','method' => 'post',
                'class'=>'form-horizontal']); ?>

                <div >
                    <div class="col-sm-12" style="margin-top:10px;">


                        <div class="form-group">
                            <label class="col-md-3 control-label">  ক্যাটাগরি</label>
                            <div class="col-md-6">
                                <input type="text" required name="category" placeholder="ক্যাটাগরি"  id="category" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">পজিশন</label>
                            <div class="col-md-6">
                                <input type="text"  id="main_display_position" class="form-control onlyNumber"
                                       placeholder="পজিশন"  value="" name="main_display_position"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">স্ট্যাটাস</label>
                            <div class="col-md-6">
                                <select  id="is_active" class="form-control" required  name="is_active">
                                    <option value="">Select</option>
                                    <option value="1" selected>Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>


                        <table class="table width100per table-bordered">
                            <thead>
                            <tr>
                                <th class="width10per">বিবরন</th>
                                <th class="width10per">বাংলা তারিখ</th>
                                <th class="width10per">ইংরেজী তারিখ</th>
                                <th class="width10per">মন্তব্য</th>
                                <th class="width10per">পজিশন</th>
                                <th class="width6per">#</th>
                            </tr>
                            <tr id="new_data" >
                                <td>
                                    <input type="text" placeholder="বিবরন" class="form-control" required
                                           name="event_name[]"
                                           id="event_name_1">
                                </td>
                                <td><input type="text"  id="description" class="form-control" placeholder="বাংলা তারিখ"
                                         name="description[]"/></td>
                                <td><input type="text"  id="eng_event_date_1" class="form-control datepickerLong"
                                           placeholder="ইংরেজী তারিখ"  value="" name="eng_event_date[]"/></td>
                                <td>
                                        <textarea  rows="1" id="remarks_info_1" class="form-control" placeholder="মন্তব্য"
                                                   name="remarks_info[]"></textarea>
                                </td>
                                <td>
                                    <input type="text"  id="display_position_1" class="form-control onlyNumber"
                                           placeholder="পজিশন"  value="" name="display_position[]"/>
                                </td>

                            </tr>
                            </thead>
                            <tbody id="artist_chart_info_add">

                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="11">
                                    <button type="button" class="btn btn-primary btn-sm
                                        artist_expertise_info"><i
                                                class="glyphicon glyphicon-plus"></i> Add
                                    </button>
                                </td>
                            </tr>
                            </tfoot>


                        </table>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6 text-left">
                        <div id="form_output"></div>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" onclick="saveEventYearlyProgram()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                        <button type="button" onclick="saveEventYearlyProgram()" id="updateBtn" class="btn
                        btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>

                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                        <input type="hidden" name="event_id" id="event_id">
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>


    <script>
        var scntartist_chart_info_add = $('#artist_chart_info_add');
        var b = $('#artist_chart_info_add tr').size() + 2;
        $('.artist_expertise_info').on('click', function () {
            $('<tr><td> <input type="text" placeholder="বিবরন" class="form-control" required name="event_name[]"' +
                ' id="event_name_' + b + '"></td><td><input type="text"  id="description" class="form-control" ' +
                'placeholder="বাংলা তারিখ" name="description[]"/></td>  <td><input type="text"  id="eng_event_date_' +
                b +
                '" class="form-control" placeholder="ইংরেজী তারিখ"  value="" name="eng_event_date[]"/></td> <td> <textarea  rows="1" id="remarks_info_' + b + '" class="form-control" placeholder="মন্তব্য" name="remarks_info[]"></textarea>  </td>  <td>  <input type="text"  id="display_position_1" class="form-control onlyNumber"  placeholder="পজিশন"  value="" name="display_position[]"/></td><td><a href="javascript:void(0);"  id="deleteRow_' + b + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntartist_chart_info_add);

            $('#eng_event_date_'+b).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
            });
            b++;
            return false;
        });


    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>