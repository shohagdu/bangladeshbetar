@extends("master_program")
@section('title_area')
    :: setting ::  Presentation  ::

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
                <h2>উপস্থাপনা সেটিংস সমুহ</h2>

                <a href="<?php  echo asset('/presentation_setting');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    List
                </a>

            </header>
            <div>

                <div class="widget-body no-padding">
                    {!! Form::open(['url' => '', 'method' => 'post','id' => 'save_presentation_settings_info_form','class'=>'form-horizontal']) !!}
                    <table class="table table-bordered table-striped table-hover" style="width:100%">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">কেন্দ্রের / ইউনিট নাম </label>
                                    <div class="col-md-3">
                                        <select id="station_id"  required class="form-control"  onchange="getSubStation(this.value)" name="station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                            @if(!empty($station_info))
                                                @foreach($station_info as $key=>$value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label"> ফ্রিকোয়েন্সি</label>
                                    <div class="col-md-3">
                                        <select id="sub_station_id" required class="form-control" name="sub_station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $day_name = show_day_info_bn();
                        $odivision = [
                            1, 2, 3, 4
                        ];
                        ?>
                        <tr>
                            <td>
                                <?php
                                foreach ($day_name as $day_id=>$day_name) {
                                $j = 0;
                                ?>
                                <div class="col-sm-12" style="padding-bottom:2px;background: #d0d0d0">
                                    <div class="col-sm-6" style="color:red;">
                                        বার: {{ $day_name }}
                                        <input type="hidden" name="day_name_id[]" id="day_name_id_{{$day_id}}"
                                               value="{{ $day_id }}">
                                    </div>
                                </div>
                                @foreach($odivision as $odivision_id)
                                    <table class="table table-bordered table-striped table-hover width100per" id="presentation_table">
                                        <tr>
                                            <th colspan="6">
                                                @if( $odivision_id ==1)
                                                    প্রথম অধিবেশন(৬.০০-১২.০০)
                                                @elseif( $odivision_id ==2)
                                                    দ্বিতীয় অধিবেশন(১২.০০-৬.০০)
                                                @elseif( $odivision_id ==3)
                                                    তৃতীয় অধিবেশন(৬.০০-১২.০০)
                                                @elseif( $odivision_id ==4)
                                                    ৪র্থ অধিবেশন(১২.০০-৬.০০)
                                                @endif
                                            </th>
                                        </tr>
                                        <tr>
                                            <td style="width: 20% !important;">
                                                <input type="hidden"
                                                       name="program_date[{{$day_id}}][{{$odivision_id}}][duty_officer]"
                                                       class="form-control">
                                                <select id="magazine_manage" placeholder="ডিউটি অফিসার" class="select2"
                                                        multiple required
                                                        name="program_date[{{$day_id}}][{{$odivision_id}}][duty_officer][]"
                                                        style="width:100% !important">
                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>

                                            <td style="width: 20% !important;">
                                                <input type="hidden"
                                                       name="program_date[{{$day_id}}][{{$odivision_id}}][announcer]"
                                                       class="form-control">
                                                <select id="magazine_manage" placeholder="ঘোষক" class="select2" multiple
                                                        required
                                                        name="program_date[{{$day_id}}][{{$odivision_id}}][announcer][]"
                                                        style="width:100% !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <input type="hidden"
                                                       name="program_date[{{$day_id}}][{{$odivision_id}}][log_writer]"
                                                       class="form-control">
                                                <select id="magazine_manage" placeholder="লগ রাইটার" class="select2"
                                                        multiple required
                                                        name="program_date[{{$day_id}}][{{$odivision_id}}][log_writer][]"
                                                        style="width:200px !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <input type="hidden"
                                                       name="program_date[{{$day_id}}][{{$odivision_id}}][officer_assistent]"
                                                       class="form-control">
                                                <select id="magazine_manage" placeholder="অফিস সহায়ক" class="select2"
                                                        multiple required
                                                        name="program_date[{{$day_id}}][{{$odivision_id}}][officer_assistent][]"
                                                        style="width:100% !important">
                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <input type="hidden"
                                                       name="program_date[{{$day_id}}][{{$odivision_id}}][officer_incharge]"
                                                       class="form-control">
                                                <select id="magazine_manage" placeholder="অফিসার ইনসার্স"
                                                        class="select2" multiple required
                                                        name="program_date[{{$day_id}}][{{$odivision_id}}][officer_incharge][]"
                                                        style="width:100% !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </td>


                                        </tr>
                                    </table>

                                @endforeach
                                <?php $j++;
                                }
                                ?>

                            </td>
                        </tr>
                        <tr>
                            <td id="form_output"></td>
                        </tr>
                        <tr>

                            <td style="text-align:right">
                                <button type="button" onclick="savePresentationSettingsInfo()" id="saveBtn"
                                        class="btn btn-success"><i
                                            class="glyphicon glyphicon-save"></i>
                                    Save
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="glyphicon glyphicon-remove"></i> Close
                                </button>
                            </td>

                        </tr>

                    </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-sm-12" style="margin-bottom:20px;"></div>
    </article>
    <!-- Modal -->
    <style>
        #presentation_table td {
            border: 1px solid #d0d0d0;
            font-size:12px;
        }
        #presentation_table th {
            border: 1px solid #d0d0d0;
            font-size:12px;
        }
    </style>
@endsection

