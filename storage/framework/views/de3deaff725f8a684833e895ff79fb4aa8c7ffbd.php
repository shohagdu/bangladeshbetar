
<?php $__env->startSection('title_area'); ?>
    :: শিল্পীর সম্মানীর চার্ট  ::
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
                <h2> শিল্পীর সম্মানীর চার্ট</h2>

                <button type="button"data-toggle="modal" onclick="AddArtistRateChart()" data-target="#exampleModal" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
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
                                <th style="width:5%;">SL</th>
                                <th> সম্মানীর ক্যাটাগরি</th>
                                <th> অনুষ্ঠানের বিবরন </th>
                                <th style="width: 20%"> শ্রেণী</th>

                                <th style="width: 10%"> #</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=1;
                               // echo "<pre>";
                                //print_r($get_rate_chart);
                            ?>
                            <?php if(!empty($get_rate_chart)): ?>
                            <?php $__currentLoopData = $get_rate_chart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>  <?php echo e($i++); ?></td>
                                    <td>  <?php echo e($singleData->artist_song_ctg_title); ?></td>
                                    <td>  <?php echo e($singleData->description); ?></td>
                                    <td>  </td>

                                    <td>

                                        <button type="button"data-toggle="modal" data-target="#exampleModalUpdate"
                                                onclick="UpdateArtistRateChart('<?php echo e($singleData->description_id); ?>',
                                                        '<?php echo e($singleData->ctg_id); ?>')" class="btn btn-primary btn-xs">
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

                <?php echo Form::open(['url' => '', 'id' => 'artist_rate_chart_setup_form','method' => 'post','class'=>'form-horizontal']); ?>

                <div >
                    <div class="col-sm-12" style="margin-top:10px;">

                        
                        <div class="form-group">
                            <label class="col-md-3 control-label"> শিল্পী সম্মানীর ক্যাটাগরি</label>
                            <div class="col-md-6">
                                <select required name="artist_song_ctg"  class="form-control artist_song_ctg">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($artist_song_ctg)): ?>
                                        <?php $__currentLoopData = $artist_song_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3 pull-right text-right">
                                <a href="<?php  echo asset('/program_style_setup');?>" class="btn btn-primary
                                btn-sm text-right"><i
                                            class="glyphicon
                                glyphicon-plus"></i> নতুন ক্যাটাগরি</a>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">অনুষ্ঠানের বিবরন</label>
                            <div class="col-md-6">
                                <select required name="description" id="description" class="form-control description">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>
                            </div>
                            <div class="col-md-3 pull-right text-right">
                                <a href="<?php  echo asset('/artist_honouriam_sub_ctg');?>" class="btn btn-primary
                                btn-sm text-right"><i
                                            class="glyphicon
                                glyphicon-plus"></i> নতুন সাব ক্যাটাগরি</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">ভূমিকা</label>
                            <div class="col-md-6">
                                <select required name="artist_vumika" id="artist_vumika"
                                        class="form-control">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($artist_vumika)): ?>
                                        <?php $__currentLoopData = $artist_vumika; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option  value="<?php echo e($key); ?>" ><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">কর্মক্ষেত্র</label>
                            <div class="col-md-6">
                                <select required name="work_area[]" multiple id="work_area" class=" select2" style="width:100%;" placeholder="চিহ্নিত করুন">
                                    <?php if(!empty($work_area)): ?>
                                        <?php $__currentLoopData = $work_area; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option  value="<?php echo e($key); ?>" ><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <table class="table width100per">
                            <thead>
                                <tr>
                                    <th class="width10per">শ্রেণী</th>
                                    <th class="width10per">অনুষ্ঠানের স্থিতি</th>
                                    <th class="width10per">সম্মানীর পরিমান</th>
                                    <th class="width6per">মহড়া ফি</th>
                                    <th class="width6per">জন(সবোর্চ্চ)</th>
                                    <th class="width10per">মন্তব্য</th>
                                    <th class="width6per">পজিশন</th>
                                    <th class="width6per">স্ট্যাটাস</th>
                                    <th class="width6per">#</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select required name="artist_song_grade[]" id="artist_song_grade_1"
                                                class="form-control">
                                            <option value="">চিহ্নিত করুন</option>
                                            <?php if(!empty($artist_grade_info)): ?>
                                                <?php $__currentLoopData = $artist_grade_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </td>
                                    <td><input type="text"  id="stability_1" class="form-control" placeholder="স্থিতি"
                                               value="" name="stability[]"/></td>
                                    <td><input type="text"  id="amount_1" class="form-control onlyNumber"
                                               placeholder="সম্মানীর পরিমান"  value="" name="amount[]"/></td>
                                    <td> <select  id="mohoda_fee_1" class="form-control" name="mohoda_fee[]">
                                            <option value="2">না</option>
                                            <option value="1">হ্যাঁ</option>
                                        </select>
                                    </td>
                                    <td><input type="text"  id="maximum_artist_1" class="form-control onlyNumber"
                                                     placeholder="জন(সবোর্চ্চ)"  value="" name="maximum_artist[]"/>
                                    </td>

                                    <td>
                                        <textarea  rows="1" id="remarks_info_1" class="form-control" placeholder="মন্তব্য"
                                                   name="remarks_info[]"></textarea>
                                    </td>
                                    <td>
                                        <input type="text"  id="display_position_1" class="form-control onlyNumber"
                                               placeholder="পজিশন"  value="" name="display_position[]"/>
                                    </td>
                                    <td>
                                        <select  id="is_active-1" class="form-control" required  name="is_active[]">
                                            <option value="">Select</option>
                                            <option value="1" selected>Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
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
                        <button type="button" onclick="saveArtistRateChart()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                        <input type="hidden" name="chart_id" id="chart_id">
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:85%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                        <h5 class="modal-title" id="exampleModalLabel">শিল্পী সম্মানীর তথ্য আপডেট করুন  </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <?php echo Form::open(['url' => '', 'id' => 'artist_rate_chart_setup_form_update','method' => 'post',
                'class'=>'form-horizontal']); ?>

                <div >
                    <div class="col-sm-12" style="margin-top:10px;">


                        <div class="form-group">
                            <label class="col-md-3 control-label"> শিল্পী সম্মানীর ক্যাটাগরি</label>
                            <div class="col-md-6">
                                <select required name="artist_song_ctg"  class="form-control artist_song_ctg">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($artist_song_ctg)): ?>
                                        <?php $__currentLoopData = $artist_song_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3 pull-right text-right">
                                <a href="<?php  echo asset('/program_style_setup');?>" class="btn btn-primary
                                btn-sm text-right"><i
                                            class="glyphicon
                                glyphicon-plus"></i> নতুন ক্যাটাগরি</a>
                            </div>

                        </div>
                        <div id="artist_chart_info_update"></div>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6 text-left">
                        <div id="form_output"></div>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" onclick="updateArtistRateChart()" id="updateBtn" class="btn
                        btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>

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
            $('<tr><td>\n' +
                '                                        <select required name="artist_song_grade[]" id="artist_song_grade_1"\n' +
                '                                                class="form-control">\n' +
                '                                            <option value="">চিহ্নিত করুন</option>\n' +
                '                                            <?php if(!empty($artist_grade_info)): ?>\n' +
                '                                                <?php $__currentLoopData = $artist_grade_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
                '                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                            <?php endif; ?>\n' +
                '                                        </select>\n' +
                '                                    </td><td><input type="text"  id="stability_1" ' +
                'class="form-control" placeholder="স্থিতি" value="" name="stability[]"/></td> <td><input type="text" ' +
                ' id="amount_1" class="form-control onlyNumber" placeholder="সম্মানীর পরিমান"  value="" ' +
                'name="amount[]"/></td> <td> <select  id="mohoda_fee_1" class="form-control" name="mohoda_fee[]">\n' +
                '                                            <option value="2">না</option>\n' +
                '                                            <option value="1">হ্যাঁ</option>\n' +
                '                                        </select>\n' +
                '                                    </td> <td><input type="text"  id="maximum_artist_1" class="form-control onlyNumber"\n' +
                '                                                     placeholder="জন(সবোর্চ্চ)"  value="" name="maximum_artist[]"/> </td>\n' +
                '\n' +
                '                                    <td>\n' +
                '                                        <textarea  rows="1" id="remarks_info_1" class="form-control" placeholder="মন্তব্য"\n' +
                '                                                   name="remarks_info[]"></textarea>\n' +
                '                                    </td>\n' +
                '                                    <td>\n' +
                '                                        <input type="text"  id="display_position_1" class="form-control onlyNumber"\n' +
                '                                               placeholder="পজিশন"  value="" name="display_position[]"/>\n' +
                '                                    </td>\n' +
                '                                    <td>\n' +
                '                                        <select  id="is_active-1" class="form-control" required  name="is_active[]">\n' +
                '                                            <option value="">Select</option>\n' +
                '                                            <option value="1" selected>Active</option>\n' +
                '                                            <option value="2">Inactive</option>\n' +
                '                                        </select>\n' +
                '                                    </td><td><a href="javascript:void(0);"  id="deleteRow_' + b + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntartist_chart_info_add);

            b++;
            return false;
        });


    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>