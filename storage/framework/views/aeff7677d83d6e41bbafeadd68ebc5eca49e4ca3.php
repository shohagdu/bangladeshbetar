
<?php $__env->startSection('title_area'); ?>
    :: Add New Poeam ::
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
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>
                <a href="<?php echo e(url('get_sakhhatkar_list')); ?>" class="btn btn-primary btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    সাক্ষাতকার খাতা
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'sakhhatkar_create_form',
                        'class'=>'form-horizontal']); ?>

                        <div>
                            <div class="col-sm-12" style="margin-top:10px;">

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> পরিকল্পনা আইডি
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="program_plan_id" placeholder="পরিকল্পনা আইডি"
                                               class="form-control"/>
                                    </div>

                                    <label class="col-md-2 control-label">সাক্ষাৎকারের প্রথম লাইন</label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="first_line" id="first_line" placeholder="সাক্ষাৎকারের প্রথম লাইন" />
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
                                    <label class="col-md-4 control-label"><input type="checkbox"
                                                                                 name="sadin_bangla_betar_kendro"/>
                                        স্বাধীন বাংলা বেতার কেন্দ্র </label>
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label">অনুষ্ঠানের নাম</label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="program_name" id="program_name"
                                               placeholder="অনুষ্ঠানের নাম"/>
                                    </div>

                                    <label class="col-md-2 control-label"> সাক্ষাৎকারের বিষয়
                                    </label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" required name="subject" id="subject"
                                                  placeholder="সাক্ষাৎকারের বিষয়"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">সাক্ষাৎ দাতার নাম </label>
                                    <div class="col-md-4">
                                        <input type="text" required name="sakhhat_data" id="sakhhat_data"
                                               placeholder="সাক্ষাৎ দাতার নাম" class="form-control"/>
                                    </div>
                                    <label class="col-md-2 control-label"> সাক্ষাৎকারের প্রকার
                                    </label>
                                    <div class="col-md-4">
                                        <select id="sakhhater_prokar" class="form-control" name="sakhhater_prokar">
                                            <option value="">চিহ্নিত করুন</option>
                                            <?php foreach($song_category as $value) { ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> কর্মক্ষেত্র
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="work_area" placeholder="কর্মক্ষেত্র"
                                               name="work_area"/>
                                    </div>

                                    <label class="col-md-2 control-label"> স্থিতি
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="stability" id="stability"
                                               placeholder="স্থিতি"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> স্থান
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="prochar_sthan" name="prochar_sthan"
                                               placeholder="স্থান"/>
                                    </div>

                                    <label class="col-md-2 control-label">বিষয় </label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" name="subject" id="subject"
                                                  placeholder="বিষয়"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> সাক্ষাৎ গ্রহণের তারিখ
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control datepickerLong" autocomplete="off"
                                               name="grohoner_date" id="grohoner_date"
                                               placeholder="সাক্ষাৎ গ্রহণের তারিখ"/>
                                    </div>
                                    <audio id="player">
                                        <source id="audioSource" src="" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    <label class="col-md-2 control-label"> সাক্ষাতের অডিও ফাইল <span
                                                class="mandatory_field">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="file" name="odio_file" accept="audio/*" id="audioFile"
                                               class="form-control" required/>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" style="display:none;" id="play_button"
                                                onclick="playsong()" class="btn btn-primary"><i class="fa fa-play"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> মন্তব্য
                                    </label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" id="comment" placeholder="মন্তব্য" name="comment"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> সাক্ষাতকার বিভাগ
                                    </label>
                                    <div class="col-md-10">
                                         <input type="checkbox" value="1" onclick="sakhhatkarDepartmentCheck(this)" name="sakhhatkar_department[]"/> সাক্ষাতকারভিত্তিক
                                         <input type="checkbox" value="2" onclick="sakhhatkarDepartmentCheck(this)" name="sakhhatkar_department[]"/> আলোচনা অনুষ্ঠান
                                         <input type="checkbox" onclick="sakhhatkarDepartmentCheck(this)"  value="3"name="sakhhatkar_department[]"/> চিঠিপত্র/ এসএমএস/ইমেইল
                                         <input type="checkbox" onclick="sakhhatkarDepartmentCheck(this)" value="4" name="sakhhatkar_department[]"/> ফোন-ইন প্রোগ্রাম
                                         <input type="checkbox" onclick="sakhhatkarDepartmentCheck(this)" value="5" name="sakhhatkar_department[]"/> সরেজমিন প্রতিবেদন
                                         <input type="checkbox" onclick="sakhhatkarDepartmentCheck(this)" value="6" name="sakhhatkar_department[]"/> বির্তক
                                    </div>
                                </div>



                                <div class="col-sm-12">

                                    <div class="row">


                                        <table id="sakhhatkar_vhittik" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:20%">সাক্ষাতকারভিত্তিক</th>
                                                <th style="width:30%"></th>
                                                <th style="width:20%"></th>
                                                <th style="width:30%"></th>
                                            </tr>

                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="সাক্ষাতকার দাতা"/>
                                                </td>
                                                <td>
                                                    <select id="surokar" placeholder="সাক্ষাতকার দাতা" searchid="459"
                                                            class="select2-ajax" multiple name="sakhhatkardata[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="সাক্ষাতকার গ্রহীতা"/>
                                                </td>
                                                <td>
                                                    <select id="main_artist" placeholder="সাক্ষাতকার গ্রহীতা"
                                                            searchid="469" class="select2-ajax" multiple
                                                            name="sakhhatkar_grohita[]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table id="alochona_onusthan" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:20%">আলোচনা অনুষ্ঠান</th>
                                                <th style="width:30%"></th>
                                                <th style="width:20%"></th>
                                                <th style="width:30%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="আলোচনা অংশগ্রহণকারী"/>
                                                </td>
                                                <td>
                                                    <select id="surokar" placeholder="আলোচনা অংশগ্রহণকারী" searchid="459"
                                                            class="select2-ajax" multiple name="ongshogrohonkari[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="আলোচনার সঞ্চালক"/>
                                                </td>
                                                <td>
                                                    <select id="main_artist" placeholder="আলোচনার সঞ্চালক"
                                                            searchid="469" class="select2-ajax" multiple
                                                            name="sonchalok[]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                        <table id="sms" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:20%">চিঠিপত্র/ এসএমএস/ইমেইল</th>
                                                <th style="width:30%"></th>
                                                <th style="width:20%"></th>
                                                <th style="width:30%"></th>
                                            </tr>

                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="গ্রন্থনা"/>
                                                </td>
                                                <td>
                                                    <select id="surokar" placeholder="গ্রন্থনা" searchid="459"
                                                            class="select2-ajax" multiple name="gronthona[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="উপস্থাপনা"/>
                                                </td>
                                                <td>
                                                    <select id="main_artist" placeholder="উপস্থাপনা" searchid="469"
                                                            class="select2-ajax" multiple name="uposthapona[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table id="phone_in_program" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:20%">ফোন-ইন প্রোগ্রাম</th>
                                                <th style="width:30%"></th>
                                                <th style="width:20%"></th>
                                                <th style="width:30%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="বিশেষজ্ঞ"/>
                                                </td>
                                                <td>
                                                    <select id="surokar" placeholder="সাক্ষাতকার দাতা" searchid="459"
                                                            class="select2-ajax" multiple name="bishesoggo[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="পরিচালনা"/>
                                                </td>
                                                <td>
                                                    <select id="main_artist" placeholder="পরিচালনা" searchid="469"
                                                            class="select2-ajax" multiple name="porichalona[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table id="protibedon" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:20%">সরেজমিন প্রতিবেদন</th>
                                                <th style="width:30%"></th>
                                                <th style="width:20%"></th>
                                                <th style="width:30%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="প্রতিবেদক"/>
                                                </td>
                                                <td>
                                                    <select id="surokar" placeholder="প্রতিবেদক" searchid="459"
                                                            class="select2-ajax" multiple name="protibedok[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>

                                                <td>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table id="bitorko_table" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:15%">বিতর্ক</th>
                                                <th style="width:20%"></th>
                                                <th style="width:15%"></th>
                                                <th style="width:20%"></th>
                                                <th style="width:10%"></th>
                                                <th style="width:20%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="বিতরক পর্যায়"/>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="bitorko_porjay">
                                                        <option value="">বাছাই করুণ</option>
                                                        <option value="1">স্কুল</option>
                                                        <option value="2">ক্লেজ</option>
                                                        <option value="3">বিশ্ববিদ্যালয়</option>
                                                    </select>
                                                </td>
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">প্রতিষ্ঠানের নাম</td>
                                                <td colspan="2">ঠিকানা</td>
                                                <td colspan="2">অংশগ্রহণকারী</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="text" class="form-control" style="width:100% !important;" placeholder="প্রতিষ্ঠানের নাম" name="protisthaner_name[0]"></input>
                                                </td>
                                                <td colspan="2">
                                                    <textarea style="width:100% !important;" placeholder="প্রতিষ্ঠানের ঠিকানা" name="protisthaner_thikana[0]"></textarea>
                                                </td>
                                                <td colspan="2">
                                                    <select  searchid="459" class="select2-ajax"
                                                            multiple name="bitorko_ongshogrohonkari[0][]"
                                                            style="width:100%; !important">

                                                    </select>
                                                    <button onclick="bitorko_add()" type="button" class="btn btn-info btn-sm" style="float:right;"><i class="fa fa-plus"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="বিচারক"/>
                                                </td>
                                                <td>
                                                    <select placeholder="বিচারক" searchid="459" class="select2-ajax"
                                                            multiple name="bicharok[]" style="width:100%; !important">

                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="বিতর্ক পরিচালনা"/>
                                                </td>
                                                <td>
                                                    <select placeholder="বিচারক" searchid="459" class="select2-ajax"
                                                            multiple name="bitorko_porichalona[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="সহযোগিতা"/>
                                                </td>
                                                <td>
                                                    <select placeholder="সহযোগিতা" searchid="459" class="select2-ajax"
                                                            multiple name="bitorko_shohojogita[]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:25%"> বিষয়বস্তু</th>
                                                <th style="width:65%">আর্কাইভ আইডি</th>
                                                <th style="width:10%">

                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="bisoybostu_section">

                                            <tr>
                                                <td>
                                                    <select id="archive_type_id_0"
                                                            onchange="reinitialize_archiveids(this.value)" searchid="8"
                                                            class="select2-archive_type" style="width:100%; !important">

                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="archive_type_artist_id0" search_type="1"
                                                            class="select2-archiveids" multiple
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>
                                                <td>
                                                    <button onclick="bisoybostu_add()" type="button"
                                                            class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                                    </button>
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
                                                    <select id="vumika_id" placeholder="ভুমিকা বাছাই করুণ"
                                                            searchid="469" class="select2-ajax-vumika"
                                                            name="vumika_id[0]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="vumika_artist" placeholder="অংশগ্রহণে" searchid="469"
                                                            class="select2-ajax" multiple name="vumika_artist[0][]"
                                                            style="width:100%; !important">

                                                    </select>
                                                </td>
                                                <td>
                                                    <button onclick="vumikashilpi_add()" type="button"
                                                            class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                                    </button>
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
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="পরিকল্পনা"/>
                                                </td>
                                                <td>
                                                    <select id="maker" placeholder="পরিকল্পনাকারীর নাম" searchid="20"
                                                            class="select2" multiple name="plan_maker[]"
                                                            style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name . "(" . $key . ")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="সম্পাদনা"/>
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="সম্পাদনা" class="select2"
                                                            searchid="20" multiple name="sompadona[]"
                                                            style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name . "(" . $key . ")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>


                                            </tr>

                                            <tr>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="প্রযোজনা সহকারী"/>
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="প্রযোজনা সহকারী" class="select2"
                                                            searchid="20" multiple name="assistent_producer[]"
                                                            style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name . "(" . $key . ")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="প্রযোজনা"/>
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="প্রযোজনা" class="select2"
                                                            searchid="20" multiple name="producer[]"
                                                            style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name . "(" . $key . ")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>


                                            </tr>

                                            <tr>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="তত্ত্বাবধানে"/>
                                                </td>
                                                <td>
                                                    <select id="codinator" placeholder="নাম" class="select2"
                                                            searchid="20" multiple name="codinator[]"
                                                            style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name . "(" . $key . ")"; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control"
                                                           placeholder="নির্দেশনা"/>
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="নির্দেশনা নাম" class="select2"
                                                            searchid="20" multiple name="direction[]"
                                                            style="width:100%; !important">
                                                        <?php foreach ($employee_info as $key => $name) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name . "(" . $key . ")"; ?></option>
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
                                <button type="submit" id="saveBtn" class="btn btn-success"><i
                                            class="glyphicon glyphicon-save"></i>
                                    <span id="saveing_text">Save</span>
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="glyphicon glyphicon-remove"></i> Close
                                </button>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                        <div class=" col-sm-offset-4 col-sm-8 ajax-loader" style="display: none;">
                            <img src="<?php echo e(url('fontView\assets\img\ajax-loader.gif')); ?>" class="img-responsive"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>