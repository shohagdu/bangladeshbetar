@extends("master_program")
@section('title_area')
    :: Add ::  log Writer  ::

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

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>লগ রাইটারের তথ্য সমুহ</h2>

                <button type="button" data-toggle="modal" onclick="AddProgramArtist()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
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
                                <th> অনুষ্ঠানের নাম</th>
                                <th> তারিখ</th>
                                <th> ধরন</th>
                                <th>প্রচার সময়</th>
                                <th>রেকডিং সময়</th>
                                <th>রেকডিং তারিখ</th>
                                <th style="width: 80px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            @if(!empty($program_artist_info))
                                @foreach($program_artist_info as $singleData)
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td>  {{ $singleData->name  }}</td>
                                        <td>  {{ $singleData->mobile  }}</td>
                                        <td>  {{ $singleData->national_id  }}</td>
                                        <td>
                                            @if($singleData->artist_grade==1))
                                            ক
                                            @elseif($singleData->artist_grade==2)
                                                খ
                                            @else
                                                গ
                                            @endif
                                        </td>
                                        <td>  {{ date('d-m-Y',strtotime($singleData->enlisted_date))  }}</td>
                                        <td>  {{ $singleData->address  }}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#exampleModal"
                                                    onclick="updateProgramArtist('{{ $singleData->id }}')"
                                                    class="btn btn-info btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span> উপস্থাপনা তথ্য
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '', 'method' => 'post','id' => 'save_artist_info_form','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">
                        <div class="form-group">

                            <label class="col-md-1 control-label">মাস</label>
                            <div class="col-md-2">
                                <input type="text" name="entry_date" placeholder="মাস"
                                       class="form-control datepickerinfo" id="entry_date">
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2">উপস্থাপনা বিবরন</th>
                                </tr>
                                <tr>
                                    <th style="width:10%;">তারিখ</th>
                                    <th style="width:5%;">বার</th>
                                    <th style="width:15%;">প্রথম অধিবেশন(৬.০০-১২.০০)</th>
                                    <th style="width:15%;">দি্বতীয় অধিবেশন(১২.০০-৬.০০)</th>
                                    <th style="width:15%;">তৃতীয় অধিবেশন(৬.০০-১২.০০)</th>
                                    <th style="width:5%;">#</th>
                                </tr>
                                <tr>
                                    <td><input type="text" placeholder="তারিখ" id="program_title_1" name="program_title[]" class="form-control"> </td>
                                    <td><input type="text" placeholder="বার" id="program_title_1" name="program_title[]" class="form-control"> </td>
                                    <td><input type="text" placeholder="শিল্পীর নাম" name="artist_name_1" name="artist_name[]" class="form-control"> </td>
                                    <td><input type="text" placeholder="শিল্পীর নাম" name="artist_name_1" name="artist_name[]" class="form-control"> </td>
                                    <td><input type="text" placeholder="শিল্পীর নাম" name="artist_name_1" name="artist_name[]" class="form-control"> </td>
                                    <td><button type="button" id="artist_name_1" name="artist_name[]" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-remove"></i> </button></td>
                                </tr>
                                <tr>
                                    <td><button type="button" id="add_info" name="add_info" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-plus"></i> Add </button></td>

                                </tr>



                            </table>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="form_output"></span>
                    </div>
                    <div class=" col-sm-5">
                        <button type="button" onclick="saveArtistInfo()" id="saveBtn" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i>
                            Save
                        </button>
                        <button type="submit" id="updateBtn" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i> Update
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" name="setting_id" id="setting_id">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
    </div>



@endsection

