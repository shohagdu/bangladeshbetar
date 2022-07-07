<?php $__env->startSection('title_area'); ?>
:: Add New Song ::
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
            <a href="<?php echo e(url('get_archive_list')); ?>" class="btn btn-primary btn-xs"
               style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                সংগীত খাতা
            </a>
        </header>
        <div>
            <div class="widget-body no-padding">
                <div class="col-sm-12">

                    <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'song_create_form',
                    'class'=>'form-horizontal']); ?>

                    <div>
                        <div class="col-sm-12" style="margin-top:10px;">


                            <div class="form-group">
                                <label class="col-md-2 control-label"> সংগীতের বিভাগ
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" required name="song_department" id="song_category">
                                        <option value="1">সংগীত</option>
                                        <option value="2">ছায়াছবির গান</option>
                                        <option value="3">ব্যন্ডের গান</option>
                                    </select>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"> পরিকল্পনা আইডি
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="program_plan_id" placeholder="পরিকল্পনা আইডি" class="form-control" />
                                </div>
                                <label class="col-md-2 control-label">সঙ্গীত আইডি </label>
                                <div class="col-md-4">
                                    <input type="text" readonly name="songit_id" placeholder="সঙ্গীত আইডি" class="form-control" />
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
                                
                                <label class="col-md-2 control-label">গানের প্রথম লাইন</label>
                                <div class="col-md-4">
                                    <input class="form-control" required name="ganer_first_line" id="ganer_first_line" placeholder="গানের প্রথম লাইন" />
                                </div>

                                <label class="col-md-2 control-label"> গানের নাম
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control" required name="ganer_name" id="ganer_name" placeholder="গানের নাম" />
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"> গানের প্রকার
                                </label>
                                <div class="col-md-4">
                                    <select id="ganer_prokar" required onchange="get_song_sub_type(this.value)" class="form-control" name="ganer_prokar">
                                        <option value="">বাছাই করুন</option>
                                        <?php foreach ($song_category as $row) { ?>
                                            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label"> গানের উপ প্রকার
                                </label>
                                <div class="col-md-4">
                                    <select id="ganer_up_prokar" class="form-control" name="ganer_up_prokar">
                                        <option value="">বাছাই করুন</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">গানের টাইপ </label>
                                <div class="col-md-4">
                                    <select id="song_type"  class="select2" multiple=true placeholder="গানের টাইপ" name="song_type[]">
                                        <?php foreach ($song_type as $row) { ?>
                                            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <!-- <span><a href="javascript:void(0)">নতুন টাইপ</a></span> -->
                                </div>
                                <label class="col-md-2 control-label"> অংশগ্রহন
                                </label>
                                <div class="col-md-4">
                                    <select id="ongso_grohon" class="form-control" name="ongso_grohon">
                                        <option value="">চিহ্নিত করুন</option>
                                        <option value="1">একক</option>
                                        <option value="2">ডুয়েট</option>
                                        <option value="3">দলিয়</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"> রেটিং
                                </label>
                                <div class="col-md-4">
                                    <select id="reating" required class="form-control" name="reating">
                                        <option value="">চিহ্নিত করুন</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
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

                                <label class="col-md-2 control-label"> সোর্স
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="source" id="source">
                                        <option value="">বাছাই করুন</option>
                                        <?php foreach($song_source as $item){ ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group">

                                <label class="col-md-2 control-label">সোর্স আইডি </label>
                                <div class="col-md-4">
                                    <input type="text" name="source_id" placeholder="সোর্স আইডি" class="form-control"/>
                                </div>
                                <label class="col-md-2 control-label">প্রথম সম্প্রচার তারিখ </label>
                                <div class="col-md-4">
                                    <input class="form-control datepickerLong" name="first_bordcasting_date" id="first_bordcasting_date" placeholder="প্রথম সম্প্রচার তারিখ" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"> রেকডিং তারিখ
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control datepickerLong" name="recoarding_date" id="recoarding_date" placeholder="রেকডিং তারিখ" />
                                </div>
                                <label class="col-md-2 control-label">লিরিক্স ডকুমেন্ট </label>
                                <div class="col-md-4">
                                    <input type="file" name="lyrix_document" placeholder="লিরিক্স ডকুমেন্ট" class="form-control" />
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">লিরিক্স </label>
                                <div class="col-md-10">
                                    <textarea class="form-control" rows="7" name="lyrix" placeholder="লিরিক্স"></textarea>
                                </div>
                            </div>

                            <div class="film_section">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">ছায়াছবির নাম </label>
                                    <div class="col-md-4">
                                        <input type="text" name="film_name" class="form-control" placeholder="ছায়াছবির নাম" />
                                    </div>
                                    <label class="col-md-2 control-label">ছায়াছবির ধরন </label>
                                    <div class="col-md-4">
                                        <select id="film_type"  class="select2" multiple=true placeholder="ছায়াছবির ধরন" name="film_type[]">
                                            <?php foreach ($film_type as $row) { ?>
                                                <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">মুক্তির সাল </label>
                                    <div class="col-md-4">
                                        <input type="text" name="film_publish_date" class="form-control" placeholder="মুক্তির সাল" />
                                    </div>
                                    <label class="col-md-2 control-label">অবলম্বনে </label>
                                    <div class="col-md-4">
                                        <input type="text" name="oblombone" class="form-control" placeholder="অবলম্বনে" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">পুরস্কার/টীকা </label>
                                    <div class="col-md-4">
                                        <textarea  name="film_tika" class="form-control" placeholder="পুরস্কার/টীকা"></textarea>
                                    </div>
                                    <label class="col-md-2 control-label">কাহিনি সংক্ষেপ </label>
                                    <div class="col-md-4">
                                        <textarea name="kahini_songlap" class="form-control" placeholder="কাহিনি সংক্ষেপ"></textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <audio id="player">
                                    <source id="audioSource" src="" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <label class="col-md-2 control-label"> গানের অডিও ফাইল <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-3">
                                    <input type="file" name="odio_file" accept="audio/*" id="audioFile" class="form-control"  required/>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" style="display:none;" id="play_button" onclick="playsong()" class="btn btn-primary"><i   class="fa fa-play"></i></button>
                                </div>

                                <label class="col-md-2 control-label">গানের এ্যালবাম </label>
                                <div class="col-md-4">
                                    <select id="albam_name" name="albam_name_id" class="form-control">
                                        <option value="">এ্যালবামের নাম</option>
                                        <?php
                                        foreach ($archive_albam as $row) {
                                            ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span><a href="javascript:void(0)">নতুন এ্যালবাম</a></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">হাইপারলিংক </label>
                                <div class="col-md-4">
                                    <input class="form-control" name="hyperlink" id="hyperlink" placeholder="হাইপারলিংক" />
                                </div>
                                <label class="col-md-2 control-label band_section">ব্যন্ডের নাম </label>
                                <div class="col-md-4 band_section">
                                    <select class="form-control" name="band_name">
                                        <option value="">বাছাই করুন</option>
                                        <?php foreach ($band as $row) { ?>
                                            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <span><a href="javascript:void(0)">নতুন ব্যন্ড</a></span>
                                </div>

                            </div>


                            <div class="col-sm-12">

                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:15%">অংশগ্রহনকারী শিল্পীর তথ্য</th>
                                                <th style="width:35%"></th>
                                                <th style="width:15%"></th>
                                                <th style="width:35%">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="সঙ্গীত শিল্পী" />
                                                </td>
                                                <td>
                                                    <select id="artist" placeholder="সঙ্গীত শিল্পী" searchid="469" class="select2-ajax" multiple name="artist[]" style="width:100%; !important">
                                                        
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="মুল সঙ্গীত শিল্পী" />
                                                </td>
                                                <td>
                                                    <select id="main_artist" placeholder="মুল সঙ্গীত শিল্পী" searchid="469" class="select2-ajax" multiple name="main_artist[]" style="width:100%; !important">
                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="গীতিকার" />
                                                </td>
                                                <td>
                                                    <select id="gitikar" placeholder="গীতিকার নাম" searchid="460" class="select2-ajax" multiple name="gitikar[]" style="width:100%; !important">
                                                        
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="সুরকার" />
                                                </td>
                                                <td>
                                                    <select id="surokar" placeholder="সুরকার নাম" searchid="330" class="select2-ajax" multiple name="surokar[]" style="width:100%; !important">
                                                        
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="রেকর্ডিস্ট" />
                                                </td>
                                                <td>
                                                    <select id="recordist" placeholder="রেকর্ডিস্ট" searchid="463" class="select2-ajax" multiple name="recordist[]" style="width:100%; !important">
                                                        
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="শব্দ সম্পাদক"/>
                                                </td>
                                                <td>
                                                    <select id="sompadok" placeholder="শব্দ সম্পাদক" searchid="464" class="select2-ajax" multiple name="sompadok[]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="সংগীত পরিচালক" />
                                                </td>
                                                <td>
                                                    <select id="director" placeholder="পরিচালক নাম" searchid="465" class="select2-ajax" multiple name="song_director[]" style="width:100%; !important">
                                                        
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="সংগীত প্রযোজক" />
                                                </td>
                                                <td>
                                                    <select id="prjojok" placeholder="প্রযোজকের নাম" searchid="466" class="select2-ajax" multiple name="song_producer[]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table  class="table table-bordered film_section">
                                            <tr>
                                                <td>
                                                    <input type="text" style="width:130px"  readonly class="form-control" placeholder="অভিনয় শিল্পী" />
                                                </td>
                                                <td>
                                                    <select id="film_artist" placeholder="অভিনয় শিল্পী" searchid="467" class="select2-ajax" multiple name="film_actor[]" style="width:350px; !important">
                                                        
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" style="width:130px" readonly class="form-control" placeholder="চলচ্চিত্র পরিচালক" />
                                                </td>
                                                <td>
                                                    <select id="film_director" placeholder="চলচ্চিত্র পরিচালক" searchid="468" class="select2-ajax" multiple name="film_director[]" style="width:320px; !important">

                                                    </select>
                                                </td>
                                            </tr>
                                    </table>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:50%">যন্ত্র শিল্পী</th>
                                                <th style="width:40%">বাদ্যযন্ত্র</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="sound_artist_info">
                                            <tr>
                                                <td>
                                                    <select id="sound_artist" placeholder="যন্ত্রশিল্পীর নাম" class="select2" name="instument_artist[]" style="width:100%; !important">
                                                        <option value="">যন্ত্র শিল্পী</option>
                                                        <?php foreach ($artist_info as $key => $name) { ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="instument" onkeypress="autocompleteInstument(this)" placeholder="বাদ্যযন্ত্রের নাম" class="form-control" name="instument[]" style="width:100%; !important" />
                                                </td>
                                                <td>
                                                    <button onclick="jontroshilpi_add()" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
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
                            <textarea style="visibility:hidden" id="artist_json_data"><?php echo json_encode($artist_info, JSON_UNESCAPED_UNICODE); ?></textarea>
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