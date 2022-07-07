@extends("master_program")
@section('title_area')
    :: শিল্পীর সম্মানীর চার্ট  ::
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
                <h2> শিল্পীর সম্মানীর চার্ট</h2>
                <button type="button" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-print"></i>
                    Print
                </button>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table  class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:5%;">অনুচ্ছেদ নং</th>
                                    <th colspan="2"> অনুষ্ঠানের বিবরন </th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $i=0;
                                //echo "<pre/>";
                                //print_r($program_ctg);
                            ?>
                            @if(!empty($program_ctg))
                                @foreach($program_ctg as $ctg)
                                   <tr>
                                       <th>{{ $ctg->display_position }}</th>
                                       <th colspan="2">{{ $ctg->title  }}</th>
                                   </tr>
                                    @php
                                        $j=1;
                                        $chart_details = get_artist_rate_chart_details( $ctg->id );

                                    @endphp
                                   @if(count($chart_details)>0)
                                     @foreach ($chart_details as $sub_ctg_info)
                                    <tr>
                                        <td>{{ $ctg->display_position }}.{{ $sub_ctg_info->display_position }}</td>
                                        <td class="width30per">{{ $sub_ctg_info->title }}</td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="width10per">শ্রেণী</th>
                                                    <th class="width40per">অনুষ্ঠানের স্থিতি</th>
                                                    <th class="width20per">সম্মানীর হার</th>
                                                    <th class="width15per">মহডা ফি</th>
                                                    <th class="width20per">সবোচ্চ সদসস্য</th>
                                                    <th class="width10per">পজিশন</th>
                                                </tr>
                                                @php
                                                    $j=1;
                                                    $sub_chart_details = get_artist_rate_chart_info(
                                                    $sub_ctg_info->id );
                                                @endphp
                                                @if(count($sub_chart_details)>0)
                                                    @foreach ($sub_chart_details as $chart_detaisl)
                                                    <tr>
                                                        <td>{{ $chart_detaisl->grade_title }}</td>
                                                        <td>{{ $chart_detaisl->stability }}</td>
                                                        <td>{{ $chart_detaisl->amount }}</td>
                                                        <td>{{ ($chart_detaisl->mohoda_fee==2 || $chart_detaisl->mohoda_fee=='2.00')?"না":"হ্যাঁ" }}</td>
                                                        <td>{{ $chart_detaisl->maximum_artist }}</td>
                                                        <td>{{ $chart_detaisl->display_position }}</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" style="text-align:center;">কোন তথ্য পাওয়া যায়
                                                            নাই</td>
                                                    </tr>
                                                @endif

                                            </table>
                                        </td>
                                    </tr>
                                     @endforeach
                                     @else
                                       <tr>
                                           <td colspan="3"  style="text-align: center">কোন ক্যাটাগরি এন্টি নেই</td>
                                       </tr>
                                   @endif


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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span>  </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                {!! Form::open(['url' => '', 'id' => 'artist_rate_chart_setup_form','method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body ">
                    <div class="col-sm-12" style="margin-top:10px;">

                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">তালিকাভুক্ত গানের ধরন </label>
                            <div class="col-md-9">
                                <select required name="artist_song_ctg" id="artist_song_ctg" class="form-control">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($artist_song_ctg))
                                        @foreach ($artist_song_ctg as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">অনুষ্ঠানের বিবরন</label>
                            <div class="col-md-9">
                                <textarea  id="description" class="form-control" placeholder="অনুষ্ঠানের বিবরন"  name="description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">গ্রেড </label>
                            <div class="col-md-9">
                                <select required name="artist_song_grade" id="artist_song_grade" class="form-control">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($artist_grade_info))
                                        @foreach ($artist_grade_info as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">অনুষ্ঠানের স্থিতি</label>
                            <div class="col-md-9">
                                <input type="text"  id="stability" class="form-control" placeholder="স্থিতি"  value="" name="stability"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">সম্মানীর পরিমান</label>
                            <div class="col-md-9">
                                <input type="text"  id="amount" class="form-control onlyNumber" placeholder="সম্মানীর পরিমান"  value="" name="amount"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">স্ট্যাটাস</label>
                            <div class="col-md-9">
                                <select  id="is_active" class="form-control" required  name="is_active">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6 text-left">
                        <div id="form_output"></div>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" onclick="saveArtistRateChart()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                        <button type="button" onclick="saveArtistRateChart()" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                        <input type="hidden" name="chart_id" id="chart_id">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

