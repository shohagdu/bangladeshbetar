@extends("master_program")
@section('title_area')
:: সময়সূচী সেটিংস ::
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
    <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
            <h2> অনুষ্ঠান সূচি সেটিংস</h2>

            <a href="master_day_program_time_table">
                <button type="button" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Program Schedule
                </button>
            </a>

        </header>
        <div>
            <div class="widget-body no-padding">
                {!! Form::open(['url' => '', 'id' => 'program_time_table_setup_form','method' => 'post','class'=>'form-horizontal']) !!}
                <div class="col-sm-12" style="margin-top:10px;margin-bottom:80px;">

                    <div class="form-group">
                        <label class="col-md-2 control-label">কেন্দ্র/ইউনিটের নাম </label>
                        <div class="col-md-4">
                            <select id="station_id" required class="form-control" onchange="getSubStation(this.value)" name="station_id">
                                <option value="">চিহ্নিত করুন</option>
                                @if(!empty($station_info))
                                @foreach($station_info as $key=>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">মুল ফ্রিকোয়েন্সি</label>
                        <div class="col-md-4">
                            <select id="sub_station_id" required class="form-control" name="sub_station_id">
                                <option value="">চিহ্নিত করুন</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">অনুরুপ ফ্রিকোয়েন্সি</label>
                        <div class="col-md-4">
                            <select id="onurup_ids" placeholder="অনুরুপ" multiple required class="select2" name="onurup_ids[]">

                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-2 control-label">নিদিষ্ট অনুষ্ঠান সূচি</label>
                        <div class="col-md-4">
                            <select id="fixed_onusan_suchy" class="form-control" required name="fixed_onustan_suchy">
                                <option value="">চিহ্নিত করুন</option>
                                <option value="1">গ্রীষ্মকালীন(১লা এপ্রিল-৩০শে সেপ্টেম্বর)</option>
                                <option value="2">শীতকালীন(১রা অক্টোবর-৩১শে মার্চ)</option>
                            </select>
                        </div>

                        <label class="col-md-2 control-label">ত্রৈমিাসিক পরিকল্পনা </label>
                        <div class="col-md-2">
                            <select id="torimasik_porikolpona" class="form-control" name="torimasik_porikolpona">
                                <option value="">চিহ্নিত করুন</option>
                                <option value="1">১ম: (বৈশাখ-আযাঢ়) </option>
                                <option value="2">২য়: (শ্রাবণ-আশ্বিন)</option>
                                <option value="3">৩য়: (কার্তিক-পৌষ)</option>
                                <option value="4">৪র্থ: (মাঘ-চৈত্র)</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="bangla_son" value="১৪২৬" class="form-control" readonly="">
                        </div>


                    </div>

                    <table class="table-bordered table">

                        <thead>

                            <tr>
                                <td>বার</td>
                                <td style="width:8%">সপ্তাহ</td>
                                <td style="width:8%">সময়</td>


                                <td>চাংক</td>
                                <td>অনুষ্ঠানের বিষয়/বিবরন</td>
                                <td>বিষয়বস্তু</td>
                                <td style="width:8%">স্থিতি</td>
                                <td style="width:12%">মন্তব্য</td>
                                <td style="width:5%">রেকর্ড</td>
                                <td style="width:7%">ক্রমিক</td>

                                <td style="width:5%">#</td>
                            </tr>
                        </thead>

                        <tbody id="dynamicJobHistorytr">

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="11">
                                    <button type="button" onclick="addRow()" class="btn btn-primary btn-sm program_time"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="11">
                                    <div id="form_output"></div>
                                    <textarea style="visibility:hidden;" name="schedule" id="schedule"></textarea>
                                    <div class="clearfix"></div>
                                    <button style="margin-left:400px;" type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</article>

@endsection