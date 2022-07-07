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
                </td>
                <td>{{ $row->emp_name }}</td>
                <td>{{ $row->department_title }}</td>
                <td>{{ $row->designation_title }}</td>
                <td>{{ date('h:i a',strtotime($row->start_time))   }} </td>
                <td>{{ date('h:i a',strtotime($row->end_time))   }} </td>
            </tr>
        @endforeach
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