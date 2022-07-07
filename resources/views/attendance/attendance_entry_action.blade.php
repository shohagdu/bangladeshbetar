{!! Form::open(['url' => '', 'method' => 'post', 'id' => 'employee_attendance_data_form','class'=>'form-horizontal']) !!}
<input type="hidden" name="searching_param" value="{{ $searching_info }}">
<table id="print_table" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th >SL</th>
        <th class="width10per" > employee Id</th>
        <th > Name</th>
        <th > Department</th>
        <th > Designation</th>
        <th class="width5per"  > <input type="checkbox" id="checked_all" > </th>
        <th class="width10per" > In-time</th>
        <th class="width10per"> Out-time</th>

    </tr>
    </thead>
    <tbody>
    @if(empty($data))
        <tr><td colspan="7" style="text-align:center">No data found.</td></tr>
    @endif
    @if(!empty($data))
        @php($i=1)
        @foreach($data as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->employee_id }}
                    {{--<input type="hidden" name="employee_id[]" value="{{  $row->employee_id }}" class="form-control">--}}
                    <input type="hidden" name="attendance_id[{{  $row->employee_id }}]" value="{{  $row->attendance_id }}" class="form-control">
                </td>
                <td>{{ $row->emp_name }}</td>
                <td>{{ $row->department_title }}</td>
                <td>{{ $row->designation_title }}</td>
                <td><input type="checkbox" name="employee_id[{{  $row->employee_id }}]" value="{{  $row->employee_id }}"  {{  (!empty($row->attendance_id)?"checked":'') }} ></td>

                <td><input  type="text" name="in_time[{{  $row->employee_id }}]" placeholder="In-Time" value="{{  (empty($row->start_time)?'9:00 am':$row->start_time) }}" class="form-control timepicker"> </td>
                <td><input type="text" name="end_time[{{  $row->employee_id }}]" placeholder="Out-Time"  value="{{ (empty($row->end_time)?'05:00 pm':$row->end_time) }}" class="form-control timepicker"> </td>
            </tr>
        @endforeach
        <tr><td colspan="7" style="text-align:center"><button type="button" onclick="saved_employee_attendance_info()" class="btn btn-success btn-lg"  ><i class="glyphicon glyphicon-ok-sign"></i> Save</button></td></tr>
    @endif
    </tbody>
</table>
{!! Form::close() !!}
<script>
    $(document).ready(function() {
        $('.timepicker').datetimepicker({
            format: 'hh:mm a'
        });
        $('#checked_all').change(function() {
            var checkboxes = $(this).closest('form').find(':checkbox');
            checkboxes.prop('checked', $(this).is(':checked'));
        });
   });
</script>