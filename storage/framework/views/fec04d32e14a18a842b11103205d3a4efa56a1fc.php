<?php $__env->startSection('title_area'); ?>
    :: Add New Poeam ::
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
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>
                <a href="<?php echo e(url('get_procharona_list')); ?>" class="btn btn-primary btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    প্রচারনা খাতা
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'procharona_create_form',
                        'class'=>'form-horizontal']); ?>

                        <div>
                            <div class="col-sm-12" style="margin-top:10px;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> পরিকল্পনা আইডি
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="program_plan_id" placeholder="পরিকল্পনা আইডি" class="form-control" />
                                    </div>
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> কেন্দ্র
                                    </label>
                                    <div class="col-md-4">
                                        <select id="station_id" required class="form-control" name="station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                            <?php if(!empty($station_info)): ?>
                                                <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-4 control-label"><input type="checkbox" name="sadin_bangla_betar_kendro"/> স্বাধীন বাংলা বেতার কেন্দ্র </label>
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label">প্রথম লাইন</label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="prothom_line" id="prothom_line" placeholder="প্রথম লাইন" />
                                    </div>

                                    <label class="col-md-2 control-label"> প্রচারণার বিষয়
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="subject" id="subject" placeholder="প্রচারণার বিষয়"/>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> আঙ্গিক <span class="mandatory_field">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" required id="angik" name="angik">
                                            <option value="">বাছাই করুন</option>
                                            <?php
                                            if(!empty($angik_info)) {
                                                foreach($angik_info as $value){
                                            ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label"> মন্ত্রণালয়
                                    </label>
                                    <div class="col-md-4">
                                        <select id="ministry" onchange="get_ministry_sub_type(this.value)" class="form-control" name="ministry">
                                            <option value="">বাছাই করুণ</option>
                                            <?php
                                            if(!empty($ministry)) {
                                            foreach($ministry as $value){
                                            ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> দপ্তর
                                    </label>
                                    <div class="col-md-4">
                                        <select id="doptor" required class="form-control" name="doptor">
                                            <option value="">চিহ্নিত করুন</option>
                                        </select>
                                    </div>

                                    <label class="col-md-2 control-label"> স্থিতি
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="stability" id="stability" placeholder="স্থিতি" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> প্রচার স্থান
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" onkeypress="autocompletebrodcastPlace(this)" class="form-control" id="prochar_sthan" name="prochar_sthan" placeholder="প্রচার স্থান" />
                                    </div>

                                    <label class="col-md-2 control-label">হাইপারলিংক </label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="hyperlink" id="hyperlink" placeholder="হাইপারলিংক" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> রেকডিং তারিখ
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control datepickerLong" autocomplete="off" name="recoarding_date" id="recoarding_date" placeholder="রেকডিং তারিখ" />
                                    </div>
                                    <label class="col-md-2 control-label">প্রথম সম্প্রচার তারিখ </label>
                                    <div class="col-md-4">
                                        <input class="form-control datepickerLong" autocomplete="off" name="first_bordcasting_date" id="first_bordcasting_date" placeholder="প্রথম সম্প্রচার তারিখ" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <audio id="player">
                                        <source id="audioSource" src="" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    <label class="col-md-2 control-label"> প্রচারণার অডিও ফাইল <span class="mandatory_field">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="file" name="odio_file" accept="audio/*" id="audioFile" class="form-control"  required/>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" style="display:none;" id="play_button" onclick="playsong()" class="btn btn-primary"><i   class="fa fa-play"></i></button>
                                    </div>

                                    <label class="col-md-2 control-label"> পাণ্ডুলিপি <span class="mandatory_field">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" name="pandulipi" id="pandulipi" class="form-control"  required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        মন্তব্য
                                    </label>
                                    <div class="col-md-10">
                                        <textarea id="comment" class="form-control" name="comment" placeholder="মন্তব্য"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="row">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:25%">প্রচারনার বিষয়বস্তু</th>
                                                <th style="width:65%">আর্কাইভ আইডি</th>
                                                <th style="width:10%">

                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="bisoybostu_section">

                                                <tr>
                                                    <td>
                                                        <select id="archive_type_id_0" onchange="reinitialize_archiveids(this.value)"  searchid="8" class="select2-archive_type"  style="width:100%; !important">

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="archive_type_artist_id0"  search_type="1" class="select2-archiveids" multiple  style="width:100%; !important">

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button onclick="bisoybostu_add()" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width:25%">ভূমিকায়</th>
                                                    <th style="width:65%">অংশগ্রহণকারী শিল্পী</th>
                                                    <th style="width:30%">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="vumika_artist_info">
                                                <tr>
                                                    <td>
                                                        <select id="vumika_id" placeholder="ভুমিকা বাছাই করুণ" searchid="469"  class="select2-ajax-vumika"  name="vumika_id[0]" style="width:100%; !important">

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="vumika_artist" placeholder="অংশগ্রহণে" searchid="469" class="select2-ajax" multiple name="vumika_artist[0][]" style="width:100%; !important">

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button onclick="vumikashilpi_add()" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:20%">অংশগ্রহনকারী শিল্পীর তথ্য</th>
                                                <th style="width:35%"></th>
                                                <th style="width:15%"></th>
                                                <th style="width:30%">

                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="অংশগ্রহণে" />
                                                </td>
                                                <td colspan="3">
                                                    <select id="ongshogrohon" placeholder="অংশগ্রহণে" searchid="469" class="select2-ajax" multiple name="ongshogrohon[]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:15%">সংশ্লিষ্ট আধিকারিক</th>
                                                <th style="width:35%"></th>
                                                <th style="width:15%"></th>
                                                <th style="width:35%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="পরিকল্পনা" />
                                                </td>
                                                <td>
                                                    <select id="maker" placeholder="পরিকল্পনাকারীর নাম" searchid="20" class="select2" multiple name="plan_maker[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="সম্পাদনা" />
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="সম্পাদনা" class="select2" searchid="20" multiple name="sompadona[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>




                                            </tr>

                                            <tr>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="প্রযোজনা সহকারী" />
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="প্রযোজনা সহকারী" class="select2" searchid="20" multiple name="assistent_producer[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="প্রযোজনা" />
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="প্রযোজনা" class="select2" searchid="20" multiple name="producer[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="তত্ত্বাবধানে" />
                                                </td>
                                                <td>
                                                    <select id="codinator" placeholder="নাম" class="select2" searchid="20" multiple name="codinator[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="নির্দেশনা" />
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="নির্দেশনা নাম" class="select2" searchid="20" multiple name="direction[]" style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name."(".$key.")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class=" col-sm-7 text-left">
                                <span class="text-left" id="form_output"></span>
                            </div>
                            <div class=" col-sm-5">
                                <button type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                                    <span id="saveing_text">Save</span>
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close
                                </button>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                        <div class=" col-sm-offset-4 col-sm-8 ajax-loader" style="display: none;">
                            <img src="<?php echo e(url('fontView\assets\img\ajax-loader.gif')); ?>" class="img-responsive" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>