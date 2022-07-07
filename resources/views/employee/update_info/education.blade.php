{!! Form::open(['url' => '/save_employee_education', 'method' => 'post', 'id' => 'employee_education_form','class'=>'form-horizontal']) !!}
<div class="modal-body">
    <div class="col-sm-12">
        <table class="table table-bordered width100per">
            <thead>
                <tr>
                    <th class="width20per">Degree Name</th>
                    <th  class="width20per">Group/Major Subject</th>
                    <th  class="width20per">Board/Institute</th>
                    <th  class="width10per">Passing Year</th>
                    <th  class="width10per">Result</th>
                    <th  class="width10per">GPA</th>
                    <th class="width10per">Action</th>
                </tr>
            </thead>
                <?php
                $educational_info=(!empty($employee_general_info->education_info))?json_decode($employee_general_info->education_info,true):NULL;
                    if(empty($educational_info)){
                ?>
                <tr>
                    <td>
                        <select name="degree_name[]" id="degree_name_1" class="form-control">
                            <option value="">Select</option>
                            @if(!empty($degree_info))
                                @foreach ($degree_info as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                    <td><input type="text" name="major_subject[]" placeholder="Group/Major Subject" class="form-control" id="major_subject_1"></td>
                    <td><input type="text" name="board_subject[]" placeholder="Board/Institute" class="form-control" id="board_subject_1"></td>
                    <td><input type="text" name="passing_year[]" placeholder="Passing Year" class="form-control" id="passing_year_1"></td>
                    <td><input type="text" name="result_year[]" placeholder="Result" class="form-control" id="result_year_1"></td>
                    <td><input type="text" name="gpa[]" placeholder="GPA" class="form-control" id="gpa_1"></td>
                    <td><a href="javascript:void(0);"  id="deleteRow_1"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> Drop</a></td>

                </tr>
                <?php }else{
                        $edu=101;
                   ?>
                @foreach($educational_info as $parent_key=>$education)
                <tr>
                    <td>
                        <select name="degree_name[]" id="degree_name_{{$edu}}" class="form-control">
                            <option value="">Select</option>
                            @if(!empty($degree_info))
                                @foreach ($degree_info as $key => $value)
                                    <option value="{{ $key }}" {{ (!empty($education['degree_name']) && $education['degree_name']==$key)?"selected":'' }}>{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                    <td><input type="text" name="major_subject[]" value="{{ (!empty($education['major_subject']) )?$education['major_subject']:'' }}" placeholder="Group/Major Subject" class="form-control" id="major_subject_{{$edu}}"></td>
                    <td><input type="text" name="board_subject[]" value="{{ (!empty($education['institution']) )?$education['institution']:'' }}" placeholder="Board/Institute" class="form-control" id="board_subject_{{$edu}}"></td>
                    <td><input type="text" name="passing_year[]" value="{{ (!empty($education['passing_year']) )?$education['passing_year']:'' }}" placeholder="Passing Year" class="form-control" id="passing_year_{{$edu}}"></td>
                    <td><input type="text" name="result_year[]"  value="{{ (!empty($education['result']) )?$education['result']:'' }}" placeholder="Result" class="form-control" id="result_year_{{$edu}}"></td>
                    <td><input type="text" name="gpa[]" value="{{ (!empty($education['cgpa']) )?$education['cgpa']:'' }}" placeholder="GPA" class="form-control" id="gpa_{{$edu}}"></td>
                    <td><a href="javascript:void(0);"  id="deleteRow_{{$edu}}"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> Drop</a></td>

                </tr>
                    @php($edu++)
                @endforeach
                <?php  } ?>
            <tbody id="dynamicEducationtr">
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5"><button type="button" class="btn btn-primary btn-sm" id="add_education" class="add_education"><i class="glyphicon glyphicon-plus"></i> Add New</button> </td>
                </tr>
            </tfoot>

        </table>

    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output_education"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="{{ $employe_info->employee_id }}">
        <button type="button" id="updateBtn" onclick="updateEducationInfo()" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#bank_account"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>
    </div>
</div>
{!! Form::close() !!}






<script>
    var scntDivEducation = $('#dynamicEducationtr');
    var a = $('#dynamicEducationtr tr').size() + 2;
    $('#add_education').on('click', function () {
        $('<tr><td><select name="degree_name[]" id="degree_name_'+ a +'" class="form-control">\n' +
            '                            <option value="">Select</option>\n' +
            '                            @if(!empty($degree_info))\n' +
            '                                @foreach ($degree_info as $key => $value)\n' +
            '                                    <option value="{{ $key }}">{{ $value }}</option>\n' +
            '                                @endforeach\n' +
            '                            @endif\n' +
            '                        </select></td><td><input type="text" name="major_subject[]" placeholder="Group/Major Subject" class="form-control" id="major_subject_'+ a +'"> </td><td><input type="text" name="board_subject[]" placeholder="Board/Institute" class="form-control" id="board_subject_'+ a +'"></td><td> <input type="text" name="passing_year[]" placeholder="Passing Year" class="form-control" id="passing_year_'+ a +'"></td> <td><input type="text" name="result_year[]" placeholder="Result" class="form-control" id="result_year_' + a + '"></td><td><input type="text" name="gpa[]" placeholder="GPA" class="form-control" id="gpa_'+ a +'"></td><td><a href="javascript:void(0);"  id="deleteRow_' + a + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntDivEducation);
        a++;
        return false;
    });
</script>