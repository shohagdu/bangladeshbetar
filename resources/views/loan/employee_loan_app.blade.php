@extends("master_hr")
@section('title_area')
    :: Loan Application  ::

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
                <h2>Loan Application </h2>

                <button type="button" data-toggle="modal" onclick="AddLoanApplication()" data-target="#exampleModal"
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
                                <th> Employee Id</th>
                                <th> Name</th>
                                <th> Type</th>
                                <th> Reason</th>
                                <th> Days</th>
                                <th> Status</th>
                                <th style="width: 80px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            @if(!empty($data_list))
                                @foreach($data_list as $singleData)
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td>  {{ $singleData->title  }}</td>
                                        <td>  {{ $singleData->unit_title  }}</td>
                                        <td>  {{ ($singleData->is_show==1)?"Show Sales":"Not Show"  }}</td>
                                        <td>  {{ $singleData->sorting }}</td>
                                        <td>  {{ ($singleData->is_active==1)?"Active":"Inactive"  }}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#exampleModal"
                                                    onclick="updateData('{{ $singleData->id }}','{{ $singleData->title }}','{{ $singleData->product_unit }}','{{ $singleData->is_show }}','{{ $singleData->is_active }}','{{ $singleData->sorting }}')"
                                                    class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                            <buttton onclick="deleteConfirm('{{ $singleData->id  }}')"
                                                     class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>
                                            </buttton>
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
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span> </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '/save_product_info', 'method' => 'post','id' => 'addLoanApp','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Employee ID</label>
                            <div class="col-md-4">
                                <input type="text" id="employee_id" class="form-control" placeholder="Search Employee Id" required
                                       value="" name="name"/>

                            </div>
                            <label class="col-md-2 control-label">Apply Date</label>
                            <div class="col-md-4">
                                <input type="text" name="loan_apply_date" placeholder="Apply Date" class="form-control datepickerinfo" id="loan_apply_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Loan Amount </label>
                            <div class="col-md-4">
                                <input type="text" id="loan_amount" class="form-control" placeholder="Loan Amount" required  name="loan_amount"/>
                            </div>
                            <label class="col-md-2 control-label">Total Installment</label>
                            <div class="col-md-4">
                                <input type="text" id="total_installment" class="form-control" placeholder="Total Installment" required name="total_installment"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Per Installment Amount</label>
                            <div class="col-md-4">
                                <input type="text" id="per_installment_amount" class="form-control" placeholder="Per Installment Amount" required  value="" name="per_installment_amount"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Details</label>
                            <div class="col-md-10">
                                <textarea name="loan_details" placeholder="Details" class="form-control " id="loan_details"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Comments</label>
                            <div class="col-md-8">
                                <textarea name="leave_comments" placeholder="Comments" class="form-control " id="leave_comments"></textarea>
                            </div>
                            <label class="col-md-2 control-label"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Comments</button> </label>
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

