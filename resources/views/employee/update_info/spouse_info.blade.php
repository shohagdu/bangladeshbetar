{!! Form::open(['url' => '/save_employee_spouse_child_info', 'method' => 'post', 'id' => 'employee_spouse_child_form','class'=>'form-horizontal']) !!}
<div class="modal-body">
    <div class="col-sm-12">
        <?php
            $spouse_info = (!empty($employee_general_info->spouse_info)) ? json_decode($employee_general_info->spouse_info, true) : NULL;
            $child_info = (!empty($employee_general_info->children_info)) ? json_decode($employee_general_info->children_info, true) : NULL;
        ?>
        <div class="form-group">
            <label class="col-md-2 control-label">Spouse Name</label>
            <div class="col-md-4">
                <input type="text" id="spouse_name" value="{{ (!empty($spouse_info['spouse_name'])?$spouse_info['spouse_name']:'')  }}" class="form-control" placeholder="Spouse Name"  name="spouse_name"/>

            </div>
            <label class="col-md-2 control-label">Occupation</label>
            <div class="col-md-4">
                <input type="text" value="{{ (!empty($spouse_info['spouse_occupation'])?$spouse_info['spouse_occupation']:'')  }}" id="spouse_occupation" class="form-control" placeholder="Occupation"  name="spouse_occupation"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Mobile</label>
            <div class="col-md-4">
                <input type="text" id="spouse_mobile" value="{{ (!empty($spouse_info['spouse_mobile'])?$spouse_info['spouse_mobile']:'')  }}"  class="form-control onlyNumber" placeholder="Mobile"  name="spouse_mobile"/>
            </div>
            <label class="col-md-2 control-label">Designation</label>
            <div class="col-md-4">
                <input type="text" id="spouse_designation" value="{{ (!empty($spouse_info['spouse_designation'])?$spouse_info['spouse_designation']:'')  }}" class="form-control" placeholder="Designation"  name="spouse_designation"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Home District</label>
            <div class="col-md-4">
                <select id="spouse_home_district" class="select2"  name="spouse_home_district">
                    <option value="">Select</option>
                    @if(!empty($all_district))
                        @foreach($all_district as $key=>$value)
                            <option value="{{ $key }}" {{ (isset($spouse_info['spouse_home_district']) && $spouse_info['spouse_home_district']==$key)?"selected":''  }} >{{ $value }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <label class="col-md-2 control-label">Organization</label>
            <div class="col-md-4">
                <input type="text" id="spouse_organization" value="{{ (!empty($spouse_info['spouse_organization'])?$spouse_info['spouse_organization']:'')  }}" class="form-control" placeholder="Organization"  name="spouse_organization"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Address</label>
            <div class="col-md-4">
                <textarea id="spouse_address" class="form-control" placeholder="Address"  name="spouse_address">{{ (!empty($spouse_info['spouse_address'])?$spouse_info['spouse_address']:'')  }}</textarea>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered width100per">
                <thead>
                <tr>
                    <th colspan="4" class="width100per">Children Information</th>
                </tr>
                <tr>
                    <th class="width30per">Name</th>
                    <th  class="width30per">Sex</th>
                    <th  class="width15per">Date of Birth</th>
                    <th class="width10per">Action</th>
                </tr>

                </thead>
                @if(!empty($child_info))
                    @php($k=1)
                    @foreach($child_info as $child)
                    <tr>
                        <td><input type="text" name="childName[]" placeholder="Name" value="{{ (!empty($child['childName']))?$child['childName']:'' }}" class="form-control" id="gchildName_{{ $k }}"></td>
                        <td>
                            <select name="childSex[]" id="childSex_{{ $k }}" class="form-control">
                                <option value="">Select</option>
                                <option value="1" {{ (!empty($child['childSex']) && $child['childSex']==1)?"selected":'' }}>Male</option>
                                <option value="2" {{ (!empty($child['childSex']) && $child['childSex']==2)?"selected":'' }} >Female</option>
                            </select>
                        </td>
                        <td><input type="text" name="child_birth_date[]" value="{{ (!empty($child['child_birth_date']))?$child['child_birth_date']:'' }}" placeholder="Date of Birth" class="form-control datepickerinfo" id="child_birth_date_{{ $k }}"></td>

                        <td><a href="javascript:void(0);"  id="deleteRow_1"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> Drop</a></td>

                    </tr>
                        @php($k++)
                    @endforeach
                @endif

                <tbody id="dynamicChildInfotr">
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6"><button type="button" class="btn btn-primary btn-sm" id="add_child_info" ><i class="glyphicon glyphicon-plus"></i> Add New</button> </td>
                </tr>
                </tfoot>

            </table>

        </div>

    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output_spouse_child"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="{{ $employe_info->employee_id }}">
        <button type="button" onclick="updateSpouseChildInfo()" id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#promotion"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>

    </div>
</div>
{!! Form::close() !!}

<script>
    var scntDivChildInfo = $('#dynamicChildInfotr');
    var child_info = $('#dynamicChildInfotr').size() + 1;
    $('#add_child_info').on('click', function () {
        $('<tr><td><input type="text" name="childName[]" placeholder="Name" class="form-control datepickerinfo" id="increment_date_'+ child_info +'"> </td><td><select name="childSex[]" id="childSex_'+ child_info +'" class="form-control">\n' +
            '                        <option value="">Select</option><option value="1">Male</option><option value="2">Female</option>\n' +
            '                    </select></td><td><input type="text" name="child_birth_date[]" placeholder="Date of Birth" class="form-control datepickerinfo" id="child_birth_date_'+ child_info +'"></td><td><a href="javascript:void(0);"  id="deleteRow_' + child_info + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntDivChildInfo);
        $("#child_birth_date_" + child_info  ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        }).val();
        child_info++;
        return false;
    });
</script>