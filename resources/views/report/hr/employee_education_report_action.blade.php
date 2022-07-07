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
        <th > Education</th>
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
                <td>
                    <?php
                    $education_info = (!empty($row->education_info))? JSON_DECODE($row->education_info,TRUE):'';
                    if(!empty($education_info)){
                    ?>
                    <table rules="all" border="1px"  class="table-bordered table  sub-table width100per">
                        <tr>
                            <td>Degree</td>
                            <td nowrap>M.Subject</td>
                            <td>Institute</td>
                            <td nowrap>Passing</td>
                            <td>Result</td>
                            <td>CGPA</td>
                        </tr>
                            <?php
                                foreach ($education_info as $edu_info ){
                                    ?>
                                    <tr>
                                        <td>{{ $degree[$edu_info['degree_name']]  }}</td>
                                        <td>{{ $edu_info['major_subject']  }}</td>
                                        <td>{{ $edu_info['institution']  }}</td>
                                        <td>{{ $edu_info['passing_year']  }}</td>
                                        <td>{{ $edu_info['result']  }}</td>
                                        <td>{{ $edu_info['cgpa']  }}</td>
                                    </tr>
                            <?php
                                }
                           ?>
                    </table>
                    <?php } ?>
                </td>
                <td>{{ $row->is_active }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>