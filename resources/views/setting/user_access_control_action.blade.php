<table id="dt_basic" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
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
        <th > #</th>

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
                <td>
                    <button type="button"data-toggle="modal" data-target="#exampleModal" onclick="updateDataUserInfo
                            ('{{ $row->user_primary_id }}','{{ $row->emp_name }}','{{ $row->mobile }}','{{ $row->email }}','{{ '' }}','{{ $row->employee_id }}')" class="btn btn-primary btn-xs">
                        <i class="glyphicon glyphicon-pencil"></i> Update
                    </button>
                    <!--<button type="button" title="Impersonate"   class="btn btn-danger btn-xs"><i class="glyphicon
                    glyphicon-share-alt"></i> Impersonate </button>-->
                    <a href="{{ url('create_access_control/'.$row->user_primary_id) }}" title="Impersonate"   class="btn btn-warning
                    btn-xs"><i class="glyphicon
                    glyphicon-share-alt"></i> Access  </a>

                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dt_basic').DataTable();
    });
</script>
