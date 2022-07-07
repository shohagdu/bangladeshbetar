@extends("master_program")
@section('title_area')
    :: {{ $page_title }}  ::
@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> {{ $page_title }}  </h2>


                <a href="{{ url('artist_record') }}"
                   class="btn btn-info btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                   Artist List
                </a>
                <a href="{{ url('artist_record_add') }}"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New Artist
                </a>
                <button onclick="back()"
                   class="btn btn-warning btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-backward"></i>
                 Back
                </button>


            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table  id="table-style" style="width: 100%;margin-bottom: 10px;">
                            <tr>
                                <td class="width20per "> স্ট্যাটাস</td>
                                <td class="{{ (!empty($artist_info_show->is_active) &&
                                        $artist_info_show->is_active==2) ?
                           "Inactive":'Active' }} width30per">{{ (!empty($artist_info_show->is_active) &&
                                        $artist_info_show->is_active==2) ?
                           "Inactive":'Active' }} </td>
                                <td class="width20per text-center" rowspan="4">
                                    <span >
                                        <img src="{{ (file_exists("fontView/assets/artist_image/"
                                            .$artist_info_show->picture))? (!empty
                                            ($artist_info_show->picture)?url
                                            ("fontView/assets/artist_image/"
                                            .$artist_info_show->picture):url
                                            ("images\default\default-avatar.png")):url
                                            ("images\default\default-avatar.png")  }}" style="height:115px; width:115px;">
                                            <div class="clearfix"></div>
                                            <div style="padding:5px;background: #d0d0d0;" >শিল্পীর ছবি</div>
                                    </span>
                                </td>
                                <td class="width20per text-center" rowspan="4">
                                    <span >
                                    <img src="{{ (file_exists("fontView/assets/artist_signature/"
                                        .$artist_info_show->artist_signature))? (!empty
                                        ($artist_info_show->artist_signature)?url
                                        ("fontView/assets/artist_signature/"
                                        .$artist_info_show->artist_signature):url
                                        ("images\default\default-avatar.png")):url
                                        ("images\default\default-avatar.png")  }}" style="height:115px; width:115px;
                                        ">
                                        <div class="clearfix"></div>
                                        <div style="padding:5px;background: #d0d0d0;" >স্বাক্ষর</div>
                                    </span>

                                </td>
                            </tr>
                            <tr>
                                <td class="width20per "> শিল্পীর দপ্তর</td>
                                <td class=" width30per">{{ (!empty($artist_info_show->artist_doptor) &&
                                            $artist_info_show->artist_doptor==1) ?
                               "অনুষ্ঠান":( ($artist_info_show->artist_doptor==2)?"বার্তা":"") }} </td>

                            </tr>
                            <tr>
                                <td class="width20per ">শিল্পীর ধরন</td>
                                <td class="width30per">
                                    @php
                                        $artist_type=artist_type();
                                        if(!empty($artist_type)){
                                            if(!empty($artist_info_show->artist_type)){
                                                echo ($artist_type[$artist_info_show->artist_type]);
                                            }
                                        }
                                    @endphp

                                    {{(!empty($artist_info_show->artist_type) &&
                                            $artist_info_show->artist_type==1) ?((!empty($artist_info_show->staff_id))?
                                    "-(".$artist_info_show->staff_id.")":''):'' }}
                                </td>
                            </tr>
                            <tr>
                                <td class=""> তালিকাভুক্ত কেন্দ্রে নাম</td>
                                <td>
                                    @if(!empty($artist_info_show->station_name ))
                                        {{ $artist_info_show->station_name }}
                                    @endif </td>

                            </tr>
                            <tr>
                                <td class=""> সর্বশেষ গ্রেড তালিকাভুক্তির তারিখ</td>
                                <td>{{ (empty($artist_info_show->enlisted_last_date) ||
                                $artist_info_show->enlisted_last_date=='0000-00-00' ||
                                $artist_info_show->enlisted_last_date=='1970-01-01') ?'':date('d-m-Y',strtotime
                                ($artist_info_show->enlisted_last_date)) }} </td>
                                <td class=" width20per">তালিকাভুক্তির তারিখ</td>
                                <td class="width30per">
                                    {{ (empty($artist_info_show->enlisted_date) ||
                                $artist_info_show->enlisted_date=='0000-00-00' ||
                                $artist_info_show->enlisted_date=='1970-01-01') ?'':date('d-m-Y',strtotime
                                ($artist_info_show->enlisted_date)) }}
                                </td>
                            </tr>

                            <tr>
                                <td class=""> শিল্পীর নাম (বাংলায়)</td>
                                <td> {{ !empty($artist_info_show->name_bn)?
                                $artist_info_show->name_bn:'' }}</td>
                                <td class="">শিল্পীর সংক্ষিপ্ত নাম</td>
                                <td>{{ $artist_info_show->artist_short_name }} </td>
                            </tr>

                            <tr>
                                <td class=""> শিল্পীর নাম (ইংরেজী)</td>
                                <td> {{ !empty($artist_info_show->name)?
                                $artist_info_show->name:'' }}</td>
                                <td class="">জাতীয় পুরষ্কার প্রাপ্ত</td>
                                <td>
                                    {{ !empty($artist_info_show->national_awarded_title) ?
                                    ($artist_info_show->national_awarded_title):'' }}

                                </td>
                            </tr>


                            <tr>
                                <td class=""> পিতার নাম</td>
                                <td>{{ !empty($artist_info_show->father_name)?
                                $artist_info_show->father_name:'' }} </td>
                                <td class="">পেশা</td>
                                <td> {{ !empty( $artist_info_show->artist_occupation)
                                          ?trim($artist_info_show->artist_occupation):'' }}</td>
                            </tr>
                            <tr>
                                <td class=""> মাতার নাম</td>
                                <td>{{ !empty( $artist_info_show->
                                mother_name)? $artist_info_show->
                                mother_name:'' }} </td>
                                <td class="">জাতীয়তা</td>
                                <td>
                                    {{ !empty($artist_info_show->nationality_title) &&
                                    ($artist_info_show->nationality_title ==!'') ?
                                    $artist_info_show->nationality_title: '' }}
                                </td>
                            </tr>
                        </table>
                        <button type="button"  data-toggle="modal" data-target="#add_promanok_file"
                                class="btn btn-success btn-sm" style="float:right;margin-top:5px;margin-right:5px;
                                margin-bottom:10px;"><i
                                    class="glyphicon glyphicon-plus"></i> Add File
                        </button>
                        <div class="clearfix"></div>
                        <table id="dt_basic" class="table table-bordered">
                            <thead>

                            <tr>
                                <th class="width30per">প্রমানক ফাইলের বর্ণনা</th>
                                <th class="width30per">প্রমানক ফাইল</th>
                                <th  class="width10per">#</th>
                            </tr>
                            </thead>
                            <?php
                            $all_promanok_file=(!empty($artist_info_show->promanok_file))?json_decode
                            ($artist_info_show->promanok_file,true):NULL;
                                if(!empty($all_promanok_file)){
                                    foreach ($all_promanok_file as $file){

                            ?>
                            <tbody id="promanok_file_info">
                                <td>{{ (!empty($file['file_tile']))?$file['file_tile']:''  }}</td>
                                <td><a target="_blank" href="{{ (!empty($file['file_info']))?asset
                                ("fontView/assets/artist_promanok/"
                                .$file['file_info']):''}}" ><i class="glyphicon glyphicon-link"></i> View
                                        Attachment</a></td>
                            <td>
                                <button type="button"  data-toggle="modal" data-target="#add_promanok_file"
                                        class="btn btn-info btn-sm" ><i
                                            class="glyphicon glyphicon-pencil"></i> Update
                                </button>
                                <button type="button"
                                        class="btn btn-danger btn-sm" ><i
                                            class="glyphicon glyphicon-trash"></i> Drop
                                </button>

                            </td>
                            </tbody>
                            <?php } }?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <div id="add_promanok_file" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">প্রমানক ফাইল</h4>
                </div>
                {!! Form::open(['url' => '', 'method' => 'post','id' => 'save_artist_attachment_form',
                               'class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-4 control-label">ফাইল</label>
                        <div class="col-md-8">
                            <input type="file" name="promanok_file"
                                   class="form-control" id="promanok_file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">প্রমানক ফাইল বর্ণনা</label>
                        <div class="col-md-8">
                            <input type="text" name="promanok_file_title" placeholder="প্রমানক ফাইল বর্ণনা"
                                   class="form-control" id="promanok_file_title">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-md-8">
                        <div id="form_output_artist_info"></div>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" name="artist_id" value="{{ Request::segment(2) }}">
                        <button type="submit" class="btn btn-success" ><i
                                    class="glyphicon glyphicon-save"></i> Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection

