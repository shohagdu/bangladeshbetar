<table id="print_table" rules="all" border="1px"class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th >SL</th>
        <th > Station</th>
        <th > Area </th>
        <th > Land No </th>
        <th > Khotian</th>
        <th > Mouza</th>
        <th > Dag</th>
        <th > location</th>
        <th > Last tax date</th>

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
                <td>{{$row->station_name}}</td>
                <td>{{ $row->area_name }}</td>
                <td>{{ $row->land_no }}</td>
                <td>{{ $row->khotian_no }}</td>
                <td>{{ $row->mouza_no }}</td>
                <td>{{ $row->dag_no }}</td>
                <td>{{ $row->location_name }}</td>
                <td>{{ $row->last_date_tax }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>