@extends("master_archive")
@section('title_area')
:: Add New Song ::
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
        <header>
            <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
            <h2>{{ $page_title }}</h2>
        </header>
        <div>
            <div class="widget-body no-padding">
                <div class="col-sm-12">

                    {!! Form::open(['url' => '', 'method' => 'post','id' => 'song_create_form',
                    'class'=>'form-horizontal']) !!}
                    <div>
                        <div class="col-sm-12" style="margin-top:10px;">

                            
                            <div class="form-group">
                                <label class="col-md-3 control-label"> অনুষ্ঠান পরিকল্পনা আইডি (যদি থাকে)
                                </label>
                                <div class="col-md-3">
                                    <input type="text" name="program_plan_id" placeholder="পরিকল্পনা আইডি"  class="form-control"/>
                                </div>
                                <label class="col-md-3 control-label">সঙ্গীত আইডি </label>
                                <div class="col-md-3">
                                    <input type="text" readonly name="program_plan_id" placeholder="সঙ্গীত আইডি" class="form-control"/>
                                    <span>সংগীতের প্যাটার্ন অনুসারে আইডি অটোমেটিক জেনারেট হবে </span>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label class="col-md-2 control-label"> কেন্দ্র <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-4">
                                    <select id="station_id" onchange="getSubStation(this.value)" class="form-control" name="station_id">
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
                                <label class="col-md-2 control-label"> গানের নাম <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control" name="ganer_name" id="ganer_name" placeholder="গানের নাম"/>
                                </div>
                                <label class="col-md-2 control-label">১ম লাইন <span class="mandatory_field">*</span> </label>
                                <div class="col-md-4">
                                    <input class="form-control" name="ganer_first_line" id="ganer_first_line" placeholder="১ম লাইন"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"> গানের প্রকার <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-4">
                                    <select id="ganer_prokar" class="form-control" name="ganer_prokar">
                                        <option value="">গানের প্রকার</option>
                                        <?php foreach($song_category as $row) { ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label"> গানের উপ প্রকার
                                </label>
                                <div class="col-md-4">
                                    <select id="ganer_up_prokar" class="form-control" name="ganer_up_prokar">
                                        <option value="">উপ প্রকার</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">গানের বিষয় <span class="mandatory_field">*</span> </label> 
                                <div class="col-md-4">
                                    <select id="subject" required class="form-control" name="subject">
                                        <option value="">চিহ্নিত করুন</option>
                                        <?php foreach($song_subject as $row) { ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <label class="col-md-2 control-label"> অংশগ্রহন <span class="mandatory_field">*</span>
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
                                <label class="col-md-2 control-label"> রেটিং <span class="mandatory_field">*</span>
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
                                
                                <label class="col-md-2 control-label"> স্থিতি <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control" name="stability" id="stability" placeholder="স্থিতি"/>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label"> প্রচার স্থান <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-4">
                                    <select id="sub_station_id" required class="form-control" name="sub_station_id">
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                </div>
                                
                                <label class="col-md-2 control-label"> সোর্স <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control" name="source" id="source" placeholder="সোর্স"/>
                                </div>
                            </div>

                            

                            <div class="form-group">
                                <label class="col-md-2 control-label"> রেকডিং তারিখ 
                                </label>
                                <div class="col-md-4">
                                    <input class="form-control datepickerLong" name="recoarding_date" id="recoarding_date" placeholder="রেকডিং তারিখ"/>
                                </div>
                                <label class="col-md-2 control-label">প্রথম সম্প্রচার তারিখ </label>
                                <div class="col-md-4">
                                    <input class="form-control datepickerLong" name="first_bordcasting_date" id="first_bordcasting_date" placeholder="প্রথম সম্প্রচার তারিখ"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">হাইপারলিংক </label>
                                <div class="col-md-4">
                                    <input class="form-control" name="hyperlink" id="hyperlink" placeholder="হাইপারলিংক"/>
                                </div>
                                <label class="col-md-2 control-label">লিরিক্স </label>
                                <div class="col-md-4">
                                    <textarea class="form-control" name="lyrix" placeholder="লিরিক্স"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">লিরিক্স ডকুমেন্ট </label>
                                <div class="col-md-4">
                                    <input type="file" name="lyrix_document"  class="form-control"/>
                                </div>
                                <label class="col-md-2 control-label"> গানের অডিও ফাইল <span class="mandatory_field">*</span>
                                </label>
                                <div class="col-md-4">
                                    <input type="file" name="odio_file" required class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">হাইপারলিংক </label>
                                <div class="col-md-4">
                                    <input class="form-control" name="hyperlink" id="hyperlink" placeholder="হাইপারলিংক"/>
                                </div>
                                <label class="col-md-2 control-label">গানের এ্যালবাম </label>
                                <div class="col-md-4">
                                    <select id="albam_name"  class="form-control">
                                        <option value="">এ্যালবামের নাম</option>
                                        <?php 
                                        foreach($albam_info as $row) {
                                        ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">ছায়াছবির নাম </label>
                                <div class="col-md-4">
                                    <input type="text" name="" class="form-control" placeholder="ছায়াছবির নাম"/>
                                </div>
                                <label class="col-md-2 control-label">ছায়াছবির ধরন </label>
                                <div class="col-md-4">
                                    <select class="form-control">
                                        <option value="">চিনহিত করুন</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">মুক্তির সাল </label>
                                <div class="col-md-4">
                                    <input type="text" name="" class="form-control" placeholder="মুক্তির সাল"/>
                                </div>
                                <label class="col-md-2 control-label">অবলম্বনে </label>
                                <div class="col-md-4">
                                    <input type="text" name="" class="form-control" placeholder="অবলম্বনে"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">পুরস্কার </label>
                                <div class="col-md-4">
                                    <input type="text" name="" class="form-control" placeholder="পুরস্কার"/>
                                </div>
                                <label class="col-md-2 control-label">কাহিনি সংক্ষেপ </label>
                                <div class="col-md-4">
                                    <textarea class="form-control" placeholder="কাহিনি সংক্ষেপ"></textarea>
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
                                                <th style="width:35%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="মুল কণ্ঠশিল্পী"/>
                                                </td>
                                                <td>
                                                    <select id="main_artist" placeholder="মুল কণ্ঠশিল্পী" class="select2" multiple name="main_artist[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="কণ্ঠশিল্পী"/>
                                                </td>
                                                <td>
                                                    <select id="artist" placeholder="কণ্ঠশিল্পী" class="select2" multiple name="artist[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="গীতিকার"/>
                                                </td>
                                                <td>
                                                    <select id="gitikar" placeholder="গীতিকার নাম" class="select2" multiple name="gitikar[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="সুরকার"/>
                                                </td>
                                                <td>
                                                    <select id="surokar" placeholder="সুরকার নাম" class="select2" multiple name="surokar[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="যন্ত্রশিল্পী"/>
                                                </td>
                                                <td>
                                                    <select id="sound_artist" placeholder="যন্ত্রশিল্পীর নাম" class="select2" multiple name="sound_artist[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="ব্যবহিত বাদ্যযন্ত্র"/>
                                                </td>
                                                <td>
                                                    <input type="text" id="instument" placeholder="বাদ্যযন্ত্রের নাম" class="form-control"  name="instument" style="width:100%; !important"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="সংগীত পরিচালক"/>
                                                </td>
                                                <td>
                                                    <select id="director" placeholder="পরিচালক নাম" class="select2" multiple name="director[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="ছায়াছবি প্রযোজক"/>
                                                </td>
                                                <td>
                                                    <select id="prjojok" placeholder="প্রযোজকের নাম" class="select2" multiple name="prjojok[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="ছায়াছবি পরিচালক"/>
                                                </td>
                                                <td>
                                                    <select id="director" placeholder="ছায়াছবি পরিচালক" class="select2" multiple name="director[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="অভিনয় শিল্পী"/>
                                                </td>
                                                <td>
                                                    <select id="prjojok" placeholder="অভিনয় শিল্পী" class="select2" multiple name="prjojok[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
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
                                                    <input type="text" readonly class="form-control" placeholder="পরিকল্পনা"/>
                                                </td>
                                                <td>
                                                    <select id="maker" placeholder="পরিকল্পনাকারীর নাম" class="select2" multiple name="maker[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="তত্ত্বাবধায়ক"/>
                                                </td>
                                                <td>
                                                    <select id="codinator" placeholder="তত্ত্বাবধায়কের নাম" class="select2" multiple name="codinator[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <input type="text" readonly class="form-control" placeholder="নির্দেশনা"/>
                                                </td>
                                                <td>
                                                    <select id="direction" placeholder="নির্দেশনা নাম" class="select2" multiple name="direction[]" style="width:100%; !important">
                                                         <?php foreach($atrist_info_info as $key => $name){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
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
                            <button type="submit"  id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>Save
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</article>

@endsection