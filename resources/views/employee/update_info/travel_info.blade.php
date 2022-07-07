
<div class="modal-body">
    <div class="col-sm-12">
        <?php
        $travel_info = (!empty($employee_general_info->travel_info)) ? json_decode
        ($employee_general_info->travel_info, true) : NULL;

        ?>

        <div class="col-sm-12">
            <table class="table table-bordered width100per">
                <thead>
                <tr>
                    <th colspan="7" class="width100per" >

                            Travel Information
                        <div class="text-right" style="margin-top:-20px">

                            <button type="button"data-toggle="modal" onclick="AddTravelInfo()"
                                    data-target="#add_travel_info" class="btn btn-primary btn-xs" style="float:right;
                                    margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-plus"></i>
                                Add New
                            </button>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th class="width10per">Type</th>
                    <th  class="width10per">From Date</th>
                    <th  class="width10per">To Date</th>
                    <th  class="width10per">GO No</th>
                    <th  class="width10per">Country</th>
                    <th  class="width20per">Purpose</th>
                    <th class="width10per">Action</th>
                </tr>

                </thead>
                @if(!empty($travel_info))
                    @php($kl=1)
                    @foreach($travel_info as $travel)
                        @if($travel['is_active']==1)
                            <tr>
                                <td>  {{ (!empty ($travel['type']))?(($travel['type']==1)?"Local Travel":"Foreign Travel"):'' }}
                                </td>
                                <td>  {{ (!empty ($travel['from_date']))?$travel['from_date']:'' }} </td>
                                <td>  {{ (!empty ($travel['to_date']))?$travel['to_date']:'' }} </td>
                                <td>  {{ (!empty ($travel['go_no']))?$travel['go_no']:'' }} </td>
                                <td>  {{ (!empty ($travel['country']))?$travel['country']:'' }} </td>
                                <td>  {{ (!empty ($travel['purpose']))?$travel['purpose']:'' }} </td>


                                <td><button id="deleteRow_{{ $kl }}" onclick="deleteEmployeeTravel('{{ $travel['id']
                                }}','{{ $employe_info->employee_id }}')"
                                            class="deleteRow
                                btn btn-warning
                                 btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> Drop</button></td>

                            </tr>
                        @endif
                        @php($kl++)
                    @endforeach
                @endif
            </table>

        </div>

    </div>
    <div class="clearfix"></div>
</div>


<div class="modal fade" id="add_travel_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-8">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span> New Travel
                        Information </h5>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>

            {!! Form::open(['url' => '/save_travel_info_form', 'id' => 'employee_travel_form','method' => 'post',
            'class'=>'form-horizontal']) !!}
            <div class="modal-body ">
                <div class="col-sm-12" style="margin-top:10px;">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Type</label>
                        <div class="col-md-10">
                            <select id="type" class="form-control"  name="type">
                                    <option value="">Select Type</option>
                                    <option value="1">Local Travel</option>
                                    <option value="2">Foreign Travel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">From Date</label>
                        <div class="col-md-10">
                            <input type="text"  id="from_date" class="form-control datepicker" placeholder="Enter From Date"   required  name="from_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">To Date</label>
                        <div class="col-md-10">
                            <input type="text"  id="to_date" class="form-control datepicker" required placeholder="Enter To Date"
                                   name="to_date">
                        </div>
                    </div>
                    <div id="foreign_travel" style="display: none;">
                         <div class="form-group">
                            <label class="col-md-2 control-label">GO No</label>
                            <div class="col-md-10">
                                <input type="text"  id="go_no" class="form-control"  placeholder="Enter GO No"  required
                                       name="go_no">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Country</label>
                            <div class="col-md-10">
                                <select  id="country_id" class="form-control"   name="country">
                                    <option value="">Select</option>
                                    @if(!empty($nationality))
                                        @foreach($nationality as $key=>$value)
                                            <option value="{{ $key }}" >{{ $value }}</option>  @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Purpose</label>
                        <div class="col-md-10">
                            <textarea  id="purpose" class="form-control" placeholder="Enter Purpose"  name="purpose"></textarea>

                        </div>
                    </div>






                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-6 text-left">
                    <span class="text-left" id="form_output_travel_info"></span>
                </div>
                <div class="col-sm-6">
                    <button type="button" onclick="saveTravelInfo()" id="saveBtnTravel" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                    <button type="button" onclick="updateTravelInfo()" id="updateBtnTravel" class="btn btn-success"><i
                                class="glyphicon glyphicon-save"></i> Update</button>
                    <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                    <input type="hidden" name="employee_id" value="{{ $employe_info->employee_id }}">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

