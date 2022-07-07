@extends("master_archive")
@section('title_area')
:: Add New Poeam ::
@endsection
@section('show_message')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('message') }}
</div>
@endif
@endsection
@section('main_content_area')
<article class="col-sm-12 col-md-12 col-lg-12">
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
            <h2>{{ $page_title }}</h2>
            <a href="{{ url('get_kobita_list') }}" class="btn btn-primary btn-xs"
               style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                গ্লপ/কবিতা খাতা
            </a>
        </header>
        <div>
            <div class="widget-body no-padding">
                <div class="col-sm-12">

                    {!! Form::open(['url' => '', 'method' => 'post','id' => 'kobita_create_form',
                    'class'=>'form-horizontal']) !!}
                    <div>
                        <div class="col-sm-12" style="margin-top:10px;">

                            <div class="form-group">

                                <label class="col-md-2 control-label">বিভাগ</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="kobita_department" id="kobita_department"  required>
                                        <option value="1">কবিতা</option>
                                        <option value="2">গল্প</option>
                                    </select>
                                </div>

                                <label class="col-md-2 control-label"> পরিকল্পনা আইডি
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="program_plan_id" placeholder="পরিকল্পনা আইডি" class="form-control" />
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"> কেন্দ্র
                                </label>
                                <div class="col-md-4">
                                    <select id="station_id" required class="form-control" name="station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                        @if(!empty($station_info))
                                        @foreach($station_info as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <label class="col-md-4 control-label"><input type="checkbox" name="sadin_bangla_betar_kendro"/> স্বাধীন বাংলা বেতার কেন্দ্র </label>
                                <div class="col-md-2">

                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-md-2 control-label"> প্রথম লাইন</label>
                                <div class="col-md-4">
                                    <input class="form-control" required name="kobitar_first_line" id="kobitar_first_line" placeholder="কবিতার প্রথম লাইন" />
                                </div>

                                <label class="col-md-2 control-label"> গল্প/কবিতার নাম
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control" required name="kobitar_name" id="kobitar_name" placeholder="কবিতার নাম" />
                                </div>

                            </div>



                            <div class="form-group">
                                <label class="col-md-2 control-label">কবিতার ধরন </label>
                                <div class="col-md-4">
                                    <select id="kobitar_dhoron" class="form-control" name="kobitar_dhoron">
                                        <option value="">চিহ্নিত করুন</option>
                                        <?php foreach($kobita_type as $key => $value) { ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->name; ?></option>
                                        <?php  }  ?>
                                    </select>
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
                                <label class="col-md-2 control-label"> কবিতার অডিও ফাইল <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-3">
                                    <input type="file" name="odio_file" accept="audio/*" id="audioFile" class="form-control"  required/>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" style="display:none;" id="play_button" onclick="playsong()" class="btn btn-primary"><i   class="fa fa-play"></i></button>
                                </div>

                                <label class="col-md-2 control-label">কবিতার এ্যালবাম </label>
                                <div class="col-md-4">
                                    <select id="kobitar_albam" name="kobitar_albam" class="form-control">
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

                                <label class="col-md-2 control-label">গ্রন্থের নাম</label>
                                <div class="col-md-4">
                                    <input class="form-control" required name="gronther_name" id="kobitar_first_line" placeholder="কবিতার প্রথম লাইন" />
                                </div>

                                <label class="col-md-2 control-label"> কবিতার ্লাইন
                                </label>
                                <div class="col-md-4">
                                    <textarea class="form-control" placeholder="কবিতার লাইন" name="kobitar_line" rows="12"></textarea>
                                </div>

                            </div>

                            <div class="col-sm-12">

                                <div class="row">
                                    <table  class="table table-bordered">
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
                                            <tr id="kobita_section">
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="আবৃত্তিকার" />
                                                </td>
                                                <td>
                                                    <select id="abritikar" placeholder="আবৃত্তিকার" searchid="469" class="select2-ajax" multiple name="abritikar[]" style="width:100%; !important">

                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="রচয়িতা" />
                                                </td>
                                                <td>
                                                    <select id="rochoyita" placeholder="রচয়িতা" searchid="469" class="select2-ajax" multiple name="rochoyita[]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>

                                            <tr id="golpo_section">
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="গল্প পাঠক" />
                                                </td>
                                                <td>
                                                    <select id="abritikar" placeholder="গল্প পাঠক" searchid="469" class="select2-ajax" multiple name="golpo_pathok[]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="গল্প রচনা" />
                                                </td>
                                                <td>
                                                    <select id="rochoyita" placeholder="গল্প রচনা" searchid="469" class="select2-ajax" multiple name="golpo_rochoyita[]" style="width:100%; !important">

                                                    </select>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <table  class="table table-bordered">
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
                    {!! Form::close() !!}
                    <div class=" col-sm-offset-4 col-sm-8 ajax-loader" style="display: none;">
                        <img src="{{ url('fontView\assets\img\ajax-loader.gif') }}" class="img-responsive" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

@endsection