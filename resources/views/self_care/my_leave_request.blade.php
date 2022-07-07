@extends("master")
@section('title_area')
    :: My Leave Record ::

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
                <h2>My Leave Record </h2>
                <button type="button" data-toggle="modal" onclick="AddLeaveApplication()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </button>
            </header>


            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> Employee Id</th>
                                <th> Name</th>
                                <th> Type</th>
                                <th> From DT</th>
                                <th> To DT</th>
                                <th> Reason</th>
                                <th> Status</th>
                                <th style="width: 80px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            @if(!empty($employee_leave_info))
                                @foreach($employee_leave_info as $singleData)
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td>  {{ $singleData->employee_id  }}</td>
                                        <td>  {{ $singleData->emp_name  }}</td>
                                        <td>  {{ $singleData->leave_type  }}</td>
                                        <td>  {{ date('d-m-Y',strtotime($singleData->from_date))  }}</td>
                                        <td>  {{ date('d-m-Y',strtotime($singleData->to_date))  }}</td>
                                        <td>  {{ $singleData->leave_reason  }}</td>
                                        <td>  {{ $singleData->status  }}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#exampleModal"
                                                    onclick="updateLeaveApplication('{{ $singleData->id }}')"
                                                    class="btn btn-info btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                            <a href="{{ url('view_leave_application/'.$singleData->id."/view") }}"
                                               class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-share-alt"></i>
                                            </a>
                                        <!--  {{--<buttton onclick="deleteConfirm('{{ $singleData->id  }}')"--}}
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span> Leave Application</h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '/save_product_info', 'method' => 'post','id' => 'addLeaveApp','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">

                            <label class="col-md-2 control-label">Leave Type </label>
                            <div class="col-md-4">
                                <select required name="leave_type" id="leave_type" class="form-control">
                                    <option value="">Select</option>
                                    @if(!empty($leave_type))
                                        @foreach ($leave_type as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif

                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">From Date</label>
                            <div class="col-md-4">
                                <input type="text" name="leave_from" placeholder="From Date" class="form-control datepickerinfo" id="leave_from">
                            </div>
                            <label class="col-md-2 control-label">To Date</label>
                            <div class="col-md-4">
                                <input type="text" name="leave_to" placeholder="To Date" class="form-control datepickerinfo" id="leave_to">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Reason of Leave</label>
                            <div class="col-md-10">
                                <textarea name="leave_reason" placeholder="Reason of Leave" class="form-control " id="leave_reason"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Hard Copy(Application)</label>
                            <div class="col-md-4">
                                <input type="file" name="application_hard_copy" class="form-control" id="application_hard_copy">
                            </div>
                            <label class="col-md-2 control-label">Medical Certificate</label>
                            <div class="col-md-4">
                                <input type="file" name="medical_certificate" class="form-control" id="medical_certificate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Comments</label>
                            <div class="col-md-8">
                                <textarea name="leave_comments" placeholder="Comments" class="form-control " id="leave_comments"></textarea>
                            </div>
                            <label class="col-md-2 control-label"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Comments</button> </label>
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

