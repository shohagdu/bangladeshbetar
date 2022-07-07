{!! Form::open(['url' => '/save_employee_promotion', 'method' => 'post', 'id' => 'employee_promotion_form','class'=>'form-horizontal']) !!}
<div class="modal-body">
    <div class="col-sm-12">
        <table class="table table-bordered width100per">
            <thead>
            <tr>
                <th class="width20per">Designation</th>
                <th  class="width20per">Increment Date</th>
                <th  class="width15per">Go Date</th>
                <th  class="width20per">Nature of Increment</th>
                <th  class="width15per">Pay Scale</th>
                <th class="width10per">Action</th>
            </tr>
            </thead>
            <?php
            $promotion_info = (!empty($employee_general_info->promotion_info)) ? json_decode($employee_general_info->promotion_info, true) : NULL;
            if(!empty($promotion_info)){
                $i=101;
            ?>
            @foreach($promotion_info as $promotion)
            <tr>
                <td>
                    <select name="promotion_designation[]" id="promotion_designation_{{ $i }}" class="form-control">
                        <option value="">Select</option>
                        @if(!empty($designation_info))
                            @foreach($designation_info as $key=>$value)
                                <option value="{{ $key }}" {{ (!empty($promotion['promotion_designation']) && $promotion['promotion_designation']==$key)?"selected":'' }} >{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td><input type="text" value="{{ (!empty($promotion['increment_date']))?$promotion['increment_date']:'' }}" name="increment_date[]" placeholder="Increment Date" class="form-control datepickerinfo" id="increment_date_{{ $i }}"></td>
                <td><input type="text" value="{{ (!empty($promotion['go_date']))?$promotion['go_date']:'' }}" name="go_date[]" placeholder="Go Date" class="form-control datepickerinfo" id="go_date_{{ $i }}"></td>
                <td><input type="text" value="{{ (!empty($promotion['nature_increment']))?$promotion['nature_increment']:'' }}"  name="nature_increment[]" placeholder="Nature of Increment" class="form-control" id="nature_increment_{{ $i }}"></td>
                <td><input type="text" name="pay_scale[]" value="{{ (!empty($promotion['pay_scale']))?$promotion['pay_scale']:'' }}" placeholder="Pay Scale" class="form-control" id="pay_scale_{{ $i }}"></td>
                <td><a href="javascript:void(0);"  id="deleteRow_1"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> Drop</a></td>

            </tr>
                @php($i++)
            @endforeach
            <?php }?>
            <tbody id="dynamicPromotiontr">
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6"><button type="button" class="btn btn-primary btn-sm" id="add_promotion" ><i class="glyphicon glyphicon-plus"></i> Add New</button> </td>
            </tr>
            </tfoot>

        </table>

    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output_promotion"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="{{ $employe_info->employee_id }}">
        <button type="button" id="updateBtn" onclick="updatePromotionInfo()" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#job_history"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>

    </div>
</div>
{!! Form::close() !!}

<script>
    var scntDivPromotion = $('#dynamicPromotiontr');
    var p = $('#dynamicPromotiontr tr').size() + 2;
    $('#add_promotion').on('click', function () {
        $('<tr><td><select name="promotion_designation[]" id="promotion_designation_'+ p +'" class="form-control"><option value="">Select</option> @if(!empty($designation_info))\n' +
            '                            @foreach($designation_info as $key=>$value)\n' +
            '                                <option value="{{ $key }}" >{{ $value }}</option>\n' +
            '                            @endforeach\n' +
            '                        @endif</select></td><td><input type="text" name="increment_date[]" placeholder="Increment Date" class="form-control datepickerinfo" id="increment_date_'+ p +'"> </td><td><input type="text" name="go_date[]" placeholder="Go Date" class="form-control datepickerinfo" id="go_date_'+ p +'"></td><td><input type="text" name="nature_increment[]" placeholder="Nature of Increment" class="form-control" id="nature_increment_'+ p +'"></td><td><input type="text" name="pay_scale[]" placeholder="Pay Scale" class="form-control" id="pay_scale_'+ p +'"></td><td><a href="javascript:void(0);"  id="deleteRow_' + p + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntDivPromotion);
        $("#increment_date_" + p ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        }).val();
        $("#go_date_" + p  ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        }).val();

        p++;
        return false;
    });
</script>