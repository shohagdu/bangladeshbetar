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
                <h2>Update Artist Information</h2>

                <a href="<?php echo e(url('artist_record')); ?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    List
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12" style="margin-top:20px;">
                        <?php
                        // echo "<pre>";
                        //  print_r($artist_info_show);
                        ?>

                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'artist_info_update_form',
                        'class'=>'form-horizontal']); ?> 
                        <div class="form-group">
                            <label class="col-md-2 control-label"> স্ট্যাটাস <span class="mandatory_field">*</span></label>
                            <div class="col-md-10">
                                <select id="status" class="form-control" required name="status">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1" <?php echo e((!empty($artist_info_show->is_active) &&
                                        $artist_info_show->is_active==1) ?
                           "selected":''); ?> >Active</option>
                                    <option value="2"  <?php echo e((!empty($artist_info_show->is_active) &&
                                        $artist_info_show->is_active==2) ?
                           "selected":''); ?> >Inactive</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">শিল্পীর  দপ্তর <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <select id="artist_doptor" class="form-control"
                                        required name="artist_doptor">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1" <?php echo e((!empty($artist_info_show->artist_doptor) &&
                                            $artist_info_show->artist_doptor==1) ?
                               "selected":''); ?> >অনুষ্ঠান বিভাগ</option>
                                    <option value="2" <?php echo e((!empty($artist_info_show->artist_doptor) &&
                                            $artist_info_show->artist_doptor==2) ?
                               "selected":''); ?> >বার্তা বিভাগ</option>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">শিল্পীর ধরন <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <select required name="artist_ctg" id="artist_ctg" class="form-control">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php 
                                        $artist_type=artist_type();
                                     ?>
                                    <?php if(!empty($artist_type)): ?>
                                        <?php $__currentLoopData = $artist_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e((!empty($artist_info_show->artist_type) &&
                                            $artist_info_show->artist_type==$key) ?
                               "selected":''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">তালিকাভুক্ত কেন্দ্রে নাম</label>
                            <div class="col-md-4">
                                <select id="station_id" class="form-control" name="station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($station_info)): ?>
                                        <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e($artist_info_show->station_id == $key ? 'selected': ''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>

                            </div>
                            <div id="staff_artist"  style="display: <?php echo e((!empty($artist_info_show->artist_type) &&
                                            $artist_info_show->artist_type==2) ?'block':'none'); ?>;">
                                <label class="col-md-2 control-label">স্টাফ আই ডি</label>
                                <div class="col-md-4">

                                    <input type="text" value="<?php echo e((!empty($artist_info_show->staff_id))?
                                    $artist_info_show->staff_id:''); ?>"  name="staff_id" placeholder="স্টাফ আই ডি"
                                           class="form-control " id="staff_id">

                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">সর্বশেষ গ্রেড তালিকাভুক্তির তারিখ </label>
                            <div class="col-md-4">
                                <input type="text"  value="<?php echo e((empty($artist_info_show->enlisted_last_date) ||
                                $artist_info_show->enlisted_last_date=='0000-00-00' ||
                                $artist_info_show->enlisted_last_date=='1970-01-01') ?'':date('d-m-Y',strtotime
                                ($artist_info_show->enlisted_last_date))); ?>" name="last_grade_date" placeholder="সর্বশেষ
                                গ্রেড তালিকাভুক্তির  তারিখ " class="form-control datepickerinfo" id="last_grade_date">
                            </div>
                            <label class="col-md-2 control-label">তালিকাভুক্তির তারিখ</label>
                            <div class="col-md-4">
                                <input type="text"  value="<?php echo e((empty($artist_info_show->enlisted_date) ||
                                $artist_info_show->enlisted_date=='0000-00-00' ||
                                $artist_info_show->enlisted_date=='1970-01-01') ?'':date('d-m-Y',strtotime
                                ($artist_info_show->enlisted_date))); ?>"
                                       name="artist_recorded_date"
                                       placeholder="তালিকাভুক্তির তারিখ"
                                       class="form-control datepickerinfo" id="artist_recorded_date">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-md-2 control-label">শিল্পীর নাম (বাংলায়) <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="artist_name_bn"  value="<?php echo e(!empty($artist_info_show->name_bn)?
                                $artist_info_show->name_bn:''); ?>"
                                       class="form-control" required name="artist_name_bn"
                                       placeholder="শিল্পীর নাম (বাংলায়)">
                            </div>

                            <label class="col-md-2 control-label">শিল্পীর  সংক্ষিপ্ত নাম <span class="mandatory_field">*</span> </label>
                            <div class="col-md-4">
                                <input type="text" id="artist_short_name"  value="<?php echo e($artist_info_show->artist_short_name); ?>" class="form-control" required
                                       name="artist_short_name"
                                       placeholder="সংক্ষিপ্ত নাম ">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">শিল্পীর নাম (ইংরেজী) <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="artist_name" value="<?php echo e(!empty($artist_info_show->name)?
                                $artist_info_show->name:''); ?>"
                                       class="form-control"  name="artist_name"
                                       placeholder="শিল্পীর নাম (ইংরেজী)">
                            </div>
                            <label class="col-md-2 control-label">জাতীয় পুরষ্কার প্রাপ্ত</label>
                            <div class="col-md-4">
                                <select id="national_awarded" class="form-control" name="national_awarded">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($national_award_info)): ?>
                                        <?php $__currentLoopData = $national_award_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option   <?php echo e(!empty($artist_info_show->national_awarded) &&
                                            ($artist_info_show->national_awarded == $key) ?
                                            'selected': ''); ?>

                                                      value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">পিতার নাম  <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="father_name" value="<?php echo e(!empty($artist_info_show->father_name)?
                                $artist_info_show->father_name:''); ?>"  class="form-control"  name="father_name"
                                       placeholder="পিতার নাম">
                            </div>
                            <label class="col-md-2 control-label">পেশা</label>
                            <div class="col-md-4">
                                <textarea id="artist_occupation" placeholder="পেশা" class="form-control"
                                          name="artist_occupation"><?php echo e(!empty( $artist_info_show->artist_occupation)
                                          ?trim($artist_info_show->artist_occupation):''); ?></textarea>

                            </div>



                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">মাতার নাম <span class="mandatory_field">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="mother_name"  value="<?php echo e(!empty( $artist_info_show->
                                mother_name)? $artist_info_show->
                                mother_name:''); ?>"
                                       class="form-control" required
                                       name="mother_name"
                                       placeholder="মাতার নাম">

                            </div>
                            <label class="col-md-2 control-label">জাতীয়তা</label>
                            <div class="col-md-4">
                                <select id="nationality" class="form-control" name="nationality">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($nationality)): ?>
                                        <?php $__currentLoopData = $nationality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e(!empty($artist_info_show->nationality) &&
                                            ($artist_info_show->nationality == $key) ?
                                            'selected': ''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </select>
                            </div>


                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">স্বামী/স্ত্রী নাম</label>
                            <div class="col-md-4">
                                <div style="width: 35%;float: left;">
                                    <select id="husband_wife_type" class="form-control" name="husband_wife_type">
                                        <option value="" >চিহ্নিত করুন</option>
                                        <option value="1" <?php echo e(!empty($artist_info_show->is_husband_wife) &&
                                            ($artist_info_show->is_husband_wife == 1) ?
                                            'selected': ''); ?>>স্বামী</option>
                                        <option value="2" <?php echo e(!empty($artist_info_show->is_husband_wife) &&
                                            ($artist_info_show->is_husband_wife == 2) ?
                                            'selected': ''); ?>>স্ত্রী</option>
                                    </select>
                                </div>
                                <div style="width: 65%;float: left;">
                                    <div class="col-sm-12">
                                        <input type="text" id="husband_wife" class="form-control"
                                               name="husband_wife" value="<?php echo e(!empty($artist_info_show->husband_wife_name)?
                                $artist_info_show->husband_wife_name:''); ?>"  placeholder="স্বামী/স্ত্রী নাম">
                                    </div>
                                </div>
                            </div>
                            <label class="col-md-2 control-label">জেলা </label>
                            <div class="col-md-4">
                                <select id="present_district" class="form-control" name="present_district">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($all_district)): ?>
                                        <?php $__currentLoopData = $all_district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php echo e((isset($artist_info_show->artist_district) && $artist_info_show->artist_district==$key)?"selected":''); ?> >
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
                                <select id="merital_status" class="form-control" name="merital_status">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1" <?php echo e(!empty($artist_info_show->marital_status) &&
                                            ($artist_info_show->marital_status == 1) ?
                                            'selected': ''); ?>>বিবাহিত</option>
                                    <option value="2" <?php echo e(!empty($artist_info_show->marital_status) &&
                                            ($artist_info_show->marital_status == 2) ?
                                            'selected': ''); ?>>অবিবাহিত</option>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">লিঙ্গ</label>
                            <div class="col-md-4">
                                <select id="gender" class="form-control" name="gender">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1"  <?php echo e(!empty($artist_info_show->gender) &&
                                            ($artist_info_show->gender == 1) ?
                                            'selected': ''); ?>>পুরয়ষ</option>
                                    <option value="2"  <?php echo e(!empty($artist_info_show->gender) &&
                                            ($artist_info_show->gender == 2) ?
                                            'selected': ''); ?>>মহিলা</option>
                                    <option value="3"  <?php echo e(!empty($artist_info_show->gender) &&
                                            ($artist_info_show->gender == 3) ?
                                            'selected': ''); ?>>অন্যান্য</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">ঠিকানা</label>
                            <div class="col-md-4">
                        <textarea id="address_info" class="form-control" placeholder="ঠিকানাা"
                                  name="address_info"><?php echo e(!empty($artist_info_show->address)?$artist_info_show->address:''); ?></textarea>
                            </div>
                            <label class="col-md-2 control-label">শিক্ষাগত যোগ্যতা</label>
                            <div class="col-md-4">
                        <textarea id="education_info" class="form-control" placeholder="শিক্ষাগত যোগ্গতা"
                                  name="educational_info"><?php echo e(!empty($artist_info_show->educational_info)?$artist_info_show->educational_info:''); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">মোবাইল</label>
                            <div class="col-md-4">
                                <?php
                                if(!empty($artist_info_show->mobile)){
                                $deconde_mobile=json_decode($artist_info_show->mobile,true);
                                foreach($deconde_mobile as $key =>$mobile){
                                $indexed=100+$key;
                                ?>
                                <div id="mobile_no_log_info_<?php echo e($indexed); ?>">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <input type="text" id="mobile_no_<?php echo e($key); ?>" value="<?php echo e($mobile); ?>"
                                                   class="form-control"
                                                   placeholder="মোবাইল"
                                                   name="mobile_no[]"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="margin-top:5px;">
                                        <a href="javascript:void(0);"  id="deleteRow_<?php echo e($indexed); ?>"  class="delete-row btn
                                            btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>
                                            Drop</a>
                                    </div>
                                </div>
                                <?php
                                $indexed++;
                                }
                                }
                                ?>

                                <div class="clearfix"></div>
                                <div id="show_mobile_log"></div>
                                <div class="clearfix"></div>
                                <div class="col-sm-4" style="margin-top:5px;">
                                    <div class="row">
                                        <button type="button" class="btn btn-primary btn-sm" id="add_mobile_no"><i
                                                    class="glyphicon
                                        glyphicon-plus"></i> Add</button>
                                    </div>
                                </div>




                            </div>
                            <label class="col-md-2 control-label">ই-মেইল </label>
                            <div class="col-md-4">
                                <input type="text" id="email_address" value="<?php echo e(!empty($artist_info_show->email)?
                                $artist_info_show->email:''); ?>"   class="form-control" placeholder="ই-মেইল"
                                       name="email_address"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ছবি</label>
                            <div class="col-md-4">
                                <input type="file" id="picture" class="form-control"
                                       name="picture"/>
                                <input type="hidden" name="old_image" id="old_image" value="<?php echo e(!empty
                                ($artist_info_show->picture)? $artist_info_show->picture:''); ?>">


                            </div>
                            <label class="col-md-2 control-label">স্বাক্ষর</label>
                            <div class="col-md-4">
                                <input type="file" id="signature" class="form-control"
                                       name="signature"/>
                                <input type="hidden" name="old_signature" id="old_signature" value="<?php echo e(!empty
                                ($artist_info_show->artist_signature)? $artist_info_show->artist_signature:''); ?>">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">জাতীয় পরিচয়পত্র নং</label>
                            <div class="col-md-4">
                                <input type="text" id="national_id_no" placeholder="জাতীয় পরিচয়পত্র নং" class="form-control"
                                       name="national_id_no"/>
                            </div>
                            <label class="col-md-2 control-label">ফেইসবুক আইডি(Facebook ID) </label>
                            <div class="col-md-4">
                                <input type="text" id="fb_id_link" value="<?php echo e(!empty($artist_info_show->fb_id_link)?
                                $artist_info_show->fb_id_link:''); ?>"  class="form-control" placeholder="ফেইসবুক আইডি(Facebook ID)"
                                       name="fb_id_link"/>

                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">জন্ম নিবন্ধন</label>
                            <div class="col-md-4">
                                <input type="text" id="birth_certificate_id" value="<?php echo e(!empty($artist_info_show->birth_certificate_id)?
                                $artist_info_show->birth_certificate_id:''); ?>" placeholder="জন্ম নিবন্ধন নং" class="form-control"
                                       name="birth_certificate_id"/>
                            </div>
                            <label class="col-md-2 control-label">পুরাতন আইডি নং</label>
                            <div class="col-md-4">
                                <input type="text" id="old_artist_no" value="<?php echo e(!empty($artist_info_show->artist_old_id)?
                                $artist_info_show->artist_old_id:''); ?>" placeholder="পুরাতন আইডি নং" class="form-control"
                                       name="old_artist_no"/>
                            </div>
                         </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">বেতারের দায়িত্বপ্রাপ্ত কর্মস্থল</label>
                            <div class="col-md-10">
                                <?php
                                $previous_station= !empty($artist_info_show->previous_station_id)?
                                    json_decode($artist_info_show->previous_station_id,true):'';
                                $selected='';
                               
                                ?>
                                <select id="previous_station_id" class="select2"
                                        name="previous_station_id[]"
                                        multiple placeholder="বেতারের দায়িত্বপ্রাপ্ত কর্মস্থল">

                                    <?php if(!empty($station_info)): ?>
                                        <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            

                                            <option  <?php if (!empty($previous_station) && in_array($key,$previous_station)){ echo  $selected=
                                                    "selected";} ?>
                                                    value="<?php echo e($key); ?>"><?php echo e($value); ?></option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>






                        <div class="form-group">
                            <label class="col-md-2 control-label">ব্যাংকের নাম</label>
                            <div class="col-md-4">
                                <select name="bank_name" class="form-control" id="bank_name">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($bank_info)): ?>
                                        <?php $__currentLoopData = $bank_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e((!empty($artist_info_show->bank_name) &&
                                            $artist_info_show->bank_name==$key) ?
                               "selected":''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">ব্যাংকের শাখার নাম</label>
                            <div class="col-md-4">
                                <input type="text" value="<?php echo e(!empty($artist_info_show->bank_branch_name)?
                                $artist_info_show->bank_branch_name:''); ?>"  name="bank_branch_name" placeholder="ব্যাংকের শাখার নাম"
                                       class="form-control" id="bank_branch_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ব্যাংক একাউন্ট নং</label>
                            <div class="col-md-4">
                                <input type="text" value="<?php echo e(!empty($artist_info_show->bank_account_no)?
                                $artist_info_show->bank_account_no:''); ?>"   name="bank_account_no" placeholder="ব্যাংক একাউন্ট নং"
                                       class="form-control" id="bank_account_no">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">চুক্তি ভিত্তিক শিল্পী</label>
                            <div class="col-md-3">
                                <input type="text"  value="<?php echo e(!empty($artist_info_show->fixed_amount)?
                                $artist_info_show->fixed_amount:''); ?>"  name="fixed_amount" placeholder="এক কালিন টাকা পরিমান"
                                       class="form-control" id="fixed_amount">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="per_day_amount" value="<?php echo e(!empty($artist_info_show->per_day_amount)?
                                $artist_info_show->per_day_amount:''); ?>"  placeholder="দৈনিক টাকা"
                                       class="form-control" id="per_day_amount">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="total_days" value="<?php echo e(!empty($artist_info_show->total_days)?
                                $artist_info_show->total_days:''); ?>"  placeholder="সবোর্চ্চ দিনের সংখ্যা"
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
                                    <?php
                                    if(!empty($artist_info_show->artist_expertise_info)){
                                    $deconde_expertise=json_decode($artist_info_show->artist_expertise_info,true);
                                    //    print_r($deconde_expertise);
                                    if(!empty($deconde_expertise)){
                                    foreach($deconde_expertise as $key_main =>$expertise){
                                    $indexed=100+$key_main;
                                    ?>
                                    <tr>
                                        <td>
                                            <select required name="expertise[]" id="expertise_<?php echo e($key_main); ?>"
                                                    class="form-control artist_expertise"><option value=""> চিহ্নিত
                                                    করুন</option> <?php if(!empty($expertise_dept)): ?>
                                                    <?php $__currentLoopData = $expertise_dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option <?php echo e((!empty
                                                    ( $expertise['expertise']) &&  $expertise['expertise']==$key) ?
                               "selected":''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?></select></td>
                                        <td>
                                            <select id="expertise_dept_<?php echo e($key_main); ?>"class="form-control" name="expertise_dept[]"> <option value="">চিহ্নিত করুন</option>
                                                <?php $__currentLoopData = $expertise['all_expertise_dept_By_expertise']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>
                                                $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option <?php echo e((!empty
                                                    ( $expertise['expertise_dept']) &&  $expertise['expertise_dept']==$key) ?"selected":''); ?>  value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                        <td><select 
                                                    name="expertise_grade[]"
                                                    class="form-control"
                                                    id="expertise_grade_<?php echo e($key_main); ?>"><option
                                                        value="">চিহ্নিত করুন</option>
                                                <?php if(!empty($artist_grade_info)): ?>
                                                    <?php $__currentLoopData = $artist_grade_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>
                                                    $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option <?php echo e((!empty
                                                        ( $expertise['expertise_grade']) &&  $expertise['expertise_grade']==$key) ?
                                   "selected":''); ?>  value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                        <td><a href="javascript:void(0);"  id="deleteRow_<?php echo e($key_main); ?>"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>

                                    <?php
                                    $key_main++;
                                    }
                                    }
                                    }
                                    ?>


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
                                    <?php
                                    if(!empty($artist_info_show->artist_rate_chart_info)){
                                    $deconde_rate_chart=json_decode($artist_info_show->artist_rate_chart_info,true);
                                    foreach($deconde_rate_chart as $key_main =>$rate_chart){
                                    $indexed=100+$key_main;
                                    // dd($rate_chart);
                                    ?>
                                    <tr><td><select required name="artist_hounoriam_ctg[]"
                                                    id="artist_hounoriam_ctg_<?php echo e($key_main); ?>" class="form-control ' +
                'artist_hounoriam_ctg"><option value=""> চিহ্নিত করুন</option>
                                                <?php if(!empty($program_ctg)): ?>
                                                    <?php $__currentLoopData = $program_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?php echo e((!empty
                                                    ( $rate_chart['artist_hounoriam_ctg']) &&  $rate_chart['artist_hounoriam_ctg']==$key) ?"selected":''); ?>><?php echo e($value); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="chart_description_<?php echo e($key_main); ?>'" class="form-control
                                        chart_description" name="chart_description[]">
                                                <option value="">চিহ্নিত  করুন</option>
                                                <?php $__currentLoopData = $rate_chart['chart_description_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>
                                                $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option <?php echo e((!empty
                                                    ( $rate_chart['chart_description']) &&  $rate_chart['chart_description']==$key) ?"selected":''); ?>  value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>
                                        </td>
                                        <td><select required
                                                    name="artist_grade[]"
                                                    class="form-control"
                                                    id="artist_grade_<?php echo e($key_main); ?>"><option
                                                        value="">চিহ্নিত করুন</option>
                                                <?php $__currentLoopData = $rate_chart['chart_description_grade_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>
                                                $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option <?php echo e((!empty
                                                    ( $rate_chart['artist_grade']) &&  $rate_chart['artist_grade']==$key) ?"selected":''); ?>  value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                        <td><a
                                                    href="javascript:void(0);"  id="deleteRow_<?php echo e($key_main); ?>"
                                                    class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>

                                    <?php
                                    $key_main++;
                                    }
                                    }
                                    ?>
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
                        </div>-->


                        <div class="modal-footer">
                            <div class=" col-sm-7 text-left">
                                <span class="text-left" id="form_output_artist_info"></span>
                            </div>
                            <div class=" col-sm-5">
                                <button type="submit" id="saveBtn"
                                        class="btn btn-success"><i
                                            class="glyphicon glyphicon-save"></i>
                                    Save
                                </button>
                                
                                
                                
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="glyphicon glyphicon-remove"></i> Close
                                </button>
                                <input type="hidden" name="setting_id" id="setting_id" value="<?php echo e($artist_info_show->id); ?>">
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
            $('<tr><td><select required name="artist_hounoriam_ctg[]" id="artist_hounoriam_ctg_'+ a +'" class="form-control ' +
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
            $('<tr><td><select required name="expertise[]" id="expertise_'+ b +'" class="form-control ' +
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
                '                                                <?php $__currentLoopData = $artist_grade_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option   value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
                '                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                            </select>\n' +
                '                                        </td><td><a href="javascript:void(0);"  id="deleteRow_' + b + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntexperstise_info);

            b++;
            return false;
        });


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>