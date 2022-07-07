<?php $__env->startSection('title_area'); ?>
     Program :: Add Artist Record  ::
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
            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Add Artist Record</h2>

                <a href="<?php echo e(url('artist_record')); ?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                   List
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12" style="margin-top:20px;">

                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'save_artist_info_form',
                        'class'=>'form-horizontal']); ?>

                        <div class="form-group">
                            <label class="col-md-2 control-label">শিল্পীর  দপ্তর <span class="mandatory_field">*</span>
                            </label>
                            <div class="col-md-4">
                                <select id="artist_doptor" tabindex="1" class="form-control"
                                        required name="artist_doptor">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1">অনুষ্ঠান বিভাগ</option>
                                    <option value="2">বার্তা বিভাগ</option>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">শিল্পীর ধরন <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <select required tabindex="1" name="artist_ctg" id="artist_ctg" class="form-control">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php 
                                        $artist_type=artist_type();
                                     ?>
                                    <?php if(!empty($artist_type)): ?>
                                        <?php $__currentLoopData = $artist_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">তালিকাভুক্ত কেন্দ্রে নাম</label>
                            <div class="col-md-4">
                                <select id="station_id" tabindex="3" class="form-control" name="station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($station_info)): ?>
                                        <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <div class="col-md-4">
                                    <input type="hidden" name="entry_date" placeholder="এন্টির তারিখ"
                                           class="form-control datepickerinfo" id="entry_date">
                                </div>
                            </div>
                            <div id="staff_artist" style="display: none;">
                                <label class="col-md-2 control-label">স্টাফ আই ডি</label>
                                <div class="col-md-4">
                                    <input type="text" tabindex="3" name="staff_id" placeholder="স্টাফ আই ডি"
                                           class="form-control " id="staff_id">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">সর্বশেষ গ্রেড তালিকাভুক্তির তারিখ </label>
                            <div class="col-md-4">
                                <input type="text" tabindex="4" name="last_grade_date" placeholder="সর্বশেষ গ্রেড তালিকাভুক্তির  তারিখ" class="form-control datepickerinfo" id="last_grade_date">
                            </div>
                            <label class="col-md-2 control-label">তালিকাভুক্তির তারিখ</label>
                            <div class="col-md-4">
                                <input type="text" name="artist_recorded_date" placeholder="তালিকাভুক্তির তারিখ"
                                       class="form-control datepickerinfo" id="artist_recorded_date">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-md-2 control-label">শিল্পীর নাম (বাংলায়) <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="artist_name_bn" tabindex="5" class="form-control" required
                                       name="artist_name_bn"
                                       placeholder="শিল্পীর নাম (বাংলায়)">
                            </div>

                            <label class="col-md-2 control-label">শিল্পীর  সংক্ষিপ্ত নাম (সাধরনত: ডিউটি রোস্টারে ব্যবহারের জন্য) <span
                                        class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="artist_short_name" tabindex="6" class="form-control" 
                                       name="artist_short_name"
                                       placeholder="সংক্ষিপ্ত নাম ">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">শিল্পীর নাম (ইংরেজী) <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="artist_name" tabindex="7" class="form-control" 
                                       name="artist_name"
                                       placeholder="শিল্পীর নাম (ইংরেজী)">
                            </div>
                            <label class="col-md-2 control-label">জাতীয় পুরষ্কার প্রাপ্ত</label>
                            <div class="col-md-4">
                                <select id="national_awarded" tabindex="10" class="form-control"
                                        name="national_awarded">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($national_award_info)): ?>
                                        <?php $__currentLoopData = $national_award_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">পিতার নাম <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="father_name" tabindex="8" class="form-control" 
                                       name="father_name"
                                       placeholder="পিতার নাম">
                            </div>
                            <label class="col-md-2 control-label">পেশা</label>
                            <div class="col-md-4">
                                <textarea id="artist_occupation" placeholder="পেশা" class="form-control"
                                          name="artist_occupation"></textarea>

                            </div>



                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">মাতার নাম <span class="mandatory_field">*</span> </label>
                            <div class="col-md-4">
                                <input type="text" id="mother_name" tabindex="9" class="form-control" 
                                       name="mother_name"
                                       placeholder="মাতার নাম">

                            </div>
                            <label class="col-md-2 control-label">জাতীয়তা</label>
                            <div class="col-md-4">
                                <select id="nationality" tabindex="12" class="form-control" name="nationality">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($nationality)): ?>
                                        <?php $__currentLoopData = $nationality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </select>
                            </div>


                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">স্বামী/স্ত্রী নাম</label>
                            <div class="col-md-4">
                                <div style="width: 35%;float: left;">
                                    <select id="husband_wife_type"  class="form-control"
                                            name="husband_wife_type">
                                        <option value="">চিহ্নিত করুন</option>
                                        <option value="1">স্বামী</option>
                                        <option value="2">স্ত্রী</option>
                                    </select>
                                </div>
                                <div style="width: 65%;float: left;">
                                    <div class="col-sm-12">
                                        <input type="text" tabindex="18" id="husband_wife" class="form-control"
                                               name="husband_wife" placeholder="স্বামী/স্ত্রী নাম">
                                    </div>
                                </div>
                            </div>
                            <label class="col-md-2 control-label">জেলা </label>
                            <div class="col-md-4">
                                <select id="present_district" tabindex="14" class="form-control"
                                        name="present_district">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($all_district)): ?>
                                        <?php $__currentLoopData = $all_district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php echo e((isset($present_address['district']) && $present_address['district']==$key)?"selected":''); ?> >
                                                <?php echo e($value); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>


                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">বৈবাহিক অবস্থা</label>
                            <div class="col-md-4">
                                <select id="merital_status" tabindex="17" class="form-control" name="merital_status">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1">বিবাহিত</option>
                                    <option value="2">অবিবাহিত</option>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">লিঙ্গ</label>
                            <div class="col-md-4">
                                <select id="gender" tabindex="16" class="form-control" name="gender">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1">পুরয়ষ</option>
                                    <option value="2">মহিলা</option>
                                    <option value="3">অন্যান্য</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">ঠিকানা</label>
                            <div class="col-md-4">
                        <textarea id="address_info" tabindex="15" class="form-control" placeholder="ঠিকানাা"
                                  name="address_info"></textarea>
                            </div>
                            <label class="col-md-2 control-label">শিক্ষাগত যোগ্যতা</label>
                            <div class="col-md-4">
                        <textarea id="educational_info" tabindex="19" class="form-control" placeholder="শিক্ষাগত
                        যোগ্গতা"
                                  name="educational_info"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">মোবাইল (অবশ্যই  লিখুন, এই নাম্বারে এসএমএস পাঠানো হবে) </label>
                            <div class="col-md-4">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <input type="text" tabindex="20" id="mobile_no_1" class="form-control"
                                               placeholder="মোবাইল"
                                       name="mobile_no[]"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-primary btn-sm" id="add_mobile_no"><i
                                                class="glyphicon
                                    glyphicon-plus"></i> Add</button>
                                </div>

                                <div id="show_mobile_log"></div>
                            </div>
                            <label class="col-md-2 control-label">ই-মেইল </label>
                            <div class="col-md-4">
                                <input type="text" id="email_address" tabindex="21" class="form-control"
                                       placeholder="ই-মেইল"
                                       name="email_address"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ছবি</label>
                            <div class="col-md-4">
                                <input type="file" id="picture" tabindex="23" class="form-control"
                                       name="picture"/>
                            </div>
                            <label class="col-md-2 control-label">স্বাক্ষর</label>
                            <div class="col-md-4">
                                <input type="file" id="signature" class="form-control"
                                       name="signature"/>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">জাতীয় পরিচয়পত্র নং</label>
                            <div class="col-md-4">
                                <input type="text" id="national_id_no" placeholder="জাতীয় পরিচয়পত্র নং" class="form-control"
                                       name="national_id_no"/>
                            </div>
                            <label class="col-md-2 control-label">জন্ম নিবন্ধন</label>
                            <div class="col-md-2">
                                <input type="text" id="birth_certificate_id" placeholder="জন্ম নিবন্ধন নং" class="form-control"
                                       name="birth_certificate_id"/>
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="old_artist_no" placeholder="পুরাতন আইডি নং" class="form-control"
                                       name="old_artist_no"/>
                            </div>
                            
                            

                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">বেতারের দায়িত্বপ্রাপ্ত কর্মস্থল</label>
                            <div class="col-md-10">
                                <select id="previous_station_id" tabindex="24" class="select2"
                                        name="previous_station_id[]"
                                        multiple placeholder="বেতারের দায়িত্বপ্রাপ্ত কর্মস্থল">

                                    <?php if(!empty($station_info)): ?>
                                        <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"> স্ট্যাটাস <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <select id="status" class="form-control" required name="status">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1" selected>Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">ফেইসবুক আইডি(Facebook ID) </label>
                            <div class="col-md-4">
                                <input type="text" id="fb_id_link" tabindex="22" class="form-control"
                                       placeholder="ফেইসবুক আইডি
                                (Facebook ID)"
                                       name="fb_id_link"/>

                            </div>

                    </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">ব্যাংকের নাম</label>
                            <div class="col-md-4">
                                <select name="bank_name" tabindex="25" class="form-control" id="bank_name">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($bank_info)): ?>
                                        <?php $__currentLoopData = $bank_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                             </div>
                            <label class="col-md-2 control-label">ব্যাংকের শাখার নাম</label>
                            <div class="col-md-4">
                                <input type="text" tabindex="26" name="bank_branch_name" placeholder="ব্যাংকের শাখার
                                নাম"
                                       class="form-control" id="bank_branch_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ব্যাংক একাউন্ট নং</label>
                            <div class="col-md-4">
                                <input type="text" tabindex="27" name="bank_account_no" placeholder="ব্যাংক একাউন্ট নং"
                                       class="form-control" id="bank_account_no">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">চুক্তি ভিত্তিক শিল্পী</label>
                            <div class="col-md-3">
                                <input type="text" tabindex="28" name="fixed_amount" placeholder="এক কালিন টাকা পরিমান"
                                       class="form-control" id="fixed_amount">
                            </div>
                            <div class="col-md-3">
                                <input type="text" tabindex="29" name="per_day_amount" placeholder="দৈনিক টাকা"
                                       class="form-control" id="per_day_amount">
                            </div>
                            <div class="col-md-3">
                                <input type="text" tabindex="30" name="total_days" placeholder="সবোর্চ্চ দিনের সংখ্যা"
                                       class="form-control" id="total_days">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="width30per">শিল্পীর দক্ষতা</th>
                                        <th class="width30per">দক্ষতার বিভাগ</th>
                                        <th class="width30per">শ্রেণী</th>
                                        <th  class="width10per">#</th>
                                    </tr>
                                    </thead>
                                    <tbody id="experstise_info">

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button type="button" id="artist_expertise_info" class="btn btn-primary
                                            btn-sm"><i
                                                        class="glyphicon glyphicon-plus"></i> Add
                                            </button>
                                        </td>
                                    </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <!--  <div class="form-group">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="width30per">শিল্পী সম্মানীর চার্ট এর ক্যাটাগরি</th>
                                        <th class="width30per">অনুষ্ঠানের বিবরণ</th>
                                        <th class="width20per">শ্রেণী</th>
                                        <th  class="width10per">#</th>
                                    </tr>
                                    </thead>
                                    <tbody id="dynamicSongtr">

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button type="button" id="add_artist_song_ctg" class="btn btn-primary btn-sm"><i
                                                        class="glyphicon glyphicon-plus"></i> Add
                                            </button>
                                        </td>
                                    </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>

                       <div class="form-group">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="width20per">শিল্পীর দক্ষতা</th>
                                        <th class="width20per">দক্ষতার বিভাগ</th>
                                        <th class="width20per">শ্রেণী</th>
                                        <th class="width20per">শিল্পী সম্মানীর চার্ট এর ক্যাটাগরি</th>
                                        <th class="width20per">অনুষ্ঠানের বিবরণ</th>
                                        <th  class="width10per">#</th>
                                    </tr>
                                    </thead>
                                    <tbody id="experstise_info_all">

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" id="artist_expertise_info_all" class="btn btn-primary
                                            btn-sm"><i
                                                        class="glyphicon glyphicon-plus"></i> Add
                                            </button>
                                        </td>
                                    </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>-->


                            <div class="modal-footer">
                                <div class=" col-sm-7 text-left">
                                    <span class="text-left" id="form_output_artist_info"></span>
                                </div>
                                <div class=" col-sm-5">
                                    <button type="Submit"  id="saveBtn"
                                            class="btn btn-success"><i
                                                class="glyphicon glyphicon-save"></i>
                                        Save
                                    </button>



                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                class="glyphicon glyphicon-remove"></i> Close
                                    </button>
                                    <input type="hidden" name="setting_id" id="setting_id">
                                </div>

                            </div>

                        </div>
                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </article>



    <script>
        var k=1;
        $("#add_mobile_no").click(function(){
            var markup = '<div id="mobile_no_log_info_'+ k +'"> <div class="col-sm-8" style="margin-top:10px" ><div ' +
                'class="row"> ' +
                '<input ' +
                'type="text" ' +
                'id="mobile_no' + k + '" ' +
                'class="form-control" \n' +
                '                                                   placeholder="মোবাইল" ' +
                'name="mobile_no[]"/></div></div><div class="col-sm-4" style="margin-top:10px" >\n' +
                '        <a href="javascript:void(0);"  id="deleteRow_' + k + '"  class="delete-row btn btn-warning ' +
                'btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a> </div></div>';
            $("#show_mobile_log").append(markup);
            k++;
        });

       $(document).on("click", ".delete-row", function (e) {
           var element_id = elementId($(this).attr('id'));
            $("#mobile_no_log_info_"+element_id).remove();
        });

        var scntDivSong = $('#dynamicSongtr');
        var a = $('#dynamicSongtr tr').size() + 2;
        $('#add_artist_song_ctg').on('click', function () {
            $('<tr><td><select  name="artist_hounoriam_ctg[]" id="artist_hounoriam_ctg_'+ a +'" class="form-control ' +
                'artist_hounoriam_ctg"><option value=""> চিহ্নিত করুন</option> <?php if(!empty($program_ctg)): ?>\n' +
                '                                                    <?php $__currentLoopData = $program_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
                '                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                                <?php endif; ?></select></td><td><select id="chart_description_'+a +'" class="form-control chart_description" name="chart_description[]">\n' +
                '            <option value="">চিহ্নিত করুন</option>\n' +
                '        </select></td><td><select  name="artist_grade[]" class="form-control" id="artist_grade_'+ a +'"><option value="">চিহ্নিত করুন</option></select></td><td><a href="javascript:void(0);"  id="deleteRow_' + a + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntDivSong);
            a++;
            return false;
        });

        var scntexperstise_info = $('#experstise_info');
        var b = $('#experstise_info tr').size() + 2;
        $('#artist_expertise_info').on('click', function () {
            $('<tr><td><select  name="expertise[]" id="expertise_'+ b +'" class="form-control ' +
                'artist_expertise"><option value=""> চিহ্নিত করুন</option> <?php if(!empty($expertise_dept)): ?>\n' +
                '                                                    <?php $__currentLoopData = $expertise_dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
                '                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                                <?php endif; ?></select></td><td><select id="expertise_dept_'+ b +'"class="form-control" name="expertise_dept[]">\n' +
                '            <option value="">চিহ্নিত করুন</option>\n' +
                '        </select></td><td><select \n' +
                '                                                    name="expertise_grade[]"\n' +
                '                                                    class="form-control"\n' +
                '                                                    id="expertise_grade_'+b+'"><option\n' +
                '                                                        value="">চিহ্নিত করুন</option>\n' +
                '                                                       <?php if(!empty($artist_grade_info)): ?>\n' +
                '                                                <?php $__currentLoopData = $artist_grade_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option   value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
                '                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                                <?php endif; ?>\n' +
                '                                            </select>\n' +
                '                                        </td><td><a href="javascript:void(0);"  id="deleteRow_' + b + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntexperstise_info);

            b++;
            return false;
        });

/*
        var scntexperstise_info_alll = $('#experstise_info_all');
        var c = $('#experstise_info_all tr').size() + 2;
        $('#artist_expertise_info_all').on('click', function () {

            $(`<tr><td><select  name="expertise[]" id="expertise_${c}" class="form-control  artist_expertise"><option
             value=""> চিহ্নিত করুন</option>
                                            <?php if(!empty($expertise_dept)): ?>
                                                <?php $__currentLoopData = $expertise_dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </select></td><td><select id="expertise_dept_${c}"class="form-control" name="expertise_dept[]"> <option value="">চিহ্নিত করুন</option>
                                            </select></td><td><select name="expertise_grade[]" class="form-control"
                                            id="expertise_grade_'+b+'"><option value="">চিহ্নিত করুন</option> <?php if(!empty($artist_grade_info)): ?>
                                                    <?php $__currentLoopData = $artist_grade_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option   value="<?php echo e($key); ?>"><?php echo e($value); ?></option>                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>                                         </select>
             </td><td><select  name="artist_hounoriam_ctg[]" id="artist_hounoriam_ctg_${c}" class="form-control
             artist_hounoriam_ctg"><option value=""> চিহ্নিত করুন</option> <?php if(!empty($program_ctg)): ?>
                                        <?php $__currentLoopData = $program_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?></select></td><td ><select style="width:200px;"  placeholder="চিহ্নিত করুন"
                                    id="chart_description_${c}"
                                    multiple
                                    class="chart_description" name="chart_description[]">

                                    </select></td><td><a href="javascript:void(0);"  id="deleteRow_${c}"  class="deleteRow
                btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>`).appendTo(scntexperstise_info_alll);
            $("#chart_description_"+ c).select2()
            c++;
            return false;
        });
*/




    </script>
    <style>
        .mandatory_field{
            font-weight: bold;
            color:red;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>