@extends("master_program")
@section('title_area')
    :: Program Archieve History  ::

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
                <h2>Program Archieve History</h2>

                <button type="button" data-toggle="modal" onclick="AddProgramApplication()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> Program Title</th>
                                <th> Program Category</th>
                                <th> Schedule Date</th>
                                <th> Remark</th>
                                <th> Status</th>
                                <th style="width: 80px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            @if(!empty($program_info))
                                @foreach($program_info as $singleData)
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td>  {{ $singleData->title  }}</td>
                                        <td>  {{ $singleData->program_ctg  }}</td>
                                        <td>  {{ date('d-m-Y h:i:s a',strtotime($singleData->schedule_date_time))  }}</td>
                                        <td>  {{ $singleData->remarks  }}</td>
                                        <td>  {{ $singleData->status_show  }}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#exampleModal"
                                                    onclick="updateProgramApplication('{{ $singleData->id }}')"
                                                    class="btn btn-info btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                        <!--
                                        {{--<a href="{{ url('view_leave_application/'.$singleData->id."/view") }}"--}}
                                               {{--class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-share-alt"></i>--}}
                                            {{--</a>--}}
                                         {{--<buttton onclick="deleteConfirm('{{ $singleData->id  }}')"--}}
                                        {{--class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>--}}
                                        {{--</buttton>--}}-->
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

    <script>

    </script>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span> Program Archieve History</h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '/save_product_info', 'method' => 'post','id' => 'addProgramApp','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Program Title</label>
                            <div class="col-md-4">
                                <input type="text" id="program_title" class="form-control" required name="program_title" placeholder="Enter Program Title">


                            </div>
                            <label class="col-md-2 control-label">Program Category </label>
                            <div class="col-md-4">
                                <select required name="program_ctg" id="program_ctg" placeholder="Select Program Category " multiple class="select2">
                                    @if(!empty($program_ctg))
                                        @foreach ($program_ctg as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif

                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Internal Artist</label>
                            <div class="col-md-10">
                                <select id="internal_artist" class="select2" placeholder="Select Internal Artist" multiple required  name="internal_artist">
                                    @if(!empty($employee_info))
                                        @foreach($employee_info as $key=>$value)
                                            <option value="{{ $key }}" >{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">External Artist</label>
                            <div class="col-md-10">
                                <select id="external_artist" class="select2" placeholder="Select External Artist" multiple required
                                        name="external_artist">
                                    @if(!empty($employee_info))
                                        @foreach($employee_info as $key=>$value)
                                            <option value="{{ $key }}" >{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Record Date</label>
                            <div class="col-md-4">
                                <input type="text" name="record_date" placeholder="Record Date" class="form-control datepickerinfo" id="record_date">
                            </div>
                            <label class="col-md-2 control-label">Time</label>
                            <div class="col-md-4">

                                <div class='input-group' >
                                    <input type='text' class="form-control timepicker" value="{{ date('h:i a') }}" />
                                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Remarks</label>
                            <div class="col-md-10">
                                <textarea name="remarks" placeholder="Remarks" class="form-control" id="remarks"></textarea>
                            </div>
                        </div>

                        <div class="form-group" id="show_status">
                            <label class="col-md-2 control-label">Status</label>
                            <div class="col-md-4">
                                <select id="status_id" class="form-control" required
                                        name="status_id">
                                    <option value="">Select</option>
                                    @if(!empty($leave_status))
                                        @foreach($leave_status as $key=>$value)
                                            <option value="{{ $key }}" >{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
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
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

