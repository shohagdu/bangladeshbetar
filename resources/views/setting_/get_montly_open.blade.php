@extends("master_hr")
@section('title_area')
    ::  Months Setup  ::

@endsection
@section('show_message')
    {{ Session::get('message') }}
@endsection
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> Months Setup </h2>

                <button type="button"data-toggle="modal" onclick="addData()" data-target="#exampleModal" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {{--<div class="col-sm-offset-10 col-sm-2">--}}
                            {{--<div class="row">--}}
                                {{--<div class="form-group">--}}
                                    {{--<select type="text"  id="fiscal_year_search" class="form-control" name="fiscal_year_search">--}}
                                        {{--<option value="">Select</option>--}}
                                        {{--@if($get_fiscal_year)--}}
                                            {{--@foreach($get_fiscal_year as $key=>$value)--}}
                                                {{--<option value="{{ $key }}">{{ $value }}</option>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> Fiscal Year</th>
                                <th> Months Name</th>
                                <th> Start Date</th>
                                <th> End Date</th>
                                <th> Modify Last Date</th>
                                <th> Status </th>
                                <th> Sorting</th>
                                <th style="width: 10%"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i=1;
                            ?>
                            @foreach($monthly_data as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>

                                    <td>  {{ $singleData->fiscal_year_title  }}</td>
                                    <td>  {{ $singleData->title  }}</td>
                                    <td>  {{ date('d-m-Y',strtotime($singleData->start_date))  }}</td>
                                    <td>  {{ date('d-m-Y',strtotime($singleData->end_date))  }}</td>
                                    <td>  {{ date('d-m-Y',strtotime($singleData->modify_last_date))  }}</td>
                                    <td>  {{ ($singleData->status==1)?"Running":(($singleData->status==2)?"Previous":"Next")  }}</td>
                                    <td>  {{ $singleData->sorting  }}</td>
                                    <td>
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick='updateData("{{ $singleData->id }}","{{ $singleData->title }}","{{ date('d-m-Y',strtotime($singleData->start_date)) }}","{{ date('d-m-Y',strtotime($singleData->end_date)) }}","{{ date('d-m-Y',strtotime($singleData->modify_last_date)) }}","{{ $singleData->status }}","{{ $singleData->sorting }}","{{ $singleData->fiscal_year_id }}" )' class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        <a href="{{ url('/delete_montly_open/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                          <!--  {{--<tfoot>--}}
                            {{--<tr>--}}
                                {{--<td colspan="6" style="padding-top:0px !important;padding-bottom:0px !important;border-right:1px solid #fff;">--}}
                                    {{--{{ $monthly_data->links() }}--}}
                                {{--</td>--}}
                                {{--<td colspan="2" style="text-align:right;">--}}
                                    {{--Showing {{ $monthly_data->firstItem() }}- {{ $monthly_data->lastItem() }} from {{ $monthly_data->total() }} Item--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--</tfoot>--}}-->
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <script>

        function addData() {
            $("#monthly_opning")[0].reset();
            $("#title").val('');
            $("#start_date").val('');
            $("#end_date").val('');
            $("#changeLastDate").val('');
            $("#status_log").val('');
            $("#position").val('');
            $("#setting_id").val('');
            $("#updateBtn").hide();
            $("#saveBtn").show();
        }
        function updateData(id,title,start_date,end_date,last_modification,status_log,position,fiscal_year) {
            $("#monthly_opning")[0].reset();
            $("#fiscal_year").val(fiscal_year);
            $("#title").val(title);
            $("#start_date").val(start_date);
            $("#end_date").val(end_date);
            $("#changeLastDate").val(last_modification);
            $("#status_log").val(status_log);
            $("#position").val(position);
            $("#setting_id").val(id);


            $("#updateBtn").show();
            $("#saveBtn").hide();
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                          <h5 class="modal-title" id="exampleModalLabel">Months Entry </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                {!! Form::open(['url' => '/save_montly_open', 'id'=>'monthly_opning', 'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">


                        <div class="form-group">
                            <label class="col-md-4 control-label"> Fiscal Year</label>
                            <div class="col-md-8">
                                <select type="text"  id="fiscal_year" class="form-control"  required  name="fiscal_year">
                                    <option value="">Select</option>
                                    @if($get_fiscal_year)
                                        @foreach($get_fiscal_year as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"> Months Name</label>
                            <div class="col-md-8">
                                <input type="text"  id="title" class="form-control" placeholder="Months Name" required value="" name="title"/>

                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-md-4 control-label">Start Date
                            </label>
                            <div class="col-md-8">
                                <input type="text"  id="start_date" class="form-control datepickerLong" placeholder="Start Date" readonly required value="" name="start_date"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">End Date
                            </label>
                            <div class="col-md-8">
                                <input type="text"  id="end_date" class="form-control datepickerLong" placeholder="End Date" readonly required value="" name="end_date"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Modify Last Date
                            </label>
                            <div class="col-md-8">
                                <input type="text"  id="changeLastDate" class="form-control datepickerLong" placeholder="Modify Last Date" readonly required value="" name="changeLastDate"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"> Status</label>
                            <div class="col-md-8">
                                <select  id="status_log" class="form-control" required name="status">
                                    <option value="">Select</option>
                                    <option value="1">Running</option>
                                    <option value="2">Previous</option>
                                    <option value="3">Next</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sorting </label>
                            <div class="col-md-8">
                                <input type="text"  id="position" class="form-control" placeholder="পজিশন(Sorting)" required value="" name="position"/>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">

                    <button type="submit" name="saveBtn" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save </button>
                    <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Close</button>
                    <input type="hidden" name="setting_id" id="setting_id">

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

