<table id="print_table" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th >SL</th>
        <th > employee Id</th>
        <th > Name</th>
        <th > Station</th>
        <th > Mobile</th>
        <th > Department</th>
        <th > Designation</th>
        <th > Status</th>

    </tr>
    </thead>
    <tbody>
    @if(empty($data))
        <tr><td colspan="11" style="text-align:center">No data found.</td></tr>
    @endif
    @if(!empty($data))
        @php($i=1)
        @foreach($data as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->employee_id }}</td>
                <td>{{ $row->emp_name }}</td>
                <td>{{ $row->station_name }}</td>
                <td>{{ $row->mobile }}</td>
                <td>{{ $row->department_title }}</td>
                <td>{{ $row->designation_title }}</td>
                <td>{{ $row->is_active }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>