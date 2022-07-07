
<div class="modal-body">
    <div class="col-sm-12">
        <?php
        $travel_info = (!empty($employee_general_info->deptamental_action)) ? json_decode
        ($employee_general_info->deptamental_action, true) : NULL;
        ?>

        <div class="col-sm-12">
            <table class="table table-bordered width100per">
                <thead>
                <tr>
                    <th colspan="7" class="width100per" >

                        Departmental Information
                        <div class="text-right" style="margin-top:-20px">

                            <button type="button"data-toggle="modal" onclick="AddDepartmentalActionInfo()"
                                    data-target="#add_departmental_action_info" class="btn btn-primary btn-xs"
                                    style="float:right;
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
                        <tr>
                            <td>  {{ (!empty ($travel['type']))?$travel['type']:'' }} </td>
                            <td>  {{ (!empty ($travel['from_date']))?$travel['from_date']:'' }} </td>
                            <td>  {{ (!empty ($travel['to_date']))?$travel['to_date']:'' }} </td>
                            <td>  {{ (!empty ($travel['go_no']))?$travel['go_no']:'' }} </td>
                            <td>  {{ (!empty ($travel['country']))?$travel['country']:'' }} </td>
                            <td>  {{ (!empty ($travel['purpose']))?$travel['purpose']:'' }} </td>


                            <td><a href="javascript:void(0);"  id="deleteRow_{{ $kl }}"  class="deleteRow btn btn-warning
                             btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> Drop</a></td>

                        </tr>
                        @php($kl++)
                    @endforeach
                @endif
            </table>

        </div>

    </div>
    <div class="clearfix"></div>
</div>


<div class="modal fade" id="add_departmental_action_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-8">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title-departmatnal-action"></span> New  </h5>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>

            {!! Form::open(['url' => '/save_travel_info_form', 'id' => 'departmental_action_info_form','method' =>
            'post',
            'class'=>'form-horizontal']) !!}
            <div class="modal-body ">
                <div class="col-sm-12" style="margin-top:10px;">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Type</label>
                        <div class="col-md-10">
                            <select id="action_type" class="form-control"  name="type">
                                <option value="">Select Type</option>
                                <option value="1">চলমান</option>
                                <option value="2">নিস্পত্তিকৃত</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">মামলা নং</label>
                        <div class="col-md-10">
                            <input type="text"  id="departmantal_action_no" class="form-control " placeholder="মামলা নং"
                                   required
                                   name="departmantal_action_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">তারিখ</label>
                        <div class="col-md-10">
                            <input type="text"  id="mamla_date" class="form-control datepicker" required
                                   placeholder="মামলা তারিখ"
                                   name="mamla_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">বর্তমান অবস্থা</label>
                        <div class="col-md-10">
                            <textarea  id="present_condtion" class="form-control" placeholder="বর্তমান অবস্থা"
                                       name="present_condtion"></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">শাস্তির ধরন</label>
                        <div class="col-md-10">
                            <select id="punishment_type" class="form-control"  name="punishment_type">
                                <option value="">Select Type</option>
                                <option value="1">অর্বহতি প্রাপ্ত</option>
                                <option value="2">দন্ডপ্রাপ্ত</option>
                            </select>
                        </div>
                    </div>
                    <div id="dondo_paptho_info" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-2 control-label">শাস্তির তথ্য (কি দন্ড)</label>
                            <div class="col-md-10">
                                <input type="text"  id="punishment_name" class="form-control"  placeholder="শাস্তির তথ্য (কি দন্ড)"  required  name="punishment_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">বর্ননা</label>
                            <div class="col-md-10">
                                <textarea  id="purpose" class="form-control" placeholder="বর্ননা"  name="purpose"></textarea>
                            </div>
                        </div>
                    </div>







                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-6 text-left">
                    <span class="text-left" id="form_output_departmanatl_action_info"></span>
                </div>
                <div class="col-sm-6">
                    <button type="button" onclick="saveSetupInfo()" id="saveBtnDepartmentalAction" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                    <button type="button" onclick="saveSetupInfo()" id="updateBtnDepartmentalAction" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                    <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                    <input type="hidden" name="employee_id" value="{{ $employe_info->employee_id }}">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

